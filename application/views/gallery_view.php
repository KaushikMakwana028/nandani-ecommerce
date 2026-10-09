<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gallery View - Visual Journey
 * Displays real gallery items from database with dynamic category filters,
 * responsive CSS masonry grid, and GLightbox popup preview.
 */

// Format phone numbers
$phone_display = '+91 123 456 7890';
$phone_raw = '+911234567890';
if (!empty($settings['phone_numbers'])) {
    $phones = array_map('trim', explode(',', $settings['phone_numbers']));
    if (!empty($phones[0])) {
        $phone_display = $phones[0];
        $phone_raw = preg_replace('/[^0-9+]/', '', $phones[0]);
    }
}

// Build gallery cards strictly from active database items (no dummy data)
$gallery_cards = [];
if (!empty($gallery_items)) {
    foreach ($gallery_items as $item) {
        $cat_name = !empty($item->category_name) ? trim($item->category_name) : 'Moments';
        $cat_slug = strtolower($cat_name);
        $cat_slug = preg_replace('/[^a-z0-9]+/', '-', $cat_slug);
        $cat_slug = trim($cat_slug, '-');
        if (empty($cat_slug)) {
            $cat_slug = 'cat-' . $item->category_id;
        }

        // Resolve gallery image file
        $img_url = '';
        if (!empty($item->image) && file_exists(FCPATH . 'uploads/gallery/' . $item->image)) {
            $img_url = base_url('uploads/gallery/' . $item->image);
        } elseif (!empty($item->image) && file_exists(FCPATH . 'assets/images/gallery/' . $item->image)) {
            $img_url = base_url('assets/images/gallery/' . $item->image);
        } else {
            $img_url = base_url('assets/images/gallery/gallery-1.jpg');
        }

        // Title / Caption
        $title = !empty($item->title_caption) ? trim($item->title_caption) : $cat_name;

        $gallery_cards[] = [
            'id'            => $item->id,
            'title'         => $title,
            'category_name' => $cat_name,
            'category_slug' => $cat_slug,
            'category_id'   => $item->category_id,
            'img_url'       => $img_url,
        ];
    }
}

// Collect unique categories strictly from available DB gallery items
$dynamic_filters = [];
foreach ($gallery_cards as $card) {
    $slug = $card['category_slug'];
    if (!empty($slug) && !isset($dynamic_filters[$slug])) {
        $dynamic_filters[$slug] = [
            'name' => $card['category_name'],
            'id'   => $card['category_id']
        ];
    }
}

// Determine active category filter
$active_filter_slug = 'all';
if (!empty($selected_category)) {
    $sel = strtolower(trim($selected_category));
    foreach ($dynamic_filters as $slug => $filter_data) {
        if ($sel == $filter_data['id'] || $sel === $slug || $sel === strtolower($filter_data['name'])) {
            $active_filter_slug = $slug;
            break;
        }
    }
}

// Masonry layout variation rhythm matching gallery.html (tall, wide patterns)
$box_patterns = ['tall', '', '', 'wide', '', 'tall', '', '', 'wide', '', '', ''];
?>

<!-- ===== PAGE BANNER ===== -->
<section class="page-banner" style="background-image:url('<?= base_url('assets/images/about/office3.jpeg'); ?>')">
  <div class="page-banner-overlay"></div>
  <div class="container position-relative">
    <div class="text-center" data-aos="fade-up">
      <span class="tag tag-light">Visual Journey</span>
      <h1 class="text-white">Gallery</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center mb-0">
          <li class="breadcrumb-item"><a href="<?= site_url(''); ?>">Home</a></li>
          <li class="breadcrumb-item active text-gold" aria-current="page">Gallery</li>
        </ol>
      </nav>
    </div>
  </div>
</section>

