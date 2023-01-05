<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
	<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ isset($title) ? "{$title} - " . config('site.name') : config('site.name') }} </title>
		<link rel="canonical" href="https://jobs.brickplanet.com" />
        <link rel="stylesheet" href="{{asset('css/jobs/foundation.css')}}">
		<link rel="stylesheet" href="{{asset('css/jobs/style.css')}}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		 @yield('meta')
      <style>
      
      .navbar .headshot a {
            text-decoration: none;
        }

        .navbar .headshot img {
            background: #eee;
            border-radius: 50%;
        }

        .navbar .headshot .dropdown-toggle {
            margin-right: none!important;
        }

        .navbar .headshot .dropdown-toggle::after {
            border: none!important;
            margin: 0!important;
        }
      
      </style>
<div class="site-wrapper">
		<div class="site-header without-bg-and-shadow">
			<div class="grid-container">
				<div class="grid-x grid-margin-x align-middle">
					<div class="small-12 medium-12 large-auto cell">
						<a href="/"><div class="logo-ico"></div></a>
						<div class="logo-divider"></div>
						<div class="logo-right">Careers</div>
					</div>
					<div class="small-12 medium-12 large-shrink cell right">
						<ul>
                          @guest
                            <li><a href="{{ route('jobs.listings.index') }}">Openings</a></li>
							<li><a href="{{ route('jobs.about.index') }}">About Us</a></li>
                            <li><a href="{{ route('jobs.login.index') }}">Get Started</a></li>
                          @else
                           <li><a href="{{ route('jobs.listings.index') }}">Openings</a></li>
                           <li><a href="{{ route('jobs.about.index') }}">About Us</a></li>
                          
                           <li><a href="{{ route('jobs.logout') }}">Logout</a></li>
                            
                          @endguest
						</ul>
					</div>
				</div>
			</div>
		</div>
<div class="content-wrapper">
  @yield('content')
</div>
<div class="site-footer">
			<div class="grid-container text-center">
				<div class="footer-logo-ico"></div>
				<div class="footer-copyright">&copy; 2017 {{ config('site.name') }}.</div>
				<div class="footer-notes">{{ config('site.name') }} is an Equal Opportunity Employer. Applicants are not discriminated against race, color, religion, gender, sexual orientation, national origin, age, political view(s), or any other characteristics covered by law.</div>
			</div>
		</div>