<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Helper to format heading with highlighted span
function render_hero_heading($heading_text, $highlighted_word) {
    $heading = htmlspecialchars($heading_text);
    if (!empty($highlighted_word)) {
        $word = htmlspecialchars($highlighted_word);
        $escaped = preg_quote($word, '/');
        $heading = preg_replace('/(' . $escaped . ')/i', '<span>$1</span>', $heading, 1);
    }
    return $heading;
}

// Settings fallback
$phone_display = '+91 123 456 7890';
$phone_raw = '+911234567890';
if (!empty($settings['phone_numbers'])) {
    $phones = array_map('trim', explode(',', $settings['phone_numbers']));
    if (!empty($phones[0])) {
        $phone_display = $phones[0];
        $phone_raw = preg_replace('/[^0-9+]/', '', $phones[0]);
    }
}
$email_display = 'info@nandani.com';
if (!empty($settings['emails'])) {
    $emails = array_map('trim', explode(',', $settings['emails']));
    if (!empty($emails[0])) {
        $email_display = $emails[0];
    }
}
$office_address = !empty($settings['address']) ? nl2br(htmlspecialchars($settings['address'])) : 'Plot 101, Industrial Area<br>Rajkot, Gujarat - 360002';
?>

<!-- ===== HERO SLIDER SECTION ===== -->
<section class="hero-section">
  <div class="swiper heroSwiper">
    <div class="swiper-wrapper">

      <?php if (!empty($hero_slides)): ?>
        <?php foreach ($hero_slides as $slide): ?>
          <?php
            $bg_image = !empty($slide->image) ? base_url('uploads/hero_slider/' . $slide->image) : base_url('assets/images/hero/hero-1.jpg');
            $b1_url = !empty($slide->button1_link) ? ((strpos($slide->button1_link, 'http://') === 0 || strpos($slide->button1_link, 'https://') === 0) ? $slide->button1_link : site_url(ltrim($slide->button1_link, '/'))) : site_url('products');
            $b2_url = !empty($slide->button2_link) ? ((strpos($slide->button2_link, 'http://') === 0 || strpos($slide->button2_link, 'https://') === 0) ? $slide->button2_link : site_url(ltrim($slide->button2_link, '/'))) : site_url('distributor');
          ?>
          <div class="swiper-slide" style="background-image:url('<?= $bg_image; ?>')">
            <div class="hero-overlay"></div>
            <div class="container hero-content">
              <div class="row">
                <div class="col-lg-8">
                  <?php if (!empty($slide->tag_text)): ?>
                    <span class="hero-tag" data-swiper-parallax="-300"><?= htmlspecialchars($slide->tag_text); ?></span>
                  <?php endif; ?>
                  
                  <h1 data-swiper-parallax="-400"><?= render_hero_heading($slide->heading_text, $slide->highlighted_word); ?></h1>
                  
                  <?php if (!empty($slide->description)): ?>
                    <p data-swiper-parallax="-200"><?= htmlspecialchars($slide->description); ?></p>
                  <?php endif; ?>

                  <div class="hero-btns" data-swiper-parallax="-100">
                    <?php if (!empty($slide->button1_text)): ?>
                      <a href="<?= $b1_url; ?>" class="btn-primary-custom"><?= htmlspecialchars($slide->button1_text); ?> <i class="fas fa-arrow-right ms-2"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($slide->button2_text)): ?>
                      <a href="<?= $b2_url; ?>" class="btn-outline-light-custom"><?= htmlspecialchars($slide->button2_text); ?></a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Default Slide 1 -->
        <div class="swiper-slide" style="background-image:url('<?= base_url('assets/images/hero/hero-1.jpg'); ?>')">
          <div class="hero-overlay"></div>
          <div class="container hero-content">
            <div class="row">
              <div class="col-lg-8">
                <span class="hero-tag" data-swiper-parallax="-300">Trusted Since Years</span>
                <h1 data-swiper-parallax="-400">Your Trusted Partner in <span>Kitchen Appliance</span> Distribution</h1>
                <p data-swiper-parallax="-200">From decades of manufacturing excellence to becoming an authorized distributor of India's most reputed kitchen appliance brands.</p>
                <div class="hero-btns" data-swiper-parallax="-100">
                  <a href="<?= site_url('products'); ?>" class="btn-primary-custom">Explore Products <i class="fas fa-arrow-right ms-2"></i></a>
                  <a href="<?= site_url('distributor'); ?>" class="btn-outline-light-custom">Become a Distributor</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Default Slide 2 -->
        <div class="swiper-slide" style="background-image:url('<?= base_url('assets/images/hero/hero-2.jpg'); ?>')">
          <div class="hero-overlay"></div>
          <div class="container hero-content">
            <div class="row">
              <div class="col-lg-8">
                <span class="hero-tag" data-swiper-parallax="-300">Authorized Distributors</span>
                <h1 data-swiper-parallax="-400">Bringing <span>Reputed Brands</span> Closer to Every Kitchen</h1>
                <p data-swiper-parallax="-200">We proudly represent top-tier kitchen appliance manufacturers, delivering quality and trust across our distribution network.</p>
                <div class="hero-btns" data-swiper-parallax="-100">
                  <a href="<?= site_url('brands'); ?>" class="btn-primary-custom">Our Brand Partners <i class="fas fa-arrow-right ms-2"></i></a>
                  <a href="<?= site_url('contact'); ?>" class="btn-outline-light-custom">Contact Us</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Default Slide 3 -->
        <div class="swiper-slide" style="background-image:url('<?= base_url('assets/images/hero/hero-3.jpg'); ?>')">
          <div class="hero-overlay"></div>
          <div class="container hero-content">
            <div class="row">
              <div class="col-lg-8">
                <span class="hero-tag" data-swiper-parallax="-300">Grow With Us</span>
                <h1 data-swiper-parallax="-400">Expand Your Business as Our <span>Authorized Dealer</span></h1>
                <p data-swiper-parallax="-200">Join our growing distribution network and partner with a name built on legacy, trust, and quality assurance.</p>
                <div class="hero-btns" data-swiper-parallax="-100">
                  <a href="<?= site_url('distributor'); ?>" class="btn-primary-custom">Apply Now <i class="fas fa-arrow-right ms-2"></i></a>
                  <a href="<?= site_url('about'); ?>" class="btn-outline-light-custom">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>

    <!-- Navigation Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
  </div>

  <!-- Scroll Down Indicator -->
  <div class="scroll-down">
    <div class="mouse"><div class="wheel"></div></div>
    <span>Scroll Down</span>
  </div>

  <!-- Floating Stats Card -->
  <div class="container">
    <div class="hero-stats-card" data-aos="fade-up" data-aos-delay="200">
      <div class="row g-0 text-center">
        <div class="col-6 col-md-3 stat-item">
          <i class="fas fa-award"></i>
          <h3><span class="counter" data-target="25">0</span>+</h3>
          <p>Years of Legacy</p>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <i class="fas fa-handshake"></i>
          <h3><span class="counter" data-target="<?= (!empty($brand_count) && $brand_count > 15) ? $brand_count : 15; ?>">0</span>+</h3>
          <p>Brand Partners</p>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <i class="fas fa-box-open"></i>
          <h3><span class="counter" data-target="<?= (!empty($product_count) && $product_count > 200) ? $product_count : 200; ?>">0</span>+</h3>
          <p>Products Range</p>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <i class="fas fa-map-marker-alt"></i>
          <h3><span class="counter" data-target="100">0</span>+</h3>
          <p>Distributors Network</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== ABOUT SNAPSHOT SECTION ===== -->
