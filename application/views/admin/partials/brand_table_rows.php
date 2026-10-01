<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($brands)): ?>
    <?php foreach ($brands as $b): ?>
        <?php $logo_url = base_url('uploads/brands/' . $b->logo_image); ?>
        <tr class="brand-row"
            data-id="<?= $b->id ?>"
            data-name="<?= htmlspecialchars($b->name, ENT_QUOTES, 'UTF-8') ?>"
            data-category-id="<?= $b->category_id ?>"
            data-since-year="<?= $b->since_year ?? '' ?>"
            data-short-desc="<?= htmlspecialchars($b->short_description ?? '', ENT_QUOTES, 'UTF-8') ?>"
            data-status="<?= $b->status ?>"
            data-logo="<?= $logo_url ?>">
            
            <!-- Logo Thumbnail -->
            <td>
                <div class="brand-logo-wrapper" title="<?= htmlspecialchars($b->name) ?>">
                    <img src="<?= $logo_url ?>" alt="<?= htmlspecialchars($b->name) ?>" class="brand-logo-img" onerror="this.src='https://via.placeholder.com/80x60?text=PNG';">
                </div>
            </td>

            <!-- Brand Details -->
            <td>
                <div class="fw-bold text-dark fs-6 mb-1"><?= htmlspecialchars($b->name) ?></div>
                <?php if (!empty($b->short_description)): ?>
                    <div class="text-muted small text-truncate" style="max-width: 380px;">
                        <?= htmlspecialchars($b->short_description) ?>
                    </div>
                <?php else: ?>
                    <span class="text-muted fst-italic small">No description provided</span>
                <?php endif; ?>
            </td>

            <!-- Joined Product Category -->
            <td>
                <?php if (!empty($b->category_name)): ?>
                    <span class="cat-badge" title="Type: <?= htmlspecialchars($b->category_type ?? 'product') ?>">
                        <i class="fa-solid fa-layer-group"></i>
                        <?= htmlspecialchars($b->category_name) ?>
                    </span>
                <?php else: ?>
                    <span class="text-danger small fst-italic">Category unlinked</span>
                <?php endif; ?>
            </td>

            <!-- Since Year -->
            <td>
                <?php if (!empty($b->since_year)): ?>
                    <span class="since-pill">Est. <?= $b->since_year ?></span>
                <?php else: ?>
                    <span class="text-muted small">&mdash;</span>
                <?php endif; ?>
            </td>

            <!-- Status -->
            <td>
                <a href="<?= base_url('admin/brands/toggle-status/' . $b->id) ?>" 
                   class="status-pill <?= $b->status ?>" 
                   title="Click to toggle status">
                    <span class="status-pill-dot"></span>
                    <span><?= ucfirst($b->status) ?></span>
                </a>
            </td>

            <!-- Actions -->
            <td class="text-end">
                <div class="d-inline-flex gap-1">
                    <button type="button" class="action-btn btn-edit-brand" title="Edit Brand">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <a href="<?= base_url('admin/brands/delete/' . $b->id) ?>" 
                       class="action-btn btn-delete" 
                       title="Delete Brand"
                       data-confirm-delete="true"
                       data-item-name="<?= htmlspecialchars($b->name, ENT_QUOTES, 'UTF-8') ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="6" class="text-center py-5">
            <div class="py-4">
                <i class="fa-solid fa-tags fa-3x text-muted opacity-50 mb-3"></i>
                <h6 class="fw-bold text-dark mb-1">No Brands Found</h6>
                <p class="text-muted small mb-3">
                    <?= !empty($search_query) ? 'No brands match "' . htmlspecialchars($search_query) . '".' : 'No brands found matching the selected filter criteria.' ?>
                </p>
                <button type="button" class="btn btn-outline-secondary btn-sm px-3" id="resetBrandFiltersBtn">
                    Clear Filters
                </button>
            </div>
        </td>
    </tr>
<?php endif; ?>
