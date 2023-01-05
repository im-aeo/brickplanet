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
    'title' => $message->title
])

@section('css')
    <style>
        img.user-headshot {
            background: var(--headshot_bg);
            border-radius: 50%;
            width: 50%;
            margin: 0 auto;
            display: block;
        }

        @media only screen and (min-width: 768px) {
            img.user-headshot {
                width: 60%;
            }
        }
    </style>
@endsection

@section('content')
<div class="grid-x grid-margin-x message-top-links">
			<div class="auto cell">
				<a href="{{ route('home.index') }}">Dashboard</a> &raquo; <a href="{{ route('account.inbox.index', '') }}">Inbox</a> &raquo; {{ $message->title }}
			</div>
		</div>
		<div class="container md-padding border-r">
			<div class="grid-x grid-margin">
				<div class="large-2 cell text-center">
<a href="{{ route('users.profile', $message->sender->username) }}"><div class="message-avatar" style="background:url({{ $message->sender->headshot() }});background-size:cover;"></div></a>
                  
    <a href="{{ route('users.profile', $message->sender->username) }}">{{ $message->sender->username }}</a>
				</div>
				<div class="large-10 cell">
					<div class="grid-x grid-align-x align-middle">
						<div class="auto cell">
							<div class="message-title">{{ $message->title }}</div>
						</div>
						<div class="shrink cell right">              
                  @if($message->sender->id == Auth::user()->id)
                  @else        
                        <a href="#" class="button button-blue" style="display:inline-block;" onclick="showReply()">Reply</a>
                  @endif       
<form action="" method="POST" style="display:inline;">
									<button name="report_message" class="report-abuse report-abuse-inline"></button>
								</form>                  
                  </div>
					</div>
					<div class="message-time">@if($message->sender->id == Auth::user()->id) Sent @else Received @endif on {{ $message->created_at->format('M d, Y h:i A') }}</div>
					<div class="message-divider"></div>
					<div class="message-body">
						{!! nl2br(e($message->body)) !!}
					</div>
				</div>
			</div>
		</div>
@if($message->sender->id == Auth::user()->id)
                  @else 
<div id="replyModule" style="display:none;">
				<div class="push-25"></div>
				<div class="container border-r md-padding">
					<h5>Write a reply</h5>
					<div class="push-15"></div>
					<a name="reply"></a>
                  <form action="{{ route('account.inbox.create', ['type' => 'reply']) }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $message->id }}">
                    <input type="hidden" name="type" value="reply">
						<textarea name="body" class="normal-input message-reply" placeholder="Enter your message here." required></textarea>
						<input type="submit" value="Send Reply" class="button button-blue">
					</form>
				</div>
			</div>
			<script>
				function showReply() {
					document.getElementById("replyModule").style.display = "block";
				}
			</script>
@endif
@endsection
