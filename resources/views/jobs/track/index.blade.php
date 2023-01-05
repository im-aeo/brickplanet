@extends('layouts.jobs', [
    'title' => 'Track Application Status'
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3><i class="fas fa-analytics mr-1" style="font-size:25px;"></i> Track</h3>
            <div class="card text-center-sm">
                <div class="card-body">
                    @forelse ($responses as $response)
                        <div class="listing">
                            <div class="row">
                                <div class="col-md-10 align-self-center">
                                    <h4>{{ $response->listing->title }}</h4>
                                    <p class="{{ $response->class }}"><strong>{{ strtoupper($response->status) }}</strong></p>
                                </div>
                                <div class="col-md-2 align-self-center">
                                    <div class="mt-3 show-sm-only"></div>
                                    <a href="{{ route('jobs.track.view', $response->tracking_code) }}" class="btn btn-block btn-outline-success">View</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>You haven't applied for any positions yet.</p>
                    @endforelse
                </div>
            </div>
            {{ $responses->onEachSide(1) }}
        </div>
    </div>
@endsection
