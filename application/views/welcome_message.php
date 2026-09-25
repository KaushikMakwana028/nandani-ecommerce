<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nandani — Premium Kitchen & Home Appliances</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #C8102E;
            --dark-red: #8B0000;
            --gold-accent: #FFC72C;
            --dark-text: #1A1A1A;
            --light-bg: #F8F9FA;
            --white: #FFFFFF;
            --font-body: 'Poppins', sans-serif;
            --font-heading: 'Playfair Display', serif;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--light-bg);
            color: var(--dark-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .landing-navbar {
            background-color: var(--white);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1rem 2rem;
        }

        .brand-logo-text {
            font-family: var(--font-heading);
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark-text);
            letter-spacing: 0.5px;
        }

        .brand-logo-text span {
            color: var(--primary-red);
        }

        .hero-section {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 1.5rem;
            background: radial-gradient(circle at top right, rgba(255, 199, 44, 0.1), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(200, 16, 46, 0.06), transparent 50%);
        }

        .hero-card {
            max-width: 680px;
            background-color: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            padding: 3.5rem 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
            text-align: center;
        }

        .badge-status {
            background-color: rgba(255, 199, 44, 0.2);
            color: #9A6F00;
            border: 1px solid rgba(255, 199, 44, 0.4);
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-family: var(--font-heading);
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-text);
            line-height: 1.25;
            margin-bottom: 1.25rem;
        }

        .hero-lead {
            font-size: 1.05rem;
            color: #6B7280;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-portal {
            background-color: var(--primary-red);
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            padding: 12px 30px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(200, 16, 46, 0.35);
        }

        .btn-portal:hover {
            background-color: var(--dark-red);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 0, 0, 0.4);
        }

        .info-pill {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px dashed #E5E7EB;
            font-size: 0.82rem;
            color: #9CA3AF;
        }

        .landing-footer {
            background-color: var(--white);
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            padding: 1.25rem;
            text-align: center;
            font-size: 0.82rem;
            color: #6B7280;
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <nav class="landing-navbar d-flex align-items-center justify-content-between">
        <div class="brand-logo-text">
            Nandani<span>.</span>
        </div>
        <a href="<?= base_url('admin') ?>" class="btn btn-sm btn-outline-dark px-3 py-1 fw-semibold">
            <i class="fa-solid fa-lock me-1"></i> Admin Login
        </a>
    </nav>

    <!-- Main Hero Landing -->
    <main class="hero-section">
        <div class="hero-card">
            <div class="badge-status">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <span>Public Website Under Active Development</span>
            </div>

            <h1 class="hero-title">
                Excellence in Kitchen & Home Appliances
            </h1>

            <p class="hero-lead">
                Welcome to <strong>Nandani Enterprise</strong>. Our customer-facing catalog and shopping experience are currently under preparation. Administrative personnel can manage master categories, products, and configurations via the Admin Portal.
            </p>

            <div>
                <a href="<?= base_url('admin') ?>" class="btn-portal">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Access Admin Panel</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="info-pill">
                <i class="fa-solid fa-circle-info me-1 text-secondary"></i>
                This landing page is the default root route (<code>/</code>) and will be substituted with the public website in future phases.
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="landing-footer">
        Nandani &copy; <?= date('Y') ?> Business Portal. All rights reserved.
    </footer>

</body>
</html>
