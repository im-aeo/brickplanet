<?php

namespace App\Http\Controllers\Jobs;

use App\Models\JobListing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JobListingResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ListingsController extends Controller
{
    public function index()
    {
        $listings = JobListing::where('is_active', '=', true)->orderBy('created_at', 'DESC')->paginate(10);

        return view('jobs.listings.index')->with([
            'listings' => $listings
        ]);
    }

    public function view($uid)
    {
        $listing = JobListing::where([
            ['uid', '=', $uid],
            ['is_active', '=', true]
        ])->firstOrFail();

        return view('jobs.listings.view')->with([
            'listing' => $listing
        ]);
    }

    public function apply(Request $request)
    {
        if (!Auth::check())
            return response()->json(['errors' => ['name' => ['You are not logged in.']]]);

        if (Auth::user()->isStaff())
            return response()->json(['error' => ['name' => ['You are already a staff member.']]]);

        $listing = JobListing::where([
            ['uid', '=', $request->uid],
            ['is_active', '=', true]
        ]);

        if (!$listing->exists())
            return response()->json(['errors' => ['name' => ['This listing does not exist.']]]);

        $listing = $listing->first();

        $applied = JobListingResponse::where([
            ['listing_id', '=', $listing->id],
            ['applicant_id', '=', Auth::user()->id],
            ['status', '=', 'pending']
        ])->exists();

        if ($applied)
            return response()->json(['errors' => ['name' => ['You have already applied for this position.']]]);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:20', 'regex:/\\A[a-z\\d]+(?:[.-][a-z\\d]+)*\\z/i'],
            'email' => ['required', 'email', 'max:255'],
            'why_work' => ['required', 'min:25', 'max:2500'],
            'why_choose' => ['required', 'min:25', 'max:2500'],
            'how_find' => ['required', 'min:25', 'max:2500']
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()]);

        $trackingCode = strtoupper(Str::random(30));

        $response = new JobListingResponse;
        $response->listing_id = $listing->id;
        $response->applicant_id = Auth::user()->id;
        $response->tracking_code = $trackingCode;
        $response->name = $request->name;
        $response->email = $request->email;
        $response->why_work = $request->why_work;
        $response->why_choose = $request->why_choose;
        $response->how_find = $request->how_find;
        $response->save();

        return response()->json(['url' => route('jobs.track.view', $trackingCode)]);
    }
}
