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
    'title' => 'Friend Requests'
])

@section('content')
<div class="container lg-padding border-r">
		<div class="grid-x grid-margin-x align-middle">
			<div class="auto cell">
    <h4>Friend Requests ({{ number_format($friendRequests->count()) }})</h4>
    </div>
			<div class="shrink cell right text-right">
              <a href="#" class="button button-green">Accept All</a>
          </div>
		</div>
		<div class="push-25"></div>
		<div class="grid-x grid-margin-x">
          
                @forelse ($friendRequests as $friendRequest)
                    <div class="large-3 medium-3 small-3 cell text-center friend-card">
                            <a href="{{ route('users.profile', $friendRequest->sender->username) }}">
                                <img src="{{ $friendRequest->sender->thumbnail() }}">
                                
                            </a>
                      <a href="{{ route('users.profile', $friendRequest->sender->username) }}">
					{{ $friendRequest->sender->username }}
				</a>
                      <div class="push-10"></div>
				<div class="grid-x grid-margin-x align-middle">
					<div class="large-auto medium-auto small-12 cell">
                            <form action="{{ route('account.friends.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $friendRequest->sender->id }}">
                               
                                        <input type="submit" name="action" value="Accept" class="button button-green">
                                    </form>
					</div>
                  <div class="large-auto medium-auto small-12 cell">
                                    <form action="{{ route('account.friends.update') }}" method="POST">
                                      @csrf
                                <input type="hidden" name="id" value="{{ $friendRequest->sender->id }}">
                                      
                                        <input type="submit" name="action" value="Decline" class="button button-red">
                                    </form>
					</div>
				</div>
			</div>
                @empty
        
			You have no pending friend requests at this time.
		
                @endforelse
            </div>
    {{ $friendRequests->onEachSide(1) }}
@endsection
