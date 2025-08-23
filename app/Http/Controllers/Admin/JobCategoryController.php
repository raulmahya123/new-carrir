<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobCategoryController extends Controller
{
    public function index()
    {
        $categories = JobCategory::orderBy('name')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:job_categories,name',
        ]);
        $data['slug'] = Str::slug($data['name']);

        JobCategory::create($data);
        return redirect()->route('admin.categories.index')->with('ok', 'Kategori berhasil ditambahkan');
    }

    public function edit(JobCategory $job_category)
    {
        return view('admin.categories.edit', compact('job_category'));
    }

    public function update(Request $request, JobCategory $job_category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:job_categories,name,'.$job_category->id,
        ]);
        $data['slug'] = Str::slug($data['name']);

        $job_category->update($data);
        return redirect()->route('admin.categories.index')->with('ok', 'Kategori berhasil diupdate');
    }

    public function destroy(JobCategory $job_category)
    {
        $job_category->delete();
        return back()->with('ok','Kategori berhasil dihapus');
    }
}
