<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($categories)): ?>
    <?php foreach ($categories as $cat): ?>
        <tr>
            <?php if ($type !== 'gallery'): ?>
                <td>
                    <?php if (!empty($cat->image) && file_exists(FCPATH . $cat->image)): ?>
                        <img src="<?= base_url($cat->image) ?>" alt="<?= html_escape($cat->name) ?>" class="cat-thumbnail">
                    <?php else: ?>
                        <div class="cat-thumbnail-placeholder">
                            <i class="fa-solid <?= ($type === 'brand') ? 'fa-tag' : 'fa-image' ?>"></i>
                        </div>
                    <?php endif; ?>
                </td>
            <?php endif; ?>

            <td>
                <div class="fw-semibold text-dark"><?= html_escape($cat->name) ?></div>
                <?php if (!empty($cat->short_description)): ?>
                    <div class="text-muted small text-truncate" style="max-width: 320px;">
                        <?= html_escape($cat->short_description) ?>
                    </div>
                <?php endif; ?>
            </td>

            <?php if ($type !== 'gallery'): ?>
                <td>
                    <?= render_category_icon_badge($cat->icon) ?>
                </td>
            <?php endif; ?>

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
                    <button type="button" 
                            class="action-btn btn-edit-category" 
                            title="Edit Category"
                            data-id="<?= $cat->id ?>"
                            data-name="<?= html_escape($cat->name) ?>"
                            data-type="<?= html_escape($cat->type) ?>"
                            data-icon="<?= html_escape(normalize_fa_icon($cat->icon, '')) ?>"
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
        <td colspan="<?= ($type === 'gallery') ? '4' : '6' ?>" class="text-center py-5 text-muted">
            <i class="fa-solid fa-box-open fa-2x mb-2 opacity-50 d-block"></i>
            <?= !empty($search_query) ? 'No ' . html_escape($type) . ' categories match "' . html_escape($search_query) . '".' : 'No ' . html_escape($type) . ' categories found.' ?>
        </td>
    </tr>
<?php endif; ?>
