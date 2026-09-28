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
        gap: 6px;
        background-color: #F3F4F6;
        color: var(--dark-text);
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
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
</style>

<!-- Top Title Bar -->
<div class="cat-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1 class="cat-title">Categories Master</h1>
        <p class="text-muted small mb-0 mt-1">Master classification for Products, Galleries, and Brands. Modules select from here via filtered dropdowns.</p>
    </div>
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
                aria-controls="productTabPane" 
                aria-selected="<?= ($active_tab === 'product') ? 'true' : 'false' ?>">
            <i class="fa-solid fa-box-open"></i>
            <span>Product Categories</span>
            <span class="badge-count"><?= $product_count ?></span>
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
                aria-controls="galleryTabPane" 
                aria-selected="<?= ($active_tab === 'gallery') ? 'true' : 'false' ?>">
            <i class="fa-solid fa-images"></i>
            <span>Gallery Categories</span>
            <span class="badge-count"><?= $gallery_count ?></span>
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
                aria-controls="brandTabPane" 
                aria-selected="<?= ($active_tab === 'brand') ? 'true' : 'false' ?>">
            <i class="fa-solid fa-tags"></i>
            <span>Brand Categories</span>
            <span class="badge-count"><?= $brand_count ?></span>
        </button>
    </li>
</ul>

