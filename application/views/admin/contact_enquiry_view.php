<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page-Scoped Styles inside <style> Tag -->
<style>
    .enquiry-header {
        margin-bottom: 1.5rem;
    }

    .enquiry-title {
        font-family: var(--font-heading, 'Playfair Display', serif);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--dark-text, #1A1A1A);
        margin: 0;
    }

    /* Stat Cards */
    .enquiry-stat-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color, #E5E7EB);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        gap: 14px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .enquiry-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    }

    .stat-icon-wrapper {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .stat-icon-red {
        background-color: rgba(200, 16, 46, 0.1);
        color: var(--primary-red, #C8102E);
    }

    .stat-icon-blue {
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563EB;
    }

    .stat-icon-amber {
        background-color: rgba(217, 119, 6, 0.1);
        color: #D97706;
    }

    .stat-icon-gray {
        background-color: #F3F4F6;
        color: #4B5563;
    }

    /* Action & Filter Toolbar */
    .enquiry-toolbar-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color, #E5E7EB);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .status-filter-pills {
        display: inline-flex;
        background-color: #F3F4F6;
        padding: 4px;
        border-radius: 10px;
        gap: 4px;
        flex-wrap: wrap;
    }

    .filter-pill-btn {
        border: none;
        background: transparent;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 8px;
        color: #4B5563;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .filter-pill-btn:hover {
        color: #111827;
        background-color: rgba(255, 255, 255, 0.6);
    }

    .filter-pill-btn.active {
        background-color: #FFFFFF;
        color: var(--primary-red, #C8102E);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .filter-pill-count {
        font-size: 0.72rem;
        padding: 1px 6px;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.06);
    }

    .filter-pill-btn.active .filter-pill-count {
        background-color: rgba(200, 16, 46, 0.1);
        color: var(--primary-red, #C8102E);
    }

    /* Table Container & Table Styles */
    .enquiry-table-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color, #E5E7EB);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .table-enquiries {
        margin-bottom: 0;
        vertical-align: middle;
        width: 100%;
    }

    .table-enquiries thead th {
        background-color: #F9FAFB;
        color: #4B5563;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 1.15rem;
        border-bottom: 1px solid var(--border-color, #E5E7EB);
        white-space: nowrap;
    }

    .table-enquiries tbody td {
        padding: 1rem 1.15rem;
        font-size: 0.88rem;
        border-bottom: 1px solid #F3F4F6;
        color: #374151;
        background-color: #FFFFFF;
    }

    .table-enquiries tbody tr:last-child td {
        border-bottom: none;
    }

    .table-enquiries tbody tr:hover td {
        background-color: #FBFBFB;
    }

    /* Truncated Message Styling — Never overflow table layout */
    .message-truncate-cell {
        max-width: 220px;
        min-width: 160px;
    }

    .table-responsive {
        min-height: 220px;
    }

    .message-preview-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.83rem;
        color: #4B5563;
        line-height: 1.45;
        margin-bottom: 4px;
        word-break: break-word;
    }

    .btn-view-expand {
        font-size: 0.76rem;
        font-weight: 600;
        color: var(--primary-red, #C8102E);
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
    }

    .btn-view-expand:hover {
        color: var(--dark-red, #9B0D23);
        text-decoration: underline;
    }

    /* Modern Status Pill Dropdown Badge */
    .status-dropdown-wrapper {
        position: relative;
        display: inline-block;
    }

    .status-pill-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.76rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
        background: transparent;
        text-decoration: none !important;
    }

    .status-indicator-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .status-pill-badge.dropdown-toggle::after {
        display: inline-block;
        margin-left: 5px;
        vertical-align: middle;
        content: "";
        border-top: 4px solid currentColor;
        border-right: 3.5px solid transparent;
        border-bottom: 0;
        border-left: 3.5px solid transparent;
        opacity: 0.7;
        transition: transform 0.2s ease;
    }

    .status-pill-badge.dropdown-toggle.show::after {
        transform: rotate(180deg);
    }

    /* Status Color Themes */
    .status-badge-new {
        background-color: #EFF6FF;
        color: #1D4ED8;
        border-color: #BFDBFE;
    }
    .status-badge-new .status-indicator-dot {
        background-color: #2563EB;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
    }
    .status-badge-new:hover {
        background-color: #DBEAFE;
    }

    .status-badge-contacted {
        background-color: #FEF3C7;
        color: #B45309;
        border-color: #FDE68A;
    }
    .status-badge-contacted .status-indicator-dot {
        background-color: #D97706;
        box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.2);
    }
    .status-badge-contacted:hover {
        background-color: #FDE68A;
    }

    .status-badge-closed {
        background-color: #F3F4F6;
        color: #4B5563;
        border-color: #E5E7EB;
    }
    .status-badge-closed .status-indicator-dot {
        background-color: #9CA3AF;
        box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.2);
    }
    .status-badge-closed:hover {
        background-color: #E5E7EB;
    }

    /* Dropdown Menu */
    .status-dropdown-menu {
        border-radius: 12px;
        border: 1px solid #E5E7EB;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        padding: 6px;
        min-width: 145px;
        z-index: 1050;
    }

    .status-dropdown-menu .dropdown-header {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #9CA3AF;
        padding: 4px 10px 6px;
        text-transform: uppercase;
    }

    .status-select-item {
        font-size: 0.82rem;
        font-weight: 500;
        padding: 7px 10px;
        border-radius: 6px;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none !important;
        transition: all 0.15s ease;
    }

    .status-select-item:hover {
        background-color: #F9FAFB;
        color: #111827;
    }

    .status-select-item.active {
        background-color: #F3F4F6;
        font-weight: 600;
        color: #111827;
    }

    .dot-new { background-color: #2563EB; }
    .dot-contacted { background-color: #D97706; }
    .dot-closed { background-color: #9CA3AF; }

    /* Action Buttons */
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: 1px solid var(--border-color, #E5E7EB);
        background-color: #FFFFFF;
        color: #4B5563;
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
        padding: 0;
    }

    .action-btn:hover {
        background-color: #F3F4F6;
        color: var(--dark-text, #1A1A1A);
        border-color: #D1D5DB;
    }

    .action-btn.btn-delete:hover {
        background-color: #FEE2E2;
        color: var(--primary-red, #C8102E);
        border-color: #FCA5A5;
    }

    .action-btn.btn-view:hover {
        background-color: #EFF6FF;
        color: #2563EB;
        border-color: #BFDBFE;
    }

    /* Badges */
    .badge-ref {
        font-family: monospace;
        font-size: 0.76rem;
        background-color: #F3F4F6;
        color: #374151;
        padding: 2px 6px;
        border-radius: 4px;
        border: 1px solid #E5E7EB;
    }

    /* Modal Reading Box */
    .modal-message-card {
        background-color: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-left: 4px solid var(--primary-red, #C8102E);
        border-radius: 8px;
        padding: 1.25rem;
        font-size: 0.92rem;
        line-height: 1.6;
        color: #1F2937;
        white-space: pre-wrap;
        word-break: break-word;
        max-height: 280px;
        overflow-y: auto;
    }

    .detail-item-label {
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6B7280;
        margin-bottom: 2px;
    }

    .detail-item-value {
        font-size: 0.92rem;
        font-weight: 600;
        color: #111827;
        word-break: break-word;
    }
</style>

<div class="container-fluid p-0">

    <!-- Page Header Top -->
    <div class="enquiry-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="enquiry-title">Contact Enquiries</h1>
            <p class="text-muted small mb-0 mt-1">Review, follow up, and manage customer inquiries submitted from the website contact page.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('admin/enquiries/export/contact?status=' . $status_filter) ?>" 
               class="btn btn-outline-success d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold"
               title="Export filtered contact records to CSV">
                <i class="fa-solid fa-file-csv fs-5"></i>
                <span>Export to CSV</span>
            </a>
        </div>
    </div>

    <!-- Stats Quick Cards Row -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="enquiry-stat-card">
                <div class="stat-icon-wrapper stat-icon-red">
                    <i class="fa-solid fa-inbox"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark lh-1 fs-5"><?= $counts['all'] ?></div>
                    <small class="text-muted" style="font-size: 0.75rem;">Total Submissions</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="enquiry-stat-card">
                <div class="stat-icon-wrapper stat-icon-blue">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark lh-1 fs-5"><?= $counts['new'] ?></div>
                    <small class="text-muted" style="font-size: 0.75rem;">New / Unopened</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="enquiry-stat-card">
                <div class="stat-icon-wrapper stat-icon-amber">
                    <i class="fa-solid fa-phone-volume"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark lh-1 fs-5"><?= $counts['contacted'] ?></div>
                    <small class="text-muted" style="font-size: 0.75rem;">Contacted / In Progress</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="enquiry-stat-card">
                <div class="stat-icon-wrapper stat-icon-gray">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark lh-1 fs-5"><?= $counts['closed'] ?></div>
                    <small class="text-muted" style="font-size: 0.75rem;">Closed / Completed</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar Above Table -->
    <div class="enquiry-toolbar-card d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="fw-bold small text-muted text-uppercase letter-spacing-1 me-1">Status Filter:</span>
            <div class="status-filter-pills">
                <a href="<?= base_url('admin/enquiries/contact?status=all') ?>" 
                   class="filter-pill-btn <?= ($status_filter === 'all') ? 'active' : '' ?>">
                    <span>All</span>
                    <span class="filter-pill-count"><?= $counts['all'] ?></span>
                </a>
                <a href="<?= base_url('admin/enquiries/contact?status=new') ?>" 
                   class="filter-pill-btn <?= ($status_filter === 'new') ? 'active' : '' ?>">
                    <span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 0.55rem;"></i></span>
                    <span>New</span>
                    <span class="filter-pill-count"><?= $counts['new'] ?></span>
                </a>
                <a href="<?= base_url('admin/enquiries/contact?status=contacted') ?>" 
                   class="filter-pill-btn <?= ($status_filter === 'contacted') ? 'active' : '' ?>">
                    <span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 0.55rem;"></i></span>
                    <span>Contacted</span>
                    <span class="filter-pill-count"><?= $counts['contacted'] ?></span>
                </a>
                <a href="<?= base_url('admin/enquiries/contact?status=closed') ?>" 
                   class="filter-pill-btn <?= ($status_filter === 'closed') ? 'active' : '' ?>">
                    <span class="text-secondary"><i class="fa-solid fa-circle" style="font-size: 0.55rem;"></i></span>
                    <span>Closed</span>
                    <span class="filter-pill-count"><?= $counts['closed'] ?></span>
                </a>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small">
                Showing <strong><?= count($enquiries) ?></strong> contact record(s)
            </span>
            <?php if ($status_filter !== 'all'): ?>
                <a href="<?= base_url('admin/enquiries/contact?status=all') ?>" class="btn btn-outline-secondary btn-sm px-2 py-1">
                    <i class="fa-solid fa-xmark me-1"></i> Clear Filter
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Contact Enquiries Table -->
    <div class="enquiry-table-card mb-5">
        <div class="table-responsive">
            <table class="table table-enquiries" id="contactEnquiriesTable">
                <thead>
                    <tr>
                        <th style="width: 70px;">Ref #</th>
                        <th style="min-width: 160px;">Sender Details</th>
                        <th style="min-width: 110px;">City</th>
                        <th style="min-width: 140px;">Subject</th>
                        <th style="min-width: 180px;">Message</th>
                        <th style="width: 115px;">Status</th>
                        <th style="min-width: 110px;">Submitted On</th>
                        <th style="width: 75px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
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
                                        <?= ($status_filter !== 'all') ? 'No enquiries match the "' . ucfirst($status_filter) . '" status filter.' : 'Customer queries submitted from the website will appear here.' ?>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal: View Full Contact Message Details -->
<div class="modal fade" id="contactDetailModal" tabindex="-1" aria-labelledby="contactDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="modal-header border-bottom px-4 py-3 bg-light">
                <div class="d-flex align-items-center gap-2">
                    <span id="modalRefBadge" class="badge-ref fs-6">#REF</span>
                    <h5 class="modal-title fw-bold text-dark fs-5 mb-0" id="contactDetailModalLabel">Contact Enquiry Details</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="detail-item-label">Sender Name</div>
                        <div class="detail-item-value fs-5" id="modalName">—</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-item-label">City / Location</div>
                        <div class="detail-item-value d-inline-flex align-items-center gap-1">
                            <i class="fa-solid fa-location-dot text-danger opacity-75"></i>
                            <span id="modalCity">—</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-item-label">Phone Number</div>
                        <div class="detail-item-value">
                            <a id="modalPhoneLink" href="#" class="text-decoration-none text-success d-inline-flex align-items-center gap-1">
                                <i class="fa-solid fa-phone"></i>
                                <span id="modalPhone">—</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-item-label">Email Address</div>
                        <div class="detail-item-value">
                            <a id="modalEmailLink" href="#" class="text-decoration-none text-primary d-inline-flex align-items-center gap-1">
                                <i class="fa-regular fa-envelope"></i>
                                <span id="modalEmail">—</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="detail-item-label">Subject</div>
                    <div class="detail-item-value fw-bold text-dark" id="modalSubject">—</div>
                </div>

                <div>
                    <div class="detail-item-label mb-2">Message Body</div>
                    <div class="modal-message-card" id="modalMessage">
                        —
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mt-4 pt-3 border-top text-muted small">
                    <div>
                        <i class="fa-regular fa-clock me-1"></i> Submitted on: <span id="modalDate" class="fw-semibold text-dark">—</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span>Current Status:</span>
                        <div class="dropdown status-dropdown-wrapper">
                            <button type="button" 
                                    class="status-pill-badge status-badge-new dropdown-toggle" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false" 
                                    id="modalStatusDropdownBtn">
                                <span class="status-indicator-dot"></span>
                                <span class="status-badge-text" id="modalStatusText">New</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm status-dropdown-menu" id="modalStatusMenu">
                                <li class="dropdown-header">Change Status</li>
                                <li>
                                    <a class="dropdown-item status-select-item active" href="javascript:void(0)" data-status="new">
                                        <span class="status-indicator-dot dot-new"></span>
                                        <span>New</span>
                                        <i class="fa-solid fa-check ms-auto text-primary check-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item status-select-item" href="javascript:void(0)" data-status="contacted">
                                        <span class="status-indicator-dot dot-contacted"></span>
                                        <span>Contacted</span>
                                        <i class="fa-solid fa-check ms-auto text-warning check-icon d-none"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item status-select-item" href="javascript:void(0)" data-status="closed">
                                        <span class="status-indicator-dot dot-closed"></span>
                                        <span>Closed</span>
                                        <i class="fa-solid fa-check ms-auto text-secondary check-icon d-none"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-top px-4 py-3 bg-light">
                <button type="button" class="btn btn-outline-secondary px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript: Status Dropdown AJAX Update & Detail Modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const updateStatusUrl = '<?= base_url('admin/enquiries/update-status') ?>';

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });

    function capitalizeFirstLetter(string) {
        if (!string) return '';
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function updateBadgeUI(wrapperEl, newStatus) {
        if (!wrapperEl) return;
        const btn = wrapperEl.querySelector('.status-pill-badge');
        const textSpan = wrapperEl.querySelector('.status-badge-text');
        if (btn) {
            btn.classList.remove('status-badge-new', 'status-badge-contacted', 'status-badge-closed');
            btn.classList.add('status-badge-' + newStatus);
        }
        if (textSpan) {
            textSpan.textContent = capitalizeFirstLetter(newStatus);
        }
        const items = wrapperEl.querySelectorAll('.status-select-item');
        items.forEach(item => {
            const itemStatus = item.getAttribute('data-status');
            const checkIcon = item.querySelector('.check-icon');
            if (itemStatus === newStatus) {
                item.classList.add('active');
                if (checkIcon) checkIcon.classList.remove('d-none');
            } else {
                item.classList.remove('active');
                if (checkIcon) checkIcon.classList.add('d-none');
            }
        });
    }

    function handleStatusUpdate(id, newStatus, currentItemEl) {
        if (!id || !newStatus) return;

        const rowWrapper = document.querySelector(`#statusDropdown-${id}`)?.closest('.status-dropdown-wrapper');
        const modalBtn = document.getElementById('modalStatusDropdownBtn');
        const modalWrapper = modalBtn?.closest('.status-dropdown-wrapper');

        const formData = new FormData();
        formData.append('id', id);
        formData.append('type', 'contact');
        formData.append('status', newStatus);

        fetch(updateStatusUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Server responded with HTTP ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                if (rowWrapper) {
                    updateBadgeUI(rowWrapper, newStatus);
                }
                if (modalBtn && modalBtn.getAttribute('data-id') === String(id)) {
                    updateBadgeUI(modalWrapper, newStatus);
                }
                document.querySelectorAll(`.btn-open-modal[data-id="${id}"]`).forEach(btn => {
                    btn.dataset.status = newStatus;
                });

                Toast.fire({
                    icon: 'success',
                    title: data.message || 'Status updated successfully.'
                });
            } else {
                throw new Error(data.message || 'Unable to update status.');
            }
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Update Failed',
                text: err.message || 'An error occurred while communicating with the server.',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal2-nandani-popup',
                    confirmButton: 'swal2-nandani-btn'
                }
            });
        });
    }

    document.addEventListener('click', function(e) {
        const item = e.target.closest('.status-select-item');
        if (!item) return;

        e.preventDefault();
        let id = item.getAttribute('data-id');
        const newStatus = item.getAttribute('data-status');

        if (!id) {
            const modalBtn = document.getElementById('modalStatusDropdownBtn');
            id = modalBtn ? modalBtn.getAttribute('data-id') : null;
        }

        if (id && newStatus) {
            handleStatusUpdate(id, newStatus, item);
        }
    });

    const detailModalEl = document.getElementById('contactDetailModal');
    const detailModal = detailModalEl ? new bootstrap.Modal(detailModalEl) : null;

    document.querySelectorAll('.btn-open-modal').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const dataset = this.dataset;

            document.getElementById('modalRefBadge').textContent = dataset.ref || '#REF';
            document.getElementById('modalName').textContent = dataset.name || 'N/A';
            document.getElementById('modalCity').textContent = dataset.city || 'Not Provided';
            document.getElementById('modalPhone').textContent = dataset.phone || 'N/A';
            document.getElementById('modalPhoneLink').href = dataset.phone ? 'tel:' + dataset.phone : '#';
            document.getElementById('modalEmail').textContent = dataset.email || 'N/A';
            document.getElementById('modalEmailLink').href = dataset.email ? 'mailto:' + dataset.email : '#';
            document.getElementById('modalSubject').textContent = dataset.subject || 'General Enquiry';
            document.getElementById('modalMessage').textContent = dataset.message || 'No message provided.';
            document.getElementById('modalDate').textContent = dataset.date || 'N/A';

            const modalBtn = document.getElementById('modalStatusDropdownBtn');
            if (modalBtn) {
                modalBtn.setAttribute('data-id', dataset.id);
                const currentStatus = dataset.status || 'new';
                const modalWrapper = modalBtn.closest('.status-dropdown-wrapper');
                updateBadgeUI(modalWrapper, currentStatus);
            }

            if (detailModal) detailModal.show();
        });
    });
});
</script>
