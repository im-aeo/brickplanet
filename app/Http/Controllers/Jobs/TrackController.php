<?php

namespace App\Http\Controllers\Jobs;

use Illuminate\Http\Request;
use App\Models\JobListingResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TrackController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (!Auth::check())
                return redirect()->route('jobs.login.index');

            return $next($request);
        });
    }

    public function index()
    {
        $responses = JobListingResponse::where('applicant_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);

        foreach ($responses as $response)
            switch ($response->status) {
                case 'accepted':
                    $response->class = 'text-success';
                    break;
                case 'declined':
                    $response->class = 'text-danger';
                    break;
                case 'pending':
                    $response->class = 'text-warning';
                    break;
            }

        return view('jobs.track.index')->with([
            'responses' => $responses
        ]);
    }

    public function view($code)
    {
        $response = JobListingResponse::where('tracking_code', '=', $code);
        $site = config('site.name');

        if (!$response->exists())
            return back()->withErrors(['Invalid tracking code.']);

        $response = $response->first();
        $status = $response->status;

        switch ($response->status) {
            case 'accepted':
                $message = 'Your application has been...';
                $class = 'text-success';
                $title = 'Welcome on board!';
                $text = "But this is not the end yet! We will soon be contacting you on {$site} to move forward, thank you for your interest in working with us.";
                break;
            case 'declined':
                $message = 'Your application has been...';
                $class = 'text-danger';
                $title = 'Better luck next time!';
                $text = "Don't let this discourage you because can always re-apply in the future! We hope to see you re-apply, thank you for your interest in working with us.";
                break;
            case 'pending':
                $message = 'Your application is currently...';
                $class = 'text-warning';
                $title = 'We are currently reviewing your application!';
                $text = 'Your application has been submitted successfully and we are currently reviewing it, thank you for your interest in working with us.';
                break;
        }

        return view('jobs.track.view')->with([
            'status' => $status,
            'message' => $message,
            'class' => $class,
            'title' => $title,
            'text' => $text
        ]);
    }
}
