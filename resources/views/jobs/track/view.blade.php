@extends('layouts.jobs', [
    'title' => 'Track Application Status'
])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3><i class="fas fa-analytics mr-1" style="font-size:25px;"></i> Track</h3>
            <div class="card text-center">
                <div class="card-body">
                    <h4>Application Status</h4>
                    <h3 class="{{ $class }}"><strong>{{ strtoupper($status) }}</strong></h3>
                    <hr>
                    <h5>{{ $title }}</h5>
                    <p>{{ $text }}</p>
                    <small class="text-muted">We suggest bookmarking this page so you will always be able to check the status of your application.</small>
                </div>
            </div>
        </div>
    </div>
@endsection
