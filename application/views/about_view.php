<?php
defined('BASEPATH') or exit('No direct script access allowed');

$phone_display = '+91 123 456 7890';
$phone_raw = '+911234567890';
if (!empty($settings['phone_numbers'])) {
  $phones = array_map('trim', explode(',', $settings['phone_numbers']));
  if (!empty($phones[0])) {
    $phone_display = $phones[0];
    $phone_raw = preg_replace('/[^0-9+]/', '', $phones[0]);
  }
}
?>

<!-- ===== PAGE BANNER ===== -->
<section class="page-banner" style="background-image:url('<?= base_url('assets/images/about/office3.jpeg'); ?>')">
  <div class="page-banner-overlay"></div>
  <div class="container position-relative">
    <div class="text-center" data-aos="fade-up">
      <span class="tag tag-light">Who We Are</span>
      <h1 class="text-white">About Nandini</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center mb-0">
          <li class="breadcrumb-item"><a href="<?= site_url(''); ?>">Home</a></li>
          <li class="breadcrumb-item active text-gold" aria-current="page">About Us</li>
        </ol>
      </nav>
    </div>
  </div>
</section>

<!-- ===== ABOUT INTRO SECTION ===== -->
<section class="about-intro-section py-5">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <!-- LEFT: Image Collage -->
      <div class="col-lg-6" data-aos="fade-right">
        <div class="intro-img-wrap">
          <div class="intro-img-main">
            <img src="<?= base_url('assets/images/about/office2.jpeg'); ?>" alt="Nandini Executive Corporate Office">
          </div>
          <div class="intro-img-small">
            <img src="<?= base_url('assets/images/about/office1.jpeg'); ?>" alt="Nandini Corporate Lounge & Skyline View">
          </div>
          <div class="intro-badge">
            <i class="fas fa-award"></i>
            <span><span class="counter" data-target="25">0</span>+ Years</span>
          </div>
          <a href="#officeTour" class="intro-tour-pill">
            <i class="fas fa-play-circle text-danger"></i> Virtual Tour
          </a>
        </div>
      </div>

      <!-- RIGHT: Content -->
      <div class="col-lg-6" data-aos="fade-left">
        <span class="tag">Our Story</span>
        <h2 class="mb-4">Who We Are & <span>Where We Come From</span></h2>
        <p class="text-muted mb-3">
          Nandini began its journey decades ago as a dedicated manufacturer of kitchen appliances, building a reputation for quality, durability, and innovation. Our products once graced kitchens across the region, crafted with precision and care.
        </p>
        <p class="text-muted mb-4">
          Over time, as the market evolved, we recognized a greater opportunity — to leverage our deep industry knowledge and become a trusted bridge between India's most reputed kitchen appliance manufacturers and dealers nationwide. Today, Nandini proudly operates as an authorized dealer, carrying forward the same values of trust and quality that defined our manufacturing era.
        </p>

        <div class="row g-3">
          <div class="col-6">
            <div class="intro-tick"><i class="fas fa-check-circle"></i> Manufacturing Heritage</div>
          </div>
          <div class="col-6">
            <div class="intro-tick"><i class="fas fa-check-circle"></i> Authorized Dealership</div>
          </div>
          <div class="col-6">
            <div class="intro-tick"><i class="fas fa-check-circle"></i> Pan-India Network</div>
          </div>
          <div class="col-6">
            <div class="intro-tick"><i class="fas fa-check-circle"></i> Trusted by Dealers</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== OUR BUSINESS TODAY SECTION ===== -->
<section class="business-today-section py-5">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-10 text-center" data-aos="fade-up">
        <span class="tag">Present Focus</span>
        <h2 class="mb-4">Our <span>Business Today</span></h2>
        <p class="text-muted mb-0">
          Today, Nandini Kitchen Appliances Pvt. Ltd. operates primarily as a <strong>dealer in Maharashtra</strong>, representing established brands in the kitchen and home appliance industry. We work at the dealer level, partnering with reputed brands such as <strong>Marlex, Kanchan and Greenchef</strong>, along with a wide range of kitchenware, home appliances and utility products.
        </p>
        <p class="text-muted mt-3">
          Our objective is to provide dealers and retailers with a wide and reliable range of products under one roof, supported by efficient distribution, market knowledge and dependable service. Our long-standing manufacturing experience gives us a strong understanding of product quality, market requirements and customer expectations.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ===== OUR INFRASTRUCTURE SECTION ===== -->
