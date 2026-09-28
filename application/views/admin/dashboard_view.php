<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Load Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

<!-- Page-Scoped Styles -->
<style>
    /* ========================================================
       DASHBOARD — MOBILE-FIRST REDESIGN
       (colors + font families unchanged)
       ======================================================== */

    .dash-wrap {
        overflow-x: hidden;
        max-width: 100%;
    }

    /* Every flex/grid child may shrink -> nothing can overflow a card */
    .dash-wrap * {
        min-width: 0;
    }

    /* ---------- 1. HERO ---------- */
    .dashboard-hero-banner {
        background: linear-gradient(135deg, var(--primary-red, #C8102E) 0%, #9B0D23 60%, #6E0516 100%);
        border-radius: 18px;
        padding: 1.6rem 1.9rem;
        color: #FFFFFF;
        box-shadow: 0 10px 28px rgba(200, 16, 46, 0.22);
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .dashboard-hero-banner::after {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(255, 199, 44, 0.25) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .dashboard-hero-banner::before {
        content: '';
        position: absolute;
        bottom: -40px;
        left: 20%;
        width: 140px;
        height: 140px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-inner {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .hero-greeting {
        font-family: var(--font-heading, 'Playfair Display', serif);
        font-size: 1.85rem;
        font-weight: 700;
        margin: 0 0 0.35rem;
        letter-spacing: -0.3px;
        line-height: 1.25;
        word-break: break-word;
    }

    .hero-sub {
        margin: 0;
        font-size: 0.86rem;
        color: rgba(255, 255, 255, 0.72);
        line-height: 1.5;
    }

    .hero-badges-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        font-size: 0.82rem;
        margin-bottom: 0.85rem;
    }

    .hero-date-pill,
    .hero-clock-pill,
    .hero-alert-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .hero-date-pill {
        background: rgba(255, 255, 255, 0.16);
        backdrop-filter: blur(4px);
        font-weight: 500;
    }

    .hero-clock-pill {
        background: rgba(0, 0, 0, 0.2);
        font-family: monospace;
        font-size: 0.8rem;
    }

    .hero-alert-pill {
        background: #FFC72C;
        color: #1A1A1A;
        font-weight: 700;
    }

    .hero-action-btn {
        background-color: #FFFFFF;
        color: var(--primary-red, #C8102E);
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.2rem;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .hero-action-btn:hover {
        background-color: #FFF5F6;
        color: #9B0D23;
        transform: translateY(-2px);
    }

    /* ---------- 2. KPI CARDS ---------- */
    .dashboard-kpi-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color, #E5E7EB);
        border-radius: 16px;
        padding: 1.2rem 1.3rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none !important;
        color: inherit !important;
        overflow: hidden;
        position: relative;
    }

    .dashboard-kpi-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--kpi-accent, #C8102E);
        opacity: 0.85;
    }

    .kpi-blue {
        --kpi-accent: #2563EB;
    }

    .kpi-gold {
        --kpi-accent: #D97706;
    }

    .kpi-emerald {
        --kpi-accent: #10B981;
    }

    .kpi-purple {
        --kpi-accent: #8B5CF6;
    }

    .dashboard-kpi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
    }

    .kpi-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 0.8rem;
    }

    .kpi-label {
        font-size: 0.74rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #6B7280;
        margin-bottom: 0.2rem;
    }

    .kpi-value {
        font-size: 2.1rem;
        font-weight: 700;
        color: var(--dark-text, #1A1A1A);
        line-height: 1.1;
        letter-spacing: -0.5px;
    }

    .kpi-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .icon-bg-blue {
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563EB;
    }

    .icon-bg-gold {
        background-color: rgba(217, 119, 6, 0.1);
        color: #D97706;
    }

    .icon-bg-emerald {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10B981;
    }

    .icon-bg-purple {
        background-color: rgba(139, 92, 246, 0.1);
        color: #8B5CF6;
    }

    .kpi-footer {
        padding-top: 0.7rem;
        border-top: 1px solid #F3F4F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
        font-size: 0.78rem;
        color: #6B7280;
    }

    .kpi-subtext {
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .kpi-arrow-indicator {
        opacity: 0.5;
        flex-shrink: 0;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .dashboard-kpi-card:hover .kpi-arrow-indicator {
        opacity: 1;
        transform: translateX(3px);
        color: var(--primary-red, #C8102E);
    }

    /* ---------- 3. GLANCE CARDS (overflow-proof) ---------- */
    .glance-card {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 14px;
        padding: 0.85rem 1rem;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.02);
        transition: all 0.2s ease;
        text-decoration: none !important;
        color: inherit !important;
        height: 100%;
        overflow: hidden;
    }

    .glance-card:hover {
        background-color: #F9FAFB;
        border-color: #D1D5DB;
        transform: translateY(-1px);
    }

    .glance-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .glance-body {
        flex: 1 1 auto;
        min-width: 0;
    }

    .glance-title {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: #6B7280;
        line-height: 1.25;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .glance-val {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        line-height: 1.3;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .glance-val .glance-unit {
        font-weight: 400;
        color: #6B7280;
        font-size: 0.78rem;
    }

    /* ---------- 4. CHART CARDS ---------- */
    .dashboard-chart-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color, #E5E7EB);
        border-radius: 16px;
        padding: 1.3rem 1.4rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .chart-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .chart-card-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--dark-text, #1A1A1A);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chart-card-subtitle {
        font-size: 0.8rem;
        color: #6B7280;
        margin: 3px 0 0;
        line-height: 1.4;
    }

    .chart-total-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-radius: 999px;
        padding: 4px 12px;
        font-size: 0.76rem;
        font-weight: 600;
        color: #374151;
        white-space: nowrap;
    }

    /* Custom HTML legend (replaces the bulky in-canvas legend) */
    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 6px 14px;
        margin-bottom: 0.7rem;
        font-size: 0.78rem;
        font-weight: 500;
        color: #4B5563;
    }

    .chart-legend span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .chart-legend i {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    /* FIXED height => no Chart.js resize feedback loop */
    .chart-canvas-container {
        position: relative;
        width: 100%;
        height: 290px;
        flex-shrink: 0;
        overflow: hidden;
    }

    .chart-canvas-container.is-donut {
        height: 300px;
    }

    .chart-canvas-container canvas {
        display: block !important;
        width: 100% !important;
        height: 100% !important;
    }

    /* Doughnut center label */
    .donut-center {
        position: absolute;
        left: 50%;
        top: 42%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: none;
        line-height: 1.1;
    }

    .donut-center strong {
        display: block;
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--dark-text, #1A1A1A);
    }

    .donut-center small {
        font-size: 0.7rem;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    /* ---------- 5. QUICK ACTIONS ---------- */
    .quick-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
    }

    .quick-action-btn {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 12px;
        padding: 0.9rem 0.4rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-align: center;
        text-decoration: none !important;
        color: #374151;
        font-size: 0.78rem;
        font-weight: 600;
        line-height: 1.25;
        transition: all 0.2s ease;
        min-height: 86px;
    }

    .quick-action-btn span {
        display: block;
        max-width: 100%;
        overflow-wrap: anywhere;
    }

    .quick-action-btn:hover {
        background-color: #FFF5F6;
        border-color: rgba(200, 16, 46, 0.3);
        color: var(--primary-red, #C8102E);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(200, 16, 46, 0.08);
    }

    .quick-action-icon {
        font-size: 1.3rem;
        color: var(--primary-red, #C8102E);
        transition: transform 0.2s ease;
    }

    .quick-action-btn:hover .quick-action-icon {
        transform: scale(1.15);
    }

    /* ---------- 6. RECENT ACTIVITY ---------- */
    .recent-table-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color, #E5E7EB);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        margin-bottom: 2rem;
    }

    .recent-table-header {
        padding: 1.15rem 1.4rem;
        border-bottom: 1px solid var(--border-color, #E5E7EB);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-recent-enquiries {
        margin: 0;
        vertical-align: middle;
    }

    .table-recent-enquiries thead th {
        background-color: #F9FAFB;
        font-size: 0.74rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #4B5563;
        padding: 0.85rem 1.15rem;
        border-bottom: 1px solid #E5E7EB;
        white-space: nowrap;
    }

    .table-recent-enquiries tbody td {
        padding: 0.9rem 1.15rem;
        font-size: 0.86rem;
        border-bottom: 1px solid #F3F4F6;
        color: #374151;
    }

    .table-recent-enquiries tbody tr:last-child td {
        border-bottom: none;
    }

    .table-recent-enquiries tbody tr:hover td {
        background-color: #FBFBFB;
    }

    .user-avatar-initials {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(200, 16, 46, 0.1) 0%, rgba(200, 16, 46, 0.2) 100%);
        color: var(--primary-red, #C8102E);
        font-weight: 700;
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .type-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.73rem;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        white-space: nowrap;
    }

    .type-pill-contact {
        background-color: #EFF6FF;
        color: #1D4ED8;
        border: 1px solid #BFDBFE;
    }

    .type-pill-distributor {
        background-color: #FAF5FF;
        color: #7E22CE;
        border: 1px solid #E9D5FF;
    }

    .status-mini-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.74rem;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 12px;
        white-space: nowrap;
    }

    .status-mini-pill .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-mini-new {
        background-color: #EFF6FF;
        color: #1D4ED8;
        border: 1px solid #BFDBFE;
    }

    .status-mini-new .dot {
        background-color: #2563EB;
    }

    .status-mini-contacted {
        background-color: #FEF3C7;
        color: #B45309;
        border: 1px solid #FDE68A;
    }

    .status-mini-contacted .dot {
        background-color: #D97706;
    }

    .status-mini-closed {
        background-color: #F3F4F6;
        color: #4B5563;
        border: 1px solid #E5E7EB;
    }

    .status-mini-closed .dot {
        background-color: #9CA3AF;
    }

    /* Mobile list version of the recent table */
    .enq-list {
        display: none;
    }

    .enq-item {
        display: flex;
        gap: 12px;
        padding: 0.95rem 1rem;
        border-bottom: 1px solid #F3F4F6;
        text-decoration: none !important;
        color: inherit !important;
    }

    .enq-item:last-child {
        border-bottom: none;
    }

    .enq-item:active {
        background: #FBFBFB;
    }

    .enq-main {
        flex: 1 1 auto;
        min-width: 0;
    }

    .enq-top {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 8px;
    }

    .enq-name {
        font-weight: 700;
        color: #111827;
        font-size: 0.9rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .enq-date {
        font-size: 0.7rem;
        color: #6B7280;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .enq-subject {
        font-size: 0.82rem;
        color: #374151;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin: 1px 0 0;
    }

    .enq-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
        margin-top: 7px;
    }

    .enq-city {
        font-size: 0.72rem;
        color: #6B7280;
    }

    /* ========================================================
       RESPONSIVE
       ======================================================== */
    @media (max-width: 991.98px) {
        .hero-greeting {
            font-size: 1.6rem;
        }

        .chart-canvas-container {
            height: 270px;
        }
    }

    @media (max-width: 767.98px) {
        .dashboard-hero-banner {
            padding: 1.15rem 1.1rem;
            border-radius: 16px;
            margin-bottom: 1.1rem;
        }

        .hero-inner {
            flex-direction: column;
            align-items: stretch;
        }

        .hero-greeting {
            font-size: 1.32rem;
        }

        .hero-sub {
            font-size: 0.8rem;
        }

        .hero-badges-wrapper {
            font-size: 0.74rem;
            gap: 6px;
            margin-bottom: 0.7rem;
        }

        .hero-date-pill,
        .hero-clock-pill,
        .hero-alert-pill {
            padding: 3px 10px;
        }

        .hero-action-btn {
            width: 100%;
            padding: 0.6rem 1rem;
        }

        /* KPI: compact, icon moves to the top-right, value stays big */
        .dashboard-kpi-card {
            padding: 0.95rem 0.9rem 0.85rem 1rem;
            border-radius: 14px;
        }

        .kpi-header {
            margin-bottom: 0.6rem;
        }

        .kpi-value {
            font-size: 1.65rem;
        }

        .kpi-icon-wrapper {
            width: 38px;
            height: 38px;
            font-size: 1rem;
            border-radius: 10px;
        }

        .kpi-label {
            font-size: 0.64rem;
            letter-spacing: 0.4px;
        }

        .kpi-footer {
            font-size: 0.7rem;
            padding-top: 0.55rem;
        }

        /* Glance: icon on top, text below => full width for long values */
        .glance-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            padding: 0.85rem 0.9rem;
        }

        .glance-body {
            width: 100%;
        }

        .glance-val {
            font-size: 0.95rem;
        }

        .dashboard-chart-card {
            padding: 1rem 0.9rem;
            border-radius: 14px;
        }

        .chart-card-title {
            font-size: 0.98rem;
        }

        .chart-card-subtitle {
            font-size: 0.75rem;
        }

        .chart-canvas-container {
            height: 240px;
        }

        .chart-canvas-container.is-donut {
            height: 290px;
        }

        .quick-action-btn {
            min-height: 78px;
            font-size: 0.68rem;
            padding: 0.7rem 0.25rem;
            gap: 6px;
        }

        .quick-action-icon {
            font-size: 1.15rem;
        }

        .quick-grid {
            gap: 8px;
        }

        /* Swap table -> list */
        .recent-table-card .table-responsive {
            display: none;
        }

        .enq-list {
            display: block;
        }

        .recent-table-header {
            padding: 1rem;
        }

        .recent-table-header .btn {
            width: 100%;
        }

        .recent-table-header>div:last-child {
            width: 100%;
        }
    }

    @media (max-width: 400px) {
        .kpi-value {
            font-size: 1.5rem;
        }

        .quick-action-btn {
            font-size: 0.64rem;
        }

        .chart-canvas-container {
            height: 220px;
        }
    }
</style>

<div class="container-fluid p-0 dash-wrap">

    <!-- 1. HERO -->
    <div class="dashboard-hero-banner">
        <div class="hero-inner">
            <div>
                <div class="hero-badges-wrapper">
                    <span class="hero-date-pill">
                        <i class="fa-regular fa-calendar-check text-warning"></i>
                        <span><?= html_escape($today_date) ?></span>
                    </span>
                    <span class="hero-clock-pill">
                        <i class="fa-regular fa-clock"></i>
                        <span id="heroLiveClock">--:--:--</span>
                    </span>
                    <?php if ($total_new_enquiries > 0): ?>
                        <span class="hero-alert-pill">
                            <i class="fa-solid fa-bell"></i> <?= (int)$total_new_enquiries ?> New Leads
                        </span>
                    <?php endif; ?>
                </div>
                <h1 class="hero-greeting">
                    Welcome back, <?= html_escape($admin_user['name'] ?? 'Admin') ?>! 👋
                </h1>
                <p class="hero-sub">
                    Live overview of your product inventory, partner brands, and online enquiries.
                </p>
            </div>

            <a href="<?= base_url() ?>" target="_blank" class="hero-action-btn" title="View Public Front-End Store">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Visit Website</span>
            </a>
        </div>
    </div>

    <!-- 2. PRIMARY KPI CARDS -->
    <div class="row g-2 g-md-3 g-xl-4 mb-3 mb-md-4">
        <!-- Products -->
        <div class="col-6 col-lg-3">
            <a href="<?= base_url('admin/products') ?>" class="dashboard-kpi-card kpi-blue" title="Manage Products Catalog">
                <div class="kpi-header">
                    <div>
                        <div class="kpi-label">Products</div>
                        <div class="kpi-value"><?= (int)$total_products ?></div>
                    </div>
                    <div class="kpi-icon-wrapper icon-bg-blue"><i class="fa-solid fa-box-open"></i></div>
                </div>
                <div class="kpi-footer">
                    <span class="kpi-subtext">
                        <strong class="text-success"><?= (int)$active_products ?></strong> Active
                        <?php if ($product_badges['bestseller'] > 0): ?>
                            &bull; <?= (int)$product_badges['bestseller'] ?> Best
                        <?php endif; ?>
                    </span>
                    <i class="fa-solid fa-arrow-right kpi-arrow-indicator"></i>
                </div>
            </a>
        </div>

        <!-- Brands -->
        <div class="col-6 col-lg-3">
            <a href="<?= base_url('admin/brands') ?>" class="dashboard-kpi-card kpi-gold" title="Manage Partner Brands">
                <div class="kpi-header">
                    <div>
                        <div class="kpi-label">Brands</div>
                        <div class="kpi-value"><?= (int)$total_brands ?></div>
                    </div>
                    <div class="kpi-icon-wrapper icon-bg-gold"><i class="fa-solid fa-tags"></i></div>
                </div>
                <div class="kpi-footer">
                    <span class="kpi-subtext"><strong class="text-success"><?= (int)$active_brands ?></strong> Active</span>
                    <i class="fa-solid fa-arrow-right kpi-arrow-indicator"></i>
                </div>
            </a>
        </div>

        <!-- Customer Queries -->
        <div class="col-6 col-lg-3">
            <a href="<?= base_url('admin/enquiries/contact') ?>" class="dashboard-kpi-card kpi-emerald" title="View Customer Enquiries">
                <div class="kpi-header">
                    <div>
                        <div class="kpi-label">Queries</div>
                        <div class="kpi-value"><?= (int)$contact_total ?></div>
                    </div>
                    <div class="kpi-icon-wrapper icon-bg-emerald"><i class="fa-solid fa-envelope-open-text"></i></div>
                </div>
                <div class="kpi-footer">
                    <span class="kpi-subtext">
                        <?php if ($contact_new > 0): ?>
                            <span class="text-primary fw-bold"><?= (int)$contact_new ?> New</span> &bull;
                        <?php endif; ?>
                        <?= (int)$contact_contacted ?> Active
                    </span>
                    <i class="fa-solid fa-arrow-right kpi-arrow-indicator"></i>
                </div>
            </a>
        </div>

        <!-- Distributor Leads -->
        <div class="col-6 col-lg-3">
            <a href="<?= base_url('admin/enquiries/distributor') ?>" class="dashboard-kpi-card kpi-purple" title="View Dealership Applications">
                <div class="kpi-header">
                    <div>
                        <div class="kpi-label">Distributors</div>
                        <div class="kpi-value"><?= (int)$distributor_total ?></div>
                    </div>
                    <div class="kpi-icon-wrapper icon-bg-purple"><i class="fa-solid fa-briefcase"></i></div>
                </div>
                <div class="kpi-footer">
                    <span class="kpi-subtext">
                        <?php if ($distributor_new > 0): ?>
                            <span class="text-primary fw-bold"><?= (int)$distributor_new ?> New</span>
                        <?php else: ?>
                            <?= (int)$distributor_closed ?> Processed
                        <?php endif; ?>
                    </span>
                    <i class="fa-solid fa-arrow-right kpi-arrow-indicator"></i>
                </div>
            </a>
        </div>
    </div>

    <!-- 3. GLANCE COUNTERS -->
    <div class="row g-2 g-md-3 mb-3 mb-md-4">
        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/category') ?>" class="glance-card">
                <div class="glance-icon bg-light text-primary"><i class="fa-solid fa-layer-group"></i></div>
                <div class="glance-body">
                    <div class="glance-title">Categories</div>
                    <div class="glance-val"><?= (int)$total_categories ?> <span class="glance-unit">(<?= (int)$product_categories ?>/<?= (int)$gallery_categories ?>)</span></div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/hero-slider') ?>" class="glance-card">
                <div class="glance-icon bg-light text-danger"><i class="fa-solid fa-images"></i></div>
                <div class="glance-body">
                    <div class="glance-title">Hero Slides</div>
                    <div class="glance-val"><?= (int)$active_slides ?> / <?= (int)$total_slides ?> <span class="glance-unit">Active</span></div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= base_url('admin/gallery') ?>" class="glance-card">
                <div class="glance-icon bg-light text-warning"><i class="fa-solid fa-photo-film"></i></div>
                <div class="glance-body">
                    <div class="glance-title">Gallery</div>
                    <div class="glance-val"><?= (int)$total_gallery ?> <span class="glance-unit">Images</span></div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="<?= !empty($settings->whatsapp_number) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings->whatsapp_number) : base_url('admin/settings') ?>"
                target="_blank" rel="noopener" class="glance-card">
                <div class="glance-icon bg-light text-success"><i class="fa-brands fa-whatsapp"></i></div>
                <div class="glance-body">
                    <div class="glance-title">WhatsApp</div>
                    <div class="glance-val">
                        <?= !empty($settings->whatsapp_number) ? html_escape($settings->whatsapp_number) : '<span class="glance-unit">Not configured</span>' ?>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- 4. CHARTS ROW 1 -->
    <div class="row g-3 mb-3 mb-md-4">
        <div class="col-12 col-xl-8">
            <div class="dashboard-chart-card">
                <div class="chart-card-header">
                    <div>
                        <h2 class="chart-card-title">
                            <i class="fa-solid fa-chart-line text-danger"></i>
                            <span>Inquiry Inflow Trends</span>
                        </h2>
                        <p class="chart-card-subtitle">Customer queries vs dealership applications (last 6 months)</p>
                    </div>
                    <span class="chart-total-chip">Total: <?= (int)$total_enquiries ?></span>
                </div>
                <div class="chart-legend">
                    <span><i style="background:#C8102E"></i> Customer Queries</span>
                    <span><i style="background:#2563EB"></i> Dealership Leads</span>
                </div>
                <div class="chart-canvas-container">
                    <canvas id="enquiriesTrendChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="dashboard-chart-card">
                <div class="chart-card-header">
                    <div>
                        <h2 class="chart-card-title">
                            <i class="fa-solid fa-chart-pie text-primary"></i>
                            <span>Product Categories</span>
                        </h2>
                        <p class="chart-card-subtitle">Inventory breakdown by category</p>
                    </div>
                </div>
                <div class="chart-canvas-container is-donut">
                    <canvas id="categoryDistributionChart"></canvas>
                    <div class="donut-center">
                        <strong><?= (int)$total_products ?></strong>
                        <small>Products</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. CHARTS ROW 2 + QUICK ACTIONS -->
    <div class="row g-3 mb-3 mb-md-4">
        <div class="col-12 col-lg-6">
            <div class="dashboard-chart-card">
                <div class="chart-card-header">
                    <div>
                        <h2 class="chart-card-title">
                            <i class="fa-solid fa-chart-simple text-warning"></i>
                            <span>Lead Processing Pipeline</span>
                        </h2>
                        <p class="chart-card-subtitle">Status stages across queries &amp; distributor leads</p>
                    </div>
                </div>
                <div class="chart-legend">
                    <span><i style="background:#C8102E"></i> Customer Queries</span>
                    <span><i style="background:#2563EB"></i> Distributor Leads</span>
                </div>
                <div class="chart-canvas-container">
                    <canvas id="pipelineStatusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="dashboard-chart-card">
                <div class="chart-card-header">
                    <div>
                        <h2 class="chart-card-title">
                            <i class="fa-solid fa-bolt text-danger"></i>
                            <span>Quick Actions</span>
                        </h2>
                        <p class="chart-card-subtitle">Shortcuts to frequently used admin modules</p>
                    </div>
                </div>
                <div class="quick-grid">
                    <a href="<?= base_url('admin/products/add') ?>" class="quick-action-btn">
                        <i class="fa-solid fa-plus-circle quick-action-icon"></i><span>Add Product</span>
                    </a>
                    <a href="<?= base_url('admin/brands/add') ?>" class="quick-action-btn">
                        <i class="fa-solid fa-tag quick-action-icon"></i><span>Add Brand</span>
                    </a>
                    <a href="<?= base_url('admin/category') ?>" class="quick-action-btn">
                        <i class="fa-solid fa-folder-plus quick-action-icon"></i><span>Categories</span>
                    </a>
                    <a href="<?= base_url('admin/gallery/add') ?>" class="quick-action-btn">
                        <i class="fa-solid fa-camera quick-action-icon"></i><span>Upload Image</span>
                    </a>
                    <a href="<?= base_url('admin/hero-slider') ?>" class="quick-action-btn">
                        <i class="fa-solid fa-sliders quick-action-icon"></i><span>Hero Slides</span>
                    </a>
                    <a href="<?= base_url('admin/settings') ?>" class="quick-action-btn">
                        <i class="fa-solid fa-gears quick-action-icon"></i><span>Settings</span>
                    </a>
                    <a href="<?= base_url('admin/enquiries/export/contact') ?>" class="quick-action-btn">
                        <i class="fa-solid fa-file-csv quick-action-icon"></i><span>Export Leads</span>
                    </a>
                    <a href="<?= base_url('admin/profile') ?>" class="quick-action-btn">
                        <i class="fa-solid fa-user-shield quick-action-icon"></i><span>Profile</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. RECENT ENQUIRIES -->
    <div class="recent-table-card">
        <div class="recent-table-header">
            <div>
                <h2 class="chart-card-title">
                    <i class="fa-regular fa-clock text-danger"></i>
                    <span>Recent Enquiries &amp; Proposals</span>
                </h2>
                <p class="chart-card-subtitle">Latest submissions from your website visitors</p>
            </div>
            <div>
                <a href="<?= base_url('admin/enquiries/contact') ?>" class="btn btn-outline-secondary btn-sm px-3 fw-semibold">
                    <span>View All</span>
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <?php if (!empty($recent_enquiries)): ?>

            <!-- Mobile list -->
            <div class="enq-list">
                <?php foreach ($recent_enquiries as $inq):
                    $is_dist = ($inq->type === 'distributor');
                    $link    = base_url('admin/enquiries/' . ($is_dist ? 'distributor' : 'contact'));
                ?>
                    <a href="<?= $link ?>" class="enq-item">
                        <div class="user-avatar-initials"><?= strtoupper(substr($inq->name, 0, 1)) ?></div>
                        <div class="enq-main">
                            <div class="enq-top">
                                <div class="enq-name"><?= html_escape($inq->name) ?></div>
                                <div class="enq-date"><?= date('M d, h:i A', strtotime($inq->created_at)) ?></div>
                            </div>
                            <p class="enq-subject"><?= html_escape($inq->title_info ?? 'General Inquiry') ?></p>
                            <div class="enq-meta">
                                <?php if (!$is_dist): ?>
                                    <span class="type-pill type-pill-contact"><i class="fa-regular fa-envelope"></i> Contact</span>
                                <?php else: ?>
                                    <span class="type-pill type-pill-distributor"><i class="fa-solid fa-briefcase"></i> Dealership</span>
                                <?php endif; ?>

                                <?php if ($inq->status === 'new'): ?>
                                    <span class="status-mini-pill status-mini-new"><span class="dot"></span>New</span>
                                <?php elseif ($inq->status === 'contacted'): ?>
                                    <span class="status-mini-pill status-mini-contacted"><span class="dot"></span>Contacted</span>
                                <?php else: ?>
                                    <span class="status-mini-pill status-mini-closed"><span class="dot"></span>Closed</span>
                                <?php endif; ?>

                                <span class="enq-city"><i class="fa-solid fa-location-dot"></i> <?= html_escape(!empty($inq->city) ? $inq->city : 'Not specified') ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Desktop / tablet table -->
            <div class="table-responsive">
                <table class="table table-recent-enquiries">
                    <thead>
                        <tr>
                            <th style="min-width: 170px;">Applicant / Customer</th>
                            <th style="width: 130px;">Type</th>
                            <th style="min-width: 190px;">Details / Subject</th>
                            <th style="width: 120px;">Status</th>
                            <th style="min-width: 120px;">Submitted On</th>
                            <th style="width: 80px;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_enquiries as $inq): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar-initials"><?= strtoupper(substr($inq->name, 0, 1)) ?></div>
                                        <div>
                                            <div class="fw-bold text-dark lh-sm"><?= html_escape($inq->name) ?></div>
                                            <small class="text-muted text-truncate d-inline-block" style="max-width: 160px;"><?= html_escape($inq->email) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($inq->type === 'contact'): ?>
                                        <span class="type-pill type-pill-contact"><i class="fa-regular fa-envelope"></i><span>Contact</span></span>
                                    <?php else: ?>
                                        <span class="type-pill type-pill-distributor"><i class="fa-solid fa-briefcase"></i><span>Dealership</span></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark text-truncate" style="max-width: 220px;" title="<?= html_escape($inq->title_info ?? '') ?>">
                                        <?= html_escape($inq->title_info ?? 'General Inquiry') ?>
                                    </div>
                                    <small class="text-muted text-truncate d-block" style="max-width: 220px;">
                                        <?= html_escape(!empty($inq->city) ? $inq->city : 'Location not specified') ?>
                                    </small>
                                </td>
                                <td>
                                    <?php if ($inq->status === 'new'): ?>
                                        <span class="status-mini-pill status-mini-new"><span class="dot"></span><span>New</span></span>
                                    <?php elseif ($inq->status === 'contacted'): ?>
                                        <span class="status-mini-pill status-mini-contacted"><span class="dot"></span><span>Contacted</span></span>
                                    <?php else: ?>
                                        <span class="status-mini-pill status-mini-closed"><span class="dot"></span><span>Closed</span></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="small fw-medium text-dark"><?= date('M d, Y', strtotime($inq->created_at)) ?></div>
                                    <small class="text-muted" style="font-size: 0.72rem;"><?= date('h:i A', strtotime($inq->created_at)) ?></small>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/enquiries/' . ($inq->type === 'distributor' ? 'distributor' : 'contact')) ?>"
                                        class="btn btn-sm btn-light border py-1 px-2 text-primary" title="View in module">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <div class="text-center text-muted py-5">
                <i class="fa-regular fa-inbox fa-2x opacity-50 mb-2"></i>
                <div>No recent enquiries found.</div>
            </div>
        <?php endif; ?>
    </div>

</div>

<!-- JavaScript: Live Clock & Charts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // 1. Live clock
        function updateClock() {
            const el = document.getElementById('heroLiveClock');
            if (el) {
                el.textContent = new Date().toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                });
            }
        }
        updateClock();
        setInterval(updateClock, 1000);

        // Global Chart.js settings
        Chart.defaults.font.family = "'Poppins', sans-serif";
        Chart.defaults.color = '#6B7280';

        const isMobile = () => window.matchMedia('(max-width: 767.98px)').matches;
        const tooltipStyle = {
            backgroundColor: '#111827',
            padding: 10,
            cornerRadius: 8,
            boxPadding: 4
        };

        // Gradient fill computed from the real chart area (always correct height)
        function areaGradient(rgb) {
            return function(context) {
                const chart = context.chart;
                const area = chart.chartArea;
                if (!area) return 'rgba(' + rgb + ', 0.1)';
                const g = chart.ctx.createLinearGradient(0, area.top, 0, area.bottom);
                g.addColorStop(0, 'rgba(' + rgb + ', 0.28)');
                g.addColorStop(1, 'rgba(' + rgb + ', 0.01)');
                return g;
            };
        }

        // 2. Inquiry inflow trend (line/area)
        const trendCtx = document.getElementById('enquiriesTrendChart');
        if (trendCtx) {
            const monthsData = <?= json_encode($months) ?>;
            const contactData = <?= json_encode($contact_trend) ?>;
            const distributorData = <?= json_encode($distributor_trend) ?>;

            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: monthsData,
                    datasets: [{
                        label: 'Customer Queries',
                        data: contactData,
                        borderColor: '#C8102E',
                        backgroundColor: areaGradient('200, 16, 46'),
                        fill: true,
                        tension: 0.38,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#C8102E',
                        pointBorderColor: '#FFFFFF',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }, {
                        label: 'Dealership Leads',
                        data: distributorData,
                        borderColor: '#2563EB',
                        backgroundColor: areaGradient('37, 99, 235'),
                        fill: true,
                        tension: 0.38,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#2563EB',
                        pointBorderColor: '#FFFFFF',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 6,
                            right: 8
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        }, // custom HTML legend is used
                        tooltip: tooltipStyle
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: '#F3F4F6'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                maxRotation: 0,
                                autoSkip: true,
                                maxTicksLimit: 6,
                                // "Sep 2026" -> "Sep" on phones so labels never rotate/overlap
                                callback: function(value) {
                                    const label = this.getLabelForValue(value);
                                    return isMobile() ? String(label).split(' ')[0] : label;
                                }
                            }
                        }
                    }
                }
            });
        }

        // 3. Product category doughnut
        const catCtx = document.getElementById('categoryDistributionChart');
        if (catCtx) {
            <?php
            $cat_labels = [];
            $cat_counts = [];
            foreach ($category_distribution as $cd) {
                $cat_labels[] = $cd['name'];
                $cat_counts[] = $cd['count'];
            }
            if (empty($cat_labels)) {
                $cat_labels = ['General Range'];
                $cat_counts = [(int)$total_products];
            }
            ?>
            const catLabels = <?= json_encode($cat_labels) ?>;
            const catCounts = <?= json_encode($cat_counts) ?>;
            const colorPalette = ['#C8102E', '#2563EB', '#D97706', '#10B981', '#8B5CF6', '#EC4899', '#06B6D4'];

            new Chart(catCtx, {
                type: 'doughnut',
                data: {
                    labels: catLabels,
                    datasets: [{
                        data: catCounts,
                        backgroundColor: catLabels.map((_, i) => colorPalette[i % colorPalette.length]),
                        borderWidth: 2,
                        borderColor: '#FFFFFF',
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    layout: {
                        padding: 4
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 10,
                                boxHeight: 10,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    size: 11
                                },
                                padding: 10
                            }
                        },
                        tooltip: tooltipStyle
                    }
                }
            });
        }

        // 4. Lead pipeline (grouped bar)
        const pipeCtx = document.getElementById('pipelineStatusChart');
        if (pipeCtx) {
            const contactStatus = [<?= (int)$contact_new ?>, <?= (int)$contact_contacted ?>, <?= (int)$contact_closed ?>];
            const distributorStatus = [<?= (int)$distributor_new ?>, <?= (int)$distributor_contacted ?>, <?= (int)$distributor_closed ?>];

            new Chart(pipeCtx, {
                type: 'bar',
                data: {
                    labels: ['New', 'In Progress', 'Closed'],
                    datasets: [{
                        label: 'Customer Queries',
                        data: contactStatus,
                        backgroundColor: '#C8102E',
                        borderRadius: 6,
                        barPercentage: 0.7,
                        categoryPercentage: 0.75
                    }, {
                        label: 'Distributor Leads',
                        data: distributorStatus,
                        backgroundColor: '#2563EB',
                        borderRadius: 6,
                        barPercentage: 0.7,
                        categoryPercentage: 0.75
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: tooltipStyle
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: '#F3F4F6'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                maxRotation: 0
                            }
                        }
                    }
                }
            });
        }
    });
</script>