<!-- Tabs Content -->
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
                    <tbody>
                        <?php if (!empty($product_categories)): ?>
                            <?php foreach ($product_categories as $cat): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($cat->image) && file_exists(FCPATH . $cat->image)): ?>
                                            <img src="<?= base_url($cat->image) ?>" alt="<?= html_escape($cat->name) ?>" class="cat-thumbnail">
                                        <?php else: ?>
                                            <div class="cat-thumbnail-placeholder">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= html_escape($cat->name) ?></div>
                                        <?php if (!empty($cat->short_description)): ?>
                                            <div class="text-muted small text-truncate" style="max-width: 320px;">
                                                <?= html_escape($cat->short_description) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($cat->icon)): ?>
                                            <div class="cat-icon-badge">
                                                <i class="fa-solid <?= html_escape($cat->icon) ?>"></i>
                                                <span><?= html_escape($cat->icon) ?></span>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted small fst-italic">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($cat->status === 'active'): ?>
                                            <span class="status-pill status-active">
                                                <i class="fa-solid fa-circle-check" style="font-size: 0.65rem;"></i> Active
                                            </span>
                                        <?php else: ?>
                                            <span class="status-pill status-inactive">
                                                <i class="fa-solid fa-circle-xmark" style="font-size: 0.65rem;"></i> Inactive
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1"><?= (int)$cat->sort_order ?></span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <!-- Open Edit Modal Directly -->
                                            <button type="button" 
                                                    class="action-btn btn-edit-category" 
                                                    title="Edit Category"
                                                    data-id="<?= $cat->id ?>"
                                                    data-name="<?= html_escape($cat->name) ?>"
                                                    data-type="<?= html_escape($cat->type) ?>"
                                                    data-icon="<?= html_escape($cat->icon) ?>"
                                                    data-image="<?= !empty($cat->image) && file_exists(FCPATH . $cat->image) ? base_url($cat->image) : '' ?>"
                                                    data-short_description="<?= html_escape($cat->short_description) ?>"
                                                    data-status="<?= html_escape($cat->status) ?>"
                                                    data-sort_order="<?= (int)$cat->sort_order ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <a href="<?= base_url('admin/category/delete/' . $cat->id) ?>" 
                                               class="action-btn btn-delete" 
                                               title="Delete Category"
                                               data-confirm-delete="true"
                                               data-item-name="<?= html_escape($cat->name) ?>">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-box-open fa-2x mb-2 opacity-50 d-block"></i>
                                    No product categories found. Click "Add Product Category" to create one.
                                </td>
                            </tr>
                        <?php endif; ?>
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
                    <tbody>
                        <?php if (!empty($gallery_categories)): ?>
                            <?php foreach ($gallery_categories as $cat): ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= html_escape($cat->name) ?></div>
                                    </td>
                                    <td>
                                        <?php if ($cat->status === 'active'): ?>
                                            <span class="status-pill status-active">
                                                <i class="fa-solid fa-circle-check" style="font-size: 0.65rem;"></i> Active
                                            </span>
                                        <?php else: ?>
                                            <span class="status-pill status-inactive">
                                                <i class="fa-solid fa-circle-xmark" style="font-size: 0.65rem;"></i> Inactive
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1"><?= (int)$cat->sort_order ?></span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <!-- Open Edit Modal Directly -->
                                            <button type="button" 
                                                    class="action-btn btn-edit-category" 
                                                    title="Edit Category"
                                                    data-id="<?= $cat->id ?>"
                                                    data-name="<?= html_escape($cat->name) ?>"
                                                    data-type="<?= html_escape($cat->type) ?>"
                                                    data-icon="<?= html_escape($cat->icon) ?>"
                                                    data-image="<?= !empty($cat->image) && file_exists(FCPATH . $cat->image) ? base_url($cat->image) : '' ?>"
                                                    data-short_description="<?= html_escape($cat->short_description) ?>"
                                                    data-status="<?= html_escape($cat->status) ?>"
                                                    data-sort_order="<?= (int)$cat->sort_order ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <a href="<?= base_url('admin/category/delete/' . $cat->id) ?>" 
                                               class="action-btn btn-delete" 
                                               title="Delete Category"
                                               data-confirm-delete="true"
                                               data-item-name="<?= html_escape($cat->name) ?>">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-images fa-2x mb-2 opacity-50 d-block"></i>
                                    No gallery categories found. Click "Add Gallery Category" to create one.
                                </td>
                            </tr>
                        <?php endif; ?>
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
                    <tbody>
                        <?php if (!empty($brand_categories)): ?>
                            <?php foreach ($brand_categories as $cat): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($cat->image) && file_exists(FCPATH . $cat->image)): ?>
                                            <img src="<?= base_url($cat->image) ?>" alt="<?= html_escape($cat->name) ?>" class="cat-thumbnail">
                                        <?php else: ?>
                                            <div class="cat-thumbnail-placeholder">
                                                <i class="fa-solid fa-tag"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= html_escape($cat->name) ?></div>
                                        <?php if (!empty($cat->short_description)): ?>
                                            <div class="text-muted small text-truncate" style="max-width: 320px;">
                                                <?= html_escape($cat->short_description) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($cat->icon)): ?>
                                            <div class="cat-icon-badge">
                                                <i class="fa-solid <?= html_escape($cat->icon) ?>"></i>
                                                <span><?= html_escape($cat->icon) ?></span>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted small fst-italic">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($cat->status === 'active'): ?>
                                            <span class="status-pill status-active">
                                                <i class="fa-solid fa-circle-check" style="font-size: 0.65rem;"></i> Active
                                            </span>
                                        <?php else: ?>
                                            <span class="status-pill status-inactive">
                                                <i class="fa-solid fa-circle-xmark" style="font-size: 0.65rem;"></i> Inactive
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1"><?= (int)$cat->sort_order ?></span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <!-- Open Edit Modal Directly -->
                                            <button type="button" 
                                                    class="action-btn btn-edit-category" 
                                                    title="Edit Category"
                                                    data-id="<?= $cat->id ?>"
                                                    data-name="<?= html_escape($cat->name) ?>"
                                                    data-type="<?= html_escape($cat->type) ?>"
                                                    data-icon="<?= html_escape($cat->icon) ?>"
                                                    data-image="<?= !empty($cat->image) && file_exists(FCPATH . $cat->image) ? base_url($cat->image) : '' ?>"
                                                    data-short_description="<?= html_escape($cat->short_description) ?>"
                                                    data-status="<?= html_escape($cat->status) ?>"
                                                    data-sort_order="<?= (int)$cat->sort_order ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <a href="<?= base_url('admin/category/delete/' . $cat->id) ?>" 
                                               class="action-btn btn-delete" 
                                               title="Delete Category"
                                               data-confirm-delete="true"
                                               data-item-name="<?= html_escape($cat->name) ?>">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-tags fa-2x mb-2 opacity-50 d-block"></i>
                                    No brand categories found. Click "Add Brand Category" to create one.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
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
                        <label for="prod_icon" class="form-label">Icon Class (FontAwesome)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-icons"></i></span>
                            <input type="text" class="form-control" id="prod_icon" name="icon" placeholder="e.g. fa-fire-burner">
                        </div>
                        <div class="form-text text-muted small">Example: <code>fa-fire-burner</code>, <code>fa-kitchen-set</code>, <code>fa-blender</code></div>
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
                        <label for="brand_icon" class="form-label">Icon Class (FontAwesome)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-icons"></i></span>
                            <input type="text" class="form-control" id="brand_icon" name="icon" placeholder="e.g. fa-tags">
                        </div>
                        <div class="form-text text-muted small">Example: <code>fa-tags</code>, <code>fa-award</code>, <code>fa-crown</code></div>
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
                            <label for="edit_cat_icon" class="form-label">Icon Class (FontAwesome)</label>
                            <div class="d-flex align-items-center gap-2">
                                <div class="modal-icon-preview" id="editIconPreviewBox">
                                    <i class="fa-solid fa-icons" id="editIconPreview"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control" id="edit_cat_icon" name="icon" placeholder="e.g. fa-fire-burner">
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

