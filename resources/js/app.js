// ===== Gen-Z Navbar JS =====
(function () {
  const html = document.documentElement;

  // Theme init (persist)
  const saved = localStorage.getItem('theme');
  if (saved === 'dark') html.classList.add('dark');
  if (saved === 'light') html.classList.remove('dark');

  // Elements
  const nav = document.getElementById('site-nav');
  const navToggle = document.getElementById('nav-toggle');
  const menu = document.getElementById('mobile-menu');
  const themeBtn = document.getElementById('theme-toggle');
  const themeBtnM = document.getElementById('theme-toggle-m');

  // Scroll shadow/condense
  const onScroll = () => {
    if (window.scrollY > 8) nav.classList.add('nav-scrolled');
    else nav.classList.remove('nav-scrolled');
  };
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  // Mobile menu toggle
  const closeMenu = () => { menu.classList.add('hidden'); };
  const openMenu  = () => { menu.classList.remove('hidden'); };

  navToggle?.addEventListener('click', () => {
    menu.classList.contains('hidden') ? openMenu() : closeMenu();
  });
  // close on outside click
  document.addEventListener('click', (e) => {
    if (!menu || !navToggle) return;
    const clickInside = menu.contains(e.target) || navToggle.contains(e.target);
    if (!clickInside && !menu.classList.contains('hidden')) closeMenu();
  });
  // close on ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMenu();
  });

  // Theme toggle
  function toggleTheme() {
    const isDark = html.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    // swap icons
    document.querySelector('.sun-icon')?.classList.toggle('hidden', isDark);
    document.querySelector('.moon-icon')?.classList.toggle('hidden', !isDark);
  }
  themeBtn?.addEventListener('click', toggleTheme);
  themeBtnM?.addEventListener('click', toggleTheme);

  // Set initial icon state
  const isDarkInit = html.classList.contains('dark');
  document.querySelector('.sun-icon')?.classList.toggle('hidden', isDarkInit);
  document.querySelector('.moon-icon')?.classList.toggle('hidden', !isDarkInit);
})();
