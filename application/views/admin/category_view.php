<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Specific Styles Scoped Inside Page -->
<style>
    .cat-header {
        margin-bottom: 1.5rem;
    }

    .cat-title {
        font-family: var(--font-heading);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    /* Tabs Styling */
    .cat-nav-tabs {
        border-bottom: 2px solid var(--border-color);
        gap: 8px;
    }

    .cat-nav-tabs .nav-link {
        font-size: 0.95rem;
        font-weight: 600;
        color: #6B7280;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 12px 20px;
        background: transparent;
        border-radius: 0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .cat-nav-tabs .nav-link:hover {
        color: var(--dark-text);
        border-color: #D1D5DB;
    }

    .cat-nav-tabs .nav-link.active {
        color: var(--primary-red);
        border-bottom-color: var(--primary-red);
        background: transparent;
    }

    .cat-nav-tabs .badge-count {
        font-size: 0.72rem;
        padding: 3px 8px;
        border-radius: 12px;
        background-color: #E5E7EB;
        color: #374151;
        font-weight: 600;
    }

    .cat-nav-tabs .nav-link.active .badge-count {
        background-color: rgba(200, 16, 46, 0.12);
        color: var(--primary-red);
    }

    /* Main Table Card */
    .cat-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .cat-card-header {
        padding: 1.25rem 1.5rem;
        background-color: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    .table-categories {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table-categories thead th {
        background-color: #FAFAFA;
        color: #4B5563;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        font-weight: 600;
        border-bottom: 1px solid var(--border-color);
        padding: 13px 18px;
        white-space: nowrap;
    }

    .table-categories tbody td {
        padding: 14px 18px;
        font-size: 0.9rem;
        border-bottom: 1px solid #F3F4F6;
    }

    .table-categories tbody tr:last-child td {
        border-bottom: none;
    }

    .table-categories tbody tr:hover td {
        background-color: #FAFCFE;
    }

    /* Image Thumbnail */
    .cat-thumbnail {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--border-color);
        background-color: #F9FAFB;
    }

    .cat-thumbnail-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        border: 1px dashed #D1D5DB;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9CA3AF;
        font-size: 1.1rem;
        background-color: #F9FAFB;
    }

    /* Icon Box */
    .cat-icon-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #F8F9FA;
        color: #1F2937;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 500;
        border: 1px solid var(--border-color);
    }

    .cat-icon-badge i {
        color: var(--primary-red);
        font-size: 0.95rem;
    }

    /* Status Pill: Active = Green, Inactive = Grey */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        font-size: 0.76rem;
        padding: 4px 12px;
        border-radius: 20px;
        text-transform: capitalize;
    }

    .status-pill.status-active {
        background-color: #DCFCE7;
        color: #15803D;
    }

    .status-pill.status-inactive {
        background-color: #F3F4F6;
        color: #6B7280;
    }

    /* Action Buttons */
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
        transition: all 0.2s ease;
        border: 1px solid var(--border-color);
        background: #FFFFFF;
        color: #4B5563;
        text-decoration: none;
        cursor: pointer;
    }

    .action-btn:hover {
        background-color: #F9FAFB;
        color: var(--dark-text);
        border-color: #D1D5DB;
    }

    .action-btn.btn-delete:hover {
        background-color: #FEE2E2;
        color: var(--primary-red);
        border-color: #FECACA;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 14px;
        border: 1px solid var(--border-color);
    }

    .modal-header {
        border-bottom: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
    }

    .modal-title {
        font-family: var(--font-heading);
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--dark-text);
    }

    .form-label {
        font-size: 0.84rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.4rem;
    }

    .form-control, .form-select {
        font-size: 0.88rem;
        border-color: #D1D5DB;
        padding: 9px 12px;
        border-radius: 8px;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.15);
    }

    /* Icon Picker Widget Styles */
    .icon-picker-widget {
        position: relative;
    }

    .icon-preview-box {
        width: 46px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--primary-red);
        background-color: #F9FAFB;
        border-color: #D1D5DB;
        transition: all 0.2s ease;
    }

    .icon-preview-box.is-valid-icon {
        border-color: #10B981 !important;
        background-color: #ECFDF5 !important;
        color: var(--primary-red) !important;
    }

    .icon-preview-box.is-invalid-icon {
        border-color: #F59E0B !important;
        background-color: #FFFBEB !important;
        color: #D97706 !important;
    }

    .icon-suggestions-panel {
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        background: #FFFFFF;
        border: 1px solid #D1D5DB;
        border-radius: 12px;
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.14);
        z-index: 1065;
        max-height: 340px;
        overflow-y: auto;
    }

    .icon-suggestion-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 9px 14px;
        cursor: pointer;
        border-bottom: 1px solid #F3F4F6;
        transition: background-color 0.15s ease;
    }

    .icon-suggestion-item:last-child {
        border-bottom: none;
    }

    .icon-suggestion-item:hover {
        background-color: rgba(200, 16, 46, 0.05);
    }

    .icon-suggestion-item.top-pick {
        background-color: #FFF1F2;
    }

    .item-icon-box {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background-color: #F3F4F6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        color: var(--primary-red);
        flex-shrink: 0;
    }

    .icon-suggestion-item:hover .item-icon-box {
        background-color: var(--primary-red);
        color: #FFFFFF;
    }

    .item-name {
        font-size: 0.85rem;
        font-family: monospace;
        color: var(--dark-text);
    }

    .icon-quick-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        align-items: center;
    }

    .btn-quick-icon {
        border: 1px solid #E5E7EB;
        background-color: #FFFFFF;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 0.77rem;
        font-weight: 500;
        color: #374151;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        transition: all 0.18s ease;
    }

    .btn-quick-icon:hover {
        border-color: var(--primary-red);
        background-color: rgba(200, 16, 46, 0.06);
        color: var(--primary-red);
        transform: translateY(-1px);
    }

    .btn-browse-icons {
        font-size: 0.82rem;
        font-weight: 500;
    }

    /* Modal Live Icon Preview */
    .modal-icon-preview {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        background-color: #F3F4F6;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--primary-red);
        flex-shrink: 0;
    }

    .modal-thumb-preview {
        width: 54px;
        height: 54px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--border-color);
    }

    /* Icon Browser Modal Grid */
    .icon-grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 10px;
        max-height: 420px;
        overflow-y: auto;
        padding: 4px;
    }

    .icon-browser-card {
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        padding: 14px 8px;
        text-align: center;
        cursor: pointer;
        background-color: #FFFFFF;
        transition: all 0.18s ease;
    }

    .icon-browser-card:hover {
        border-color: var(--primary-red);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(200, 16, 46, 0.12);
    }

    .icon-browser-card .card-icon {
        font-size: 1.6rem;
        color: #4B5563;
        margin-bottom: 6px;
    }

    .icon-browser-card:hover .card-icon {
        color: var(--primary-red);
    }

    .icon-browser-card .card-title {
        font-size: 0.74rem;
        font-weight: 600;
        color: #1F2937;
    }

    .icon-browser-card .card-code {
        font-size: 0.67rem;
        color: #6B7280;
        font-family: monospace;
    }
