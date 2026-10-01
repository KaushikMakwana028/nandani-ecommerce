// ============================
// Animated Counter (High-Performance IntersectionObserver)
// ============================
(function() {
  function initCounters() {
    const counters = document.querySelectorAll('.counter');
    if (!counters.length) return;

    function countUp(counter) {
      if (counter.dataset.counterStarted === 'true') return;
      counter.dataset.counterStarted = 'true';

      const target = parseInt(counter.getAttribute('data-target'), 10) || 0;
      if (target <= 0) return;

      const duration = 1600; // ms
      const startTime = performance.now();

      function step(now) {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        // smooth easeOutExpo
        const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
        const current = Math.floor(ease * target);
        counter.innerText = current;

        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          counter.innerText = target;
        }
      }

      requestAnimationFrame(step);
    }

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            countUp(entry.target);
            obs.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15 });

      counters.forEach(counter => observer.observe(counter));
    } else {
      // Fallback for older browsers
      counters.forEach(countUp);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCounters);
  } else {
    initCounters();
  }
})();