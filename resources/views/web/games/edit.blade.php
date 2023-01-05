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
    'title' => 'Edit Game'
])

@section('content')
<div class="grid-x grid-margin-x align-middle">
		<div class="auto cell no-margin">
			<h4>Edit {{ $game->name }}</h4>
		</div>
		<div class="shrink cell no-margin right">
			<a href="{{ route('games.index', $game->id) }}" class="button button-grey" style="padding: 8px 15px;font-size:13px;line-height:1.25;">Return to Game</a>
		</div>
	</div>
	<div class="push-15"></div>
   <div class="container border-r md-padding">
   <form action="{{ route('games.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $game->id }}">
                        <label for="name"><strong>Name</strong></label>
                        <input maxlength="64" type="text" name="name" class="normal-input" placeholder="My Game" value="{{ $game->name }}" required>
                        <div class="push-25"></div>
                        <label for="description"><strong>Description</strong></label>
                        <textarea maxlength="1024" name="description" class="normal-input" name="description" placeholder="Have fun!" rows="4">{{ $game->description }}</textarea>
                        <div class="push-25"></div>
                            <label for="thumbnail"><strong>Thumbnail</strong></label>
                            @if (!$game->is_thumbnail_pending)
                                <input style="background:transparent;border:0;padding:0;" name="thumbnail" type="file">
                            @else
                                <input class="width-100 block" style="background:transparent;border:0;padding:0;" type="text" value="Thumbnail is currently pending." readonly disabled>
                            @endif
                      <div class="push-25"></div>
                      <input type="submit" name="submit" value="Update" class="button button-blue">
                    </form>
                </div>
@endsection
