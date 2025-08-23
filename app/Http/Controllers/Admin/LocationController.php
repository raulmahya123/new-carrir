<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // Kalau punya scope published() di Job, aktifkan blok withCount di bawah
        $locations = Location::withCount([
            // 'jobs as jobs_count' => fn($q) => $q->published(), // hitung hanya published
            'jobs as jobs_count'  // ← hapus baris ini kalau pakai yang di atas
        ])
        ->orderBy('name')
        ->paginate(20);

        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'region'  => 'nullable|string|max:100',
            'country' => 'nullable|string|max:5',
            'lat'     => 'nullable|numeric|between:-90,90',
            'lng'     => 'nullable|numeric|between:-180,180',
        ]);

        // Kosongkan ke null kalau input kosong (hindari "" disimpan)
        $data['lat'] = $data['lat'] ?? null;
        $data['lng'] = $data['lng'] ?? null;

        Location::create($data);

        return redirect()
            ->route('admin.locations.index')
            ->with('ok', 'Lokasi berhasil ditambahkan');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'region'  => 'nullable|string|max:100',
            'country' => 'nullable|string|max:5',
            'lat'     => 'nullable|numeric|between:-90,90',
            'lng'     => 'nullable|numeric|between:-180,180',
        ]);

        $data['lat'] = $data['lat'] ?? null;
        $data['lng'] = $data['lng'] ?? null;

        $location->update($data);

        return redirect()
            ->route('admin.locations.index')
            ->with('ok', 'Lokasi berhasil diupdate');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return back()->with('ok','Lokasi berhasil dihapus');
    }
}
