<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($images)): ?>
    <div class="gallery-grid mb-4" id="galleryGrid">
        <?php foreach ($images as $img): ?>
            <?php $img_url = base_url('uploads/gallery/' . $img->image); ?>
            <div class="gallery-card"
                 data-id="<?= $img->id ?>"
                 data-caption="<?= htmlspecialchars($img->title_caption ?? '', ENT_QUOTES, 'UTF-8') ?>"
                 data-category-id="<?= $img->category_id ?>"
                 data-status="<?= $img->status ?>"
                 data-image="<?= $img_url ?>">
                 
                <!-- Thumbnail Container with Hover Icons -->
                <div class="gallery-thumb-container">
                    <img src="<?= $img_url ?>" alt="<?= htmlspecialchars($img->title_caption ?? 'Gallery Item') ?>" class="gallery-thumb-img" onerror="this.src='https://via.placeholder.com/300x200?text=Gallery+Image';">
                    
                    <!-- Hover Overlay with Edit & Delete Controls -->
                    <div class="gallery-hover-overlay">
                        <a href="<?= $img_url ?>" target="_blank" class="hover-btn btn-view" title="Open Full Image" data-lightbox="gallery">
                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                        </a>
                        <button type="button" class="hover-btn btn-edit-gallery" title="Edit Caption & Category">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <a href="<?= base_url('admin/gallery/delete/' . $img->id) ?>" 
                           class="hover-btn btn-delete text-danger" 
                           title="Delete Image"
                           data-confirm-delete="true"
                           data-item-name="<?= !empty($img->title_caption) ? htmlspecialchars($img->title_caption, ENT_QUOTES, 'UTF-8') : 'this gallery image' ?>">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="gallery-card-body">
                    <div>
                        <?php if (!empty($img->title_caption)): ?>
                            <div class="gallery-caption" title="<?= htmlspecialchars($img->title_caption) ?>">
                                <?= htmlspecialchars($img->title_caption) ?>
                            </div>
                        <?php else: ?>
                            <div class="gallery-caption text-muted fst-italic">
                                Untitled Image
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="gallery-meta">
                        <span class="gallery-cat-tag" title="Category: <?= htmlspecialchars($img->category_name ?? 'Unassigned') ?>">
                            <i class="fa-solid fa-tag text-muted"></i>
                            <?= htmlspecialchars($img->category_name ?? 'Unassigned') ?>
                        </span>

                        <a href="<?= base_url('admin/gallery/toggle-status/' . $img->id) ?>" 
                           class="status-pill <?= $img->status ?>" 
                           title="Click to toggle status">
                            <span class="status-pill-dot"></span>
                            <span><?= ucfirst($img->status) ?></span>
                        </a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center my-4 bg-white">
        <div class="py-4">
            <i class="fa-solid fa-photo-film fa-3x text-muted opacity-50 mb-3"></i>
            <h5 class="fw-bold text-dark mb-1">No Gallery Images Found</h5>
            <p class="text-muted small mb-3">
                <?= (!empty($search_query) || $selected_category > 0 || !empty($selected_status)) ? 'No images match the selected filter criteria.' : 'Upload visual assets to showcase your events, factory, or corporate milestones.' ?>
            </p>
            <button type="button" class="btn btn-outline-secondary btn-sm px-3" id="resetGalleryFiltersBtn">
                Clear Filters
            </button>
        </div>
    </div>
<?php endif; ?>
