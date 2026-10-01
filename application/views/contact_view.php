<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Contact Us View
 * Renders live contact information, working hours, and physical address from settings,
 * interactive Google Maps embed, social channels, and real-time enquiry form synced with Admin.
 */
?>

<!-- ===== PAGE BANNER ===== -->
<section class="page-banner" style="background-image:url('<?= base_url('assets/images/about/about-banner.jpg'); ?>')">
  <div class="page-banner-overlay"></div>
  <div class="container position-relative">
    <div class="text-center" data-aos="fade-up">
      <span class="tag tag-light">Get In Touch</span>
      <h1 class="text-white">Contact Us</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center mb-0">
          <li class="breadcrumb-item"><a href="<?= site_url(''); ?>">Home</a></li>
          <li class="breadcrumb-item active text-gold" aria-current="page">Contact</li>
        </ol>
      </nav>
    </div>
  </div>
</section>

<!-- ===== CONTACT INFO CARDS (From Settings) ===== -->
<section class="contact-info-cards-section py-5">
  <div class="container py-4">
    <div class="row g-4">

      <!-- Card 1: Our Office -->
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="50">
        <div class="contact-card">
          <div class="contact-card-icon"><i class="fas fa-map-marker-alt"></i></div>
          <h5>Our Office</h5>
          <p><?= nl2br(htmlspecialchars($address)); ?></p>
        </div>
      </div>

      <!-- Card 2: Call Us -->
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="contact-card">
          <div class="contact-card-icon"><i class="fas fa-phone-alt"></i></div>
          <h5>Call Us</h5>
          <p>
            <?php if (!empty($phone_numbers)): ?>
              <?php foreach ($phone_numbers as $idx => $p): ?>
                <a href="tel:<?= $p['raw']; ?>" class="d-block text-muted text-decoration-none hover-gold"><?= htmlspecialchars($p['display']); ?></a>
              <?php endforeach; ?>
            <?php else: ?>
              <a href="tel:<?= $phone_raw; ?>" class="d-block text-muted text-decoration-none hover-gold"><?= htmlspecialchars($phone_display); ?></a>
            <?php endif; ?>
          </p>
        </div>
      </div>

      <!-- Card 3: Email Us -->
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
        <div class="contact-card">
          <div class="contact-card-icon"><i class="fas fa-envelope"></i></div>
          <h5>Email Us</h5>
          <p>
            <?php if (!empty($emails)): ?>
              <?php foreach ($emails as $idx => $e): ?>
                <a href="mailto:<?= htmlspecialchars($e); ?>" class="d-block text-muted text-decoration-none hover-gold"><?= htmlspecialchars($e); ?></a>
              <?php endforeach; ?>
            <?php else: ?>
              <a href="mailto:<?= htmlspecialchars($email_display); ?>" class="d-block text-muted text-decoration-none hover-gold"><?= htmlspecialchars($email_display); ?></a>
            <?php endif; ?>
          </p>
        </div>
      </div>

      <!-- Card 4: Working Hours -->
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="contact-card">
          <div class="contact-card-icon"><i class="fas fa-clock"></i></div>
          <h5>Working Hours</h5>
          <p><?= nl2br(htmlspecialchars($working_hours)); ?></p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== CONTACT FORM + MAP SECTION ===== -->
