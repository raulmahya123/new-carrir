<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Kategori</title>

  @vite(['resources/css/app.css','resources/js/app.js'])

  <style>
    html, body { height: 100%; }
    /* Desktop collapse */
    #sidebar[data-collapsed="true"] { width: 4.25rem; }
    #sidebar[data-collapsed="true"] .brand-text,
    #sidebar[data-collapsed="true"] .nav-label,
    #sidebar[data-collapsed="true"] .nav-divider,
    #sidebar[data-collapsed="true"] .logout-label { display: none; }
    #sidebar[data-collapsed="true"] .nav-link { justify-content: center; padding-left: .5rem; padding-right: .5rem; }

    /* Collapse button pinned at the edge */
    #sidebar .collapse-wrap { position: relative; }
    #btnCollapse { position: absolute; right: -14px; top: 50%; transform: translateY(-50%); }
    #sidebar[data-collapsed="true"] #btnCollapse { right: -14px; }

    /* Toggle icon for collapsed/expanded */
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
          <button id="btnCollapse"
                  class="hidden lg:inline-flex h-9 w-9 items-center justify-center rounded-xl border bg-white shadow-sm hover:bg-sky-50"
                  title="Collapse/Expand sidebar">
            <svg class="icon-expanded w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M11 19l-7-7 7-7M20 19l-7-7 7-7"/>
            </svg>
            <svg class="icon-collapsed w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M13 5l7 7-7 7M4 5l7 7-7 7"/>
            </svg>
          </button>
        </div>

        <!-- Nav -->
        <nav class="space-y-1 text-sm flex-1">
          <a href="{{ route('admin.dashboard') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50">
            <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h6V14h4v6h6V10"/>
            </svg>
            <span class="nav-label">Dashboard</span>
          </a>
          <a href="{{ route('admin.jobs.index') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M10 6h4m-7 4h10M5 10h14v9a2 2 0 01-2 2H7a2 2 0 01-2-2zM9 6a2 2 0 012-2h2a2 2 0 012 2v2H9V6z"/>
            </svg>
            <span class="nav-label">Jobs</span>
          </a>
          <a href="{{ route('admin.categories.index') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50 bg-sky-50">
            <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-width="2" d="M7 7h.01M3 11l8-8 10 10-8 8H3V11z"/>
            </svg>
            <span class="nav-label">Categories</span>
          </a>
          <a href="{{ route('admin.locations.index') }}"
             class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-50">
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
        <!-- Header panel -->
        <div class="rounded-2xl bg-gradient-to-r from-sky-500 to-emerald-500 p-[1px]">
          <div class="rounded-2xl bg-white/70 backdrop-blur px-5 py-4 flex items-center justify-between">
            <div>
              <h1 class="text-xl sm:text-2xl font-semibold tracking-tight">Edit Kategori</h1>
              <p class="text-sm text-slate-600 mt-1">Perbarui nama & slug kategori</p>
            </div>
            <a href="{{ route('admin.categories.index') }}"
               class="px-3 py-2 rounded-xl border bg-white hover:bg-sky-50 text-sm">Kembali</a>
          </div>
        </div>

        <!-- Form -->
        <div class="rounded-2xl p-[1px] bg-gradient-to-br from-sky-300 to-emerald-300">
          <div class="rounded-2xl bg-white/80 backdrop-blur p-5 max-w-xl">
            <form method="POST" action="{{ route('admin.categories.update', $job_category) }}" class="space-y-5">
              @csrf
              @method('PUT')

              <div>
                <label class="block mb-1 font-medium">Nama Kategori</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $job_category->name) }}"
                       class="border rounded-lg w-full p-2.5 focus:outline-none focus:ring-2 focus:ring-sky-400"
                       placeholder="Contoh: Engineering" required>
                @error('name')
                  <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label class="block mb-1 font-medium">Slug</label>
                <input type="text" name="slug" id="slug"
                       value="{{ old('slug', $job_category->slug) }}"
                       class="border rounded-lg w-full p-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                       placeholder="engineering" required>
                <p class="text-xs text-slate-500 mt-1">Slug otomatis dari nama (bisa kamu ubah).</p>
                @error('slug')
                  <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <div class="flex items-center gap-3">
                <button class="px-4 py-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 text-white shadow hover:opacity-90">
                  Update
                </button>
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 rounded-xl border bg-white hover:bg-slate-50">
                  Batal
                </a>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>

  {{-- Drawer (mobile) & Collapse (desktop) + auto-slug --}}
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
    sync(); mq.addEventListener?.('change', sync);

    btnCollapse?.addEventListener('click', () => {
      const isCollapsed = sidebar.getAttribute('data-collapsed') === 'true';
      sidebar.setAttribute('data-collapsed', isCollapsed ? 'false' : 'true');
    });

    // ===== Auto-generate slug dari name =====
    const $name = document.getElementById('name');
    const $slug = document.getElementById('slug');
    function toSlug(v){
      return (v || '')
        .toString()
        .normalize('NFD').replace(/[\u0300-\u036f]/g,'') // diakritik
        .toLowerCase()
        .replace(/[^a-z0-9]+/g,'-')                      // non-alnum -> -
        .replace(/^-+|-+$/g,'')                          // trim -
        .substring(0,120);
    }
    $name?.addEventListener('input', () => {
      if (!$slug.dataset.touched) { $slug.value = toSlug($name.value); }
    });
    $slug?.addEventListener('input', () => { $slug.dataset.touched = '1'; $slug.value = toSlug($slug.value); });

    // Seed awal saat halaman load
    if ($name && $slug && !$slug.value) { $slug.value = toSlug($name.value); }
  </script>
</body>
</html>
