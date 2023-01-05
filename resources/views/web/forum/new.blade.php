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
<div class="container-header md-padding">
<strong>New {{ ucfirst($type) }}</strong>
</div>

<div class="container border-wh md-padding">
    <form action="{{ route('forum.create') }}" method="POST">
        <div class="grid-x grid-margin-x">
            <div class="auto cell">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="type" value="{{ $type }}">

                        @if ($quote)
              <div class="forum-quote">
											<div class="forum-quote-info">Originally posted by <a href="{{ route('users.profile', $quote->creator->username) }}">{{ $quote->creator->username }}</a>&nbsp;-&nbsp;{{ $quote->created_at->diffForHumans() }}</div>
											<div class="forum-quote-post"><div class="forum-thread-body">{!! nl2br(e($quote->body)) !!}</div></div>
										</div>
										<div class="push-15"></div>
                        @endif

                        @if ($type == 'thread')
                            <label for="title">Title</label>
                            <input class="normal-input" type="text" name="title" placeholder="Title" required>
                      <div class="push-15"></div>
                        @endif

                        <label for="body">Body</label>
                        <textarea class="normal-input" name="body" placeholder="Write your post here..." rows="5" required></textarea>
                      <div class="push-15"></div>
              </div>
              </div>
          <div class="grid-x grid-margin-x align-middle">
					<div class="auto cell">
                        <button class="button button-green" type="submit">Create</button>
						</div>
					</div>
				</div>
			</form>
		</div>
@endsection
