<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Specific Styles Scoped Inside Page -->
<style>
    .category-page-header {
        margin-bottom: 1.5rem;
    }

    .category-page-title {
        font-family: var(--font-heading);
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    .category-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .category-card-header {
        padding: 1.25rem 1.5rem;
        background-color: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    /* Filter Pills */
    .filter-pills-nav {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-pill-btn {
        font-size: 0.82rem;
        font-weight: 500;
        padding: 6px 14px;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        background-color: #FFFFFF;
        color: #4B5563;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .filter-pill-btn:hover {
        background-color: #F3F4F6;
        color: var(--dark-text);
    }

    .filter-pill-btn.active {
        background-color: var(--dark-text);
        border-color: var(--dark-text);
        color: var(--white);
    }

    .filter-pill-btn .pill-counter {
        font-size: 0.72rem;
        background: rgba(0, 0, 0, 0.08);
        padding: 2px 7px;
        border-radius: 10px;
    }

    .filter-pill-btn.active .pill-counter {
        background: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
    }

    /* Table Styling */
    .table-categories {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table-categories thead th {
        background-color: #FAFAFA;
        color: #4B5563;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 600;
        border-bottom: 1px solid var(--border-color);
        padding: 12px 16px;
        white-space: nowrap;
    }

    .table-categories tbody td {
        padding: 14px 16px;
        font-size: 0.88rem;
        border-bottom: 1px solid #F3F4F6;
    }

    .table-categories tbody tr:last-child td {
        border-bottom: none;
    }

    .table-categories tbody tr:hover td {
        background-color: #FAFCFE;
    }

    .category-icon-box {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        background-color: #F3F4F6;
        color: var(--dark-text);
    }

    .badge-type-product {
        background-color: rgba(200, 16, 46, 0.1);
        color: var(--primary-red);
        border: 1px solid rgba(200, 16, 46, 0.2);
        font-weight: 600;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: capitalize;
    }

    .badge-type-gallery {
        background-color: rgba(255, 199, 44, 0.18);
        color: #9A6F00;
        border: 1px solid rgba(255, 199, 44, 0.4);
        font-weight: 600;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: capitalize;
    }

    .badge-type-brand {
        background-color: rgba(30, 41, 59, 0.1);
        color: #1E293B;
        border: 1px solid rgba(30, 41, 59, 0.2);
        font-weight: 600;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: capitalize;
    }

    .badge-status-active {
        background-color: #DCFCE7;
        color: #15803D;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .badge-status-inactive {
        background-color: #F3F4F6;
        color: #6B7280;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        transition: all 0.2s ease;
        border: 1px solid var(--border-color);
        background: #FFFFFF;
        color: #4B5563;
        text-decoration: none;
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
</style>

<!-- Top Action Header -->
<div class="category-page-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1 class="category-page-title">Categories Master</h1>
        <p class="text-muted small mb-0 mt-1">Master classification for Products, Galleries, and Brands across the business platform.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('admin/category/add') ?>" class="btn btn-primary-red d-inline-flex align-items-center">
            <i class="fa-solid fa-plus me-2"></i>
            <span>Add Category</span>
        </a>
    </div>
</div>

<!-- Category Main Card -->
<div class="category-card">
    
    <!-- Filter Tabs & Actions Header -->
    <div class="category-card-header d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
        <div class="filter-pills-nav">
            <a href="<?= base_url('admin/category') ?>" class="filter-pill-btn <?= empty($current_type) ? 'active' : '' ?>">
                <span>All Categories</span>
                <span class="pill-counter"><?= $counts['all'] ?? 0 ?></span>
            </a>
            <a href="<?= base_url('admin/category?type=product') ?>" class="filter-pill-btn <?= ($current_type === 'product') ? 'active' : '' ?>">
                <i class="fa-solid fa-box-open" style="font-size: 0.75rem;"></i>
                <span>Products</span>
                <span class="pill-counter"><?= $counts['product'] ?? 0 ?></span>
            </a>
            <a href="<?= base_url('admin/category?type=gallery') ?>" class="filter-pill-btn <?= ($current_type === 'gallery') ? 'active' : '' ?>">
                <i class="fa-solid fa-images" style="font-size: 0.75rem;"></i>
                <span>Galleries</span>
                <span class="pill-counter"><?= $counts['gallery'] ?? 0 ?></span>
            </a>
            <a href="<?= base_url('admin/category?type=brand') ?>" class="filter-pill-btn <?= ($current_type === 'brand') ? 'active' : '' ?>">
                <i class="fa-solid fa-tags" style="font-size: 0.75rem;"></i>
                <span>Brands</span>
                <span class="pill-counter"><?= $counts['brand'] ?? 0 ?></span>
            </a>
        </div>
        <div class="text-muted small">
            Showing <strong><?= count($categories) ?></strong> record(s)
        </div>
    </div>

    <!-- Categories Data Table -->
    <div class="table-responsive">
        <table class="table table-categories">
            <thead>
                <tr>
                    <th style="width: 60px;">#ID</th>
                    <th style="width: 60px;">Icon</th>
                    <th>Category Name</th>
                    <th>Module Type</th>
                    <th>Short Description</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 90px;">Sort Order</th>
                    <th style="width: 140px;">Created Date</th>
                    <th style="width: 110px;" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td class="text-muted fw-semibold">#<?= $cat->id ?></td>
                            <td>
                                <div class="category-icon-box">
                                    <i class="fa-solid <?= !empty($cat->icon) ? html_escape($cat->icon) : 'fa-folder' ?>"></i>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark"><?= html_escape($cat->name) ?></div>
                            </td>
                            <td>
                                <?php if ($cat->type === 'product'): ?>
                                    <span class="badge-type-product"><i class="fa-solid fa-fire me-1"></i>Product</span>
                                <?php elseif ($cat->type === 'gallery'): ?>
                                    <span class="badge-type-gallery"><i class="fa-solid fa-camera-retro me-1"></i>Gallery</span>
                                <?php else: ?>
                                    <span class="badge-type-brand"><i class="fa-solid fa-tag me-1"></i>Brand</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="text-muted small text-truncate" style="max-width: 320px;">
                                    <?= !empty($cat->short_description) ? html_escape($cat->short_description) : '<span class="text-muted fst-italic">None</span>' ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($cat->status === 'active'): ?>
                                    <span class="badge-status-active"><i class="fa-solid fa-circle-check me-1"></i>Active</span>
                                <?php else: ?>
                                    <span class="badge-status-inactive"><i class="fa-solid fa-circle-xmark me-1"></i>Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1"><?= (int)$cat->sort_order ?></span>
                            </td>
                            <td class="text-muted small">
                                <?= date('d M Y', strtotime($cat->created_at)) ?>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?= base_url('admin/category/edit/' . $cat->id) ?>" class="action-btn" title="Edit Category">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <!-- Delete Button with Global Confirmation Step -->
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
                        <td colspan="9" class="text-center py-5">
                            <div class="py-4">
                                <i class="fa-solid fa-layer-group text-muted fa-3x mb-3 opacity-50"></i>
                                <h5 class="text-dark fw-bold">No Categories Found</h5>
                                <p class="text-muted small mb-3">No category records match your current filter.</p>
                                <a href="<?= base_url('admin/category') ?>" class="btn btn-sm btn-outline-secondary">Reset Filters</a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
