<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($enquiries)): ?>
    <?php foreach ($enquiries as $app): ?>
        <tr id="row-distributor-<?= $app->id ?>">
            <!-- Ref # -->
            <td>
                <span class="badge-ref">#DA-<?= str_pad($app->id, 4, '0', STR_PAD_LEFT) ?></span>
            </td>

            <!-- Applicant & Firm -->
            <td>
                <div class="fw-bold text-dark"><?= html_escape($app->name) ?></div>
                <div class="d-inline-flex align-items-center gap-1 text-primary small fw-semibold mt-1">
                    <i class="fa-solid fa-store opacity-75"></i>
                    <span><?= html_escape($app->business_name) ?></span>
                </div>
            </td>

            <!-- Contact & Location -->
            <td>
                <div class="small">
                    <a href="tel:<?= html_escape($app->phone) ?>" class="text-muted text-decoration-none d-inline-flex align-items-center gap-1">
                         <i class="fa-solid fa-phone text-success opacity-75"></i>
                        <span><?= html_escape($app->phone) ?></span>
                    </a>
                </div>
                <div class="small mt-1">
                    <a href="mailto:<?= html_escape($app->email) ?>" class="text-muted text-decoration-none d-inline-flex align-items-center gap-1">
                        <i class="fa-regular fa-envelope text-primary opacity-75"></i>
                        <span><?= html_escape($app->email) ?></span>
                    </a>
                </div>
                <div class="small text-muted mt-1 d-inline-flex align-items-center gap-1">
                    <i class="fa-solid fa-location-dot text-danger opacity-75"></i>
                    <span>
                        <?= html_escape(trim(($app->city ?? '') . (!empty($app->state) ? ', ' . $app->state : ''), ', ')) ?: 'Location not specified' ?>
                    </span>
                </div>
            </td>

            <!-- Dealership Profile -->
            <td>
                <div class="mb-1">
                    <span class="badge-interest" title="Interested Product Line">
                        <i class="fa-solid fa-tag me-1"></i><?= html_escape($app->product_interest ?: 'General Range') ?>
                    </span>
                </div>
                <div>
                    <span class="badge-storage" title="Storage / Warehouse Space">
                        <i class="fa-solid fa-warehouse me-1"></i><?= html_escape($app->storage_space ?: 'Not specified') ?>
                    </span>
                </div>
            </td>

            <!-- Message (Truncated with "View Full" button) -->
            <td class="message-truncate-cell">
                <div class="message-preview-text">
                    <?= !empty($app->message) ? html_escape($app->message) : '<span class="text-muted fst-italic">No additional notes provided</span>' ?>
                </div>
                <button type="button" 
                        class="btn-view-expand btn-open-modal"
                        data-ref="#DA-<?= str_pad($app->id, 4, '0', STR_PAD_LEFT) ?>"
                        data-name="<?= html_escape($app->name) ?>"
                        data-business="<?= html_escape($app->business_name) ?>"
                        data-email="<?= html_escape($app->email) ?>"
                        data-phone="<?= html_escape($app->phone) ?>"
                        data-city="<?= html_escape($app->city ?? 'Not Provided') ?>"
                        data-state="<?= html_escape($app->state ?? 'Not Provided') ?>"
                        data-interest="<?= html_escape($app->product_interest ?? 'General Range') ?>"
                        data-storage="<?= html_escape($app->storage_space ?? 'Not specified') ?>"
                        data-message="<?= html_escape($app->message ?? 'No notes provided.') ?>"
                        data-status="<?= $app->status ?>"
                        data-date="<?= date('M d, Y h:i A', strtotime($app->created_at)) ?>"
                        data-id="<?= $app->id ?>">
                    <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                    <span>View Full Proposal</span>
                </button>
            </td>

            <!-- Status (Dropdown Badge per row) -->
            <td>
                <div class="dropdown status-dropdown-wrapper">
                    <button type="button" 
                            class="status-pill-badge status-badge-<?= $app->status ?> dropdown-toggle" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false" 
                            id="statusDropdown-<?= $app->id ?>"
                            title="Change status for this application">
                        <span class="status-indicator-dot"></span>
                        <span class="status-badge-text"><?= ucfirst($app->status) ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm status-dropdown-menu" aria-labelledby="statusDropdown-<?= $app->id ?>">
                        <li class="dropdown-header">Change Status</li>
                        <li>
                            <a class="dropdown-item status-select-item <?= ($app->status === 'new') ? 'active' : '' ?>" 
                               href="javascript:void(0)" 
                               data-id="<?= $app->id ?>" 
                               data-type="distributor" 
                               data-status="new">
                                <span class="status-indicator-dot dot-new"></span>
                                <span>New</span>
                                <i class="fa-solid fa-check ms-auto text-primary check-icon <?= ($app->status === 'new') ? '' : 'd-none' ?>"></i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item status-select-item <?= ($app->status === 'contacted') ? 'active' : '' ?>" 
                               href="javascript:void(0)" 
                               data-id="<?= $app->id ?>" 
                               data-type="distributor" 
                               data-status="contacted">
                                <span class="status-indicator-dot dot-contacted"></span>
                                <span>Contacted</span>
                                <i class="fa-solid fa-check ms-auto text-warning check-icon <?= ($app->status === 'contacted') ? '' : 'd-none' ?>"></i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item status-select-item <?= ($app->status === 'closed') ? 'active' : '' ?>" 
                               href="javascript:void(0)" 
                               data-id="<?= $app->id ?>" 
                               data-type="distributor" 
                               data-status="closed">
                                <span class="status-indicator-dot dot-closed"></span>
                                <span>Closed</span>
                                <i class="fa-solid fa-check ms-auto text-secondary check-icon <?= ($app->status === 'closed') ? '' : 'd-none' ?>"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>

            <!-- Submitted On -->
            <td>
                <div class="fw-medium text-dark" style="font-size: 0.82rem;">
                    <?= date('M d, Y', strtotime($app->created_at)) ?>
                </div>
                <div class="text-muted" style="font-size: 0.74rem;">
                    <?= date('h:i A', strtotime($app->created_at)) ?>
                </div>
            </td>

            <!-- Actions -->
            <td class="text-center">
                <div class="d-inline-flex align-items-center gap-1">
                    <button type="button" 
                            class="action-btn btn-view btn-open-modal" 
                            title="View Full Details"
                            data-ref="#DA-<?= str_pad($app->id, 4, '0', STR_PAD_LEFT) ?>"
                            data-name="<?= html_escape($app->name) ?>"
                            data-business="<?= html_escape($app->business_name) ?>"
                            data-email="<?= html_escape($app->email) ?>"
                            data-phone="<?= html_escape($app->phone) ?>"
                            data-city="<?= html_escape($app->city ?? 'Not Provided') ?>"
                            data-state="<?= html_escape($app->state ?? 'Not Provided') ?>"
                            data-interest="<?= html_escape($app->product_interest ?? 'General Range') ?>"
                            data-storage="<?= html_escape($app->storage_space ?? 'Not specified') ?>"
                            data-message="<?= html_escape($app->message ?? 'No notes provided.') ?>"
                            data-status="<?= $app->status ?>"
                            data-date="<?= date('M d, Y h:i A', strtotime($app->created_at)) ?>"
                            data-id="<?= $app->id ?>">
                        <i class="fa-regular fa-eye"></i>
                    </button>

                    <a href="<?= base_url('admin/enquiries/delete/distributor/' . $app->id) ?>" 
                       class="action-btn btn-delete text-danger" 
                       title="Delete Application"
                       data-confirm-delete="true"
                       data-item-name="dealership application from <?= html_escape($app->name) ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="8" class="text-center py-5">
            <div class="py-4">
                <i class="fa-solid fa-briefcase fa-3x text-muted opacity-50 mb-3"></i>
                <h5 class="fw-bold text-dark mb-1">No Applications Found</h5>
                <p class="text-muted small mb-0">
                    <?= !empty($search_query) ? 'No dealership applications match "' . html_escape($search_query) . '".' : 'There are currently no distributor applications under this filter selection.' ?>
                </p>
            </div>
        </td>
    </tr>
<?php endif; ?>
