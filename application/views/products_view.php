<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Format phone and contact data
$phone_display = !empty($phone_display) ? $phone_display : '+91 123 456 7890';
$phone_raw = !empty($phone_raw) ? $phone_raw : '+911234567890';
if (empty($phone_raw) && !empty($settings['phone_numbers'])) {
    $phones = array_map('trim', explode(',', $settings['phone_numbers']));
    if (!empty($phones[0])) {
        $phone_display = $phones[0];
        $phone_raw = preg_replace('/[^0-9+]/', '', $phones[0]);
    }
}

// Category slug helper
if (!function_exists('get_product_cat_slug')) {
    function get_product_cat_slug($cat_name) {
        if (empty($cat_name)) return 'other';
        $c = strtolower(trim($cat_name));
        if (strpos($c, 'gas') !== false || strpos($c, 'stove') !== false || strpos($c, 'hob') !== false) return 'gas-stove';
        if (strpos($c, 'mix') !== false || strpos($c, 'grind') !== false || strpos($c, 'blend') !== false) return 'mixer';
        if (strpos($c, 'cook') !== false || strpos($c, 'non-stick') !== false || strpos($c, 'pan') !== false) return 'cookware';
        if (strpos($c, 'chim') !== false || strpos($c, 'hood') !== false) return 'chimney';
        return preg_replace('/[^a-z0-9]+/', '-', $c);
    }
}

// Build cards strictly from real DB products (no dummy data)
$product_cards = [];
$db_products = !empty($products) ? $products : [];

foreach ($db_products as $p) {
    $cat_name = !empty($p->category_name) ? $p->category_name : 'Kitchen Appliances';
    $brand_name = !empty($p->brand_name) ? $p->brand_name : 'Nandini';
    $cat_slug = get_product_cat_slug($cat_name);

    // Resolve product image
    $img_url = '';
    if (!empty($p->image) && file_exists(FCPATH . 'uploads/products/' . $p->image)) {
        $img_url = base_url('uploads/products/' . $p->image);
    } elseif (!empty($p->image) && file_exists(FCPATH . 'assets/images/products/' . $p->image)) {
        $img_url = base_url('assets/images/products/' . $p->image);
    } else {
        $img_url = base_url('assets/images/products/cat-gas-stove.jpg');
    }

    // Resolve description
    $desc = !empty($p->short_description)
        ? $p->short_description
        : ('High performance ' . strtolower($cat_name) . ' by ' . $brand_name . ' designed for durability, safety, and modern kitchen performance.');

    $search_str = strtolower($p->name . ' ' . $brand_name . ' ' . $cat_name);

    $product_cards[] = [
        'id'            => $p->id,
        'brand_id'      => $p->brand_id,
        'name'          => $p->name,
        'brand_name'    => $brand_name,
        'category_name' => $cat_name,
        'category_slug' => $cat_slug,
        'category_id'   => $p->category_id,
        'badge'         => (!empty($p->badge) && $p->badge !== 'none') ? $p->badge : '',
        'img_url'       => $img_url,
        'description'   => $desc,
        'search_str'    => $search_str
    ];
}

// Collect unique categories strictly from available DB products
$dynamic_filters = [];
foreach ($product_cards as $item) {
    $slug = $item['category_slug'];
    if (!empty($slug) && !isset($dynamic_filters[$slug])) {
        $dynamic_filters[$slug] = [
            'name' => $item['category_name'],
            'id'   => $item['category_id']
        ];
    }
}

// Determine initially active category filter
$active_filter_slug = 'all';
if (!empty($selected_cat)) {
    foreach ($dynamic_filters as $slug => $filter_data) {
        if ($selected_cat == $filter_data['id'] || $selected_cat === $slug) {
            $active_filter_slug = $slug;
            break;
        }
    }
}
?>

<!-- ===== PAGE BANNER ===== -->
<section class="page-banner" style="background-image:url('<?= base_url('assets/images/about/office3.jpeg'); ?>')">
  <div class="page-banner-overlay"></div>
  <div class="container position-relative">
    <div class="text-center" data-aos="fade-up">
      <?php if (!empty($current_brand)): ?>
        <span class="tag tag-light"><?= htmlspecialchars($current_brand->name); ?> Portfolio</span>
        <h1 class="text-white"><?= htmlspecialchars($current_brand->name); ?> Products</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="<?= site_url(''); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('brands'); ?>">Our Brands</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('products'); ?>">Products</a></li>
            <li class="breadcrumb-item active text-gold" aria-current="page"><?= htmlspecialchars($current_brand->name); ?></li>
          </ol>
        </nav>
      <?php else: ?>
        <span class="tag tag-light">Our Catalogue</span>
        <h1 class="text-white">Products</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="<?= site_url(''); ?>">Home</a></li>
            <li class="breadcrumb-item active text-gold" aria-current="page">Products</li>
          </ol>
        </nav>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ===== PRODUCTS TOOLBAR SECTION ===== -->
