@extends('layouts.app')

@section('content')
<article class="bg-white p-6 rounded shadow">
  <h1 class="text-2xl font-semibold">{{ $job->title }}</h1>
  <div class="text-gray-600 mt-1">
    {{ $job->category->name ?? '-' }} • {{ $job->location->name ?? '-' }} • {{ ucfirst($job->employment_type) }}
    @if($job->posted_at) • Diposting {{ $job->posted_at->format('d M Y') }} @endif
  </div>

  @if($job->summary)
    <p class="mt-4">{{ $job->summary }}</p>
  @endif

  @if($job->description)
    <h2 class="mt-6 font-semibold">Deskripsi</h2>
    <div class="prose max-w-none">{!! nl2br(e($job->description)) !!}</div>
  @endif

  @if($job->requirements)
    <h2 class="mt-6 font-semibold">Persyaratan</h2>
    <div class="prose max-w-none">{!! nl2br(e($job->requirements)) !!}</div>
  @endif

  @if(!is_null($job->min_salary) || !is_null($job->max_salary))
    <h2 class="mt-6 font-semibold">Rentang Gaji</h2>
    <p>{{ $job->currency }} {{ number_format($job->min_salary) }} - {{ number_format($job->max_salary) }}</p>
  @endif

  <div class="mt-6 flex gap-3">
    @if($job->apply_link)
      <a target="_blank" rel="noopener" class="px-4 py-2 rounded bg-blue-600 text-white"
         href="{{ $job->apply_link }}">Apply</a>
    @elseif($job->contact_email)
      <a class="px-4 py-2 rounded border"
         href="mailto:{{ $job->contact_email }}?subject=Lamaran: {{ urlencode($job->title) }}">
        Apply via Email
      </a>
    @endif
  </div>
</article>
@endsection
