<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
    <form id="settingsForm" action="<?= base_url('admin/settings/save') ?>" method="POST" novalidate>

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
                                   placeholder="e.g. info@nandani.com, sales@nandani.com"
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
                                   placeholder="https://facebook.com/nandaniofficial"
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
                                   placeholder="https://instagram.com/nandaniofficial"
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
                                   placeholder="https://linkedin.com/company/nandani"
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
                                   placeholder="https://youtube.com/@nandaniofficial"
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
        }, 50);
    });
});
</script>
