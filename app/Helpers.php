<?php
/**
 * MIT License
 *
 * Copyright (c) 2022 FoxxoSnoot, Aeo
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

use App\Models\Item;
use App\Models\User;
use App\Models\Group;
use App\Models\Report;
use App\Models\StaffUser;
use Illuminate\Support\Str;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require_once(__DIR__ . '/PaypalIPN.php');

function site_setting($key)
{
    $settings = SiteSettings::where('id', '=', 1)->first();

    return $settings->$key;
}

function set_active($path, $active = 'active') {

    return call_user_func_array('Route::is', (array)$path) ? $active : '';

}

function game_launch($string)
{
    $replaceArray = [
        0 => "SDOCPAP34394L",
        1 => "CNSA43278PDI4",
        2 => "FHB43REW4AS6N",
        3 => "ASD7VFGMHJDFG",
        4 => "NCIRF42423VU4",
        5 => "D940BXXAOER45",
        6 => "52V852J8KV38Y",
        7 => "ASD97DSF523VX",
        8 => "XSDAPFOR94NA3",
        9 => "STYU6GHJ4GDUU7",
        "-" => "ASDU4G234L3VHJ",
        "a" => "XA6W77ZKX4DX",
        "b" => "85JM67LHQK65",
        "c" => "Z5RU8XZS34M4",
        "d" => "S8KZEE7M6CZV",
        "e" => "YUHJ266VW7YK",
        "f" => "AJCDY8887SER",
        "g" => "UG9U2KCA762A",
        "h" => "FW6W64QWHYDN",
        "i" => "BW2GHBM5TRMB",
        "j" => "9ATDW583DNKH",
        "k" => "SE8YS2Q92WX8",
        "l" => "P6JVFRC3R2PU",
        "m" => "FH7R6P3NBD6S",
        "n" => "7MBNZB5S9Z3E",
        "o" => "ZJQ8N22TCU6W",
        "p" => "DADG4K98N7VA",
        "q" => "PV2P3FNZFRA2",
        "r" => "ZADKTJGV69UE",
        "s" => "XHEAG2KDBMZE",
        "t" => "NDGMDV6F5DSV",
        "u" => "3YZ5CNDYFXRJ",
        "v" => "G4G5C5WF3ETU",
        "w" => "4NQ74VWZAFK7",
        "x" => "JLGRJ9T5SGUV",
        "y" => "LESGS87NF685",
        "z" => "4DPSNWDQ4XMQ",
        "A" => "GK5MHDHSZ7C7",
        "B" => "RRV2E48JDBYB",
        "C" => "TPPT6L8RVT29",
        "D" => "B77RBGLKUJ93",
        "E" => "FSB7LP6956CL",
        "F" => "87H9TE7MFC2R",
        "G" => "FAJV5F8UA7ND",
        "H" => "99Y9BL6R3AQD",
        "I" => "TNGL8HGAXAWQ",
        "J" => "H7SL7CL98D3H",
        "K" => "NM6H6CP3WTU5",
        "L" => "5T2XL5GPT9B4",
        "M" => "RBW6MHQBRP6L",
        "N" => "R3N9TCNVEQ6Q",
        "O" => "5GAQK8GS7WZP",
        "P" => "V6R89BMBHMG4",
        "Q" => "DQ5WHTQ52NKH",
        "R" => "6Y4KLGMG9PEC",
        "S" => "DKUC4Q8GHVKQ",
        "T" => "X464XS96JPRU",
        "U" => "JWQXHK2UF35M",
        "V" => "BFTHE2A6BSPQ",
        "W" => "YWD3AWTAYHVM",
        "X" => "4ASA5KRER9VJ",
        "Y" => "F5LCBCQL3Z85",
        "Z" => "MTZA99FRDE8T"
    ];
}  
function shortNum($num) {
		if ($num < 999) {
			return $num;
		}
		else if ($num > 999 && $num <= 9999) {
			$new_num = substr($num, 0, 1);
			return $new_num.'K+';
		}
		else if ($num > 9999 && $num <= 99999) {
			$new_num = substr($num, 0, 2);
			return $new_num.'K+';
		}
		else if ($num > 99999 && $num <= 999999) {
			$new_num = substr($num, 0, 3);
			return $new_num.'K+';
		}
		else if ($num > 999999 && $num <= 9999999) {
			$new_num = substr($num, 0, 1);
			return $new_num.'M+';
		}
		else if ($num > 9999999 && $num <= 99999999) {
			$new_num = substr($num, 0, 2);
			return $new_num.'M+';
		}
		else if ($num > 99999999 && $num <= 999999999) {
			$new_num = substr($num, 0, 3);
			return $new_num.'M+';
		}
		else {
			return $num;
		}
	}

	function get_timeago($ptime) {
		$estimate_time = time() - $ptime;

		if($estimate_time < 45) {
			return 'just now';
		}
		$condition = array(
			12 * 30 * 24 * 60 * 60 => 'year',
			30 * 24 * 60 * 60 => 'month',
			24 * 60 * 60 => 'day',
			60 * 60 => 'hour',
			60 => 'min',
			1 => 'sec'
		);
		foreach($condition as $secs => $str) {
				$d = $estimate_time / $secs;
			if($d >= 1) {
				$r = round( $d );
				return '' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
			}
		}
	}
function get_short_timeago($ptime) {
		$estimate_time = time() - $ptime;

		if($estimate_time < 45) {
			return 'just now';
		}
		$condition = array(
			12 * 30 * 24 * 60 * 60 => 'yr',
			30 * 24 * 60 * 60 => 'month',
			24 * 60 * 60 => 'day',
			60 * 60 => 'hr',
			60 => 'min',
			1 => 'sec'
		);
		foreach($condition as $secs => $str) {
				$d = $estimate_time / $secs;
			if($d >= 1) {
				$r = round( $d );
				return '' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
			}
		}
	}

	function get_timeagoMSG($ptime) {
		$estimate_time = time() - $ptime;

		if($estimate_time < 45) {
			return 'NOW';
		}
		$condition = array(
			12 * 30 * 24 * 60 * 60 => 'YR',
			30 * 24 * 60 * 60 => 'MNTH',
			24 * 60 * 60 => 'D',
			60 * 60 => 'HR',
			60 => 'MIN',
			1 => 'SEC'
		);
		foreach($condition as $secs => $str) {
				$d = $estimate_time / $secs;
			if($d >= 1) {
				$r = round( $d );
				return '' . $r . '' . $str . ( $r > 1 ? '' : '' ) . '';
			}
		}
	}

function staffUser()
{
    return User::where('id', '=', session('staff_user_site_id'))->first();
}

function pendingAssetsCount()
{
    if (Auth::user()->staff('can_review_pending_assets'))
        return Item::where('status', '=', 'pending')->count() + Group::where('is_thumbnail_pending', '=', true)->count();

    return 0;
}

function pendingReportsCount()
{
    if (Auth::user()->staff('can_review_pending_reports'))
        return Report::where('is_seen', '=', false)->count();

    return 0;
}

function itemType($type, $plural = false)
{
    $types = config('item_types');
    $type = (array_key_exists($type, $types)) ? $types[$type][($plural) ? 1 : 0] : ucfirst($type);

    return $type;
}

function itemTypeFromPlural($type)
{
    $types = config('item_types');

    foreach ($types as $t) {
        if ($t[1] == ucfirst($type))
            return $t[0];
    }

    return ucfirst($type);
}
function generateRandomString($length = 10) {
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function itemTypePadding($type)
{
    if ($type == 'default')
        return '5px';

    $types = config('site.item_thumbnails_with_padding');
    $padding = (in_array($type, $types)) ? 5 : 0;

    return "{$padding}px";
}

function render($id, $type)
{
    $url = config('site.renderer.url');
    $key = config('site.renderer.key');

    $response = Http::get("{$url}?seriousKey={$key}&type={$type}&id={$id}");

    return ($type != 'preview') ? $response->successful() : $response->json()['thumbnail'];
}
