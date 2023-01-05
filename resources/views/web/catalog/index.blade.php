@extends('layouts.default', [
    'title' => 'Store'
])

@section('meta')
    <meta name="item-types-with-padding" content="{{ json_encode(config('site.item_thumbnails_with_padding')) }}">
    <meta name="item-type-padding-amount" content="{{ itemTypePadding('default') }}">
@endsection

@section('css')
<style>
  .text-md-padding {
    padding: 15px;
    font-size: 15px;
  }
</style>
@endsection

@section('content')
<div class="error-message">
			<span><i class="material-icons" style="vertical-align:middle;margin-right:5px;font-size:20px;">report_problem</i></span><span><strong>Oops!</strong> Store purchases are currently down. We will have them back up soon!</span>
		</div>

<div class="grid-x grid-margin-x">
		<div class="auto cell no-margin">
			<h4>Store</h4>
		</div>
		<div class="shrink cell right no-margin">
        @if (Auth::check())
           
                <a href="{{ route('creator_area.index') }}"><button class="button button-green">
                  Create
                  </button></a>
        @endif
    </div>
</div>
<div class="store-topbar">
		<div class="grid-x align-middle grid-margin-x">
			<div class="auto cell no-margin">
				<ul>
                  <a href="{{ route('catalog.index', 'recent') }}">
					<li id="recent" data-category="recent" class="active">RECENT</li>
                  </a>
                   @foreach (config('site.catalog_item_types') as $type)
                  <a href="{{ route('catalog.index', $type) }}">
					<li id="{{ lcfirst(itemType($type, true)) }}" data-category="{{ lcfirst(itemType($type, true)) }}" onclick="switchCategory(\'{{ $type }}\')" class="@if ($type == 'home') active @endif">{{ Str::upper($type) }}</li>
                  </a>
                  @endforeach
				</ul>
			</div>
		</div>
	</div>

<div class="container border-wh">
  <div class="grid-x grid-margin-x">
   @forelse ($items as $item)
            <div class="large-custom-2-4 medium-4 small-6 cell">
				<div class="border-r store-item-card">
					<div class="card-image" style="position:relative;">
                      
                      <div class="official-item-parent">
                        <div class="official-item-image" title="Official item sold by {{ config('site.name') }}"></div>
                      </div>
                        <a href="{{ route('catalog.item', [$item->id, $item->slug()]) }}"><img src="{{ $item->thumbnail() }}"></a>
                       </div>
					<div class="card-divider"></div>
					<div class="card-body">
						<div class="grid-x grid-margin-x">
							<div class="auto cell"> 
                                <div class="card-item-name"><a href="{{ route('catalog.item', [$item->id, $item->slug()]) }}">{{ $item->name }}</a></div>
                                </div>
						</div>
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell text-left">
								<div class="card-item-creator">
                                           <a href="{{ $item->creatorUrl() }}">{{ $item->creatorName() }}</a>
                              </div>
                           </div>
							<div class="shrink cell text-right">
                               @if ($item->onsale() && $item->price == 0)
                                               <div class="card-item-price"><font class="coins-text">Free</font></div>
                                            @elseif (!$item->onsale())
                                                 <div class="card-item-price"><font style="color: red;" class="coins-text">Offsale</font></div>
                                            @else
                                                <div class="card-item-price"><img src="{{ asset('img/bits-sm.png') }}"> {{ number_format($item->price) }}</div>
                                            @endif
                              
                                            @if ($item->limited)
                                                <div class="bg-primary text-white text-center" style="border-radius:50%;width:30px;height:30px;position:absolute;margin-left:5px;margin-top:5px;">
                                                    <span style="font-size:20px;font-weight:600;margin-top:7px;">C</span>
                                                </div>
                                            @elseif ($item->isTimed())
                                                <div class="bg-danger text-white text-center" style="border-radius:50%;width:30px;height:30px;position:absolute;margin-left:5px;margin-top:5px;">
                                                    <span style="font-size:17px;font-weight:600;"><i class="fas fa-clock" style="margin-top:6.5px;"></i></span>
                                                </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                  </div>
                        @empty
        <div class="text-md-padding">
		No results found. Try refining your search.
		</div>
                        @endforelse
 </div><div class="push-25"></div></div>                               
@endsection
