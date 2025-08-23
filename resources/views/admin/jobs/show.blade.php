@extends('layouts.app')
@section('content')
<article class="bg-white p-6 rounded shadow">
  <div class="flex items-start justify-between">
    <h1 class="text-2xl font-semibold">{{ $job->title }}</h1>
    <div class="space-x-2">
      <a href="{{ route('admin.jobs.edit',$job) }}" class="px-3 py-1 border rounded">Edit</a>
      <a href="{{ route('jobs.show',$job->slug) }}" target="_blank" class="px-3 py-1 border rounded">Lihat Publik</a>
    </div>
  </div>

  <div class="mt-2 text-gray-600">
    {{ $job->category->name ?? '-' }} • {{ $job->location->name ?? '-' }} • {{ ucfirst($job->employment_type) }}
  </div>

  <dl class="grid md:grid-cols-2 gap-4 mt-4 text-sm">
    <div>
      <dt class="font-medium">Status</dt>
      <dd class="uppercase">{{ $job->status }}</dd>
    </div>
    <div>
      <dt class="font-medium">Posted At</dt>
      <dd>{{ $job->posted_at ? $job->posted_at->format('Y-m-d H:i') : '-' }}</dd>
    </div>
    <div>
      <dt class="font-medium">Closed At</dt>
      <dd>{{ $job->closed_at ? $job->closed_at->format('Y-m-d H:i') : '-' }}</dd>
    </div>
    <div>
      <dt class="font-medium">Gaji</dt>
      <dd>
        @if(!is_null($job->min_salary) || !is_null($job->max_salary))
          {{ $job->currency }} {{ number_format($job->min_salary) }} - {{ number_format($job->max_salary) }}
        @else - @endif
      </dd>
    </div>
    <div class="md:col-span-2">
      <dt class="font-medium">Apply</dt>
      <dd>
        @if($job->apply_link)
          <a href="{{ $job->apply_link }}" target="_blank" class="text-blue-600 underline">Link</a>
        @elseif($job->contact_email)
          <a href="mailto:{{ $job->contact_email }}?subject=Lamaran: {{ urlencode($job->title) }}" class="text-blue-600 underline">Email</a>
        @else - @endif
      </dd>
    </div>
  </dl>

  @if($job->summary)
    <h2 class="mt-6 font-semibold">Ringkasan</h2>
    <p class="mt-1">{{ $job->summary }}</p>
  @endif

  @if($job->description)
    <h2 class="mt-6 font-semibold">Deskripsi</h2>
    <div class="prose max-w-none">{!! nl2br(e($job->description)) !!}</div>
  @endif

  @if($job->requirements)
    <h2 class="mt-6 font-semibold">Persyaratan</h2>
    <div class="prose max-w-none">{!! nl2br(e($job->requirements)) !!}</div>
  @endif
</article>
@endsection
