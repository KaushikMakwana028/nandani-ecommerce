<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Nandani Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/logo.png') ?>">

    <!-- Google Fonts: Poppins (UI) & Playfair Display (Headings) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Scoped Reset Password Styles -->
    <style>
        :root {
            --primary-red: #C8102E;
            --dark-red: #8B0000;
            --gold-accent: #FFC72C;
            --dark-text: #1A1A1A;
            --light-bg: #F8F9FA;
            --white: #FFFFFF;
            --border-color: #E5E7EB;
            --font-body: 'Poppins', sans-serif;
            --font-heading: 'Playfair Display', serif;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--light-bg);
            color: var(--dark-text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            margin: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(200, 16, 46, 0.04) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 199, 44, 0.08) 0%, transparent 40%);
        }

        .reset-card {
            width: 100%;
            max-width: 460px;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            padding: 2.5rem 2.25rem;
            position: relative;
            overflow: hidden;
        }

        .reset-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--gold-accent), var(--primary-red));
        }

        .brand-header {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .brand-icon-wrap {
            width: 54px;
            height: 54px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, var(--gold-accent), #E5A800);
            color: var(--dark-text);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(255, 199, 44, 0.35);
        }

        .brand-title {
            font-family: var(--font-heading);
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--dark-text);
            margin: 0;
        }

        .brand-subtitle {
            font-size: 0.85rem;
            color: #6B7280;
            margin-top: 0.25rem;
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
            padding: 10px 12px;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.15);
        }

        .btn-reset {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
            color: var(--white);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 11px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(200, 16, 46, 0.25);
        }

        .btn-reset:hover, .btn-reset:focus, .btn-reset:active {
            background-color: var(--dark-red) !important;
            border-color: var(--dark-red) !important;
            color: var(--white) !important;
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.35);
        }

        .back-login-link {
            font-size: 0.85rem;
            color: #4B5563;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .back-login-link:hover {
            color: var(--primary-red);
        }
    </style>
</head>
<body>

<div class="reset-card">
    
    <!-- Brand & Heading -->
    <div class="brand-header text-center mb-4">
        <a href="<?= base_url() ?>" class="d-inline-block mb-3" title="Nandani">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Nandani Logo" class="reset-brand-logo" style="height: 70px; width: auto; object-fit: contain; filter: drop-shadow(0 4px 10px rgba(200, 16, 46, 0.18));">
        </a>
        <h1 class="brand-title">Reset Admin Password</h1>
        <p class="brand-subtitle">Enter your registered admin email to set a new password</p>
    </div>

    <!-- Error Alert -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2 px-3 small" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2 flex-shrink-0"></i>
            <div><?= $this->session->flashdata('error'); ?></div>
            <button type="button" class="btn-close btn-close-sm ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Validation Errors (Inline) -->
    <?php if (validation_errors()): ?>
        <div class="alert alert-danger py-2 px-3 small">
            <?= validation_errors('<div class="mb-1"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
        </div>
    <?php endif; ?>

    <!-- Reset Password Form -->
    <form action="<?= base_url('admin/forgot-password') ?>" method="POST" id="resetPasswordForm" novalidate>
        <!-- Email Field to identify account -->
        <div class="mb-3">
            <label for="email" class="form-label">Admin Email Address <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" 
                       class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" 
                       id="email" 
                       name="email" 
                       value="<?= set_value('email') ?>" 
                       placeholder="admin@gmail.com" 
                       required 
                       autofocus>
            </div>
            <div class="form-text text-muted small">The registered email of your admin account.</div>
        </div>

        <!-- New Password Field -->
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" 
                       class="form-control <?= form_error('new_password') ? 'is-invalid' : '' ?>" 
                       id="new_password" 
                       name="new_password" 
                       placeholder="At least 6 characters" 
                       required>
                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassBtn" title="Toggle visibility">
                    <i class="fa-regular fa-eye" id="toggleNewPassIcon"></i>
                </button>
            </div>
            <div class="invalid-feedback d-none" id="clientNewPassError">Password must be at least 6 characters.</div>
        </div>

        <!-- Confirm New Password Field -->
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
            </div>
            <div class="invalid-feedback d-none" id="clientConfirmPassError">Passwords must match exactly.</div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-reset d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-arrows-rotate me-2"></i>
            <span>Update Password</span>
        </button>
    </form>

    <!-- Back to Login Link -->
    <div class="text-center mt-4 pt-3 border-top border-light">
        <a href="<?= base_url('admin/login') ?>" class="back-login-link">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
        </a>
    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Client-side Validation UX & Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleNewPassBtn');
        const passInput = document.getElementById('new_password');
        const passIcon = document.getElementById('toggleNewPassIcon');
        const form = document.getElementById('resetPasswordForm');
        const confirmInput = document.getElementById('confirm_password');
        const newPassErr = document.getElementById('clientNewPassError');
        const confirmPassErr = document.getElementById('clientConfirmPassError');

        if (toggleBtn && passInput && passIcon) {
            toggleBtn.addEventListener('click', function() {
                const isPassword = passInput.getAttribute('type') === 'password';
                passInput.setAttribute('type', isPassword ? 'text' : 'password');
                passIcon.classList.toggle('fa-eye');
                passIcon.classList.toggle('fa-eye-slash');
            });
        }

        if (form) {
            form.addEventListener('submit', function(e) {
                let valid = true;
                const newPass = passInput.value;
                const confirmPass = confirmInput.value;

                if (newPass.length < 6) {
                    passInput.classList.add('is-invalid');
                    if (newPassErr) newPassErr.classList.remove('d-none');
                    valid = false;
                } else {
                    passInput.classList.remove('is-invalid');
                    if (newPassErr) newPassErr.classList.add('d-none');
                }

                if (newPass !== confirmPass || !confirmPass) {
                    confirmInput.classList.add('is-invalid');
                    if (confirmPassErr) confirmPassErr.classList.remove('d-none');
                    valid = false;
                } else {
                    confirmInput.classList.remove('is-invalid');
                    if (confirmPassErr) confirmPassErr.classList.add('d-none');
                }

                if (!valid) {
                    e.preventDefault();
                }
            });
        }
    });
</script>

</body>
</html>