<!-- ===== GALLERY INTRO + FILTER ===== -->
<section class="gallery-page-section py-5">
  <div class="container py-4">

    <div class="section-title text-center" data-aos="fade-up">
      <span class="tag">Our Moments</span>
      <h2>A Glimpse Into <span>Nandani's World</span></h2>
      <p>Explore our warehouse, events, product showcases, and the people behind our success.</p>
    </div>

    <!-- Filter Buttons (Real categories only from DB) -->
    <div class="brand-filter text-center mb-5" data-aos="fade-up">
      <button class="filter-btn <?= ($active_filter_slug === 'all') ? 'active' : ''; ?>" data-filter="all">All</button>
      <?php foreach ($dynamic_filters as $f_slug => $f_info): ?>
        <button class="filter-btn <?= ($active_filter_slug === $f_slug) ? 'active' : ''; ?>" data-filter="<?= htmlspecialchars($f_slug); ?>"><?= htmlspecialchars($f_info['name']); ?></button>
      <?php endforeach; ?>
    </div>

    <!-- Gallery Masonry Grid -->
    <div class="gallery-masonry" id="galleryGrid">
      <?php if (!empty($gallery_cards)): ?>
        <?php foreach ($gallery_cards as $idx => $card): ?>
          <?php
            $box_class = (count($gallery_cards) > 1) ? $box_patterns[$idx % count($box_patterns)] : '';
            $delay = (($idx % 4) + 1) * 50;
            $is_hidden = ($active_filter_slug !== 'all' && $card['category_slug'] !== $active_filter_slug);
          ?>
          <div class="gallery-box <?= $box_class; ?> gallery-item <?= $is_hidden ? 'hide' : ''; ?>" data-category="<?= htmlspecialchars($card['category_slug']); ?>" data-aos="zoom-in" data-aos-delay="<?= $delay; ?>">
            <a href="<?= $card['img_url']; ?>" class="glightbox" data-gallery="gallery1" data-title="<?= htmlspecialchars($card['title']); ?>">
              <img src="<?= $card['img_url']; ?>" alt="<?= htmlspecialchars($card['title']); ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/gallery/gallery-1.jpg'); ?>';">
              <div class="gallery-hover">
                <i class="fas fa-search-plus"></i>
                <span><?= htmlspecialchars($card['title']); ?></span>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div id="noGalleryResults" class="text-center py-5" style="<?= empty($gallery_cards) ? '' : 'display:none;'; ?>">
      <div class="col-lg-8 mx-auto">
        <div class="empty-state-card p-5" style="background:#fff; border:1px solid #eee; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.06);">
          <div class="empty-icon-wrap mb-3" style="width:76px; height:76px; margin:0 auto; border-radius:50%; background:linear-gradient(135deg, rgba(200,16,46,0.1), rgba(212,175,55,0.15)); display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-camera-retro" style="font-size:30px; color:var(--gold);"></i>
          </div>
          <h4 class="mb-2" style="font-family:'Playfair Display', serif; font-weight:700;">No Gallery Media in This Category</h4>
          <p class="text-muted mb-4" style="max-width:480px; margin:0 auto;">There are currently no photos listed under this category filter. View all images or check back soon as our album is regularly refreshed.</p>
          <button type="button" class="btn-primary-custom" onclick="document.querySelector('.brand-filter .filter-btn[data-filter=\'all\']').click();">
            <i class="fas fa-undo me-2"></i>Show All Gallery Photos
          </button>
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
        <span class="tag tag-light">Grow With Nandani</span>
        <h2 class="text-white">Want to See More Of Our <span>Business In Action?</span></h2>
        <p class="text-light-grey mb-4">Visit our facility or connect with us to learn more about our operations and products.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <a href="<?= site_url('contact'); ?>" class="btn-primary-custom">Contact Us <i class="fas fa-arrow-right ms-2"></i></a>
          <a href="tel:<?= $phone_raw; ?>" class="btn-outline-light-custom"><i class="fas fa-phone-alt me-2"></i>Call Us Now</a>
        </div>
      </div>
    </div>
  </div>
</section>
