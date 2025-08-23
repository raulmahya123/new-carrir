@props(['job'])
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
