<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($enquiries)): ?>
    <?php foreach ($enquiries as $inq): ?>
        <tr id="row-contact-<?= $inq->id ?>">
            <!-- Ref # -->
            <td>
                <span class="badge-ref">#CE-<?= str_pad($inq->id, 4, '0', STR_PAD_LEFT) ?></span>
            </td>

            <!-- Sender Details -->
            <td>
                <div class="fw-bold text-dark"><?= html_escape($inq->name) ?></div>
                <div class="small mt-1">
                    <a href="mailto:<?= html_escape($inq->email) ?>" class="text-muted text-decoration-none d-inline-flex align-items-center gap-1">
                        <i class="fa-regular fa-envelope text-primary opacity-75"></i>
                        <span><?= html_escape($inq->email) ?></span>
                    </a>
                </div>
                <div class="small">
                    <a href="tel:<?= html_escape($inq->phone) ?>" class="text-muted text-decoration-none d-inline-flex align-items-center gap-1">
                        <i class="fa-solid fa-phone text-success opacity-75"></i>
                        <span><?= html_escape($inq->phone) ?></span>
                    </a>
                </div>
            </td>

            <!-- City -->
            <td>
                <?php if (!empty($inq->city)): ?>
                    <span class="d-inline-flex align-items-center gap-1 text-dark fw-medium">
                        <i class="fa-solid fa-location-dot text-danger opacity-75"></i>
                        <?= html_escape($inq->city) ?>
                    </span>
                <?php else: ?>
                    <span class="text-muted fst-italic">—</span>
                <?php endif; ?>
            </td>

            <!-- Subject -->
            <td>
                <div class="fw-semibold text-dark text-truncate" style="max-width: 170px;" title="<?= html_escape($inq->subject ?? 'General Enquiry') ?>">
                    <?= html_escape($inq->subject ?? 'General Enquiry') ?>
                </div>
            </td>

            <!-- Message (Truncated with "View Full" button) -->
            <td class="message-truncate-cell">
                <div class="message-preview-text">
                    <?= html_escape($inq->message) ?>
                </div>
                <button type="button" 
                        class="btn-view-expand btn-open-modal"
                        data-ref="#CE-<?= str_pad($inq->id, 4, '0', STR_PAD_LEFT) ?>"
                        data-name="<?= html_escape($inq->name) ?>"
                        data-email="<?= html_escape($inq->email) ?>"
                        data-phone="<?= html_escape($inq->phone) ?>"
                        data-city="<?= html_escape($inq->city ?? 'Not Provided') ?>"
                        data-subject="<?= html_escape($inq->subject ?? 'General Enquiry') ?>"
                        data-message="<?= html_escape($inq->message) ?>"
                        data-status="<?= $inq->status ?>"
                        data-date="<?= date('M d, Y h:i A', strtotime($inq->created_at)) ?>"
                        data-id="<?= $inq->id ?>">
                    <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                    <span>View Full Message</span>
                </button>
            </td>

            <!-- Status (Dropdown Badge per row) -->
            <td>
                <div class="dropdown status-dropdown-wrapper">
                    <button type="button" 
                            class="status-pill-badge status-badge-<?= $inq->status ?> dropdown-toggle" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false" 
                            id="statusDropdown-<?= $inq->id ?>"
                            title="Change status for this enquiry">
                        <span class="status-indicator-dot"></span>
                        <span class="status-badge-text"><?= ucfirst($inq->status) ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm status-dropdown-menu" aria-labelledby="statusDropdown-<?= $inq->id ?>">
                        <li class="dropdown-header">Change Status</li>
                        <li>
                            <a class="dropdown-item status-select-item <?= ($inq->status === 'new') ? 'active' : '' ?>" 
                               href="javascript:void(0)" 
                               data-id="<?= $inq->id ?>" 
                               data-type="contact" 
                               data-status="new">
                                <span class="status-indicator-dot dot-new"></span>
                                <span>New</span>
                                <i class="fa-solid fa-check ms-auto text-primary check-icon <?= ($inq->status === 'new') ? '' : 'd-none' ?>"></i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item status-select-item <?= ($inq->status === 'contacted') ? 'active' : '' ?>" 
                               href="javascript:void(0)" 
                               data-id="<?= $inq->id ?>" 
                               data-type="contact" 
                               data-status="contacted">
                                <span class="status-indicator-dot dot-contacted"></span>
                                <span>Contacted</span>
                                <i class="fa-solid fa-check ms-auto text-warning check-icon <?= ($inq->status === 'contacted') ? '' : 'd-none' ?>"></i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item status-select-item <?= ($inq->status === 'closed') ? 'active' : '' ?>" 
                               href="javascript:void(0)" 
                               data-id="<?= $inq->id ?>" 
                               data-type="contact" 
                               data-status="closed">
                                <span class="status-indicator-dot dot-closed"></span>
                                <span>Closed</span>
                                <i class="fa-solid fa-check ms-auto text-secondary check-icon <?= ($inq->status === 'closed') ? '' : 'd-none' ?>"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>

            <!-- Submitted On -->
            <td>
                <div class="fw-medium text-dark" style="font-size: 0.82rem;">
                    <?= date('M d, Y', strtotime($inq->created_at)) ?>
                </div>
                <div class="text-muted" style="font-size: 0.74rem;">
                    <?= date('h:i A', strtotime($inq->created_at)) ?>
                </div>
            </td>

            <!-- Actions -->
            <td class="text-center">
                <div class="d-inline-flex align-items-center gap-1">
                    <button type="button" 
                            class="action-btn btn-view btn-open-modal" 
                            title="View Full Details"
                            data-ref="#CE-<?= str_pad($inq->id, 4, '0', STR_PAD_LEFT) ?>"
                            data-name="<?= html_escape($inq->name) ?>"
                            data-email="<?= html_escape($inq->email) ?>"
                            data-phone="<?= html_escape($inq->phone) ?>"
                            data-city="<?= html_escape($inq->city ?? 'Not Provided') ?>"
                            data-subject="<?= html_escape($inq->subject ?? 'General Enquiry') ?>"
                            data-message="<?= html_escape($inq->message) ?>"
                            data-status="<?= $inq->status ?>"
                            data-date="<?= date('M d, Y h:i A', strtotime($inq->created_at)) ?>"
                            data-id="<?= $inq->id ?>">
                        <i class="fa-regular fa-eye"></i>
                    </button>

                    <a href="<?= base_url('admin/enquiries/delete/contact/' . $inq->id) ?>" 
                       class="action-btn btn-delete text-danger" 
                       title="Delete Enquiry"
                       data-confirm-delete="true"
                       data-item-name="contact enquiry from <?= html_escape($inq->name) ?>">
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
                <i class="fa-regular fa-envelope-open fa-3x text-muted opacity-50 mb-3"></i>
                <h5 class="fw-bold text-dark mb-1">No Contact Enquiries Found</h5>
                <p class="text-muted small mb-0">
                    <?= !empty($search_query) ? 'No contact submissions match "' . html_escape($search_query) . '".' : 'There are currently no enquiries under this filter selection.' ?>
                </p>
            </div>
        </td>
    </tr>
<?php endif; ?>
