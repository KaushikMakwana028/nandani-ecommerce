<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Extract primary phone and email from settings
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

$active_menu = isset($active_menu) ? $active_menu : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Nandani - Kitchen Appliance Distributors'; ?></title>
<meta name="description" content="<?= isset($meta_description) ? htmlspecialchars($meta_description) : 'Nandani - Trusted distributors of premium kitchen appliances across India. From manufacturing legacy to authorized distribution excellence.'; ?>">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/fav.png'); ?>">
<link rel="icon" type="image/png" sizes="48x48" href="<?= base_url('assets/images/fav.png'); ?>">
<link rel="apple-touch-icon" href="<?= base_url('assets/images/fav.png'); ?>">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/header.css'); ?>">
<!-- Swiper Slider CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<!-- Custom Hero CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/hero.css'); ?>">
<!-- Custom About CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/about.css'); ?>">
<!-- Custom Brands CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/brands.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/products-home.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/why-choose.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/network.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/cta-banner.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/testimonials.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/gallery-home.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/contact-strip.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/footer.css'); ?>">

<?php if (isset($extra_css) && is_array($extra_css)): ?>
  <?php foreach ($extra_css as $css_file): ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/' . $css_file); ?>">
  <?php endforeach; ?>
<?php endif; ?>
</head>
<body>

<!-- ===== TOP BAR ===== -->
<div class="top-bar" id="topBar">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">
    <div class="d-none d-md-block">
      <a href="tel:<?= $phone_raw; ?>"><i class="fas fa-phone-alt"></i><?= htmlspecialchars($phone_display); ?></a>
      <a href="mailto:<?= htmlspecialchars($email_display); ?>"><i class="fas fa-envelope"></i><?= htmlspecialchars($email_display); ?></a>
    </div>
    <div class="mx-auto mx-md-0 d-md-none">
      <a href="tel:<?= $phone_raw; ?>"><i class="fas fa-phone-alt"></i><?= htmlspecialchars($phone_display); ?></a>
    </div>
    <div class="social-icons d-none d-md-block">
      <?php if (!empty($settings['social_facebook'])): ?>
        <a href="<?= htmlspecialchars($settings['social_facebook']); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <?php else: ?>
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <?php endif; ?>

      <?php if (!empty($settings['social_instagram'])): ?>
        <a href="<?= htmlspecialchars($settings['social_instagram']); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <?php else: ?>
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <?php endif; ?>

      <?php if (!empty($settings['social_linkedin'])): ?>
        <a href="<?= htmlspecialchars($settings['social_linkedin']); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      <?php else: ?>
        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      <?php endif; ?>

      <?php if (!empty($settings['social_whatsapp']) || !empty($settings['whatsapp_number'])): ?>
        <?php $wa_link = !empty($settings['social_whatsapp']) ? $settings['social_whatsapp'] : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_number']); ?>
        <a href="<?= htmlspecialchars($wa_link); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      <?php else: ?>
        <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg main-navbar sticky-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url(''); ?>">
      <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Nandani Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><span></span></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav align-items-lg-center">
        <li class="nav-item"><a class="nav-link <?= $active_menu === 'home' ? 'active' : ''; ?>" href="<?= site_url(''); ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= $active_menu === 'about' ? 'active' : ''; ?>" href="<?= site_url('about'); ?>">About Us</a></li>
        <li class="nav-item"><a class="nav-link <?= $active_menu === 'brands' ? 'active' : ''; ?>" href="<?= site_url('brands'); ?>">Our Brands</a></li>
        <li class="nav-item"><a class="nav-link <?= $active_menu === 'products' ? 'active' : ''; ?>" href="<?= site_url('products'); ?>">Products</a></li>
        <li class="nav-item"><a class="nav-link <?= $active_menu === 'gallery' ? 'active' : ''; ?>" href="<?= site_url('gallery'); ?>">Gallery</a></li>
        <li class="nav-item"><a class="nav-link <?= $active_menu === 'contact' ? 'active' : ''; ?>" href="<?= site_url('contact'); ?>">Contact</a></li>
        <li class="nav-item ms-lg-3">
          <a href="<?= site_url('distributor'); ?>" class="btn-distributor">Become a Distributor</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
