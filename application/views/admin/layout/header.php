<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($page_title ?? 'Admin') ?> | Nandani Admin Panel</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/fav.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/fav.png') ?>">

    <!-- Google Fonts: Poppins (Body/UI) & Playfair Display (Headings) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6.5.2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Design System Global Layout Styles -->
    <style>
        :root {
            --primary-red: #C8102E;
            --dark-red: #8B0000;
            --gold-accent: #FFC72C;
            --dark-text: #1A1A1A;
            --light-bg: #F8F9FA;
            --white: #FFFFFF;
            --border-color: #E5E7EB;
            --sidebar-width: 260px;
            --font-body: 'Poppins', sans-serif;
            --font-heading: 'Playfair Display', serif;
        }

        body {
            font-family: var(--font-body);
            color: var(--dark-text);
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h1, h2, h3, .heading-serif {
            font-family: var(--font-heading);
        }

        /* Layout Structure */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background-color: var(--dark-text);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1040;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.15);
        }

        .brand-icon-box {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary-red), var(--dark-red));
            color: var(--gold-accent);
            border-radius: 8px;
            font-size: 1.1rem;
        }

        .brand-title {
            font-family: var(--font-heading);
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 0.5px;
        }

        .brand-badge {
            background-color: var(--gold-accent);
            color: var(--dark-text);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .brand-tagline {
            font-size: 0.7rem;
            color: #9CA3AF;
            letter-spacing: 0.5px;
        }

        .nav-section-title {
            font-size: 0.7rem;
            font-weight: 600;
            color: #6B7280;
            letter-spacing: 1px;
        }

        .admin-sidebar .nav-link {
            color: #D1D5DB;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 10px 14px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .admin-sidebar .nav-link .nav-icon {
            width: 22px;
            font-size: 1rem;
            margin-right: 12px;
            color: #9CA3AF;
            transition: color 0.2s;
        }

        .admin-sidebar .nav-link:hover {
            color: var(--white);
            background-color: rgba(255, 255, 255, 0.08);
        }

        .admin-sidebar .nav-link:hover .nav-icon {
            color: var(--gold-accent);
        }

        /* Active Navigation Item in Primary Red */
        .admin-sidebar .nav-link.active {
            background-color: var(--primary-red);
            color: var(--white);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(200, 16, 46, 0.35);
        }

        .admin-sidebar .nav-link.active .nav-icon {
            color: var(--white);
        }

        /* Submenu Dropdown in Sidebar */
        .admin-sidebar .nav-link.active-parent {
            background-color: rgba(255, 255, 255, 0.06);
            color: var(--white);
            font-weight: 600;
        }

        .admin-sidebar .nav-link.active-parent .nav-icon {
            color: var(--primary-red);
        }

        .submenu-arrow {
            font-size: 0.7rem;
            transition: transform 0.25s ease;
            color: #9CA3AF;
        }

        .admin-sidebar .nav-link[aria-expanded="true"] .submenu-arrow {
            transform: rotate(180deg);
            color: var(--white);
        }

        /* Recessed Submenu Container */
        .sidebar-submenu-box {
            background-color: rgba(0, 0, 0, 0.22);
            border-radius: 8px;
            margin: 4px 0 6px 0;
            padding: 4px;
        }

        .sidebar-submenu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-submenu .submenu-link {
            font-size: 0.84rem;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 6px;
            color: #9CA3AF;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }

        .sidebar-submenu .submenu-link .submenu-icon {
            font-size: 0.88rem;
            width: 18px;
            text-align: center;
            color: #9CA3AF;
            transition: color 0.2s ease;
        }

        .sidebar-submenu .submenu-link:hover {
            color: var(--white);
            background-color: rgba(255, 255, 255, 0.06);
            text-decoration: none !important;
        }

        .sidebar-submenu .submenu-link:hover .submenu-icon {
            color: var(--white);
        }

        /* Active Submenu Link */
        .sidebar-submenu .submenu-link.active {
            background-color: var(--primary-red) !important;
            color: var(--white) !important;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(200, 16, 46, 0.3);
            text-decoration: none !important;
        }

        .sidebar-submenu .submenu-link.active .submenu-icon {
            color: var(--white) !important;
        }

        .nav-badge {
            background-color: rgba(255, 199, 44, 0.2);
            color: var(--gold-accent);
            font-size: 0.65rem;
            font-weight: 600;
            padding: 3px 6px;
        }

        .btn-signout {
            color: #F87171;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.88rem;
            transition: all 0.2s ease;
            background-color: rgba(239, 68, 68, 0.08);
        }

        .btn-signout:hover {
            background-color: var(--primary-red);
            color: var(--white);
        }

        /* Main Content Wrapper */
        .admin-main {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        /* Top Header Styling */
        .admin-topbar {
            height: 68px;
            background-color: var(--white);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .breadcrumb-text {
            font-size: 0.88rem;
            color: #6B7280;
            font-weight: 500;
        }

        .breadcrumb-text strong {
            color: var(--dark-text);
            font-weight: 600;
        }

        /* Profile Block */
        .profile-toggle-btn {
            background: transparent;
            border: 1px solid transparent;
            border-radius: 40px;
            padding: 4px 12px 4px 6px;
            transition: all 0.2s ease;
        }

        .profile-toggle-btn:hover, .profile-toggle-btn:focus {
            background-color: #F3F4F6;
            border-color: var(--border-color);
        }

        .profile-toggle-btn::after {
            display: none !important;
        }

        .header-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-red), var(--dark-red));
            color: var(--white);
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .header-admin-name {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--dark-text);
        }

        .header-chevron {
            font-size: 0.7rem;
            color: #6B7280;
            transition: transform 0.2s;
        }

        /* Profile Dropdown Menu */
        .admin-profile-menu {
            width: 280px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            padding: 12px;
        }

        .dropdown-avatar-lg {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-red), var(--dark-red));
            color: var(--gold-accent);
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--gold-accent);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .role-badge-gold {
            background-color: var(--gold-accent);
            color: var(--dark-text);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-profile-menu .dropdown-item {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 9px 12px;
            border-radius: 8px;
            color: #374151;
            display: flex;
            align-items: center;
            transition: all 0.15s ease;
        }

        .admin-profile-menu .dropdown-item i {
            width: 20px;
            font-size: 0.95rem;
            margin-right: 10px;
            color: #6B7280;
        }

        .admin-profile-menu .dropdown-item:hover {
            background-color: #F3F4F6;
            color: var(--dark-text);
        }

        .admin-profile-menu .dropdown-item:hover i {
            color: var(--primary-red);
        }

        .admin-profile-menu .dropdown-item.text-danger:hover {
            background-color: #FEE2E2;
            color: var(--primary-red);
        }

        .admin-profile-menu .dropdown-item.text-danger i {
            color: var(--primary-red);
        }

        /* Buttons adhering to design system */
        .btn-primary-red {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
            color: var(--white);
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-primary-red:hover, .btn-primary-red:focus, .btn-primary-red:active {
            background-color: var(--dark-red) !important;
            border-color: var(--dark-red) !important;
            color: var(--white) !important;
        }

        /* ==========================================================
           Nandani Admin - Unified Premium Filters & Pagination Theme
           ========================================================== */

        /* Elevated Filter Card */
        .admin-filter-card {
            background: #FFFFFF;
            border: 1px solid var(--border-color, #E5E7EB);
            border-radius: 14px;
            padding: 1.15rem 1.35rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            transition: box-shadow 0.2s ease;
        }

        .admin-filter-card:hover {
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
        }

        .filter-field-label {
            font-size: 0.74rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6B7280;
            margin-bottom: 0.35rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-field-label i {
            color: var(--primary-red, #C8102E);
            opacity: 0.85;
        }

        /* Filter Form Controls */
        .admin-filter-card .form-control,
        .admin-filter-card .form-select,
        .filter-control {
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 0.86rem;
            color: #1F2937;
            background-color: #FFFFFF;
            padding: 0.5rem 0.85rem;
            min-height: 38px;
            transition: all 0.2s ease;
        }

        .admin-filter-card .form-control:focus,
        .admin-filter-card .form-select:focus,
        .filter-control:focus {
            border-color: var(--primary-red, #C8102E) !important;
            box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.14) !important;
            outline: none;
        }

        /* Search Input Box with Icon */
        .filter-search-box {
            position: relative;
            width: 100%;
        }

        .filter-search-box .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            font-size: 0.88rem;
            pointer-events: none;
            z-index: 2;
            transition: color 0.2s ease;
        }

        .filter-search-box:focus-within .search-icon {
            color: var(--primary-red, #C8102E);
        }

        .filter-search-box .form-control {
            padding-left: 40px !important;
            padding-right: 36px !important;
        }

        .filter-search-box .btn-clear-search {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #9CA3AF;
            padding: 0;
            cursor: pointer;
            font-size: 0.95rem;
            transition: color 0.15s ease;
            z-index: 2;
        }

        .filter-search-box .btn-clear-search:hover {
            color: var(--primary-red, #C8102E);
        }

        /* Status Filter Pills */
        .status-filter-pills {
            display: inline-flex;
            align-items: center;
            background-color: #F3F4F6;
            padding: 4px;
            border-radius: 10px;
            gap: 4px;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .filter-pill-btn {
            border: none;
            background: transparent;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            color: #4B5563;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.18s ease;
        }

        .filter-pill-btn:hover {
            color: #111827;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .filter-pill-btn.active {
            background-color: #FFFFFF;
            color: var(--primary-red, #C8102E);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .filter-pill-count {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 1px 7px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.06);
            color: #4B5563;
        }

        .filter-pill-btn.active .filter-pill-count {
            background-color: rgba(200, 16, 46, 0.12);
            color: var(--primary-red, #C8102E);
        }

        /* Theme-Matched Reset Button */
        .btn-filter-reset {
            background-color: #FFFFFF;
            border: 1px solid #D1D5DB;
            color: #374151;
            font-size: 0.84rem;
            font-weight: 500;
            padding: 0.45rem 1rem;
            min-height: 38px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .btn-filter-reset i {
            color: var(--primary-red, #C8102E);
            font-size: 0.82rem;
            transition: transform 0.35s ease;
        }

        .btn-filter-reset:hover {
            background-color: #FFF5F5;
            color: var(--primary-red, #C8102E);
            border-color: var(--primary-red, #C8102E);
            box-shadow: 0 2px 8px rgba(200, 16, 46, 0.15);
        }

        .btn-filter-reset:hover i {
            transform: rotate(-180deg);
        }

        .btn-filter-reset:active {
            background-color: #FEE2E2;
            transform: translateY(1px);
        }

        /* ==========================================================
           Unified Nandani Pagination Theme
           ========================================================== */
        .pagination-container,
        .pagination-footer-bar {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 0.85rem 1.25rem;
            background-color: #FFFFFF;
            border-top: 1px solid var(--border-color, #E5E7EB);
        }

        @media (min-width: 576px) {
            .pagination-container,
            .pagination-footer-bar {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .pagination-range-info,
        .pagination-entries-text {
            font-size: 0.84rem;
            color: #6B7280;
            font-weight: 400;
            margin: 0;
        }

        .pagination-range-info strong,
        .pagination-entries-text strong {
            color: #111827;
            font-weight: 600;
        }

        /* Override Bootstrap 5 Pagination Variables & Base Styles */
        .pagination.nandani-pagination,
        .admin-main .pagination {
            --bs-pagination-color: #374151;
            --bs-pagination-bg: #FFFFFF;
            --bs-pagination-border-color: #E5E7EB;
            --bs-pagination-hover-color: var(--primary-red, #C8102E);
            --bs-pagination-hover-bg: #FFF5F5;
            --bs-pagination-hover-border-color: #FCA5A5;
            --bs-pagination-focus-color: var(--primary-red, #C8102E);
            --bs-pagination-focus-bg: #FFF5F5;
            --bs-pagination-focus-box-shadow: 0 0 0 0.2rem rgba(200, 16, 46, 0.15);
            --bs-pagination-active-color: #FFFFFF;
            --bs-pagination-active-bg: var(--primary-red, #C8102E);
            --bs-pagination-active-border-color: var(--primary-red, #C8102E);
            --bs-pagination-disabled-color: #9CA3AF;
            --bs-pagination-disabled-bg: #F9FAFB;
            --bs-pagination-disabled-border-color: #E5E7EB;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pagination.nandani-pagination .page-item,
        .admin-main .pagination .page-item {
            margin: 0;
        }

        .pagination.nandani-pagination .page-link,
        .admin-main .pagination .page-link {
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.84rem;
            font-weight: 500;
            color: #374151;
            background-color: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 8px !important;
            text-decoration: none;
            transition: all 0.18s ease;
            cursor: pointer;
            user-select: none;
        }

        .pagination.nandani-pagination .page-link:hover,
        .admin-main .pagination .page-link:hover {
            background-color: #FFF5F5 !important;
            color: var(--primary-red, #C8102E) !important;
            border-color: #FCA5A5 !important;
            box-shadow: 0 2px 4px rgba(200, 16, 46, 0.08);
        }

        .pagination.nandani-pagination .page-item.active .page-link,
        .admin-main .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-red, #C8102E), var(--dark-red, #8B0000)) !important;
            color: #FFFFFF !important;
            border-color: var(--primary-red, #C8102E) !important;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(200, 16, 46, 0.28) !important;
            cursor: default;
        }

        .pagination.nandani-pagination .page-item.disabled .page-link,
        .admin-main .pagination .page-item.disabled .page-link {
            background-color: #F9FAFB !important;
            color: #9CA3AF !important;
            border-color: #E5E7EB !important;
            cursor: not-allowed;
            opacity: 0.7;
            box-shadow: none !important;
        }

        /* Prev / Next Buttons */
        .pagination.nandani-pagination .page-link-prev,
        .pagination.nandani-pagination .page-link-next {
            padding: 0 13px !important;
            font-weight: 500;
            gap: 5px;
        }

        .pagination.nandani-pagination .page-link-prev i,
        .pagination.nandani-pagination .page-link-next i {
            font-size: 0.72rem;
            transition: transform 0.18s ease;
        }

        .pagination.nandani-pagination .page-link-prev:not(.disabled):hover i {
            transform: translateX(-2px);
        }

        .pagination.nandani-pagination .page-link-next:not(.disabled):hover i {
            transform: translateX(2px);
        }

        /* Ellipsis Dots Separator */
        .pagination.nandani-pagination .page-link-dots {
            background: transparent !important;
            border-color: transparent !important;
            color: #6B7280 !important;
            cursor: default !important;
            font-weight: 700;
            letter-spacing: 2px;
            min-width: 28px;
            padding: 0 4px;
        }

        .pagination.nandani-pagination .page-link-dots:hover {
            background: transparent !important;
            border-color: transparent !important;
            color: #6B7280 !important;
            box-shadow: none !important;
        }

        /* Mobile / Tablet Off-canvas Sidebar Collapse */

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1035;
                display: none;
            }
            .sidebar-backdrop.show {
                display: block;
            }
        }
    </style>
</head>
<body>

<div class="admin-wrapper">

    <!-- Shared Sidebar Component -->
    <?php $this->load->view('admin/layout/sidebar'); ?>

    <!-- Main Content Area beside Sidebar -->
    <div class="admin-main">
        
        <!-- Shared Top Header Component -->
        <header class="admin-topbar d-flex align-items-center justify-content-between px-3 px-lg-4">
            <!-- Left: Mobile Hamburger + Breadcrumb -->
            <div class="d-flex align-items-center">
                <!-- Hamburger Button (Tablet & Mobile) -->
                <button type="button" class="btn btn-outline-secondary btn-sm d-lg-none me-3" id="sidebarToggleBtn" aria-label="Toggle Sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Breadcrumb Text: Admin / Page Name -->
                <div class="breadcrumb-text d-flex align-items-center">
                    <i class="fa-solid fa-house-chimney text-muted me-2 d-none d-sm-inline" style="font-size: 0.8rem;"></i>
                    <span>Admin</span>
                    <span class="mx-2 text-muted">/</span>
                    <strong><?= html_escape($breadcrumb ?? $page_title ?? 'Dashboard') ?></strong>
                </div>
            </div>

            <!-- Right: Admin Profile Block with Dropdown -->
            <div class="dropdown">
                <button class="profile-toggle-btn d-flex align-items-center text-decoration-none border-0" 
                        type="button" 
                        id="adminProfileDropdown" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                    <?php if (!empty($admin_user['profile_image']) && file_exists(FCPATH . $admin_user['profile_image'])): ?>
                        <img src="<?= base_url($admin_user['profile_image']) ?>" alt="Avatar" class="header-avatar me-2" style="object-fit: cover;">
                    <?php else: ?>
                        <div class="header-avatar me-2">
                            <?= strtoupper(substr($admin_user['name'] ?? 'Admin', 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                    <span class="header-admin-name d-none d-md-inline me-2"><?= html_escape($admin_user['name'] ?? 'Admin') ?></span>
                    <i class="fa-solid fa-chevron-down header-chevron"></i>
                </button>

                <!-- Profile Dropdown Component -->
                <ul class="dropdown-menu dropdown-menu-end admin-profile-menu mt-2" aria-labelledby="adminProfileDropdown">
                    <!-- User Info Card Header -->
                    <li class="px-2 py-2 mb-2 bg-light rounded-3 d-flex align-items-center">
                        <?php if (!empty($admin_user['profile_image']) && file_exists(FCPATH . $admin_user['profile_image'])): ?>
                            <img src="<?= base_url($admin_user['profile_image']) ?>" alt="Avatar" class="dropdown-avatar-lg me-3 flex-shrink-0" style="object-fit: cover;">
                        <?php else: ?>
                            <div class="dropdown-avatar-lg me-3 flex-shrink-0">
                                <?= strtoupper(substr($admin_user['name'] ?? 'Admin', 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        <div class="overflow-hidden">
                            <div class="fw-bold text-dark text-truncate" style="font-size: 0.95rem;">
                                <?= html_escape($admin_user['name'] ?? 'Admin') ?>
                            </div>
                            <div class="text-muted text-truncate mb-1" style="font-size: 0.75rem;">
                                <?= html_escape($admin_user['email'] ?? 'admin@nandanienterprise.com') ?>
                            </div>
                            <span class="role-badge-gold">
                                <i class="fa-solid fa-shield-halved me-1"></i><?= html_escape($admin_user['role'] ?? 'Super Admin') ?>
                            </span>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <a class="dropdown-item" href="<?= base_url('admin/profile') ?>">
                            <i class="fa-solid fa-user-gear"></i>Profile Settings
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= base_url('admin/change-password') ?>">
                            <i class="fa-solid fa-key"></i>Change Password
                        </a>
                    </li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="<?= base_url('admin/logout') ?>">
                            <i class="fa-solid fa-sign-out-alt"></i>Sign Out
                        </a>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Page Specific Content Container -->
        <main class="flex-grow-1 px-3 px-lg-4 py-3">
