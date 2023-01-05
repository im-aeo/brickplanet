<!--
MIT License

Copyright (c) 2022 Aeo

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

@extends('layouts.2019.land', [
    'title' => 'Landing'
])

@section('js')
    @if (config('app.env') == 'production' && site_setting('registration_enabled'))
        {!! NoCaptcha::renderJs() !!}
    @endif
@endsection

@section('content')
<link href="https://fonts.googleapis.com/css?family=Baloo+Tammudu" rel="stylesheet">
		<div class="landing-box">
			<div class="grid-container site-container-margin">
				<div class="grid-x grid-margin-x">
					<div class="large-7 cell">
						<div class="lb-title">Welcome to {{ config('site.name') }}</div>
						<div class="lb-text">{{ config('site.name') }} is an online 3D gaming platform where users can collaborate to create awesome games, clothing, and participate in a virtual economy. Join us to create an online virtual world where the possibilities are endless.</div>
					</div>
@if (!site_setting('registration_enabled'))
        
    @else
					<div class="large-4 large-offset-1 cell">
						<div class="landing-signup">
							<div class="ls-title">Get started for free</div>
							 <form action="{{ route('auth.register.authenticate') }}" method="POST">
                            @csrf
								<input type="email" name="email" class="ls-input" placeholder="Email Address">
								<div class="push-15"></div>
								<input type="text" name="username" class="ls-input" placeholder="Username">
								<div class="push-15"></div>
								<input type="password" name="password" class="ls-input" placeholder="Password">
								<div class="push-15"></div>
								<input type="password" name="confirm-password_confirmation" class="ls-input" placeholder="Confirm Password">
								<div class="push-15"></div>
							@if (config('app.env') == 'production')
                                {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                            @endif
								<div class="push-15"></div>
								<input type="submit" class="button button-green" value="Sign up">
							</form>
						</div>
					</div>
                  @endif
				</div>
			</div>
		</div>

@endsection
