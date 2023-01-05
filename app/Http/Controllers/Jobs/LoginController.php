<?php

namespace App\Http\Controllers\Jobs;

use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (Auth::check() && $request->route()->getName() != 'jobs.logout')
                return redirect()->route('jobs.listings.index');
            else if (!Auth::check() && $request->route()->getName() == 'jobs.logout')
                return redirect()->route('jobs.login.index');

            return $next($request);
        });
    }

    public function index()
    {
        return view('jobs.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            $user = User::where('username', '=', $request->username)->first();

            $login = new UserLogin;
            $login->user_id = $user->id;
            $login->ip = $request->ip();
            $login->save();

            return redirect()->route('jobs.listings.index')->with('success_message', 'You have successfully logged in!');
        }

        return back()->withErrors(['The credentials you have provided are wrong!']);
    }

    public function logout()
    {
        Auth::logout();

        return back();
    }
}
