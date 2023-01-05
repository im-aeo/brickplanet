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
<?php
    function thumbFix($link){
        return str_replace("https://cdn.detrimo.com/", "https://cdn.detrimo.com/thumbnails/", $link);
    }
?>

@extends('layouts.default', [
    'title' => $item->name,
    'image' => $item->thumbnail()
])

@section('meta')
    <meta
        name="item-info"
        data-id="{{ $item->id }}"

        @if ($item->has3dView())
            data-model="{{ config('site.storage_url') }}/uploads/{{ $item->filename }}.obj"
            data-texture="{{ config('site.storage_url') }}/uploads/{{ $item->filename }}.png"
        @endif

        @if ($item->isTimed())
            data-onsale-until="{{ $item->onsale_until->format('Y-m-d H:i') }}"
        @endif
    >
@endsection


@section('js')
 @if ($item->has3dView())
        <script src="{{ asset('js/vendor/three.min.js') }}"></script>
        <script src="{{ asset('js/vendor/three.orbitcontrols.min.js') }}"></script>
        <script src="{{ asset('js/vendor/three.obj_loader.min.js') }}"></script>
        <script src="{{ asset('js/3d_view.js') }}"></script>
    @endif

    @if ($item->isTimed())
        <script src="{{ asset('js/vendor/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('js/vendor/moment.min.js') }}"></script>
        <script src="{{ asset('js/vendor/moment.timezone.min.js') }}"></script>
        <script src="{{ asset('js/timed_item.js') }}"></script>
    @endif

    @if ($item->type == 'crate')
        <script src="{{ asset('js/vendor/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/crate.js?v=2') }}"></script>
    @endif
@endsection

