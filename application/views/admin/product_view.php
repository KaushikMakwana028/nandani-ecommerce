<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Scoped Styles inside <style> Tag -->
<style>
    .prod-header {
        margin-bottom: 1.5rem;
    }

    .prod-title {
        font-family: var(--font-heading);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    /* Stats Card */
    .prod-stat-box {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0.85rem 1.25rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .prod-stat-icon {
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

    /* Search & Filter Bar */
    .prod-search-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .search-input-group {
        position: relative;
    }

    .search-input-group .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9CA3AF;
        font-size: 0.9rem;
    }

    .search-input-group .form-control {
        padding-left: 38px;
        border-radius: 8px;
        border-color: #D1D5DB;
        font-size: 0.9rem;
    }

    .search-input-group .form-control:focus {
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.12);
    }

    /* Main Table Card */
    .prod-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .prod-card-header {
        padding: 1.25rem 1.5rem;
        background-color: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    .table-products {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table-products thead th {
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

    .table-products tbody tr {
        transition: background-color 0.15s ease;
    }

    .table-products tbody tr:hover {
        background-color: #F9FAFB;
    }

    .table-products td {
        padding: 1rem 1rem;
        border-bottom: 1px solid #F3F4F6;
        color: var(--dark-text);
        font-size: 0.9rem;
    }

    /* Thumbnail Display */
    .prod-thumb-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        background-color: #F9FAFB;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
        overflow: hidden;
    }

    .prod-thumb-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }

    /* Product Badges */
    .badge-pill-custom {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pill-custom.bestseller {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        color: #92400E;
        border: 1px solid #FCD34D;
    }

    .badge-pill-custom.new {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
        border: 1px solid #FCA5A5;
    }

    /* Category & Brand Pills */
    .brand-pill {
        font-size: 0.78rem;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 6px;
        background-color: #F3F4F6;
        color: #374151;
        border: 1px solid #E5E7EB;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .cat-pill {
        font-size: 0.78rem;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 6px;
        background-color: #EFF6FF;
        color: #1D4ED8;
        border: 1px solid #DBEAFE;
        display: inline-flex;
        align-items: center;
        gap: 4px;
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

    /* Dropzone Upload Styling */
    .image-dropzone {
        border: 2px dashed #D1D5DB;
        border-radius: 10px;
        padding: 1.25rem;
        text-align: center;
        background-color: #F9FAFB;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .image-dropzone:hover {
        border-color: var(--primary-red);
        background-color: #FFF5F5;
    }

    .image-dropzone input[type="file"] {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .image-preview-container {
        position: relative;
        width: 120px;
        height: 100px;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        background-color: #FAFAFA;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
        margin-top: 10px;
        overflow: hidden;
    }

    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }
</style>

<div class="container-fluid p-0">

    <!-- Page Header & Action Controls -->
    <div class="prod-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="prod-title">Product Management</h1>
            <p class="text-muted small mb-0 mt-1">Manage product catalog items, brand associations, categories, and showcase badges.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="prod-stat-box">
                <div class="prod-stat-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark lh-1" style="font-size: 1.15rem;"><?= $total_products ?></div>
                    <small class="text-muted" style="font-size: 0.75rem;">Total Products (<?= $active_products ?> Active)</small>
                </div>
            </div>
            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addProductModal" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                <i class="fa-solid fa-plus"></i>
                <span>Add New Product</span>
            </button>
        </div>
    </div>


    <!-- Comprehensive Filter Toolbar -->
    <div class="admin-filter-card mb-4">
        <form id="productFilterForm" method="GET" action="<?= base_url('admin/products') ?>">
            <!-- Top Tier: Search Bar on Left, Items per page & Reset on Right -->
            <div class="row g-2 align-items-center mb-3">
                <div class="col-12 col-lg-8">
                    <div class="filter-search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" class="form-control" name="q" id="filter_q" value="<?= htmlspecialchars($search_query) ?>" placeholder="Search product name, code, or description...">
                        <button type="button" class="btn-clear-search <?= empty($search_query) ? 'd-none' : '' ?>" id="clearSearchBtn" aria-label="Clear Search">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-lg-end gap-2">
                    <div class="d-flex align-items-center gap-2 flex-grow-1 flex-lg-grow-0">
                        <span class="text-muted small d-none d-sm-inline">Show:</span>
                        <select class="form-select form-select-sm filter-control" name="per_page" id="filter_per_page" title="Items per page" style="min-width: 95px;">
                            <option value="10" <?= ($per_page == 10) ? 'selected' : '' ?>>10 / page</option>
                            <option value="25" <?= ($per_page == 25) ? 'selected' : '' ?>>25 / page</option>
                            <option value="50" <?= ($per_page == 50) ? 'selected' : '' ?>>50 / page</option>
                            <option value="100" <?= ($per_page == 100) ? 'selected' : '' ?>>100 / page</option>
                        </select>
                    </div>
                    <button type="button" class="btn-filter-reset" id="resetFiltersBtn" title="Reset all filters">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Reset</span>
                    </button>
                </div>
            </div>

            <!-- Bottom Tier: Filter Dropdowns Grid with clear labels -->
            <div class="row g-2 pt-2 border-top">
                <!-- Category Filter -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <label class="filter-field-label"><i class="fa-solid fa-layer-group me-1 opacity-75"></i> Category</label>
                    <select class="form-select form-select-sm filter-control" name="category_id" id="filter_category_id">
                        <option value="0">All Categories</option>
                        <?php if (!empty($product_categories)): ?>
                            <?php foreach ($product_categories as $c): ?>
                                <option value="<?= $c->id ?>" <?= ($selected_category == $c->id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c->name) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Brand Filter -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <label class="filter-field-label"><i class="fa-solid fa-tags me-1 opacity-75"></i> Brand</label>
                    <select class="form-select form-select-sm filter-control" name="brand_id" id="filter_brand_id">
                        <option value="0">All Brands</option>
                        <?php if (!empty($brands)): ?>
                            <?php foreach ($brands as $b): ?>
                                <option value="<?= $b->id ?>" <?= ($selected_brand == $b->id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($b->name) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="col-6 col-sm-6 col-xl-3">
                    <label class="filter-field-label"><i class="fa-solid fa-toggle-on me-1 opacity-75"></i> Status</label>
                    <select class="form-select form-select-sm filter-control" name="status" id="filter_status">
                        <option value="">All Statuses</option>
                        <option value="active" <?= ($selected_status === 'active') ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= ($selected_status === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <!-- Badge Filter -->
                <div class="col-6 col-sm-6 col-xl-3">
                    <label class="filter-field-label"><i class="fa-solid fa-certificate me-1 opacity-75"></i> Badge</label>
                    <select class="form-select form-select-sm filter-control" name="badge" id="filter_badge">
                        <option value="">All Badges</option>
                        <option value="none" <?= ($selected_badge === 'none') ? 'selected' : '' ?>>Standard</option>
                        <option value="new" <?= ($selected_badge === 'new') ? 'selected' : '' ?>>New</option>
                        <option value="bestseller" <?= ($selected_badge === 'bestseller') ? 'selected' : '' ?>>Bestseller</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Products Table Card -->
    <div class="prod-card mb-4 position-relative">
        <!-- Loading Overlay -->
        <div id="productTableOverlay" class="position-absolute w-100 h-100 top-0 start-0 d-none justify-content-center align-items-center" style="background: rgba(255,255,255,0.7); z-index: 10; backdrop-filter: blur(1px);">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="prod-card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-box-open text-muted"></i>
                <h5 class="mb-0 fw-bold text-dark fs-6">Products Directory</h5>
            </div>
            <span class="text-muted small" id="showingCountBadge"><?= $total_filtered ?> items found</span>
        </div>

        <div class="table-responsive">
            <table class="table table-products" id="productsTable">
                <thead>
                    <tr>
                        <th style="width: 90px;">Thumbnail</th>
                        <th>Product Details</th>
                        <th style="width: 170px;">Brand</th>
                        <th style="width: 170px;">Category</th>
                        <th style="width: 130px;">Badge</th>
                        <th style="width: 110px;">Status</th>
                        <th style="width: 110px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <?php $this->load->view('admin/partials/product_table_rows', [
                        'products'     => $products,
                        'search_query' => $search_query
                    ]); ?>
                </tbody>
            </table>
        </div>

        <!-- Table Pagination and Entry Counter Footer -->
        <div class="pagination-footer-bar">
            <div class="pagination-entries-text" id="showingEntriesText">
                Showing <strong><?= $from_entry ?></strong> to <strong><?= $to_entry ?></strong> of <strong><?= $total_filtered ?></strong> items
            </div>
            <div id="paginationContainer">
                <?= $pagination_html ?>
            </div>
        </div>
    </div>


</div>

<!-- ==========================================
     MODAL: ADD NEW PRODUCT
========================================== -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <form action="<?= base_url('admin/products/add') ?>" method="POST" enctype="multipart/form-data" id="addProductForm">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="addProductModalLabel">
                        <i class="fa-solid fa-plus-circle text-danger me-2" style="color: var(--primary-red) !important;"></i>Add New Product
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark mb-1">
                            Product Image <span class="text-danger">*</span>
                        </label>
                        <div class="image-dropzone" id="addDropzone">
                            <input type="file" name="image" id="add_prod_image" accept="image/jpeg,image/png,image/webp" required>
                            <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                            <div class="fw-semibold text-dark small">Click or drag image file here to upload</div>
                            <div class="text-muted" style="font-size: 0.75rem;">JPG, PNG, WEBP (Max: 5MB)</div>
                        </div>
                        <div class="image-preview-container d-none" id="add_image_preview_box">
                            <img id="add_image_preview_img" src="#" alt="Preview">
                        </div>
                    </div>

                    <!-- Row 1: Product Name -->
                    <div class="mb-3">
                        <label for="add_prod_name" class="form-label fw-bold small text-dark mb-1">
                            Product Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="name" id="add_prod_name" placeholder="e.g., 3-Burner Toughened Glass Top Gas Stove" maxlength="150" required>
                    </div>

                    <!-- Row 2: Brand & Category Dropdowns -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="add_prod_brand" class="form-label fw-bold small text-dark mb-1">
                                Brand (Active Brands Only) <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="brand_id" id="add_prod_brand" required>
                                <option value="" disabled selected>-- Select Active Brand --</option>
                                <?php if (!empty($brands)): ?>
                                    <?php foreach ($brands as $b): ?>
                                        <option value="<?= $b->id ?>"><?= htmlspecialchars($b->name) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="add_prod_category" class="form-label fw-bold small text-dark mb-1">
                                Category (Product Only) <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="category_id" id="add_prod_category" required>
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

                    <!-- Row 3: Badge & Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="add_prod_badge" class="form-label fw-bold small text-dark mb-1">
                                Showcase Badge
                            </label>
                            <select class="form-select" name="badge" id="add_prod_badge">
                                <option value="none" selected>None (Standard)</option>
                                <option value="new">New Arrival (Red Badge)</option>
                                <option value="bestseller">Bestseller (Gold Badge)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="add_prod_status" class="form-label fw-bold small text-dark mb-1">
                                Status
                            </label>
                            <select class="form-select" name="status" id="add_prod_status">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Short Description -->
                    <div class="mb-2">
                        <label for="add_prod_short_desc" class="form-label fw-bold small text-dark mb-1">
                            Short Description
                        </label>
                        <textarea class="form-control" name="short_description" id="add_prod_short_desc" rows="2" maxlength="255" placeholder="Brief 1-2 sentence specification or highlight of this product..."></textarea>
                        <small class="text-muted" style="font-size: 0.72rem;">Maximum 255 characters.</small>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                        <i class="fa-solid fa-check me-1"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: EDIT PRODUCT (IN-PLACE POPULATED)
========================================== -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <form action="" method="POST" enctype="multipart/form-data" id="editProductForm">
                <input type="hidden" name="id" id="edit_prod_id" value="">

                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="editProductModalLabel">
                        <i class="fa-solid fa-pen-to-square text-danger me-2" style="color: var(--primary-red) !important;"></i>Edit Product
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Image Upload & Existing Thumbnail -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark mb-1">
                            Product Image
                        </label>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <div class="image-preview-container mt-0" style="width: 100%; height: 95px;">
                                    <img id="edit_current_img" src="#" alt="Current Product Image">
                                </div>
                                <small class="text-muted d-block text-center mt-1" style="font-size: 0.75rem;">Current Image</small>
                            </div>
                            <div class="col-md-8">
                                <div class="image-dropzone" id="editDropzone">
                                    <input type="file" name="image" id="edit_prod_image" accept="image/jpeg,image/png,image/webp">
                                    <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                                    <div class="fw-semibold text-dark small">Upload replacement image</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Leave empty to keep existing image &bull; Max 5MB</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 1: Product Name -->
                    <div class="mb-3">
                        <label for="edit_prod_name" class="form-label fw-bold small text-dark mb-1">
                            Product Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="name" id="edit_prod_name" maxlength="150" required>
                    </div>

                    <!-- Row 2: Brand & Category Dropdowns -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_prod_brand" class="form-label fw-bold small text-dark mb-1">
                                Brand <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="brand_id" id="edit_prod_brand" required>
                                <option value="" disabled>-- Select Brand --</option>
                                <?php if (!empty($brands)): ?>
                                    <?php foreach ($brands as $b): ?>
                                        <option value="<?= $b->id ?>"><?= htmlspecialchars($b->name) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_prod_category" class="form-label fw-bold small text-dark mb-1">
                                Category (Product Only) <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="category_id" id="edit_prod_category" required>
                                <option value="" disabled>-- Select Product Category --</option>
                                <?php if (!empty($product_categories)): ?>
                                    <?php foreach ($product_categories as $pc): ?>
                                        <option value="<?= $pc->id ?>"><?= htmlspecialchars($pc->name) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Row 3: Badge & Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_prod_badge" class="form-label fw-bold small text-dark mb-1">
                                Showcase Badge
                            </label>
                            <select class="form-select" name="badge" id="edit_prod_badge">
                                <option value="none">None (Standard)</option>
                                <option value="new">New Arrival (Red Badge)</option>
                                <option value="bestseller">Bestseller (Gold Badge)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_prod_status" class="form-label fw-bold small text-dark mb-1">
                                Status
                            </label>
                            <select class="form-select" name="status" id="edit_prod_status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Short Description -->
                    <div class="mb-2">
                        <label for="edit_prod_short_desc" class="form-label fw-bold small text-dark mb-1">
                            Short Description
                        </label>
                        <textarea class="form-control" name="short_description" id="edit_prod_short_desc" rows="2" maxlength="255"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                        <i class="fa-solid fa-check me-1"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     SCRIPTS: PRODUCT MODALS & PREVIEWS
========================================== -->
<!-- ==========================================
     SCRIPTS: PRODUCT MODALS, PREVIEWS & LIVE AJAX
========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const baseUrl = '<?= base_url() ?>';
    const productsEndpoint = baseUrl + 'admin/products';

    // Elements
    const filterForm       = document.getElementById('productFilterForm');
    const filterQ          = document.getElementById('filter_q');
    const filterCategory   = document.getElementById('filter_category_id');
    const filterBrand      = document.getElementById('filter_brand_id');
    const filterStatus     = document.getElementById('filter_status');
    const filterBadge      = document.getElementById('filter_badge');
    const filterPerPage    = document.getElementById('filter_per_page');
    const resetFiltersBtn  = document.getElementById('resetFiltersBtn');
    const clearSearchBtn   = document.getElementById('clearSearchBtn');
    const tableBody        = document.getElementById('productTableBody');
    const tableOverlay     = document.getElementById('productTableOverlay');
    const paginationBox    = document.getElementById('paginationContainer');
    const entriesText      = document.getElementById('showingEntriesText');
    const countBadge       = document.getElementById('showingCountBadge');

    let currentPage = <?= $current_page ?>;
    let searchTimer = null;

    // AJAX Fetch Function
    function fetchProducts(page = 1) {
        currentPage = page;

        // Show overlay spinner
        if (tableOverlay) {
            tableOverlay.classList.remove('d-none');
            tableOverlay.classList.add('d-flex');
        }

        const params = new URLSearchParams();
        const qVal = filterQ ? filterQ.value.trim() : '';
        if (qVal) params.append('q', qVal);

        const catVal = filterCategory ? filterCategory.value : '0';
        if (catVal && catVal !== '0') params.append('category_id', catVal);

        const brandVal = filterBrand ? filterBrand.value : '0';
        if (brandVal && brandVal !== '0') params.append('brand_id', brandVal);

        const statusVal = filterStatus ? filterStatus.value : '';
        if (statusVal) params.append('status', statusVal);

        const badgeVal = filterBadge ? filterBadge.value : '';
        if (badgeVal) params.append('badge', badgeVal);

        const perPageVal = filterPerPage ? filterPerPage.value : '10';
        params.append('per_page', perPageVal);
        params.append('page', page);
        params.append('ajax', '1');

        // Update browser URL without reloading
        const urlParams = new URLSearchParams(params);
        urlParams.delete('ajax');
        const newUrl = productsEndpoint + (urlParams.toString() ? '?' + urlParams.toString() : '');
        window.history.replaceState({}, '', newUrl);

        fetch(productsEndpoint + '?' + params.toString(), {
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
                        ? `Showing <strong>${data.from}</strong> to <strong>${data.to}</strong> of <strong>${data.total}</strong> items`
                        : 'No products found';
                }
                if (countBadge) countBadge.textContent = data.total + ' items found';
            }
        })
        .catch(err => {
            console.error('Error fetching products:', err);
        })
        .finally(() => {
            if (tableOverlay) {
                tableOverlay.classList.add('d-none');
                tableOverlay.classList.remove('d-flex');
            }
        });
    }

    // Debounced Search Input
    if (filterQ) {
        filterQ.addEventListener('input', function() {
            if (clearSearchBtn) {
                clearSearchBtn.classList.toggle('d-none', !this.value.trim());
            }
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                fetchProducts(1);
            }, 300);
        });
    }

    // Clear Search Button
    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', function() {
            if (filterQ) {
                filterQ.value = '';
                filterQ.focus();
            }
            clearSearchBtn.classList.add('d-none');
            fetchProducts(1);
        });
    }

    // Filter Selects Change Listeners
    [filterCategory, filterBrand, filterStatus, filterBadge, filterPerPage].forEach(el => {
        if (el) {
            el.addEventListener('change', function() {
                fetchProducts(1);
            });
        }
    });

    // Reset Filters Button
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', function() {
            if (filterQ) filterQ.value = '';
            if (clearSearchBtn) clearSearchBtn.classList.add('d-none');
            if (filterCategory) filterCategory.value = '0';
            if (filterBrand) filterBrand.value = '0';
            if (filterStatus) filterStatus.value = '';
            if (filterBadge) filterBadge.value = '';
            if (filterPerPage) filterPerPage.value = '10';
            fetchProducts(1);
        });
    }

    // Reset Button inside Empty State Table
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'resetProductFiltersBtn') {
            if (resetFiltersBtn) resetFiltersBtn.click();
        }
    });

    // Prevent default form submit on Enter, trigger AJAX instead
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetchProducts(1);
        });
    }

    // Pagination Link Clicks via Event Delegation
    if (paginationBox) {
        paginationBox.addEventListener('click', function(e) {
            const link = e.target.closest('.page-link');
            if (link && link.dataset.page) {
                e.preventDefault();
                const targetPage = parseInt(link.dataset.page, 10);
                if (targetPage > 0) {
                    fetchProducts(targetPage);
                }
            }
        });
    }

    // 1. ADD IMAGE PREVIEW
    const addImgInput = document.getElementById('add_prod_image');
    const addPreviewBox = document.getElementById('add_image_preview_box');
    const addPreviewImg = document.getElementById('add_image_preview_img');

    if (addImgInput) {
        addImgInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    addPreviewImg.src = e.target.result;
                    addPreviewBox.classList.remove('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // 2. EDIT IMAGE PREVIEW
    const editImgInput = document.getElementById('edit_prod_image');
    const editCurrentImg = document.getElementById('edit_current_img');

    if (editImgInput) {
        editImgInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    editCurrentImg.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // 3. EDIT PRODUCT MODAL POPULATION (Using Event Delegation so works across AJAX loads)
    const editModalEl = document.getElementById('editProductModal');
    const editModal = editModalEl ? new bootstrap.Modal(editModalEl) : null;
    const editForm = document.getElementById('editProductForm');

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-edit-product');
        if (!btn) return;

        const tr = btn.closest('.product-row');
        if (!tr) return;

        const id = tr.dataset.id;
        const name = tr.dataset.name || '';
        const brandId = tr.dataset.brandId || '';
        const categoryId = tr.dataset.categoryId || '';
        const shortDesc = tr.dataset.shortDesc || '';
        const badge = tr.dataset.badge || 'none';
        const status = tr.dataset.status || 'active';
        const image = tr.dataset.image || '';

        // Populate form
        if (editForm) {
            editForm.action = baseUrl + 'admin/products/edit/' + id;
            document.getElementById('edit_prod_id').value = id;
            document.getElementById('edit_prod_name').value = name;
            document.getElementById('edit_prod_brand').value = brandId;
            document.getElementById('edit_prod_category').value = categoryId;
            document.getElementById('edit_prod_short_desc').value = shortDesc;
            document.getElementById('edit_prod_badge').value = badge;
            document.getElementById('edit_prod_status').value = status;
            document.getElementById('edit_current_img').src = image;

            // Reset file input
            if (editImgInput) editImgInput.value = '';

            if (editModal) editModal.show();
        }
    });
});
</script>
