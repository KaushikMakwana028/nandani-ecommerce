<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        </main>
        <!-- End of Main Content -->

        <!-- Simple Footer Component -->
        <footer class="admin-footer py-3 bg-light border-top text-center mt-auto">
            <div class="container-fluid d-flex align-items-center justify-content-center gap-2 flex-wrap">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="Nandani Logo" style="height: 22px; width: auto; object-fit: contain; opacity: 0.85;">
                <small class="text-muted fw-normal" style="font-size: 0.82rem;">
                    Nandani &copy; <?= date('Y') ?> Admin Panel. All rights reserved.
                </small>
            </div>
        </footer>

    </div>
    <!-- End of admin-main -->

</div>
<!-- End of admin-wrapper -->

<!-- Bootstrap 5.3.3 Bundle with Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert2 Custom Theme Scoped Styles -->
<style>
    .swal2-popup.swal2-nandani-popup {
        border-radius: 16px !important;
        font-family: var(--font-body, 'Poppins', sans-serif) !important;
        padding: 1.75rem !important;
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.16) !important;
        border: 1px solid #E5E7EB !important;
    }

    .swal2-popup.swal2-nandani-popup:not(.swal2-toast) .swal2-title {
        font-family: var(--font-heading, 'Playfair Display', serif) !important;
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: #1A1A1A !important;
        margin-bottom: 0.5rem !important;
    }

    /* Sleek Toast Specific Styling */
    body .swal2-popup.swal2-toast {
        border-radius: 12px !important;
        padding: 0.85rem 1.25rem !important;
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.14) !important;
        border: 1px solid #E5E7EB !important;
        background: #FFFFFF !important;
        width: auto !important;
        max-width: 360px !important;
    }

    body .swal2-popup.swal2-toast .swal2-title {
        font-family: var(--font-body, 'Poppins', sans-serif) !important;
        font-size: 0.88rem !important;
        font-weight: 600 !important;
        color: #1F2937 !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.45 !important;
    }

    body .swal2-popup.swal2-toast .swal2-icon {
        margin: 0 10px 0 0 !important;
        width: 26px !important;
        height: 26px !important;
        min-width: 26px !important;
    }

    body .swal2-popup.swal2-toast .swal2-timer-progress-bar {
        background-color: #10B981 !important;
        height: 3px !important;
    }

    .swal2-html-container {
        font-size: 0.92rem !important;
        color: #4B5563 !important;
        line-height: 1.55 !important;
        margin: 0.75rem 1rem 1.25rem !important;
    }

    /* Icon Customizations */
    .swal2-icon.swal2-success {
        border-color: #10B981 !important;
        color: #10B981 !important;
    }

    .swal2-icon.swal2-success [class^='swal2-success-line'] {
        background-color: #10B981 !important;
    }

    .swal2-icon.swal2-success .swal2-success-ring {
        border-color: rgba(16, 185, 129, 0.3) !important;
    }

    .swal2-icon.swal2-error {
        border-color: var(--primary-red, #C8102E) !important;
        color: var(--primary-red, #C8102E) !important;
    }

    .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
        background-color: var(--primary-red, #C8102E) !important;
    }

    .swal2-icon.swal2-warning {
        border-color: #D4AF37 !important;
        color: #B45309 !important;
    }

    /* Action Buttons */
    .swal2-actions {
        gap: 10px !important;
        margin-top: 0.5rem !important;
    }

    .swal2-nandani-btn {
        background-color: var(--primary-red, #C8102E) !important;
        border-color: var(--primary-red, #C8102E) !important;
        color: #FFFFFF !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.88rem !important;
        padding: 9px 24px !important;
        box-shadow: 0 4px 12px rgba(200, 16, 46, 0.25) !important;
        transition: all 0.2s ease !important;
    }

    .swal2-nandani-btn:hover {
        background-color: var(--dark-red, #9B0D23) !important;
        border-color: var(--dark-red, #9B0D23) !important;
        transform: translateY(-1px) !important;
    }

    .swal2-nandani-cancel {
        background-color: #F3F4F6 !important;
        border-color: #E5E7EB !important;
        color: #374151 !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.88rem !important;
        padding: 9px 22px !important;
        transition: all 0.2s ease !important;
    }

    .swal2-nandani-cancel:hover {
        background-color: #E5E7EB !important;
        color: #111827 !important;
    }

    .swal2-timer-progress-bar {
        background-color: var(--primary-red, #C8102E) !important;
    }
</style>

<!-- Responsive Sidebar, SweetAlert2 Flash Messages & Delete Confirmation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar responsive behavior
        const sidebar = document.getElementById('adminSidebar');
        const toggleBtn = document.getElementById('sidebarToggleBtn');
        const closeBtn = document.getElementById('sidebarCloseBtn');
        const backdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            if (sidebar) sidebar.classList.add('show');
            if (backdrop) backdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            if (sidebar) sidebar.classList.remove('show');
            if (backdrop) backdrop.classList.remove('show');
            document.body.style.overflow = '';
        }

        if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (backdrop) backdrop.addEventListener('click', closeSidebar);

        // Global SweetAlert2 Delete Confirmation Hook
        document.querySelectorAll('[data-confirm-delete]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href') || this.getAttribute('data-delete-url');
                const itemName = this.getAttribute('data-item-name') || 'this item';

                Swal.fire({
                    title: 'Delete Confirmation',
                    html: `Are you sure you want to delete <strong>"${itemName}"</strong>?<br><span class="text-muted small">This action cannot be undone.</span>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa-solid fa-trash-can me-1"></i> Yes, Delete',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                    customClass: {
                        popup: 'swal2-nandani-popup',
                        confirmButton: 'swal2-nandani-btn',
                        cancelButton: 'swal2-nandani-cancel'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });

        // Flashdata Alerts via SweetAlert2 (Single, elegant, themed)
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= addslashes(strip_tags($this->session->flashdata('success'))) ?>',
                timer: 3500,
                timerProgressBar: true,
                confirmButtonText: 'Great!',
                customClass: {
                    popup: 'swal2-nandani-popup',
                    confirmButton: 'swal2-nandani-btn'
                }
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Action Notice',
                html: '<?= addslashes($this->session->flashdata('error')) ?>',
                confirmButtonText: 'Understood',
                customClass: {
                    popup: 'swal2-nandani-popup',
                    confirmButton: 'swal2-nandani-btn'
                }
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('info')): ?>
            Swal.fire({
                icon: 'info',
                title: 'Notice',
                text: '<?= addslashes(strip_tags($this->session->flashdata('info'))) ?>',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal2-nandani-popup',
                    confirmButton: 'swal2-nandani-btn'
                }
            });
        <?php endif; ?>
    });
</script>

</body>
</html>
