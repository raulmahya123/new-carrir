<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Location;

class DashboardController extends Controller
{
    public function index()
    {
        // Kartu statistik
        $totalJobs = Job::count();
        $openJobs  = Job::where('status','open')->count();
        $draftJobs = Job::where('status','draft')->count();
        $closedJobs= Job::where('status','closed')->count();

        // Grafik: jobs by status
        $jobsByStatus = Job::selectRaw('status, COUNT(*) as cnt')
            ->groupBy('status')
            ->pluck('cnt','status');

        // Grafik: jobs by category (top 8)
        $jobsByCategoryRaw = JobCategory::withCount('jobs')
            ->orderByDesc('jobs_count')
            ->limit(8)
            ->get(['id','name','slug','jobs_count']);

        $jobsByCategoryLabels = $jobsByCategoryRaw->pluck('name');
        $jobsByCategoryCounts = $jobsByCategoryRaw->pluck('jobs_count');

        // Peta: lokasi + jumlah lowongan published
        $locations = Location::select('id','name','region','country','lat','lng')
            ->withCount(['jobs as jobs_count' => function($q){
                $q->where('status','open')->whereNotNull('posted_at')->where('posted_at','<=', now());
            }])->get();

        return view('admin.dashboard', [
            'stats' => [
                'total'  => $totalJobs,
                'open'   => $openJobs,
                'draft'  => $draftJobs,
                'closed' => $closedJobs,
            ],
            'chart' => [
                'statusLabels' => ['draft','open','closed'],
                'statusCounts' => [
                    $jobsByStatus->get('draft',0),
                    $jobsByStatus->get('open',0),
                    $jobsByStatus->get('closed',0),
                ],
                'catLabels'    => $jobsByCategoryLabels,
                'catCounts'    => $jobsByCategoryCounts,
            ],
            'locations' => $locations,
        ]);
    }
}
