<!doctype html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? 'Karir • AAP Mining' }}</title>
    <meta name="description" content="Karir di AAP Mining — perusahaan pertambangan batubara & nikel. Jelajahi lowongan, lokasi tambang, benefit, dan proses rekrutmen. Apply via email/Google Form/Job Portal.">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50 text-slate-900 flex flex-col">
    <!-- Skip link -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-white border px-3 py-1 rounded shadow">Lewati ke konten</a>

    <!-- NAVBAR -->
    <nav id="site-nav" class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b">
        <div class="max-w-7xl mx-auto px-4 lg:px-6 py-3 flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="flex items-center gap-3" aria-label="Beranda AAP Mining Careers">
                <img
                    src="{{ asset('assets/images/logo.jpg') }}"
                    alt="Logo AAP Mining"
                    class="h-9 w-9 object-contain rounded-md bg-white p-1 shadow-sm">
                <span class="font-semibold tracking-tight">AAP Mining • Careers</span>
            </a>


            <div class="hidden md:flex items-center gap-2">
                <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-700 transition">Home</a>
                <a href="{{ route('jobs.index') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-700 transition">Lowongan</a>
                <a href="#about-mining" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-700 transition">Tentang</a>
                <a href="#benefits" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-700 transition">Benefit</a>
                <a href="#process" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-700 transition">Proses</a>

                <!-- @auth
          @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-700 transition">Admin</a>
          @endif
        @endauth

        <span class="mx-2 h-6 w-px bg-slate-200"></span>

        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-3 py-2 rounded-lg border border-slate-200 hover:border-emerald-400 hover:bg-emerald-500/10 transition">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg border border-slate-200 hover:border-emerald-400 hover:bg-emerald-500/10 transition">Login</a>
        @endauth  -->
            </div>

            <button id="nav-toggle" class="md:hidden h-10 w-10 grid place-items-center rounded-lg border border-slate-200 hover:bg-emerald-500/10 transition" aria-label="Buka menu">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile -->
        <div id="mobile-menu" class="hidden md:hidden border-t bg-white/90 backdrop-blur">
            <div class="px-4 pb-4 flex flex-col gap-2">
                <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10">Home</a>
                <a href="{{ route('jobs.index') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10">Lowongan</a>
                <a href="#about-mining" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10">Tentang</a>
                <a href="#benefits" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10">Benefit</a>
                <a href="#process" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10">Proses</a>

                <!-- @auth
          @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-500/10">Admin</a>
          @endif
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-3 py-2 rounded-lg border border-slate-200 hover:border-emerald-400 hover:bg-emerald-500/10 transition">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg border border-slate-200 hover:border-emerald-400 hover:bg-emerald-500/10 transition">Login</a>
        @endauth -->
            </div>
        </div>
    </nav>

    <!-- HERO (Mining) -->
    <header class="bg-gradient-to-b from-emerald-50 to-sky-50 border-b">
        <div class="max-w-7xl mx-auto px-4 lg:px-6 py-12 md:py-16 grid md:grid-cols-12 gap-10 items-center">
            <div class="md:col-span-6">
                <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">
                    Bangun Kariermu di
                    <span class="text-emerald-700">AAP Mining</span>
                </h1>
                <p class="mt-4 text-slate-700 md:text-lg">
                    Perusahaan pertambangan <b>batubara</b> & <b>nikel</b> dengan operasi di berbagai site.
                    Eksplorasi, produksi, hingga logistik—kami mencari talenta terbaik untuk tumbuh bersama.
                </p>

                <!-- Quick stats -->
                <dl class="mt-8 grid grid-cols-3 gap-5">
                    <div class="bg-white/70 backdrop-blur rounded-xl p-4 border text-center">
                        <dt class="text-xs tracking-wide text-slate-500">Site Aktif</dt>
                        <dd class="text-2xl font-bold">7+</dd>
                    </div>
                    <div class="bg-white/70 backdrop-blur rounded-xl p-4 border text-center">
                        <dt class="text-xs tracking-wide text-slate-500">Armada</dt>
                        <dd class="text-2xl font-bold">300+</dd>
                    </div>
                    <div class="bg-white/70 backdrop-blur rounded-xl p-4 border text-center">
                        <dt class="text-xs tracking-wide text-slate-500">Karyawan</dt>
                        <dd class="text-2xl font-bold">2.000+</dd>
                    </div>
                </dl>
            </div>

            <div class="md:col-span-6">
                <div class="relative">
                    <img src="{{ asset('assets/images/foto1.jpg') }}" alt="Operasi tambang AAP" class="w-full h-72 md:h-[22rem] object-cover rounded-2xl border shadow-sm" loading="eager" width="1400" height="900" />
                    <div class="absolute -z-10 -right-6 -top-6 w-40 h-40 bg-emerald-200/40 blur-3xl rounded-full"></div>
                </div>
            </div>
        </div>
    </header>

    <!-- HIGHLIGHT ROLES -->
    <section class="max-w-7xl mx-auto px-4 lg:px-6 py-12" id="about-mining">
        <h2 class="text-2xl md:text-3xl font-semibold">Bidang & Peran Unggulan</h2>
        <p class="mt-2 text-slate-700">Kami membuka peluang di hulu–hilir pertambangan batubara & nikel.</p>

        <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <article class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-semibold">Operasi Tambang</div>
                <p class="text-sm text-slate-600 mt-1">Operator Alat Berat (Excavator, Dozer, HD), Dispatch, Pit Control.</p>
            </article>
            <article class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-semibold">Teknik & Geologi</div>
                <p class="text-sm text-slate-600 mt-1">Mine Engineer, Geologist, Surveyor, Short/Long Term Planner.</p>
            </article>
            <article class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-semibold">Perawatan & Workshop</div>
                <p class="text-sm text-slate-600 mt-1">Mechanic, Electrician, Tyreman, Maintenance Planner.</p>
            </article>
            <article class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-semibold">Keselamatan & Lingkungan</div>
                <p class="text-sm text-slate-600 mt-1">K3 (HSE), Environment, Reclamation & Rehabilitation.</p>
            </article>
            <article class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-semibold">Supply Chain & Logistik</div>
                <p class="text-sm text-slate-600 mt-1">Fuel, Warehouse, Hauling, Port/Jetty Operation.</p>
            </article>
            <article class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-semibold">Pendukung Operasi</div>
                <p class="text-sm text-slate-600 mt-1">HR/GA, IT, Finance, Procurement, Community Development.</p>
            </article>
        </div>
    </section>

    {{-- LOCATIONS (pakai field: name, region, country, lat, lng) --}}
    <section class="max-w-7xl mx-auto px-4 lg:px-6 py-12" id="locations">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-semibold">Lokasi Operasional</h2>
                <p class="mt-2 text-slate-700">Site tambang batubara & nikel AAP Mining.</p>
            </div>
        </div>

        <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @forelse($locations as $loc)
            @php
            $hasCoord = !is_null($loc->lat) && !is_null($loc->lng);
            $map = $hasCoord ? "https://www.google.com/maps?q={$loc->lat},{$loc->lng}" : null;
            @endphp

            <article class="group relative bg-white border rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-semibold flex items-center gap-2">
                            <svg class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 21s-6-4.35-6-10a6 6 0 1112 0c0 5.65-6 10-6 10z" />
                                <circle cx="12" cy="11" r="2.5" stroke-width="1.8" />
                            </svg>
                            {{ $loc->name }}
                        </h3>
                        @if(!empty($loc->region))
                        <p class="text-sm text-slate-600">{{ $loc->region }}</p>
                        @endif
                    </div>

                    <span class="inline-flex items-center text-xs font-medium px-2 py-1 rounded-full border bg-slate-50 text-slate-700 border-slate-200">
                        {{ $loc->country ?? 'ID' }}
                    </span>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                    <div class="bg-slate-50 border rounded-lg p-3">
                        <div class="text-[10px] uppercase tracking-wide text-slate-500">Latitude</div>
                        <div class="font-semibold">{{ $hasCoord ? number_format($loc->lat, 6) : '—' }}</div>
                    </div>
                    <div class="bg-slate-50 border rounded-lg p-3">
                        <div class="text-[10px] uppercase tracking-wide text-slate-500">Longitude</div>
                        <div class="font-semibold">{{ $hasCoord ? number_format($loc->lng, 6) : '—' }}</div>
                    </div>
                </div>

                <div class="mt-4">
                    @if($map)
                    <a href="{{ $map }}" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-1 text-sm font-medium text-emerald-700 hover:underline">
                        Buka di Google Maps
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M7 17l10-10M14 7h3V4" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M5 7v10a2 2 0 002 2h10" />
                        </svg>
                    </a>
                    @else
                    <span class="text-xs text-slate-500">Koordinat belum tersedia</span>
                    @endif
                </div>
            </article>
            @empty
            <div class="col-span-full">
                <div class="p-6 border rounded-xl bg-slate-50 text-slate-600">
                    Belum ada data lokasi. Tambahkan data di Admin terlebih dahulu.
                </div>
            </div>
            @endforelse
        </div>
    </section>
{{-- CATEGORIES --}}
<section class="max-w-7xl mx-auto px-4 lg:px-6 py-12" id="categories">
  <div class="flex items-end justify-between gap-4">
    <div>
      <h2 class="text-2xl md:text-3xl font-semibold">Kategori Lowongan</h2>
      <p class="mt-2 text-slate-700">Jelajahi posisi berdasarkan kategori fungsi.</p>
    </div>
  </div>

  <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @forelse($categories as $cat)
      <a href="{{ route('jobs.index', ['category' => $cat->slug]) }}"
         class="group bg-white border rounded-xl p-5 shadow-sm hover:shadow-md hover:border-emerald-300 transition block">
        <div class="flex items-center justify-between">
          <h3 class="font-semibold">{{ $cat->name }}</h3>
          <span class="text-xs px-2 py-1 rounded-full border bg-emerald-50 text-emerald-700 border-emerald-200">
  ID: {{ $cat->id }}
