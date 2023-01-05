<?php
/**
 * MIT License
 *
 * Copyright (c) 2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace App\Http\Controllers\Web\Account;

use Carbon\Carbon;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\ThumbnailQueue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
 public const AVATAR_COLORS = [
        '#f3b700',
        '#d34a05',
        '#c60000',
        '#c81879',
        '#1c4399',
        '#3292d3',
        '#c2dc7f',
        '#1d6a19',
        '#85ad00',
        '#441209',
        '#c15b2c',
        '#f1f1f1',
        '#fcfcc9',
        '#fcff81',
        '#e087b6',
        '#815ea6',
        '#7eb2e6',
        '#39b2ca',
        '#b9ded1',
        '#caad64',
        '#eab372',
        '#ddddd0',
        '#e58700',
        '#810058',
        '#ac93c6',
        '#4578bb',
        '#4f607a',
        '#507051',
        '#76603f',
        '#ffffff',
        '#897f7e',
        '#7b8183',
        '#650013',
        '#220965',
        '#3b1e81',
        '#586e85',
        '#248233',
        '#6e703f',
        '#936941',
        '#8d290b',
        '#3b3f44',
        '#936b1c',
        '#0a1b32',
        '#103a21',
        '#210c07',
        '#000000',
        '#37302c',
        '#3b3f44',
        '#eeec9f',
        '#e1a479',
        '#de9c93',
        '#d97b87',
        '#e4b9d4',
        '#b9b6d7',
        '#cbe2ec',
        '#9ec6eb',
        '#d7e3f3',
        '#a2c8a5',
        '#bff59e',
        '#eeea98',
        '#bdb4b0',
        '#e9eaee',
        '#9ec6eb'
    ];

    public function index()
    {
        $colors = $this::AVATAR_COLORS;

        return view('web.account.character')->with([
            'colors' => $colors
        ]);
    }

    public function thumbnails()
    {
        return response()->json([
            'thumbnail' => Auth::user()->thumbnail(),
            'headshot' => Auth::user()->headshot()
        ]);
    }

    public function regenerate()
    {
        $avatar = Auth::user()->avatar();
        $avatar->flood = Carbon::createFromTimestamp(time() + 5)->toDateTimeString();
        $avatar->save();

        render(Auth::user()->id, 'user');

        return $this->thumbnails();
    }

    public function inventory(Request $request)
    {
        $type = lcfirst(itemTypeFromPlural($request->category));

        if (!in_array($type, config('site.character_editor_item_types')))
            return response()->json(['error' => 'Invalid category.']);

        $items = Item::where([
            ['type', '=', $type],
            ['status', '=', 'approved']
        ])->join('inventories', 'inventories.item_id', '=', 'items.id')->where('inventories.user_id', '=', Auth::user()->id)->orderBy('inventories.created_at', 'DESC')->paginate(8);
        $avatar = Auth::user()->avatar();
        $json = ['current_page' => $items->currentPage(), 'total_pages' => $items->lastPage(), 'items' => []];

        if ($items->count() == 0)
            return response()->json(['error' => "No {$request->category} found."]);

        foreach ($items as $item) {
            $item->id = $item->item_id;

            switch ($item->type) {
                case 'hat':
                    $isWearing = ($avatar->hat_1 == $item->id || $avatar->hat_2 == $item->id || $avatar->hat_3 == $item->id);
                    break;
                case 'head':
                    $isWearing = $avatar->head == $item->id;
                    break;
                case 'face':
                    $isWearing = $avatar->face == $item->id;
                    break;
                case 'gadget':
                    $isWearing = $avatar->gadget == $item->id;
                    break;
                case 'tshirt':
                    $isWearing = $avatar->tshirt == $item->id;
                    break;
                case 'shirt':
                    $isWearing = $avatar->shirt == $item->id;
                    break;
                case 'pants':
                    $isWearing = $avatar->pants == $item->id;
                    break;
            }

            $json['items'][] = ['id' => $item->id, 'name' => $item->name, 'type' => $item->type, 'thumbnail' => str_replace("https://cdn.detrimo.com/", "https://cdn.detrimo.com/thumbnails/", $item->thumbnail()), 'url' => route('catalog.item', [$item->id, $item->slug()]), 'is_wearing' => $isWearing];
        }

        return response()->json($json);
    }

    public function thumbFix($link){
        return str_replace("https://cdn.detrimo.com/", "https://cdn.detrimo.com/thumbnails/", $link);
    }

    public function wearing()
    {
        $avatar = Auth::user()->avatar();
        $items = [];

        if (
            !$avatar->hat_1 &&
            !$avatar->hat_2 &&
            !$avatar->hat_3 &&
            !$avatar->head &&
            !$avatar->face &&
            !$avatar->gadget &&
            !$avatar->tshirt &&
            !$avatar->shirt &&
            !$avatar->pants
        ) return response()->json(['error' => 'You are not wearing any items.']);

        if ($avatar->hat_1)
            $items[] = ['name' => $avatar->hat(1)->name, 'type' => $avatar->hat(1)->type, 'thumbnail' => $this->thumbFix($avatar->hat(1)->thumbnail()), 'url' => route('catalog.item', [$avatar->hat(1)->id, $avatar->hat(1)->slug()]), 'type' => 'hat_1'];

        if ($avatar->hat_2)
            $items[] = ['name' => $avatar->hat(2)->name, 'type' => $avatar->hat(2)->type, 'thumbnail' => $this->thumbFix($avatar->hat(2)->thumbnail()), 'url' => route('catalog.item', [$avatar->hat(2)->id, $avatar->hat(2)->slug()]), 'type' => 'hat_2'];

        if ($avatar->hat_3)
            $items[] = ['name' => $avatar->hat(3)->name, 'type' => $avatar->hat(3)->type, 'thumbnail' => $this->thumbFix($avatar->hat(3)->thumbnail()), 'url' => route('catalog.item', [$avatar->hat(3)->id, $avatar->hat(3)->slug()]), 'type' => 'hat_3'];

        if ($avatar->head)
            $items[] = ['name' => $avatar->head()->name, 'type' => $avatar->head()->type, 'thumbnail' => $this->thumbFix($avatar->head()->thumbnail()), 'url' => route('catalog.item', [$avatar->head()->id, $avatar->head()->slug()]), 'type' => 'head'];

        if ($avatar->face)
            $items[] = ['name' => $avatar->face()->name, 'type' => $avatar->face()->type, 'thumbnail' => $this->thumbFix($avatar->face()->thumbnail()), 'url' => route('catalog.item', [$avatar->face()->id, $avatar->face()->slug()]), 'type' => 'face'];

        if ($avatar->gadget)
            $items[] = ['name' => $avatar->gadget()->name, 'type' => $avatar->gadget()->type, 'thumbnail' => $this->thumbFix($avatar->gadget()->thumbnail()), 'url' => route('catalog.item', [$avatar->gadget()->id, $avatar->gadget()->slug()]), 'type' => 'gadget'];

        if ($avatar->tshirt)
            $items[] = ['name' => $avatar->tshirt()->name, 'type' => $avatar->tshirt()->type, 'thumbnail' => $this->thumbFix($avatar->tshirt()->thumbnail()), 'url' => route('catalog.item', [$avatar->tshirt()->id, $avatar->tshirt()->slug()]), 'type' => 'tshirt'];

        if ($avatar->shirt)
            $items[] = ['name' => $avatar->shirt()->name, 'type' => $avatar->shirt()->type, 'thumbnail' => $this->thumbFix($avatar->shirt()->thumbnail()), 'url' => route('catalog.item', [$avatar->shirt()->id, $avatar->shirt()->slug()]), 'type' => 'shirt'];

        if ($avatar->pants)
            $items[] = ['name' => $avatar->pants()->name, 'type' => $avatar->pants()->type, 'thumbnail' => $this->thumbFix($avatar->pants()->thumbnail()), 'url' => route('catalog.item', [$avatar->pants()->id, $avatar->pants()->slug()]), 'type' => 'pants'];

        return response()->json($items);
    }

    public function update(Request $request)
    {
        $avatar = Auth::user()->avatar();

        switch ($request->action) {
            case 'wear':
                $item = Item::where('id', '=', $request->id);

                if (!$item->exists())
                    return response()->json(['error' => 'Invalid item.']);

                $item = $item->first();
                $column = ($item->type == 'hat') ? 'hat_1' : $item->type;

                if (!Auth::user()->ownsItem($item->id))
                    return response()->json(['error' => 'You do not own this item.']);

                if ($item->status != 'approved')
                    return response()->json(['error' => 'This item is not approved.']);

                if ($item->type == 'hat') {
                    if (!$avatar->hat_1)
                        $column = 'hat_1';
                    else if (!$avatar->hat_2)
                        $column = 'hat_2';
                    else if (!$avatar->hat_3)
                        $column = 'hat_3';
                }

                $avatar->$column = $item->id;
                $avatar->save();

                return $this->regenerate();
            case 'remove':
                if (!in_array($request->type, ['hat_1', 'hat_2', 'hat_3', 'head', 'face', 'gadget', 'tshirt', 'shirt', 'pants']))
                    return response()->json(['error' => 'Invalid type.']);

                $avatar->{$request->type} = null;
                $avatar->save();

                return $this->regenerate();
            case 'angle':
                if (!in_array($request->angle, ['left', 'right']))
                    return response()->json(['error' => 'Invalid angle.']);

                if ($avatar->angle == $request->angle)
                    return $this->thumbnails();

                $avatar->angle = $request->angle;
                $avatar->save();

                return $this->regenerate();
            case 'color':
                $colors = $this::AVATAR_COLORS;

                if (!in_array($request->body_part, ['head', 'torso', 'left_arm', 'right_arm', 'left_leg', 'right_leg']))
                    return response()->json(['error' => 'Invalid body part.']);

                if (!array_key_exists($request->color, $colors))
                    return response()->json(['error' => 'Invalid color.']);

                if ($avatar->{"color_{$request->body_part}"} == $colors[$request->color])
                    return $this->thumbnails();

                $avatar->{"color_{$request->body_part}"} = $colors[$request->color];
                $avatar->save();

                return $this->regenerate();
            default:
                return response()->json(['error' => 'Invalid action.']);
        }
    }
}