<section class="about-snapshot py-5">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <!-- LEFT: Image Collage -->
      <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
        <div class="about-img-wrap">
          <div class="img-main">
            <img src="<?= base_url('assets/images/about/about-main.jpg'); ?>" alt="Nandani Warehouse">
          </div>
          <div class="img-small">
            <img src="<?= base_url('assets/images/about/about-small.jpg'); ?>" alt="Nandani Products">
          </div>

          <!-- Experience Badge -->
          <div class="experience-badge">
            <h3><span class="counter" data-target="25">0</span>+</h3>
            <p>Years of<br>Excellence</p>
          </div>

          <!-- Dotted decoration -->
          <div class="dot-pattern"></div>
        </div>
      </div>

      <!-- RIGHT: Content -->
      <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
        <div class="about-content">
          <span class="section-title-tag">About Nandani</span>
          <h2 class="about-heading">From <span>Manufacturing Legacy</span> to Trusted Distribution Excellence</h2>
          <p class="about-text">
            What began decades ago as a proud manufacturer of kitchen appliances has today evolved into a trusted name in authorized distribution. Nandani now proudly partners with India's most reputed kitchen appliance brands, bringing quality products closer to distributors and retailers nationwide.
          </p>

          <!-- Journey Checklist -->
          <div class="journey-list">
            <div class="journey-item">
              <div class="journey-icon"><i class="fas fa-industry"></i></div>
              <div class="journey-text">
                <h5>Manufacturing Roots</h5>
                <p>Decades of hands-on experience manufacturing quality kitchen appliances.</p>
              </div>
            </div>

            <div class="journey-item">
              <div class="journey-icon"><i class="fas fa-handshake"></i></div>
              <div class="journey-text">
                <h5>Strategic Transition</h5>
                <p>Evolved into an authorized distributor for India's leading appliance brands.</p>
              </div>
            </div>

            <div class="journey-item">
              <div class="journey-icon"><i class="fas fa-globe-asia"></i></div>
              <div class="journey-text">
                <h5>Growing Network</h5>
                <p>Expanding distribution network across regions with trusted dealer partnerships.</p>
              </div>
            </div>
          </div>

          <div class="about-btn-wrap">
            <a href="<?= site_url('about'); ?>" class="btn-primary-custom">Discover Our Story <i class="fas fa-arrow-right ms-2"></i></a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== BRAND PARTNERS SECTION ===== -->
