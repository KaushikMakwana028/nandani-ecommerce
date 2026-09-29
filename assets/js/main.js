// ============================
// AOS Animation Init
// ============================
AOS.init({
  duration: 900,
  once: true,
  offset: 100
});

// ============================
// Navbar Scroll Effect
// ============================
window.addEventListener('scroll', function(){
  const topBar = document.getElementById('topBar');
  const nav = document.getElementById('mainNav');

  if(window.scrollY > 80){
    topBar.classList.add('hide');
    nav.classList.add('scrolled');
  } else {
    topBar.classList.remove('hide');
    nav.classList.remove('scrolled');
  }
});