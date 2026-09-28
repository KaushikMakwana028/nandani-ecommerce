<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Scoped Styles inside <style> Tag -->
<style>
    .slider-header {
        margin-bottom: 1.5rem;
    }

    .slider-title {
        font-family: var(--font-heading);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    /* Limit Indicator Card */
    .limit-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .limit-progress {
        height: 8px;
        border-radius: 4px;
        background-color: #E5E7EB;
        overflow: hidden;
    }

    .limit-progress-bar {
        height: 100%;
        transition: width 0.3s ease;
    }

    .limit-progress-bar.normal {
        background-color: #10B981;
    }

    .limit-progress-bar.warning {
        background-color: #F59E0B;
    }

    .limit-progress-bar.full {
        background-color: var(--primary-red);
    }

    /* Main Table Card */
    .slider-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .slider-card-header {
        padding: 1.25rem 1.5rem;
        background-color: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    .table-slider {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table-slider thead th {
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

    .table-slider tbody tr {
        transition: background-color 0.15s ease;
    }

    .table-slider tbody tr:hover {
        background-color: #F9FAFB;
    }

    .table-slider tbody tr.dragging {
        opacity: 0.4;
        background-color: #FEF2F2 !important;
        outline: 2px dashed var(--primary-red);
    }

    .table-slider tbody tr.drag-over {
        border-top: 3px solid var(--primary-red) !important;
    }

    .table-slider td {
        padding: 1rem 1rem;
        border-bottom: 1px solid #F3F4F6;
        color: var(--dark-text);
        font-size: 0.9rem;
    }

    /* Order Column & Reorder Controls */
    .order-box {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .drag-handle {
        cursor: grab;
        color: #9CA3AF;
        padding: 4px;
        font-size: 0.95rem;
        transition: color 0.2s ease;
    }

    .drag-handle:hover {
        color: var(--primary-red);
    }

    .order-badge {
        font-size: 0.8rem;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 6px;
        background-color: #F3F4F6;
        color: #374151;
        min-width: 30px;
        text-align: center;
        display: inline-block;
    }

    .btn-arrow {
        width: 24px;
        height: 24px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        border: 1px solid #D1D5DB;
        background-color: #FFFFFF;
        color: #4B5563;
        font-size: 0.7rem;
        line-height: 1;
        text-decoration: none;
        transition: all 0.15s ease;
    }

    .btn-arrow:hover:not(.disabled) {
        background-color: var(--primary-red);
        border-color: var(--primary-red);
        color: #FFFFFF;
    }

    .btn-arrow.disabled {
        opacity: 0.35;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Thumbnail Display */
    .slide-thumb-wrapper {
        position: relative;
        width: 140px;
        height: 75px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #E5E7EB;
        background-color: #1A1A1A;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .slide-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.25s ease;
    }

    .slide-thumb-wrapper:hover .slide-thumb {
        transform: scale(1.08);
    }

    .slide-thumb-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s ease;
        color: #FFFFFF;
        font-size: 0.85rem;
    }

    .slide-thumb-wrapper:hover .slide-thumb-overlay {
        opacity: 1;
    }

    /* Content Preview */
    .slide-tag-pill {
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 2px 8px;
        border-radius: 4px;
        background-color: #F3F4F6;
        color: #4B5563;
        display: inline-block;
        margin-bottom: 4px;
    }

    .slide-heading {
        font-size: 0.96rem;
        font-weight: 700;
        color: var(--dark-text);
        line-height: 1.3;
        margin-bottom: 3px;
    }

    .highlighted-word-tag {
        color: #B8860B;
        font-weight: 800;
        background-color: #FEF9C3;
        padding: 1px 6px;
        border-radius: 4px;
        font-size: 0.88em;
    }

    .slide-desc {
        font-size: 0.82rem;
        color: #6B7280;
        max-width: 320px;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .slide-buttons-preview {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 6px;
    }

    .cta-badge {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 4px;
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        color: #374151;
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

    /* Actions Group */
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

    .action-btn.btn-preview:hover {
        background-color: #EFF6FF;
        color: #2563EB;
        border-color: #BFDBFE;
    }

    /* Upload & Image Dropzone */
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

    .preview-container {
        position: relative;
        width: 100%;
        height: 140px;
        border-radius: 8px;
        overflow: hidden;
        background-color: #1A1A1A;
        border: 1px solid #E5E7EB;
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Hero Banner Simulator Modal */
    .simulator-stage {
        position: relative;
        width: 100%;
        min-height: 340px;
        border-radius: 12px;
        overflow: hidden;
        background-color: #111827;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        padding: 2.5rem;
        box-shadow: inset 0 0 100px rgba(0,0,0,0.8);
    }

    .simulator-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.55) 50%, rgba(0,0,0,0.3) 100%);
    }

    .simulator-content {
        position: relative;
        z-index: 2;
        max-width: 620px;
        color: #FFFFFF;
    }

    .sim-tag {
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 2px;
        color: #D4AF37;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
        display: inline-block;
    }

    .sim-heading {
        font-family: var(--font-heading);
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 0.85rem;
        color: #FFFFFF;
    }

    .sim-highlight {
        color: #D4AF37;
        text-shadow: 0 0 20px rgba(212, 175, 55, 0.4);
    }

    .sim-desc {
        font-size: 0.95rem;
        color: #D1D5DB;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

    .sim-btn-primary {
        background-color: var(--primary-red);
        color: #FFFFFF;
        border: none;
        padding: 9px 20px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .sim-btn-secondary {
        background-color: transparent;
        color: #FFFFFF;
        border: 2px solid rgba(255, 255, 255, 0.7);
        padding: 7px 18px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>

<div class="container-fluid p-0">

    <!-- Page Header & Action Controls -->
    <div class="slider-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="slider-title">Hero Slider Management</h1>
            <p class="text-muted small mb-0 mt-1">Configure and prioritize up to 5 homepage hero slides, call-to-actions, and background banners.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <?php if ($can_add): ?>
                <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addSlideModal" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add New Slide</span>
                </button>
            <?php else: ?>
                <button type="button" class="btn btn-secondary d-inline-flex align-items-center gap-2 px-3 py-2 disabled" title="Maximum limit of 5 slides reached" style="cursor: not-allowed; opacity: 0.65; font-weight: 600;">
                    <i class="fa-solid fa-lock"></i>
                    <span>Max 5 Slides Reached</span>
                </button>
            <?php endif; ?>
        </div>
    </div>


    <!-- Limit Indicator Banner -->
    <div class="limit-card mb-4">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-2">
            <div class="d-flex align-items-center gap-2">
                <span class="fw-semibold text-dark">Capacity Allocation:</span>
                <span class="badge <?= ($slide_count >= $max_slides) ? 'bg-danger' : 'bg-primary' ?> px-2 py-1">
                    <?= $slide_count ?> / <?= $max_slides ?> Slides
                </span>
                <span class="text-muted small">(<?= $active_count ?> Active on Homepage)</span>
            </div>
            <div>
                <?php if ($slide_count >= $max_slides): ?>
                    <span class="text-danger small fw-semibold"><i class="fa-solid fa-triangle-exclamation me-1"></i> Maximum of 5 slides reached. Edit or remove an existing slide to add another.</span>
                <?php else: ?>
                    <span class="text-muted small"><i class="fa-solid fa-circle-info me-1"></i> <?= ($max_slides - $slide_count) ?> more slide slot(s) available.</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="limit-progress">
            <?php 
                $percentage = ($slide_count / $max_slides) * 100;
                $bar_class = ($slide_count >= $max_slides) ? 'full' : (($slide_count >= 4) ? 'warning' : 'normal');
            ?>
            <div class="limit-progress-bar <?= $bar_class ?>" style="width: <?= $percentage ?>%;"></div>
        </div>
    </div>

    <!-- Main Slides Table Card -->
    <div class="slider-card mb-4">
        <div class="slider-card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-list-ol text-muted"></i>
                <h5 class="mb-0 fw-bold text-dark fs-6">Homepage Slide Sequence</h5>
            </div>
            <div class="text-muted small">
                <i class="fa-solid fa-arrows-up-down me-1"></i> Use up/down arrows or drag rows to reorder
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-slider" id="heroSlidesTable">
                <thead>
                    <tr>
                        <th style="width: 100px;">Order</th>
                        <th style="width: 160px;">Slide Banner</th>
                        <th>Headline & Content</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 130px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="sortableSlides">
                    <?php if (!empty($slides)): ?>
                        <?php foreach ($slides as $index => $slide): ?>
                            <?php 
                                $is_first = ($index === 0);
                                $is_last  = ($index === count($slides) - 1);
                                $image_url = base_url('uploads/hero_slider/' . $slide->image);
                            ?>
                            <tr class="slide-row" 
                                draggable="true" 
                                data-id="<?= $slide->id ?>" 
                                data-order="<?= $slide->sort_order ?>"
                                data-heading="<?= htmlspecialchars($slide->heading_text, ENT_QUOTES, 'UTF-8') ?>"
                                data-tag="<?= htmlspecialchars($slide->tag_text ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-highlighted="<?= htmlspecialchars($slide->highlighted_word ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-desc="<?= htmlspecialchars($slide->description ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-b1-text="<?= htmlspecialchars($slide->button1_text ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-b1-link="<?= htmlspecialchars($slide->button1_link ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-b2-text="<?= htmlspecialchars($slide->button2_text ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-b2-link="<?= htmlspecialchars($slide->button2_link ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-status="<?= $slide->status ?>"
                                data-image="<?= $image_url ?>">
                                
                                <!-- Order & Reorder Controls -->
                                <td>
                                    <div class="order-box">
                                        <i class="fa-solid fa-grip-vertical drag-handle" title="Drag to reorder"></i>
                                        <span class="order-badge">#<?= $slide->sort_order ?></span>
                                        <div class="d-inline-flex flex-column gap-1 ms-1">
                                            <a href="<?= base_url('admin/hero-slider/move/' . $slide->id . '/up') ?>" 
                                               class="btn-arrow btn-move-up <?= $is_first ? 'disabled' : '' ?>" 
                                               title="Move Up">
                                                <i class="fa-solid fa-chevron-up"></i>
                                            </a>
                                            <a href="<?= base_url('admin/hero-slider/move/' . $slide->id . '/down') ?>" 
                                               class="btn-arrow btn-move-down <?= $is_last ? 'disabled' : '' ?>" 
                                               title="Move Down">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                <!-- Thumbnail -->
                                <td>
                                    <div class="slide-thumb-wrapper btn-trigger-preview" title="Click to preview slide">
                                        <img src="<?= $image_url ?>" alt="<?= htmlspecialchars($slide->heading_text, ENT_QUOTES, 'UTF-8') ?>" class="slide-thumb" onerror="this.src='https://via.placeholder.com/300x160?text=No+Image';">
                                        <div class="slide-thumb-overlay">
                                            <i class="fa-solid fa-eye me-1"></i> Preview
                                        </div>
                                    </div>
                                </td>

                                <!-- Content Summary -->
                                <td>
                                    <?php if (!empty($slide->tag_text)): ?>
                                        <span class="slide-tag-pill"><?= htmlspecialchars($slide->tag_text) ?></span>
                                    <?php endif; ?>

                                    <div class="slide-heading">
                                        <?php 
                                            $heading_display = htmlspecialchars($slide->heading_text);
                                            if (!empty($slide->highlighted_word)) {
                                                $hl_clean = htmlspecialchars($slide->highlighted_word);
                                                // Replace case-insensitively
                                                $pattern = '/' . preg_quote($hl_clean, '/') . '/i';
                                                $replacement = '<span class="highlighted-word-tag">$0</span>';
                                                $heading_display = preg_replace($pattern, $replacement, $heading_display);
                                            }
                                            echo $heading_display;
                                        ?>
                                    </div>

                                    <?php if (!empty($slide->description)): ?>
                                        <div class="slide-desc"><?= htmlspecialchars($slide->description) ?></div>
                                    <?php endif; ?>

                                    <!-- Call to Actions Preview -->
                                    <div class="slide-buttons-preview">
                                        <?php if (!empty($slide->button1_text)): ?>
                                            <span class="cta-badge" title="Link: <?= htmlspecialchars($slide->button1_link ?? '') ?>">
                                                <i class="fa-solid fa-arrow-up-right-from-square text-primary" style="font-size: 0.65rem;"></i>
                                                <strong>1:</strong> <?= htmlspecialchars($slide->button1_text) ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if (!empty($slide->button2_text)): ?>
                                            <span class="cta-badge" title="Link: <?= htmlspecialchars($slide->button2_link ?? '') ?>">
                                                <i class="fa-solid fa-arrow-up-right-from-square text-secondary" style="font-size: 0.65rem;"></i>
                                                <strong>2:</strong> <?= htmlspecialchars($slide->button2_text) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td>
                                    <a href="<?= base_url('admin/hero-slider/toggle-status/' . $slide->id) ?>" 
                                       class="status-pill <?= $slide->status ?>" 
                                       title="Click to toggle status">
                                        <span class="status-pill-dot"></span>
                                        <span><?= ucfirst($slide->status) ?></span>
                                    </a>
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="action-btn btn-preview btn-trigger-preview" title="Live Preview">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button type="button" class="action-btn btn-edit-slide" title="Edit Slide">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <a href="<?= base_url('admin/hero-slider/delete/' . $slide->id) ?>" 
                                           class="action-btn btn-delete" 
                                           title="Delete Slide"
                                           data-confirm-delete="true"
                                           data-item-name="<?= htmlspecialchars($slide->heading_text, ENT_QUOTES, 'UTF-8') ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <i class="fa-solid fa-images fa-3x text-muted opacity-50 mb-3"></i>
                                    <h6 class="fw-bold text-dark mb-1">No Hero Slides Added Yet</h6>
                                    <p class="text-muted small mb-3">Start by creating your first hero banner slide to showcase on the homepage.</p>
                                    <button type="button" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addSlideModal" style="background-color: var(--primary-red); border-color: var(--primary-red);">
                                        <i class="fa-solid fa-plus me-1"></i> Add First Slide
                                    </button>
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
     MODAL: ADD NEW SLIDE
========================================== -->
<div class="modal fade" id="addSlideModal" tabindex="-1" aria-labelledby="addSlideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <form action="<?= base_url('admin/hero-slider/add') ?>" method="POST" enctype="multipart/form-data" id="addSlideForm">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="addSlideModalLabel">
                        <i class="fa-solid fa-plus-circle text-danger me-2" style="color: var(--primary-red) !important;"></i>Add New Hero Slide
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark mb-1">
                            Slide Background Image <span class="text-danger">*</span>
                        </label>
                        <div class="image-dropzone" id="addDropzone">
                            <input type="file" name="image" id="add_slide_image" accept="image/jpeg,image/png,image/webp" required>
                            <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                            <div class="fw-semibold text-dark small">Click or drag image file here to upload</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Supported: JPG, PNG, WEBP (Max: 5MB, Recommended: 1920 &times; 800px)</div>
                        </div>
                        <div class="preview-container d-none" id="add_image_preview_box">
                            <img id="add_image_preview_img" src="#" alt="Preview">
                        </div>
                    </div>

                    <!-- Row 1: Heading & Highlighted Word -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label for="add_heading" class="form-label fw-bold small text-dark mb-1">
                                Main Heading <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="heading_text" id="add_heading" placeholder="e.g., Premium Kitchen Appliances & Stoves" maxlength="150" required>
                        </div>
                        <div class="col-md-4">
                            <label for="add_highlighted" class="form-label fw-bold small text-dark mb-1">
                                Highlighted Word
                            </label>
                            <input type="text" class="form-control" name="highlighted_word" id="add_highlighted" placeholder="e.g., Premium" maxlength="50">
                            <small class="text-muted" style="font-size: 0.72rem;">Word will appear in gold luxury text.</small>
                        </div>
                    </div>

                    <!-- Row 2: Tag Text & Description -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label for="add_tag" class="form-label fw-bold small text-dark mb-1">
                                Tag / Category Label
                            </label>
                            <input type="text" class="form-control" name="tag_text" id="add_tag" placeholder="e.g., Exclusive Collection" maxlength="100">
                        </div>
                        <div class="col-md-7">
                            <label for="add_description" class="form-label fw-bold small text-dark mb-1">
                                Description / Subtitle
                            </label>
                            <textarea class="form-control" name="description" id="add_description" rows="2" placeholder="Brief supporting narrative for the hero slide..."></textarea>
                        </div>
                    </div>

                    <!-- Row 3: Button 1 (Text & Link) -->
                    <div class="row g-3 mb-3 p-3 rounded-3" style="background-color: #F9FAFB; border: 1px solid #E5E7EB;">
                        <div class="col-12">
                            <span class="fw-bold small text-dark"><i class="fa-solid fa-link me-1 text-primary"></i> Primary Call-to-Action (Button 1)</span>
                        </div>
                        <div class="col-md-5">
                            <label for="add_b1_text" class="form-label small text-muted mb-1">Button 1 Label</label>
                            <input type="text" class="form-control form-control-sm" name="button1_text" id="add_b1_text" placeholder="e.g., Explore Products" maxlength="50">
                        </div>
                        <div class="col-md-7">
                            <label for="add_b1_link" class="form-label small text-muted mb-1">Button 1 Link (URL or relative path)</label>
                            <input type="text" class="form-control form-control-sm" name="button1_link" id="add_b1_link" placeholder="e.g., /products or https://..." maxlength="255">
                        </div>
                    </div>

                    <!-- Row 4: Button 2 (Text & Link) -->
                    <div class="row g-3 mb-3 p-3 rounded-3" style="background-color: #F9FAFB; border: 1px solid #E5E7EB;">
                        <div class="col-12">
                            <span class="fw-bold small text-dark"><i class="fa-solid fa-link me-1 text-secondary"></i> Secondary Call-to-Action (Button 2)</span>
                        </div>
                        <div class="col-md-5">
                            <label for="add_b2_text" class="form-label small text-muted mb-1">Button 2 Label</label>
                            <input type="text" class="form-control form-control-sm" name="button2_text" id="add_b2_text" placeholder="e.g., Contact Us" maxlength="50">
                        </div>
                        <div class="col-md-7">
                            <label for="add_b2_link" class="form-label small text-muted mb-1">Button 2 Link (URL or relative path)</label>
                            <input type="text" class="form-control form-control-sm" name="button2_link" id="add_b2_link" placeholder="e.g., /contact or https://..." maxlength="255">
                        </div>
                    </div>

                    <!-- Row 5: Status & Sort Order -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="add_status" class="form-label fw-bold small text-dark mb-1">Display Status</label>
                            <select class="form-select" name="status" id="add_status">
                                <option value="active" selected>Active (Visible on Homepage)</option>
                                <option value="inactive">Inactive (Hidden)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="add_order" class="form-label fw-bold small text-dark mb-1">Display Order</label>
                            <input type="number" class="form-control" name="sort_order" id="add_order" value="<?= $slide_count + 1 ?>" min="1" max="100">
                            <small class="text-muted" style="font-size: 0.72rem;">Order is automatically normalized sequentially.</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                        <i class="fa-solid fa-check me-1"></i> Save Hero Slide
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: EDIT SLIDE (IN-PLACE POPULATED)
========================================== -->
<div class="modal fade" id="editSlideModal" tabindex="-1" aria-labelledby="editSlideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <form action="" method="POST" enctype="multipart/form-data" id="editSlideForm">
                <input type="hidden" name="id" id="edit_slide_id" value="">

                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="editSlideModalLabel">
                        <i class="fa-solid fa-pen-to-square text-danger me-2" style="color: var(--primary-red) !important;"></i>Edit Hero Slide
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Image Upload & Current Image Preview -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark mb-1">
                            Slide Background Image
                        </label>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <div class="preview-container mt-0" id="edit_current_img_box">
                                    <img id="edit_current_img" src="#" alt="Current Slide Image">
                                </div>
                                <small class="text-muted d-block text-center mt-1" style="font-size: 0.75rem;">Current Banner</small>
                            </div>
                            <div class="col-md-7">
                                <div class="image-dropzone" id="editDropzone">
                                    <input type="file" name="image" id="edit_slide_image" accept="image/jpeg,image/png,image/webp">
                                    <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                                    <div class="fw-semibold text-dark small">Upload new replacement image</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Leave empty to keep existing image.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 1: Heading & Highlighted Word -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label for="edit_heading" class="form-label fw-bold small text-dark mb-1">
                                Main Heading <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="heading_text" id="edit_heading" maxlength="150" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_highlighted" class="form-label fw-bold small text-dark mb-1">
                                Highlighted Word
                            </label>
                            <input type="text" class="form-control" name="highlighted_word" id="edit_highlighted" maxlength="50">
                            <small class="text-muted" style="font-size: 0.72rem;">Word will appear in gold luxury text.</small>
                        </div>
                    </div>

                    <!-- Row 2: Tag Text & Description -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label for="edit_tag" class="form-label fw-bold small text-dark mb-1">
                                Tag / Category Label
                            </label>
                            <input type="text" class="form-control" name="tag_text" id="edit_tag" maxlength="100">
                        </div>
                        <div class="col-md-7">
                            <label for="edit_description" class="form-label fw-bold small text-dark mb-1">
                                Description / Subtitle
                            </label>
                            <textarea class="form-control" name="description" id="edit_description" rows="2"></textarea>
                        </div>
                    </div>

                    <!-- Row 3: Button 1 (Text & Link) -->
                    <div class="row g-3 mb-3 p-3 rounded-3" style="background-color: #F9FAFB; border: 1px solid #E5E7EB;">
                        <div class="col-12">
                            <span class="fw-bold small text-dark"><i class="fa-solid fa-link me-1 text-primary"></i> Primary Call-to-Action (Button 1)</span>
                        </div>
                        <div class="col-md-5">
                            <label for="edit_b1_text" class="form-label small text-muted mb-1">Button 1 Label</label>
                            <input type="text" class="form-control form-control-sm" name="button1_text" id="edit_b1_text" maxlength="50">
                        </div>
                        <div class="col-md-7">
                            <label for="edit_b1_link" class="form-label small text-muted mb-1">Button 1 Link (URL or relative path)</label>
                            <input type="text" class="form-control form-control-sm" name="button1_link" id="edit_b1_link" maxlength="255">
                        </div>
                    </div>

                    <!-- Row 4: Button 2 (Text & Link) -->
                    <div class="row g-3 mb-3 p-3 rounded-3" style="background-color: #F9FAFB; border: 1px solid #E5E7EB;">
                        <div class="col-12">
                            <span class="fw-bold small text-dark"><i class="fa-solid fa-link me-1 text-secondary"></i> Secondary Call-to-Action (Button 2)</span>
                        </div>
                        <div class="col-md-5">
                            <label for="edit_b2_text" class="form-label small text-muted mb-1">Button 2 Label</label>
                            <input type="text" class="form-control form-control-sm" name="button2_text" id="edit_b2_text" maxlength="50">
                        </div>
                        <div class="col-md-7">
                            <label for="edit_b2_link" class="form-label small text-muted mb-1">Button 2 Link (URL or relative path)</label>
                            <input type="text" class="form-control form-control-sm" name="button2_link" id="edit_b2_link" maxlength="255">
                        </div>
                    </div>

                    <!-- Row 5: Status & Sort Order -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_status" class="form-label fw-bold small text-dark mb-1">Display Status</label>
                            <select class="form-select" name="status" id="edit_status">
                                <option value="active">Active (Visible on Homepage)</option>
                                <option value="inactive">Inactive (Hidden)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_order" class="form-label fw-bold small text-dark mb-1">Display Order</label>
                            <input type="number" class="form-control" name="sort_order" id="edit_order" min="1" max="100">
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                        <i class="fa-solid fa-check me-1"></i> Update Hero Slide
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: HERO BANNER SIMULATOR (LIVE PREVIEW)
========================================== -->
<div class="modal fade" id="previewSlideModal" tabindex="-1" aria-labelledby="previewSlideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content shadow border-0">
            <div class="modal-header border-bottom px-4 py-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-display text-primary fs-5"></i>
                    <h5 class="modal-title fw-bold text-dark" id="previewSlideModalLabel">Homepage Hero Slide Preview</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="simulator-stage" id="simStage">
                    <div class="simulator-overlay"></div>
                    <div class="simulator-content">
                        <div class="sim-tag" id="simTag">TAG TEXT</div>
                        <h2 class="sim-heading" id="simHeading">Main Heading Appears Here</h2>
                        <p class="sim-desc" id="simDesc">Slide description and narrative preview will show here.</p>
                        <div class="d-flex align-items-center gap-3" id="simButtonsBox">
                            <a href="#" class="sim-btn-primary" id="simB1">Button 1</a>
                            <a href="#" class="sim-btn-secondary" id="simB2">Button 2</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2 bg-white">
                <span class="text-muted small me-auto"><i class="fa-solid fa-info-circle me-1"></i> Visual representation of how this slide appears on the customer-facing frontend.</span>
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Close Preview</button>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     SCRIPTS: REORDERING, MODALS & INTERACTIONS
========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('sortableSlides');
    const baseUrl = '<?= base_url() ?>';

    // 1. IMAGE PREVIEW (ADD MODAL)
    const addImgInput = document.getElementById('add_slide_image');
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

    // 2. IMAGE PREVIEW (EDIT MODAL)
    const editImgInput = document.getElementById('edit_slide_image');
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

    // 3. EDIT SLIDE MODAL POPULATION
    const editModalEl = document.getElementById('editSlideModal');
    const editModal = editModalEl ? new bootstrap.Modal(editModalEl) : null;
    const editForm = document.getElementById('editSlideForm');

    document.querySelectorAll('.btn-edit-slide').forEach(btn => {
        btn.addEventListener('click', function() {
            const tr = this.closest('.slide-row');
            if (!tr) return;

            const id = tr.dataset.id;
            const heading = tr.dataset.heading || '';
            const tag = tr.dataset.tag || '';
            const highlighted = tr.dataset.highlighted || '';
            const desc = tr.dataset.desc || '';
            const b1Text = tr.dataset.b1Text || '';
            const b1Link = tr.dataset.b1Link || '';
            const b2Text = tr.dataset.b2Text || '';
            const b2Link = tr.dataset.b2Link || '';
            const status = tr.dataset.status || 'active';
            const order = tr.dataset.order || '1';
            const image = tr.dataset.image || '';

            // Populate form
            editForm.action = baseUrl + 'admin/hero-slider/edit/' + id;
            document.getElementById('edit_slide_id').value = id;
            document.getElementById('edit_heading').value = heading;
            document.getElementById('edit_tag').value = tag;
            document.getElementById('edit_highlighted').value = highlighted;
            document.getElementById('edit_description').value = desc;
            document.getElementById('edit_b1_text').value = b1Text;
            document.getElementById('edit_b1_link').value = b1Link;
            document.getElementById('edit_b2_text').value = b2Text;
            document.getElementById('edit_b2_link').value = b2Link;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_order').value = order;
            document.getElementById('edit_current_img').src = image;

            // Reset file input
            if (editImgInput) editImgInput.value = '';

            editModal.show();
        });
    });

    // 4. LIVE HERO BANNER PREVIEW MODAL
    const previewModalEl = document.getElementById('previewSlideModal');
    const previewModal = previewModalEl ? new bootstrap.Modal(previewModalEl) : null;

    document.querySelectorAll('.btn-trigger-preview').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const tr = this.closest('.slide-row');
            if (!tr) return;

            const heading = tr.dataset.heading || '';
            const tag = tr.dataset.tag || '';
            const highlighted = tr.dataset.highlighted || '';
            const desc = tr.dataset.desc || '';
            const b1Text = tr.dataset.b1Text || '';
            const b1Link = tr.dataset.b1Link || '#';
            const b2Text = tr.dataset.b2Text || '';
            const b2Link = tr.dataset.b2Link || '#';
            const image = tr.dataset.image || '';

            // Set background
            const simStage = document.getElementById('simStage');
            simStage.style.backgroundImage = 'url(' + image + ')';

            // Set Tag
            const simTag = document.getElementById('simTag');
            if (tag) {
                simTag.textContent = tag;
                simTag.style.display = 'inline-block';
            } else {
                simTag.style.display = 'none';
            }

            // Set Heading with highlight
            const simHeading = document.getElementById('simHeading');
            if (highlighted && heading.toLowerCase().includes(highlighted.toLowerCase())) {
                const regex = new RegExp('(' + highlighted.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&') + ')', 'gi');
                simHeading.innerHTML = heading.replace(regex, '<span class="sim-highlight">$1</span>');
            } else {
                simHeading.textContent = heading;
            }

            // Set Description
            const simDesc = document.getElementById('simDesc');
            if (desc) {
                simDesc.textContent = desc;
                simDesc.style.display = 'block';
            } else {
                simDesc.style.display = 'none';
            }

            // Set Buttons
            const simB1 = document.getElementById('simB1');
            const simB2 = document.getElementById('simB2');

            if (b1Text) {
                simB1.textContent = b1Text;
                simB1.href = b1Link;
                simB1.style.display = 'inline-flex';
            } else {
                simB1.style.display = 'none';
            }

            if (b2Text) {
                simB2.textContent = b2Text;
                simB2.href = b2Link;
                simB2.style.display = 'inline-flex';
            } else {
                simB2.style.display = 'none';
            }

            previewModal.show();
        });
    });

    // 5. DRAG-AND-DROP SEQUENTIAL REORDERING
    let draggedRow = null;

    if (tableBody) {
        tableBody.addEventListener('dragstart', function(e) {
            const tr = e.target.closest('tr.slide-row');
            if (!tr) return;
            draggedRow = tr;
            tr.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', tr.dataset.id);
        });

        tableBody.addEventListener('dragend', function(e) {
            const tr = e.target.closest('tr.slide-row');
            if (tr) tr.classList.remove('dragging');
            document.querySelectorAll('tr.slide-row').forEach(row => row.classList.remove('drag-over'));
            draggedRow = null;
        });

        tableBody.addEventListener('dragover', function(e) {
            e.preventDefault();
            const tr = e.target.closest('tr.slide-row');
            if (!tr || tr === draggedRow) return;

            document.querySelectorAll('tr.slide-row').forEach(row => row.classList.remove('drag-over'));
            tr.classList.add('drag-over');
            e.dataTransfer.dropEffect = 'move';
        });

        tableBody.addEventListener('dragleave', function(e) {
            const tr = e.target.closest('tr.slide-row');
            if (tr) tr.classList.remove('drag-over');
        });

        tableBody.addEventListener('drop', function(e) {
            e.preventDefault();
            const tr = e.target.closest('tr.slide-row');
            if (!tr || !draggedRow || tr === draggedRow) return;

            tr.classList.remove('drag-over');

            // Determine if insert before or after
            const rect = tr.getBoundingClientRect();
            const next = (e.clientY - rect.top) / (rect.bottom - rect.top) > 0.5;
            tableBody.insertBefore(draggedRow, next ? tr.nextSibling : tr);

            // Collect new sequence of IDs
            const rows = Array.from(tableBody.querySelectorAll('tr.slide-row'));
            const orderIds = rows.map(r => r.dataset.id);

            // Update visible badge numbers immediately
            rows.forEach((r, idx) => {
                const badge = r.querySelector('.order-badge');
                if (badge) badge.textContent = '#' + (idx + 1);
                r.dataset.order = (idx + 1);

                // Update arrow states
                const upBtn = r.querySelector('.btn-move-up');
                const downBtn = r.querySelector('.btn-move-down');
                if (upBtn) upBtn.classList.toggle('disabled', idx === 0);
                if (downBtn) downBtn.classList.toggle('disabled', idx === rows.length - 1);
            });

            // Persist order in a single transaction via AJAX
            const formData = new FormData();
            orderIds.forEach(id => formData.append('order[]', id));

            fetch(baseUrl + 'admin/hero-slider/reorder', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update successful; optional subtle toast or quiet update
                } else {
                    alert('Could not save new slide order: ' + (data.message || 'Unknown error'));
                    window.location.reload();
                }
            })
            .catch(err => {
                console.error('Reorder error:', err);
                window.location.reload();
            });
        });
    }
});
</script>
