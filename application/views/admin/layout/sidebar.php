<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Admin Sidebar -->
<aside id="adminSidebar" class="admin-sidebar d-flex flex-column flex-shrink-0 text-white">
    <!-- Brand Header -->
    <div class="sidebar-brand d-flex align-items-center justify-content-between px-3 py-3 border-bottom border-secondary border-opacity-25">
        <a href="<?= base_url('admin/dashboard') ?>" class="d-flex align-items-center justify-content-center flex-grow-1 text-decoration-none py-1" title="Nandani Admin Panel">
            <img src="<?= base_url('assets/images/logo-white.png') ?>" alt="Nandani" class="sidebar-brand-img" style="height: 46px; max-width: 155px; width: auto; object-fit: contain; filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.45));">
        </a>
        <!-- Close button on Mobile/Tablet -->
        <button type="button" class="btn-close btn-close-white d-lg-none ms-2" id="sidebarCloseBtn" aria-label="Close"></button>
    </div>

    <!-- Navigation Modules -->
    <div class="sidebar-nav-wrapper flex-grow-1 overflow-auto py-3">
        <div class="nav-section-title px-3 mb-2 text-uppercase">Modules</div>
        <ul class="nav nav-pills flex-column mb-auto px-2">
            <!-- Dashboard -->
            <li class="nav-item mb-1">
                <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= ($active_menu === 'dashboard') ? 'active' : '' ?>">
                    <i class="fa-solid fa-gauge-high nav-icon"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Categories -->
            <li class="nav-item mb-1">
                <a href="<?= base_url('admin/category') ?>" class="nav-link <?= ($active_menu === 'categories' || $active_menu === 'category') ? 'active' : '' ?>">
                    <i class="fa-solid fa-layer-group nav-icon"></i>
                    <span>Categories</span>
                    <span class="badge ms-auto nav-badge">Master</span>
                </a>
            </li>

            <!-- Brands -->
            <li class="nav-item mb-1">
                <a href="<?= base_url('admin/brands') ?>" class="nav-link <?= ($active_menu === 'brands') ? 'active' : '' ?>">
                    <i class="fa-solid fa-tags nav-icon"></i>
                    <span>Brands</span>
                </a>
            </li>

            <!-- Products -->
            <li class="nav-item mb-1">
                <a href="<?= base_url('admin/products') ?>" class="nav-link <?= ($active_menu === 'products') ? 'active' : '' ?>">
                    <i class="fa-solid fa-box-open nav-icon"></i>
                    <span>Products</span>
                </a>
            </li>

            <!-- Hero Slider -->
            <li class="nav-item mb-1">
                <a href="<?= base_url('admin/hero-slider') ?>" class="nav-link <?= ($active_menu === 'hero_slider') ? 'active' : '' ?>">
                    <i class="fa-solid fa-images nav-icon"></i>
                    <span>Hero Slider</span>
                </a>
            </li>

            <!-- Gallery -->
            <li class="nav-item mb-1">
                <a href="<?= base_url('admin/gallery') ?>" class="nav-link <?= ($active_menu === 'gallery') ? 'active' : '' ?>">
                    <i class="fa-solid fa-photo-film nav-icon"></i>
                    <span>Gallery</span>
                </a>
            </li>

            <!-- Enquiries Dropdown -->
            <?php 
                $is_enquiry_active = in_array($active_menu, ['enquiries', 'contact_enquiries', 'distributor_enquiries'], TRUE);
            ?>
            <li class="nav-item mb-1">
                <a href="#submenuEnquiries" 
                   class="nav-link d-flex align-items-center justify-content-between <?= $is_enquiry_active ? 'active-parent' : 'collapsed' ?>" 
                   data-bs-toggle="collapse" 
                   role="button" 
                   aria-expanded="<?= $is_enquiry_active ? 'true' : 'false' ?>" 
                   aria-controls="submenuEnquiries">
                    <span class="d-flex align-items-center">
                        <i class="fa-solid fa-envelope-open-text nav-icon"></i>
                        <span>Enquiries</span>
                    </span>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <div class="collapse <?= $is_enquiry_active ? 'show' : '' ?>" id="submenuEnquiries">
                    <div class="sidebar-submenu-box">
                        <ul class="sidebar-submenu">
                            <li class="mb-1">
                                <a href="<?= base_url('admin/enquiries/contact') ?>" class="submenu-link <?= ($active_menu === 'contact_enquiries') ? 'active' : '' ?>">
                                    <i class="fa-regular fa-envelope submenu-icon"></i>
                                    <span>Contact Enquiry</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/enquiries/distributor') ?>" class="submenu-link <?= ($active_menu === 'distributor_enquiries') ? 'active' : '' ?>">
                                    <i class="fa-solid fa-briefcase submenu-icon"></i>
                                    <span>Distributor</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <!-- Settings -->
            <li class="nav-item mb-1">
                <a href="<?= base_url('admin/settings') ?>" class="nav-link <?= ($active_menu === 'settings') ? 'active' : '' ?>">
                    <i class="fa-solid fa-sliders nav-icon"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Pinned Sign Out at Bottom -->
    <div class="sidebar-footer p-3 border-top border-secondary border-opacity-25 mt-auto">
        <a href="<?= base_url('admin/logout') ?>" class="btn-signout d-flex align-items-center justify-content-between text-decoration-none">
            <span class="d-flex align-items-center">
                <i class="fa-solid fa-right-from-bracket me-2"></i>
                <span class="fw-semibold">Sign Out</span>
            </span>
            <i class="fa-solid fa-arrow-right-from-bracket opacity-50"></i>
        </a>
    </div>
</aside>

<!-- Mobile Overlay Backdrop -->
<div id="sidebarBackdrop" class="sidebar-backdrop d-lg-none"></div>
