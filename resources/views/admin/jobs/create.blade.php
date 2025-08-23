<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Job</title>

  @vite(['resources/css/app.css','resources/js/app.js'])

  <style>
    html, body { height: 100%; }
    /* Sidebar collapse (desktop) */
    #sidebar[data-collapsed="true"] { width: 4.25rem; }
    #sidebar[data-collapsed="true"] .brand-text,
    #sidebar[data-collapsed="true"] .nav-label,
    #sidebar[data-collapsed="true"] .nav-divider,
    #sidebar[data-collapsed="true"] .logout-label { display:none; }
    #sidebar[data-collapsed="true"] .nav-link { justify-content:center; padding-left:.5rem; padding-right:.5rem; }
    #sidebar[data-collapsed="true"] .dot { margin:0; }
    /* Collapse button pinned */
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

  <!-- Overlay (mobile) -->
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

      {{-- ALERT AREA (success/error) --}}
      @if (session('success') || session('ok') || session('error'))
        <div id="inline-alert" class="rounded-xl border p-3
             {{ session('error') ? 'bg-red-50 border-red-200 text-red-800' : 'bg-emerald-50 border-emerald-200 text-emerald-800' }}">
          {{ session('success') ?? session('ok') ?? session('error') }}
        </div>
      @endif

      @if ($errors->any())
        <div id="banner-check" class="rounded-xl border border-red-200 bg-red-50 text-red-800 p-3">
          <div class="font-medium mb-1">Cek lagi data kamu:</div>
          <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Toast (floating, auto-dismiss) -->
      <div id="toast"
           class="fixed right-4 top-4 z-50 hidden px-4 py-3 rounded-xl shadow
                  bg-emerald-600 text-white text-sm">
        <span id="toast-text"></span>
      </div>

      <!-- Header -->
      <div class="rounded-2xl bg-gradient-to-r from-sky-500 to-emerald-500 p-[1px]">
        <div class="rounded-2xl bg-white/70 backdrop-blur px-5 py-4 flex items-center justify-between">
          <div>
            <h1 class="text-xl sm:text-2xl font-semibold tracking-tight">Tambah Job</h1>
            <p class="text-sm text-slate-600 mt-1">Buat lowongan pekerjaan baru</p>
          </div>
          <a href="{{ route('admin.jobs.index') }}"
             class="px-3 py-2 rounded-xl border bg-white hover:bg-sky-50 text-sm">Kembali</a>
        </div>
      </div>

      <!-- Form -->
      <form method="POST" action="{{ route('admin.jobs.store') }}" class="grid lg:grid-cols-3 gap-6">
        @csrf

        <!-- Left: fields -->
        <div class="lg:col-span-2 space-y-5">
          <div class="rounded-2xl p-[1px] bg-gradient-to-br from-sky-300 to-emerald-300">
            <div class="rounded-2xl bg-white/80 backdrop-blur p-5 space-y-5">
              <div class="grid sm:grid-cols-2 gap-4">
                <div>
                  <label class="block mb-1 font-medium">Judul</label>
                  <input type="text" name="title" id="title"
                         value="{{ old('title') }}"
                         class="w-full border p-2.5 rounded focus:outline-none focus:ring-2 focus:ring-sky-400" required>
                  @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                  <label class="block mb-1 font-medium">Slug</label>
                  <input type="text" name="slug" id="slug"
                         value="{{ old('slug') }}"
                         class="w-full border p-2.5 rounded focus:outline-none focus:ring-2 focus:ring-emerald-400" required>
                  <p class="text-xs text-slate-500 mt-1">Otomatis dari judul (bisa diubah).</p>
                  @error('slug')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
              </div>

              <div class="grid sm:grid-cols-3 gap-4">
                <div>
                  <label class="block mb-1 font-medium">Kategori</label>
                  <select name="job_category_id" class="w-full border p-2.5 rounded">
                    <option value="">- pilih -</option>
                    @foreach($categories as $c)
                      <option value="{{ $c->id }}" @selected(old('job_category_id')==$c->id)>{{ $c->name }}</option>
                    @endforeach
                  </select>
                  @error('job_category_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                  <label class="block mb-1 font-medium">Lokasi</label>
                  <select name="location_id" class="w-full border p-2.5 rounded">
                    <option value="">- pilih -</option>
                    @foreach($locations as $l)
                      <option value="{{ $l->id }}" @selected(old('location_id')==$l->id)>{{ $l->name }}</option>
                    @endforeach
                  </select>
                  @error('location_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                  <label class="block mb-1 font-medium">Tipe Kerja</label>
                  <select name="employment_type" class="w-full border p-2.5 rounded">
                    @foreach(['fulltime'=>'Fulltime','contract'=>'Contract','intern'=>'Intern','freelance'=>'Freelance'] as $k=>$v)
                      <option value="{{ $k }}" @selected(old('employment_type','fulltime')===$k)>{{ $v }}</option>
                    @endforeach
                  </select>
                  @error('employment_type')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
              </div>

              <div>
                <label class="block mb-1 font-medium">Ringkasan Singkat</label>
                <textarea name="summary" rows="3"
                          class="w-full border p-2.5 rounded focus:outline-none focus:ring-2 focus:ring-sky-400"
                          placeholder="Ringkas deskripsi peran">{{ old('summary') }}</textarea>
                @error('summary')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
              </div>

              <div class="grid sm:grid-cols-2 gap-4">
                <div>
                  <label class="block mb-1 font-medium">Deskripsi Pekerjaan</label>
                  <textarea name="description" rows="8"
                            class="w-full border p-2.5 rounded focus:outline-none focus:ring-2 focus:ring-sky-400"
                            placeholder="Tugas & tanggung jawab">{{ old('description') }}</textarea>
                  @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                  <label class="block mb-1 font-medium">Persyaratan</label>
                  <textarea name="requirements" rows="8"
                            class="w-full border p-2.5 rounded focus:outline-none focus:ring-2 focus:ring-emerald-400"
                            placeholder="Kualifikasi & pengalaman">{{ old('requirements') }}</textarea>
                  @error('requirements')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
              </div>
            </div>
          </div>

          <div class="rounded-2xl p-[1px] bg-gradient-to-br from-emerald-300 to-sky-300">
            <div class="rounded-2xl bg-white/80 backdrop-blur p-5 space-y-5">
              <div class="grid sm:grid-cols-4 gap-4">
                <div class="sm:col-span-2">
                  <label class="block mb-1 font-medium">Gaji Minimum</label>
                  <input type="number" name="min_salary" min="0"
                         value="{{ old('min_salary') }}"
                         class="w-full border p-2.5 rounded" placeholder="0">
                  @error('min_salary')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="sm:col-span-2">
                  <label class="block mb-1 font-medium">Gaji Maksimum</label>
                  <input type="number" name="max_salary" min="0"
                         value="{{ old('max_salary') }}"
                         class="w-full border p-2.5 rounded" placeholder="0">
                  @error('max_salary')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="sm:col-span-2">
                  <label class="block mb-1 font-medium">Mata Uang</label>
                  <input type="text" name="currency" value="{{ old('currency','IDR') }}"
                         class="w-full border p-2.5 rounded" placeholder="IDR">
                  @error('currency')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="sm:col-span-2">
                  <label class="block mb-1 font-medium">Status</label>
                  <select name="status" class="w-full border p-2.5 rounded">
                    @foreach(['draft'=>'Draft','open'=>'Open','closed'=>'Closed'] as $k=>$v)
                      <option value="{{ $k }}" @selected(old('status','draft')===$k)>{{ $v }}</option>
                    @endforeach
                  </select>
                  @error('status')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
              </div>

              <div class="grid sm:grid-cols-2 gap-4">
                <div>
                  <label class="block mb-1 font-medium">Posted At</label>
                  <input type="datetime-local" name="posted_at"
                         value="{{ old('posted_at') }}"
                         class="w-full border p-2.5 rounded">
                  @error('posted_at')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                  <label class="block mb-1 font-medium">Closed At</label>
                  <input type="datetime-local" name="closed_at"
                         value="{{ old('closed_at') }}"
                         class="w-full border p-2.5 rounded">
                  @error('closed_at')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: meta -->
        <div class="space-y-5">
          <div class="rounded-2xl p-[1px] bg-gradient-to-br from-sky-300 to-emerald-300">
            <div class="rounded-2xl bg-white/80 backdrop-blur p-5 space-y-4">
              <div>
                <label class="block mb-1 font-medium">Apply Link (URL)</label>
                <input type="url" name="apply_link"
                       value="{{ old('apply_link') }}"
                       class="w-full border p-2.5 rounded"
                       placeholder="https://forms.gle/...">
                @error('apply_link')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
              </div>
              <div>
                <label class="block mb-1 font-medium">Contact Email</label>
                <input type="email" name="contact_email"
                       value="{{ old('contact_email') }}"
                       class="w-full border p-2.5 rounded"
                       placeholder="hr@example.com">
                @error('contact_email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
              </div>

              <div class="flex gap-2 pt-2">
                <button type="button" id="btnSave"
                        class="px-4 py-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 text-white shadow hover:opacity-90">
                  Simpan
                </button>
                <a href="{{ route('admin.jobs.index') }}" class="px-4 py-2 rounded-xl border bg-white hover:bg-slate-50">
                  Batal
                </a>
              </div>
            </div>
          </div>

          <div class="rounded-2xl p-[1px] bg-gradient-to-br from-emerald-300 to-sky-300">
            <div class="rounded-2xl bg-white/80 backdrop-blur p-5">
              <div class="text-sm text-slate-600">
                <div>Slug unik & wajib diisi.</div>
                <div>Set <strong>status</strong> ke <strong>open</strong> agar tampil di publik.</div>
                <div>Isi <strong>posted_at</strong> untuk jadwal rilis & pengurutan.</div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </main>
  </div>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmModal"
     class="fixed inset-0 z-50 hidden items-center justify-center">
  <!-- backdrop -->
  <div class="absolute inset-0 bg-black/50"></div>

  <!-- card -->
  <div class="relative bg-white rounded-2xl shadow-xl w-[90%] max-w-md p-5">
    <div class="text-lg font-semibold">Apakah Anda Sudah Yakin</div>
    <p class="text-sm text-slate-600 mt-1">Pastikan data sudah benar. Lanjut simpan?</p>

    <!-- warning 'cek lagi' -->
    <div id="precheckWarn" class="hidden mt-3 rounded-lg border border-amber-200 bg-amber-50 text-amber-800 px-3 py-2 text-sm">
      Ada kolom wajib yang belum diisi. Cek lagi ya.
    </div>

    <div class="mt-4 flex justify-end gap-2">
      <button type="button" id="btnNo"
        class="px-3 py-2 rounded-lg border bg-white hover:bg-slate-50">Tidak</button>
      <button type="button" id="btnYes"
        class="px-3 py-2 rounded-lg bg-gradient-to-r from-sky-500 to-emerald-500 text-white">Ya, Simpan</button>
    </div>
  </div>
</div>

<!-- Drawer (mobile) & Collapse (desktop) + Auto-slug + Toast + Modal -->
<script>
  const btnDrawer   = document.getElementById('btnSidebar');
  const btnCollapse = document.getElementById('btnCollapse');
  const sidebar     = document.getElementById('sidebar');
  const overlay     = document.getElementById('overlay');

  function openDrawer(){ sidebar.classList.remove('-translate-x-[110%]'); overlay?.classList.remove('pointer-events-none'); overlay?.classList.add('opacity-100'); }
  function closeDrawer(){ sidebar.classList.add('-translate-x-[110%]'); overlay?.classList.add('pointer-events-none'); overlay?.classList.remove('opacity-100'); }
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

  // Auto-generate slug dari Judul
  const $title = document.getElementById('title');
  const $slug  = document.getElementById('slug');
  function toSlug(v){
    return (v||'').toString()
      .normalize('NFD').replace(/[\u0300-\u036f]/g,'')
      .toLowerCase()
      .replace(/[^a-z0-9]+/g,'-')
      .replace(/^-+|-+$/g,'')
      .substring(0,140);
  }
  $title?.addEventListener('input', ()=>{
    if (!$slug.dataset.touched) $slug.value = toSlug($title.value);
  });
  $slug?.addEventListener('input', ()=>{
    $slug.dataset.touched = '1';
    $slug.value = toSlug($slug.value);
  });

  // Toast dari inline alert (optional)
  (function(){
    const toast = document.getElementById('toast');
    const toastText = document.getElementById('toast-text');
    const inline = document.getElementById('inline-alert');
    if (inline) {
      toastText.textContent = inline.textContent.trim();
      toast.classList.remove('hidden');
      setTimeout(()=> toast.classList.add('hidden'), 3000);
    }
  })();

  // Modal Konfirmasi & Pre-check
  const btnSave = document.getElementById('btnSave');
  const modal   = document.getElementById('confirmModal');
  const btnYes  = document.getElementById('btnYes');
  const btnNo   = document.getElementById('btnNo');
  const preWarn = document.getElementById('precheckWarn');
  const form    = document.querySelector('form[action*="admin/jobs"][method="POST"]');

  function openModal(){ modal.classList.remove('hidden'); modal.classList.add('flex'); }
  function closeModal(){ modal.classList.add('hidden'); modal.classList.remove('flex'); }

  function precheck() {
    const title = document.getElementById('title')?.value?.trim();
    const slug  = document.getElementById('slug')?.value?.trim();
    const cat   = document.querySelector('select[name="job_category_id"]')?.value;
    const loc   = document.querySelector('select[name="location_id"]')?.value;
    const type  = document.querySelector('select[name="employment_type"]')?.value;

    const notOk = !title || !slug || !cat || !loc || !type;
    preWarn.classList.toggle('hidden', !notOk);
    return !notOk;
  }

  btnSave?.addEventListener('click', () => {
    openModal();
    precheck(); // tampilkan “cek lagi” bila kosong
  });

  btnNo?.addEventListener('click', () => closeModal());

  btnYes?.addEventListener('click', () => {
    if (!precheck()) return; // masih ada kosong → jangan submit
    form?.submit();
  });

  // Tutup modal saat klik backdrop
  modal?.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });
</script>
</body>
</html>
