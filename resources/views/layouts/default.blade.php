<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
	<head>
		<title>{{ isset($title) ? "{$title} - " . config('site.name') : config('site.name') }} </title>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Brick Planet is a user generated content sandbox game with tens of thousands of active players. Play today!">
		<meta name="keywords" value="brickplanet, brick planet, brick game, create game">
		<meta name="author" content="Brickplanet Inc.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{asset('css/foundation.css')}}">
		<link rel="stylesheet" href="{{asset('css/dark-style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
		 @yield('meta')
         @yield('css')
<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-78458167-1', 'auto');
		  ga('send', 'pageview');

		</script>
        @yield('fonts')
		<script src="{{ asset('js/jquery.js?v=2') }}"></script>
        <script src="{{ asset('js/main.js?v=2') }}"></script>
        <script src="{{ asset('js/foundation.js?v=2') }}"></script>
        <script src="{{ asset('js/search.js') }}"></script>		
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.css" integrity="sha512-DanfxWBasQtq+RtkNAEDTdX4Q6BPCJQ/kexi/RftcP0BcA4NIJPSi7i31Vl+Yl5OCfgZkdJmCqz+byTOIIRboQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.js" integrity="sha512-/CzcPLOqUndTJKlWJ+PkvFh2ETRtkrnxwmULr9LsUU+cFLl7TAOR5gwwD8DRLvtM4h5ke/GQknlqQbWuT9BKdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
<script>
NProgress.start();
NProgress.set(0.4);
//Increment 
var interval = setInterval(function() { NProgress.inc(); }, 1000);
$(document).ready(function(){
    NProgress.done();
    clearInterval(interval);
});
</script>
        @yield('js')
	</head>
	<body>
	<div class="site-wrap">
		<div class="top-bar">
			<div class="top-bar-left">
				<div class="grid-x align-middle grid-margin-x">
					<div class="shrink cell hide-for-large">
						<button class="menu-icon sidebar-menu-icon" type="button" data-toggle="side-bar"></button>
					</div>
					<div class="shrink cell menu-logo">
						<a href="{{ route('home.index') }}">
							<img src="{{ config('site.logo') }}" class="show-for-large">
							<img src="{{ config('site.icon') }}" class="hide-for-large" style="height:30px;">
						</a>
					</div>
					<div class="auto cell no-margin">
						<input type="text" class="menu-search" id="navbarSearch" placeholder="Search">
						<div class="search-dropdown-parent">
							<div id="search-dropdown" class="search-dropdown fast" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;">
								<div id="show-recent"></div>
								<div id="navbarSearchResults"></div>
							</div>
						</div>
					</div>
					<div class="shrink cell">
						<ul class="menu align-middle">
							 @guest
								<li class="menu-login show-for-medium">
									<div class="menu-log-in">
										<a href="{{ route('auth.login.index') }}">Log In</a>
									</div>
								</li>
								<li class="menu-createaccount show-for-medium">
									<div class="menu-create-account">
										<a href="{{ route('auth.register.index') }}">Create Account</a>
									</div>
								</li>
                      
								 @else
								<li class="menu-link show-for-medium">
									<a data-toggle="user-notifications">
										<span class="icon relative">
											<i class="material-icons">diversity_1</i>
											
											@if (Auth::user()->friendRequestCount() > 0)
											<div class="notification-badge badge-header" id="notifications-count">{{ shortNum(Auth::user()->friendRequestCount()) }}</div>
											@else 
											<div class="notification-badge badge-header" id="notifications-count" style="display:none;">0</div>
											@endif
										</span>
									</a>
								</li>
								<li class="menu-link">
									<a title="{{ number_format(Auth::user()->currency_credits) }} Credits" href="{{ route('account.money.index', '') }}">
										<span class="icon"><img src="{{ asset('img/credits-sm.png') }}" width="20"></span>
										<span class="show-for-medium">{{ number_format(Auth::user()->currency_credits) }}</span>
										<span class="show-for-small-only">{{ shortNum(Auth::user()->currency_credits) }}</span>
									</a>
								</li>
								<li class="menu-link">
									<a title="{{ number_format(Auth::user()->currency) }} Bits" href="'.$serverName.'/upgrade/bits">
										<span class="icon"><img src="{{ asset('img/bits-sm.png') }}" width="20"></span>
										<span class="show-for-medium">{{ number_format(Auth::user()->currency) }}</span>
										<span class="show-for-small-only">{{ shortNum(Auth::user()->currency) }}</span>
									</a>
								</li>
								<li class="menu-link avatar-preview">
									<a data-toggle="user-dropdown-all"><div class="menu-avatar-preview-thumbnail" style="background-image:url({{ Auth::user()->headshot() }});background-size:cover;"></div></a>
									</li>
                                  @endguest	
						</ul>
					</div>
				</div>
			</div>
		</div>
      
		@auth
			<!-- User Dropdown -->
			<div id="user-dropdown-all" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;" class="fast">
				<i class="material-icons user-dropdown-arrow">arrow_drop_up</i>
				<div class="user-dropdown" id="user-dropdown">
					<div class="dropdown-header">
						<div class="grid-x align-middle grid-margin-x">
							<div class="shrink cell no-margin">
								<div class="avatar-preview-thumbnail" style="background-image:url({{ Auth::user()->headshot() }});background-size:cover;"></div>
							</div>
							<div class="auto cell">
								<div class="dropdown-username"><a href="{{ route('users.profile', Auth::user()->username) }}">{{ Auth::user()->username }}</a></div>
							</div>
						</div>
					</div>
					<div class="dropdown-body">
						<ul>
							<li><a href="{{ route('users.profile', Auth::user()->username) }}">Profile</a></li>
							<li><a href="{{ route('account.character.index') }}">Character</a></li>
						</ul>
						<div class="ddivider"></div>
						<ul>
							<li><a href="{{ route('account.settings.index', '') }}">Settings</a></li>
							<li><a href="{{ route('auth.logout') }}">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
						<div id="user-notifications" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;" class="fast">
				<i class="material-icons user-notifications-arrow">arrow_drop_up</i>
				<div class="user-notifications">
					<div class="user-notifications-header">
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell no-margin">
								Friend Requests
							</div>
							<div class="shrink cell no-margin right">
								<a href="{{ route('account.friends.index') }}">See All</a>
							</div>
						</div>
					</div>
					<div class="user-chat-row-divider"></div>
					<div id="user-notifications-html">

							<div class="user-notifications-none">
								<i class="material-icons">face</i>
								<span>You have {{ number_format(Auth::user()->friendRequestCount()) }} Friend Requests.</span>
							</div>

					</div>
					<div class="push-5"></div>
				</div>
			</div>

      @endauth
      	

		
		<div class="top-bar-push"></div>
		<div class="grid-x grid-margin-x">
			<div class="sidebar-shrink shrink cell no-margin">
				<!-- Mobile / Tablet -->
				<div class="side-bar hide-for-large" id="side-bar" data-toggler data-animate="fade-in fade-out" style="display:none;">
					<div class="side-bar-inner">
						           <ul>
          @guest
                      <li><a href="{{ route('auth.login.index') }}"><i class="material-icons">person</i><span>Log In</span></a></li>
            <li><a href="{{ route('auth.register.index') }}"><i class="material-icons">person_add</i><span>Create Account</span></a></li>
          @endguest
          
			<li><a href="{{ route('games.index') }}"><i class="material-icons">games</i><span>Games</span></a></li>
           <li><a href="{{ route('catalog.index', 'recent') }}" class="{{ set_active(['catalog.*']) }}"><i class="material-icons">store</i><span>Store</span></a></li>
          
          			<li><a href="{{ route('groups.index') }}" class="{{ set_active(['groups.*']) }}"><i class="material-icons">flag</i><span>Groups</span></a></li>
          
            <li><a href="{{ route('users.index', '') }}"><i class="material-icons">people</i><span>Users</span></a></li>
          
		
			<li><a href="/forum/" class="{{ set_active(['forum.*']) }}"><i class="material-icons">forum</i><span>Forum</span></a></li>
          @auth
		  <br>
          <li><a href="#"><i class="material-icons">inbox</i><span>Inbox</span></a></li>
          
                    <li><a href="{{ route('account.money.index', '') }}" class="{{ set_active(['account.money.*']) }}"><i class="material-icons">wallet</i><span>Creator Area</span></a></li>
          <li><a href="{{ route('account.upgrade.index') }}" class="{{ set_active(['account.upgrade.*']) }}"><i class="material-icons">rocket_launch</i><span>Upgrades</span></a></li>
          @endauth
        @if (Auth::check() && Auth::user()->isStaff())
                                <li>
                                  <div class="sbdivider"></div>
                                    <a href="{{ route('admin.index') }}" target="_blank">
                                      <i class="material-icons">gavel</i>
                                      <span>Admin</span>
                                        @if (pendingAssetsCount() > 0 || pendingReportsCount() > 0)
                                            <span class="nav-notif">
                                                @if (pendingAssetsCount() > 0)
                                                    <span>(A: {{ number_format(pendingAssetsCount()) }})</span>
                                                @endif

                                                @if (pendingReportsCount() > 0)
                                                    <span>(R: {{ number_format(pendingReportsCount()) }})</span>
                                                @endif
                                            </span>
                                        @endif
                                    </a>
                                </li>
                            @endif
			