<section class="brands-section">
  <!-- Background Pattern -->
  <div class="brands-bg-pattern"></div>

  <div class="container position-relative">
    <div class="section-title text-center" data-aos="fade-up">
      <span class="tag tag-light">OUR BRAND PARTNERS</span>
      <h2 class="text-white">Proud Distributors of <span>India's Most Trusted</span> Kitchen Brands</h2>
      <p class="text-light-grey">We collaborate with industry-leading manufacturers to bring you unmatched quality and reliability.</p>
    </div>

    <?php
    // Default fallback brands matching image 1
    $default_spotlights = [
        [
            'name'          => 'Marlex',
            'category_name' => 'Gas Stoves & Hobs',
            'since_year'    => '2015',
            'logo_url'      => base_url('assets/images/brands/marlex-logo-120px.png')
        ],
        [
            'name'          => 'Kanchan',
            'category_name' => 'Cookware & Pressure Cookers',
            'since_year'    => '2017',
            'logo_url'      => base_url('assets/images/brands/kanchan-logo-120px.png')
        ],
        [
            'name'          => 'Greenchef',
            'category_name' => 'Non-Stick Cookware',
            'since_year'    => '2019',
            'logo_url'      => base_url('assets/images/brands/greenchef-logo-120px.png')
        ],
        [
            'name'          => 'Brand Name',
            'category_name' => 'Category Name',
            'since_year'    => 'YEAR',
            'logo_url'      => base_url('assets/images/logo.png')
        ]
    ];

    // Build exactly 4 items, prioritizing active brands from DB
    $spotlight_items = [];
    $db_brands = !empty($brands) ? array_values($brands) : [];

    for ($i = 0; $i < 4; $i++) {
        if (isset($db_brands[$i])) {
            $b = $db_brands[$i];
            $spotlight_items[] = [
                'name'          => $b->name,
                'category_name' => !empty($b->category_name) ? $b->category_name : 'Kitchen Appliances',
                'since_year'    => !empty($b->since_year) ? $b->since_year : '2015',
                'logo_url'      => !empty($b->logo_image) ? base_url('uploads/brands/' . $b->logo_image) : $default_spotlights[$i]['logo_url']
            ];
        } else {
            $spotlight_items[] = $default_spotlights[$i];
        }
    }
    ?>

    <!-- ===== BRAND SHOWCASE (4 Brands - Spotlight Cards) ===== -->
    <div class="brand-spotlight-grid" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center g-4">
        <?php foreach ($spotlight_items as $idx => $s_brand): ?>
          <?php
            $num = sprintf("%02d", $idx + 1);
            $delay = ($idx + 1) * 50;
          ?>
          <div class="col-lg-3 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
            <div class="spotlight-card text-light">
              <span class="spotlight-num"><?= $num; ?></span>
              <div class="spotlight-logo-wrap">
                <img src="<?= $s_brand['logo_url']; ?>" alt="<?= htmlspecialchars($s_brand['name']); ?>">
              </div>
              <h5 class="spotlight-name"><?= htmlspecialchars($s_brand['name']); ?></h5>
              <span class="spotlight-category"><?= htmlspecialchars($s_brand['category_name']); ?></span>
              <span class="spotlight-since">EST. <?= htmlspecialchars($s_brand['since_year']); ?></span>
              <div class="spotlight-glow"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Trust Badge Strip -->
    <div class="brands-trust-strip" data-aos="fade-up" data-aos-delay="300">
      <div class="trust-item">
        <i class="fas fa-certificate"></i>
        <span>100% Authorized Distributor</span>
      </div>
      <div class="trust-divider"></div>
      <div class="trust-item">
        <i class="fas fa-shield-alt"></i>
        <span>Genuine Products Guaranteed</span>
      </div>
      <div class="trust-divider"></div>
      <div class="trust-item">
        <i class="fas fa-truck"></i>
        <span>Strong Distribution Network Across Maharashtra</span>
      </div>
    </div>

    <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
      <a href="<?= site_url('brands'); ?>" class="btn-outline-light-custom">View All Brands <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
  </div>
