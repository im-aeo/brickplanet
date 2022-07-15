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

<html lang="en" prefix="og: https://ogp.me/ns#">
	<head>
		<title>{{ isset($title) ? "{$title} - " . config('site.name') : config('site.name') }}</title>
		<meta charset="utf-8">
      <!-- Preconnect -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
      <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Uxhill is a user generated content sandbox game with tens of thousands of active players. Play today!">
		<meta name="keywords" value="Detrimo, Uxhill, brick game, create game, Roblox, Clone, Detrimo,Retrimo but ass, =3, =6">
		<meta name="author" content="Uxhill.">
          <meta name="theme-color" content="{{ config('site.theme_color') }}">
    <link rel="shortcut icon" href="{{ config('site.icon') }}">
    <meta name="author" content="{{ config('site.name') }}">
    <meta name="description" content="Brick building, brick build together part piece construct make create set.">
    <meta name="keywords" content="{{ strtolower(config('site.name')) }}, {{ strtolower(str_replace(' ', '', config('site.name'))) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
      
      <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:title" content="{{ $title ?? config('site.name') }}">
    <meta property="og:description" content="Brick building, brick build together part piece construct make create set.">
      @yield('fonts')
      
    <meta property="og:image" content="{{ !isset($image) ? config('site.icon') : $image }}">
		<link rel="stylesheet" href="{{ asset('css/stylesheet.css?v=69') }}">
      <link rel="stylesheet" href="{{ asset('css/main.css?v=69') }}">
          <link rel="stylesheet" href="{{ (Auth::check()) ? asset('css/themes/' . Auth::user()->setting->theme . '.css?v=' . rand()) : asset('css/themes/dark.css?v=' . rand()) }}">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="/css/font-awesome.min.css" rel="stylesheet">
          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1047015416294545"
         crossorigin="anonymous"></script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-78458167-1', 'auto');
		  ga('send', 'pageview');

		</script>
      @yield('css')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.1/js/foundation.min.js"></script>
      <script src="/js/main.js"></script>
					</head>
	<body>
    <script>
		var _token = $('meta[name="csrf-token"]').attr('content');
	</script>  

	<div class="site-wrap">
	
		<div class="top-bar">
			<div class="top-bar-left">
				<div class="grid-x align-middle grid-margin-x">
					<div class="shrink cell hide-for-large">
						<button class="menu-icon sidebar-menu-icon" type="button" data-toggle="side-bar" id="sidebarToggler"></button>
					</div>
					<div class="shrink cell menu-logo">
						<a href="/">
							<img src="{{ config('site.logo') }}" class="show-for-large" width="150">
							<img src="{{ config('site.icon') }}" class="hide-for-large" style="height:30px;">
						</a>
					</div>
					<div class="auto cell no-margin" id="navbarContent">
						<input  class="menu-search" id="navbarSearch" placeholder="Search for users, items and groups..." onkeyup="searchSite(this.value)">
						<div class="search-dropdown-parent">
							<div id="search-dropdown" class="search-dropdown fast" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;">
								<div id="show-recent">
								
								</div>
								<div id="navbarSearchResults"></div>
							</div>
						</div>
					</div>
                  @guest
<div class="shrink cell">
<ul class="menu align-middle">
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
                          <div class="shrink cell">
<ul class="menu align-middle">

								<li class="menu-link show-for-medium">
									<a data-toggle="user-notifications">
										<span class="icon relative">
											<i class="material-icons">diversity_1</i>

                                          <!-- notiv code here !-->
											<div class="notification-badge badge-header" id="notifications-count">{{ number_format(Auth::user()->friendRequestCount()) }}</div>
                                          
                                          
												<div class="notification-badge badge-header" id="notifications-count" style="display:none;">{{ number_format(Auth::user()->friendRequestCount()) }}</div>
										</span>
									</a>
								</li>
								<li class="menu-link">
									<a title="{{ number_format(Auth::user()->currency_bucks) }} Credits" href="{{ route('account.money.index', '') }}">
										<span class="icon">
										<img src="/img/credits-sm.png" width="20"></span>
										<span id="userCurrency" class="show-for-medium">@{{ credits }}</span>
										<span id="userCurrency" class="show-for-small-only">{{ number_format(Auth::user()->currency_bucks) }}</span>
									</a>
								</li>
								<li class="menu-link">
									<a title="{{ number_format(Auth::user()->currency_bits) }} Bits" href="{{ route('account.money.index', '') }}">
										<span class="icon">
										    <img src="/img/bits-sm.png" width="20">
										</span>
										<span id="user" class="show-for-medium">@{{ bits }}</span>
										<span id="user" class="show-for-small-only">{{ number_format(Auth::user()->currency) }}</span>
									</a>
								</li>
								<li class="menu-link avatar-preview">
									<a data-toggle="user-dropdown-all"><div class="menu-avatar-preview-thumbnail" style="background-image:url({{ Auth::user()->headshot() }});background-size:cover;"></div></a>
								</li>
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
								<div class="dropdown-username">
								    <a id="name" href="#">{{ Auth::user()->username }}</a>
								</div>
							</div>
						</div>
					</div>
					<div class="dropdown-body">
						<ul>
							<li><a href="{{ route('users.profile', Auth::user()->username ) }}">Profile</a></li>
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
                                    @endif
