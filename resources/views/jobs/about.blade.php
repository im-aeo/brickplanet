@extends('layouts.jobs', [
    'title' => 'About Us'
])
@section('content')
<div class="home-teaser"></div>
	<div class="grid-container">
		<div class="home-content-white">
			<div class="home-big-title-text text-center">We innovate</div>
			<div class="home-text text-center">At {{ config('site.name') }}, we prioritize two things &dash; customer satisfaction and innovation. And we know that is only possible by having great people behind the scenes.</div>
			<div class="home-button-learnmore"><a href="{{ route('jobs.listings.index') }}">Search Openings</a></div>
		</div>
		<div class="home-content-grey">
			<div class="home-big-title-text">A growing startup</div>
			<div class="home-text">We're headquartered in Huntsville, Alabama, America's fastest growing tech city. {{ config('site.name') }} was founded by young adults with a common goal of creating the best gaming platform where players can create and share their creations with the world.<br/>We embrace diversity, inclusion, and new ideas.</div>
		</div>
</div>
@endsection
