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
    'title' => $title
])

@section('content')
	<div class="grid-x grid-margin-x">
		<div class="large-8 large-offset-2 cell">
			
			<h4>{{ $title }}</h4>
			<div class="container border-r md-padding">
                    <form action="{{ route('account.inbox.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="type" value="{{ $type }}">
                        @if ($type == 'message')
                            <label for="title">Title</label>
                            <input class="normal-input" type="text" name="title" placeholder="Title" required>
                        @endif
                        <label for="body">Body</label>
                        <textarea class="normal-input" name="body" placeholder="Write your message here..." rows="5" required></textarea>
                      <div class="push-15"></div>
                        <button class="button button-blue" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
