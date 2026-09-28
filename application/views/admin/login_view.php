<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Nandani</title>

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

    <!-- Scoped Login Styles -->
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

        .login-card {
            width: 100%;
            max-width: 440px;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            padding: 2.5rem 2.25rem;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-red), var(--gold-accent));
        }

        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon-wrap {
            width: 54px;
            height: 54px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, var(--primary-red), var(--dark-red));
            color: var(--gold-accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(200, 16, 46, 0.25);
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

        .btn-login {
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

        .btn-login:hover, .btn-login:focus, .btn-login:active {
            background-color: var(--dark-red) !important;
            border-color: var(--dark-red) !important;
            color: var(--white) !important;
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.35);
        }

        .forgot-link {
            font-size: 0.84rem;
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--dark-red);
            text-decoration: underline;
        }

        .back-home-link {
            font-size: 0.82rem;
            color: #6B7280;
            text-decoration: none;
        }

        .back-home-link:hover {
            color: var(--dark-text);
        }
    </style>
</head>
<body>

<div class="login-card">
    
    <!-- Brand & Heading -->
    <div class="brand-header text-center mb-4">
        <a href="<?= base_url() ?>" class="d-inline-block mb-3" title="Nandani">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Nandani Logo" class="login-brand-logo" style="height: 72px; width: auto; object-fit: contain; filter: drop-shadow(0 4px 10px rgba(200, 16, 46, 0.18));">
        </a>
        <h1 class="brand-title">Admin Portal Login</h1>
        <p class="brand-subtitle">Enter your credentials to access the management dashboard</p>
    </div>

    <!-- Generic Error Notification -->
    <?php if ($this->session->flashdata('login_error')): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2 px-3 small" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2 flex-shrink-0"></i>
            <div><?= $this->session->flashdata('login_error'); ?></div>
            <button type="button" class="btn-close btn-close-sm ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Success Notification (e.g. from password reset) -->
    <?php if ($this->session->flashdata('login_success')): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2 px-3 small" role="alert">
            <i class="fa-solid fa-circle-check me-2 flex-shrink-0"></i>
            <div><?= $this->session->flashdata('login_success'); ?></div>
            <button type="button" class="btn-close btn-close-sm ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Session Expired / Protected Route Message -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center py-2 px-3 small" role="alert">
            <i class="fa-solid fa-lock me-2 flex-shrink-0"></i>
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

    <!-- Login Form -->
    <form action="<?= base_url('admin/login') ?>" method="POST" novalidate id="adminLoginForm">
        <!-- CSRF Token if enabled -->
        <?php if ($this->config->item('csrf_protection')): ?>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        <?php endif; ?>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
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
            <div class="invalid-feedback d-none" id="clientEmailError">Please provide a valid email address.</div>
        </div>

        <!-- Password Field -->
        <div class="mb-3">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <label for="password" class="form-label mb-0">Password <span class="text-danger">*</span></label>
                <a href="<?= base_url('admin/forgot-password') ?>" class="forgot-link">Forgot Password?</a>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" 
                       class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" 
                       id="password" 
                       name="password" 
                       placeholder="••••••••" 
                       required>
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn" title="Toggle visibility">
                    <i class="fa-regular fa-eye" id="toggleIcon"></i>
                </button>
            </div>
            <div class="invalid-feedback d-none" id="clientPasswordError">Password is required.</div>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="btn btn-login d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-arrow-right-to-bracket me-2"></i>
                <span>Sign In</span>
            </button>
        </div>
    </form>

    <!-- Return to Website Link -->
    <div class="text-center mt-4 pt-3 border-top border-light">
        <a href="<?= base_url() ?>" class="back-home-link">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Public Website
        </a>
    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Client-side UX Validation and Password Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        const form = document.getElementById('adminLoginForm');
        const emailInput = document.getElementById('email');
        const emailErr = document.getElementById('clientEmailError');
        const passErr = document.getElementById('clientPasswordError');

        // Toggle password visibility
        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                toggleIcon.classList.toggle('fa-eye');
                toggleIcon.classList.toggle('fa-eye-slash');
            });
        }

        // Client-side validation UX
        if (form) {
            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate email
                const emailVal = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailVal || !emailRegex.test(emailVal)) {
                    emailInput.classList.add('is-invalid');
                    if (emailErr) emailErr.classList.remove('d-none');
                    valid = false;
                } else {
                    emailInput.classList.remove('is-invalid');
                    if (emailErr) emailErr.classList.add('d-none');
                }

                // Validate password
                if (!passwordInput.value.trim()) {
                    passwordInput.classList.add('is-invalid');
                    if (passErr) passErr.classList.remove('d-none');
                    valid = false;
                } else {
                    passwordInput.classList.remove('is-invalid');
                    if (passErr) passErr.classList.add('d-none');
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
