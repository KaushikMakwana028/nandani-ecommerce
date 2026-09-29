// ============================
// Animated Counter (triggers when in view)
// ============================
const counters = document.querySelectorAll('.counter');
let counterStarted = false;

function startCounting(){
  counters.forEach(counter => {
    const target = +counter.getAttribute('data-target');
    let count = 0;
    const increment = target / 80; // speed control

    const updateCount = () => {
      count += increment;
      if(count < target){
        counter.innerText = Math.ceil(count);
        requestAnimationFrame(updateCount);
      } else {
        counter.innerText = target;
      }
    };
    updateCount();
  });
}

// Trigger counter when stats card or brands section scrolls into view
const statsSection = document.querySelector('.hero-stats-card') || document.querySelector('.brands-intro-section') || document.querySelector('.brand-stat-box');
if(statsSection){
  const checkCounter = () => {
    const rect = statsSection.getBoundingClientRect();
    if(rect.top < window.innerHeight - 50 && !counterStarted){
      startCounting();
      counterStarted = true;
    }
  };
  window.addEventListener('scroll', checkCounter);
  // Check immediately if section is already in viewport
  checkCounter();
}