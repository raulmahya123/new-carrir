<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Location;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
{
    $filters = [
        'category' => $request->get('category'),
        'location' => $request->get('location'),
        'type'     => $request->get('type'),
        'q'        => $request->get('q'),
    ];

    $jobs = Job::with(['category:id,name,slug', 'location:id,name'])
        ->published()
        ->filter($filters)
        ->latest('posted_at')
        ->paginate(12)
        ->withQueryString();

    // ⬇️ locations + jumlah lowongan aktif (published) per lokasi
    $locations = Location::withCount([
        'jobs as jobs_count' => function ($q) {
            $q->published();
        }
    ])->orderBy('name')->get(['id','name','region','country','image_path']);

    return view('jobs.index', [
        'jobs'       => $jobs,
        'categories' => JobCategory::orderBy('name')->get(['id','name','slug']),
        'locations'  => $locations,
        'filters'    => $filters,
    ]);
}


    public function show(string $slug)
    {
        $job = Job::with(['category','location'])
            ->published()
            ->where('slug',$slug)
            ->firstOrFail();

        return view('jobs.show', compact('job'));
    }
}