<section class="infrastructure-section py-5">
  <div class="container py-4">
    <div class="row align-items-center g-5">

      <div class="col-lg-5" data-aos="fade-right">
        <span class="tag">Manufacturing Heritage</span>
        <h2 class="mb-4">Our <span>Infrastructure</span></h2>
        <p class="text-muted mb-4">
          Our operations at Khatwad, Nashik, have been developed across multiple industrial facilities covering approximately <strong>8,000 sq. metres</strong>. Our manufacturing background remains an important strength of the group, while our present business focus is on distribution and expanding our network of reputed kitchen and home appliance brands across Maharashtra.
        </p>
        <div class="infra-stat-box">
          <i class="fas fa-industry"></i>
          <div>
            <h4>8,000 sq. mt.</h4>
            <p>Industrial Facility Area — Khatwad, Nashik</p>
          </div>
        </div>
      </div>

      <div class="col-lg-7" data-aos="fade-left">
        <div class="row g-3">
          <div class="col-md-6">
            <div class="infra-item"><i class="fas fa-check-circle"></i> Non-Stick Cookware</div>
          </div>
          <div class="col-md-6">
            <div class="infra-item"><i class="fas fa-check-circle"></i> Hard Anodised Cookware</div>
          </div>
          <div class="col-md-6">
            <div class="infra-item"><i class="fas fa-check-circle"></i> Pressure Cookers</div>
          </div>
          <div class="col-md-6">
            <div class="infra-item"><i class="fas fa-check-circle"></i> Hard Anodised Pressure Cookers</div>
          </div>
          <div class="col-md-6">
            <div class="infra-item"><i class="fas fa-check-circle"></i> Aluminium Products</div>
          </div>
          <div class="col-md-6">
            <div class="infra-item"><i class="fas fa-check-circle"></i> Copper Utensils</div>
          </div>
          <div class="col-md-6">
            <div class="infra-item"><i class="fas fa-check-circle"></i> Triply Utensils</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== CORPORATE HEADQUARTERS & OFFICE TOUR SECTION ===== -->
