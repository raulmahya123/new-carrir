// resources/js/admin/dashboard.js

(function () {
  // Pastikan DOM siap
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  function init() {
    // Ambil JSON dari tag <script type="application/json" id="dashboard-data">
    const el = document.getElementById('dashboard-data');
    if (!el) return;

    let DASH = {};
    try {
      DASH = JSON.parse(el.textContent || '{}');
    } catch (e) {
      console.error('Invalid dashboard data JSON', e);
      return;
    }

    const statusLabels = Array.isArray(DASH.statusLabels) ? DASH.statusLabels : [];
    const statusCounts = Array.isArray(DASH.statusCounts) ? DASH.statusCounts : [];
    const catLabels    = Array.isArray(DASH.catLabels)    ? DASH.catLabels    : [];
    const catCounts    = Array.isArray(DASH.catCounts)    ? DASH.catCounts    : [];
    const locs         = Array.isArray(DASH.locations)    ? DASH.locations    : [];

    renderStatusChart(statusLabels, statusCounts);
    renderCategoryChart(catLabels, catCounts);
    renderMap(locs);
  }

  function renderStatusChart(labels, counts) {
    const ctx = document.getElementById('chartStatus');
    if (!ctx || typeof window.Chart === 'undefined') return;

    new window.Chart(ctx, {
      type: 'bar',
      data: { labels, datasets: [{ label: 'Jobs', data: counts }] },
      options: { responsive: true, maintainAspectRatio: false }
    });
  }

  function renderCategoryChart(labels, counts) {
    const ctx = document.getElementById('chartCategory');
    if (!ctx || typeof window.Chart === 'undefined') return;

    new window.Chart(ctx, {
      type: 'bar',
      data: { labels, datasets: [{ label: 'Jobs', data: counts }] },
      options: { responsive: true, maintainAspectRatio: false }
    });
  }

  function renderMap(locations) {
    const mapEl = document.getElementById('map');
    if (!mapEl || typeof window.L === 'undefined') return;

    const defaultCenter = [-2.5489, 118.0149]; // Indonesia center
    const map = window.L.map(mapEl).setView(defaultCenter, 4);

    window.L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const markers = [];
    (locations || []).forEach((loc) => {
      if (loc && loc.lat && loc.lng) {
        const label = `${loc.name ?? ''}${loc.region ? ' • ' + loc.region : ''} — ${(loc.jobs_count ?? 0)} lowongan`;
        const m = window.L.marker([parseFloat(loc.lat), parseFloat(loc.lng)])
          .addTo(map)
          .bindPopup(label);
        markers.push(m);
      }
    });

    if (markers.length) {
      const group = window.L.featureGroup(markers);
      map.fitBounds(group.getBounds().pad(0.3));
    }
  }
})();
