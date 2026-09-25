<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Specific Styles Scoped Inside Page -->
<style>
    .change-pass-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        max-width: 640px;
    }

    .change-pass-header {
        padding: 1.25rem 1.5rem;
        background-color: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    .change-pass-title {
        font-family: var(--font-heading);
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    .form-label {
        font-size: 0.84rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.4rem;
    }

    .input-group-text {
        background-color: #F9FAFB;
        border-color: #D1D5DB;
        color: #9CA3AF;
    }

    .form-control {
        font-size: 0.88rem;
        border-color: #D1D5DB;
        padding: 9px 12px;
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.15);
    }

    .pass-criteria-box {
        background-color: #F9FAFB;
        border: 1px dashed #D1D5DB;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 0.8rem;
        color: #6B7280;
    }

    .pass-criteria-box ul {
        margin: 0;
        padding-left: 20px;
    }
</style>

<!-- Header Bar -->
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="heading-serif mb-1" style="font-size: 1.75rem; font-weight: 700;">Change Password</h1>
        <p class="text-muted small mb-0">Update your administrative access password to protect your account.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('admin/profile') ?>" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center">
            <i class="fa-solid fa-user-gear me-2"></i> Profile Settings
        </a>
    </div>
</div>

<!-- Change Password Card -->
<div class="change-pass-card">
    <div class="change-pass-header">
        <h3 class="change-pass-title">Update Security Credentials</h3>
    </div>

    <div class="p-4">
        <!-- Validation Errors (Inline) -->
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger py-2 px-3 small mb-4">
                <?= validation_errors('<div class="mb-1"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/change-password/update') ?>" method="POST" id="changePasswordForm" novalidate>
            <!-- Current Password -->
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" 
                           class="form-control <?= form_error('current_password') ? 'is-invalid' : '' ?>" 
                           id="current_password" 
                           name="current_password" 
                           placeholder="Enter your current password" 
                           required>
                    <button class="btn btn-outline-secondary toggle-pass-btn" type="button" data-target="current_password">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
                <div class="form-text text-muted small">Must verify before a new password can be accepted.</div>
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input type="password" 
                           class="form-control <?= form_error('new_password') ? 'is-invalid' : '' ?>" 
                           id="new_password" 
                           name="new_password" 
                           placeholder="Minimum 8 characters" 
                           required>
                    <button class="btn btn-outline-secondary toggle-pass-btn" type="button" data-target="new_password">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Confirm New Password -->
            <div class="mb-4">
                <label for="confirm_password" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-circle-check"></i></span>
                    <input type="password" 
                           class="form-control <?= form_error('confirm_password') ? 'is-invalid' : '' ?>" 
                           id="confirm_password" 
                           name="confirm_password" 
                           placeholder="Re-enter new password" 
                           required>
                    <button class="btn btn-outline-secondary toggle-pass-btn" type="button" data-target="confirm_password">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Password Advice Box -->
            <div class="pass-criteria-box mb-4">
                <div class="fw-semibold text-dark mb-1"><i class="fa-solid fa-shield-halved me-1 text-danger"></i> Password Requirements:</div>
                <ul>
                    <li>Minimum 8 characters in length</li>
                    <li>Both new password entries must match exactly</li>
                    <li>Stored using high-entropy bcrypt hashing with zero plain-text storage</li>
                </ul>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                <button type="submit" class="btn btn-primary-red d-inline-flex align-items-center">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    <span>Update Password</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Password Visibility & Client UX Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-pass-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');
                if (input) {
                    const isPass = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPass ? 'text' : 'password');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                }
            });
        });

        const form = document.getElementById('changePasswordForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const current = document.getElementById('current_password').value;
                const newPass = document.getElementById('new_password').value;
                const confirm = document.getElementById('confirm_password').value;
                let valid = true;

                if (!current) {
                    document.getElementById('current_password').classList.add('is-invalid');
                    valid = false;
                }
                if (newPass.length < 8) {
                    document.getElementById('new_password').classList.add('is-invalid');
                    valid = false;
                }
                if (newPass !== confirm || !confirm) {
                    document.getElementById('confirm_password').classList.add('is-invalid');
                    valid = false;
                }

                if (!valid) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
