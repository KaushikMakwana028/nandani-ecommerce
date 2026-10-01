// ============================
// Gallery Category Filter
// ============================
const galleryFilterBtns = document.querySelectorAll('.gallery-page-section .filter-btn');
const galleryItems = document.querySelectorAll('.gallery-item');
const noGalleryResults = document.getElementById('noGalleryResults');

galleryFilterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    galleryFilterBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const filterValue = btn.getAttribute('data-filter');
    let visibleCount = 0;

    galleryItems.forEach(item => {
      if(filterValue === 'all' || item.getAttribute('data-category') === filterValue){
        item.classList.remove('hide');
        visibleCount++;
      } else {
        item.classList.add('hide');
      }
    });

    if(noGalleryResults){
      noGalleryResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    if(typeof lightbox !== 'undefined' && lightbox && typeof lightbox.reload === 'function'){
      lightbox.reload();
    }
  });
});

// ============================
// GLightbox Init
// ============================
let lightbox;
if (typeof GLightbox !== 'undefined') {
  lightbox = GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    zoomable: true,
  });
}

// If an active filter button is already selected on page load (e.g. from query param)
const initialActiveBtn = document.querySelector('.gallery-page-section .filter-btn.active');
if (initialActiveBtn && initialActiveBtn.getAttribute('data-filter') !== 'all') {
  initialActiveBtn.click();
}