</section>

<!-- ===== PRODUCT CATEGORIES SECTION ===== -->
<section class="product-cat-section py-5">
  <div class="container py-5">
    <div class="section-title text-center" data-aos="fade-up">
      <span class="tag">What We Deal In</span>
      <h2>Explore Our <span>Product Categories</span></h2>
      <p>Wide range of premium kitchen appliances sourced from India's most trusted manufacturing brands.</p>
    </div>

    <div class="row g-4">
      <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $index => $cat): ?>
          <?php
            $delay = (($index % 4) + 1) * 100;
            
            // Determine image
            if (!empty($cat->image)) {
                $cat_img_src = (strpos($cat->image, 'http') === 0) ? $cat->image : base_url($cat->image);
            } else {
                // Check if any active product in this category has an uploaded image
                $prod_img = null;
                if (!empty($products)) {
                    foreach ($products as $p) {
                        if ($p->category_id == $cat->id && !empty($p->image)) {
                            $prod_img = base_url('uploads/products/' . $p->image);
                            break;
                        }
                    }
                }
                $cat_img_src = $prod_img ?: base_url('assets/images/products/cat-gas-stove.jpg');
            }

            // Determine FontAwesome icon class
            $cat_icon = 'fas fa-fire-burner';
            if (!empty($cat->icon)) {
                if (strpos($cat->icon, 'fa-') !== false && strpos($cat->icon, 'fa') !== 0) {
                    $cat_icon = 'fas ' . $cat->icon;
                } else {
                    $cat_icon = $cat->icon;
                }
            }
          ?>
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
            <div class="cat-card">
              <div class="cat-img">
                <img src="<?= $cat_img_src; ?>" alt="<?= htmlspecialchars($cat->name); ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/products/cat-gas-stove.jpg'); ?>';">
              </div>
              <div class="cat-body">
                <div class="cat-icon"><i class="<?= htmlspecialchars($cat_icon); ?>"></i></div>
                <h5><?= htmlspecialchars($cat->name); ?></h5>
                <p><?= htmlspecialchars($cat->short_description ?: 'Premium range of durable and efficient kitchen appliances.'); ?></p>
                <a href="<?= site_url('products?category=' . $cat->id); ?>" class="cat-link">Explore <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="cat-card">
            <div class="cat-img"><img src="<?= base_url('assets/images/products/cat-gas-stove.jpg'); ?>" alt="Gas Stoves"></div>
            <div class="cat-body">
              <div class="cat-icon"><i class="fas fa-fire-burner"></i></div>
              <h5>Gas Stoves & Hobs</h5>
              <p>Premium range of durable and efficient cooking solutions.</p>
              <a href="<?= site_url('products'); ?>" class="cat-link">Explore <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="cat-card">
            <div class="cat-img"><img src="<?= base_url('assets/images/products/cat-mixer.jpg'); ?>" alt="Mixer Grinders"></div>
            <div class="cat-body">
              <div class="cat-icon"><i class="fas fa-blender"></i></div>
              <h5>Mixer Grinders</h5>
              <p>High-performance mixers built for daily kitchen demands.</p>
              <a href="<?= site_url('products'); ?>" class="cat-link">Explore <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="cat-card">
            <div class="cat-img"><img src="<?= base_url('assets/images/products/cat-cookware.jpg'); ?>" alt="Cookware"></div>
            <div class="cat-body">
              <div class="cat-icon"><i class="fas fa-utensils"></i></div>
              <h5>Cookware & Non-Stick</h5>
              <p>Long-lasting, safe and stylish cookware collections.</p>
              <a href="<?= site_url('products'); ?>" class="cat-link">Explore <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="cat-card">
            <div class="cat-img"><img src="<?= base_url('assets/images/products/cat-chimney.jpg'); ?>" alt="Kitchen Chimneys"></div>
            <div class="cat-body">
              <div class="cat-icon"><i class="fas fa-wind"></i></div>
              <h5>Kitchen Chimneys</h5>
              <p>Modern ventilation solutions for a cleaner kitchen.</p>
              <a href="<?= site_url('products'); ?>" class="cat-link">Explore <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="text-center mt-5" data-aos="fade-up">
      <a href="<?= site_url('products'); ?>" class="btn-primary-custom">View All Products <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
  </div>