</ul>
                      
                    @auth
					<div class="sbdivider"></div>
                      <div class="sbtitle">FRIENDS</div>
                      
                      <ul>
                        @foreach(Auth::user()->navfriendlist() as $navfriends)
                        <li> 
                          <a href="{{ route('users.profile', $navfriends->username) }}" title="{{ $navfriends->username }}">  
                            <div class="user-avatar relative" style="background-image:url({{ $navfriends->headshot() }});background-size:cover;"> 
                              <span class="user-friend-activity-status" style="background:#{!! ($navfriends->online()) ? '56A902' : 'AAAAAA' !!};"></span> </div> {{ $navfriends->username }} </a>
                        </li>
                        @endforeach
                      </ul> 
                      <div class="sbdivider"></div>
                      <div class="sbtitle">GROUPS</div>
                      <ul>
                      @foreach(Auth::user()->navFavGroup() as $navfavgroup)
                        <li>
                          <a href="{{ route('groups.view', [$navfavgroup->id, $navfavgroup->slug()]) }}" title="{{ $navfavgroup->name }}">
                            <div class="user-avatar relative" style="background-image:url({{ $navfavgroup->thumbnail() }});background-size:cover;">
                              <i class="material-icons favorite-group-icon">star</i>
                            </div> 
                            <span>{{ $navfavgroup->name }}</span> 
                          </a> 
                      </li>
                      @endforeach  
                        @foreach(Auth::user()->navGrouplist() as $navgroups)
                        <li>
                          <a href="{{ route('groups.view', [$navgroups->id, $navgroups->slug()]) }}" title="{{ $navgroups->name }}">
                            <div class="user-avatar relative" style="background-image:url({{ $navgroups->thumbnail() }});background-size:cover;">
                            </div> 
                            <span>{{ $navgroups->name }}</span> 
                          </a> 
                      </li>
                      @endforeach  
                      </ul>
                      @endauth
					</div>
				</div>
				<!-- Desktop -->
				<div class="side-bar show-for-large" id="side-bar-desktop">
					<div class="side-bar-inner">
          <ul>
          
			<li><a href="{{ route('games.index') }}"><i class="material-icons">games</i><span>Games</span></a></li>
           <li><a href="{{ route('catalog.index', 'recent') }}" class="{{ set_active(['catalog.*']) }}"><i class="material-icons">store</i><span>Store</span></a></li>
          
          			<li><a href="{{ route('groups.index') }}" class="{{ set_active(['groups.*']) }}"><i class="material-icons">flag</i><span>Groups</span></a></li>
          
            <li><a href="{{ route('users.index', '') }}"><i class="material-icons">people</i><span>Users</span></a></li>
          
		
			<li><a href="/forum/" class="{{ set_active(['forum.*']) }}"><i class="material-icons">forum</i><span>Forum</span></a></li>
          @auth
		  <br>
          <li><a href="#"><i class="material-icons">inbox</i><span>Inbox</span></a></li>
          
                    <li><a href="{{ route('account.money.index', '') }}" class="{{ set_active(['account.money.*']) }}"><i class="material-icons">wallet</i><span>Creator Area</span></a></li>
          <li><a href="{{ route('account.upgrade.index') }}" class="{{ set_active(['account.upgrade.*']) }}"><i class="material-icons">rocket_launch</i><span>Upgrades</span></a></li>
          @endauth
        @if (Auth::check() && Auth::user()->isStaff())
                                <li>
                                  <div class="sbdivider"></div>
                                    <a href="{{ route('admin.index') }}" target="_blank">
                                      <i class="material-icons">gavel</i>
                                      <span>Admin</span>
                                        @if (pendingAssetsCount() > 0 || pendingReportsCount() > 0)
                                            <span class="nav-notif">
                                                @if (pendingAssetsCount() > 0)
                                                    <span>(A: {{ number_format(pendingAssetsCount()) }})</span>
                                                @endif

                                                @if (pendingReportsCount() > 0)
                                                    <span>(R: {{ number_format(pendingReportsCount()) }})</span>
                                                @endif
                                            </span>
                                        @endif
                                    </a>
                                </li>
                            @endif
			
