// ============================
// Brand Filter Functionality
// ============================
const filterBtns = document.querySelectorAll('.filter-btn');
const brandItems = document.querySelectorAll('.brand-item');
const noResults = document.getElementById('noResults');

filterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    // Active button toggle
    filterBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const filterValue = btn.getAttribute('data-filter');
    let visibleCount = 0;

    brandItems.forEach(item => {
      if(filterValue === 'all' || item.getAttribute('data-category') === filterValue){
        item.classList.remove('hide');
        visibleCount++;
      } else {
        item.classList.add('hide');
      }
    });

    // Show/hide "No Results" message
    if(noResults){
      noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }
  });
});