</style>

<!-- Top Title Bar -->
<div class="cat-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1 class="cat-title">Categories Master</h1>
        <p class="text-muted small mb-0 mt-1">Master classification for Products, Galleries, and Brands. Modules select from here via filtered dropdowns.</p>
    </div>
</div>

<!-- Category Filter Toolbar -->
<div class="admin-filter-card mb-4">
    <form id="categoryFilterForm">
        <!-- Top Tier: Search Input + Per Page & Reset -->
        <div class="row g-2 align-items-center mb-3">
            <div class="col-12 col-lg-8">
                <div class="filter-search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" class="form-control" name="q" id="category_filter_q" value="<?= htmlspecialchars($search_query ?? '') ?>" placeholder="Search category name or description...">
                    <button type="button" class="btn-clear-search <?= empty($search_query) ? 'd-none' : '' ?>" id="clearCategorySearchBtn" aria-label="Clear Search">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                </div>
            </div>

            <div class="col-12 col-lg-4 d-flex align-items-center justify-content-lg-end gap-2">
                <div class="d-flex align-items-center gap-2 flex-grow-1 flex-lg-grow-0">
                    <span class="text-muted small d-none d-sm-inline">Show:</span>
                    <select class="form-select form-select-sm filter-control" name="per_page" id="category_filter_per_page" title="Items per page" style="min-width: 95px;">
                        <option value="10" <?= ($per_page == 10) ? 'selected' : '' ?>>10 / page</option>
                        <option value="25" <?= ($per_page == 25) ? 'selected' : '' ?>>25 / page</option>
                        <option value="50" <?= ($per_page == 50) ? 'selected' : '' ?>>50 / page</option>
                        <option value="100" <?= ($per_page == 100) ? 'selected' : '' ?>>100 / page</option>
                    </select>
                </div>
                <button type="button" class="btn-filter-reset" id="resetCategoryFiltersBtn" title="Reset all filters">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Reset</span>
                </button>
            </div>
        </div>

        <!-- Bottom Tier: Status Filter -->
        <div class="row g-2 pt-2 border-top">
            <div class="col-12 col-sm-6 col-md-4">
                <label class="filter-field-label"><i class="fa-solid fa-toggle-on me-1 opacity-75"></i> Status</label>
                <select class="form-select form-select-sm filter-control" name="status" id="category_filter_status">
                    <option value="">All Statuses</option>
                    <option value="active" <?= ($selected_status === 'active') ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= ($selected_status === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>
    </form>
</div>


<!-- Tabs Navigation: Product Categories / Gallery Categories / Brand Categories -->
<ul class="nav cat-nav-tabs mb-4" id="categoryTabs" role="tablist">
    <!-- Tab 1: Product Categories -->
    <li class="nav-item" role="presentation">
        <button class="nav-link <?= ($active_tab === 'product') ? 'active' : '' ?>" 
                id="product-tab" 
                data-bs-toggle="tab" 
                data-bs-target="#productTabPane" 
                type="button" 
                role="tab" 
                data-tab-type="product"
                aria-controls="productTabPane" 
                aria-selected="<?= ($active_tab === 'product') ? 'true' : 'false' ?>">
            <i class="fa-solid fa-box-open"></i>
            <span>Product Categories</span>
            <span class="badge-count" id="productCountBadge"><?= $product_count ?></span>
        </button>
    </li>

    <!-- Tab 2: Gallery Categories -->
    <li class="nav-item" role="presentation">
        <button class="nav-link <?= ($active_tab === 'gallery') ? 'active' : '' ?>" 
                id="gallery-tab" 
                data-bs-toggle="tab" 
                data-bs-target="#galleryTabPane" 
                type="button" 
                role="tab" 
                data-tab-type="gallery"
                aria-controls="galleryTabPane" 
                aria-selected="<?= ($active_tab === 'gallery') ? 'true' : 'false' ?>">
            <i class="fa-solid fa-images"></i>
            <span>Gallery Categories</span>
            <span class="badge-count" id="galleryCountBadge"><?= $gallery_count ?></span>
        </button>
    </li>

    <!-- Tab 3: Brand Categories -->
    <li class="nav-item" role="presentation">
        <button class="nav-link <?= ($active_tab === 'brand') ? 'active' : '' ?>" 
                id="brand-tab" 
                data-bs-toggle="tab" 
                data-bs-target="#brandTabPane" 
                type="button" 
                role="tab" 
                data-tab-type="brand"
                aria-controls="brandTabPane" 
                aria-selected="<?= ($active_tab === 'brand') ? 'true' : 'false' ?>">
            <i class="fa-solid fa-tags"></i>
            <span>Brand Categories</span>
            <span class="badge-count" id="brandCountBadge"><?= $brand_count ?></span>
        </button>
    </li>
</ul>

<!-- Tabs Content Wrapper with Loading Overlay -->
<div class="position-relative mb-4">
    <!-- Shared Loading Overlay -->
    <div id="categoryTableOverlay" class="position-absolute w-100 h-100 top-0 start-0 d-none justify-content-center align-items-center" style="background: rgba(255,255,255,0.7); z-index: 10; backdrop-filter: blur(1px); border-radius: 14px; min-height: 200px;">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading categories...</span>
        </div>
    </div>

    <div class="tab-content" id="categoryTabsContent">
        
        <!-- ==================== TAB 1: PRODUCT CATEGORIES ==================== -->
        <div class="tab-pane fade <?= ($active_tab === 'product') ? 'show active' : '' ?>" id="productTabPane" role="tabpanel" aria-labelledby="product-tab">
            <div class="cat-card">
                <div class="cat-card-header d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Product Categories</h5>
                        <small class="text-muted">Classification for Gas Stoves, Appliances, and Equipment</small>
                    </div>
                    <button type="button" class="btn btn-primary-red d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addProductCategoryModal">
                        <i class="fa-solid fa-plus me-2"></i>
                        <span>Add Product Category</span>
                    </button>
                </div>

                <!-- Product Categories Table -->
                <div class="table-responsive">
                    <table class="table table-categories">
                        <thead>
                            <tr>
                                <th style="width: 70px;">Image</th>
                                <th>Name</th>
                                <th>Icon</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 100px;">Sort Order</th>
                                <th style="width: 110px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productCategoryTableBody">
                            <?= $this->load->view('admin/partials/category_table_rows', [
                                'categories'   => $product_categories,
                                'type'         => 'product',
                                'search_query' => $search_query ?? ''
                            ], TRUE) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB 2: GALLERY CATEGORIES ==================== -->
        <div class="tab-pane fade <?= ($active_tab === 'gallery') ? 'show active' : '' ?>" id="galleryTabPane" role="tabpanel" aria-labelledby="gallery-tab">
            <div class="cat-card">
                <div class="cat-card-header d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Gallery Categories</h5>
                        <small class="text-muted">Classification for Events, Exhibitions, and Corporate Media</small>
                    </div>
                    <button type="button" class="btn btn-primary-red d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addGalleryCategoryModal">
                        <i class="fa-solid fa-plus me-2"></i>
                        <span>Add Gallery Category</span>
                    </button>
                </div>

                <!-- Gallery Categories Table -->
                <div class="table-responsive">
                    <table class="table table-categories">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th style="width: 140px;">Status</th>
                                <th style="width: 120px;">Sort Order</th>
                                <th style="width: 110px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="galleryCategoryTableBody">
                            <?= $this->load->view('admin/partials/category_table_rows', [
                                'categories'   => $gallery_categories,
                                'type'         => 'gallery',
                                'search_query' => $search_query ?? ''
                            ], TRUE) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB 3: BRAND CATEGORIES ==================== -->
        <div class="tab-pane fade <?= ($active_tab === 'brand') ? 'show active' : '' ?>" id="brandTabPane" role="tabpanel" aria-labelledby="brand-tab">
            <div class="cat-card">
                <div class="cat-card-header d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Brand Categories</h5>
                        <small class="text-muted">Classification and taxonomy for associated Brands</small>
                    </div>
                    <button type="button" class="btn btn-primary-red d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addBrandCategoryModal">
                        <i class="fa-solid fa-plus me-2"></i>
                        <span>Add Brand Category</span>
                    </button>
                </div>

                <!-- Brand Categories Table -->
                <div class="table-responsive">
                    <table class="table table-categories">
                        <thead>
                            <tr>
                                <th style="width: 70px;">Logo/Image</th>
                                <th>Brand Category Name</th>
                                <th>Icon</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 100px;">Sort Order</th>
                                <th style="width: 110px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="brandCategoryTableBody">
                            <?= $this->load->view('admin/partials/category_table_rows', [
                                'categories'   => $brand_categories,
                                'type'         => 'brand',
                                'search_query' => $search_query ?? ''
                            ], TRUE) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Pagination & Entries Bar -->
<div class="pagination-footer-bar rounded-3 border mb-4">
    <div class="pagination-entries-text" id="categoryEntriesText">
        Showing <strong><?= $from_entry ?></strong> to <strong><?= $to_entry ?></strong> of <strong><?= $total_filtered ?></strong> items
    </div>
    <div id="categoryPaginationContainer">
        <?= $pagination_html ?>
    </div>
</div>


<!-- ==================== MODAL: ADD PRODUCT CATEGORY ==================== -->
<div class="modal fade" id="addProductCategoryModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <?= form_open_multipart('admin/category/add', ['id' => 'addProductCatForm', 'novalidate' => 'novalidate']) ?>
                <input type="hidden" name="type" value="product">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="prod_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prod_name" name="name" placeholder="e.g. Gas Stove" required>
                        <div class="invalid-feedback">Category name is required.</div>
                    </div>

                    <div class="mb-3">
                        <label for="prod_icon" class="form-label d-flex align-items-center justify-content-between">
                            <span>Icon Class (FontAwesome)</span>
                            <span class="badge bg-light text-muted border font-monospace" style="font-size: 0.72rem;">Optional</span>
                        </label>
                        <div class="icon-picker-widget" data-widget="prod_icon">
                            <div class="input-group">
                                <span class="input-group-text icon-preview-box" id="prod_icon_preview_box" title="Live Icon Preview">
                                    <i class="fa-solid fa-icons" id="prod_icon_preview"></i>
                                </span>
                                <input type="text" class="form-control font-monospace icon-picker-input" id="prod_icon" name="icon" placeholder="Type keyword (e.g. mixer, stove, fan) or icon class..." autocomplete="off">
                                <button type="button" class="btn btn-outline-secondary btn-clear-icon d-none" title="Clear icon">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-browse-icons" title="Browse full icon library">
                                    <i class="fa-solid fa-compass me-1"></i> Browse
                                </button>
                            </div>

                            <!-- Real-time Autocomplete & Smart Suggestions Dropdown -->
                            <div class="icon-suggestions-panel d-none" id="prod_icon_suggestions"></div>

                            <!-- Quick Pick Chips for Product Categories -->
                            <div class="icon-quick-chips mt-2">
                                <span class="text-muted small me-1">Quick pick:</span>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-fire" title="Gas Stove"><i class="fa-solid fa-fire text-danger"></i> Gas Stove</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-fire-burner" title="Burner / Cooktop"><i class="fa-solid fa-fire-burner text-danger"></i> Burner</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-blender" title="Mixer / Blender"><i class="fa-solid fa-blender text-danger"></i> Mixer</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-kitchen-set" title="Kitchen Appliances"><i class="fa-solid fa-kitchen-set text-danger"></i> Kitchen</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-utensils" title="Utensils"><i class="fa-solid fa-utensils text-danger"></i> Utensils</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-plug" title="Electrical Appliance"><i class="fa-solid fa-plug text-danger"></i> Appliance</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-fan" title="Cooling Fan"><i class="fa-solid fa-fan text-danger"></i> Fan</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="prod_image" class="form-label">Image Thumbnail</label>
                        <input type="file" class="form-control" id="prod_image" name="image" accept="image/png, image/jpeg, image/jpg, image/webp">
                        <div class="form-text text-muted small">Recommended square image (max 2MB).</div>
                    </div>

                    <div class="mb-3">
                        <label for="prod_desc" class="form-label">Short Description</label>
                        <textarea class="form-control" id="prod_desc" name="short_description" rows="2" placeholder="Brief summary of this product category"></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label for="prod_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="prod_status" name="status" required>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="prod_sort" class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="prod_sort" name="sort_order" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-red">Save Category</button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- ==================== MODAL: ADD GALLERY CATEGORY ==================== -->
<div class="modal fade" id="addGalleryCategoryModal" tabindex="-1" aria-labelledby="addGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <?= form_open('admin/category/add', ['id' => 'addGalleryCatForm', 'novalidate' => 'novalidate']) ?>
                <input type="hidden" name="type" value="gallery">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="addGalleryModalLabel">Add Gallery Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="gal_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="gal_name" name="name" placeholder="e.g. Exhibitions" required>
                        <div class="invalid-feedback">Category name is required.</div>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label for="gal_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="gal_status" name="status" required>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="gal_sort" class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="gal_sort" name="sort_order" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-red">Save Category</button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- ==================== MODAL: ADD BRAND CATEGORY ==================== -->
<div class="modal fade" id="addBrandCategoryModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <?= form_open_multipart('admin/category/add', ['id' => 'addBrandCatForm', 'novalidate' => 'novalidate']) ?>
                <input type="hidden" name="type" value="brand">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Add Brand Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="brand_name" name="name" placeholder="e.g. Domestic Appliances" required>
                        <div class="invalid-feedback">Brand category name is required.</div>
                    </div>

                    <div class="mb-3">
                        <label for="brand_icon" class="form-label d-flex align-items-center justify-content-between">
                            <span>Icon Class (FontAwesome)</span>
                            <span class="badge bg-light text-muted border font-monospace" style="font-size: 0.72rem;">Optional</span>
                        </label>
                        <div class="icon-picker-widget" data-widget="brand_icon">
                            <div class="input-group">
                                <span class="input-group-text icon-preview-box" id="brand_icon_preview_box" title="Live Icon Preview">
                                    <i class="fa-solid fa-icons" id="brand_icon_preview"></i>
                                </span>
                                <input type="text" class="form-control font-monospace icon-picker-input" id="brand_icon" name="icon" placeholder="Type keyword (e.g. brand, award, tag) or icon class..." autocomplete="off">
                                <button type="button" class="btn btn-outline-secondary btn-clear-icon d-none" title="Clear icon">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-browse-icons" title="Browse full icon library">
                                    <i class="fa-solid fa-compass me-1"></i> Browse
                                </button>
                            </div>

                            <!-- Real-time Autocomplete & Smart Suggestions Dropdown -->
                            <div class="icon-suggestions-panel d-none" id="brand_icon_suggestions"></div>

                            <!-- Quick Pick Chips for Brand Categories -->
                            <div class="icon-quick-chips mt-2">
                                <span class="text-muted small me-1">Quick pick:</span>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-tag" title="Tag"><i class="fa-solid fa-tag text-danger"></i> Tag</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-tags" title="Tags"><i class="fa-solid fa-tags text-danger"></i> Tags</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-award" title="Award"><i class="fa-solid fa-award text-danger"></i> Award</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-crown" title="Crown"><i class="fa-solid fa-crown text-danger"></i> Crown</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-star" title="Star"><i class="fa-solid fa-star text-danger"></i> Star</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-certificate" title="Certified"><i class="fa-solid fa-certificate text-danger"></i> Certified</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-gem" title="Luxury"><i class="fa-solid fa-gem text-danger"></i> Luxury</button>
                                <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-shield-halved" title="Warranty"><i class="fa-solid fa-shield-halved text-danger"></i> Warranty</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="brand_image" class="form-label">Logo / Image</label>
                        <input type="file" class="form-control" id="brand_image" name="image" accept="image/png, image/jpeg, image/jpg, image/webp">
                        <div class="form-text text-muted small">Recommended square image/logo (max 2MB).</div>
                    </div>

                    <div class="mb-3">
                        <label for="brand_desc" class="form-label">Short Description</label>
                        <textarea class="form-control" id="brand_desc" name="short_description" rows="2" placeholder="Brief summary of this brand category"></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label for="brand_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="brand_status" name="status" required>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="brand_sort" class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="brand_sort" name="sort_order" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-red">Save Category</button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- ==================== MODAL: EDIT CATEGORY (UNIVERSAL IN-PLACE MODAL) ==================== -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="id" id="edit_cat_id" value="">
                <input type="hidden" name="type" id="edit_cat_type" value="">
                
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <span class="badge bg-light text-dark border text-uppercase" id="edit_cat_badge">Type</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="edit_cat_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_cat_name" name="name" required>
                        <div class="invalid-feedback">Category name is required.</div>
                    </div>

                    <!-- Dynamic Section for Product & Brand only -->
                    <div id="editProdBrandSection">
                        <!-- Icon Class with Live Preview -->
                        <div class="mb-3">
                            <label for="edit_cat_icon" class="form-label d-flex align-items-center justify-content-between">
                                <span>Icon Class (FontAwesome)</span>
                                <span class="badge bg-light text-muted border font-monospace" style="font-size: 0.72rem;">Optional</span>
                            </label>
                            <div class="icon-picker-widget" data-widget="edit_cat_icon">
                                <div class="input-group">
                                    <span class="input-group-text icon-preview-box" id="edit_icon_preview_box" title="Live Icon Preview">
                                        <i class="fa-solid fa-icons" id="editIconPreview"></i>
                                    </span>
                                    <input type="text" class="form-control font-monospace icon-picker-input" id="edit_cat_icon" name="icon" placeholder="Type keyword (e.g. mixer, stove, fan, tag) or icon class..." autocomplete="off">
                                    <button type="button" class="btn btn-outline-secondary btn-clear-icon d-none" title="Clear icon">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-browse-icons" title="Browse full icon library">
                                        <i class="fa-solid fa-compass me-1"></i> Browse
                                    </button>
                                </div>

                                <!-- Real-time Autocomplete & Smart Suggestions Dropdown -->
                                <div class="icon-suggestions-panel d-none" id="edit_cat_icon_suggestions"></div>

                                <!-- Quick Pick Chips for Edit Modal -->
                                <div class="icon-quick-chips mt-2">
                                    <span class="text-muted small me-1">Quick pick:</span>
                                    <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-fire" title="Gas Stove"><i class="fa-solid fa-fire text-danger"></i> Gas Stove</button>
                                    <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-fire-burner" title="Burner"><i class="fa-solid fa-fire-burner text-danger"></i> Burner</button>
                                    <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-blender" title="Mixer / Blender"><i class="fa-solid fa-blender text-danger"></i> Mixer</button>
                                    <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-kitchen-set" title="Kitchen"><i class="fa-solid fa-kitchen-set text-danger"></i> Kitchen</button>
                                    <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-tag" title="Tag"><i class="fa-solid fa-tag text-danger"></i> Tag</button>
                                    <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-tags" title="Tags"><i class="fa-solid fa-tags text-danger"></i> Tags</button>
                                    <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-crown" title="Crown"><i class="fa-solid fa-crown text-danger"></i> Crown</button>
                                    <button type="button" class="btn-quick-icon" data-icon="fa-solid fa-award" title="Award"><i class="fa-solid fa-award text-danger"></i> Award</button>
                                </div>
                            </div>
                        </div>

                        <!-- Image / Logo with Current Thumbnail Preview -->
                        <div class="mb-3">
                            <label for="edit_cat_image" class="form-label">Category Image / Logo</label>
                            <div id="editCurrentImageBox" class="d-none align-items-center gap-2 mb-2 p-2 bg-light rounded border">
                                <img src="" alt="Thumbnail" class="modal-thumb-preview" id="editCurrentThumb">
                                <div class="small">
                                    <span class="fw-semibold text-dark">Current Image</span>
                                    <div class="text-muted" style="font-size: 0.75rem;">Choose a file below to replace it</div>
                                </div>
                            </div>
                            <input type="file" class="form-control" id="edit_cat_image" name="image" accept="image/png, image/jpeg, image/jpg, image/webp">
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label for="edit_cat_desc" class="form-label">Short Description</label>
                            <textarea class="form-control" id="edit_cat_desc" name="short_description" rows="2" placeholder="Brief summary of category"></textarea>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Status -->
                        <div class="col-6">
                            <label for="edit_cat_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_cat_status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <!-- Sort Order -->
                        <div class="col-6">
                            <label for="edit_cat_sort" class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="edit_cat_sort" name="sort_order" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-red">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tab URL Sync, AJAX Filtering & Dynamic Edit Modal Handler -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const baseUrl = '<?= base_url() ?>';
        let currentTab = '<?= $active_tab ?>';
        let searchTimer = null;

        // Elements
        const filterForm       = document.getElementById('categoryFilterForm');
        const filterQ          = document.getElementById('category_filter_q');
        const clearSearchBtn   = document.getElementById('clearCategorySearchBtn');
        const filterStatus     = document.getElementById('category_filter_status');
        const filterPerPage    = document.getElementById('category_filter_per_page');
        const resetFiltersBtn  = document.getElementById('resetCategoryFiltersBtn');
        const tableOverlay     = document.getElementById('categoryTableOverlay');
        const paginationBox    = document.getElementById('categoryPaginationContainer');
        const entriesText      = document.getElementById('categoryEntriesText');

        // AJAX Fetch Function
        function fetchCategories(page = 1) {
            if (tableOverlay) {
                tableOverlay.classList.remove('d-none');
                tableOverlay.classList.add('d-flex');
            }

            const params = new URLSearchParams();
            params.set('tab', currentTab);
            if (filterQ && filterQ.value.trim() !== '') {
                params.set('q', filterQ.value.trim());
            }
            if (filterStatus && filterStatus.value !== '') {
                params.set('status', filterStatus.value);
            }
            if (filterPerPage && filterPerPage.value !== '') {
                params.set('per_page', filterPerPage.value);
            }
            params.set('page', page);
            params.set('ajax', '1');

            const requestUrl = baseUrl + 'admin/categories?' + params.toString();

            fetch(requestUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    let targetTbody = null;
                    if (currentTab === 'product') {
                        targetTbody = document.getElementById('productCategoryTableBody');
                        const b = document.getElementById('productCountBadge');
                        if (b && !filterQ.value.trim() && !filterStatus.value) b.textContent = data.total;
                    } else if (currentTab === 'gallery') {
                        targetTbody = document.getElementById('galleryCategoryTableBody');
                        const b = document.getElementById('galleryCountBadge');
                        if (b && !filterQ.value.trim() && !filterStatus.value) b.textContent = data.total;
                    } else if (currentTab === 'brand') {
                        targetTbody = document.getElementById('brandCategoryTableBody');
                        const b = document.getElementById('brandCountBadge');
                        if (b && !filterQ.value.trim() && !filterStatus.value) b.textContent = data.total;
                    }

                    if (targetTbody) targetTbody.innerHTML = data.html;
                    if (paginationBox) paginationBox.innerHTML = data.pagination;
                    if (entriesText) {
                        entriesText.innerHTML = (data.total > 0)
                            ? `Showing <strong>${data.from}</strong> to <strong>${data.to}</strong> of <strong>${data.total}</strong> items`
                            : 'No categories found';
                    }
                }
            })
            .catch(err => {
                console.error('Error fetching categories:', err);
            })
            .finally(() => {
                if (tableOverlay) {
                    tableOverlay.classList.add('d-none');
                    tableOverlay.classList.remove('d-flex');
                }
            });
        }

        // Tab switching listener
        const tabButtons = document.querySelectorAll('#categoryTabs button[data-bs-toggle="tab"]');
        tabButtons.forEach(btn => {
            btn.addEventListener('shown.bs.tab', function(e) {
                const targetId = e.target.getAttribute('data-bs-target');
                if (targetId === '#galleryTabPane') {
                    currentTab = 'gallery';
                } else if (targetId === '#brandTabPane') {
                    currentTab = 'brand';
                } else {
                    currentTab = 'product';
                }

                const url = new URL(window.location);
                url.searchParams.set('tab', currentTab);
                window.history.replaceState({}, '', url);

                // Fetch new tab data
                fetchCategories(1);
            });
        });

        // Search input debounce
        if (filterQ) {
            filterQ.addEventListener('input', function() {
                if (clearSearchBtn) {
                    clearSearchBtn.classList.toggle('d-none', !this.value.trim());
                }
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => {
                    fetchCategories(1);
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
                fetchCategories(1);
            });
        }

        // Filters select change
        [filterStatus, filterPerPage].forEach(el => {
            if (el) {
                el.addEventListener('change', function() {
                    fetchCategories(1);
                });
            }
        });

        // Reset button
        function resetFilters() {
            if (filterQ) filterQ.value = '';
            if (clearSearchBtn) clearSearchBtn.classList.add('d-none');
            if (filterStatus) filterStatus.value = '';
            if (filterPerPage) filterPerPage.value = '10';
            fetchCategories(1);
        }

        if (resetFiltersBtn) {
            resetFiltersBtn.addEventListener('click', resetFilters);
        }

        if (filterForm) {
            filterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                fetchCategories(1);
            });
        }

        // Pagination Click Delegation
        if (paginationBox) {
            paginationBox.addEventListener('click', function(e) {
                const link = e.target.closest('.page-link');
                if (link && link.dataset.page) {
                    e.preventDefault();
                    const targetPage = parseInt(link.dataset.page, 10);
                    if (targetPage > 0) {
                        fetchCategories(targetPage);
                    }
                }
            });
        }

        // Edit Modal Dynamic Handler (Event Delegation for AJAX rows)
        const editModalEl          = document.getElementById('editCategoryModal');
        const editModal            = editModalEl ? new bootstrap.Modal(editModalEl) : null;
        const editForm             = document.getElementById('editCategoryForm');
        const editIdInput          = document.getElementById('edit_cat_id');
        const editTypeInput        = document.getElementById('edit_cat_type');
        const editNameInput        = document.getElementById('edit_cat_name');
        const editIconInput        = document.getElementById('edit_cat_icon');
        const editIconPreview      = document.getElementById('editIconPreview');
        const editDescInput        = document.getElementById('edit_cat_desc');
        const editStatusSelect     = document.getElementById('edit_cat_status');
        const editSortInput        = document.getElementById('edit_cat_sort');
        const editBadge            = document.getElementById('edit_cat_badge');
        const editProdBrandSection = document.getElementById('editProdBrandSection');
        const editCurrentImageBox  = document.getElementById('editCurrentImageBox');
        const editCurrentThumb     = document.getElementById('editCurrentThumb');
        const editFileInput        = document.getElementById('edit_cat_image');

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-edit-category');
            if (!btn) return;

            const id     = btn.getAttribute('data-id');
            const name   = btn.getAttribute('data-name') || '';
            const type   = btn.getAttribute('data-type') || 'product';
            const icon   = btn.getAttribute('data-icon') || '';
            const image  = btn.getAttribute('data-image') || '';
            const desc   = btn.getAttribute('data-short_description') || '';
            const status = btn.getAttribute('data-status') || 'active';
            const sort   = btn.getAttribute('data-sort_order') || '0';

            // Set form action
            if (editForm) {
                editForm.action = baseUrl + 'admin/category/edit/' + id;
                editIdInput.value = id;
                editTypeInput.value = type;
                editNameInput.value = name;
                editNameInput.classList.remove('is-invalid');
                editStatusSelect.value = status;
                editSortInput.value = sort;

                // Update badge and title
                if (editBadge) editBadge.textContent = type.toUpperCase();
                const modalTitle = document.getElementById('editCategoryModalLabel');
                if (modalTitle) modalTitle.textContent = 'Edit ' + type.charAt(0).toUpperCase() + type.slice(1) + ' Category';

                // Reset file input
                if (editFileInput) editFileInput.value = '';

                // Show/hide relevant fields based on type
                if (type === 'gallery') {
                    if (editProdBrandSection) editProdBrandSection.style.display = 'none';
                } else {
                    if (editProdBrandSection) {
                        editProdBrandSection.style.display = 'block';
                        editIconInput.value = icon;
                        editIconInput.dispatchEvent(new Event('input'));
                        editDescInput.value = desc;

                        // Image preview
                        if (image) {
                            editCurrentThumb.src = image;
                            editCurrentImageBox.classList.remove('d-none');
                            editCurrentImageBox.classList.add('d-flex');
                        } else {
                            editCurrentImageBox.classList.add('d-none');
                            editCurrentImageBox.classList.remove('d-flex');
                        }
                    }
                }

                if (editModal) editModal.show();
            }
        });

        // Edit form validation
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                if (!editNameInput.value.trim()) {
                    e.preventDefault();
                    editNameInput.classList.add('is-invalid');
                } else {
                    editNameInput.classList.remove('is-invalid');
                }
            });
        }
    });
</script>

<!-- Font Awesome Icon Picker & Suggestions Script -->
<script src="<?= base_url('assets/js/admin-icon-picker.js') ?>"></script>