</span>
        </div>
        <div class="mt-3 inline-flex items-center gap-1 text-emerald-700 text-sm font-medium">
          Lihat posisi
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </a>
    @empty
      <div class="col-span-full p-6 border rounded-xl bg-slate-50 text-slate-600">
        Belum ada kategori.
      </div>
    @endforelse
  </div>
</section>


    <!-- BENEFITS -->
    <section class="max-w-7xl mx-auto px-4 lg:px-6 py-12" id="benefits">
        <h2 class="text-2xl md:text-3xl font-semibold">Benefit & Fasilitas</h2>
        <p class="mt-2 text-slate-700">Kami mendukung produktivitas dan kesejahteraan karyawan di site.</p>

        <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-medium">Roster & Transport</div>
                <p class="text-sm text-slate-600 mt-1">Jadwal kerja proporsional, transport site (PP) sesuai kebijakan.</p>
            </div>
            <div class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-medium">Akomodasi & Konsumsi</div>
                <p class="text-sm text-slate-600 mt-1">Camp, laundry, dan kantin bersubsidi.</p>
            </div>
            <div class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-medium">Kesehatan & Asuransi</div>
                <p class="text-sm text-slate-600 mt-1">Klinik site, BPJS/Asuransi, pemeriksaan berkala.</p>
            </div>
            <div class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="font-medium">Pelatihan & Karier</div>
                <p class="text-sm text-slate-600 mt-1">Sertifikasi K3, operator, engineering, hingga leadership.</p>
            </div>
        </div>
    </section>

    <!-- PROCESS -->
    <section class="max-w-7xl mx-auto px-4 lg:px-6 py-12" id="process">
        <h2 class="text-2xl md:text-3xl font-semibold">Proses Rekrutmen</h2>
        <ol class="mt-6 grid md:grid-cols-4 gap-5">
            <li class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="text-sm text-slate-500">1</div>
                <div class="font-medium mt-1">Screening CV</div>
                <p class="text-sm text-slate-600 mt-1">Seleksi awal berdasarkan kriteria posisi.</p>
            </li>
            <li class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="text-sm text-slate-500">2</div>
                <div class="font-medium mt-1">Tes Teknis/Kesehatan</div>
                <p class="text-sm text-slate-600 mt-1">Tes kompetensi & pemeriksaan kesehatan (sesuai posisi).</p>
            </li>
            <li class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="text-sm text-slate-500">3</div>
                <div class="font-medium mt-1">Interview</div>
                <p class="text-sm text-slate-600 mt-1">HR & User; penilaian budaya K3 dan teamwork.</p>
            </li>
            <li class="bg-white border rounded-xl p-5 shadow-sm">
                <div class="text-sm text-slate-500">4</div>
                <div class="font-medium mt-1">Offering & Onboarding</div>
                <p class="text-sm text-slate-600 mt-1">Penawaran, administrasi, dan induksi K3 site.</p>
            </li>
        </ol>
        <div class="mt-6 text-sm text-slate-600">
            * Apply dilakukan melalui kanal eksternal (email/Google Form/Job Portal) pada halaman detail lowongan.
        </div>
    </section>

    <!-- HSE & ESG -->
    <section class="max-w-7xl mx-auto px-4 lg:px-6 py-12">
        <div class="grid md:grid-cols-2 gap-6 items-center">
            <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6">
                <h3 class="text-xl font-semibold">Prioritas K3L (HSE)</h3>
                <p class="mt-2 text-slate-700">Budaya keselamatan adalah tanggung jawab bersama. Kami menerapkan <b>Golden Rules</b>, inspeksi rutin, pelaporan insiden, dan pelatihan berkala.</p>
                <ul class="list-disc list-inside text-sm text-slate-700 mt-3">
                    <li>Toolbox Meeting & Safety Talk</li>
                    <li>Permit to Work & Lock Out Tag Out</li>
                    <li>Defensive Driving & Fatigue Management</li>
                </ul>
            </div>
            <div class="bg-sky-50 border border-sky-100 rounded-2xl p-6">
                <h3 class="text-xl font-semibold">Lingkungan & Komunitas (ESG)</h3>
                <p class="mt-2 text-slate-700">Reklamasi berkelanjutan, pengelolaan air & debu, serta program pemberdayaan masyarakat di sekitar area operasi.</p>
                <ul class="list-disc list-inside text-sm text-slate-700 mt-3">
                    <li>Progressive Reclamation</li>
                    <li>Pengelolaan Limbah & Emisi</li>
                    <li>Community Development</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="max-w-7xl mx-auto px-4 lg:px-6 py-12">
        <div class="relative overflow-hidden bg-gradient-to-r from-emerald-700 via-emerald-600 to-sky-600 rounded-3xl shadow-lg">
            <!-- dekorasi blur -->
            <div class="absolute -top-12 -right-12 w-48 h-48 bg-white/10 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-16 -left-16 w-56 h-56 bg-sky-400/20 blur-3xl rounded-full"></div>

            <div class="relative z-10 px-6 py-12 md:px-10 md:py-16 grid md:grid-cols-3 gap-8 items-center text-white">
                <div class="md:col-span-2">
                    <h3 class="text-3xl md:text-4xl font-extrabold leading-tight">
                        Siap Bangun Karier di <span class="text-emerald-200">AAP Mining</span>?
                    </h3>
                    <p class="mt-3 text-white/90 text-lg max-w-xl">
                        Kami mencari talenta terbaik untuk bergabung di operasi <b>batubara</b> & <b>nikel</b>.
                        Lihat lowongan aktif dan apply sekarang!
                    </p>
                </div>
                <div class="md:text-right flex md:justify-end items-center">
                    <button type="button"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow hover:bg-slate-100 transition">
                        Lihat Semua Lowongan
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                </div>
            </div>
        </div>
    </section>


    <!-- DYNAMIC CONTENT WRAPPER (Jobs index/detail dsb) -->
    <main id="main-content" class="max-w-7xl mx-auto px-4 lg:px-6 py-8 flex-1 w-full">
        @if(session('ok'))
        <div class="p-3 bg-green-100 border border-green-200 text-green-900 rounded mb-4">{{ session('ok') }}</div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="border-t bg-white">
        <div class="max-w-7xl mx-auto px-4 lg:px-6 py-10 grid md:grid-cols-4 gap-8 text-sm">
            <div class="md:col-span-2">
                <div class="font-semibold">AAP Mining • Careers</div>
                <p class="mt-2 text-slate-600">Portal resmi informasi lowongan AAP Mining (batubara & nikel). Apply dilakukan via kanal eksternal (email/Google Form/Job Portal).</p>
            </div>
            <nav aria-label="Footer navigation">
                <div class="font-semibold">Navigasi</div>
                <ul class="mt-2 space-y-1">
                    <li><a href="{{ route('jobs.index') }}" class="hover:underline">Daftar Lowongan</a></li>
                    @auth
                    @if(auth()->user()->is_admin)
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin Dashboard</a></li>
                    @endif
                    @endauth
                </ul>
            </nav>
            <div>
                <div class="font-semibold">Kontak</div>
                <ul class="mt-2 text-slate-600 space-y-1">
                    <li>Email HR: <a href="mailto:hr@aap-mining.co.id" class="hover:underline">hr@aap-mining.co.id</a></li>
                    <li>Website: <a href="https://aap-mining.co.id" target="_blank" rel="noopener" class="hover:underline">aap-mining.co.id</a></li>
                    <li>Alamat: Jakarta & Site Kalimantan/Sulawesi</li>
                </ul>
            </div>
        </div>
        <div class="text-center text-xs text-slate-500 py-5">
            © {{ date('Y') }} AAP Mining • All rights reserved.
        </div>
    </footer>

    <!-- Mini JS (toggle mobile menu) -->
    <script>
        const btn = document.getElementById('nav-toggle');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>
</body>

</html>