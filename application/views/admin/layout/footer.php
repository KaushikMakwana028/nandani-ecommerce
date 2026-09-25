<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        </main>
        <!-- End of Main Content -->

        <!-- Simple Footer Component -->
        <footer class="admin-footer py-3 bg-light border-top text-center mt-auto">
            <div class="container-fluid">
                <small class="text-muted fw-normal" style="font-size: 0.82rem;">
                    Nandani &copy; <?= date('Y') ?> Admin Panel. All rights reserved.
                </small>
            </div>
        </footer>

    </div>
    <!-- End of admin-main -->

</div>
<!-- End of admin-wrapper -->

<!-- Global Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="mb-3 text-danger">
                    <i class="fa-solid fa-triangle-exclamation fa-3x"></i>
                </div>
                <h5 class="modal-title mb-2 fw-bold text-dark" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                <p class="text-muted small mb-4" id="deleteConfirmMessage">Are you sure you want to delete this record? This action cannot be undone.</p>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="deleteConfirmBtn" class="btn btn-danger btn-sm px-3" style="background-color: var(--primary-red); border-color: var(--primary-red);">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5.3.3 Bundle with Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Responsive Sidebar & Global Admin Interactions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        if (toggleBtn) {
            toggleBtn.addEventListener('click', openSidebar);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeSidebar);
        }

        if (backdrop) {
            backdrop.addEventListener('click', closeSidebar);
        }

        // Global Delete confirmation hook
        document.querySelectorAll('[data-confirm-delete]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href') || this.getAttribute('data-delete-url');
                const itemName = this.getAttribute('data-item-name') || 'this item';
                const messageEl = document.getElementById('deleteConfirmMessage');
                const confirmBtn = document.getElementById('deleteConfirmBtn');
                
                if (messageEl) {
                    messageEl.textContent = `Are you sure you want to delete "${itemName}"? This action cannot be undone.`;
                }
                if (confirmBtn) {
                    confirmBtn.setAttribute('href', url);
                }

                const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                modal.show();
            });
        });
    });
</script>

</body>
</html>