@section('content')
    @if (!$item->public_view)
        <div class="alert bg-warning"><i class="fas fa-exclamation-triangle"></i> This item is not public.</div>
    @endif


	<div class="container lg-padding border-r">
		<div class="grid-x grid-margin-x">
			<div class="large-8 medium-8 small-6 cell">
				<div class="store-item-card relative">
                  <img class="item-image" id="thumbnail" src="{{ $item->thumbnail() }}">
                  
                   @if ($item->has3dView())
                        <div class="show-sm-only" style="margin-top:-15px;"></div>
                        <button class="button button success" id="3dButton" style="margin-top:-75px;margin-left:5px;">Toggle 3D</button>
                         <button class="button button success" id="2dButton" style="margin-top:-75px;margin-left:5px;">Toggle Thumbnail</button>
                        <div id="canvas"></div>
                    @endif
					
						<form action="" method="POST">
							<button class="report-abuse report-abuse-item" name="report_item"></button>
						</form>
						
				</div>
					<div class="grid-x grid-margin-x">
						<div class="large-3 medium-3 small-6 cell text-center">
							<div class="item-info-content">{{ $item->created_at->format('M d, Y') }}</div>
							<div class="item-info-title">CREATED</div>
							<div class="push-15"></div>
						</div>
						<div class="large-3 medium-3 small-6 cell text-center">
							<div class="item-info-content">{{ $item->updated_at->format('M d, Y') }}</div>
							<div class="item-info-title">UPDATED</div>
							<div class="push-15"></div>
						</div>
						<div class="large-3 medium-3 small-6 cell text-center">
							<div class="item-info-content">{{ number_format($item->owners()->count()) }}</div>
							<div class="item-info-title">OWNERS</div>
							<div class="push-15"></div>
						</div>
						<div class="large-3 medium-3 small-6 cell text-center">
							<div class="item-info-content">0</div>
							<div class="item-info-title">FAVORITES</div>
							<div class="push-15"></div>
						</div>
					</div>
			</div>
			<div class="large-4 medium-4 small-6 cell">
				<div class="grid-x align-middle grid-margin-x">
					<div class="auto cell no-margin">
						<div class="item-name">
							<span>{{ $item->name }}</span>
							
								<span><a href="/store/edit/" class="item-edit" title="Edit item"><i class="material-icons">border_color</i></a></span>
								
						</div>
					</div>
					<div class="shrink cell right no-margin">
						
								<button type="submit" name="favorite" title="Favorite item" class="item-star"><i class="material-icons">star_bordered</i></button>
								
					</div>
				</div>
				<div class="item-divider"></div>
				<div class="item-category">
					{{ $item->type }} @if ($item->limited)<strong>COLLECTIBLE,&nbsp;{{ ($item->stock > 0) ? "{$item->stock} LEFT" : 'SOLD OUT' }}</strong>@endif
				</div>
						<div class="grid-x grid-margin align-middle item-price">
					<div class="shrink cell">
                         <img src="/img/bits-sm.png">
							</div>
							<div class="shrink cell">
								<span>{{ number_format($item->price) }} Bits</span>
							</div>
                          
						</div>
						
						<input type="button" class="item-buy-button" value="Buy Now" data-open="BuyNowModal">
						<div class="reveal item-modal" id="BuyNowModal" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
                          
                         @if (Auth::check() && Auth::user()->ownsItem($item->id))
                         <div class="grid-x grid-margin-x align-middle">
								<div class="auto cell no-margin">
									<div class="modal-title">It looks like this item is already in your backpack.</div>
								</div>
								<div class="shrink cell no-margin">
									<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
							</div> 
                          @endif
                          
                        @if (Auth::check() && !Auth::user()->ownsItem($item->id))
                        @if(Auth::user()->currency < $item->price)
                           <div class="grid-x grid-margin-x align-middle">
								<div class="auto cell no-margin">
									<div class="modal-title">You dont have enough to make this purchase.</div>
								</div>
								<div class="shrink cell no-margin">
									<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
							</div> 
                          @else
						<!--<font class='coins-text'>You Are Purchasing {{ $item->name }} {{ ucfirst($item->type) }} For {{ $item->price }} Bits.</font> !-->
							<form action="{{ route('catalog.purchase') }}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $item->id }}">
								<div class="grid-x grid-margin-x align-middle">
									<div class="auto cell no-margin">
										<div class="modal-title">Are you sure you would like to make this purchase?</div>
									</div>
									<div class="shrink cell no-margin">
										<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
								</div>
								<p>Are you sure you would like to buy <a href="'.$serverName.'/store/view/'.$gI->ID.'/">{{ $item->name }}</a> from <a href="'.$serverName.'/users/'.$gI->Username.'/">{{ $item->creatorName() }}</a> for {{ $item->price }} Bits? Your balance after this transaction will be <font class="coins-text">{{ number_format(Auth::user()->currency - $item->price) }} Bits</font> and will not be able to be refunded.</p>
								<div align="center" style="margin-top:15px;">
									<input type="submit" class="button button-green store-button inline-block" name="ConfirmYes" value="Yes, purchase item">
									<input type="hidden" name="Payment" value="bits">
									<input type="button" data-close class="button button-grey store-button inline-block" value="No, cancel">
								</div>
							</form>
                           @endif
                           @if (!Auth::check())
                          <div class="grid-x grid-margin-x align-middle">
								<div class="auto cell no-margin">
									<div class="modal-title">You need to login to make this purchase.</div>
								</div>
								<div class="shrink cell no-margin">
									<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
							</div> 
							@endif
                          @endif
						</div>
						
				<div class="view-item-right-creator-parent">
					<div class="grid-x grid-margin-x">
						<div class="large-12 cell text-center">
						
							<a href="{{ $item->creatorUrl() }}">
								<div class="view-item-right-creator-avatar" style="background-image:url({{ $item->creatorImage() }});"></div>
							</a>
							
							<a href="{{ $item->creatorUrl() }}"><div class="view-item-right-creator-name">{{ $item->creatorName() }}</div></a>
							
						</div>
					</div>
				</div>
				<div class="item-divider"></div>
				
				<div class="item-description">DESCRIPTION</div>
				<div class="view-item-right-description">
					{!! (!empty($item->description)) ? nl2br(e($item->description)) : '<div class="text-muted">This item does not have a description.</div>' !!}
				</div>
			</div>
		</div>
	</div>                  
@endsection
