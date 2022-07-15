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
    'title' => 'Forum'
])

@section('css')
    <style>
        .topic {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .topic:not(:last-child) {
            border-bottom: 1px solid var(--divider_color);
        }

        .topic:hover {
            background: var(--section_bg_hover);
        }
    </style>
@endsection

@section('content')
@include('web.forum._header')
            @if ($topics->count() == 0)
                <span>There are currently no forum topics.</span>
            @else
                <div class="content">
                    @foreach ($topics as $topic)
                    <div class="topic-divider"></div>
                  <div class="grid-x grid-margin-x align-middle forum-topic">
					<div class="large-7 medium-8 small-8 cell">
                                <div class="topic-title"><a href="{{ route('forum.topic', [$topic->id, $topic->slug()]) }}">{{ $topic->name }}</a></div>
                                <div class="topic-description">{{ $topic->description }}</div>
                            </div>
                                <div class="large-1 medium-2 small-2 cell text-center">
                                    {{ number_format($topic->threads(false)->count()) }}
                                </div>
                                <div class="large-1 medium-2 small-2 cell text-center">
                                    {{ number_format(0) }}
                                </div>
                                <div class="large-3 cell text-right show-for-large">
                                    @if ($topic->lastPost())
                                        <a href="{{ route('forum.thread', $topic->lastPost()->id) }}">{{ $topic->lastPost()->title }}</a>
                                        <div style="font-size:13px;padding-top:2px;">{{ $topic->lastPost()->updated_at->diffForHumans() }}</div>
                                                                    @else
                                  <div style="font-size:13px;padding-top:2px;">N/A</div>
                                                                      @endif
                                
                                  
                    </div>
                    </div>
                    @endforeach
                        </div>       
                </div>
            @endif
        </div>
        </div>
@endsection
