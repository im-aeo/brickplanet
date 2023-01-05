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

@section('content')
<div class="grid-x grid-margin-x align-middle">
		<div class="auto cell no-margin">
			<h4>Users</h4>
		</div>
</div>
	<div class="push-15"></div>
	<div class="container md-padding border-r">
      @forelse ($users as $user)
      <div class="grid-x grid-margin-x group-table">
					<div class="large-2 medium-3 small-4 cell center-text">
                        <a href="{{ route('users.profile', $user->username) }}" class="gt-link">
                                <img src="{{ $user->thumbnail() }}">
                      </a>
        </div>
					<div class="large-10 medium-9 small-8 cell">
						<div class="gt-title">
        
                                        <a href="{{ route('users.profile', $user->username) }}"><span>{{ $user->username }}</span></a>&nbsp;<span class="profile-{{ ($user->online()) ? 'online' : 'offline' }}">{{ ($user->online()) ? 'ONLINE' : 'OFFLINE' }}</span>
                      </div>
                                    
                                    <div class="gt-description">{{ $user->description ?? 'This user does not have a description.' }}</div>
                                </div>
                            </div>

  
<div class="group-divider"></div>                 
                  @empty
                        <div class="grid-x grid-margin-x"><div class="auto cell">No results found. Try refining your search.</div></div>
                    @endforelse
                    {{ $users->onEachSide(1)->links('vendor.pagination.aeo') }}
   
</div>
@endsection