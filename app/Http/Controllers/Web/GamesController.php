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

namespace App\Http\Controllers\Web;

use App\Models\Game;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::where('is_active', '=', true)->orderBy('playing', 'DESC')->paginate(24);

        return view('web.games.index')->with([
            'games' => $games
        ]);
    }

    public function download()
    {
        return view('web.games.download');
    }

    public function view($id)
    {
        $game = Game::where('id', '=', $id)->firstOrFail();

        return view('web.games.view')->with([
            'game' => $game
        ]);
    }

    public function edit($id)
    {
        $game = Game::where([
            ['id', '=', $id],
            ['creator_id', '=', Auth::user()->id]
        ])->firstOrFail();

        return view('web.games.edit')->with([
            'game' => $game
        ]);
    }

    public function update(Request $request)
    {
        $game = Game::where([
            ['id', '=', $request->id],
            ['creator_id', '=', Auth::user()->id]
        ])->firstOrFail();

        $filename = Str::random(50);
        $validate = [
            'name' => ['required', 'min:3', 'max:70', 'regex:/^[a-z0-9 .\-!,\':;<>?()\[\]+=\/]+$/i'],
            'description' => ['max:1024']
        ];

        if ($request->hasFile('thumbnail'))
            $validate['thumbnail'] = ['required', 'dimensions:min_width=100,min_height=100', 'mimes:png,jpg,jpeg', 'max:2048'];

        $this->validate($request, $validate);

        $game->name = $request->name;
        $game->description = $request->description;

        if ($request->hasFile('thumbnail')) {
            if ($game->is_thumbnail_pending)
                return back()->withErrors(["Current thumbnail hasn't been moderated yet."]);

            $game->is_thumbnail_pending = true;

            if (Storage::exists("thumbnails/games/{$game->thumbnail()}.png"))
                Storage::delete("thumbnails/games/{$game->thumbnail()}.png");

            $game->thumbnail = $filename;

            $thumbnail = imagecreatefromstring($request->file('thumbnail')->get());
            $img = imagecreatetruecolor(892, 640);

            imagealphablending($img, false);
            imagesavealpha($img, true);
            imagefilledrectangle($img, 0, 0, 892, 640, imagecolorallocatealpha($img, 255, 255, 255, 127));
            imagecopyresampled($img, $thumbnail, 0, 0, 0, 0, 892, 640, imagesx($thumbnail), imagesy($thumbnail));

            $thumbnail = $img;
            imagealphablending($thumbnail, false);
            imagesavealpha($thumbnail, true);

            if (!Storage::exists('thumbnails/games/'))
                Storage::makeDirectory('thumbnails/games/');

            Storage::put("thumbnails/games/{$filename}.png", Image::make($thumbnail)->encode('png'));
        }

        $game->save();

        return redirect()->route('games.view', $game->id)->with('success_message', 'Set has been updated.');
    }

    public function creations()
    {
        $games = Auth::user()->games();

        return view('web.games.creations')->with([
            'games' => $games
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $default = rand(1, 7);

        if ($user->games()->count() >= 5)
            return back()->withErrors(['Max set limit reached.']);

        $game = new Game;
        $game->creator_id = $user->id;
        $game->host_key = Str::random(100);
        $game->name = "{$user->username}'s Set";
        $game->thumbnail = "default_{$default}";
        $game->save();

        return back()->with('success_message', 'Set created.');
    }
}