</section>

<!-- ===== WHY CHOOSE US SECTION ===== -->
<section class="why-choose-section py-5">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <div class="col-lg-5" data-aos="fade-right">
        <span class="tag">Why Choose Us</span>
        <h2 class="mb-4">The <span>Nandani Advantage</span> for Your Business Growth</h2>
        <p class="text-muted mb-4">With decades of manufacturing heritage now channeled into distribution excellence, we bring unmatched value to every partnership.</p>
        <img src="<?= base_url('assets/images/about/why-choose.jpg'); ?>" alt="Why Choose Nandani" class="why-img rounded-4 shadow">
      </div>

      <div class="col-lg-7">
        <div class="row g-4">
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="why-box">
              <div class="why-icon"><i class="fas fa-medal"></i></div>
              <h5>Legacy of Trust</h5>
              <p>25+ years of industry experience from manufacturing to distribution.</p>
            </div>
          </div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="why-box">
              <div class="why-icon"><i class="fas fa-award"></i></div>
              <h5>Authorized & Genuine</h5>
              <p>100% authentic products directly sourced from reputed manufacturers.</p>
            </div>
          </div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="why-box">
              <div class="why-icon"><i class="fas fa-truck-fast"></i></div>
              <h5>Timely Delivery</h5>
              <p>Efficient logistics ensuring your stock reaches on time, every time.</p>
            </div>
          </div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="why-box">
              <div class="why-icon"><i class="fas fa-headset"></i></div>
              <h5>Dedicated Support</h5>
              <p>Personalized assistance for all our distributor partners.</p>
            </div>
          </div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="why-box">
              <div class="why-icon"><i class="fas fa-chart-line"></i></div>
              <h5>Business Growth</h5>
              <p>Profitable margins and growth opportunities for our partners.</p>
            </div>
          </div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="why-box">
              <div class="why-icon"><i class="fas fa-boxes-stacked"></i></div>
              <h5>Wide Product Range</h5>
              <p>Extensive catalogue covering all major kitchen appliance categories.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== DISTRIBUTION NETWORK SECTION ===== -->
