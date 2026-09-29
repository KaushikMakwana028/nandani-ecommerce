<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$whatsapp_clean = !empty($settings['whatsapp_number']) ? preg_replace('/[^0-9]/', '', $settings['whatsapp_number']) : '911234567890';
?>
<!-- ===== FOOTER ===== -->
<footer class="footer-section">
  <div class="footer-pattern"></div>
  <div class="container position-relative">
    <div class="row g-4 py-5">

      <div class="col-lg-4 col-md-6">
        <img src="<?= base_url('assets/images/logo-white.png'); ?>" alt="Nandani" class="footer-logo mb-3" onerror="this.onerror=null; this.src='<?= base_url('assets/images/logo.png'); ?>';">
        <p class="text-light-grey">From decades of manufacturing legacy to trusted distribution excellence — Nandani continues to bring quality kitchen appliances closer to every home.</p>
        <div class="footer-social">
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
            <?php $wa_link = !empty($settings['social_whatsapp']) ? $settings['social_whatsapp'] : 'https://wa.me/' . $whatsapp_clean; ?>
            <a href="<?= htmlspecialchars($wa_link); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <?php else: ?>
            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-lg-2 col-md-6">
        <h5 class="footer-title">Quick Links</h5>
        <ul class="footer-links">
          <li><a href="<?= site_url('about'); ?>">About Us</a></li>
          <li><a href="<?= site_url('brands'); ?>">Our Brands</a></li>
          <li><a href="<?= site_url('products'); ?>">Products</a></li>
          <li><a href="<?= site_url('gallery'); ?>">Gallery</a></li>
          <li><a href="<?= site_url('distributor'); ?>">Become a Distributor</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <h5 class="footer-title">Product Categories</h5>
        <ul class="footer-links">
          <?php if (!empty($categories)): ?>
            <?php $cat_limit = 0; foreach ($categories as $cat_item): if ($cat_limit++ >= 5) break; ?>
              <li><a href="<?= site_url('products?category=' . $cat_item->id); ?>"><?= htmlspecialchars($cat_item->name); ?></a></li>
            <?php endforeach; ?>
          <?php else: ?>
            <li><a href="<?= site_url('products'); ?>">Gas Stoves & Hobs</a></li>
            <li><a href="<?= site_url('products'); ?>">Mixer Grinders</a></li>
            <li><a href="<?= site_url('products'); ?>">Cookware & Non-Stick</a></li>
            <li><a href="<?= site_url('products'); ?>">Kitchen Chimneys</a></li>
          <?php endif; ?>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <h5 class="footer-title">Newsletter</h5>
        <p class="text-light-grey">Subscribe to get updates on new brand partnerships & offers.</p>
        <form class="footer-newsletter" onsubmit="event.preventDefault(); alert('Thank you for subscribing to our newsletter!'); this.reset();">
          <input type="email" placeholder="Your Email" required>
          <button type="submit" aria-label="Subscribe to newsletter"><i class="fas fa-paper-plane"></i></button>
        </form>
      </div>

    </div>

    <div class="footer-bottom">
      <div class="row align-items-center">
        <div class="col-md-6">
          <p class="mb-0">© <?= date('Y'); ?> Nandani. All Rights Reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <p class="mb-0">Designed with <i class="fas fa-heart" style="color:var(--gold)"></i> for Nandani</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/<?= $whatsapp_clean; ?>" class="whatsapp-float" target="_blank" aria-label="Chat with Nandani on WhatsApp">
  <i class="fab fa-whatsapp"></i>
</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- Custom JS -->
<script src="<?= base_url('assets/js/main.js'); ?>"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- Custom Slider JS -->
<script src="<?= base_url('assets/js/slider.js'); ?>"></script>
<!-- Counter JS -->
<script src="<?= base_url('assets/js/counter.js'); ?>"></script>

<?php if (isset($extra_js) && is_array($extra_js)): ?>
  <?php foreach ($extra_js as $js_file): ?>
    <script src="<?= base_url('assets/js/' . $js_file); ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
