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
    'title' => 'Sets'
])

@section('content')
    <div class="col-10-12 push-1-12">
        <div class="large-text mb1">
            <span>My Sets</span>
            <a href="{{ route('games.create') }}" class="button blue push-right small-text">CREATE SET</a>
        </div>
        @forelse ($games as $game)
            <div class="col-1-4 mobile-col-1-3 set">
                <div class="card ellipsis">
                    <div class="thumbnail no-padding">
                        <a href="{{ route('games.view', $game->id) }}">
                            <img class="round-top" src="{{ $game->thumbnail() }}">
                        </a>
                    </div>
                    <div class="content">
                        <div class="name game-name ellipsis">
                            <a href="{{ route('games.view', $game->id) }}">{{ $game->name }}</a>
                        </div>
                        <div class="creator ellipsis">By <a href="{{ route('users.profile', $game->creator->id) }}">{{ $game->creator->username }}</a></div>
                    </div>
                    <div class="footer">
                        <div class="playing">{{ $game->playing }} Playing</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="center-text">
                <div class="medium-text mb2">You don't have any sets</div>
                <a href="{{ route('games.create') }}" class="button blue">CREATE SET</a>
            </div>
        @endforelse
    </div>
@endsection
