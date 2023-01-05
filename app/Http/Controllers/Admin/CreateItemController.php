<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\CrateItem;
use App\Models\BundleItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CreateItemController extends Controller
{
    public function index($type)
    {
        switch ($type) {
            case 'hat':
                $title = 'Create New Hat';

                if (!staffUser()->staff('can_create_hat_items')) abort(404);
                break;
            case 'face':
                $title = 'Create New Face';

                if (!staffUser()->staff('can_create_face_items')) abort(404);
                break;
            case 'gadget':
                $title = 'Create New Gadget';

                if (!staffUser()->staff('can_create_gadget_items')) abort(404);
                break;
            case 'crate':
                $title = 'Create New Crate';
                $rarities = CrateItem::RARITY_NAMES;

                if (!staffUser()->staff('can_create_crate_items')) abort(404);
                break;
            case 'bundle':
                $title = 'Create New Bundle';

                if (!staffUser()->staff('can_create_bundle_items')) abort(404);
                break;
            default:
                abort(404);
        }

        return view('admin.create_item')->with([
            'title' => $title,
            'type' => $type,
            'rarities' => $rarities ?? []
        ]);
    }

    public function create(Request $request)
    {
        if (
            !in_array($request->type, ['hat', 'face', 'gadget', 'crate', 'bundle']) ||
            (!staffUser()->staff('can_create_hat_items') && $request->type == 'hat') ||
            (!staffUser()->staff('can_create_face_items') && $request->type == 'face') ||
            (!staffUser()->staff('can_create_gadget_items') && $request->type == 'gadget') ||
            (!staffUser()->staff('can_create_crate_items') && $request->type == 'crate') ||
            (!staffUser()->staff('can_create_bundle_items') && $request->type == 'bundle')
        ) abort(404);

        $onsale = $request->has('onsale');
        $official = $request->has('official');
        $public = $request->has('public');
        $limited = $request->has('limited');
        $filename = Str::random(50);
        $validate = [
            'name' => ['required', 'min:1', 'max:70'],
            'description' => ['max:1024']
        ];

        if (in_array($request->type, ['crate', 'bundle']))
            $validate['items'] = ['required'];

        if ($request->type == 'crate')
            $validate['rarities'] = ['required'];

        if ($request->type != 'bundle') {
            $validate['image'] = ['required', 'mimes:png,jpg,jpeg', 'max:2048'];

            if ($request->type != 'face')
                $validate['model'] = ['required', 'mimes:txt', 'max:2048'];
        }

        if ($onsale)
            $validate['price'] = ['required', 'numeric', 'min:0', 'max:1000000'];

        if ($limited)
            $validate['stock'] = ['required', 'numeric', 'min:0', 'max:500'];

        $this->validate($request, $validate);

        switch ($request->onsale_for) {
            case '1_hour':
                $time = 3600;
                break;
            case '12_hours':
                $time = 43200;
                break;
            case '1_day':
                $time = 86400;
                break;
            case '3_days':
                $time = 259200;
                break;
            case '7_days':
                $time = 604800;
                break;
            case '14_days':
                $time = 1209600;
                break;
            case '21_days':
                $time = 1814400;
                break;
            case '1_month':
                $time = 2592000;
                break;
        }

        if ($request->type == 'crate') {
            $rarities = explode(',', $request->rarities);
            $items = explode(',', $request->items);

            if (count($rarities) != count($items))
                return back()->withErrors(['Rarity IDs and item IDs do not match up.']);

            foreach ($rarities as $rarity) {
                if (!array_key_exists((int) $rarity, CrateItem::RARITY_NAMES))
                    return back()->withErrors(['One of the rarity IDs provided is incorrect.']);
            }
        }

        if (in_array($request->type, ['crate', 'bundle'])) {
            $items = explode(',', $request->items);

            foreach ($items as $item) {
                if (!Item::where('id', '=', $item)->exists())
                    return back()->withErrors(['One of the item IDs provided is incorrect.']);
            }
        }

        $item = new Item;
        $item->creator_id = (!$official) ? staffUser()->id : 1;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->type = $request->type;
        $item->status = 'approved';
        $item->price = ($onsale) ? $request->price : 0;
        $item->limited = $limited;
        $item->stock = ($limited) ? $request->stock : 0;
        $item->public_view = $public;
        $item->onsale = $onsale;
        $item->filename = $filename;
        $item->onsale_until = ($onsale && isset($time)) ? Carbon::createFromTimestamp(time() + $time)->format('Y-m-d H:i:s') : null;
        $item->save();

        if ($request->type == 'crate') {
            $rarities = explode(',', $request->rarities);
            $items = explode(',', $request->items);
            $i = 0;

            foreach ($items as $id) {
                $crateItem = new CrateItem;
                $crateItem->item_id = (int) $id;
                $crateItem->crate_id = $item->id;
                $crateItem->rarity = $rarities[$i];
                $crateItem->save();

                $i++;
            }
        }

        if ($request->type == 'bundle') {
            $items = explode(',', $request->items);

            foreach ($items as $id) {
                $bundleItem = new BundleItem;
                $bundleItem->item_id = (int) $id;
                $bundleItem->bundle_id = $item->id;
                $bundleItem->save();
            }
        }

        if ($item->type != 'bundle') {
            Storage::putFileAs('uploads', $request->file('image'), "{$filename}.png");

            if ($item->type != 'face')
                Storage::putFileAs('uploads', $request->file('model'), "{$filename}.obj");
        }

        render($item->id, 'item');

        return redirect()->route('catalog.item', [$item->id, $item->slug()]);
    }
}