<section class="office-tour-section py-5" id="officeTour">
  <div class="container py-4">

    <div class="section-title text-center mb-5" data-aos="fade-up">
      <span class="tag">Corporate Headquarters</span>
      <h2>Inside Nandini: <span>Where Excellence Takes Shape</span></h2>
      <p class="mx-auto" style="max-width: 680px;">Take a tour of our modern corporate headquarters — designed for executive leadership, dealer conferences, brand summits, and seamless distribution operations.</p>
    </div>

    <!-- Main Video & Overview Showcase -->
    <div class="row g-4 align-items-stretch mb-4">
      <!-- Left: Video Player -->
      <div class="col-lg-7" data-aos="fade-right">
        <div class="office-video-card h-100">
          <div class="office-video-wrap">
            <div class="video-live-pill">
              <span class="pulse-indicator"></span>
              <span>Virtual Facility Tour</span>
            </div>
            <video id="officeVideoPlayer" poster="<?= base_url('assets/images/about/office2.jpeg'); ?>" controls playsinline preload="metadata">
              <source src="<?= base_url('assets/images/about/office-vd-1.mp4'); ?>" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          </div>
          <div class="office-video-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
              <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-1 fw-bold" style="background: rgba(200,16,46,0.08) !important; color: var(--primary-red) !important; font-size: 12px;">
                <i class="fas fa-video me-1"></i> Video Walkthrough
              </span>
              <span class="text-muted small"><i class="fas fa-play me-1"></i> Interactive Video Player</span>
            </div>
            <h3>Executive Conference Suite &amp; Corporate Hub</h3>
            <p>
              An inside look at our state-of-the-art boardroom and corporate headquarters. Engineered to host high-level business summits, authorized dealer meets, and strategic planning sessions with India's leading appliance manufacturers.
            </p>
            <div class="office-features-grid">
              <div class="office-feature-chip">
                <i class="fas fa-users text-gold"></i>
                <span>20+ Executive Boardroom Capacity</span>
              </div>
              <div class="office-feature-chip">
                <i class="fas fa-handshake text-danger"></i>
                <span>Strategic Partner Summit Hub</span>
              </div>
              <div class="office-feature-chip">
                <i class="fas fa-city text-gold"></i>
                <span>Panoramic Skyline Outlook</span>
              </div>
              <div class="office-feature-chip">
                <i class="fas fa-truck-ramp-box text-danger"></i>
                <span>Connected Distribution Command</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Photo Highlights -->
      <div class="col-lg-5" data-aos="fade-left">
        <div class="d-flex flex-column gap-4 h-100">

          <!-- Photo Card 1: Boardroom -->
          <div class="office-gallery-card flex-fill">
            <div class="office-photo-box">
              <span class="office-photo-badge"><i class="fas fa-camera me-1"></i> Boardroom</span>
              <img src="<?= base_url('assets/images/about/office2.jpeg'); ?>" alt="Nandini Executive Boardroom">
            </div>
            <div class="office-card-body">
              <h4>Executive Boardroom &amp; Conference Suite</h4>
              <p>Features an expansive Italian marble conference table, premium executive seating, and integrated presentation amenities for dealer alliances.</p>
              <div class="card-meta">
                <span><i class="fas fa-check-circle me-1"></i> Dealer Meets &amp; Strategy</span>
                <span class="ms-auto text-muted small"><i class="fas fa-expand me-1"></i> Corporate Suite</span>
              </div>
            </div>
          </div>

          <!-- Photo Card 2: Skyline Lounge -->
          <div class="office-gallery-card flex-fill">
            <div class="office-photo-box">
              <span class="office-photo-badge"><i class="fas fa-eye me-1"></i> Cityscape</span>
              <img src="<?= base_url('assets/images/about/office1.jpeg'); ?>" alt="Nandini Office Skyline View">
            </div>
            <div class="office-card-body">
              <h4>Executive Lounge &amp; Cityscape View</h4>
              <p>Floor-to-ceiling glass wall design with vibrant indoor botanical planters offering natural daylighting and an inspiring panoramic view across the city.</p>
              <div class="card-meta">
                <span><i class="fas fa-check-circle me-1"></i> Collaborative Atmosphere</span>
                <span class="ms-auto text-muted small"><i class="fas fa-seedling me-1"></i> Green Space</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Additional Gallery Row: Executive Hall & Leadership Suite -->
    <div class="row g-4 mt-2" data-aos="fade-up">
      <div class="col-md-6">
        <div class="office-gallery-card">
          <div class="office-photo-box">
            <span class="office-photo-badge"><i class="fas fa-building me-1"></i> Conference Hall</span>
            <img src="<?= base_url('assets/images/about/office3.jpeg'); ?>" alt="Nandini Executive Conference Hall">
          </div>
          <div class="office-card-body">
            <h4>Executive Conference Hall &amp; Media Center</h4>
            <p>Spacious, acoustically-optimized boardroom featuring recessed ceiling lighting, conference amenities, and dedicated executive meeting zones.</p>
            <div class="card-meta">
              <span><i class="fas fa-check-circle me-1"></i> Multi-Brand Summits</span>
              <span class="ms-auto text-muted small"><i class="fas fa-arrows-alt me-1"></i> Wide Panorama</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="office-gallery-card">
          <div class="office-photo-box">
            <span class="office-photo-badge"><i class="fas fa-handshake me-1"></i> Strategy Suite</span>
            <img src="<?= base_url('assets/images/about/office4.jpeg'); ?>" alt="Nandini Strategy Suite">
          </div>
          <div class="office-card-body">
            <h4>Strategic Planning &amp; Leadership Suite</h4>
            <p>Designed for high-impact negotiations, vendor onboarding, and executive presentations with direct access to our core administrative team.</p>
            <div class="card-meta">
              <span><i class="fas fa-check-circle me-1"></i> Dealer Onboarding</span>
              <span class="ms-auto text-muted small"><i class="fas fa-shield-alt me-1"></i> Executive Hub</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ===== OUR STRENGTH / MISSION VISION SECTION ===== -->