<!-- Tab URL Sync & Edit Modal Dynamic Population Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching URL sync
        const tabButtons = document.querySelectorAll('#categoryTabs button[data-bs-toggle="tab"]');
        tabButtons.forEach(btn => {
            btn.addEventListener('shown.bs.tab', function(e) {
                const targetId = e.target.getAttribute('data-bs-target');
                let tabType = 'product';
                if (targetId === '#galleryTabPane') {
                    tabType = 'gallery';
                } else if (targetId === '#brandTabPane') {
                    tabType = 'brand';
                }
                const url = new URL(window.location);
                url.searchParams.set('tab', tabType);
                window.history.replaceState({}, '', url);
            });
        });

        // Edit Modal Dynamic Handler
        const editModalEl = document.getElementById('editCategoryModal');
        const editModal = new bootstrap.Modal(editModalEl);
        const editForm = document.getElementById('editCategoryForm');
        const editIdInput = document.getElementById('edit_cat_id');
        const editTypeInput = document.getElementById('edit_cat_type');
        const editNameInput = document.getElementById('edit_cat_name');
        const editIconInput = document.getElementById('edit_cat_icon');
        const editIconPreview = document.getElementById('editIconPreview');
        const editDescInput = document.getElementById('edit_cat_desc');
        const editStatusSelect = document.getElementById('edit_cat_status');
        const editSortInput = document.getElementById('edit_cat_sort');
        const editBadge = document.getElementById('edit_cat_badge');
        const editProdBrandSection = document.getElementById('editProdBrandSection');
        const editCurrentImageBox = document.getElementById('editCurrentImageBox');
        const editCurrentThumb = document.getElementById('editCurrentThumb');
        const editFileInput = document.getElementById('edit_cat_image');

        // Live icon preview inside edit modal
        if (editIconInput && editIconPreview) {
            editIconInput.addEventListener('input', function() {
                const val = this.value.trim();
                editIconPreview.className = 'fa-solid ' + (val ? val : 'fa-icons');
            });
        }

        // Attach click listeners to all edit buttons across all 3 tables
        document.querySelectorAll('.btn-edit-category').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name') || '';
                const type = this.getAttribute('data-type') || 'product';
                const icon = this.getAttribute('data-icon') || '';
                const image = this.getAttribute('data-image') || '';
                const desc = this.getAttribute('data-short_description') || '';
                const status = this.getAttribute('data-status') || 'active';
                const sort = this.getAttribute('data-sort_order') || '0';

                // Set form action
                editForm.action = '<?= base_url("admin/category/edit/") ?>' + id;
                editIdInput.value = id;
                editTypeInput.value = type;
                editNameInput.value = name;
                editNameInput.classList.remove('is-invalid');
                editStatusSelect.value = status;
                editSortInput.value = sort;

                // Update badge and title
                editBadge.textContent = type.toUpperCase();
                document.getElementById('editCategoryModalLabel').textContent = 'Edit ' + type.charAt(0).toUpperCase() + type.slice(1) + ' Category';

                // Reset file input
                if (editFileInput) editFileInput.value = '';

                // Show/hide relevant fields based on type
                if (type === 'gallery') {
                    editProdBrandSection.style.display = 'none';
                } else {
                    editProdBrandSection.style.display = 'block';
                    editIconInput.value = icon;
                    editIconPreview.className = 'fa-solid ' + (icon ? icon : 'fa-icons');
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

                editModal.show();
            });
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
