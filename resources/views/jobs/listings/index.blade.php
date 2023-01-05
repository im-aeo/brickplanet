@extends('layouts.jobs', [
    'title' => 'Listings'
])

@section('css')
    <style>
        .listing:not(:first-child) {
            padding-top: 16px;
        }

        .listing:not(:last-child) {
            padding-bottom: 16px;
            border-bottom: 1px solid #0000001a;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
		<div class="grid-container"><div class="site-header-margin"></div>
		<div class="job-container">
		<div class="page-title">Job Openings</div>
          <div class="job-content">
       @forelse ($listings as $listing)
            <div class="job-pos">
				<div class="grid-x grid-margin-x align-middle">
					<div class="large-8 cell">
						<div class="job-pos-title">{{ $listing->title }}</div>
						<div class="job-pos-category">{{ $listing->category }}</div>
						<div class="grid-x grid-margin-x">
							<div class="shrink cell no-margin">
								<div class="ico-group">
									<i class="material-icons">home</i>
									<span>Remote</span>
								</div>
							</div>
                          <div class="shrink cell no-margin">
									<div class="ico-group">
										<i class="material-icons">assignment</i>
										<span>Contract Based</span>
									</div>
								</div>
						</div>
					</div>
					<div class="large-4 cell text-right">
						<a href="{{ route('jobs.listings.view', $listing->uid) }}" class="job-learnmore" title="View Listing">View</a>
					</div>
				</div>
			</div>
                    @empty
                        <p>There are currently no available listings. Check again later!</p>
                    @endforelse
                </div>
            </div>
            {{ $listings->onEachSide(1) }}
        </div>
    </div>
@endsection