<section class="mission-vision-section py-5">
  <div class="container py-5">
    <div class="section-title text-center" data-aos="fade-up">
      <span class="tag">What Sets Us Apart</span>
      <h2>Our <span>Strength</span></h2>
      <p>Built on decades of manufacturing expertise and distribution excellence.</p>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="50">
        <div class="mv-card">
          <div class="mv-icon"><i class="fas fa-calendar-check"></i></div>
          <h4>35+ Years Experience</h4>
          <p>A business journey built on decades of experience in manufacturing, wholesale and distribution.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="mv-card featured">
          <div class="mv-icon"><i class="fas fa-map-marked-alt"></i></div>
          <h4>Strong Maharashtra Network</h4>
          <p>Established relationships with dealers, stockists and retailers across Maharashtra markets.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
        <div class="mv-card">
          <div class="mv-icon"><i class="fas fa-tags"></i></div>
          <h4>Reputed Brand Associations</h4>
          <p>We work with established brands like Marlex, Kanchan and Greenchef, offering a diverse portfolio.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="mv-card">
          <div class="mv-icon"><i class="fas fa-tools"></i></div>
          <h4>Manufacturing Expertise</h4>
          <p>Our cookware and utensil manufacturing background gives us valuable product &amp; market knowledge.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
        <div class="mv-card">
          <div class="mv-icon"><i class="fas fa-boxes-stacked"></i></div>
          <h4>Wide Product Range</h4>
          <p>Kitchenware, cookware, pressure cookers, home appliances and utility products under one roof.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== OUR JOURNEY TIMELINE SECTION ===== -->
<section class="timeline-section py-5">
  <div class="container py-5">
    <div class="section-title text-center" data-aos="fade-up">
      <span class="tag tag-light">Our History</span>
      <h2 class="text-white">Our <span>Journey</span> Through The Years</h2>
      <p class="text-light-grey">From manufacturing roots to becoming a trusted distribution name.</p>
    </div>

    <div class="timeline-wrap">

      <div class="timeline-item left" data-aos="fade-right">
        <div class="timeline-content">
          <span class="timeline-year">1988</span>
          <h5>The Beginning</h5>
          <p>Ratnadeep Metal Industries was established in Nashik for manufacturing aluminium products.</p>
        </div>
      </div>

      <div class="timeline-item right" data-aos="fade-left">
        <div class="timeline-content">
          <span class="timeline-year">1989</span>
          <h5>Manufacturing Expansion</h5>
          <p>Expanded manufacturing activities and strengthened our presence in the kitchenware industry.</p>
        </div>
      </div>

      <div class="timeline-item left" data-aos="fade-right">
        <div class="timeline-content">
          <span class="timeline-year">1993</span>
          <h5>Entering Dealership</h5>
          <p>Royal Dealers was established for wholesale dealership of home appliances, kitchenware and modern utensils.</p>
        </div>
      </div>

      <div class="timeline-item right" data-aos="fade-left">
        <div class="timeline-content">
          <span class="timeline-year">2003</span>
          <h5>Non-Stick Manufacturing</h5>
          <p>Started manufacturing Non-Stick Cookware under Nandini Kitchen Appliances.</p>
        </div>
      </div>

      <div class="timeline-item left" data-aos="fade-right">
        <div class="timeline-content">
          <span class="timeline-year">2006</span>
          <h5>Hard Anodised Cookware</h5>
          <p>Established a dedicated manufacturing facility for Hard Anodised Cookware.</p>
        </div>
      </div>

      <div class="timeline-item right" data-aos="fade-left">
        <div class="timeline-content">
          <span class="timeline-year">2010</span>
          <h5>Pressure Cookers</h5>
          <p>Expanded the product range into Pressure Cookers and Hard Anodised Pressure Cookers.</p>
        </div>
      </div>

      <div class="timeline-item left" data-aos="fade-right">
        <div class="timeline-content">
          <span class="timeline-year">2019</span>
          <h5>Copper Utensils</h5>
          <p>Started manufacturing Copper Utensils under Shreya Laxmi Metal, broadening our product categories.</p>
        </div>
      </div>

      <div class="timeline-item right" data-aos="fade-left">
        <div class="timeline-content">
          <span class="timeline-year">Today</span>
          <h5>Distribution &amp; Market Expansion</h5>
          <p>Focused on distribution of reputed kitchen and home appliance brands, serving dealers, retailers and business partners across Maharashtra.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== FOUNDER MESSAGE SECTION ===== -->
<?php
$founder_img = (!empty($settings['founder_image']) && file_exists(FCPATH . 'uploads/founder/' . $settings['founder_image']))
  ? base_url('uploads/founder/' . $settings['founder_image'])
  : base_url('assets/images/about/founder2.jpeg');