<section class="network-section py-5">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <div class="col-lg-6" data-aos="fade-right">
        <div class="network-img-wrap">
          <img src="<?= base_url('assets/images/about/india-map.png'); ?>" alt="Distribution Network Map" class="img-fluid">
          <div class="pulse-dot pulse-1"></div>
          <div class="pulse-dot pulse-2"></div>
          <div class="pulse-dot pulse-3"></div>
          <div class="pulse-dot pulse-4"></div>
        </div>
      </div>

      <div class="col-lg-6" data-aos="fade-left">
        <span class="tag">Our Reach</span>
        <h2 class="mb-4">Expanding Our <span>Distribution Network</span> Across the Nation</h2>
        <p class="text-muted mb-4">We are continuously growing our footprint, building strong dealer and distributor relationships to bring quality kitchen appliances to every corner.</p>

        <div class="row g-3 mb-4">
          <div class="col-6">
            <div class="network-stat">
              <h3><span class="counter" data-target="15">0</span>+</h3>
              <p>States Covered</p>
            </div>
          </div>
          <div class="col-6">
            <div class="network-stat">
              <h3><span class="counter" data-target="100">0</span>+</h3>
              <p>Active Distributors</p>
            </div>
          </div>
        </div>

        <a href="<?= site_url('distributor'); ?>" class="btn-primary-custom">Join Our Network <i class="fas fa-arrow-right ms-2"></i></a>
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
        <h2 class="text-white">Ready to Become Our <span>Authorized Distributor?</span></h2>
        <p class="text-light-grey mb-4">Join hands with a trusted name in kitchen appliance distribution and unlock new business opportunities today.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <a href="<?= site_url('distributor'); ?>" class="btn-primary-custom">Apply Now <i class="fas fa-arrow-right ms-2"></i></a>
          <a href="tel:<?= $phone_raw; ?>" class="btn-outline-light-custom"><i class="fas fa-phone-alt me-2"></i>Call Us Now</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== TESTIMONIALS SECTION ===== -->
<section class="testimonials-section py-5">
  <div class="container py-5">
    <div class="section-title text-center" data-aos="fade-up">
      <span class="tag">Testimonials</span>
      <h2>What Our <span>Distributors Say</span></h2>
      <p>Trusted by dealers and distributors across the country.</p>
    </div>

    <div class="swiper testimonialSwiper" data-aos="fade-up" data-aos-delay="200">
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="testimonial-card">
            <i class="fas fa-quote-left quote-icon"></i>
            <p class="testimonial-text">Partnering with Nandani has been a game-changer for our business. Timely delivery and genuine products every time!</p>
            <div class="testimonial-author">
              <img src="<?= base_url('assets/images/testimonials/client-1.jpg'); ?>" alt="Rajesh Sharma">
              <div>
                <h6>Rajesh Sharma</h6>
                <span>Distributor, Delhi</span>
              </div>
            </div>
            <div class="rating">★★★★★</div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="testimonial-card">
            <i class="fas fa-quote-left quote-icon"></i>
            <p class="testimonial-text">Excellent support team and quality brand portfolio. Nandani truly understands distributor needs.</p>
            <div class="testimonial-author">
              <img src="<?= base_url('assets/images/testimonials/client-2.jpg'); ?>" alt="Priya Mehta">
              <div>
                <h6>Priya Mehta</h6>
                <span>Dealer, Mumbai</span>
              </div>
            </div>
            <div class="rating">★★★★★</div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="testimonial-card">
            <i class="fas fa-quote-left quote-icon"></i>
            <p class="testimonial-text">Their legacy in manufacturing reflects in the quality of service they provide as distributors. Highly recommended!</p>
            <div class="testimonial-author">
              <img src="<?= base_url('assets/images/testimonials/client-3.jpg'); ?>" alt="Amit Verma">
              <div>
                <h6>Amit Verma</h6>
                <span>Retailer, Pune</span>
              </div>
            </div>
            <div class="rating">★★★★★</div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="testimonial-card">
            <i class="fas fa-quote-left quote-icon"></i>
            <p class="testimonial-text">Unmatched dealer margins and seamless distribution logistics. Nandani is our most trusted kitchen appliance partner.</p>
            <div class="testimonial-author">
              <img src="<?= base_url('assets/images/testimonials/client-4.jpg'); ?>" alt="Vikram Patel">
              <div>
                <h6>Vikram Patel</h6>
                <span>Distributor, Ahmedabad</span>
              </div>
            </div>
            <div class="rating">★★★★★</div>
          </div>
        </div>

      </div>
      <div class="swiper-pagination testimonial-pagination"></div>
    </div>
  </div>
</section>

