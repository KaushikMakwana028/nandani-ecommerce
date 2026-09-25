<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Specific Styles Scoped Inside Page -->
<style>
    .dash-welcome-card {
        background: linear-gradient(135deg, #FFFFFF 0%, #FFFDF8 100%);
        border: 1px solid var(--border-color);
        border-left: 5px solid var(--primary-red);
        border-radius: 12px;
        padding: 1.75rem 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        margin-bottom: 2rem;
    }

    .dash-welcome-title {
        font-family: var(--font-heading);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--dark-text);
        margin-bottom: 0.5rem;
    }

    .stat-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    }

    .stat-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .stat-icon-red {
        background-color: rgba(200, 16, 46, 0.1);
        color: var(--primary-red);
    }

    .stat-icon-gold {
        background-color: rgba(255, 199, 44, 0.2);
        color: #B27B00;
    }

    .stat-icon-dark {
        background-color: rgba(26, 26, 26, 0.08);
        color: var(--dark-text);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-text);
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #6B7280;
    }

    .dash-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .dash-card-header {
        padding: 1.25rem 1.5rem;
        background-color: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    .dash-card-title {
        font-family: var(--font-heading);
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        color: var(--dark-text);
    }

    .quick-link-box {
        padding: 1.25rem;
        border-radius: 10px;
        background-color: #FAFAFA;
        border: 1px solid var(--border-color);
        text-decoration: none;
        color: var(--dark-text);
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .quick-link-box:hover {
        background-color: #FFFFFF;
        border-color: var(--primary-red);
        box-shadow: 0 4px 12px rgba(200, 16, 46, 0.1);
        color: var(--primary-red);
    }
</style>

<!-- Welcome Header Card -->
<div class="dash-welcome-card d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
    <div>
        <h1 class="dash-welcome-title">Welcome to Nandani Admin</h1>
        <p class="text-muted mb-0">Manage business catalog, product master categories, media galleries, and incoming enquiries.</p>
    </div>
    <div>
        <a href="<?= base_url('admin/category') ?>" class="btn btn-primary-red d-inline-flex align-items-center">
            <i class="fa-solid fa-layer-group me-2"></i>
            <span>Manage Categories</span>
        </a>
    </div>
</div>

<!-- Overview Stats Grid -->
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label mb-1">Total Categories</div>
                <div class="stat-number"><?= $stats['total_categories'] ?? 0 ?></div>
                <div class="small text-muted mt-1">Master Records</div>
            </div>
            <div class="stat-icon-wrapper stat-icon-red">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label mb-1">Product Categories</div>
                <div class="stat-number"><?= $stats['product_categories'] ?? 0 ?></div>
                <div class="small text-muted mt-1">Stoves & Appliances</div>
            </div>
            <div class="stat-icon-wrapper stat-icon-gold">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label mb-1">Gallery Categories</div>
                <div class="stat-number"><?= $stats['gallery_categories'] ?? 0 ?></div>
                <div class="small text-muted mt-1">Events & Media</div>
            </div>
            <div class="stat-icon-wrapper stat-icon-dark">
                <i class="fa-solid fa-images"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label mb-1">Brand Categories</div>
                <div class="stat-number"><?= $stats['brand_categories'] ?? 0 ?></div>
                <div class="small text-muted mt-1">Brand Classifications</div>
            </div>
            <div class="stat-icon-wrapper stat-icon-red">
                <i class="fa-solid fa-tags"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Navigation & Recent Categories -->
<div class="row g-4">
    <!-- Quick Access Modules -->
    <div class="col-12 col-lg-5">
        <div class="dash-card h-100">
            <div class="dash-card-header">
                <h3 class="dash-card-title">Quick Actions</h3>
            </div>
            <div class="p-4 d-flex flex-column gap-3">
                <a href="<?= base_url('admin/category') ?>" class="quick-link-box">
                    <i class="fa-solid fa-layer-group fs-4 me-3 text-danger"></i>
                    <div>
                        <div class="fw-semibold">Categories Master</div>
                        <div class="text-muted small">View, sort and organize product/gallery types</div>
                    </div>
                    <i class="fa-solid fa-chevron-right ms-auto opacity-50"></i>
                </a>

                <a href="<?= base_url('admin/brands') ?>" class="quick-link-box">
                    <i class="fa-solid fa-tags fs-4 me-3 text-warning"></i>
                    <div>
                        <div class="fw-semibold">Brands Module</div>
                        <div class="text-muted small">Manage associated brands (Step 3 Migration)</div>
                    </div>
                    <i class="fa-solid fa-chevron-right ms-auto opacity-50"></i>
                </a>

                <a href="<?= base_url('admin/products') ?>" class="quick-link-box">
                    <i class="fa-solid fa-box-open fs-4 me-3 text-secondary"></i>
                    <div>
                        <div class="fw-semibold">Products Catalog</div>
                        <div class="text-muted small">Manage products (Step 4 Migration)</div>
                    </div>
                    <i class="fa-solid fa-chevron-right ms-auto opacity-50"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Seeded Categories Overview -->
    <div class="col-12 col-lg-7">
        <div class="dash-card h-100">
            <div class="dash-card-header d-flex align-items-center justify-content-between">
                <h3 class="dash-card-title">Master Categories</h3>
                <a href="<?= base_url('admin/category') ?>" class="text-decoration-none small fw-semibold" style="color: var(--primary-red);">
                    View All <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th class="pe-4 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent_categories)): ?>
                            <?php foreach ($recent_categories as $item): ?>
                                <tr>
                                    <td class="ps-4 fw-semibold text-dark">
                                        <i class="fa-solid <?= !empty($item->icon) ? html_escape($item->icon) : 'fa-folder' ?> me-2 text-muted"></i>
                                        <?= html_escape($item->name) ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border text-capitalize">
                                            <?= html_escape($item->type) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                                            <?= html_escape($item->status) ?>
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <a href="<?= base_url('admin/category') ?>" class="btn btn-sm btn-outline-secondary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">No categories available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