<section class="contact-form-map-section py-5">
  <div class="container py-4">
    <div class="row g-5">

      <!-- Left Column: Contact Form -->
      <div class="col-lg-6" data-aos="fade-right">
        <span class="tag">Send a Message</span>
        <h2 class="mb-4">Have a Question? <span>Write to Us</span></h2>
        <p class="text-muted mb-4">Fill out the form below and our team will get back to you within 24 hours.</p>

        <?php if ($this->session->flashdata('contact_success')): ?>
          <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-check-circle me-2 fs-5"></i>
            <div><?= $this->session->flashdata('contact_success'); ?></div>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('contact_error')): ?>
          <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2 fs-5"></i>
            <div><?= $this->session->flashdata('contact_error'); ?></div>
          </div>
        <?php endif; ?>

        <div class="contact-form-box-full">
          <form id="contactForm" action="<?= site_url('contact/submit'); ?>" method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number *</label>
                <input type="tel" name="phone" class="form-control" placeholder="Enter phone number" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" placeholder="Enter your city">
              </div>
              <div class="col-12">
                <label class="form-label">Subject</label>
                <select name="subject" class="form-select">
                  <option value="General Enquiry" <?= ($prefill_subject === 'General Enquiry') ? 'selected' : ''; ?>>General Enquiry</option>
                  <option value="Product Enquiry" <?= ($prefill_subject === 'Product Enquiry') ? 'selected' : ''; ?>>Product Enquiry</option>
                  <option value="Distributorship Enquiry" <?= ($prefill_subject === 'Distributorship Enquiry') ? 'selected' : ''; ?>>Distributorship Enquiry</option>
                  <option value="Support" <?= ($prefill_subject === 'Support') ? 'selected' : ''; ?>>Support</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label">Your Message *</label>
                <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required><?= !empty($prefill_enquiry) ? htmlspecialchars($prefill_enquiry) : ''; ?></textarea>
              </div>
              <div class="col-12">
                <button type="submit" id="contactSubmitBtn" class="btn-primary-custom w-100">
                  <span class="btn-text">Send Message <i class="fas fa-paper-plane ms-2"></i></span>
                  <span class="btn-spinner d-none"><i class="fas fa-spinner fa-spin me-2"></i>Sending...</span>
                </button>
              </div>
            </div>
          </form>

          <div id="formErrorMsg" class="alert alert-danger mt-3" style="display:none;"></div>

          <div id="formSuccessMsg" class="form-success-msg" style="display:none;">
            <i class="fas fa-check-circle"></i>
            <p id="formSuccessText">Thank you! Your message has been sent successfully. We'll get back to you soon.</p>
          </div>
        </div>
      </div>

      <!-- Right Column: Map + Social Links -->
      <div class="col-lg-6" data-aos="fade-left">
        <span class="tag">Find Us Here</span>
        <h2 class="mb-4">Visit Our <span>Office</span></h2>
        <p class="text-muted mb-4">Drop by our office for an in-person consultation about our products and distributorship opportunities.</p>

        <div class="map-box">
          <?php
            if (!empty($map_embed_code)) {
                if (strpos($map_embed_code, '<iframe') !== false) {
                    $cleaned_map = preg_replace('/width=["\'][^"\']*["\']/i', 'width="100%"', $map_embed_code);
                    $cleaned_map = preg_replace('/height=["\'][^"\']*["\']/i', 'height="350"', $cleaned_map);
                    echo $cleaned_map;
                } else {
                    echo '<iframe src="' . htmlspecialchars($map_embed_code) . '" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
                }
            } else {
                $map_query = urlencode($address);
                echo '<iframe src="https://maps.google.com/maps?q=' . $map_query . '&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
            }
          ?>
        </div>

        <div class="social-connect-box mt-4">
          <h5>Connect With Us</h5>
          <div class="social-connect-icons">
            <?php if (!empty($settings['social_facebook'])): ?>
              <a href="<?= htmlspecialchars($settings['social_facebook']); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <?php endif; ?>

            <?php if (!empty($settings['social_instagram'])): ?>
              <a href="<?= htmlspecialchars($settings['social_instagram']); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>

            <?php if (!empty($settings['social_linkedin'])): ?>
              <a href="<?= htmlspecialchars($settings['social_linkedin']); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <?php endif; ?>

            <?php if (!empty($settings['social_whatsapp']) || !empty($settings['whatsapp_number'])): ?>
              <?php $wa_url = !empty($settings['social_whatsapp']) ? $settings['social_whatsapp'] : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_number']); ?>
              <a href="<?= htmlspecialchars($wa_url); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            <?php endif; ?>

            <?php if (!empty($settings['social_youtube'])): ?>
              <a href="<?= htmlspecialchars($settings['social_youtube']); ?>" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
