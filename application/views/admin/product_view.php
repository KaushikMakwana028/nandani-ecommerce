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


    <!-- Server-Side Search Box -->
    <div class="prod-search-card">
        <form method="GET" action="<?= base_url('admin/products') ?>" class="row g-2 align-items-center">
            <div class="col-md-9 col-lg-10">
                <div class="search-input-group">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" class="form-control" name="q" value="<?= htmlspecialchars($search_query) ?>" placeholder="Search products by name (server-side query)...">
                </div>
            </div>
            <div class="col-md-3 col-lg-2 d-flex gap-2">
                <button type="submit" class="btn btn-dark w-100 py-2" style="font-weight: 600;">
                    <i class="fa-solid fa-search me-1"></i> Search
                </button>
                <?php if (!empty($search_query)): ?>
                    <a href="<?= base_url('admin/products') ?>" class="btn btn-outline-secondary py-2" title="Clear Search">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>
        <?php if (!empty($search_query)): ?>
            <div class="mt-2 text-muted small">
                Showing results for <strong>"<?= htmlspecialchars($search_query) ?>"</strong> &bull; <?= count($products) ?> matching product(s) found.
            </div>
        <?php endif; ?>
    </div>

    <!-- Main Products Table Card -->
    <div class="prod-card mb-4">
        <div class="prod-card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-box-open text-muted"></i>
                <h5 class="mb-0 fw-bold text-dark fs-6">Products Directory</h5>
            </div>
            <span class="text-muted small"><?= count($products) ?> items shown</span>
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
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $p): ?>
                            <?php $img_url = base_url('uploads/products/' . $p->image); ?>
                            <tr class="product-row"
                                data-id="<?= $p->id ?>"
                                data-name="<?= htmlspecialchars($p->name, ENT_QUOTES, 'UTF-8') ?>"
                                data-brand-id="<?= $p->brand_id ?>"
                                data-category-id="<?= $p->category_id ?>"
                                data-short-desc="<?= htmlspecialchars($p->short_description ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-badge="<?= $p->badge ?>"
                                data-status="<?= $p->status ?>"
                                data-image="<?= $img_url ?>">
                                
                                <!-- Image Thumbnail -->
                                <td>
                                    <div class="prod-thumb-wrapper" title="<?= htmlspecialchars($p->name) ?>">
                                        <img src="<?= $img_url ?>" alt="<?= htmlspecialchars($p->name) ?>" class="prod-thumb-img" onerror="this.src='https://via.placeholder.com/70x70?text=Product';">
                                    </div>
                                </td>

                                <!-- Product Details -->
                                <td>
                                    <div class="fw-bold text-dark fs-6 mb-1"><?= htmlspecialchars($p->name) ?></div>
                                    <?php if (!empty($p->short_description)): ?>
                                        <div class="text-muted small text-truncate" style="max-width: 320px;">
                                            <?= htmlspecialchars($p->short_description) ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted fst-italic small">No description provided</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Brand Joined -->
                                <td>
                                    <?php if (!empty($p->brand_name)): ?>
                                        <span class="brand-pill">
                                            <i class="fa-solid fa-tag text-muted"></i>
                                            <?= htmlspecialchars($p->brand_name) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-danger small fst-italic">Brand unlinked</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Category Joined -->
                                <td>
                                    <?php if (!empty($p->category_name)): ?>
                                        <span class="cat-pill">
                                            <i class="fa-solid fa-layer-group text-primary"></i>
                                            <?= htmlspecialchars($p->category_name) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-danger small fst-italic">Category unlinked</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Badge Pill -->
                                <td>
                                    <?php if ($p->badge === 'bestseller'): ?>
                                        <span class="badge-pill-custom bestseller">
                                            <i class="fa-solid fa-fire text-warning"></i> Bestseller
                                        </span>
                                    <?php elseif ($p->badge === 'new'): ?>
                                        <span class="badge-pill-custom new">
                                            <i class="fa-solid fa-bolt text-danger"></i> New
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted small">&mdash;</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Status -->
                                <td>
                                    <a href="<?= base_url('admin/products/toggle-status/' . $p->id) ?>" 
                                       class="status-pill <?= $p->status ?>" 
                                       title="Click to toggle status">
                                        <span class="status-pill-dot"></span>
                                        <span><?= ucfirst($p->status) ?></span>
                                    </a>
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="action-btn btn-edit-product" title="Edit Product">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <a href="<?= base_url('admin/products/delete/' . $p->id) ?>" 
                                           class="action-btn btn-delete" 
                                           title="Delete Product"
                                           data-confirm-delete="true"
                                           data-item-name="<?= htmlspecialchars($p->name, ENT_QUOTES, 'UTF-8') ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4">
                                    <i class="fa-solid fa-box-open fa-3x text-muted opacity-50 mb-3"></i>
                                    <h6 class="fw-bold text-dark mb-1">No Products Found</h6>
                                    <p class="text-muted small mb-3">
                                        <?= !empty($search_query) ? 'No products match your search query "' . htmlspecialchars($search_query) . '".' : 'Start by creating your first product item in the catalog.' ?>
                                    </p>
                                    <?php if (!empty($search_query)): ?>
                                        <a href="<?= base_url('admin/products') ?>" class="btn btn-outline-secondary btn-sm px-3">
                                            Clear Search Filter
                                        </a>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addProductModal" style="background-color: var(--primary-red); border-color: var(--primary-red);">
                                            <i class="fa-solid fa-plus me-1"></i> Add First Product
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const baseUrl = '<?= base_url() ?>';

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

    // 3. EDIT PRODUCT MODAL POPULATION
    const editModalEl = document.getElementById('editProductModal');
    const editModal = editModalEl ? new bootstrap.Modal(editModalEl) : null;
    const editForm = document.getElementById('editProductForm');

    document.querySelectorAll('.btn-edit-product').forEach(btn => {
        btn.addEventListener('click', function() {
            const tr = this.closest('.product-row');
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

            editModal.show();
        });
    });
});
</script>