</ul>
</div>
</div>
</div>
</div>
		
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
							</ul>
							<div class="sbdivider hide-for-medium"></div>
                      @endguest
							
						
		<ul>
          @guest
                      <li><a href="{{ route('auth.login.index') }}"><i class="material-icons">person</i><span>Log In</span></a></li>
            <li><a href="{{ route('auth.register.index') }}"><i class="material-icons">person_add</i><span>Create Account</span></a></li>
          @endguest
          
			<li><a href="#"><i class="material-icons">games</i><span>Games</span></a></li>
            <li><a href="{{ route('catalog.index') }}"><i class="material-icons">store</i><span>Store</span></a></li>
          
          			<li><a href="{{ route('groups.index') }}"><i class="material-icons">flag</i><span>Groups</span></a></li>
          
            <li><a href="{{ route('users.index', '') }}"><i class="material-icons">people</i><span>Users</span></a></li>
          
		
			<li><a href="/forum/"><i class="material-icons">forum</i><span>Forum</span></a></li>
          @auth
		  <br>
          <li><a href="#"><i class="material-icons">inbox</i><span>Inbox</span></a></li>
          
                    <li><a href="{{ route('account.money.index', '') }}"><i class="material-icons">design_services</i><span>Money</span></a></li>
          <li><a href="{{ route('account.upgrade.index') }}"><i class="material-icons">rocket_launch</i><span>Upgrades</span></a></li>
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
          <div class="sbdivider"></div>
			
</ul>
          
					</div>
				</div>
				
				<!-- Desktop -->
				<div class="side-bar show-for-large" id="side-bar-desktop">
					<div class="side-bar-inner">
					
		<ul>
          @guest
                      <li><a href="{{ route('auth.login.index') }}"><i class="material-icons">person</i><span>Log In</span></a></li>
            <li><a href="{{ route('auth.register.index') }}"><i class="material-icons">person_add</i><span>Create Account</span></a></li>
          @endguest
          
			<li><a href="#"><i class="material-icons">games</i><span>Games</span></a></li>
            <li><a href="{{ route('catalog.index') }}"><i class="material-icons">store</i><span>Store</span></a></li>
          
          			<li><a href="{{ route('groups.index') }}"><i class="material-icons">flag</i><span>Groups</span></a></li>
          
            <li><a href="{{ route('users.index', '') }}"><i class="material-icons">people</i><span>Users</span></a></li>
          
		
			<li><a href="/forum/"><i class="material-icons">forum</i><span>Forum</span></a></li>
          @auth
		  <br>
          <li><a href="#"><i class="material-icons">inbox</i><span>Inbox</span></a></li>
          
                    <li><a href="{{ route('account.money.index', '') }}"><i class="material-icons">wallet</i><span>Creator Area</span></a></li>
          <li><a href="{{ route('account.upgrade.index') }}"><i class="material-icons">rocket_launch</i><span>Upgrades</span></a></li>
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
          <div class="sbdivider"></div>
			
</ul>
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
								{!! site_setting('alert_message') !!}
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
                      <div class="advert-container-horizontal">
							<!-- Responsive -->
							<ins class="adsbygoogle"
								 style="display:block"
								 data-ad-client="ca-pub-1047015416294545"
								 data-ad-slot="9367089090"
								 data-ad-format="auto"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
                              @yield('content')
            <div class="advert-container-footer">
			<!-- Responsive -->
			<ins class="adsbygoogle"
				 style="display:block"
				 data-ad-client="ca-pub-1047015416294545"
				 data-ad-slot="9367089090"
				 data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
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
										<li><a href="{{ route('catalog.index') }}">Store</a></li>
										<li><a href="https://www.detrimo.com/forum/">Forum</a></li>
										<li><a href="{{ route('account.upgrade.index') }}">Upgrade</a></li>
									</ul>
								</div>
								<div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-2 cell">
									<div class="footer-title">ABOUT</div>
									<ul class="footer-links">
										<li><a href="/info/terms/">Terms of Service</a></li>
										<li><a href="/info/privacy/">Privacy Policy</a></li>
										<li><a href="https://jobs.detrimo.com/about-us/">About Us</a></li>
										<li><a href="https://blog.detrimo.com" target="_blank">Blog</a></li>
									</ul>
								</div>
								<div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
									<div class="footer-title">SUPPORT</div>
									<ul class="footer-links">
										<li><a href="/info/staff">Contact Us</a></li>
										<li><a href="https://support.detrimo.com/" target="_blank">Help Center</a></li>
										<li><a href="#">Legal</a></li>
										<li><a href="https://jobs.retrimo.xyz/">Careers</a></li>
									</ul>
								</div>
								<div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-2 cell">
									<div class="footer-title">SOCIAL MEDIA</div>
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
		</div>
          @auth
          <script type="text/javascript">
var userCurrency = new Vue({
  el: '#userCurrency',
  data: {
      credits: '{{ number_format(Auth::user()->currency_bucks) }}', bits: '{{ number_format(Auth::user()->currency) }}'
  }
})

var user = new Vue({
  el: '#user',
  data: {
      username: '{{ Auth::user()->username }}', credits: '{{ number_format(Auth::user()->currency_bucks) }}', bits: '{{ number_format(Auth::user()->currency) }}'
  }
})

var name = new Vue({
  el: '#name',
  data: {
      name: '{{ Auth::user()->username }}'
  }
})

var app = new Vue({
  el: '#app',
  
  data: {
    user: [
      { username: '{{ Auth::user()->username }}', email: '{{ Auth::user()->email }}', credits: '{{ number_format(Auth::user()->currency_bucks)}}', bits: '{{ number_format(Auth::user()->currency) }}', power: 'none' }
    ],

    subforum: [
      { name: 'Hello world!' }
    ]

  }

    
})
</script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
      
      
         @endauth 
		<script src="/js/vendor/foundation.js"></script>
		<script src="/js/main.js"></script>
        <script src="{{ asset('js/search.js') }}"></script>
    @yield('js')
	</body>
</html>
  