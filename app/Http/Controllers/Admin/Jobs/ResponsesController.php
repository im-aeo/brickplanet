<?php

namespace App\Http\Controllers\Admin\Jobs;

use Illuminate\Http\Request;
use App\Models\JobListingResponse;
use App\Http\Controllers\Controller;

class ResponsesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (!staffUser()->staff('can_view_job_listing_responses')) abort(404);

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        switch ($request->category) {
            case '':
            case 'pending':
                $category = 'pending';
                $responses = JobListingResponse::where('status', '=', 'pending');
                break;
            case 'declined':
                $category = 'declined';
                $responses = JobListingResponse::where('status', '=', 'declined');
                break;
            case 'accepted':
                $category = 'accepted';
                $responses = JobListingResponse::where('status', '=', 'accepted');
                break;
            default:
                abort(404);
        }

        $responses = $responses->orderBy('created_at', 'DESC')->paginate(25);

        return view('admin.jobs.responses.index')->with([
            'category' => $category,
            'responses' => $responses
        ]);
    }

    public function view($id)
    {
        $response = JobListingResponse::where('id', '=', $id)->firstOrFail();

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

        return view('admin.jobs.responses.view')->with([
            'response' => $response
        ]);
    }

    public function update(Request $request)
    {
        $response = JobListingResponse::where('id', '=', $request->id)->firstOrFail();

        if ($response->status != 'pending')
            return back()->withErrors(['This response has already been reviewed.']);

        switch ($request->action) {
            case 'accept':
                $response->reviewer_id = staffUser()->id;
                $response->status = 'accepted';
                $response->save();

                return back()->with('success_message', 'This response has been accepted.');
                break;
            case 'decline':
                $response->reviewer_id = staffUser()->id;
                $response->status = 'declined';
                $response->save();

                return back()->with('success_message', 'This response has been declined.');
                break;
            default:
                abort(404);
        }
    }
}
