<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $q      = $request->get('q');
        $status = $request->get('status');

        $jobs = Job::with(['category','location'])
            ->when($q, fn ($query) =>
                $query->where(function ($w) use ($q) {
                    $w->where('title', 'like', "%{$q}%")
                      ->orWhere('slug', 'like', "%{$q}%")
                      ->orWhere('summary', 'like', "%{$q}%");
                })
            )
            ->when($status, fn ($query) =>
                $query->where('status', $status)
            )
            ->orderByDesc('posted_at')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create', [
            'categories' => JobCategory::orderBy('name')->get(),
            'locations'  => Location::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'job_category_id' => ['required', 'exists:job_categories,id'],
            'location_id'     => ['required', 'exists:locations,id'],
            'title'           => ['required', 'string', 'max:255'],
            'slug'            => ['required', 'string', 'max:160', 'alpha_dash:ascii', 'unique:jobs,slug'],
            'summary'         => ['nullable', 'string'],
            'description'     => ['nullable', 'string'],
            'requirements'    => ['nullable', 'string'],
            'employment_type' => ['required', Rule::in(['fulltime','contract','intern','freelance'])],
            'min_salary'      => ['nullable', 'integer', 'min:0'],
            'max_salary'      => ['nullable', 'integer', 'min:0', 'gte:min_salary'],
            'currency'        => ['nullable', 'string', 'max:10'],
            'apply_link'      => ['nullable', 'url'],
            'contact_email'   => ['nullable', 'email'],
            'status'          => ['required', Rule::in(['draft','open','closed'])],
            'posted_at'       => ['nullable', 'date'],
            'closed_at'       => ['nullable', 'date', 'after_or_equal:posted_at'],
        ]);

        // default currency
        $data['currency'] = $data['currency'] ?? 'IDR';

        // auto posted_at bila OPEN & kosong
        if (($data['status'] ?? null) === 'open' && empty($data['posted_at'])) {
            $data['posted_at'] = now();
        }

        Job::create($data);

        // sukses -> balik ke index jobs + alert
        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job berhasil ditambahkan!');
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', [
            'job'        => $job,
            'categories' => JobCategory::orderBy('name')->get(),
            'locations'  => Location::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Job $job)
    {
        $data = $request->validate([
            'job_category_id' => ['required', 'exists:job_categories,id'],
            'location_id'     => ['required', 'exists:locations,id'],
            'title'           => ['required', 'string', 'max:255'],
            'slug'            => [
                'required', 'string', 'max:160', 'alpha_dash:ascii',
                Rule::unique('jobs', 'slug')->ignore($job->id),
            ],
            'summary'         => ['nullable', 'string'],
            'description'     => ['nullable', 'string'],
            'requirements'    => ['nullable', 'string'],
            'employment_type' => ['required', Rule::in(['fulltime','contract','intern','freelance'])],
            'min_salary'      => ['nullable', 'integer', 'min:0'],
            'max_salary'      => ['nullable', 'integer', 'min:0', 'gte:min_salary'],
            'currency'        => ['nullable', 'string', 'max:10'],
            'apply_link'      => ['nullable', 'url'],
            'contact_email'   => ['nullable', 'email'],
            'status'          => ['required', Rule::in(['draft','open','closed'])],
            'posted_at'       => ['nullable', 'date'],
            'closed_at'       => ['nullable', 'date', 'after_or_equal:posted_at'],
        ]);

        // keep atau default currency
        $data['currency'] = $data['currency'] ?? ($job->currency ?? 'IDR');

        // auto posted_at bila OPEN & kosong
        if (($data['status'] ?? null) === 'open' && empty($data['posted_at'])) {
            $data['posted_at'] = now();
        }

        $job->update($data);

        // sukses -> balik ke index jobs + alert
        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job berhasil diperbarui!');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job berhasil dihapus.');
    }
}
