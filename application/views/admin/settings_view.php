<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Founder Section Styles for 100% Visual Parity with About Us Page -->
<link rel="stylesheet" href="<?= base_url('assets/css/founder.css?v=2.0'); ?>">

<!-- Page-Scoped Styles -->
<style>
    .settings-header {
        margin-bottom: 1.5rem;
    }

    .settings-title {
        font-family: var(--font-heading, 'Playfair Display', serif);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--dark-text, #1A1A1A);
        margin: 0;
    }

    /* Section Cards */
    .settings-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color, #E5E7EB);
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: box-shadow 0.2s ease;
    }

    .settings-card:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    .settings-card-header {
        background-color: #F9FAFB;
        border-bottom: 1px solid var(--border-color, #E5E7EB);
        padding: 1.1rem 1.4rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .settings-card-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--dark-text, #1A1A1A);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-icon-badge {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .badge-icon-red {
        background-color: rgba(200, 16, 46, 0.1);
        color: var(--primary-red, #C8102E);
    }

    .badge-icon-blue {
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563EB;
    }

    .badge-icon-green {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10B981;
    }

    .badge-icon-purple {
        background-color: rgba(147, 51, 234, 0.1);
        color: #9333EA;
    }

    .badge-icon-gold {
        background-color: rgba(212, 175, 55, 0.15);
        color: #B38F26;
    }

    .settings-card-body {
        padding: 1.4rem;
    }

    /* Form Inputs & Labels */
    .form-label-custom {
        font-size: 0.82rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #4B5563;
        margin-bottom: 0.4rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .form-control-custom, .form-control-custom:focus {
        border-radius: 8px;
        border: 1px solid #D1D5DB;
        padding: 0.62rem 0.85rem;
        font-size: 0.9rem;
        color: #1F2937;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: var(--primary-red, #C8102E);
        box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.12);
        outline: none;
    }

    .input-group-custom .input-group-text {
        background-color: #F9FAFB;
        border: 1px solid #D1D5DB;
        border-right: none;
        border-radius: 8px 0 0 8px;
        padding: 0.62rem 0.85rem;
        color: #6B7280;
        font-size: 0.95rem;
    }

    .input-group-custom .form-control-custom {
        border-radius: 0 8px 8px 0;
    }

    .form-hint {
        font-size: 0.77rem;
        color: #6B7280;
        margin-top: 0.35rem;
    }

    /* Primary Red Button Theme */
    .btn-save-settings {
        background-color: var(--primary-red, #C8102E);
        border: 1px solid var(--primary-red, #C8102E);
        color: #FFFFFF;
        font-weight: 600;
        font-size: 0.92rem;
        padding: 0.65rem 2rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(200, 16, 46, 0.25);
    }

    .btn-save-settings:hover, .btn-save-settings:focus {
        background-color: var(--dark-red, #9B0D23);
        border-color: var(--dark-red, #9B0D23);
        color: #FFFFFF;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(200, 16, 46, 0.32);
    }

    .btn-save-settings:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    /* Sandboxed Map Preview Box */
    .map-preview-box {
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        overflow: hidden;
        min-height: 260px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .map-preview-box iframe {
        width: 100% !important;
        height: 280px !important;
        border: 0;
        display: block;
    }

    .map-placeholder {
        padding: 2rem;
        text-align: center;
        color: #9CA3AF;
    }

    /* Sticky Bottom Actions Bar */
    .settings-bottom-bar {
        background: #FFFFFF;
        border: 1px solid var(--border-color, #E5E7EB);
        border-radius: 12px;
        padding: 1rem 1.4rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .updated-pill {
        font-size: 0.78rem;
        font-weight: 500;
        background-color: #F3F4F6;
        color: #4B5563;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid #E5E7EB;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>

<div class="container-fluid p-0">

    <!-- Header Section -->
    <div class="settings-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="settings-title">Website Settings</h1>
            <p class="text-muted small mb-0 mt-1">Configure global business contact channels, location coordinates, social links, and WhatsApp quick chat.</p>
        </div>
        <div>
            <span class="updated-pill" id="lastUpdatedBadge">
                <i class="fa-regular fa-clock text-primary"></i>
                <span>Last saved: <strong id="lastUpdatedText"><?= !empty($settings->updated_at) ? date('M d, Y h:i A', strtotime($settings->updated_at)) : 'Never' ?></strong></span>
            </span>
        </div>
    </div>

    <!-- Main Settings Form -->
    <form id="settingsForm" action="<?= base_url('admin/settings/save') ?>" method="POST" enctype="multipart/form-data" novalidate>

        <!-- SECTION 1: Contact Information -->
        <div class="settings-card">
            <div class="settings-card-header">
                <h3 class="settings-card-title">
                    <span class="section-icon-badge badge-icon-red">
                        <i class="fa-solid fa-address-book"></i>
                    </span>
                    <span>1. Contact Information</span>
                </h3>
                <span class="badge bg-light text-muted border fw-normal" style="font-size: 0.75rem;">Header & Footer Channels</span>
            </div>
            <div class="settings-card-body">
                <div class="row g-3">
                    <!-- Phone Numbers -->
                    <div class="col-md-6">
                        <label for="phone_numbers" class="form-label-custom">
                            <span>Phone Numbers</span>
                            <span class="text-muted small fw-normal">Comma-separated</span>
                        </label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                            <input type="text" 
                                   class="form-control form-control-custom" 
                                   id="phone_numbers" 
                                   name="phone_numbers" 
                                   value="<?= html_escape($settings->phone_numbers ?? '') ?>" 
                                   placeholder="e.g. +91 98765 43210, +91 98765 43211"
                                   maxlength="255">
                        </div>
                        <div class="form-hint">Displayed in site header, top bar, and contact section.</div>
                    </div>

                    <!-- Email Addresses -->
                    <div class="col-md-6">
                        <label for="emails" class="form-label-custom">
                            <span>Email Addresses</span>
                            <span class="text-muted small fw-normal">Comma-separated</span>
                        </label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                            <input type="text" 
                                   class="form-control form-control-custom" 
                                   id="emails" 
                                   name="emails" 
                                   value="<?= html_escape($settings->emails ?? '') ?>" 
                                   placeholder="e.g. info@nandini.com, sales@nandini.com"
                                   maxlength="255">
                        </div>
                        <div class="form-hint">Official email inboxes for general and sales inquiries.</div>
                    </div>

                    <!-- Working / Operating Hours -->
                    <div class="col-12">
                        <label for="working_hours" class="form-label-custom">
                            <span>Operating / Working Hours</span>
                        </label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                            <input type="text" 
                                   class="form-control form-control-custom" 
                                   id="working_hours" 
                                   name="working_hours" 
                                   value="<?= html_escape($settings->working_hours ?? '') ?>" 
                                   placeholder="e.g. Monday - Saturday: 9:00 AM - 7:00 PM (Sunday Closed)"
                                   maxlength="150">
                        </div>
                        <div class="form-hint">Working schedule displayed on website footer and contact page.</div>
                    </div>

                    <!-- Physical Address -->
                    <div class="col-12">
                        <label for="address" class="form-label-custom">
                            <span>Registered Office / Factory Address</span>
                        </label>
                        <textarea class="form-control form-control-custom" 
                                  id="address" 
                                  name="address" 
                                  rows="3" 
                                  placeholder="e.g. Plot No. 12, GIDC Industrial Estate, Rajkot, Gujarat - 360002, India"><?= html_escape($settings->address ?? '') ?></textarea>
                        <div class="form-hint">Physical postal address displayed for correspondence and logistics.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Map Embed Code -->
        <div class="settings-card">
            <div class="settings-card-header">
                <h3 class="settings-card-title">
                    <span class="section-icon-badge badge-icon-blue">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </span>
                    <span>2. Google Maps Location Embed</span>
                </h3>
                <span class="badge bg-light text-muted border fw-normal" style="font-size: 0.75rem;">Interactive Map</span>
            </div>
            <div class="settings-card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label for="map_embed_code" class="form-label-custom">
                            <span>Map Embed HTML / URL</span>
                        </label>
                        <textarea class="form-control form-control-custom font-monospace" 
                                  id="map_embed_code" 
                                  name="map_embed_code" 
                                  rows="6" 
                                  style="font-size: 0.8rem;"
                                  placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'><?= html_escape($settings->map_embed_code ?? '') ?></textarea>
                        <div class="form-hint">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i>
                            Paste the full <code>&lt;iframe&gt;...&lt;/iframe&gt;</code> code from Google Maps (<strong>Share &rarr; Embed a map</strong>) or the embed URL. Unsafe scripts are automatically stripped and rendered in a sandbox.
                        </div>
                    </div>

                    <!-- Live Sandboxed Map Preview -->
                    <div class="col-lg-6">
                        <label class="form-label-custom">
                            <span>Live Map Preview (Sandboxed)</span>
                            <span class="text-success small fw-semibold" id="mapStatusText"><i class="fa-solid fa-shield-halved me-1"></i>Secure Sandbox</span>
                        </label>
                        <div class="map-preview-box shadow-sm" id="mapPreviewContainer">
                            <?php if (!empty($settings->map_embed_code)): ?>
                                <?= $settings->map_embed_code ?>
                            <?php else: ?>
                                <div class="map-placeholder" id="mapPlaceholder">
                                    <i class="fa-solid fa-map fa-3x text-muted opacity-50 mb-2"></i>
                                    <div class="fw-semibold text-dark">No Map Embed Configured</div>
                                    <small class="text-muted">Paste your Google Maps iframe embed code on the left to see live preview.</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Social Media Links -->
        <div class="settings-card">
            <div class="settings-card-header">
                <h3 class="settings-card-title">
                    <span class="section-icon-badge badge-icon-purple">
                        <i class="fa-solid fa-share-nodes"></i>
                    </span>
                    <span>3. Social Media Profiles</span>
                </h3>
                <span class="badge bg-light text-muted border fw-normal" style="font-size: 0.75rem;">Brand Presence</span>
            </div>
            <div class="settings-card-body">
                <div class="row g-3">
                    <!-- Facebook -->
                    <div class="col-md-6">
                        <label for="social_facebook" class="form-label-custom">Facebook Page URL</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-brands fa-facebook-f text-primary"></i></span>
                            <input type="url" 
                                   class="form-control form-control-custom" 
                                   id="social_facebook" 
                                   name="social_facebook" 
                                   value="<?= html_escape($settings->social_facebook ?? '') ?>" 
                                   placeholder="https://facebook.com/nandiniofficial"
                                   maxlength="255">
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div class="col-md-6">
                        <label for="social_instagram" class="form-label-custom">Instagram Profile URL</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-brands fa-instagram" style="color: #E1306C;"></i></span>
                            <input type="url" 
                                   class="form-control form-control-custom" 
                                   id="social_instagram" 
                                   name="social_instagram" 
                                   value="<?= html_escape($settings->social_instagram ?? '') ?>" 
                                   placeholder="https://instagram.com/nandiniofficial"
                                   maxlength="255">
                        </div>
                    </div>

                    <!-- LinkedIn -->
                    <div class="col-md-6">
                        <label for="social_linkedin" class="form-label-custom">LinkedIn Page URL</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-brands fa-linkedin-in" style="color: #0A66C2;"></i></span>
                            <input type="url" 
                                   class="form-control form-control-custom" 
                                   id="social_linkedin" 
                                   name="social_linkedin" 
                                   value="<?= html_escape($settings->social_linkedin ?? '') ?>" 
                                   placeholder="https://linkedin.com/company/nandini"
                                   maxlength="255">
                        </div>
                    </div>

                    <!-- WhatsApp Community / Channel Link -->
                    <div class="col-md-6">
                        <label for="social_whatsapp" class="form-label-custom">WhatsApp Channel / Group Link</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-brands fa-whatsapp text-success"></i></span>
                            <input type="url" 
                                   class="form-control form-control-custom" 
                                   id="social_whatsapp" 
                                   name="social_whatsapp" 
                                   value="<?= html_escape($settings->social_whatsapp ?? '') ?>" 
                                   placeholder="https://chat.whatsapp.com/... or https://wa.me/..."
                                   maxlength="255">
                        </div>
                    </div>

                    <!-- YouTube -->
                    <div class="col-12">
                        <label for="social_youtube" class="form-label-custom">YouTube Channel URL</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-brands fa-youtube text-danger"></i></span>
                            <input type="url" 
                                   class="form-control form-control-custom" 
                                   id="social_youtube" 
                                   name="social_youtube" 
                                   value="<?= html_escape($settings->social_youtube ?? '') ?>" 
                                   placeholder="https://youtube.com/@nandiniofficial"
                                   maxlength="255">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: WhatsApp Direct Contact -->
        <div class="settings-card">
            <div class="settings-card-header">
                <h3 class="settings-card-title">
                    <span class="section-icon-badge badge-icon-green">
                        <i class="fa-brands fa-whatsapp"></i>
                    </span>
                    <span>4. WhatsApp Quick Chat</span>
                </h3>
                <span class="badge bg-light text-muted border fw-normal" style="font-size: 0.75rem;">Instant Messaging</span>
            </div>
            <div class="settings-card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-7">
                        <label for="whatsapp_number" class="form-label-custom">
                            <span>WhatsApp Contact Number</span>
                            <span class="text-muted small fw-normal">With country code</span>
                        </label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="fa-solid fa-mobile-screen-button"></i></span>
                            <input type="text" 
                                   class="form-control form-control-custom" 
                                   id="whatsapp_number" 
                                   name="whatsapp_number" 
                                   value="<?= html_escape($settings->whatsapp_number ?? '') ?>" 
                                   placeholder="e.g. 919876543210 (digits only)"
                                   maxlength="20">
                        </div>
                        <div class="form-hint">
                            Primary number connected to the floating WhatsApp widget. Use international format without <code>+</code> or hyphens (e.g. <code>919876543210</code>).
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="p-3 bg-light rounded-3 border">
                            <div class="text-muted small fw-semibold mb-1 text-uppercase" style="font-size: 0.72rem;">Live WhatsApp Link Preview:</div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '') ?>" 
                                   id="whatsappPreviewLink" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="btn btn-outline-success btn-sm d-inline-flex align-items-center gap-2 fw-semibold text-truncate <?= empty($settings->whatsapp_number) ? 'disabled' : '' ?>">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <span id="whatsappPreviewText"><?= !empty($settings->whatsapp_number) ? 'wa.me/' . preg_replace('/[^0-9]/', '', $settings->whatsapp_number) : 'Enter number to test' ?></span>
                                    <i class="fa-solid fa-arrow-up-right-from-square small opacity-75"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 5: Founder & Managing Director -->
        <div class="settings-card">
            <div class="settings-card-header">
                <h3 class="settings-card-title">
                    <span class="section-icon-badge badge-icon-gold">
                        <i class="fa-solid fa-user-tie"></i>
                    </span>
                    <span>5. Founder &amp; Managing Director</span>
                </h3>
                <span class="badge bg-light text-dark border px-3 py-1">About Us Page Showcase</span>
            </div>
            <div class="settings-card-body">
                <div class="row g-4">
                    <!-- Left Column: Details & Message -->
                    <div class="col-lg-7">
                        <div class="row g-3">
                            <!-- Founder Full Name -->
                            <div class="col-12">
                                <label for="founder_name" class="form-label-custom">
                                    <span>Founder &amp; Managing Director Name</span>
                                    <span class="text-muted small fw-normal">(Optional Person Name)</span>
                                </label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text"><i class="fa-solid fa-signature"></i></span>
                                    <input type="text" 
                                           class="form-control form-control-custom" 
                                           id="founder_name" 
                                           name="founder_name" 
                                           value="<?= html_escape($settings->founder_name ?? '') ?>" 
                                           placeholder="e.g. Deepak Mohan Agrawal"
                                           maxlength="150">
                                </div>
                                <div class="form-hint">Displayed prominently as the leader's name on the website About Us page.</div>
                            </div>

                            <!-- Executive Title / Designation -->
                            <div class="col-md-6">
                                <label for="founder_title" class="form-label-custom">
                                    <span>Designation / Role Title</span>
                                </label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                                    <input type="text" 
                                           class="form-control form-control-custom" 
                                           id="founder_title" 
                                           name="founder_title" 
                                           value="<?= html_escape(!empty($settings->founder_title) ? $settings->founder_title : 'Founder & Managing Director') ?>" 
                                           placeholder="e.g. Founder & Managing Director"
                                           maxlength="150">
                                </div>
                                <div class="form-hint">Official executive title shown to website visitors.</div>
                            </div>

                            <!-- Company / Subtitle -->
                            <div class="col-md-6">
                                <label for="founder_subtitle" class="form-label-custom">
                                    <span>Company / Subtitle</span>
                                </label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                                    <input type="text" 
                                           class="form-control form-control-custom" 
                                           id="founder_subtitle" 
                                           name="founder_subtitle" 
                                           value="<?= html_escape(!empty($settings->founder_subtitle) ? $settings->founder_subtitle : 'Nandini Appliances') ?>" 
                                           placeholder="e.g. Nandini Appliances"
                                           maxlength="150">
                                </div>
                                <div class="form-hint">Organization or brand subtitle shown below designation.</div>
                            </div>

                            <!-- Founder Message / Quote -->
                            <div class="col-12">
                                <label for="founder_message" class="form-label-custom">
                                    <span>Message / Quote From Founder</span>
                                    <span class="text-muted small fw-normal">Inspirational Quote</span>
                                </label>
                                <textarea class="form-control form-control-custom" 
                                          id="founder_message" 
                                          name="founder_message" 
                                          rows="4" 
                                          placeholder="Enter the founder's quote or leave blank for default heritage quote..."><?= html_escape($settings->founder_message ?? '') ?></textarea>
                                <div class="form-hint">Displayed in quotation format on the About Us page founder section.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: High Quality Portrait & Preview Button -->
                    <div class="col-lg-5">
                        <?php
                            $founder_img_src = (!empty($settings->founder_image) && file_exists(FCPATH . 'uploads/founder/' . $settings->founder_image))
                                ? base_url('uploads/founder/' . $settings->founder_image)
                                : base_url('assets/images/about/founder2.jpeg');
                            $has_custom_founder_img = (!empty($settings->founder_image) && file_exists(FCPATH . 'uploads/founder/' . $settings->founder_image));
                        ?>
                        <div class="founder-upload-box p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <label class="form-label-custom mb-0"><span>Founder Portrait Photo</span></label>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small fw-semibold" style="font-size: 0.72rem;">
                                        <i class="fa-solid fa-shield-halved me-1"></i> Ultra-High Quality Allowed
                                    </span>
                                </div>
                                <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">
                                    Upload professional studio portraits in any quality, resolution, or format (up to 100MB).
                                </p>

                                <!-- Portrait Image Box -->
                                <div class="position-relative text-center mb-3">
                                    <div class="founder-thumb-wrap mx-auto" style="width: 170px; height: 210px; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 24px rgba(0,0,0,0.12); position: relative; background: #E5E7EB;">
                                        <img src="<?= $founder_img_src; ?>" 
                                             id="founderImageThumb" 
                                             alt="Founder Photo" 
                                             style="width: 100%; height: 100%; object-fit: cover; object-position: top center;"
                                             onerror="this.onerror=null; this.src='<?= base_url('assets/images/about/founder2.jpeg'); ?>';">
                                        <div class="founder-thumb-overlay position-absolute bottom-0 start-0 end-0 py-1 bg-dark bg-opacity-75 text-white small" style="font-size: 0.72rem;">
                                            <span id="founderThumbStatusText"><?= $has_custom_founder_img ? 'Custom Photo Active' : 'Default Photo' ?></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Input (hidden, triggered by button) -->
                                <input type="file" 
                                       id="founder_image" 
                                       name="founder_image" 
                                       class="d-none" 
                                       accept="image/*,.jpg,.jpeg,.png,.webp,.bmp,.gif,.tif,.tiff,.svg,.avif,.heic,.heif">
                                <input type="hidden" id="remove_founder_image" name="remove_founder_image" value="0">

                                <div class="d-flex gap-2 justify-content-center mb-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm px-3 fw-semibold d-inline-flex align-items-center gap-2" id="btnChooseFounderImage">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        <span id="btnChooseFounderText"><?= $has_custom_founder_img ? 'Change Photo' : 'Upload New Photo' ?></span>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm px-3 fw-semibold <?= $has_custom_founder_img ? '' : 'd-none' ?>" id="btnRemoveFounderImage" title="Revert to default photo">
                                        <i class="fa-solid fa-trash-can me-1"></i> Revert
                                    </button>
                                </div>

                                <div class="text-center text-muted small mb-3" style="font-size: 0.73rem;">
                                    Supports: JPG, PNG, WEBP, BMP, SVG, TIFF, AVIF, HEIC (Max 100MB)
                                </div>
                            </div>

                            <!-- Live User Side Preview Action Button -->
                            <div class="pt-2 border-top">
                                <button type="button" 
                                        class="btn btn-primary-custom-preview w-100 py-2 d-inline-flex align-items-center justify-content-center gap-2 fw-semibold text-white shadow-sm"
                                        id="btnPreviewFounderWebsite"
                                        style="background: linear-gradient(135deg, #C8102E 0%, #A00C23 100%); border: none; border-radius: 10px; font-size: 0.92rem;">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>Preview How It Looks on User Side</span>
                                </button>
                                <div class="text-center mt-1">
                                    <small class="text-muted" style="font-size: 0.72rem;">
                                        <i class="fa-solid fa-circle-info me-1"></i> Previews instantly with your latest text and photo
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Bottom Save Bar -->
        <div class="settings-bottom-bar mb-5">
            <div class="d-flex align-items-center gap-2 text-muted small">
                <i class="fa-solid fa-circle-check text-success"></i>
                <span>Strict single-row persistence. Edits always update live settings directly.</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="reset" class="btn btn-outline-secondary px-4 fw-semibold" id="btnResetSettings">
                    <i class="fa-solid fa-rotate-left me-1"></i> Discard
                </button>
                <button type="submit" class="btn btn-save-settings d-inline-flex align-items-center gap-2" id="btnSaveSettings">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span id="btnSaveText">Save Changes</span>
                </button>
            </div>
        </div>

    </form>

    <!-- Live User Side Preview Modal for Founder & Managing Director -->
    <div class="modal fade" id="founderPreviewModal" tabindex="-1" aria-labelledby="founderPreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 25px 60px rgba(0,0,0,0.25);">
                <!-- Modal Header -->
                <div class="modal-header px-4 py-3 bg-light border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="founderPreviewModalLabel" style="font-family: var(--font-heading, 'Playfair Display', serif);">
                            <i class="fa-solid fa-display text-danger"></i>
                            <span>Website Live Preview &mdash; Founder &amp; Managing Director Section</span>
                        </h5>
                        <p class="text-muted small mb-0">Exact simulation of how this section renders to visitors on the About Us page (<code>/about</code>).</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="<?= base_url('about') ?>" target="_blank" class="btn btn-sm btn-outline-secondary d-none d-sm-inline-flex align-items-center gap-1">
                            <span>Visit Live About Page</span>
                            <i class="fa-solid fa-arrow-up-right-from-square small"></i>
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                <!-- Modal Body (100% Visual Parity with About Us page via founder.css) -->
                <div class="modal-body p-4 p-md-5 founder-section" style="background: #FFFFFF;">
                    <div class="container-fluid">
                        <div class="row align-items-center g-5">
                            <!-- Left: Founder Image with circular quote badge -->
                            <div class="col-lg-5 text-center text-lg-start">
                                <div class="founder-img-wrap">
                                    <div class="founder-img-box">
                                        <img src="<?= $founder_img_src; ?>" 
                                             id="modalFounderImgPreview" 
                                             alt="Founder Preview">
                                    </div>
                                    <div class="founder-quote-icon">
                                        <i class="fas fa-quote-right"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Tag, Heading, Quote, and Name/Designation -->
                            <div class="col-lg-7">
                                <span class="tag">Message From Our Founder</span>
                                <h2 class="mb-4">
                                    Building Trust, <span>One Partnership</span> At A Time
                                </h2>
                                <p class="founder-text mb-4" id="modalFounderQuotePreview">
                                    &ldquo;Our journey from manufacturing to distribution has been driven by one constant belief &mdash; quality and trust are non-negotiable. As we transitioned into a new chapter, our commitment to our partners, dealers, and customers has only grown stronger. Nandini is not just a business; it's a legacy we continue to build every single day.&rdquo;
                                </p>
                                <div class="founder-info">
                                    <h5 id="modalFounderNamePreview">
                                        Founder &amp; Managing Director
                                    </h5>
                                    <span id="modalFounderTitlePreview">
                                        Nandini Appliances
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer px-4 py-3 bg-light border-top d-flex justify-content-between align-items-center">
                    <span class="text-muted small">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Interactive live preview generated in real-time
                    </span>
                    <button type="button" class="btn btn-secondary px-4 fw-semibold" data-bs-dismiss="modal">Close Preview</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript: Live Form AJAX Save, Toast Alert, Map Sanitization & Input Re-population -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const settingsForm = document.getElementById('settingsForm');
    const btnSave = document.getElementById('btnSaveSettings');
    const btnSaveText = document.getElementById('btnSaveText');
    const lastUpdatedText = document.getElementById('lastUpdatedText');
    const mapEmbedTextarea = document.getElementById('map_embed_code');
    const mapPreviewContainer = document.getElementById('mapPreviewContainer');
    const whatsappInput = document.getElementById('whatsapp_number');
    const whatsappLink = document.getElementById('whatsappPreviewLink');
    const whatsappText = document.getElementById('whatsappPreviewText');

    // Founder & Managing Director Elements
    const founderImageInput = document.getElementById('founder_image');
    const btnChooseFounderImage = document.getElementById('btnChooseFounderImage');
    const btnChooseFounderText = document.getElementById('btnChooseFounderText');
    const btnRemoveFounderImage = document.getElementById('btnRemoveFounderImage');
    const removeFounderImageInput = document.getElementById('remove_founder_image');
    const founderImageThumb = document.getElementById('founderImageThumb');
    const founderThumbStatusText = document.getElementById('founderThumbStatusText');
    const btnPreviewFounderWebsite = document.getElementById('btnPreviewFounderWebsite');
    const founderPreviewModalEl = document.getElementById('founderPreviewModal');
    const modalFounderImgPreview = document.getElementById('modalFounderImgPreview');
    const modalFounderNamePreview = document.getElementById('modalFounderNamePreview');
    const modalFounderTitlePreview = document.getElementById('modalFounderTitlePreview');
    const modalFounderQuotePreview = document.getElementById('modalFounderQuotePreview');
    const defaultFounderImg = '<?= base_url('assets/images/about/founder2.jpeg') ?>';
    const defaultFounderQuote = "Our journey from manufacturing to distribution has been driven by one constant belief — quality and trust are non-negotiable. As we transitioned into a new chapter, our commitment to our partners, dealers, and customers has only grown stronger. Nandini is not just a business; it's a legacy we continue to build every single day.";

    // Trigger photo file selection
    if (btnChooseFounderImage && founderImageInput) {
        btnChooseFounderImage.addEventListener('click', function() {
            founderImageInput.click();
        });

        // Instant FileReader client-side image preview
        founderImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    founderImageThumb.src = e.target.result;
                    modalFounderImgPreview.src = e.target.result;
                    const nameSnippet = file.name.length > 20 ? file.name.substring(0, 18) + '...' : file.name;
                    founderThumbStatusText.textContent = 'Selected: ' + nameSnippet;
                    btnChooseFounderText.textContent = 'Change Photo';
                    btnRemoveFounderImage.classList.remove('d-none');
                    removeFounderImageInput.value = '0';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Revert/Remove custom photo
    if (btnRemoveFounderImage) {
        btnRemoveFounderImage.addEventListener('click', function() {
            founderImageInput.value = '';
            removeFounderImageInput.value = '1';
            founderImageThumb.src = defaultFounderImg;
            modalFounderImgPreview.src = defaultFounderImg;
            founderThumbStatusText.textContent = 'Reverted to Default (Unsaved)';
            btnRemoveFounderImage.classList.add('d-none');
            btnChooseFounderText.textContent = 'Upload New Photo';
        });
    }

    // Live User Side Preview Modal Trigger
    if (btnPreviewFounderWebsite && founderPreviewModalEl) {
        btnPreviewFounderWebsite.addEventListener('click', function() {
            const name = (document.getElementById('founder_name').value || '').trim();
            const title = (document.getElementById('founder_title').value || '').trim() || 'Founder & Managing Director';
            const subtitle = (document.getElementById('founder_subtitle').value || '').trim() || 'Nandini Appliances';
            const msg = (document.getElementById('founder_message').value || '').trim();

            if (name) {
                modalFounderNamePreview.textContent = name;
                modalFounderTitlePreview.textContent = title + (subtitle ? ' • ' + subtitle : '');
            } else {
                modalFounderNamePreview.textContent = title;
                modalFounderTitlePreview.textContent = subtitle;
            }

            const cleanQuote = msg ? msg.replace(/^[“"']+|[”"']+$/g, '') : defaultFounderQuote;
            modalFounderQuotePreview.innerHTML = '&ldquo;' + cleanQuote.replace(/\n/g, '<br>') + '&rdquo;';

            const bsModal = bootstrap.Modal.getOrCreateInstance(founderPreviewModalEl);
            bsModal.show();
        });
    }

    // Configured sleek Toast matching global dashboard aesthetic
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    // Check if flashdata toast_success was passed from server redirect
    <?php if ($this->session->flashdata('toast_success')): ?>
        Toast.fire({
            icon: 'success',
            title: '<?= addslashes($this->session->flashdata('toast_success')) ?>'
        });
    <?php endif; ?>

    // Live WhatsApp test link updater
    function updateWhatsAppPreview() {
        const raw = whatsappInput.value || '';
        const digits = raw.replace(/[^0-9]/g, '');
        if (digits.length > 0) {
            whatsappLink.href = 'https://wa.me/' + digits;
            whatsappText.textContent = 'wa.me/' + digits;
            whatsappLink.classList.remove('disabled');
        } else {
            whatsappLink.href = '#';
            whatsappText.textContent = 'Enter number to test';
            whatsappLink.classList.add('disabled');
        }
    }
    whatsappInput.addEventListener('input', updateWhatsAppPreview);

    // Live Map Embed Previewer
    function updateMapPreview(content) {
        const trimmed = (content || '').trim();
        if (!trimmed) {
            mapPreviewContainer.innerHTML = `
                <div class="map-placeholder">
                    <i class="fa-solid fa-map fa-3x text-muted opacity-50 mb-2"></i>
                    <div class="fw-semibold text-dark">No Map Embed Configured</div>
                    <small class="text-muted">Paste your Google Maps iframe embed code on the left to see live preview.</small>
                </div>
            `;
            return;
        }

        // If it's a direct URL
        if (trimmed.startsWith('http://') || trimmed.startsWith('https://')) {
            const safeUrl = trimmed.replace(/"/g, '&quot;');
            mapPreviewContainer.innerHTML = `<iframe src="${safeUrl}" sandbox="allow-scripts allow-same-origin" loading="lazy" style="border:0; width:100%; height:280px;"></iframe>`;
            return;
        }

        // If it contains an iframe
        if (trimmed.includes('<iframe')) {
            // Strip any scripts or onerror event handlers for client-side preview safety
            let sanitized = trimmed.replace(/<script\b[^>]*>(.*?)<\/script>/gi, '')
                                   .replace(/on\w+\s*=/gi, '')
                                   .replace(/javascript:/gi, '');
            // Inject sandbox attribute into iframe for defense-in-depth
            if (!sanitized.includes('sandbox=')) {
                sanitized = sanitized.replace('<iframe', '<iframe sandbox="allow-scripts allow-same-origin"');
            }
            mapPreviewContainer.innerHTML = sanitized;
        } else {
            mapPreviewContainer.innerHTML = `
                <div class="map-placeholder">
                    <i class="fa-solid fa-triangle-exclamation fa-2x text-warning mb-2"></i>
                    <div class="fw-semibold text-dark">Invalid Map Embed Code</div>
                    <small class="text-muted">Please provide a valid &lt;iframe&gt; code or map URL.</small>
                </div>
            `;
        }
    }

    // Debounced live map preview on typing
    let mapTimer = null;
    mapEmbedTextarea.addEventListener('input', function() {
        clearTimeout(mapTimer);
        mapTimer = setTimeout(() => {
            updateMapPreview(this.value);
        }, 350);
    });

    // Form Submission: Submit via AJAX, re-fill with fresh DB response, and display Toast
    settingsForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Visual loading state
        btnSave.disabled = true;
        btnSaveText.textContent = 'Saving...';
        const originalIcon = btnSave.querySelector('i').className;
        btnSave.querySelector('i').className = 'fa-solid fa-spinner fa-spin';

        const formData = new FormData(settingsForm);

        fetch(settingsForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Server returned HTTP ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            btnSave.disabled = false;
            btnSaveText.textContent = 'Save Changes';
            btnSave.querySelector('i').className = originalIcon;

            if (data.status === 'success') {
                // Re-populate form with fresh confirmed database values
                if (data.settings) {
                    const s = data.settings;
                    document.getElementById('phone_numbers').value = s.phone_numbers || '';
                    document.getElementById('emails').value = s.emails || '';
                    document.getElementById('address').value = s.address || '';
                    document.getElementById('working_hours').value = s.working_hours || '';
                    document.getElementById('map_embed_code').value = s.map_embed_code || '';
                    document.getElementById('social_facebook').value = s.social_facebook || '';
                    document.getElementById('social_instagram').value = s.social_instagram || '';
                    document.getElementById('social_linkedin').value = s.social_linkedin || '';
                    document.getElementById('social_whatsapp').value = s.social_whatsapp || '';
                    document.getElementById('social_youtube').value = s.social_youtube || '';
                    document.getElementById('whatsapp_number').value = s.whatsapp_number || '';

                    // Founder fields re-population
                    document.getElementById('founder_name').value = s.founder_name || '';
                    document.getElementById('founder_title').value = s.founder_title || 'Founder & Managing Director';
                    document.getElementById('founder_subtitle').value = s.founder_subtitle || 'Nandini Appliances';
                    document.getElementById('founder_message').value = s.founder_message || '';
                    removeFounderImageInput.value = '0';
                    founderImageInput.value = '';

                    if (s.founder_image_url) {
                        founderImageThumb.src = s.founder_image_url;
                        modalFounderImgPreview.src = s.founder_image_url;
                    }
                    if (s.founder_image) {
                        founderThumbStatusText.textContent = 'Custom Photo Active';
                        btnRemoveFounderImage.classList.remove('d-none');
                        btnChooseFounderText.textContent = 'Change Photo';
                    } else {
                        founderThumbStatusText.textContent = 'Default Photo';
                        btnRemoveFounderImage.classList.add('d-none');
                        btnChooseFounderText.textContent = 'Upload New Photo';
                    }

                    // Update timestamp badge
                    if (s.updated_at) {
                        const dateObj = new Date(s.updated_at.replace(/-/g, "/"));
                        lastUpdatedText.textContent = dateObj.toLocaleDateString('en-US', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true
                        });
                    }

                    // Update live previews
                    updateMapPreview(s.map_embed_code);
                    updateWhatsAppPreview();
                }

                // Fire success toast
                Toast.fire({
                    icon: 'success',
                    title: data.message || 'Settings saved successfully.'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Save Failed',
                    html: data.message || 'Unable to save settings. Please check your input.',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'swal2-nandani-popup',
                        confirmButton: 'swal2-nandani-btn'
                    }
                });
            }
        })
        .catch(err => {
            btnSave.disabled = false;
            btnSaveText.textContent = 'Save Changes';
            btnSave.querySelector('i').className = originalIcon;

            Swal.fire({
                icon: 'error',
                title: 'Network / Server Error',
                text: err.message || 'An error occurred while connecting to the server.',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal2-nandani-popup',
                    confirmButton: 'swal2-nandani-btn'
                }
            });
        });
    });

    // Reset button handler to reload initial state
    document.getElementById('btnResetSettings').addEventListener('click', function() {
        setTimeout(() => {
            updateMapPreview(mapEmbedTextarea.value);
            updateWhatsAppPreview();
            founderImageInput.value = '';
            removeFounderImageInput.value = '0';
            <?php if (!empty($settings->founder_image) && file_exists(FCPATH . 'uploads/founder/' . $settings->founder_image)): ?>
                founderImageThumb.src = '<?= base_url('uploads/founder/' . $settings->founder_image) ?>';
                modalFounderImgPreview.src = '<?= base_url('uploads/founder/' . $settings->founder_image) ?>';
                founderThumbStatusText.textContent = 'Custom Photo Active';
                btnRemoveFounderImage.classList.remove('d-none');
                btnChooseFounderText.textContent = 'Change Photo';
            <?php else: ?>
                founderImageThumb.src = defaultFounderImg;
                modalFounderImgPreview.src = defaultFounderImg;
                founderThumbStatusText.textContent = 'Default Photo';
                btnRemoveFounderImage.classList.add('d-none');
                btnChooseFounderText.textContent = 'Upload New Photo';
            <?php endif; ?>
        }, 50);
    });
});
</script>