$founder_name     = !empty($settings['founder_name']) ? trim($settings['founder_name']) : '';
$founder_title    = !empty($settings['founder_title']) ? trim($settings['founder_title']) : 'Founder & Managing Director';
$founder_subtitle = !empty($settings['founder_subtitle']) ? trim($settings['founder_subtitle']) : 'Nandini Appliances';
$founder_message  = !empty($settings['founder_message']) ? trim($settings['founder_message']) : "Our journey from manufacturing to distribution has been driven by one constant belief — quality and trust are non-negotiable. As we transitioned into a new chapter, our commitment to our partners, dealers, and customers has only grown stronger. Nandini is not just a business; it's a legacy we continue to build every single day.";
?>
<section class="founder-section py-5">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <div class="col-lg-5 text-center text-lg-start" data-aos="fade-right">
        <div class="founder-img-wrap">
          <div class="founder-img-box">
            <img src="<?= $founder_img; ?>" alt="<?= htmlspecialchars(!empty($founder_name) ? $founder_name : $founder_title); ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/about/founder2.jpeg'); ?>';">
          </div>
          <div class="founder-quote-icon"><i class="fas fa-quote-right"></i></div>
        </div>
      </div>

      <div class="col-lg-7" data-aos="fade-left">
        <span class="tag">Message From Our Founder</span>
        <h2 class="mb-4">Building Trust, <span>One Partnership</span> At A Time</h2>
        <p class="founder-text">
          &ldquo;<?= nl2br(htmlspecialchars(trim($founder_message, " \t\n\r\0\x0B\"'“”"))); ?>&rdquo;
        </p>
        <div class="founder-info">
          <?php if (!empty($founder_name)): ?>
            <h5><?= htmlspecialchars($founder_name); ?></h5>
            <span><?= htmlspecialchars($founder_title); ?><?= !empty($founder_subtitle) ? ' &bull; ' . htmlspecialchars($founder_subtitle) : ''; ?></span>
          <?php else: ?>
            <h5><?= htmlspecialchars($founder_title); ?></h5>
            <span><?= htmlspecialchars($founder_subtitle); ?></span>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== OUR ASSOCIATED FIRMS SECTION ===== -->
