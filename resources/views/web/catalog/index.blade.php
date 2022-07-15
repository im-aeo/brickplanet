@extends('layouts.default', [
    'title' => 'Store - Buy Items!'
])

@section('meta')
    <meta name="item-types-with-padding" content="{{ json_encode(config('site.item_thumbnails_with_padding')) }}">
    <meta name="item-type-padding-amount" content="{{ itemTypePadding('default') }}">
@endsection

@section('js')
    <script src="{{ asset('js/catalog.js?v=9') }}"></script>
@endsection

@section('content')
<div class="store-topbar">
		<div class="grid-x align-middle grid-margin-x">
			<div class="auto cell no-margin">
				<ul>
                  @foreach (config('site.catalog_item_types') as $type)
                    <li id="{{ lcfirst(itemType($type, true)) }}" class="@if ($type == 'hat') active @endif" data-category="{{ lcfirst(itemType($type, true)) }}">{{ itemType($type, true) }}
                    </li>
                @endforeach
                  
					
				</ul>
			</div>
		</div>
	</div>
<div class="container border-wh">
  
<div class="grid-x grid-margin-x" id="items-div"></div>
  </div><div class="push-25"></div></div>

@endsection
