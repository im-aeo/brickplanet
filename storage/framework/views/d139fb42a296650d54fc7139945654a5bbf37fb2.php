<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
	<head>
		<title><?php echo e(isset($title) ? "{$title} - " . config('site.name') : config('site.name')); ?> </title>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Brick Planet is a user generated content sandbox game with tens of thousands of active players. Play today!">
		<meta name="keywords" value="brickplanet, brick planet, brick game, create game">
		<meta name="author" content="Brickplanet Inc.">
		<link rel="stylesheet" href="<?php echo e(asset('css/foundation.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('css/dark-style.css')); ?>">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="<?php echo e(asset('css/fontawesome.min.css')); ?>" rel="stylesheet">
		 <?php echo $__env->yieldContent('meta'); ?>
<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-78458167-1', 'auto');
		  ga('send', 'pageview');

		</script>
        <?php echo $__env->yieldContent('fonts'); ?>
		<script src="<?php echo e(asset('js/jquery.js?v=2')); ?>"></script>
        <script src="<?php echo e(asset('js/main.js?v=2')); ?>"></script>
        <script src="<?php echo e(asset('js/foundation.js?v=2')); ?>"></script>
        <script src="<?php echo e(asset('js/search.js')); ?>"></script>
        <script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>
      <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
        <?php echo $__env->yieldContent('js'); ?>
	</head>
	<body>
      <div class="site-wrap">
		<div class="top-bar animate__animated animate__fadeInDown">
			<div class="top-bar-left">
				<div class="grid-x align-middle grid-margin-x">
					<div class="shrink cell hide-for-large">
						<button class="menu-icon sidebar-menu-icon" type="button" data-toggle="side-bar"></button>
					</div>
					<div class="shrink cell menu-logo">
						<a href="<?php echo e(route('home.index')); ?>">
							<img src="<?php echo e(config('site.logo')); ?>" class="show-for-large">
							<img src="<?php echo e(config('site.icon')); ?>" class="hide-for-large" style="height:30px;">
						</a>
					</div>
					<div class="auto cell no-margin">
						<input type="text" class="menu-search" id="navbarSearch" placeholder="Search">
						<div class="search-dropdown-parent">
							<div id="search-dropdown" class="search-dropdown fast" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;">
								<div id="show-recent">
								
								</div>
								<div id="navbarSearchResults"></div>
							</div>
						</div>
					</div>
					<div class="shrink cell">
						<ul class="menu align-middle">
							 <?php if(auth()->guard()->guest()): ?>
								<li class="menu-login show-for-medium">
									<div class="menu-log-in">
										<a href="<?php echo e(route('auth.login.index')); ?>">Log In</a>
									</div>
								</li>
								<li class="menu-createaccount show-for-medium">
									<div class="menu-create-account">
										<a href="<?php echo e(route('auth.register.index')); ?>">Create Account</a>
									</div>
								</li>
                      
								 <?php else: ?>
								<li class="menu-link show-for-medium">
									<a data-toggle="user-notifications">
										<span class="icon relative">
											<i class="material-icons">diversity_1</i>
											
											<?php if(Auth::user()->friendRequestCount() > 0): ?> {
											<div class="notification-badge badge-header" id="notifications-count"><?php echo e(shortNum(Auth::user()->friendRequestCount())); ?></div>
											<?php else: ?> 
											<div class="notification-badge badge-header" id="notifications-count" style="display:none;">0</div>
											<?php endif; ?>
										</span>
									</a>
								</li>
								<li class="menu-link">
									<a title="<?php echo e(number_format(Auth::user()->currency_credits)); ?> Credits" href="<?php echo e(route('account.money.index', '')); ?>">
										<span class="icon"><img src="<?php echo e(asset('img/credits-sm.png')); ?>" width="20"></span>
										<span class="show-for-medium"><?php echo e(number_format(Auth::user()->currency_credits)); ?></span>
										<span class="show-for-small-only"><?php echo e(shortNum(Auth::user()->currency_credits)); ?></span>
									</a>
								</li>
								<li class="menu-link">
									<a title="<?php echo e(number_format(Auth::user()->currency)); ?> Bits" href="'.$serverName.'/upgrade/bits">
										<span class="icon"><img src="<?php echo e(asset('img/bits-sm.png')); ?>" width="20"></span>
										<span class="show-for-medium"><?php echo e(number_format(Auth::user()->currency)); ?></span>
										<span class="show-for-small-only"><?php echo e(shortNum(Auth::user()->currency)); ?></span>
									</a>
								</li>
								<li class="menu-link avatar-preview">
									<a data-toggle="user-dropdown-all"><div class="menu-avatar-preview-thumbnail" style="background-image:url(<?php echo e(Auth::user()->headshot()); ?>);background-size:cover;"></div></a>
									</li>
                                  <?php endif; ?>	
						</ul>
					</div>
				</div>
			</div>
		</div>
      
		<?php if(auth()->guard()->check()): ?>
			<!-- User Dropdown -->
			<div id="user-dropdown-all" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;" class="fast">
				<i class="material-icons user-dropdown-arrow">arrow_drop_up</i>
				<div class="user-dropdown" id="user-dropdown">
					<div class="dropdown-header">
						<div class="grid-x align-middle grid-margin-x">
							<div class="shrink cell no-margin">
								<div class="avatar-preview-thumbnail" style="background-image:url(<?php echo e(Auth::user()->headshot()); ?>);background-size:cover;"></div>
							</div>
							<div class="auto cell">
								<div class="dropdown-username"><a href="'.$serverName.'/users/'.$myU->Username.'/">'.$myU->Username.'</a></div>
							</div>
						</div>
					</div>
					<div class="dropdown-body">
						<ul>
							<li><a href="'.$serverName.'/users/'.$myU->Username.'/">Profile</a></li>
							<li><a href="'.$serverName.'/account/character/">Character</a></li>
						</ul>
						<div class="ddivider"></div>
						<ul>
							<li><a href="'.$serverName.'/account/settings/">Settings</a></li>
							<li><a href="'.$serverName.'/account/logout/">Logout</a></li>
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
								Notifications
							</div>
							<div class="shrink cell no-margin right">
								<a href="/inbox/notifications">See All</a>
							</div>
						</div>
					</div>
					<div class="user-chat-row-divider"></div>
					<div id="user-notifications-html">
						
							<div class="user-notifications-none">
								<i class="material-icons">notifications_none</i>
								<span>You have no unread notifications.</span>
							</div>
							
					</div>
					<div class="push-5"></div>
				</div>
			</div>

      <?php endif; ?>
      	

		
		<div class="top-bar-push"></div>
		<div class="grid-x grid-margin-x">
			<div class="sidebar-shrink shrink cell no-margin">
				<!-- Mobile / Tablet -->
				<div class="side-bar hide-for-large" id="side-bar" data-toggler data-animate="fade-in fade-out" style="display:none;">
					<div class="side-bar-inner">
						 <ul>
          <?php if(auth()->guard()->guest()): ?>
                      <li><a href="<?php echo e(route('auth.login.index')); ?>"><i class="material-icons">person</i><span>Log In</span></a></li>
            <li><a href="<?php echo e(route('auth.register.index')); ?>"><i class="material-icons">person_add</i><span>Create Account</span></a></li>
          <?php endif; ?>
          
			<li><a href="<?php echo e(route('games.index')); ?>"><i class="material-icons">games</i><span>Games</span></a></li>
            <li><a href="<?php echo e(route('catalog.index', 'recent')); ?>" class="<?php echo e(set_active(['catalog.*'])); ?>"><i class="material-icons">store</i><span>Store</span></a></li>
          
          			<li><a href="<?php echo e(route('groups.index')); ?>" class="<?php echo e(set_active(['groups.*'])); ?>"><i class="material-icons">group</i><span>Groups</span></a></li>
          
            <li><a href="<?php echo e(route('users.index', '')); ?>"><i class="material-icons">people</i><span>Users</span></a></li>
          
		
			<li><a href="/forum/" class="<?php echo e(set_active(['forum.*'])); ?>"><i class="material-icons">forum</i><span>Forum</span></a></li>
          
			
</ul>

					</div>
				</div>
			</div>
                        <?php echo $__env->yieldContent('content'); ?>
                 </div>
					</div>
			<div class="site-footer">
				<div class="grid-x grid-margin-x">
					
					<div class="auto cell no-margin">
						<div class="grid-container">
							<div class="grid-x grid-margin-x">
								<div class="large-2 large-offset-1 medium-3 medium-offset-0 small-4 small-offset-1 cell">
									<div class="footer-title">NAVIGATE</div>
									<ul class="footer-links">
										<li><a href="<?php echo e(route('home.index')); ?>">Home</a></li>
										<li><a href="<?php echo e(route('catalog.index', 'recent')); ?>">Store</a></li>
										<li><a href="<?php echo e(route('forum.index')); ?>">Forum</a></li>
										<li><a href="<?php echo e(route('account.upgrade.index')); ?>">Upgrade</a></li>
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
										<li><a href="https://support.<?php echo e(config('site.name')); ?>.com/" target="_blank">Help Center</a></li>
										<li><a href="#">Legal</a></li>
										<li><a href="https://jobs.avatoria.com/">Careers</a></li>
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
							<div class="footer-text">&copy; Copyright <?php echo e(date('Y')); ?> <?php echo e(config('site.name')); ?>. | All rights reserved.</div>
						</div>
					</div>
				</div>
			</div>
						

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
      </div>
  </body>
</html><?php /**PATH /var/www/html/resources/views/layouts/2019/land.blade.php ENDPATH**/ ?>