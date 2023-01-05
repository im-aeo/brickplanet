<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Models\JobListing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (!staffUser()->staff('can_create_job_listings')) abort(404);

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        switch ($request->category) {
            case '':
            case 'active':
                $category = 'active';
                $listings = JobListing::where('is_active', '=', true);
                break;
            case 'inactive':
                $category = 'inactive';
                $listings = JobListing::where('is_active', '=', false);
                break;
            default:
                abort(404);
        }

        $listings = $listings->orderBy('created_at', 'DESC')->paginate(25);

        return view('admin.jobs.listings.index')->with([
            'category' => $category,
            'listings' => $listings
        ]);
    }

    public function new()
    {
        return view('admin.jobs.listings.new');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'min:5', 'max:50'],
            'category' => ['required', 'min:5', 'max:50'],
            'body' => ['required', 'min:10', 'max:2048']
        ]);

        $uid = strtoupper(Str::random(30));

        $listing = new JobListing;
        $listing->uid = $uid;
        $listing->title = $request->title;
        $listing->category = $request->category;
        $listing->body = $request->body;
        $listing->save();

        return redirect()->route('admin.jobs.listings.index', '')->with('success_message', 'Listing has been created.');
    }

    public function edit($uid)
    {
        $listing = JobListing::where('uid', '=', $uid)->firstOrFail();

        return view('admin.jobs.listings.edit')->with([
            'listing' => $listing
        ]);
    }

    public function update(Request $request)
    {
        $listing = JobListing::where('uid', '=', $request->uid)->firstOrFail();

        switch ($request->action) {
            case 'toggle_status':
                $listing->is_active = !$listing->is_active;
                $listing->save();

                return back()->with('success_message', 'Listing status has been updated.');
                break;
            case 'update':
                $this->validate($request, [
                    'title' => ['required', 'min:5', 'max:50'],
                    'category' => ['required', 'min:5', 'max:50'],
                    'body' => ['required', 'min:10', 'max:2048']
                ]);

                $listing->title = $request->title;
                $listing->category = $request->category;
                $listing->body = $request->body;
                $listing->save();

                return redirect()->route('admin.jobs.listings.index', '')->with('success_message', 'Listing has been updated.');
                break;
            default:
                abort(404);
        }
    }
}
