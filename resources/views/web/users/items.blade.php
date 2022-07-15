@extends('layouts.default', [
    'title' => "$user->username's Backpack"
])
@section('meta')
    <meta name="item-types-with-padding" content="{{ json_encode(config('site.item_thumbnails_with_padding')) }}">
    <meta name="item-type-padding-amount" content="{{ itemTypePadding('default') }}">
    <meta name="user-info" data-id="{{ $user->id }}" data-inventory-public="{{ $user->setting->public_inventory }}">
@endsection

@section('js')
    <script src="{{ asset('js/profile.js?v=4') }}"></script>
@endsection

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
			<h4>{{ $user->username }}'s Backpack</h4>
		</div>
      <div class="shrink cell right no-margin">
        
      </div>
</div>
<div class="push-10"></div>
<div class="container border-r md-padding">
	<div class="grid-x grid-margin-x">
			<div class="large-2 cell no-margin">
                            <ul class="user-backpack-side-menu" role="tablist">
                              @foreach (config('site.inventory_item_types') as $type)
                                <li class="@if ($type == 'hat') active @endif" data-category="{{ lcfirst(itemType($type, true)) }}">{{ itemType($type, true) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="large-10 cell no-margin">
                          
                            <div class="grid-x grid-margin-x clearfix" id="inventory"></div>
                          </div>
			</div>
		</div>
	</div>
@endsection