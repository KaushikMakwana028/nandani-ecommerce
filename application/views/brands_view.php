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

// Helper to determine category slug for filter matching
if (!function_exists('resolve_brand_cat_slug')) {
    function resolve_brand_cat_slug($cat_name) {
        if (empty($cat_name)) return 'other';
        $c = strtolower(trim($cat_name));
        if (strpos($c, 'gas') !== false || strpos($c, 'stove') !== false || strpos($c, 'hob') !== false) return 'gas-stove';
        if (strpos($c, 'mix') !== false || strpos($c, 'grind') !== false || strpos($c, 'blend') !== false) return 'mixer';
        if (strpos($c, 'cook') !== false || strpos($c, 'non-stick') !== false || strpos($c, 'pan') !== false) return 'cookware';
        if (strpos($c, 'chim') !== false || strpos($c, 'hood') !== false) return 'chimney';
        return preg_replace('/[^a-z0-9]+/', '-', $c);
    }
}

// Build brand list ONLY from real active brands in the database
$display_brands = [];
$db_brands_list = !empty($brands) ? array_values($brands) : [];

foreach ($db_brands_list as $i => $db_b) {
    $cat_name = !empty($db_b->category_name) ? $db_b->category_name : 'Kitchen Appliances';
    $cat_slug = resolve_brand_cat_slug($cat_name);

    // Resolve brand logo
    $logo_url = '';
    if (!empty($db_b->logo_image) && file_exists(FCPATH . 'uploads/brands/' . $db_b->logo_image)) {
        $logo_url = base_url('uploads/brands/' . $db_b->logo_image);
    } elseif (!empty($db_b->logo_image) && file_exists(FCPATH . 'assets/images/brands/' . $db_b->logo_image)) {
        $logo_url = base_url('assets/images/brands/' . $db_b->logo_image);
    } else {
        $logo_url = base_url('assets/images/logo.png');
    }

    // Resolve description
    $desc = !empty($db_b->short_description)
            ? $db_b->short_description
            : ('Authorized distributor of high quality ' . strtolower($cat_name) . ' appliances.');

    $display_brands[] = [
        'id'            => $db_b->id,
        'name'          => $db_b->name,
        'category_name' => $cat_name,
        'category_slug' => $cat_slug,
        'since_year'    => !empty($db_b->since_year) ? $db_b->since_year : '',
        'description'   => $desc,
        'logo_url'      => $logo_url,
        'fallback_logo' => base_url('assets/images/logo.png'),
        'products_url'  => site_url('products?brand=' . $db_b->id)
    ];
}

// Collect unique categories ONLY from the active DB brands
$dynamic_filters = [];
foreach ($display_brands as $item) {
    $slug = $item['category_slug'];
    if (!empty($slug) && !isset($dynamic_filters[$slug])) {
        $dynamic_filters[$slug] = $item['category_name'];
    }
}
?>

<!-- ===== PAGE BANNER ===== -->
<section class="page-banner" style="background-image:url('<?= base_url('assets/images/about/about-banner.jpg'); ?>')">
  <div class="page-banner-overlay"></div>
  <div class="container position-relative">
    <div class="text-center" data-aos="fade-up">
      <span class="tag tag-light">Authorized Partners</span>
      <h1 class="text-white">Our Brands</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center mb-0">
          <li class="breadcrumb-item"><a href="<?= site_url(''); ?>">Home</a></li>
          <li class="breadcrumb-item active text-gold" aria-current="page">Our Brands</li>
        </ol>
      </nav>
    </div>
  </div>
</section>

<!-- ===== BRANDS INTRO ===== -->
<section class="brands-intro-section py-5">
  <div class="container py-5 text-center">
    <div class="row justify-content-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="tag">Trusted Partnerships</span>
        <h2 class="mb-4">We Are Proud Distributors of <span>India's Leading</span> Kitchen Appliance Brands</h2>
        <p class="text-muted">
          Every brand we represent is a result of careful selection based on quality, reliability, and market trust. As an authorized distributor, we ensure 100% genuine products reach our dealer network with complete confidence.
        </p>
      </div>
    </div>

    <!-- Trust Stats -->
    <div class="row g-4 mt-4 justify-content-center">
      <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
        <div class="brand-stat-box">
          <h3><span class="counter" data-target="<?= count($display_brands); ?>"><?= count($display_brands); ?></span>+</h3>
          <p>Brand Partners</p>
        </div>
      </div>
      <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
        <div class="brand-stat-box">
          <h3><span class="counter" data-target="25">25</span>+</h3>
          <p>Years Experience</p>
        </div>
      </div>
      <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
        <div class="brand-stat-box">
          <h3><span class="counter" data-target="<?= (!empty($product_count) && $product_count > 200) ? $product_count : 200; ?>">200</span>+</h3>
          <p>Products Range</p>
        </div>
      </div>
      <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
        <div class="brand-stat-box">
          <h3><span class="counter" data-target="100">100</span>+</h3>
          <p>Dealer Network</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== BRANDS GRID SECTION ===== -->
