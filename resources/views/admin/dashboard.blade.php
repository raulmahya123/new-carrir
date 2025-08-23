<!doctype html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Dashboard</title>

  {{-- Tailwind + Vite --}}
  @vite(['resources/css/app.css','resources/js/app.js','resources/js/admin/dashboard.js'])

  {{-- CDN Chart.js & Leaflet (global) --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="anonymous"/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin="anonymous"></script>

  <style>
    html, body { height: 100%; }

    /* Desktop collapse: kecilkan width & sembunyikan label */
    #sidebar[data-collapsed="true"] { width: 4.25rem; }
    #sidebar[data-collapsed="true"] .brand-text,
    #sidebar[data-collapsed="true"] .nav-label,
    #sidebar[data-collapsed="true"] .nav-divider,
    #sidebar[data-collapsed="true"] .logout-label { display: none; }
    #sidebar[data-collapsed="true"] .nav-link { justify-content: center; padding-left: .5rem; padding-right: .5rem; }

    /* Tombol collapse menempel tepi kanan sidebar */
    #sidebar .collapse-wrap { position: relative; }
    #btnCollapse { position: absolute; right: -14px; top: 50%; transform: translateY(-50%); }
    #sidebar[data-collapsed="true"] #btnCollapse { right: -14px; }

    /* Ikon collapse ↔ expand */
    #btnCollapse .icon-collapsed { display: none; }
    #sidebar[data-collapsed="true"] #btnCollapse .icon-expanded { display: none; }
    #sidebar[data-collapsed="true"] #btnCollapse .icon-collapsed { display: inline; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-emerald-50 text-slate-800">

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-40 w-64 lg:static lg:translate-x-0
                  transform -translate-x-[110%] transition-transform duration-300
                  bg-white/90 backdrop-blur border-r border-white/60 shadow-sm flex-shrink-0"
           data-collapsed="false">
      <div class="h-full flex flex-col px-3 pt-4 pb-3">
        <!-- Brand + collapse -->
        <div class="collapse-wrap mb-5">
          <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo"
                 class="h-10 w-10 rounded-xl object-cover shadow"/>
            <div class="brand-text">
              <div class="font-semibold leading-tight truncate max-w-[9rem]">
                {{ auth()->user()->name ?? 'Admin' }}
              </div>
              <div class="text-xs text-slate-500">AAP Careers</div>
            </div>
          </div>
          <!-- tombol collapse (absolute di tepi, desktop only) -->
          <button id="btnCollapse"
                  class="hidden lg:inline-flex h-9 w-9 items-center justify-center rounded-xl border bg-white shadow-sm hover:bg-sky-50"
                  title="Collapse/Expand sidebar">
            <!-- saat expanded: « -->
            <svg class="icon-expanded w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M11 19l-7-7 7-7M20 19l-7-7 7-7"/>
            </svg>
            <!-- saat collapsed: » -->
            <svg class="icon-collapsed w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M13 5l7 7-7 7M4 5l7 7-7 7"/>
            </svg>
          </button>
        </div>

        <!-- Nav -->
        <nav class="space-y-1 text-sm flex-1">
          <a href="{{ route('admin.dashboard') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50 {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50' : '' }}">
            <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h6V14h4v6h6V10"/>
            </svg>
            <span class="nav-label">Dashboard</span>
          </a>

          <a href="{{ route('admin.jobs.index') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50 {{ request()->routeIs('admin.jobs.*') ? 'bg-sky-50' : '' }}">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M10 6h4m-7 4h10M5 10h14v9a2 2 0 01-2 2H7a2 2 0 01-2-2zM9 6a2 2 0 012-2h2a2 2 0 012 2v2H9V6z"/>
            </svg>
            <span class="nav-label">Jobs</span>
          </a>

          <a href="{{ route('admin.categories.index') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50 {{ request()->routeIs('admin.categories.*') ? 'bg-sky-50' : '' }}">
            <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M7 7h.01M3 11l8-8 10 10-8 8H3V11z"/>
            </svg>
            <span class="nav-label">Categories</span>
          </a>

          <a href="{{ route('admin.locations.index') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50 {{ request()->routeIs('admin.locations.*') ? 'bg-sky-50' : '' }}">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M12 11a3 3 0 100-6 3 3 0 000 6z"/><path stroke-linecap="round" stroke-width="2" d="M12 22s8-4.5 8-12a8 8 0 10-16 0c0 7.5 8 12 8 12z"/>
            </svg>
            <span class="nav-label">Locations</span>
          </a>

          <hr class="nav-divider my-3">

          <a href="{{ route('jobs.index') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50">
            <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M14 3h7m0 0v7m0-7L10 14"/><path stroke-linecap="round" stroke-width="2" d="M5 7v11a2 2 0 002 2h11"/>
            </svg>
            <span class="nav-label">Lihat Situs</span>
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

    <!-- Overlay (mobile) -->
    <div id="overlay"
         class="fixed inset-0 z-30 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"></div>

    <!-- Right column -->
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
          <div class="rounded-2xl bg-white/70 backdrop-blur px-5 py-4 flex items-center justify-between">
            <div>
              <h1 class="text-xl sm:text-2xl font-semibold tracking-tight">Dashboard</h1>
              <p class="text-sm text-slate-600 mt-1">Ringkasan performa lowongan & lokasi operasional</p>
            </div>
            <div class="hidden sm:flex items-center gap-2">
              <span class="px-3 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-700">Gen-Z</span>
              <span class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Blue × Green</span>
            </div>
          </div>
        </div>

        {{-- Cards --}}
        <div class="grid md:grid-cols-4 gap-4">
          @php
            $cards = [
              ['label'=>'TOTAL JOBS','value'=>$stats['total'] ?? 0],
              ['label'=>'OPEN','value'=>$stats['open'] ?? 0],
              ['label'=>'DRAFT','value'=>$stats['draft'] ?? 0],
              ['label'=>'CLOSED','value'=>$stats['closed'] ?? 0],
            ];
          @endphp
          @foreach($cards as $c)
            <div class="rounded-2xl p-[1px] bg-gradient-to-br from-sky-300 to-emerald-300">
              <div class="rounded-2xl bg-white/80 backdrop-blur p-4">
                <div class="text-xs tracking-wide text-slate-500">{{ $c['label'] }}</div>
                <div class="mt-1 text-3xl font-semibold">{{ $c['value'] }}</div>
              </div>
            </div>
          @endforeach
        </div>

        {{-- Charts --}}
        <div class="grid lg:grid-cols-2 gap-6">
          <div class="rounded-2xl p-[1px] bg-gradient-to-br from-sky-300 to-emerald-300">
            <div class="rounded-2xl bg-white/80 backdrop-blur p-4">
              <div class="font-medium mb-2 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-sky-500"></span> Jobs by Status
              </div>
              <div class="h-60"><canvas id="chartStatus"></canvas></div>
            </div>
          </div>
          <div class="rounded-2xl p-[1px] bg-gradient-to-br from-emerald-300 to-sky-300">
            <div class="rounded-2xl bg-white/80 backdrop-blur p-4">
              <div class="font-medium mb-2 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Top Categories
              </div>
              <div class="h-60"><canvas id="chartCategory"></canvas></div>
            </div>
          </div>
        </div>

        {{-- Map --}}
        <div class="rounded-2xl p-[1px] bg-gradient-to-r from-sky-300 to-emerald-300">
          <div class="rounded-2xl bg-white/80 backdrop-blur p-4">
            <div class="font-medium mb-2 flex items-center gap-2">
              <span class="h-2 w-2 rounded-full bg-sky-500"></span> Peta Lokasi Operasional
            </div>
            <div id="map" class="rounded-xl overflow-hidden" style="height:420px;"></div>
          </div>
        </div>
      </main>
    </div>
  </div>

  {{-- ===== Data untuk JS eksternal (JSON valid) ===== --}}
  @php
    $DASHBOARD = [
      'statusLabels' => $chart['statusLabels'] ?? [],
      'statusCounts' => $chart['statusCounts'] ?? [],
      'catLabels'    => $chart['catLabels']    ?? [],
      'catCounts'    => $chart['catCounts']    ?? [],
      'locations'    => $locations             ?? [],
    ];
  @endphp
  <script id="dashboard-data" type="application/json">
    {!! json_encode($DASHBOARD, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
  </script>

  {{-- Drawer (mobile) & Collapse (desktop) --}}
  <script>
    const btnDrawer   = document.getElementById('btnSidebar');
    const btnCollapse = document.getElementById('btnCollapse');
    const sidebar     = document.getElementById('sidebar');
    const overlay     = document.getElementById('overlay');

    function openDrawer(){
      sidebar.classList.remove('-translate-x-[110%]');
      overlay?.classList.remove('pointer-events-none');
      overlay?.classList.add('opacity-100');
    }
    function closeDrawer(){
      sidebar.classList.add('-translate-x-[110%]');
      overlay?.classList.add('pointer-events-none');
      overlay?.classList.remove('opacity-100');
    }

    btnDrawer?.addEventListener('click', () => {
      const hidden = sidebar.classList.contains('-translate-x-[110%]');
      hidden ? openDrawer() : closeDrawer();
    });
    overlay?.addEventListener('click', closeDrawer);

    const mq = window.matchMedia('(min-width: 1024px)');
    const sync = () => { mq.matches ? openDrawer() : closeDrawer(); };
    sync();
    mq.addEventListener?.('change', sync);

    // Collapse: toggle atribut data-collapsed (desktop)
    btnCollapse?.addEventListener('click', () => {
      const isCollapsed = sidebar.getAttribute('data-collapsed') === 'true';
      sidebar.setAttribute('data-collapsed', isCollapsed ? 'false' : 'true');
    });
  </script>
</body>
</html>
