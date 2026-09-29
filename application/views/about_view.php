<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
<section class="page-banner" style="background-image:url('<?= base_url('assets/images/about/about-banner.jpg'); ?>')">
  <div class="page-banner-overlay"></div>
  <div class="container position-relative">
    <div class="text-center" data-aos="fade-up">
      <span class="tag tag-light">Who We Are</span>
      <h1 class="text-white">About Nandani</h1>
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
            <img src="<?= base_url('assets/images/about/about-main.jpg'); ?>" alt="Nandani Facility">
          </div>
          <div class="intro-img-small">
            <img src="<?= base_url('assets/images/about/about-small.jpg'); ?>" alt="Nandani Products">
          </div>
          <div class="intro-badge">
            <i class="fas fa-award"></i>
            <span><span class="counter" data-target="25">0</span>+ Years</span>
          </div>
        </div>
      </div>

      <!-- RIGHT: Content -->
      <div class="col-lg-6" data-aos="fade-left">
        <span class="tag">Our Story</span>
        <h2 class="mb-4">Who We Are & <span>Where We Come From</span></h2>
        <p class="text-muted mb-3">
          Nandani began its journey decades ago as a dedicated manufacturer of kitchen appliances, building a reputation for quality, durability, and innovation. Our products once graced kitchens across the region, crafted with precision and care.
        </p>
        <p class="text-muted mb-4">
          Over time, as the market evolved, we recognized a greater opportunity — to leverage our deep industry knowledge and become a trusted bridge between India's most reputed kitchen appliance manufacturers and dealers nationwide. Today, Nandani proudly operates as an authorized distributor, carrying forward the same values of trust and quality that defined our manufacturing era.
        </p>

        <div class="row g-3">
          <div class="col-6">
            <div class="intro-tick"><i class="fas fa-check-circle"></i> Manufacturing Heritage</div>
          </div>
          <div class="col-6">
            <div class="intro-tick"><i class="fas fa-check-circle"></i> Authorized Distribution</div>
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
          Today, Nandani Kitchen Appliances Pvt. Ltd. operates primarily as a <strong>distributor in Maharashtra</strong>, representing established brands in the kitchen and home appliance industry. We work at the distributor level, partnering with reputed brands such as <strong>Marlex, Kanchan and Greenchef</strong>, along with a wide range of kitchenware, home appliances and utility products.
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
          <h5>Entering Distribution</h5>
          <p>Royal Distributors was established for wholesale distribution of home appliances, kitchenware and modern utensils.</p>
        </div>
      </div>

      <div class="timeline-item right" data-aos="fade-left">
        <div class="timeline-content">
          <span class="timeline-year">2003</span>
          <h5>Non-Stick Manufacturing</h5>
          <p>Started manufacturing Non-Stick Cookware under Nandani Kitchen Appliances.</p>
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
<section class="founder-section py-5">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <div class="col-lg-5" data-aos="fade-right">
        <div class="founder-img-wrap">
          <img src="<?= base_url('assets/images/about/founder.jpg'); ?>" alt="Founder">
          <div class="founder-quote-icon"><i class="fas fa-quote-right"></i></div>
        </div>
      </div>

      <div class="col-lg-7" data-aos="fade-left">
        <span class="tag">Message From Our Founder</span>
        <h2 class="mb-4">Building Trust, <span>One Partnership</span> At A Time</h2>
        <p class="founder-text">
          "Our journey from manufacturing to distribution has been driven by one constant belief — quality and trust are non-negotiable. As we transitioned into a new chapter, our commitment to our partners, dealers, and customers has only grown stronger. Nandani is not just a business; it's a legacy we continue to build every single day."
        </p>
        <div class="founder-info">
          <h5>Founder &amp; Managing Director</h5>
          <span>Nandani Appliances</span>
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
