<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Specific Styles Scoped Inside Page -->
<style>
    .profile-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .profile-card-header {
        padding: 1.25rem 1.5rem;
        background-color: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    .profile-card-title {
        font-family: var(--font-heading);
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    .avatar-wrapper {
        position: relative;
        display: inline-block;
        margin: 0 auto;
    }

    .avatar-upload-box {
        position: relative;
        width: 130px;
        height: 130px;
        margin: 0 auto;
        border-radius: 50%;
        border: 4px solid var(--gold-accent, #FFC72C);
        background: linear-gradient(135deg, var(--primary-red, #C8102E), var(--dark-red, #8B0000));
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .avatar-upload-box:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 20px rgba(200, 16, 46, 0.25);
    }

    .avatar-preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-initial {
        font-size: 3.25rem;
        font-weight: 700;
        color: var(--gold-accent, #FFC72C);
        font-family: var(--font-heading, 'Playfair Display', serif);
    }

    .avatar-camera-btn {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-red, #C8102E), var(--dark-red, #8B0000));
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 3px solid #FFFFFF;
        box-shadow: 0 3px 10px rgba(200, 16, 46, 0.35);
        transition: all 0.2s ease;
        font-size: 0.95rem;
        z-index: 5;
    }

    .avatar-camera-btn:hover {
        background: linear-gradient(135deg, var(--dark-red, #8B0000), #5A0000);
        transform: scale(1.1);
        box-shadow: 0 5px 14px rgba(200, 16, 46, 0.5);
        color: #FFFFFF;
    }

    .avatar-camera-btn:active {
        transform: scale(0.95);
    }

    .badge-role-admin {
        background-color: var(--gold-accent);
        color: var(--dark-text);
        font-weight: 700;
        font-size: 0.8rem;
        padding: 6px 14px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-status-active-pill {
        background-color: #DCFCE7;
        color: #15803D;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 6px 14px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .form-label {
        font-size: 0.84rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.4rem;
    }

    .form-control, .form-select {
        font-size: 0.88rem;
        border-color: #D1D5DB;
        padding: 9px 12px;
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.15);
    }

    .form-control-readonly {
        background-color: #F9FAFB;
        color: #6B7280;
        cursor: not-allowed;
    }
</style>

<!-- Profile Settings Header -->
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="heading-serif mb-1" style="font-size: 1.75rem; font-weight: 700;">Profile Settings</h1>
        <p class="text-muted small mb-0">Manage your administrative credentials and personal details.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('admin/change-password') ?>" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center">
            <i class="fa-solid fa-key me-2"></i> Change Password
        </a>
    </div>
</div>

<?= form_open_multipart('admin/profile/update', ['id' => 'profileForm', 'novalidate' => 'novalidate']) ?>
<div class="row g-4">
    <!-- Left Column: Avatar & Read-Only Badges -->
    <div class="col-12 col-lg-4">
        <div class="profile-card text-center p-4">
            
            <!-- Avatar Upload Area with Floating Camera Button -->
            <div class="avatar-wrapper position-relative d-inline-block mx-auto mb-2">
                <div class="avatar-upload-box" id="avatarBox" title="Click to upload profile photo">
                    <?php if (!empty($user->profile_image) && file_exists(FCPATH . $user->profile_image)): ?>
                        <img src="<?= base_url($user->profile_image) ?>" alt="Avatar" class="avatar-preview-img" id="avatarPreview">
                    <?php else: ?>
                        <span class="avatar-initial" id="avatarInitial"><?= strtoupper(substr($user->name ?? 'A', 0, 1)) ?></span>
                        <img src="" alt="Avatar" class="avatar-preview-img d-none" id="avatarPreview">
                    <?php endif; ?>
                </div>

                <!-- Camera Upload Button -->
                <label for="profile_image" class="avatar-camera-btn" title="Upload profile photo" aria-label="Upload profile photo">
                    <i class="fa-solid fa-camera"></i>
                </label>
                <input type="file" 
                       class="d-none" 
                       id="profile_image" 
                       name="profile_image" 
                       accept="image/png, image/jpeg, image/jpg, image/webp">
            </div>

            <div class="text-muted small mb-3" style="font-size: 0.76rem;">
                <span class="text-secondary"><i class="fa-solid fa-camera me-1 opacity-75"></i>Click camera to change photo</span>
                <div class="opacity-75" style="font-size: 0.72rem;">JPG, PNG, WEBP &bull; Max 2MB</div>
            </div>

            <h4 class="fw-bold text-dark mb-1"><?= html_escape($user->name) ?></h4>
            <p class="text-muted small mb-3"><?= html_escape($user->email) ?></p>

            <!-- Read-Only Badges (Role & Status) -->
            <div class="d-flex justify-content-center gap-2 flex-wrap mb-4">
                <span class="badge-role-admin">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span><?= ((int)$user->role === 1) ? 'Admin' : 'User' ?></span>
                </span>
                <span class="badge-status-active-pill">
                    <i class="fa-solid fa-circle-check"></i>
                    <span><?= ((int)$user->status === 1) ? 'Active' : 'Inactive' ?></span>
                </span>
            </div>

            <div class="p-3 bg-light rounded-3 text-start small text-muted border">
                <div class="d-flex align-items-center mb-2">
                    <i class="fa-solid fa-circle-info text-primary me-2"></i>
                    <strong class="text-dark">Security Notice</strong>
                </div>
                <div>Role permissions and account active status are system-governed and cannot be modified from profile settings.</div>
            </div>

        </div>
    </div>

    <!-- Right Column: Profile Edit Form -->
    <div class="col-12 col-lg-8">
        <div class="profile-card">
            <div class="profile-card-header">
                <h3 class="profile-card-title">Edit Personal Details</h3>
            </div>
            
            <div class="p-4">
                <!-- Validation Errors (Inline) -->
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger py-2 px-3 small mb-4">
                        <?= validation_errors('<div class="mb-1"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                    </div>
                <?php endif; ?>

                <div class="row g-3 mb-3">
                    <!-- Full Name -->
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control <?= form_error('name') ? 'is-invalid' : '' ?>" 
                               id="name" 
                               name="name" 
                               value="<?= set_value('name', $user->name) ?>" 
                               required>
                        <div class="invalid-feedback">Full name is required.</div>
                    </div>

                    <!-- Email Address -->
                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" 
                               class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" 
                               id="email" 
                               name="email" 
                               value="<?= set_value('email', $user->email) ?>" 
                               required>
                        <div class="invalid-feedback">A valid email address is required.</div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <!-- Phone -->
                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" 
                               class="form-control" 
                               id="phone" 
                               name="phone" 
                               value="<?= set_value('phone', $user->phone) ?>" 
                               placeholder="+91 9876543210">
                    </div>

                    <!-- Account Role (Read-only) -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">System Role</label>
                        <input type="text" 
                               class="form-control form-control-readonly" 
                               value="<?= ((int)$user->role === 1) ? '1 — Admin (Full System Access)' : '0 — User' ?>" 
                               readonly>
                    </div>
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" 
                              id="address" 
                              name="address" 
                              rows="3" 
                              placeholder="Office / street address"><?= set_value('address', $user->address) ?></textarea>
                </div>

                <!-- Save Changes Button -->
                <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                    <button type="submit" class="btn btn-primary-red d-inline-flex align-items-center">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        <span>Save Profile</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Image Preview Script & Client UX Validation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('profile_image');
        const imgPreview = document.getElementById('avatarPreview');
        const initialText = document.getElementById('avatarInitial');
        const avatarBox = document.getElementById('avatarBox');

        // Clicking on avatar box triggers file input
        if (avatarBox && fileInput) {
            avatarBox.addEventListener('click', function() {
                fileInput.click();
            });
        }

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    // Check file size (2MB = 2097152 bytes)
                    if (file.size > 2097152) {
                        alert('Image size exceeds 2MB limit. Please choose a smaller image.');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (imgPreview) {
                            imgPreview.src = e.target.result;
                            imgPreview.classList.remove('d-none');
                        }
                        if (initialText) {
                            initialText.classList.add('d-none');
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
