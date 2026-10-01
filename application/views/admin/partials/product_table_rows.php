<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
                    <?= !empty($search_query) ? 'No products match your search query "' . htmlspecialchars($search_query) . '".' : 'No products found matching the selected filter criteria.' ?>
                </p>
                <button type="button" class="btn btn-outline-secondary btn-sm px-3" id="resetProductFiltersBtn">
                    Clear Filters
                </button>
            </div>
        </td>
    </tr>
<?php endif; ?>
