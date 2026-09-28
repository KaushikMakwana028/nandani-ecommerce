<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Specific Styles Scoped Inside Page -->
<style>
    /* Welcome Banner */
    .dashboard-welcome-banner {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
        border-radius: 16px;
        padding: 2rem 2.25rem;
        color: var(--white);
        box-shadow: 0 8px 24px rgba(200, 16, 46, 0.2);
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .dashboard-welcome-banner::after {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(255, 199, 44, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .banner-greeting {
        font-family: var(--font-heading);
        font-size: 2.1rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        letter-spacing: -0.3px;
    }

    .banner-date-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 400;
    }

    .banner-date-badge i {
        color: var(--gold-accent);
        font-size: 0.95rem;
    }

    /* Stat Number Cards */
    .dashboard-stat-card {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.65rem 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dashboard-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
        border-color: #D1D5DB;
    }

    .stat-label-text {
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.9px;
        font-weight: 600;
        color: #6B7280;
        margin-bottom: 0.35rem;
    }

    .stat-number-value {
        font-size: 2.35rem;
        font-weight: 700;
        color: var(--dark-text);
        line-height: 1.1;
        letter-spacing: -0.5px;
    }

    /* Icon in Tinted Circles */
    .stat-circle-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.45rem;
        flex-shrink: 0;
        transition: transform 0.25s ease;
    }

    .dashboard-stat-card:hover .stat-circle-icon {
        transform: scale(1.08);
    }

    /* Light Red Tint Circle */
    .tint-light-red {
        background-color: rgba(200, 16, 46, 0.1);
        color: var(--primary-red);
    }

    /* Gold Tint Circle */
    .tint-gold {
        background-color: rgba(255, 199, 44, 0.2);
        color: #B27B00;
    }
</style>

<!-- Welcome Banner Top -->
<div class="dashboard-welcome-banner d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1 class="banner-greeting">
            Welcome back, <?= html_escape($admin_user['name'] ?? 'Admin') ?>!
        </h1>
        <div class="banner-date-badge">
            <i class="fa-regular fa-calendar-check"></i>
            <span><?= html_escape($today_date) ?></span>
        </div>
    </div>
</div>

<!-- 4 Number-Card Widgets Grid -->
<div class="row g-3 g-xl-4">
    <!-- Card 1: Total Products -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="dashboard-stat-card">
            <div>
                <div class="stat-label-text">Total Products</div>
                <div class="stat-number-value"><?= (int)$total_products ?></div>
            </div>
            <div class="stat-circle-icon tint-light-red">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Brands -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="dashboard-stat-card">
            <div>
                <div class="stat-label-text">Total Brands</div>
                <div class="stat-number-value"><?= (int)$total_brands ?></div>
            </div>
            <div class="stat-circle-icon tint-gold">
                <i class="fa-solid fa-tags"></i>
            </div>
        </div>
    </div>

    <!-- Card 3: Total Gallery Images -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="dashboard-stat-card">
            <div>
                <div class="stat-label-text">Total Gallery Images</div>
                <div class="stat-number-value"><?= (int)$total_gallery ?></div>
            </div>
            <div class="stat-circle-icon tint-light-red">
                <i class="fa-solid fa-images"></i>
            </div>
        </div>
    </div>

    <!-- Card 4: Total Enquiries -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="dashboard-stat-card">
            <div>
                <div class="stat-label-text">Total Enquiries</div>
                <div class="stat-number-value"><?= (int)$total_enquiries ?></div>
            </div>
            <div class="stat-circle-icon tint-gold">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>
    </div>
</div>