<section class="products-toolbar-section py-5">
  <div class="container py-3">

    <!-- Header & Search -->
    <div class="row align-items-center g-4 mb-4">
      <div class="col-lg-7" data-aos="fade-right">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="tag mb-0">
            <?= !empty($current_brand) ? 'Authorized Brand' : 'Explore Range'; ?>
          </span>
          <?php if (!empty($current_brand)): ?>
            <span class="active-brand-chip">
              <i class="fas fa-check-circle me-1"></i><?= htmlspecialchars($current_brand->name); ?>
            </span>
          <?php endif; ?>
        </div>
        <h2 class="products-main-heading mb-1">
          <?= !empty($current_brand) ? (htmlspecialchars($current_brand->name) . ' <span>Collection</span>') : 'Our Complete <span>Product Catalogue</span>'; ?>
        </h2>
        <p class="text-muted small mb-0">
          <?php if (!empty($current_brand)): ?>
            Showing <strong><?= count($product_cards); ?></strong> <?= count($product_cards) === 1 ? 'product' : 'products'; ?> available from <?= htmlspecialchars($current_brand->name); ?>
            <a href="<?= site_url('products'); ?>" class="clear-brand-inline ms-2">
              <i class="fas fa-times-circle me-1"></i>View All Brands
            </a>
          <?php else: ?>
            Showing <strong><?= !empty($total_all_products) ? $total_all_products : count($product_cards); ?></strong> products from all authorized brands
          <?php endif; ?>
        </p>
      </div>
      <div class="col-lg-5" data-aos="fade-left">
        <div class="product-search-box">
          <i class="fas fa-search"></i>
          <input type="text" id="productSearch" placeholder="<?= !empty($current_brand) ? ('Search ' . htmlspecialchars($current_brand->name) . ' products...') : 'Search products...'; ?>" value="<?= htmlspecialchars($search_query ?? ''); ?>">
        </div>
      </div>
    </div>

    <!-- Unified Filter Panel -->
    <div class="catalogue-filter-card mb-4" data-aos="fade-up">
      <!-- Row 1: Brand Selector -->
      <?php if (!empty($brands) && count($brands) > 1): ?>
        <div class="filter-card-row brand-row">
          <div class="filter-row-header">
            <span class="filter-row-title"><i class="fas fa-tag"></i> Brands</span>
          </div>
          <div class="filter-pills-list">
            <a href="<?= site_url('products'); ?>" class="brand-pill-btn <?= empty($current_brand) ? 'active' : ''; ?>">
              <span>All Brands</span>
              <span class="pill-badge"><?= !empty($total_all_products) ? $total_all_products : count($product_cards); ?></span>
            </a>
            <?php foreach ($brands as $b): ?>
              <?php
                $is_active_b = (!empty($current_brand) && (int)$current_brand->id === (int)$b->id);
                $b_count = isset($brand_product_counts[$b->id]) ? $brand_product_counts[$b->id] : 0;
              ?>
              <a href="<?= site_url('products?brand=' . $b->id); ?>" class="brand-pill-btn <?= $is_active_b ? 'active' : ''; ?>">
                <span><?= htmlspecialchars($b->name); ?></span>
                <span class="pill-badge"><?= $b_count; ?></span>
              </a>
            <?php endforeach; ?>
            <?php if (!empty($current_brand)): ?>
              <a href="<?= site_url('products'); ?>" class="clear-filter-btn" title="Clear Brand Filter">
                <i class="fas fa-times"></i> Reset
              </a>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <!-- Row 2: Category Selector -->
      <?php if (count($dynamic_filters) > 1): ?>
        <div class="filter-card-row category-row">
          <div class="filter-row-header">
            <span class="filter-row-title"><i class="fas fa-layer-group"></i> Categories</span>
          </div>
          <div class="filter-pills-list">
            <button class="cat-pill-btn <?= ($active_filter_slug === 'all') ? 'active' : ''; ?>" data-filter="all">
              All Products
            </button>
            <?php foreach ($dynamic_filters as $filter_slug => $filter_data): ?>
              <button class="cat-pill-btn <?= ($active_filter_slug === $filter_slug) ? 'active' : ''; ?>" data-filter="<?= htmlspecialchars($filter_slug); ?>">
                <?= htmlspecialchars($filter_data['name']); ?>
              </button>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Products Grid (Strictly DB Products) -->
    <div class="row g-4" id="productGrid">
      <?php if (!empty($product_cards)): ?>
        <?php foreach ($product_cards as $index => $item): ?>
          <?php
            $delay = (($index % 4) + 1) * 50;
          ?>
          <div class="col-lg-3 col-md-4 col-sm-6 product-item" data-category="<?= htmlspecialchars($item['category_slug']); ?>" data-name="<?= htmlspecialchars($item['search_str']); ?>" data-brand="<?= htmlspecialchars($item['brand_name']); ?>" data-brand-id="<?= htmlspecialchars($item['brand_id'] ?? ''); ?>" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
            <div class="product-card">
              <?php if (!empty($item['badge'])): ?>
                <div class="product-badge <?= $item['badge'] === 'bestseller' ? 'bestseller' : ''; ?>">
                  <?= ucfirst($item['badge']); ?>
                </div>
              <?php endif; ?>
              <div class="product-img-box">
                <img src="<?= $item['img_url']; ?>" alt="<?= htmlspecialchars($item['name']); ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/products/cat-gas-stove.jpg'); ?>';">
                <div class="product-overlay">
                  <button class="quick-view-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"
                    data-img="<?= $item['img_url']; ?>"
                    data-name="<?= htmlspecialchars($item['name']); ?>"
                    data-brand="<?= htmlspecialchars($item['brand_name']); ?>"
                    data-category="<?= htmlspecialchars($item['category_name']); ?>"
                    data-desc="<?= htmlspecialchars($item['description']); ?>">
                    <i class="fas fa-eye"></i> Quick View
                  </button>
                </div>
              </div>
              <div class="product-body">
                <a href="<?= site_url('products?brand=' . ($item['brand_id'] ?? '')); ?>" class="product-brand text-decoration-none" title="Filter by <?= htmlspecialchars($item['brand_name']); ?>"><?= htmlspecialchars($item['brand_name']); ?></a>
                <h5><?= htmlspecialchars($item['name']); ?></h5>
                <span class="product-cat-tag"><?= htmlspecialchars($item['category_name']); ?></span>
                <a href="<?= site_url('contact?enquiry=' . urlencode('Product: ' . $item['name'])); ?>" class="btn-enquire">Enquire Now <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-lg-8 mx-auto text-center py-5">
          <div class="empty-state-card p-5" style="background:#fff; border:1px solid #eee; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.06);">
            <div class="empty-icon-wrap mb-3" style="width:76px; height:76px; margin:0 auto; border-radius:50%; background:linear-gradient(135deg, rgba(200,16,46,0.1), rgba(212,175,55,0.15)); display:flex; align-items:center; justify-content:center;">
              <i class="fas fa-boxes-stacked" style="font-size:32px; color:var(--primary-red);"></i>
            </div>
            <?php if (!empty($current_brand)): ?>
              <h4 class="mb-2" style="font-family:'Playfair Display', serif; font-weight:700;">No Products Currently Available for <?= htmlspecialchars($current_brand->name); ?></h4>
              <p class="text-muted mb-4" style="max-width:480px; margin:0 auto;">We are currently updating our <?= htmlspecialchars($current_brand->name); ?> catalogue. Please check back shortly or explore our full collection from other brand partners.</p>
              <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?= site_url('products'); ?>" class="btn-primary-custom">View All Products <i class="fas fa-arrow-right ms-2"></i></a>
                <a href="<?= site_url('brands'); ?>" class="btn-outline-custom"><i class="fas fa-arrow-left me-2"></i>Back to Brands</a>
              </div>
            <?php else: ?>
              <h4 class="mb-2" style="font-family:'Playfair Display', serif; font-weight:700;">No Products Currently Available</h4>
              <p class="text-muted mb-4" style="max-width:480px; margin:0 auto;">Our catalogue is currently being synchronized with new inventory and specifications. Please contact our sales desk for immediate enquiries.</p>
              <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?= site_url('contact'); ?>" class="btn-primary-custom">Enquire Now <i class="fas fa-arrow-right ms-2"></i></a>
                <a href="tel:<?= $phone_raw; ?>" class="btn-outline-custom"><i class="fas fa-phone-alt me-2"></i>Call Us</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- No Search / Filter Results -->
    <div id="noProductResults" class="text-center py-5" style="display:none;">
      <div class="col-lg-8 mx-auto">
        <div class="empty-state-card p-5" style="background:#fff; border:1px solid #eee; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.06);">
          <div class="empty-icon-wrap mb-3" style="width:76px; height:76px; margin:0 auto; border-radius:50%; background:linear-gradient(135deg, rgba(200,16,46,0.1), rgba(212,175,55,0.15)); display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-search" style="font-size:30px; color:var(--gold);"></i>
          </div>
          <h4 class="mb-2" style="font-family:'Playfair Display', serif; font-weight:700;">No Matching Products Found</h4>
          <p class="text-muted mb-4" style="max-width:480px; margin:0 auto;">We couldn't find any products matching your selected category or search keyword. Try clearing filters or searching another keyword.</p>
          <button type="button" class="btn-primary-custom" onclick="if(window.resetProductFilters){ window.resetProductFilters(); }">
            <i class="fas fa-undo me-2"></i>Reset Filter
          </button>
        </div>
      </div>
    </div>

    <?php if (count($product_cards) > 8): ?>
      <!-- Load More Button -->
      <div class="text-center mt-5" data-aos="fade-up">
        <button class="btn-outline-custom" id="loadMoreBtn">Load More Products <i class="fas fa-redo ms-2"></i></button>
      </div>
    <?php endif; ?>

  </div>
