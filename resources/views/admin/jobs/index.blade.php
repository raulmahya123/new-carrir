<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jobs</title>

  @vite(['resources/css/app.css','resources/js/app.js'])

  <style>
    html, body { height: 100%; }
    #sidebar[data-collapsed="true"] { width: 4.25rem; }
    #sidebar[data-collapsed="true"] .brand-text,
    #sidebar[data-collapsed="true"] .nav-label,
    #sidebar[data-collapsed="true"] .nav-divider,
    #sidebar[data-collapsed="true"] .logout-label { display:none; }
    #sidebar[data-collapsed="true"] .nav-link { justify-content:center; padding-left:.5rem; padding-right:.5rem; }
    #sidebar[data-collapsed="true"] .dot { margin:0; }
    #sidebar .collapse-wrap { position: relative; }
    #btnCollapse { position: absolute; right: -14px; top: 50%; transform: translateY(-50%); }
    #sidebar[data-collapsed="true"] #btnCollapse { right: -14px; }
    #btnCollapse .icon-collapsed { display:none; }
    #sidebar[data-collapsed="true"] #btnCollapse .icon-expanded { display:none; }
    #sidebar[data-collapsed="true"] #btnCollapse .icon-collapsed { display:inline; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-emerald-50 text-slate-800">
<div class="flex min-h-screen">
  <!-- Sidebar -->
  <aside id="sidebar"
         class="fixed inset-y-0 left-0 z-40 w-64 lg:static lg:translate-x-0
                transform -translate-x-[110%] transition-transform duration-300
                bg-white/85 backdrop-blur border-r border-white/60 shadow-sm flex-shrink-0"
         data-collapsed="false">
    <div class="h-full flex flex-col px-3 pt-4 pb-3">
      <div class="collapse-wrap mb-5">
        <div class="flex items-center gap-3">
          <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-xl object-cover shadow"/>
          <div class="brand-text">
            <div class="font-semibold leading-tight truncate max-w-[9rem]">
              {{ auth()->user()->name ?? 'Admin' }}
            </div>
            <div class="text-xs text-slate-500">AAP Careers</div>
          </div>
        </div>
        <button id="btnCollapse" class="hidden lg:inline-flex h-9 w-9 items-center justify-center rounded-xl border bg-white shadow-sm hover:bg-sky-50"
                title="Collapse/Expand sidebar">
          <svg class="icon-expanded w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-width="2" d="M11 19l-7-7 7-7M20 19l-7-7 7-7"/>
          </svg>
          <svg class="icon-collapsed w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-width="2" d="M13 5l7 7-7 7M4 5l7 7-7 7"/>
          </svg>
        </button>
      </div>

      <nav class="space-y-1 text-sm flex-1">
        <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50">
          <span class="dot h-2 w-2 rounded-full bg-sky-500"></span><span class="nav-label">Dashboard</span>
        </a>
        <a href="{{ route('admin.jobs.index') }}" class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg bg-sky-50">
          <span class="dot h-2 w-2 rounded-full bg-emerald-500"></span><span class="nav-label">Jobs</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50">
          <span class="dot h-2 w-2 rounded-full bg-sky-500"></span><span class="nav-label">Categories</span>
        </a>
        <a href="{{ route('admin.locations.index') }}" class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50">
          <span class="dot h-2 w-2 rounded-full bg-emerald-500"></span><span class="nav-label">Locations</span>
        </a>
        <hr class="nav-divider my-3">
        <a href="{{ route('jobs.index') }}" class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50">
          <span class="dot h-2 w-2 rounded-full bg-sky-400"></span><span class="nav-label">Lihat Situs</span>
        </a>
      </nav>

      <form method="POST" action="{{ route('logout') }}" class="px-2 py-2">
        @csrf
        <button class="flex items-center gap-2 text-red-600 hover:underline text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-width="2" d="M15 12H3m0 0l4-4m-4 4l4 4M21 16V8a2 2 0 00-2-2h-4"/>
          </svg>
          <span class="logout-label">Logout</span>
        </button>
      </form>
    </div>
  </aside>

  <!-- Overlay -->
  <div id="overlay" class="fixed inset-0 z-30 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"></div>

  <!-- Right -->
  <div class="flex-1 flex flex-col min-w-0">
    <!-- Topbar (mobile) -->
    <header class="sticky top-0 z-30 bg-white/70 backdrop-blur border-b px-4 py-3 flex items-center justify-between lg:hidden">
      <div class="flex items-center gap-2">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="h-8 w-8 rounded-lg object-cover">
        <span class="font-semibold truncate max-w-[10rem]">{{ auth()->user()->name ?? 'Admin' }}</span>
      </div>
      <button id="btnSidebar" class="p-2 rounded-md border bg-white hover:bg-sky-50" title="Open menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </header>

    <!-- Content -->
    <main class="p-4 sm:p-6 space-y-6">
      <div class="rounded-2xl bg-gradient-to-r from-sky-500 to-emerald-500 p-[1px]">
        <div class="rounded-2xl bg-white/70 backdrop-blur px-5 py-4">
          <h1 class="text-xl sm:text-2xl font-semibold tracking-tight">Jobs</h1>
          <p class="text-sm text-slate-600 mt-1">Kelola daftar lowongan pekerjaan</p>
        </div>
      </div>

      <!-- Filter + Tambah -->
      <div class="flex items-center justify-between mb-4">
        <form method="GET" class="flex flex-wrap gap-2">
          <input name="q" value="{{ request('q') }}" placeholder="Cari judul..." class="border p-2 rounded">
          <select name="status" class="border p-2 rounded">
            <option value="">Semua Status</option>
            @foreach(['draft'=>'Draft','open'=>'Open','closed'=>'Closed'] as $k=>$v)
              <option value="{{ $k }}" @selected(request('status')===$k)>{{ $v }}</option>
            @endforeach
          </select>
          <button class="px-3 py-2 border rounded bg-white hover:bg-sky-50">Filter</button>
        </form>

        <a href="{{ route('admin.jobs.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">
          + Tambah Job
        </a>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto bg-white/80 backdrop-blur rounded-xl shadow">
        <table class="w-full border-collapse text-sm">
          <thead>
            <tr class="bg-gray-100">
              <th class="p-2 border text-left">Judul</th>
              <th class="p-2 border">Kategori</th>
              <th class="p-2 border">Lokasi</th>
              <th class="p-2 border">Tipe</th>
              <th class="p-2 border">Status</th>
              <th class="p-2 border">Posted</th>
              <th class="p-2 border">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($jobs as $job)
            <tr>
              <td class="p-2 border">
                <a href="{{ route('admin.jobs.show',$job) }}" class="font-medium text-sky-700 hover:underline">{{ $job->title }}</a>
                <div class="text-gray-500 text-xs">{{ $job->slug }}</div>
              </td>
              <td class="p-2 border">{{ $job->category->name ?? '-' }}</td>
              <td class="p-2 border">{{ $job->location->name ?? '-' }}</td>
              <td class="p-2 border capitalize">{{ $job->employment_type }}</td>
              <td class="p-2 border uppercase">{{ $job->status }}</td>
              <td class="p-2 border">
                @if($job->posted_at) {{ $job->posted_at->format('Y-m-d H:i') }} @else - @endif
              </td>
              <td class="p-2 border whitespace-nowrap">
                <a href="{{ route('admin.jobs.edit',$job) }}" class="px-2 text-blue-600">Edit</a>
                <form method="POST" action="{{ route('admin.jobs.destroy',$job) }}" class="inline">
                  @csrf @method('DELETE')
                  <button onclick="return confirm('Hapus job ini?')" class="px-2 text-red-600">Hapus</button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="7" class="p-4 text-center text-gray-500">Belum ada data.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-4">{{ $jobs->links() }}</div>
    </main>
  </div>
</div>

<script>
  const btnDrawer = document.getElementById('btnSidebar');
  const btnCollapse = document.getElementById('btnCollapse');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');

  function openDrawer(){ sidebar.classList.remove('-translate-x-[110%]'); overlay?.classList.remove('pointer-events-none'); overlay?.classList.add('opacity-100'); }
  function closeDrawer(){ sidebar.classList.add('-translate-x-[110%]'); overlay?.classList.add('pointer-events-none'); overlay?.classList.remove('opacity-100'); }
  btnDrawer?.addEventListener('click', () => { const hidden = sidebar.classList.contains('-translate-x-[110%]'); hidden ? openDrawer() : closeDrawer(); });
  overlay?.addEventListener('click', closeDrawer);

  const mq = window.matchMedia('(min-width: 1024px)');
  const sync = () => { mq.matches ? openDrawer() : closeDrawer(); };
  sync(); mq.addEventListener?.('change', sync);

  btnCollapse?.addEventListener('click', () => {
    const isCollapsed = sidebar.getAttribute('data-collapsed') === 'true';
    sidebar.setAttribute('data-collapsed', isCollapsed ? 'false' : 'true');
  });
</script>
</body>
</html>
