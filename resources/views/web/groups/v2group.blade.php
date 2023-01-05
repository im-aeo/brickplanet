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
		
<div class="grid-x grid-margin-x">
<div class="grid-container site-container-margin">

<div class="grid-x grid-margin-x align-middle">
<div class="large-auto cell">
<input type="text" class="normal-input" id="searchQuery">
<div class="push-15"></div>
</div>
<div class="large-shrink small-12 cell">
<select class="normal-input" id="searchCategory">
<option value="0">All Types</option>
<option value="1">Group</option>
<option value="2">Game Studio</option>
<option value="3">Clothing</option>
<option value="4">Roleplay</option>
<option value="5">Trading</option>
</select>
<div class="push-15"></div>
</div>
<div class="large-shrink small-6 cell">
<input type="submit" class="button button-blue" value="Search">
<div class="push-15"></div>
</div>
@if (Auth::check())  
<div class="large-shrink small-6 cell text-right">
<a class="button button-green" href="{{ route('creator_area.index', ['t' => 'group']) }}" style="display:inline">Create a Group</a>
<div class="push-15"></div>
</div>
@endif  
</div>
<div class="grid-x grid-margin-x">
      @forelse ($groups as $group)
 <div class="large-3 medium-3 small-12 cell">
 <div class="push-50"></div>
 <div class="push-50"></div>
 <div class="relative">
     <a href="#" class="communityNoClr">
         <div class="communityLogoEmblem" style="background-image:url({{ $group->thumbnail() }});background-size:cover;"></div>
     </a>

     <div class="container border-r md-padding" style="height:195px;">
         <div class="push-25"></div>
         <div class="communityName">
             <a href="{{ route('groups.view', [$group->id, $group->slug()]) }}">{{ $group->name }}</a>
         @if($group->is_verified == 1)
        <i class="material-icons item-creator-is-verified verified-sm has-tip" data-tooltip="a5o5qq-tooltip" aria-haspopup="true" data-disable-hover="false" title="This group is verified" aria-describedby="uvkv23-tooltip" data-yeti-box="uvkv23-tooltip" data-toggle="uvkv23-tooltip" data-resize="uvkv23-tooltip">verified</i>
         </div>
       @endif
         <div class="communityMembers">
             <strong>{{ shortNum($group->member_count) }}</strong> Members
         </div>
         <div class="communityDescription">{{ $group->description ?? 'This group does not have a description.' }}</div>
         
     </div>
     
 </div>
 </div>
                  @empty
                        <div class="grid-x grid-margin-x"><div class="auto cell">
                            <span>No Groups found.</span>
                          </div></div>
                    @endforelse
                    <div class="pages">{{ $groups->onEachSide(1) }}</div>
   
</div>

@endsection