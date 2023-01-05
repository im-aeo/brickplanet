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

@extends('layouts.2017.land', [
    'title' => 'Error 404'
])

@section('content')
<div class="video-content">
<div class="content-title">The place to create.</div>
<div class="content-subtitle">Join the {{ config('site.name') }} Community and Start Exploring Today!</div>

<div class="content-links auth-menu"><a href="{{ route('auth.register.index') }}" class="button-create-account">Sign up</a></div>
</div>
<div class="site-footer"><span>© Copyright {{ date('Y') }} {{ config('site.name') }} All rights reserved.</span></div>

@endsection