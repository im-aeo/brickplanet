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

@section('js')
    @if (!$isGroup)
        <script src="{{ asset('js/creator_area.js') }}"></script>
    @endif
@endsection

@section('content')
    @if ($isGroup)
        @if (Auth::user()->reachedGroupLimit())
            <div class="error-message">You have reached the limit of groups you can be apart of.</div>
        @endif
    @endif
    <div class="grid-x grid-margin-x">
		<div class="large-8 large-offset-2 cell">
				
			<h4>{{ $title }}</h4>
			<div class="container border-r md-padding">
                
                    <form action="{{ route('creator_area.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($isGroup)
                            <input type="hidden" name="is_group" value="true">
                            <label for="name">Name</label>
                            <input class="normal-input" type="text" name="name" placeholder="Group Name" required>
                      <div class="push-15"></div>
                            <label for="description">Description</label>
                            <textarea class="normal-input" name="description" placeholder="Group Description" rows="5"></textarea>
                      <div class="push-15"></div>
                            <label for="template">Logo</label>
                            <input name="template" type="file">
                            <div class="push-15"></div>
                        @else
                            @if ($groupId)
                                <input type="hidden" name="group_id" value="{{ $groupId }}">
                            @endif

                            <label for="name">Name</label>
                            <input class="normal-input" type="text" name="name" placeholder="Item Name" required>
                            <label for="description">Description</label>
                            <textarea class="normal-input" name="description" placeholder="Item Description" rows="5"></textarea>
                            <label for="type">Type</label>
                            <select class="normal-input" name="type">
                                <option value="shirt">Shirt</option>
                                <option value="pants">Pants</option>
                            </select>
                            <label for="price">Price</label>
                            <input class="normal-input" type="number" name="price" placeholder="Item Price" min="0" max="1000000">
                            <div class="checkbox">
                                <input class="form-check-input" type="checkbox" name="onsale">
                                <label class="form-check-label" for="onsale">For Sale</label>
                            </div>
                            <label for="template">Template (<a href="{{ asset('img/template.png') }}" target="_blank">Download</a>)</label><br>
                            <input class="mb-3" name="template" type="file">
                        @endif

                        <button class="button button-green" type="submit">{!! (!$isGroup) ? 'Create' : "Create for <img src='img/bits-sm.png' /> {$price}" !!}</button>
                    </form>
                </div>
            </div>
        </div>
        @if (!$isGroup && config('site.renderer.previews_enabled'))
            <div class="col-md-6">
                <h3>Preview</h3>
                <div class="card text-center">
                    <div class="card-body">
                        <img id="preview" src="{{ config('site.storage_url') }}/{{ config('site.renderer.default_filename') }}.png">
                        <div class="text-danger mt-2" id="error" style="display:none;"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
