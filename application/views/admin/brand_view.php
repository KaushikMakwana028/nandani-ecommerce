<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Scoped Styles inside <style> Tag -->
<style>
    .brand-header {
        margin-bottom: 1.5rem;
    }

    .brand-title {
        font-family: var(--font-heading);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    /* Stats Card */
    .brand-stat-box {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0.85rem 1.25rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .brand-stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background-color: rgba(200, 16, 46, 0.1);
        color: var(--primary-red);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    /* Main Table Card */
    .brand-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .brand-card-header {
        padding: 1.25rem 1.5rem;
        background-color: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    .table-brands {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table-brands thead th {
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: #6B7280;
        background-color: #F9FAFB;
        border-bottom: 1px solid var(--border-color);
        padding: 0.85rem 1rem;
        white-space: nowrap;
    }

    .table-brands tbody tr {
        transition: background-color 0.15s ease;
    }

    .table-brands tbody tr:hover {
        background-color: #F9FAFB;
    }

    .table-brands td {
        padding: 1rem 1rem;
        border-bottom: 1px solid #F3F4F6;
        color: var(--dark-text);
        font-size: 0.9rem;
    }

    /* Logo Thumbnail Display (supports transparent PNGs) */
    .brand-logo-wrapper {
        width: 80px;
        height: 60px;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        background-color: #FAFAFA;
        background-image: 
            linear-gradient(45deg, #F0F0F0 25%, transparent 25%), 
            linear-gradient(-45deg, #F0F0F0 25%, transparent 25%), 
            linear-gradient(45deg, transparent 75%, #F0F0F0 75%), 
            linear-gradient(-45deg, transparent 75%, #F0F0F0 75%);
        background-size: 12px 12px;
        background-position: 0 0, 0 6px, 6px -6px, -6px 0px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px;
        overflow: hidden;
    }

    .brand-logo-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* Category Badge */
    .cat-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        background-color: #EFF6FF;
        color: #1D4ED8;
        border: 1px solid #DBEAFE;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .since-pill {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 4px;
        background-color: #F3F4F6;
        color: #4B5563;
        display: inline-block;
    }

    /* Status Pill */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .status-pill.active {
        background-color: #ECFDF5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }

    .status-pill.inactive {
        background-color: #F3F4F6;
        color: #4B5563;
        border: 1px solid #E5E7EB;
    }

    .status-pill:hover {
        opacity: 0.85;
    }

    .status-pill-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-pill.active .status-pill-dot {
        background-color: #10B981;
    }

    .status-pill.inactive .status-pill-dot {
        background-color: #9CA3AF;
    }

    /* Action Buttons */
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        background-color: var(--white);
        color: #4B5563;
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
        padding: 0;
    }

    .action-btn:hover {
        background-color: #F3F4F6;
        color: var(--dark-text);
        border-color: #D1D5DB;
    }

    .action-btn.btn-delete:hover {
        background-color: #FEE2E2;
        color: var(--primary-red);
        border-color: #FCA5A5;
    }

    /* Upload & Image Dropzone */
    .logo-dropzone {
        border: 2px dashed #D1D5DB;
        border-radius: 10px;
        padding: 1.25rem;
        text-align: center;
        background-color: #F9FAFB;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .logo-dropzone:hover {
        border-color: var(--primary-red);
        background-color: #FFF5F5;
    }

    .logo-dropzone input[type="file"] {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .logo-preview-box {
        position: relative;
        width: 140px;
        height: 80px;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        background-color: #FAFAFA;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        margin-top: 10px;
    }

    .logo-preview-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>

<div class="container-fluid p-0">

    <!-- Page Header & Action Controls -->
    <div class="brand-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="brand-title">Brand Management</h1>
            <p class="text-muted small mb-0 mt-1">Manage brand identities and link them to active product categories.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="brand-stat-box">
                <div class="brand-stat-icon">
                    <i class="fa-solid fa-tags"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark lh-1" style="font-size: 1.15rem;"><?= $total_brands ?></div>
                    <small class="text-muted" style="font-size: 0.75rem;">Total Brands (<?= $active_brands ?> Active)</small>
                </div>
            </div>
            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addBrandModal" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                <i class="fa-solid fa-plus"></i>
                <span>Add New Brand</span>
            </button>
        </div>
    </div>


    <!-- Brand Filters Toolbar -->
    <div class="admin-filter-card mb-4">
        <form id="brandFilterForm" method="GET" action="<?= base_url('admin/brands') ?>">
            <!-- Top Tier: Search Input + Per Page & Reset -->
            <div class="row g-2 align-items-center mb-3">
                <div class="col-12 col-lg-8">
                    <div class="filter-search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" class="form-control" name="q" id="brand_filter_q" value="<?= htmlspecialchars($search_query) ?>" placeholder="Search brand name or description...">
                        <button type="button" class="btn-clear-search <?= empty($search_query) ? 'd-none' : '' ?>" id="clearBrandSearchBtn" aria-label="Clear Search">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-lg-end gap-2">
                    <div class="d-flex align-items-center gap-2 flex-grow-1 flex-lg-grow-0">
                        <span class="text-muted small d-none d-sm-inline">Show:</span>
                        <select class="form-select form-select-sm filter-control" name="per_page" id="brand_filter_per_page" title="Items per page" style="min-width: 95px;">
                            <option value="10" <?= ($per_page == 10) ? 'selected' : '' ?>>10 / page</option>
                            <option value="25" <?= ($per_page == 25) ? 'selected' : '' ?>>25 / page</option>
                            <option value="50" <?= ($per_page == 50) ? 'selected' : '' ?>>50 / page</option>
                            <option value="100" <?= ($per_page == 100) ? 'selected' : '' ?>>100 / page</option>
                        </select>
                    </div>
                    <button type="button" class="btn-filter-reset" id="resetBrandFiltersBtn" title="Reset all filters">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Reset</span>
                    </button>
                </div>
            </div>

            <!-- Bottom Tier: Category & Status Dropdowns -->
            <div class="row g-2 pt-2 border-top">
                <div class="col-12 col-sm-6">
                    <label class="filter-field-label"><i class="fa-solid fa-layer-group me-1 opacity-75"></i> Category</label>
                    <select class="form-select form-select-sm filter-control" name="category_id" id="brand_filter_category_id">
                        <option value="0">All Product Categories</option>
                        <?php if (!empty($product_categories)): ?>
                            <?php foreach ($product_categories as $c): ?>
                                <option value="<?= $c->id ?>" <?= ($selected_category == $c->id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c->name) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-12 col-sm-6">
                    <label class="filter-field-label"><i class="fa-solid fa-toggle-on me-1 opacity-75"></i> Status</label>
                    <select class="form-select form-select-sm filter-control" name="status" id="brand_filter_status">
                        <option value="">All Statuses</option>
                        <option value="active" <?= ($selected_status === 'active') ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= ($selected_status === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Brands Table Card -->
    <div class="brand-card mb-4 position-relative">
        <!-- Loading Overlay -->
        <div id="brandTableOverlay" class="position-absolute w-100 h-100 top-0 start-0 d-none justify-content-center align-items-center" style="background: rgba(255,255,255,0.7); z-index: 10; backdrop-filter: blur(1px);">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="brand-card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-tags text-muted"></i>
                <h5 class="mb-0 fw-bold text-dark fs-6">Registered Brands</h5>
            </div>
            <span class="text-muted small" id="showingBrandCountBadge"><?= $total_filtered ?> brand(s) found</span>
        </div>

        <div class="table-responsive">
            <table class="table table-brands" id="brandsTable">
                <thead>
                    <tr>
                        <th style="width: 100px;">Logo</th>
                        <th>Brand Details</th>
                        <th style="width: 180px;">Product Category</th>
                        <th style="width: 110px;">Since Year</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 110px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="brandTableBody">
                    <?php $this->load->view('admin/partials/brand_table_rows', [
                        'brands'       => $brands,
                        'search_query' => $search_query
                    ]); ?>
                </tbody>
            </table>
        </div>

        <!-- Table Pagination and Entry Counter Footer -->
        <div class="pagination-footer-bar">
            <div class="pagination-entries-text" id="showingBrandEntriesText">
                Showing <strong><?= $from_entry ?></strong> to <strong><?= $to_entry ?></strong> of <strong><?= $total_filtered ?></strong> brands
            </div>
            <div id="brandPaginationContainer">
                <?= $pagination_html ?>
            </div>
        </div>
    </div>


</div>

<!-- ==========================================
     MODAL: ADD NEW BRAND
========================================== -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <form action="<?= base_url('admin/brands/add') ?>" method="POST" enctype="multipart/form-data" id="addBrandForm">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="addBrandModalLabel">
                        <i class="fa-solid fa-plus-circle text-danger me-2" style="color: var(--primary-red) !important;"></i>Add New Brand
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Row 1: Logo Upload (Strict PNG) -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark mb-1">
                            Brand Logo (PNG Only) <span class="text-danger">*</span>
                        </label>
                        <div class="logo-dropzone" id="addLogoDropzone">
                            <input type="file" name="logo_image" id="add_brand_logo" accept="image/png" required>
                            <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                            <div class="fw-semibold text-dark small">Click or drag transparent PNG logo here</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Strictly PNG format (.png) &bull; Transparent background recommended &bull; Max 2MB</div>
                        </div>
                        <div class="logo-preview-box d-none" id="add_logo_preview_box">
                            <img id="add_logo_preview_img" src="#" alt="Logo Preview">
                        </div>
                    </div>

                    <!-- Row 2: Brand Name & Category Dropdown -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label for="add_brand_name" class="form-label fw-bold small text-dark mb-1">
                                Brand Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" id="add_brand_name" placeholder="e.g., Nandani Premium Stoves" maxlength="100" required>
                        </div>
                        <div class="col-md-5">
                            <label for="add_category_id" class="form-label fw-bold small text-dark mb-1">
                                Product Category <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="category_id" id="add_category_id" required>
                                <option value="" disabled selected>-- Select Product Category --</option>
                                <?php if (!empty($product_categories)): ?>
                                    <?php foreach ($product_categories as $pc): ?>
                                        <option value="<?= $pc->id ?>"><?= htmlspecialchars($pc->name) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <small class="text-muted" style="font-size: 0.72rem;">Only active Product categories are available.</small>
                        </div>
                    </div>

                    <!-- Row 3: Since Year & Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="add_since_year" class="form-label fw-bold small text-dark mb-1">
                                Since Year (Established)
                            </label>
                            <input type="number" class="form-control" name="since_year" id="add_since_year" placeholder="e.g., 1998" min="1900" max="<?= date('Y') ?>">
                            <small class="text-muted" style="font-size: 0.72rem;">Year between 1900 and <?= date('Y') ?>.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="add_status" class="form-label fw-bold small text-dark mb-1">
                                Status
                            </label>
                            <select class="form-select" name="status" id="add_status">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Short Description -->
                    <div class="mb-2">
                        <label for="add_short_description" class="form-label fw-bold small text-dark mb-1">
                            Short Description
                        </label>
                        <textarea class="form-control" name="short_description" id="add_short_description" rows="2" maxlength="255" placeholder="Brief 1-2 sentence tagline or overview of this brand..."></textarea>
                        <small class="text-muted" style="font-size: 0.72rem;">Maximum 255 characters.</small>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                        <i class="fa-solid fa-check me-1"></i> Save Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: EDIT BRAND (IN-PLACE POPULATED)
========================================== -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <form action="" method="POST" enctype="multipart/form-data" id="editBrandForm">
                <input type="hidden" name="id" id="edit_brand_id" value="">

                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="editBrandModalLabel">
                        <i class="fa-solid fa-pen-to-square text-danger me-2" style="color: var(--primary-red) !important;"></i>Edit Brand
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Row 1: Logo Upload & Existing Preview -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark mb-1">
                            Brand Logo (PNG Only)
                        </label>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <div class="logo-preview-box mt-0" style="width: 100%; height: 90px;">
                                    <img id="edit_current_logo_img" src="#" alt="Current Logo">
                                </div>
                                <small class="text-muted d-block text-center mt-1" style="font-size: 0.75rem;">Current PNG Logo</small>
                            </div>
                            <div class="col-md-8">
                                <div class="logo-dropzone" id="editLogoDropzone">
                                    <input type="file" name="logo_image" id="edit_brand_logo" accept="image/png">
                                    <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                                    <div class="fw-semibold text-dark small">Upload replacement PNG logo</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Leave empty to keep existing logo &bull; PNG only (Max 2MB)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Brand Name & Category Dropdown -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label for="edit_brand_name" class="form-label fw-bold small text-dark mb-1">
                                Brand Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" id="edit_brand_name" maxlength="100" required>
                        </div>
                        <div class="col-md-5">
                            <label for="edit_category_id" class="form-label fw-bold small text-dark mb-1">
                                Product Category <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="category_id" id="edit_category_id" required>
                                <option value="" disabled>-- Select Product Category --</option>
                                <?php if (!empty($product_categories)): ?>
                                    <?php foreach ($product_categories as $pc): ?>
                                        <option value="<?= $pc->id ?>"><?= htmlspecialchars($pc->name) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <small class="text-muted" style="font-size: 0.72rem;">Only active Product categories are available.</small>
                        </div>
                    </div>

                    <!-- Row 3: Since Year & Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_since_year" class="form-label fw-bold small text-dark mb-1">
                                Since Year (Established)
                            </label>
                            <input type="number" class="form-control" name="since_year" id="edit_since_year" min="1900" max="<?= date('Y') ?>">
                            <small class="text-muted" style="font-size: 0.72rem;">Year between 1900 and <?= date('Y') ?>.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_status" class="form-label fw-bold small text-dark mb-1">
                                Status
                            </label>
                            <select class="form-select" name="status" id="edit_status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Short Description -->
                    <div class="mb-2">
                        <label for="edit_short_description" class="form-label fw-bold small text-dark mb-1">
                            Short Description
                        </label>
                        <textarea class="form-control" name="short_description" id="edit_short_description" rows="2" maxlength="255"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                        <i class="fa-solid fa-check me-1"></i> Update Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     SCRIPTS: BRAND MODALS, PNG PREVIEWS & LIVE AJAX
========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const baseUrl = '<?= base_url() ?>';
    const brandsEndpoint = baseUrl + 'admin/brands';

    // Filter controls
    const filterForm       = document.getElementById('brandFilterForm');
    const filterQ          = document.getElementById('brand_filter_q');
    const filterCategory   = document.getElementById('brand_filter_category_id');
    const filterStatus     = document.getElementById('brand_filter_status');
    const filterPerPage    = document.getElementById('brand_filter_per_page');
    const resetFiltersBtn  = document.getElementById('resetBrandFiltersBtn');
    const clearSearchBtn   = document.getElementById('clearBrandSearchBtn');
    const tableBody        = document.getElementById('brandTableBody');
    const tableOverlay     = document.getElementById('brandTableOverlay');
    const paginationBox    = document.getElementById('brandPaginationContainer');
    const entriesText      = document.getElementById('showingBrandEntriesText');
    const countBadge       = document.getElementById('showingBrandCountBadge');

    let currentPage = <?= $current_page ?>;
    let searchTimer = null;

    // AJAX Fetch Function
    function fetchBrands(page = 1) {
        currentPage = page;

        if (tableOverlay) {
            tableOverlay.classList.remove('d-none');
            tableOverlay.classList.add('d-flex');
        }

        const params = new URLSearchParams();
        const qVal = filterQ ? filterQ.value.trim() : '';
        if (qVal) params.append('q', qVal);

        const catVal = filterCategory ? filterCategory.value : '0';
        if (catVal && catVal !== '0') params.append('category_id', catVal);

        const statusVal = filterStatus ? filterStatus.value : '';
        if (statusVal) params.append('status', statusVal);

        const perPageVal = filterPerPage ? filterPerPage.value : '10';
        params.append('per_page', perPageVal);
        params.append('page', page);
        params.append('ajax', '1');

        // Update URL
        const urlParams = new URLSearchParams(params);
        urlParams.delete('ajax');
        const newUrl = brandsEndpoint + (urlParams.toString() ? '?' + urlParams.toString() : '');
        window.history.replaceState({}, '', newUrl);

        fetch(brandsEndpoint + '?' + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                if (tableBody) tableBody.innerHTML = data.html;
                if (paginationBox) paginationBox.innerHTML = data.pagination;
                if (entriesText) {
                    entriesText.innerHTML = (data.total > 0)
                        ? `Showing <strong>${data.from}</strong> to <strong>${data.to}</strong> of <strong>${data.total}</strong> brands`
                        : 'No brands found';
                }
                if (countBadge) countBadge.textContent = data.total + ' brand(s) found';
            }
        })
        .catch(err => {
            console.error('Error fetching brands:', err);
        })
        .finally(() => {
            if (tableOverlay) {
                tableOverlay.classList.add('d-none');
                tableOverlay.classList.remove('d-flex');
            }
        });
    }

    // Debounced search
    if (filterQ) {
        filterQ.addEventListener('input', function() {
            if (clearSearchBtn) {
                clearSearchBtn.classList.toggle('d-none', !this.value.trim());
            }
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                fetchBrands(1);
            }, 300);
        });
    }

    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', function() {
            if (filterQ) {
                filterQ.value = '';
                filterQ.focus();
            }
            clearSearchBtn.classList.add('d-none');
            fetchBrands(1);
        });
    }

    // Selects
    [filterCategory, filterStatus, filterPerPage].forEach(el => {
        if (el) {
            el.addEventListener('change', function() {
                fetchBrands(1);
            });
        }
    });

    // Reset filters
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', function() {
            if (filterQ) filterQ.value = '';
            if (clearSearchBtn) clearSearchBtn.classList.add('d-none');
            if (filterCategory) filterCategory.value = '0';
            if (filterStatus) filterStatus.value = '';
            if (filterPerPage) filterPerPage.value = '10';
            fetchBrands(1);
        });
    }

    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'resetBrandFiltersBtn') {
            if (resetFiltersBtn) resetFiltersBtn.click();
        }
    });

    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetchBrands(1);
        });
    }

    // Pagination Click
    if (paginationBox) {
        paginationBox.addEventListener('click', function(e) {
            const link = e.target.closest('.page-link');
            if (link && link.dataset.page) {
                e.preventDefault();
                const targetPage = parseInt(link.dataset.page, 10);
                if (targetPage > 0) {
                    fetchBrands(targetPage);
                }
            }
        });
    }

    // 1. ADD LOGO PNG PREVIEW
    const addLogoInput = document.getElementById('add_brand_logo');
    const addPreviewBox = document.getElementById('add_logo_preview_box');
    const addPreviewImg = document.getElementById('add_logo_preview_img');

    if (addLogoInput) {
        addLogoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                if (file.type !== 'image/png') {
                    alert('Please select a PNG image file.');
                    this.value = '';
                    addPreviewBox.classList.add('d-none');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    addPreviewImg.src = e.target.result;
                    addPreviewBox.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // 2. EDIT LOGO PNG PREVIEW
    const editLogoInput = document.getElementById('edit_brand_logo');
    const editCurrentImg = document.getElementById('edit_current_logo_img');

    if (editLogoInput) {
        editLogoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                if (file.type !== 'image/png') {
                    alert('Please select a PNG image file.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    editCurrentImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // 3. EDIT BRAND MODAL POPULATION (Event Delegation)
    const editModalEl = document.getElementById('editBrandModal');
    const editModal = editModalEl ? new bootstrap.Modal(editModalEl) : null;
    const editForm = document.getElementById('editBrandForm');

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-edit-brand');
        if (!btn) return;

        const tr = btn.closest('.brand-row');
        if (!tr) return;

        const id = tr.dataset.id;
        const name = tr.dataset.name || '';
        const categoryId = tr.dataset.categoryId || '';
        const sinceYear = tr.dataset.sinceYear || '';
        const shortDesc = tr.dataset.shortDesc || '';
        const status = tr.dataset.status || 'active';
        const logo = tr.dataset.logo || '';

        // Populate form fields
        if (editForm) {
            editForm.action = baseUrl + 'admin/brands/edit/' + id;
            document.getElementById('edit_brand_id').value = id;
            document.getElementById('edit_brand_name').value = name;
            document.getElementById('edit_category_id').value = categoryId;
            document.getElementById('edit_since_year').value = sinceYear;
            document.getElementById('edit_short_description').value = shortDesc;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_current_logo_img').src = logo;

            // Reset file input
            if (editLogoInput) editLogoInput.value = '';

            if (editModal) editModal.show();
        }
    });
});
</script>