</ul>
                      
                    @auth
					<div class="sbdivider"></div>
                      <div class="sbtitle">FRIENDS</div>
                      
                      <ul>
                        @foreach(Auth::user()->navfriendlist() as $navfriends)
                        <li> 
                          <a href="{{ route('users.profile', $navfriends->username) }}" title="{{ $navfriends->username }}">  
                            <div class="user-avatar relative" style="background-image:url({{ $navfriends->headshot() }});background-size:cover;"> 
                              <span class="user-friend-activity-status" style="background:#{!! ($navfriends->online()) ? '56A902' : 'AAAAAA' !!};"></span> </div> {{ $navfriends->username }} </a>
                        </li>
                        @endforeach
                      </ul> 
                      <div class="sbdivider"></div>
                      <div class="sbtitle">GROUPS</div>
                      <ul>
                      @foreach(Auth::user()->navFavGroup() as $navfavgroup)
                        <li>
                          <a href="{{ route('groups.view', [$navfavgroup->id, $navfavgroup->slug()]) }}" title="{{ $navfavgroup->name }}">
                            <div class="user-avatar relative" style="background-image:url({{ $navfavgroup->thumbnail() }});background-size:cover;">
                              <i class="material-icons favorite-group-icon">star</i>
                            </div> 
                            <span>{{ $navfavgroup->name }}</span> 
                          </a> 
                      </li>
                      @endforeach  
                        @foreach(Auth::user()->navGrouplist() as $navgroups)
                        <li>
                          <a href="{{ route('groups.view', [$navgroups->id, $navgroups->slug()]) }}" title="{{ $navgroups->name }}">
                            <div class="user-avatar relative" style="background-image:url({{ $navgroups->thumbnail() }});background-size:cover;">
                            </div> 
                            <span>{{ $navgroups->name }}</span> 
                          </a> 
                      </li>
                      @endforeach  
                      </ul>
                      @endauth
					</div>
				</div>
			</div>

				<div class="auto cell no-margin">
					<div class="grid-container site-container-margin">
					   @if (site_setting('alert_enabled') && site_setting('alert_message'))    
						<div style="background:{{ site_setting('alert_background_color') }};color:{{ site_setting('alert_text_color') }};" class="site-announcement">
							<div class="grid-x align-middle grid-margin-x">
								<div class="shrink cell">
									<i class="material-icons">error_outline</i>
								</div>
								<div class="auto cell">
									{{ site_setting('alert_message') }}
								</div>
								<div class="shrink cell right">
									<i class="material-icons">error_outline</i>
								</div>
							</div>
						</div>
                        @else
                      <div class="main-site-push"></div>
                        @endif
        @if (site_setting('maintenance_enabled'))
            <div class="error-message text-center">
                You are currently in maintenance mode. <a href="{{ route('maintenance.exit') }}" class="text-white" style="font-weight:600;">[Exit]</a>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    {!! $error !!}
                @endforeach
            </div>
        @endif

        @if (session()->has('success_message'))
            <div class="alert bg-success text-white">
                {!! session()->get('success_message') !!}
            </div>
        @endif

        @if (!site_setting('catalog_purchases_enabled') && Str::startsWith(request()->route()->getName(), 'catalog.'))
            <div class="alert bg-warning text-center text-white" style="font-weight:600;">
                Market purchases are temporarily unavailable. Items may be browsed but are unable to be purchased.
            </div>
        @endif
                        @yield('content')
                 </div>
					</div>
				</div>
			</div>
			<div class="site-footer">
				<div class="grid-x grid-margin-x">
					
							<div class="sidebar-shrink shrink cell no-margin">
								&nbsp;
							</div>
							
					<div class="auto cell no-margin">
						<div class="grid-container">
							<div class="grid-x grid-margin-x">
								<div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
									<div class="footer-title">NAVIGATE</div>
									<ul class="footer-links">
										<li><a href="{{ route('home.index') }}">Home</a></li>
										<li><a href="{{ route('catalog.index', 'hat') }}">Store</a></li>
										<li><a href="{{ route('forum.index') }}">Forum</a></li>
										<li><a href="{{ route('account.upgrade.index') }}">Upgrade</a></li>
									</ul>
								</div>
								<div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-2 cell">
									<div class="footer-title">ABOUT</div>
									<ul class="footer-links">
										<li><a href="/info/terms/">Terms of Service</a></li>
										<li><a href="/info/privacy/">Privacy Policy</a></li>
										<li><a href="https://jobs.avatoria.com/about-us/">About Us</a></li>
										<li><a href="https://blog.avatoria.com" target="_blank">Blog</a></li>
									</ul>
								</div>
								<div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
									<div class="footer-title">SUPPORT</div>
									<ul class="footer-links">
										<li><a href="/info/staff">Contact Us</a></li>
										<li><a href="https://support.{{config('site.name')}}.com/" target="_blank">Help Center</a></li>
										<li><a href="#">Legal</a></li>
										<li><a href="https://jobs.avatoria.com/">Careers</a></li>
									</ul>
								</div>
								<div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-2 cell">
									<div class="footer-title">へっぉ</div>
									<ul class="footer-links social-media">
										<li><a href="#" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
										<li><a href="#" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
										<li><a href="#" target="_blank"><i class="fa fa-twitch"></i><span>Twitch</span></a></li>
										<li><a href="#" target="_blank"><i class="fa fa-youtube"></i><span>YouTube</span></a></li>
									</ul>
								</div>
							</div>
							<div class="footer-divider"></div>
							<div class="footer-text">&copy; Copyright {{ date('Y') }} {{ config('site.name') }}. | All rights reserved.</div>
						</div>
					</div>
				</div>
			</div>
						

 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    
    <script>
        var _token;

        $(() => {
            _token = $('meta[name="csrf-token"]').attr('content');

            $('[data-toggle="tooltip"]').tooltip();

            $('#sidebarToggler').click(function() {
                const enabled = !$('.sidebar').hasClass('show');

                if (enabled)
                    $('.sidebar').addClass('show');
                else
                    $('.sidebar').removeClass('show');
            });
        });
    </script>
  </body>
</html>