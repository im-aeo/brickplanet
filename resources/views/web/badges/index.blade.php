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
    'title' => 'Badges'
])

@section('js')
    <script>
        function info(name, description, image)
        {
            $('#badge #badgeName').text(name);
            $('#badge #badgeDescription').text(description);
            $('#badge #badgeImage').attr('src', image);

            $('#badge').modal('show');
        }
    </script>
@endsection
@section('css')
		<style>
			.achievement-special {
				color: gold!important;
			}
			.achievement-text-small {
				font-size: 13px!important;
			}
		</style>
@endsection
@section('content')
<h3>Achievements</h3>
@forelse ($categories as $category)
    <h5>{{ $category['name'] }}</h5>
	<div class="container border-r md-padding">
		<div class="grid-x grid-margin-x align-middle">
       
                @forelse ($badges[$category['name']] as $award)
                    <div class="large-2 cell achievement-container text-center">
                        
                           <div class="achievement-image" style="background-image:url('img/badges/{{$award['image']}}.png')"></div>
                            	<div class="achievement-title">
                                            
                                            {{ $award['name'] }}
                     </div>
                          <div class="achievement-info">
                            <div class="achievement-title @if($category['special_text'] == true) achievement-special @endif">
                            {{ $award['name'] }}
                           @if($category['special_text'] == true) <br /><font class='achievement-text-small'>(special)</font> @endif
                            </div>
                    <div class="achievement-border"></div>
					<div class="achievement-description">
						<div class="padding-desc">
                        {{ $award['description'] }}
						</div>
					</div>
				</div>
			</div>
                @empty
There are currently no badges.
                @endforelse
            </div>
          </div>
<div class="push-25"></div>
@empty
No achievements have been added to this category. Check back later!
@endforelse

@endsection
