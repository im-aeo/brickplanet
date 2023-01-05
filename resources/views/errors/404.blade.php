<!--
MIT License

Copyright (c) 2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

@extends('layouts.default', [
    'title' => 'Error 404'
])

@section('content')
<div class="container lg-padding border-r">
			<div class="grid-x grid-margin-x">
				<div class="small-3 cell text-left error-border-right show-for-large">
					<p><h5>Helpful Links</h5></p>
					<li><a href="{{ route('home.index') }}">Return Home</a></li>
					<li><a href="{{ route('forum.index') }}">Community Forum</a></li>
					<li><a href="{{ route('games.index') }}">Popular Games</a></li>
					<li><a href="{{ route('account.upgrade.index') }}">Account Upgrades</a></li>
					<li><a href="{{ route('account.settings.index', '') }}">Account Settings</a></li>
				</div>
				<div class="small-2 cell text-left hide-for-large"></div>
				<div class="small-9 cell text-center">
					<h1 class="error-messageLarge">404, not found</h1>
					<div class="error-divider"></div>
					<p class="error-subErrorText">The page or resource you have requested could not be found or never existed.</p>
					<p class="error-contactText">If you continue to experience this error and believe it is a mistake, please <a href="#">contact us</a>.</p>
				</div>
			</div>
		</div>
<div style="padding-top:25px;">
				<b>Error Code:</b> {{ generateRandomString() }}
			</div>
@endsection
