// ============================
// AOS Animation Init
// ============================
if (typeof AOS !== 'undefined') {
  AOS.init({
    duration: 800,
    once: true,
    offset: 50,
    disableMutationObserver: false
  });
}

// ============================
// Navbar Scroll Effect (Non-blocking & Hysteresis Protected)
// ============================
(function() {
  const nav = document.getElementById('mainNav');
  const topBar = document.getElementById('topBar');
  if (!nav) return;

  let isScrolled = false;
  let ticking = false;

  function updateNavbar() {
    const scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;

    // Hysteresis gap: activate when scrolled down past 90px,
    // only deactivate when scrolled back up near the top (< 25px).
    // This completely eliminates layout thrashing and scroll jitter.
    if (!isScrolled && scrollY > 90) {
      isScrolled = true;
      nav.classList.add('scrolled');
      if (topBar) topBar.classList.add('hide');
    } else if (isScrolled && scrollY < 25) {
      isScrolled = false;
      nav.classList.remove('scrolled');
      if (topBar) topBar.classList.remove('hide');
    }

    ticking = false;
  }

  // Use passive scroll listener so browser scrolling is never blocked
  window.addEventListener('scroll', function() {
    if (!ticking) {
      window.requestAnimationFrame(updateNavbar);
      ticking = true;
    }
  }, { passive: true });

  // Initial check on load
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', updateNavbar);
  } else {
    updateNavbar();
  }
})();