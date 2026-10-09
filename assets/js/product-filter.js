// ============================
// Product Category Filter
// ============================
const pFilterBtns = document.querySelectorAll('.cat-pill-btn, .products-toolbar-section .filter-btn');
const productItems = document.querySelectorAll('.product-item');
const noProductResults = document.getElementById('noProductResults');
const searchInput = document.getElementById('productSearch');

function filterProducts(){
  const activeBtn = document.querySelector('.cat-pill-btn.active, .products-toolbar-section .filter-btn.active');
  const activeCategory = activeBtn ? activeBtn.getAttribute('data-filter') : 'all';
  const searchValue = searchInput ? searchInput.value.toLowerCase().trim() : '';
  let visibleCount = 0;

  productItems.forEach(item => {
    const category = item.getAttribute('data-category');
    const name = item.getAttribute('data-name') || '';

    const matchesCategory = activeCategory === 'all' || category === activeCategory;
    const matchesSearch = !searchValue || name.includes(searchValue);

    if(matchesCategory && matchesSearch){
      item.classList.remove('hide');
      visibleCount++;
    } else {
      item.classList.add('hide');
    }
  });

  if (noProductResults) {
    if (productItems.length === 0) {
      noProductResults.style.display = 'none';
    } else {
      noProductResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }
  }
}

// Category Filter Click
pFilterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    pFilterBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    filterProducts();
  });
});

// Search Input
if(searchInput){
  searchInput.addEventListener('keyup', filterProducts);
  searchInput.addEventListener('input', filterProducts);
}

// Reset Filter helper
window.resetProductFilters = function() {
  if (searchInput) {
    searchInput.value = '';
  }
  const allCategoryBtn = document.querySelector('.cat-pill-btn[data-filter="all"], .products-toolbar-section .filter-btn[data-filter="all"]');
  if (allCategoryBtn) {
    allCategoryBtn.click();
  } else {
    filterProducts();
  }
};

// ============================
// Quick View Modal - Populate Data
// ============================
const quickViewModal = document.getElementById('quickViewModal');
if(quickViewModal){
  quickViewModal.addEventListener('show.bs.modal', function(event){
    const button = event.relatedTarget;
    const img = button.getAttribute('data-img');
    const name = button.getAttribute('data-name');
    const brand = button.getAttribute('data-brand');
    const category = button.getAttribute('data-category');
    const desc = button.getAttribute('data-desc');

    document.getElementById('modalProductImg').src = img;
    document.getElementById('modalProductName').textContent = name;
    document.getElementById('modalProductBrand').textContent = brand;
    document.getElementById('modalProductCategory').textContent = category;
    document.getElementById('modalProductDesc').textContent = desc;

    const enquireBtn = document.getElementById('modalProductEnquireBtn');
    if(enquireBtn && name){
      const baseUrl = enquireBtn.getAttribute('data-base-url') || '';
      enquireBtn.href = baseUrl + '?enquiry=' + encodeURIComponent('Product: ' + name);
    }
  });
}

// Initial filter run on page load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', filterProducts);
} else {
  filterProducts();
}

// ============================
// Load More Button (Simple demo - shows alert, connect to backend/pagination later)
// ============================
const loadMoreBtn = document.getElementById('loadMoreBtn');
if(loadMoreBtn){
  loadMoreBtn.addEventListener('click', () => {
    loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
    setTimeout(() => {
      loadMoreBtn.innerHTML = 'No More Products <i class="fas fa-check ms-2"></i>';
      loadMoreBtn.disabled = true;
    }, 1200);
  });
}