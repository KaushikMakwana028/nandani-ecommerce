<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Specific Styles Scoped Inside Page -->
<style>
    .change-pass-wrapper {
        max-width: 960px;
    }

    .pass-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .pass-card-header {
        padding: 1.1rem 1.5rem;
        background-color: #FAFAFA;
        border-bottom: 1px solid var(--border-color);
    }

    .pass-card-title {
        font-family: var(--font-heading);
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    .form-label {
        font-size: 0.84rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.35rem;
    }

    .input-group-text {
        background-color: #F9FAFB;
        border-color: #D1D5DB;
        color: #9CA3AF;
        padding: 0 14px;
    }

    .pass-input {
        font-size: 0.88rem;
        border-color: #D1D5DB;
        padding: 9px 12px;
    }

    .pass-input:focus {
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.15);
    }

    /* Clean Eye Toggle Button */
    .btn-toggle-eye {
        border-color: #D1D5DB;
        background-color: #FFFFFF;
        color: #6B7280;
        padding: 0 14px;
        transition: all 0.15s ease;
    }

    .btn-toggle-eye:hover {
        background-color: #F3F4F6;
        color: var(--dark-text);
        border-color: #D1D5DB;
    }

    /* Security Guidelines Checklist */
    .sec-guide-card {
        background: linear-gradient(135deg, #FFFFFF 0%, #FFFDF8 100%);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .sec-icon-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: rgba(255, 199, 44, 0.2);
        color: #B27B00;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .sec-rule-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.83rem;
        color: #4B5563;
        margin-bottom: 0.75rem;
    }

    .sec-rule-item:last-child {
        margin-bottom: 0;
    }

    .sec-rule-item i {
        color: #16A34A;
        font-size: 0.85rem;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .btn-update-pass {
        background-color: var(--primary-red);
        border-color: var(--primary-red);
        color: var(--white);
        font-weight: 600;
        font-size: 0.9rem;
        padding: 10px 22px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-update-pass:hover, .btn-update-pass:focus {
        background-color: var(--dark-red) !important;
        border-color: var(--dark-red) !important;
        color: var(--white) !important;
        box-shadow: 0 4px 12px rgba(139, 0, 0, 0.25);
    }
</style>

<div class="change-pass-wrapper mx-auto">

    <!-- Header Title Bar -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
        <div>
            <h1 class="heading-serif mb-1" style="font-size: 1.75rem; font-weight: 700; color: var(--dark-text);">
                Change Password
            </h1>
            <p class="text-muted small mb-0">Update your administrative credentials to maintain system security.</p>
        </div>
        <div>
            <a href="<?= base_url('admin/profile') ?>" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center">
                <i class="fa-solid fa-user-gear me-2"></i> Profile Settings
            </a>
        </div>
    </div>

    <!-- Validation Errors -->
    <?php if (validation_errors()): ?>
        <div class="alert alert-danger py-2 px-3 small mb-4">
            <?= validation_errors('<div class="mb-1"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Left: Password Form Card -->
        <div class="col-12 col-lg-7">
            <div class="pass-card">
                <div class="pass-card-header">
                    <h3 class="pass-card-title">Update Security Credentials</h3>
                </div>

                <div class="p-4">
                    <form action="<?= base_url('admin/change-password/update') ?>" method="POST" id="changePasswordForm" novalidate>
                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" 
                                       class="form-control pass-input <?= form_error('current_password') ? 'is-invalid' : '' ?>" 
                                       id="current_password" 
                                       name="current_password" 
                                       placeholder="Enter your current password" 
                                       required>
                                <button class="btn btn-toggle-eye toggle-pass-btn" type="button" data-target="current_password" title="Toggle visibility">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            <div class="form-text text-muted small">Must be verified before a new password can be accepted.</div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                <input type="password" 
                                       class="form-control pass-input <?= form_error('new_password') ? 'is-invalid' : '' ?>" 
                                       id="new_password" 
                                       name="new_password" 
                                       placeholder="Minimum 8 characters" 
                                       required>
                                <button class="btn btn-toggle-eye toggle-pass-btn" type="button" data-target="new_password" title="Toggle visibility">
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
                                       class="form-control pass-input <?= form_error('confirm_password') ? 'is-invalid' : '' ?>" 
                                       id="confirm_password" 
                                       name="confirm_password" 
                                       placeholder="Re-enter new password" 
                                       required>
                                <button class="btn btn-toggle-eye toggle-pass-btn" type="button" data-target="confirm_password" title="Toggle visibility">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-light px-3">Cancel</a>
                            <button type="submit" class="btn btn-update-pass d-inline-flex align-items-center">
                                <i class="fa-solid fa-shield-halved me-2"></i>
                                <span>Update Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right: Security Guidelines Card -->
        <div class="col-12 col-lg-5">
            <div class="sec-guide-card">
                <div class="sec-icon-circle">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4 class="fw-bold text-dark fs-5 mb-2">Password Guidelines</h4>
                <p class="text-muted small mb-3">Please observe these security principles when choosing a new password:</p>

                <div class="sec-rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Minimum of 8 characters in length</span>
                </div>
                <div class="sec-rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Both new password entries must match exactly</span>
                </div>
                <div class="sec-rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Encrypted with strong, one-way bcrypt hashing</span>
                </div>
                <div class="sec-rule-item">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Zero plain-text password storage anywhere</span>
                </div>

                <div class="mt-4 pt-3 border-top small text-muted">
                    <i class="fa-solid fa-circle-info text-primary me-1"></i>
                    If you cannot recall your current password, you may use the <a href="<?= base_url('admin/forgot-password') ?>" class="text-decoration-underline" style="color: var(--primary-red);">Forgot Password</a> tool.
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Password Visibility & Client Validation Script -->
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
                } else {
                    document.getElementById('current_password').classList.remove('is-invalid');
                }

                if (newPass.length < 8) {
                    document.getElementById('new_password').classList.add('is-invalid');
                    valid = false;
                } else {
                    document.getElementById('new_password').classList.remove('is-invalid');
                }

                if (newPass !== confirm || !confirm) {
                    document.getElementById('confirm_password').classList.add('is-invalid');
                    valid = false;
                } else {
                    document.getElementById('confirm_password').classList.remove('is-invalid');
                }

                if (!valid) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
