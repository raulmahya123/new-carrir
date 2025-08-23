@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Lowongan</h1>

<form method="GET" class="grid md:grid-cols-5 gap-3 mb-6">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul/summary..."
         class="border p-2 rounded md:col-span-2">
  <select name="category" class="border p-2 rounded">
    <option value="">Semua Kategori</option>
    @foreach($categories as $c)
      <option value="{{ $c->slug }}" @selected(request('category')===$c->slug)>{{ $c->name }}</option>
    @endforeach
  </select>
  <select name="location" class="border p-2 rounded">
    <option value="">Semua Lokasi</option>
    @foreach($locations as $l)
      <option value="{{ $l->id }}" @selected(request('location')==$l->id)>{{ $l->name }}</option>
    @endforeach
  </select>
  <select name="type" class="border p-2 rounded">
    <option value="">Semua Tipe</option>
    @foreach(['fulltime'=>'Full-time','contract'=>'Contract','intern'=>'Intern','freelance'=>'Freelance'] as $k=>$v)
      <option value="{{ $k }}" @selected(request('type')===$k)>{{ $v }}</option>
    @endforeach
  </select>
  <button class="border p-2 rounded md:col-span-5">Filter</button>
</form>

<div class="grid md:grid-cols-2 gap-4">
  @forelse($jobs as $job)
    <article class="bg-white p-4 rounded shadow">
      <h2 class="text-xl font-semibold">
        <a href="{{ route('jobs.show',$job->slug) }}">{{ $job->title }}</a>
      </h2>
      <div class="text-sm text-gray-600 mb-2">
        {{ $job->category->name ?? '-' }} • {{ $job->location->name ?? '-' }} • {{ ucfirst($job->employment_type) }}
        @if($job->posted_at) • Diposting {{ $job->posted_at->diffForHumans() }} @endif
      </div>
      @if($job->summary)
        <p class="text-gray-700 line-clamp-3">{{ $job->summary }}</p>
      @endif
      <div class="mt-3 flex gap-2">
        <a class="inline-block px-3 py-1 border rounded" href="{{ route('jobs.show',$job->slug) }}">Detail</a>
        @if($job->apply_link)
          <a target="_blank" rel="noopener" class="inline-block px-3 py-1 bg-blue-600 text-white rounded" href="{{ $job->apply_link }}">Apply</a>
        @elseif($job->contact_email)
          <a class="inline-block px-3 py-1 border rounded"
             href="mailto:{{ $job->contact_email }}?subject=Lamaran: {{ urlencode($job->title) }}">Email</a>
        @endif
      </div>
    </article>
  @empty
    <p>Tidak ada lowongan.</p>
  @endforelse
</div>

<div class="mt-6">{{ $jobs->links() }}</div>
@endsection
