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
    'title' => 'Play'
])

@section('content')
    <div class="grid-x grid-margin-x">
		<div class="auto cell">
			<h3>Games - {{$games->count()}} Servers Online</h3>
		</div>
	</div>
	<div class="push-15"></div>
	<div class="grid-x grid-margin-x">
        @forelse ($games as $game)
      <div class="large-3 cell">
                   <a href="{{ route('games.view', $game->id) }}">
                            <div style="width:100%;height:250px;background-image:url({{ $game->thumbnail() }});background-size:cover;background-color:#17171C;" class="relative">
                              <div class="user-game-ingame"><span>{{ $game->playing }} In Game</span></div>
                     </div>
                        </a>
             <div class="container sm-padding">
				<div class="grid-x grid-margin-x align-middle">
					<div class="shrink cell no-margin">
                      <a href="{{ route('users.profile', $game->creator->id) }}">
                        <div class="user-game-user-thumbnail relative" style="background-image:url({ $game->creator->headshot() }});"></div>
                      </a>
                  </div>
                    <div class="auto cell no-margin">
						<div class="user-game-info">
							<a href="{{ route('games.view', $game->id) }}" class="ug-info-title">{{$game->name}}</a>
							<div class="ug-info-creator">By <a href="{{ route('users.profile', $game->creator->id) }}">{{ $game->creator->username }}</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="push-25"></div><div class="push-10"></div>
		</div>
        @empty
            <div class="text-center bold">There are no servers currently online :(</div>
        @endforelse
    </div>
    <div class="col-1-1 pages blue">{{ $games->onEachSide(1) }}</div>
@endsection
