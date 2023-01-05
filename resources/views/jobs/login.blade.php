@extends('layouts.jobs', [
    'title' => 'Login'
])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3><i class="fas fa-user mr-1" style="font-size:25px;"></i> Login</h3>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('jobs.login.authenticate') }}" method="POST">
                        @csrf
                        <label for="username">Username</label>
                        <input class="form-control mb-2" type="text" name="username" placeholder="Username" required>
                        <label for="password">Password</label>
                        <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <button class="btn btn-block btn-success">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