<!-- ===== GALLERY PREVIEW SECTION ===== -->
<section class="gallery-home-section py-5">
  <div class="container py-5">
    <div class="section-title text-center" data-aos="fade-up">
      <span class="tag">Our Gallery</span>
      <h2>A Glimpse Into <span>Our World</span></h2>
      <p>Explore our warehouse, events, and product showcases.</p>
    </div>

    <?php
      // Map gallery images
      $g1 = (!empty($gallery_items[0]->image)) ? base_url('uploads/gallery/' . $gallery_items[0]->image) : base_url('assets/images/gallery/gallery-1.jpg');
      $g2 = (!empty($gallery_items[1]->image)) ? base_url('uploads/gallery/' . $gallery_items[1]->image) : base_url('assets/images/gallery/gallery-2.jpg');
      $g3 = (!empty($gallery_items[2]->image)) ? base_url('uploads/gallery/' . $gallery_items[2]->image) : base_url('assets/images/gallery/gallery-3.jpg');
      $g4 = (!empty($gallery_items[3]->image)) ? base_url('uploads/gallery/' . $gallery_items[3]->image) : base_url('assets/images/gallery/gallery-4.jpg');
    ?>

    <div class="row g-3">
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
        <div class="gallery-item large">
          <img src="<?= $g1; ?>" alt="Gallery" onerror="this.onerror=null; this.src='<?= base_url('assets/images/gallery/gallery-1.jpg'); ?>';">
          <div class="gallery-overlay"><i class="fas fa-plus"></i></div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
        <div class="gallery-item">
          <img src="<?= $g2; ?>" alt="Gallery" onerror="this.onerror=null; this.src='<?= base_url('assets/images/gallery/gallery-2.jpg'); ?>';">
          <div class="gallery-overlay"><i class="fas fa-plus"></i></div>
        </div>
        <div class="gallery-item mt-3">
          <img src="<?= $g3; ?>" alt="Gallery" onerror="this.onerror=null; this.src='<?= base_url('assets/images/gallery/gallery-3.jpg'); ?>';">
          <div class="gallery-overlay"><i class="fas fa-plus"></i></div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
        <div class="gallery-item large">
          <img src="<?= $g4; ?>" alt="Gallery" onerror="this.onerror=null; this.src='<?= base_url('assets/images/gallery/gallery-4.jpg'); ?>';">
          <div class="gallery-overlay"><i class="fas fa-plus"></i></div>
        </div>
      </div>
    </div>

    <div class="text-center mt-5" data-aos="fade-up">
      <a href="<?= site_url('gallery'); ?>" class="btn-primary-custom">View Full Gallery <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
  </div>
</section>

<!-- ===== CONTACT STRIP SECTION ===== -->
<section class="contact-strip-section py-5" id="contact">
  <div class="container py-5">
    <div class="row g-4">

      <div class="col-lg-5" data-aos="fade-right">
        <span class="tag">Get In Touch</span>
        <h2 class="mb-4">Let's Start a <span>Business Conversation</span></h2>
        <p class="text-muted mb-4">Have questions about our products or interested in becoming a distributor? Reach out to us today.</p>

        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
          <div><h6>Our Office</h6><p><?= $office_address; ?></p></div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fas fa-phone-alt"></i></div>
          <div><h6>Call Us</h6><p><?= htmlspecialchars($phone_display); ?></p></div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
          <div><h6>Email Us</h6><p><?= htmlspecialchars($email_display); ?></p></div>
        </div>
      </div>

      <div class="col-lg-7" data-aos="fade-left">
        <div class="contact-form-box">

          <?php if ($this->session->flashdata('contact_success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle me-2"></i><?= $this->session->flashdata('contact_success'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('contact_error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-triangle me-2"></i><?= $this->session->flashdata('contact_error'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <form action="<?= site_url('home/contact_submit'); ?>" method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" value="<?= set_value('name'); ?>" required>
              </div>
              <div class="col-md-6">
                <input type="tel" name="phone" class="form-control" placeholder="Phone Number" value="<?= set_value('phone'); ?>" required>
              </div>
              <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?= set_value('email'); ?>" required>
              </div>
              <div class="col-md-6">
                <input type="text" name="city" class="form-control" placeholder="City" value="<?= set_value('city'); ?>" required>
              </div>
              <div class="col-12">
                <textarea name="message" class="form-control" rows="4" placeholder="Your Message"><?= set_value('message'); ?></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-primary-custom w-100">Send Message <i class="fas fa-paper-plane ms-2"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
