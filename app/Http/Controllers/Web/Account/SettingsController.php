<?php
/**
 * MIT License
 *
 * Copyright (c) 2021-2022 FoxxoSnoot, Aeo
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

use Illuminate\Http\Request;
use App\Models\UsernameHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('web.account.settings');
    }

    public function update(Request $request)
    {
        $allowedSettings = ['account', 'privacy', 'password'];

        if (!in_array($request->setting, $allowedSettings)) {
            abort(404);
        }

        if (Auth::user()->flooding()) {
            return back()->withErrors(['You are trying to do things too fast.']);
        }

        $myU = Auth::user();

        if ($request->setting == 'account') {
            $allowedThemes = ['light', 'dark'];

            if ($request->username != Auth::user()->username) {
                if (Auth::user()->currency_cash < 250) {
                    return back()->withErrors(['You need at least 250 Cash to change your username.']);
                }

                $this->validate(request(), [
                    'username' => ['min:3', 'max:20', 'regex:/\\A[a-z\\d]+(?:[.-][a-z\\d]+)*\\z/i', 'unique:users']
                ], [
                    'username.unique' => 'Username has already been taken.'
                ]);

                $usernameHistory = UsernameHistory::where('username', '=', $request->username)->first();

                if (UsernameHistory::where('username', '=', $request->username)->exists() && $usernameHistory->user_id != Auth::user()->id) {
                    return back()->withErrors('Username has already been taken.');
                }

                $usernameHistory = UsernameHistory::create([
                    'user_id' => $myU->id,
                    'username' => $myU->username
                ]);

                $myU->username = $request->username;
                $myU->currency_cash -= 250;
                $myU->save();
            }

            if (!in_array($request->theme, $allowedThemes)) {
                return back()->withErrors(['Invalid theme.']);
            }

            $this->validate(request(), [
                'description' => ['max:1000'],
                'signature' => ['max:100']
            ]);

            if (isProfanity($request->description)) {
                return back()->withErrors(['One or more words in your description has triggered our profanity filter. Please update and try again.']);
            }

            $myU->description = $request->description;
            $myU->signature = $request->signature;
            $myU->theme = $request->theme;
            $myU->save();

            Auth::user()->updateFlood();

            return back()->with('success_message', 'Account Settings have been updated!');
        } else if ($request->setting == 'privacy') {
            $allowedMessageOptions = ['everyone', 'friends', 'no_one'];
            $allowedFriendOptions = ['everyone', 'no_one'];
            $allowedTradeOptions = ['everyone', 'friends', 'no_one'];
            $allowedInventoryOptions = ['everyone', 'friends', 'no_one'];

            if (!in_array($request->message, $allowedMessageOptions) || !in_array($request->friend, $allowedFriendOptions) || !in_array($request->trade, $allowedTradeOptions) || !in_array($request->inventory, $allowedInventoryOptions)) {
                abort(404);
            }

            $myU->setting_message = $request->message;
            $myU->setting_friend = $request->friend;
            $myU->setting_trade = $request->trade;
            $myU->setting_inventory = $request->inventory;
            $myU->save();

            Auth::user()->updateFlood();

            return back()->with('success_message', 'Privacy Settings have been updated!');
        } else if ($request->setting == 'password') {
            $this->validate(request(), [
                'current_password' => ['required'],
                'new_password' => ['required', 'confirmed', 'min:6', 'max:255']
            ]);

            if (!Hash::check($request->current_password, $myU->password)) {
                return back()->withErrors(['Incorrect current password.']);
            }

            $myU->password = bcrypt($request->new_password);
            $myU->save();

            Auth::user()->updateFlood();

            return back()->with('success_message', 'Password has been updated!');
        }
    }
}
