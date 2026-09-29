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

    noGalleryResults.style.display = visibleCount === 0 ? 'block' : 'none';
  });
});

// ============================
// GLightbox Init
// ============================
const lightbox = GLightbox({
  selector: '.glightbox',
  touchNavigation: true,
  loop: true,
  zoomable: true,
});