<section class="brands-grid-section py-5">
  <div class="container py-4">

    <!-- Filter Buttons (Only show category filters if more than 1 category exists) -->
    <?php if (count($dynamic_filters) > 1): ?>
      <div class="brand-filter text-center mb-5" data-aos="fade-up">
        <button class="filter-btn active" data-filter="all">All Brands</button>
        <?php foreach ($dynamic_filters as $filter_slug => $filter_label): ?>
          <button class="filter-btn" data-filter="<?= htmlspecialchars($filter_slug); ?>"><?= htmlspecialchars($filter_label); ?></button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Brand Cards Grid (Only DB Brands) -->
    <div class="row g-4" id="brandGrid">
      <?php if (!empty($display_brands)): ?>
        <?php foreach ($display_brands as $index => $item): ?>
          <?php
            $delay = (($index % 4) + 1) * 50;
          ?>
          <div class="col-lg-3 col-md-4 col-sm-6 brand-item" data-category="<?= htmlspecialchars($item['category_slug']); ?>" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
            <div class="brand-card">
              <?php if (!empty($item['since_year'])): ?>
                <div class="brand-since">Since <?= htmlspecialchars($item['since_year']); ?></div>
              <?php endif; ?>
              <div class="brand-logo-box">
                <img src="<?= $item['logo_url']; ?>" alt="<?= htmlspecialchars($item['name']); ?>" onerror="this.onerror=null; this.src='<?= $item['fallback_logo']; ?>';">
              </div>
              <div class="brand-info">
                <h5><?= htmlspecialchars($item['name']); ?></h5>
                <span class="brand-category"><?= htmlspecialchars($item['category_name']); ?></span>
                <p><?= htmlspecialchars($item['description']); ?></p>
                <a href="<?= $item['products_url']; ?>" class="brand-link">View Products <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center py-5">
          <i class="fas fa-box-open" style="font-size:50px; color:#ccc;"></i>
          <p class="mt-3 text-muted">No brands found at this time.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- No Results Message (hidden by default) -->
    <div id="noResults" class="text-center py-5" style="display:none;">
      <i class="fas fa-box-open" style="font-size:50px; color:#ccc;"></i>
      <p class="mt-3 text-muted">No brands found in this category.</p>
    </div>

  </div>
</section>

<!-- ===== AUTHORIZED BADGE SECTION ===== -->
<section class="authorized-section py-5">
  <div class="container">
    <div class="authorized-box" data-aos="zoom-in">
      <div class="row align-items-center g-4">
        <div class="col-lg-2 col-md-3 text-center">
          <div class="authorized-icon">
            <i class="fas fa-certificate"></i>
          </div>
        </div>
        <div class="col-lg-7 col-md-9">
          <h4>100% Authorized & Genuine Products Guarantee</h4>
          <p class="mb-0">Every brand featured here is officially authorized for distribution by Nandani. We guarantee genuine, warranty-backed products for all our dealers and distributors.</p>
        </div>
        <div class="col-lg-3 text-lg-end text-center">
          <a href="<?= site_url('contact'); ?>" class="btn-primary-custom">Verify Partnership <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA BANNER SECTION ===== -->
<section class="cta-banner-section" style="background-image:url('<?= base_url('assets/images/hero/cta-bg.jpg'); ?>')">
  <div class="cta-overlay"></div>
  <div class="container position-relative">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="zoom-in">
        <span class="tag tag-light">Grow With Nandani</span>
        <h2 class="text-white">Want To Distribute These <span>Trusted Brands?</span></h2>
        <p class="text-light-grey mb-4">Partner with Nandani today and get access to India's most trusted kitchen appliance brand portfolio.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <a href="<?= site_url('distributor'); ?>" class="btn-primary-custom">Become a Distributor <i class="fas fa-arrow-right ms-2"></i></a>
          <a href="tel:<?= $phone_raw; ?>" class="btn-outline-light-custom"><i class="fas fa-phone-alt me-2"></i>Call Us Now</a>
        </div>
      </div>
    </div>
  </div>
</section>
