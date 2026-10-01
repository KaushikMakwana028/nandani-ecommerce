<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Scoped Styles inside <style> Tag -->
<style>
    :root {
        --hov-white : #fff;
    }

    .gal-header {
        margin-bottom: 1.5rem;
    }

    .gal-title {
        font-family: var(--font-heading);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0;
    }

    /* Stats Card */
    .gal-stat-box {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0.85rem 1.25rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .gal-stat-icon {
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

    /* Filter Card */
    .gal-filter-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    /* Responsive Thumbnail Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.5rem;
    }

    /* Gallery Item Card */
    .gallery-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        display: flex;
        flex-direction: column;
        position: relative;
        height: 100%;
    }

    .gallery-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
    }

    /* Card Image Container with Hover Actions */
    .gallery-thumb-container {
        position: relative;
        width: 100%;
        height: 220px;
        background-color: #F3F4F6;
        overflow: hidden;
        display: block;
    }

    .gallery-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-card:hover .gallery-thumb-img {
        transform: scale(1.06);
    }

    /* Hover Actions Overlay */
    .gallery-hover-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        opacity: 0;
        transition: opacity 0.25s ease;
        z-index: 2;
    }

    .gallery-card:hover .gallery-hover-overlay {
        opacity: 1;
    }

    .hover-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: #FFFFFF;
        color: #1F2937;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.25);
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        font-size: 0.95rem;
    }

    .hover-btn:hover {
        background-color: var(--primary-red);
        color: var(--hov-white) !important;
        transform: scale(1.12);
    }

    .hover-btn.btn-view:hover {
        background-color: #2563EB;
        color: #FFFFFF;
    }

    /* Card Body */
    .gallery-card-body {
        padding: 1rem 1.15rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: space-between;
    }

    .gallery-caption {
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--dark-text);
        margin-bottom: 0.5rem;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .gallery-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 0.4rem;
        gap: 8px;
    }

    .gallery-cat-tag {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        background-color: #F3F4F6;
        color: #4B5563;
        border: 1px solid #E5E7EB;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        max-width: 140px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Status Pill */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 0.74rem;
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
</style>

<div class="container-fluid p-0">

    <!-- Page Header & Action Controls -->
    <div class="gal-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="gal-title">Gallery Management</h1>
            <p class="text-muted small mb-0 mt-1">Curate showcase visuals, corporate event photography, and factory images in a responsive grid.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="gal-stat-box">
                <div class="gal-stat-icon">
                    <i class="fa-solid fa-photo-film"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark lh-1" style="font-size: 1.15rem;"><?= $total_gallery ?></div>
                    <small class="text-muted" style="font-size: 0.75rem;">Total Images (<?= $active_count ?> Active)</small>
                </div>
            </div>
            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="modal" data-bs-target="#addImageModal" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                <i class="fa-solid fa-plus"></i>
                <span>Add New Image</span>
            </button>
        </div>
    </div>


    <!-- Gallery Filters Toolbar -->
    <div class="admin-filter-card mb-4">
        <form id="galleryFilterForm" method="GET" action="<?= base_url('admin/gallery') ?>">
            <!-- Top Tier: Search Caption + Per Page & Reset -->
            <div class="row g-2 align-items-center mb-3">
                <div class="col-12 col-lg-8">
                    <div class="filter-search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" class="form-control" name="q" id="gallery_filter_q" value="<?= htmlspecialchars($search_query ?? '') ?>" placeholder="Search gallery captions or titles...">
                        <button type="button" class="btn-clear-search <?= empty($search_query) ? 'd-none' : '' ?>" id="clearGallerySearchBtn" aria-label="Clear Search">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-lg-end gap-2">
                    <div class="d-flex align-items-center gap-2 flex-grow-1 flex-lg-grow-0">
                        <span class="text-muted small d-none d-sm-inline">Show:</span>
                        <select class="form-select form-select-sm filter-control" name="per_page" id="gallery_filter_per_page" title="Images per page" style="min-width: 95px;">
                            <option value="12" <?= ($per_page == 12) ? 'selected' : '' ?>>12 / page</option>
                            <option value="24" <?= ($per_page == 24) ? 'selected' : '' ?>>24 / page</option>
                            <option value="48" <?= ($per_page == 48) ? 'selected' : '' ?>>48 / page</option>
                            <option value="96" <?= ($per_page == 96) ? 'selected' : '' ?>>96 / page</option>
                        </select>
                    </div>
                    <button type="button" class="btn-filter-reset" id="resetGalleryFiltersBtn" title="Reset all filters">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Reset</span>
                    </button>
                </div>
            </div>

            <!-- Bottom Tier: Category & Status Dropdowns -->
            <div class="row g-2 pt-2 border-top">
                <div class="col-12 col-sm-6">
                    <label class="filter-field-label"><i class="fa-solid fa-layer-group me-1 opacity-75"></i> Category</label>
                    <select class="form-select form-select-sm filter-control" name="category_id" id="gallery_filter_category_id">
                        <option value="0">All Gallery Categories</option>
                        <?php if (!empty($gallery_categories)): ?>
                            <?php foreach ($gallery_categories as $gc): ?>
                                <option value="<?= $gc->id ?>" <?= ($selected_category == $gc->id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($gc->name) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-12 col-sm-6">
                    <label class="filter-field-label"><i class="fa-solid fa-toggle-on me-1 opacity-75"></i> Status</label>
                    <select class="form-select form-select-sm filter-control" name="status" id="gallery_filter_status">
                        <option value="">All Statuses</option>
                        <option value="active" <?= ($selected_status === 'active') ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= ($selected_status === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Gallery Grid Box with Loading Overlay -->
    <div class="position-relative mb-4">
        <!-- Loading Overlay -->
        <div id="galleryGridOverlay" class="position-absolute w-100 h-100 top-0 start-0 d-none justify-content-center align-items-center" style="background: rgba(255,255,255,0.7); z-index: 10; backdrop-filter: blur(1px); border-radius: 12px; min-height: 200px;">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading images...</span>
            </div>
        </div>

        <!-- Dynamic Grid Content Container -->
        <div id="galleryGridContainer">
            <?= $this->load->view('admin/partials/gallery_grid_items', [
                'images'            => $images,
                'search_query'      => $search_query ?? '',
                'selected_category' => $selected_category ?? 0,
                'selected_status'   => $selected_status ?? ''
            ], TRUE) ?>
        </div>
    </div>

    <!-- Pagination & Entries Count Bar -->
    <div class="pagination-footer-bar rounded-3 border mb-4">
        <div class="pagination-entries-text" id="galleryEntriesText">
            Showing <strong><?= $from_entry ?></strong> to <strong><?= $to_entry ?></strong> of <strong><?= $total_filtered ?></strong> image(s)
        </div>
        <div id="galleryPaginationContainer">
            <?= $pagination_html ?>
        </div>
    </div>


</div>

<!-- ==========================================
     MODAL: ADD NEW GALLERY IMAGE
========================================== -->
<div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <form action="<?= base_url('admin/gallery/add') ?>" method="POST" enctype="multipart/form-data" id="addImageForm">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="addImageModalLabel">
                        <i class="fa-solid fa-cloud-arrow-up text-danger me-2" style="color: var(--primary-red) !important;"></i>Add Gallery Image
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark mb-1">
                            Select Image File <span class="text-danger">*</span>
                        </label>
                        <div class="image-dropzone" id="addDropzone">
                            <input type="file" name="image" id="add_gal_image" accept="image/jpeg,image/png,image/webp" required>
                            <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                            <div class="fw-semibold text-dark small">Click or drag image here to upload</div>
                            <div class="text-muted" style="font-size: 0.75rem;">JPG, PNG, WEBP (Max 5MB)</div>
                        </div>
                        <div class="preview-container d-none" id="add_gal_preview_box">
                            <img id="add_gal_preview_img" src="#" alt="Preview">
                        </div>
                    </div>

                    <!-- Title / Caption -->
                    <div class="mb-3">
                        <label for="add_gal_caption" class="form-label fw-bold small text-dark mb-1">
                            Title / Caption
                        </label>
                        <input type="text" class="form-control" name="title_caption" id="add_gal_caption" placeholder="e.g., Annual Distributor Meet 2026" maxlength="150">
                        <small class="text-muted" style="font-size: 0.72rem;">Optional description displayed beneath the image.</small>
                    </div>

                    <!-- Category & Status -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="add_gal_category" class="form-label fw-bold small text-dark mb-1">
                                Gallery Category <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="category_id" id="add_gal_category" required>
                                <option value="" disabled selected>-- Select Gallery Category --</option>
                                <?php if (!empty($gallery_categories)): ?>
                                    <?php foreach ($gallery_categories as $gc): ?>
                                        <option value="<?= $gc->id ?>"><?= htmlspecialchars($gc->name) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <small class="text-muted" style="font-size: 0.72rem;">Strictly active Gallery categories only.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="add_gal_status" class="form-label fw-bold small text-dark mb-1">
                                Status
                            </label>
                            <select class="form-select" name="status" id="add_gal_status">
                                <option value="active" selected>Active (Visible)</option>
                                <option value="inactive">Inactive (Hidden)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                        <i class="fa-solid fa-check me-1"></i> Upload Image
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: EDIT GALLERY IMAGE
========================================== -->
<div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0">
            <form action="" method="POST" enctype="multipart/form-data" id="editImageForm">
                <input type="hidden" name="id" id="edit_gal_id" value="">

                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="editImageModalLabel">
                        <i class="fa-solid fa-pen-to-square text-danger me-2" style="color: var(--primary-red) !important;"></i>Edit Gallery Item
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Image Upload & Current Image Preview -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark mb-1">
                            Gallery Image
                        </label>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <div class="preview-container mt-0" style="height: 110px;">
                                    <img id="edit_current_gal_img" src="#" alt="Current Image">
                                </div>
                                <small class="text-muted d-block text-center mt-1" style="font-size: 0.75rem;">Current Image</small>
                            </div>
                            <div class="col-md-7">
                                <div class="image-dropzone" id="editDropzone">
                                    <input type="file" name="image" id="edit_gal_image" accept="image/jpeg,image/png,image/webp">
                                    <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                                    <div class="fw-semibold text-dark small">Upload replacement image</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Leave empty to keep existing image &bull; Max 5MB</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Title / Caption -->
                    <div class="mb-3">
                        <label for="edit_gal_caption" class="form-label fw-bold small text-dark mb-1">
                            Title / Caption
                        </label>
                        <input type="text" class="form-control" name="title_caption" id="edit_gal_caption" maxlength="150">
                    </div>

                    <!-- Category & Status -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_gal_category" class="form-label fw-bold small text-dark mb-1">
                                Gallery Category <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="category_id" id="edit_gal_category" required>
                                <option value="" disabled>-- Select Gallery Category --</option>
                                <?php if (!empty($gallery_categories)): ?>
                                    <?php foreach ($gallery_categories as $gc): ?>
                                        <option value="<?= $gc->id ?>"><?= htmlspecialchars($gc->name) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_gal_status" class="form-label fw-bold small text-dark mb-1">
                                Status
                            </label>
                            <select class="form-select" name="status" id="edit_gal_status">
                                <option value="active">Active (Visible)</option>
                                <option value="inactive">Inactive (Hidden)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--primary-red); border-color: var(--primary-red); font-weight: 600;">
                        <i class="fa-solid fa-check me-1"></i> Update Gallery Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     SCRIPTS: GALLERY AJAX, MODALS & PREVIEWS
========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const baseUrl = '<?= base_url() ?>';

    // Elements for AJAX
    const filterForm         = document.getElementById('galleryFilterForm');
    const filterQ            = document.getElementById('gallery_filter_q');
    const clearSearchBtn     = document.getElementById('clearGallerySearchBtn');
    const filterCategory     = document.getElementById('gallery_filter_category_id');
    const filterStatus       = document.getElementById('gallery_filter_status');
    const filterPerPage      = document.getElementById('gallery_filter_per_page');
    const resetFiltersBtn    = document.getElementById('resetGalleryFiltersBtn');
    const gridContainer      = document.getElementById('galleryGridContainer');
    const gridOverlay        = document.getElementById('galleryGridOverlay');
    const paginationBox      = document.getElementById('galleryPaginationContainer');
    const entriesText        = document.getElementById('galleryEntriesText');

    let searchTimer = null;
    let currentPage = <?= (int)($current_page ?? 1) ?>;

    // AJAX Fetch Gallery
    function fetchGallery(page = 1) {
        currentPage = page;

        if (gridOverlay) {
            gridOverlay.classList.remove('d-none');
            gridOverlay.classList.add('d-flex');
        }

        const params = new URLSearchParams();
        if (filterQ && filterQ.value.trim() !== '') {
            params.set('q', filterQ.value.trim());
        }
        if (filterCategory && filterCategory.value !== '0') {
            params.set('category_id', filterCategory.value);
        }
        if (filterStatus && filterStatus.value !== '') {
            params.set('status', filterStatus.value);
        }
        if (filterPerPage && filterPerPage.value !== '') {
            params.set('per_page', filterPerPage.value);
        }
        params.set('page', page);
        params.set('ajax', '1');

        const requestUrl = baseUrl + 'admin/gallery?' + params.toString();

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
                if (gridContainer) gridContainer.innerHTML = data.html;
                if (paginationBox) paginationBox.innerHTML = data.pagination;
                if (entriesText) {
                    entriesText.innerHTML = (data.total > 0)
                        ? `Showing <strong>${data.from}</strong> to <strong>${data.to}</strong> of <strong>${data.total}</strong> image(s)`
                        : 'No images found';
                }
            }
        })
        .catch(err => {
            console.error('Error fetching gallery:', err);
        })
        .finally(() => {
            if (gridOverlay) {
                gridOverlay.classList.add('d-none');
                gridOverlay.classList.remove('d-flex');
            }
        });
    }

    // Debounced search
    if (filterQ) {
        filterQ.addEventListener('input', function() {
            if (clearSearchBtn) {
                clearSearchBtn.classList.toggle('d-none', !this.value.trim());
            }
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                fetchGallery(1);
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
            fetchGallery(1);
        });
    }

    // Selects
    [filterCategory, filterStatus, filterPerPage].forEach(el => {
        if (el) {
            el.addEventListener('change', function() {
                fetchGallery(1);
            });
        }
    });

    // Reset filters
    function resetAllFilters() {
        if (filterQ) filterQ.value = '';
        if (clearSearchBtn) clearSearchBtn.classList.add('d-none');
        if (filterCategory) filterCategory.value = '0';
        if (filterStatus) filterStatus.value = '';
        if (filterPerPage) filterPerPage.value = '12';
        fetchGallery(1);
    }

    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', resetAllFilters);
    }

    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'resetGalleryFiltersBtn') {
            resetAllFilters();
        }
    });

    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetchGallery(1);
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
                    fetchGallery(targetPage);
                }
            }
        });
    }

    // 1. ADD IMAGE PREVIEW
    const addImgInput = document.getElementById('add_gal_image');
    const addPreviewBox = document.getElementById('add_gal_preview_box');
    const addPreviewImg = document.getElementById('add_gal_preview_img');

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
    const editImgInput = document.getElementById('edit_gal_image');
    const editCurrentImg = document.getElementById('edit_current_gal_img');

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

    // 3. IMAGE PREVIEW LIGHTBOX (Event Delegation)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-view');
        if (!btn) return;

        e.preventDefault();
        const imgUrl = btn.getAttribute('href');
        const card = btn.closest('.gallery-card');
        const caption = card ? (card.dataset.caption || 'Gallery Image') : 'Gallery Image';

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: caption,
                imageUrl: imgUrl,
                imageAlt: caption,
                showCloseButton: true,
                showConfirmButton: false,
                width: 'auto',
                customClass: {
                    popup: 'swal2-nandani-popup'
                }
            });
        } else {
            window.open(imgUrl, '_blank');
        }
    });

    // 4. EDIT GALLERY MODAL POPULATION (Event Delegation)
    const editModalEl = document.getElementById('editImageModal');
    const editModal = editModalEl ? new bootstrap.Modal(editModalEl) : null;
    const editForm = document.getElementById('editImageForm');

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-edit-gallery');
        if (!btn) return;

        e.stopPropagation();
        const card = btn.closest('.gallery-card');
        if (!card) return;

        const id = card.dataset.id;
        const caption = card.dataset.caption || '';
        const categoryId = card.dataset.categoryId || '';
        const status = card.dataset.status || 'active';
        const image = card.dataset.image || '';

        // Populate form
        if (editForm) {
            editForm.action = baseUrl + 'admin/gallery/edit/' + id;
            document.getElementById('edit_gal_id').value = id;
            document.getElementById('edit_gal_caption').value = caption;
            document.getElementById('edit_gal_category').value = categoryId;
            document.getElementById('edit_gal_status').value = status;
            document.getElementById('edit_current_gal_img').src = image;

            // Reset file input
            if (editImgInput) editImgInput.value = '';

            if (editModal) editModal.show();
        }
    });
});
</script>
