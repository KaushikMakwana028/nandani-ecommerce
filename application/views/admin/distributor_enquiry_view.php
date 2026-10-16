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

    .badge-interest {
        font-size: 0.74rem;
        font-weight: 600;
        background-color: #FEF3C7;
        color: #92400E;
        padding: 3px 8px;
        border-radius: 6px;
        display: inline-block;
        border: 1px solid #FDE68A;
    }

    .badge-storage {
        font-size: 0.74rem;
        font-weight: 500;
        background-color: #F3F4F6;
        color: #4B5563;
        padding: 3px 8px;
        border-radius: 6px;
        display: inline-block;
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
            <h1 class="enquiry-title">Dealer Applications</h1>
            <p class="text-muted small mb-0 mt-1">Review dealership franchise applications, warehouse capacity, and dealer proposals.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('admin/enquiries/export/distributor?status=' . $status_filter) ?>" 
               class="btn btn-outline-success d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold"
               title="Export filtered dealer applications to CSV">
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
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark lh-1 fs-5"><?= $counts['all'] ?></div>
                    <small class="text-muted" style="font-size: 0.75rem;">Total Applications</small>
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
                    <small class="text-muted" style="font-size: 0.75rem;">New / Unreviewed</small>
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
                    <small class="text-muted" style="font-size: 0.75rem;">In Discussion</small>
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
                    <small class="text-muted" style="font-size: 0.75rem;">Closed / Finalized</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar Above Table -->
    <div class="admin-filter-card mb-4">
        <form id="distributorFilterForm">
            <!-- Top Tier: Status Filter Pills on Left, Show/Reset on Right -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pb-3 mb-3 border-bottom">
                <div class="status-filter-pills" id="distributorStatusPills">
                    <button type="button" class="filter-pill-btn <?= ($status_filter === 'all') ? 'active' : '' ?>" data-status="all">
                        <span>All</span>
                        <span class="filter-pill-count" id="count-pill-all"><?= $counts['all'] ?></span>
                    </button>
                    <button type="button" class="filter-pill-btn <?= ($status_filter === 'new') ? 'active' : '' ?>" data-status="new">
                        <span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 0.55rem;"></i></span>
                        <span>New</span>
                        <span class="filter-pill-count" id="count-pill-new"><?= $counts['new'] ?></span>
                    </button>
                    <button type="button" class="filter-pill-btn <?= ($status_filter === 'contacted') ? 'active' : '' ?>" data-status="contacted">
                        <span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 0.55rem;"></i></span>
                        <span>Contacted</span>
                        <span class="filter-pill-count" id="count-pill-contacted"><?= $counts['contacted'] ?></span>
                    </button>
                    <button type="button" class="filter-pill-btn <?= ($status_filter === 'closed') ? 'active' : '' ?>" data-status="closed">
                        <span class="text-secondary"><i class="fa-solid fa-circle" style="font-size: 0.55rem;"></i></span>
                        <span>Closed</span>
                        <span class="filter-pill-count" id="count-pill-closed"><?= $counts['closed'] ?></span>
                    </button>
                </div>

                <div class="d-flex align-items-center gap-2 ms-auto">
                    <span class="text-muted small d-none d-sm-inline">Show:</span>
                    <select class="form-select form-select-sm filter-control" name="per_page" id="distributor_filter_per_page" title="Items per page" style="width: auto; min-width: 95px;">
                        <option value="10" <?= ($per_page == 10) ? 'selected' : '' ?>>10 / page</option>
                        <option value="25" <?= ($per_page == 25) ? 'selected' : '' ?>>25 / page</option>
                        <option value="50" <?= ($per_page == 50) ? 'selected' : '' ?>>50 / page</option>
                        <option value="100" <?= ($per_page == 100) ? 'selected' : '' ?>>100 / page</option>
                    </select>
                    <button type="button" class="btn-filter-reset" id="resetDistributorFiltersBtn" title="Reset all filters">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Reset</span>
                    </button>
                </div>
            </div>

            <!-- Lower Tier: Search Input + Product Line Dropdown -->
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md-7 col-lg-8">
                    <div class="filter-search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" class="form-control" name="q" id="distributor_filter_q" value="<?= htmlspecialchars($search_query ?? '') ?>" placeholder="Search applicant, firm, phone, city, notes, proposal...">
                        <button type="button" class="btn-clear-search <?= empty($search_query) ? 'd-none' : '' ?>" id="clearDistributorSearchBtn" aria-label="Clear Search">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-4">
                    <select class="form-select filter-control" name="interest" id="distributor_filter_interest">
                        <option value="">All Product Lines</option>
                        <?php if (!empty($interest_list)): ?>
                            <?php foreach ($interest_list as $item): ?>
                                <option value="<?= htmlspecialchars($item->interest) ?>" <?= ($interest_filter === $item->interest) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($item->interest) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Distributor Applications Table Card with Loading Overlay -->
    <div class="enquiry-table-card mb-4 position-relative">
        <!-- Loading Overlay -->
        <div id="distributorTableOverlay" class="position-absolute w-100 h-100 top-0 start-0 d-none justify-content-center align-items-center" style="background: rgba(255,255,255,0.7); z-index: 10; backdrop-filter: blur(1px); border-radius: 14px; min-height: 200px;">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading applications...</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-enquiries" id="distributorEnquiriesTable">
                <thead>
                    <tr>
                        <th style="width: 70px;">Ref #</th>
                        <th style="min-width: 150px;">Applicant & Firm</th>
                        <th style="min-width: 140px;">Contact & Location</th>
                        <th style="min-width: 140px;">Dealership Profile</th>
                        <th style="min-width: 160px;">Notes / Proposal</th>
                        <th style="width: 115px;">Status</th>
                        <th style="min-width: 110px;">Submitted On</th>
                        <th style="width: 75px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="distributorTableBody">
                    <?= $this->load->view('admin/partials/distributor_enquiry_table_rows', [
                        'enquiries'    => $enquiries,
                        'search_query' => $search_query ?? ''
                    ], TRUE) ?>
                </tbody>
            </table>
        </div>

        <!-- Table Card Footer Pagination -->
        <div class="pagination-footer-bar">
            <div class="pagination-entries-text" id="distributorEntriesText">
                Showing <strong><?= $from_entry ?></strong> to <strong><?= $to_entry ?></strong> of <strong><?= $total_filtered ?></strong> application(s)
            </div>
            <div id="distributorPaginationContainer">
                <?= $pagination_html ?>
            </div>
        </div>
    </div>


</div>

<!-- Modal: View Full Distributor Application Details -->
<div class="modal fade" id="distributorDetailModal" tabindex="-1" aria-labelledby="distributorDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="modal-header border-bottom px-4 py-3 bg-light">
                <div class="d-flex align-items-center gap-2">
                    <span id="modalRefBadge" class="badge-ref fs-6">#REF</span>
                    <h5 class="modal-title fw-bold text-dark fs-5 mb-0" id="distributorDetailModalLabel">Dealership Application Details</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="detail-item-label">Applicant Name</div>
                        <div class="detail-item-value fs-5" id="modalName">—</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-item-label">Business / Firm Name</div>
                        <div class="detail-item-value text-primary fs-5" id="modalBusiness">—</div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="detail-item-label">Phone Number</div>
                        <div class="detail-item-value">
                            <a id="modalPhoneLink" href="#" class="text-decoration-none text-success d-inline-flex align-items-center gap-1">
                                <i class="fa-solid fa-phone"></i>
                                <span id="modalPhone">—</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="detail-item-label">Email Address</div>
                        <div class="detail-item-value">
                            <a id="modalEmailLink" href="#" class="text-decoration-none text-primary d-inline-flex align-items-center gap-1">
                                <i class="fa-regular fa-envelope"></i>
                                <span id="modalEmail">—</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="detail-item-label">Territory / Location</div>
                        <div class="detail-item-value d-inline-flex align-items-center gap-1">
                            <i class="fa-solid fa-location-dot text-danger opacity-75"></i>
                            <span id="modalLocation">—</span>
                        </div>
                    </div>
                </div>

                <!-- Dealership Specifics -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 bg-light border">
                            <div class="detail-item-label"><i class="fa-solid fa-tags text-warning me-1"></i> Interested Product Line</div>
                            <div class="detail-item-value mt-1" id="modalInterest">—</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 bg-light border">
                            <div class="detail-item-label"><i class="fa-solid fa-warehouse text-secondary me-1"></i> Available Storage / Warehouse</div>
                            <div class="detail-item-value mt-1" id="modalStorage">—</div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="detail-item-label mb-2">Applicant Proposal & Experience Notes</div>
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

<!-- JavaScript: AJAX Filtering, Pagination, Status Dropdown & Detail Modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const baseUrl         = '<?= base_url() ?>';
    const updateStatusUrl = baseUrl + 'admin/enquiries/update-status';

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

    // Filter Elements
    const filterForm       = document.getElementById('distributorFilterForm');
    const filterQ          = document.getElementById('distributor_filter_q');
    const clearSearchBtn   = document.getElementById('clearDistributorSearchBtn');
    const filterInterest   = document.getElementById('distributor_filter_interest');
    const filterPerPage    = document.getElementById('distributor_filter_per_page');
    const resetFiltersBtn  = document.getElementById('resetDistributorFiltersBtn');
    const tableBody        = document.getElementById('distributorTableBody');
    const tableOverlay     = document.getElementById('distributorTableOverlay');
    const paginationBox    = document.getElementById('distributorPaginationContainer');
    const entriesText      = document.getElementById('distributorEntriesText');
    const statusPillsWrap  = document.getElementById('distributorStatusPills');

    let currentStatus = '<?= $status_filter ?>';
    let searchTimer   = null;

    // AJAX Fetch Distributor Applications
    function fetchDistributorEnquiries(page = 1) {
        if (tableOverlay) {
            tableOverlay.classList.remove('d-none');
            tableOverlay.classList.add('d-flex');
        }

        const params = new URLSearchParams();
        if (filterQ && filterQ.value.trim() !== '') {
            params.set('q', filterQ.value.trim());
        }
        if (currentStatus && currentStatus !== 'all') {
            params.set('status', currentStatus);
        }
        if (filterInterest && filterInterest.value !== '') {
            params.set('interest', filterInterest.value);
        }
        if (filterPerPage && filterPerPage.value !== '') {
            params.set('per_page', filterPerPage.value);
        }
        params.set('page', page);
        params.set('ajax', '1');

        const requestUrl = baseUrl + 'admin/enquiries/distributor?' + params.toString();

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
                if (tableBody) tableBody.innerHTML = data.html;
                if (paginationBox) paginationBox.innerHTML = data.pagination;
                if (entriesText) {
                    entriesText.innerHTML = (data.total > 0)
                        ? `Showing <strong>${data.from}</strong> to <strong>${data.to}</strong> of <strong>${data.total}</strong> application(s)`
                        : 'No applications found';
                }
            }
        })
        .catch(err => {
            console.error('Error fetching distributor applications:', err);
        })
        .finally(() => {
            if (tableOverlay) {
                tableOverlay.classList.add('d-none');
                tableOverlay.classList.remove('d-flex');
            }
        });
    }

    // Status Pills Click Handler
    if (statusPillsWrap) {
        statusPillsWrap.addEventListener('click', function(e) {
            const btn = e.target.closest('.filter-pill-btn');
            if (!btn) return;
            e.preventDefault();

            statusPillsWrap.querySelectorAll('.filter-pill-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            currentStatus = btn.getAttribute('data-status') || 'all';
            fetchDistributorEnquiries(1);
        });
    }

    // Search input debounce
    if (filterQ) {
        filterQ.addEventListener('input', function() {
            if (clearSearchBtn) {
                clearSearchBtn.classList.toggle('d-none', !this.value.trim());
            }
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                fetchDistributorEnquiries(1);
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
            fetchDistributorEnquiries(1);
        });
    }

    // Select Changes
    [filterInterest, filterPerPage].forEach(el => {
        if (el) {
            el.addEventListener('change', function() {
                fetchDistributorEnquiries(1);
            });
        }
    });

    // Reset Filters
    function resetAllFilters() {
        if (filterQ) filterQ.value = '';
        if (clearSearchBtn) clearSearchBtn.classList.add('d-none');
        if (filterInterest) filterInterest.value = '';
        if (filterPerPage) filterPerPage.value = '10';
        currentStatus = 'all';
        if (statusPillsWrap) {
            statusPillsWrap.querySelectorAll('.filter-pill-btn').forEach(b => {
                if (b.getAttribute('data-status') === 'all') {
                    b.classList.add('active');
                } else {
                    b.classList.remove('active');
                }
            });
        }
        fetchDistributorEnquiries(1);
    }

    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', resetAllFilters);
    }

    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetchDistributorEnquiries(1);
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
                    fetchDistributorEnquiries(targetPage);
                }
            }
        });
    }

    // Update Badge UI helper
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
        formData.append('type', 'distributor');
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

    // Status Dropdown Click Delegation
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

    // Detail Modal Population (Event Delegation for AJAX rows)
    const detailModalEl = document.getElementById('distributorDetailModal');
    const detailModal = detailModalEl ? new bootstrap.Modal(detailModalEl) : null;

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-open-modal');
        if (!btn) return;

        e.preventDefault();
        const dataset = btn.dataset;

        document.getElementById('modalRefBadge').textContent = dataset.ref || '#REF';
        document.getElementById('modalName').textContent = dataset.name || 'N/A';
        document.getElementById('modalBusiness').textContent = dataset.business || 'N/A';
        document.getElementById('modalPhone').textContent = dataset.phone || 'N/A';
        document.getElementById('modalPhoneLink').href = dataset.phone ? 'tel:' + dataset.phone : '#';
        document.getElementById('modalEmail').textContent = dataset.email || 'N/A';
        document.getElementById('modalEmailLink').href = dataset.email ? 'mailto:' + dataset.email : '#';
        
        const locationText = [dataset.city, dataset.state].filter(Boolean).join(', ');
        document.getElementById('modalLocation').textContent = locationText || 'Not Provided';
        document.getElementById('modalInterest').textContent = dataset.interest || 'General Product Range';
        document.getElementById('modalStorage').textContent = dataset.storage || 'Not specified';
        document.getElementById('modalMessage').textContent = dataset.message || 'No notes provided.';
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
</script>
