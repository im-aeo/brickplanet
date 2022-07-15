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

@extends('layouts.default', [
    'title' => 'Users'
])

@section('css')
    <style>
        img.headshot {
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        @media only screen and (min-width: 768px) {
            img.headshot {
                width: 60px;
            }
        }

        .user {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .user:not(:last-child) {
            border-bottom: 1px solid var(--divider_color);
        }
    </style>
@endsection

@section('content')
<div class="grid-x grid-margin-x align-middle">
		<div class="auto cell no-margin">
			<h4>Users</h4>
		</div>
	</div>
<div class="shrink cell right no-margin">

	<div class="push-15"></div>
	<div class="container md-padding border-r">
      @forelse ($users as $user)
      <div class="grid-x grid-margin-x group-table">
					<div class="large-2 medium-3 small-4 cell center-text">
                        <a href="{{ route('users.profile', $user->username) }}" class="gt-link">
                                <img src="{{ $user->thumbnail() }}">
                      </a>
        </div>
        
                                <div class="data">
                                    <div class="ellipsis">
                                        <strong><a href="{{ route('users.profile', $user->username) }}" class="black-text">{{ $user->username }}</a></strong>
                                        &nbsp; <span class="profile-{{ ($user->online()) ? 'online' : 'offline' }}">{{ ($user->online()) ? 'ONLINE' : 'OFFLINE' }}</span>
                                    </div>
                                    <span class="ellipsis">{!! Str::limit($user->description) !!}</span>
                                </div>
                            </div>
      
<div class="group-divider"></div>                 
                  @empty
                        <div class="grid-x grid-margin-x"><div class="auto cell">
                            <span>No users found.</span>
                          </div></div>
                    @endforelse
                    {{ $users->onEachSide(1)->links('vendor.pagination.aeo') }}
    </div>
@endsection