<section class="associated-firms-section py-5" id="associatedFirms">
  <div class="container py-4">

    <div class="section-title text-center mb-5" data-aos="fade-up">
      <span class="tag">Group Synergy &amp; Sister Concerns</span>
      <h2>Our <span>Associated Firms</span></h2>
      <p class="mx-auto" style="max-width: 760px;">
        Behind Nandini’s trusted distribution excellence stands an interconnected group ecosystem spanning heavy industrial manufacturing, statewide wholesale stockist operations, and heritage devotional trade across Maharashtra.
      </p>
    </div>

    <div class="row g-4 justify-content-center">

      <!-- FIRM 1: Ratnadeep Metals -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="firm-card">
          <div class="firm-img-wrap">
            <span class="firm-badge-top"><i class="fas fa-industry"></i> Manufacturing &bull; Est. 1988</span>
            <img src="<?= base_url('assets/images/about/ratnadeep.jpeg'); ?>" alt="Ratnadeep Metals - Manufacturers of Aluminium Utensils &amp; Circles">
          </div>
          <div class="firm-body">
            <div class="firm-title-wrap">
              <span class="firm-devanagari">रत्नादीप मेटल इंडस्ट्रीज</span>
              <h3>Ratnadeep Metals</h3>
            </div>
            <div class="firm-tagline">
              <i class="fas fa-certificate me-1 text-gold"></i> Manufacturers of Aluminium Utensils &amp; Circles
            </div>
            <p class="firm-desc">
              Established in 1988 in Nashik, Ratnadeep Metals is the foundational manufacturing pillar of our group. Equipped with advanced rolling mills, circle blanking machinery, and hydraulic deep-draw presses, the firm manufactures virgin food-grade aluminium circles, heavy-duty commercial cooking vessels, and kitchenware blanks renowned for uniform thickness, pure metallurgy, and long-lasting durability.
            </p>
            <div class="firm-highlights">
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Aluminium Circles &amp; Discs</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Deep-Drawn Utensils</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Virgin Metallurgy</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Registered Trademark &reg;</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Bulk Industrial Supply</span>
            </div>
          </div>
        </div>
      </div>

      <!-- FIRM 2: Royaldeep Sales Syndicate -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="firm-card">
          <div class="firm-img-wrap">
            <span class="firm-badge-top"><i class="fas fa-truck-fast"></i> Wholesale &bull; Est. 1993</span>
            <img src="<?= base_url('assets/images/about/royaldeep.jpeg'); ?>" alt="Royaldeep Sales Syndicate - Stockist and Wholesalers of Utensils &amp; Home Appliances">
          </div>
          <div class="firm-body">
            <div class="firm-title-wrap">
              <span class="firm-devanagari">रॉयलदीप सेल्स सिंडिकेट</span>
              <h3>Royaldeep Sales Syndicate</h3>
            </div>
            <div class="firm-tagline">
              <i class="fas fa-boxes-stacked me-1 text-gold"></i> Stockist &amp; Wholesalers of Utensils &amp; Home Appliances
            </div>
            <p class="firm-desc">
              Founded in 1993 to spearhead large-scale commercial trading, Royaldeep Sales Syndicate is a premier regional master stockist and wholesale distributor. Serving hundreds of retail counters, supermarkets, and appliance dealers across Maharashtra, Royaldeep provides high-volume inventory availability, competitive wholesale pricing, and swift multi-district fulfillment across modern cookware and home appliances.
            </p>
            <div class="firm-highlights">
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Master Regional Stockist</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Cookware &amp; Pressure Cookers</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Home &amp; Kitchen Appliances</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> High-Volume Warehousing</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Pan-Maharashtra Network</span>
            </div>
          </div>
        </div>
      </div>

      <!-- FIRM 3: Nagesh Traders -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="firm-card">
          <div class="firm-img-wrap">
            <span class="firm-badge-top"><i class="fas fa-om"></i> Devotional Heritage</span>
            <img src="<?= base_url('assets/images/about/nagesh.jpeg'); ?>" alt="Nagesh Traders - Wholesale Puja Articles">
          </div>
          <div class="firm-body">
            <div class="firm-title-wrap">
              <span class="firm-devanagari">नागेश ट्रेडर्स</span>
              <h3>Nagesh Traders</h3>
            </div>
            <div class="firm-tagline">
              <i class="fas fa-bell me-1 text-gold"></i> Wholesale Puja Articles &amp; Traditional Brassware
            </div>
            <p class="firm-desc">
              Steeped in spiritual tradition and artisan metalcraft, Nagesh Traders is the group’s revered specialty wing dedicated to the wholesale supply of authentic puja articles. With a wide array of heavy-gauge brass, pure copper, bronze, and auspicious ritual ware—from temple samais and akhand diyas to embossed kalash and thali sets—Nagesh Traders serves religious merchants and festive retailers across Western India.
            </p>
            <div class="firm-highlights">
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Wholesale Puja Articles</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Pure Brass &amp; Copper Samai</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Akhand Diyas &amp; Kalash Sets</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Traditional Temple Ware</span>
              <span class="firm-chip"><i class="fas fa-circle-dot"></i> Artisanal Hand-Finish</span>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Group Synergy Banner -->
    <div class="row mt-5" data-aos="fade-up">
      <div class="col-lg-11 mx-auto">
        <div class="group-synergy-banner">
          <div class="row align-items-center g-4">
            <div class="col-md-8 text-center text-md-start">
              <span class="synergy-tag"><i class="fas fa-handshake me-1"></i> Integrated Group Strength</span>
              <h4 class="mb-2">A Complete Ecosystem From Raw Metal to Retail Counters</h4>
              <p class="mb-0 text-muted">
                From virgin aluminium circle rolling and deep-draw pressings at <strong>Ratnadeep Metals</strong>, to master stockist distribution at <strong>Royaldeep Sales Syndicate</strong>, sacred ritual craft at <strong>Nagesh Traders</strong>, and authorized brand leadership at <strong>Nandini</strong> — our group delivers end-to-end reliability for business partners across India.
              </p>
            </div>
            <div class="col-md-4 text-center text-md-end">
              <a href="<?= site_url('contact?enquiry=' . urlencode('Associated Firms Partnership Enquiry')); ?>" class="btn-primary-custom">Partner With Our Group <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
          </div>
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
        <h2 class="text-white">Ready to Become Our <span>Authorized Dealer?</span></h2>
        <p class="text-light-grey mb-4">Join hands with a trusted name in kitchen appliance distribution and unlock new business opportunities today.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <a href="<?= site_url('distributor'); ?>" class="btn-primary-custom">Apply Now <i class="fas fa-arrow-right ms-2"></i></a>
          <a href="tel:<?= $phone_raw; ?>" class="btn-outline-light-custom"><i class="fas fa-phone-alt me-2"></i>Call Us Now</a>
        </div>
      </div>
    </div>
  </div>
</section>