</section>

<!-- ===== CATALOGUE DOWNLOAD SECTION ===== -->
<section class="catalogue-download-section">
  <div class="container">
    <div class="catalogue-box" data-aos="zoom-in">
      <div class="row align-items-center g-4">
        <div class="col-lg-1 col-md-2 text-center">
          <div class="catalogue-icon"><i class="fas fa-file-pdf"></i></div>
        </div>
        <div class="col-lg-7 col-md-6">
          <h4>Download Our Complete Product Catalogue</h4>
          <p class="mb-0">Get the full list of products with specifications in one PDF file for easy reference.</p>
        </div>
        <div class="col-lg-4 col-md-4 text-md-end text-center">
          <a href="<?= base_url('assets/downloads/GC_Product.pdf'); ?>" download class="btn-primary-custom">
            <i class="fas fa-download me-2"></i>Download PDF
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA BANNER SECTION ===== -->
<section class="cta-banner-section" style="background-image:url('<?= base_url('assets/images/about/office1.jpeg'); ?>')">
  <div class="cta-overlay"></div>
  <div class="container position-relative">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="zoom-in">
        <span class="tag tag-light">Grow With Nandini</span>
        <h2 class="text-white">Interested In Our <span>Product Range?</span></h2>
        <p class="text-light-grey mb-4">Become an authorized dealer and get access to our complete product catalogue at dealer prices.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <a href="<?= site_url('distributor'); ?>" class="btn-primary-custom">Become a Dealer <i class="fas fa-arrow-right ms-2"></i></a>
          <a href="tel:<?= $phone_raw; ?>" class="btn-outline-light-custom"><i class="fas fa-phone-alt me-2"></i>Call Us Now</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== QUICK VIEW MODAL ===== -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content quick-view-modal">
      <button type="button" class="btn-close-custom" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
      <div class="row g-0">
        <div class="col-md-6">
          <div class="modal-img-box">
            <img id="modalProductImg" src="" alt="Product" onerror="this.onerror=null; this.src='<?= base_url('assets/images/products/cat-gas-stove.jpg'); ?>';">
          </div>
        </div>
        <div class="col-md-6">
          <div class="modal-body-content">
            <span class="product-brand" id="modalProductBrand"></span>
            <h3 id="modalProductName"></h3>
            <span class="product-cat-tag" id="modalProductCategory"></span>
            <p id="modalProductDesc" class="mt-3"></p>
            <ul class="modal-feature-list">
              <li><i class="fas fa-check-circle"></i> 100% Genuine Product</li>
              <li><i class="fas fa-check-circle"></i> Manufacturer Warranty</li>
              <li><i class="fas fa-check-circle"></i> Dealer Pricing Available</li>
            </ul>
            <a href="<?= site_url('contact'); ?>" id="modalProductEnquireBtn" data-base-url="<?= site_url('contact'); ?>" class="btn-primary-custom w-100 text-center">Enquire About This Product <i class="fas fa-paper-plane ms-2"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
