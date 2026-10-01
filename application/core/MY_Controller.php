<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Application Controller
 */
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
}

/**
 * Base Controller for Admin Panel
 * Provides layout rendering, user session context, breadcrumb and active navigation management
 */
class Admin_Controller extends MY_Controller {

    protected $admin_user = [];

    public function __construct() {
        parent::__construct();

        // Ensure database, session, and cookies are ready
        $this->load->library(['session']);
        $this->load->helper(['url', 'form', 'html', 'cookie']);
        $this->load->model('General_model');

        // Route Protection: Check if admin is logged in via session
        $admin_id = $this->session->userdata('admin_id');
        $is_logged_in = $this->session->userdata('admin_logged_in');

        // Permanent Session Auto-Restore:
        // If session was cleared (e.g. browser restart or PHP GC), check persistent remember token
        if (empty($admin_id) || empty($is_logged_in)) {
            $perm_cookie = $this->input->cookie('nandani_admin_perm', TRUE);
            if (!empty($perm_cookie) && strpos($perm_cookie, ':') !== FALSE) {
                list($cookie_uid, $cookie_hash) = explode(':', $perm_cookie, 2);
                $cookie_user = $this->db->get_where('users', ['id' => (int)$cookie_uid])->row();

                if ($cookie_user && (int)$cookie_user->status === 1 && (int)$cookie_user->role === 1) {
                    $expected_hash = hash_hmac('sha256', $cookie_user->id . $cookie_user->email . $cookie_user->password, $this->config->item('encryption_key'));
                    if (hash_equals($expected_hash, $cookie_hash)) {
                        // Auto-restore permanent session
                        $session_data = [
                            'admin_id'        => $cookie_user->id,
                            'admin_name'      => $cookie_user->name,
                            'admin_email'     => $cookie_user->email,
                            'admin_role'      => 'Admin',
                            'admin_logged_in' => TRUE
                        ];
                        $this->session->set_userdata($session_data);
                        $admin_id = $cookie_user->id;
                        $is_logged_in = TRUE;
                    }
                }
            }
        }

        if (empty($admin_id) || empty($is_logged_in)) {
            $this->session->set_flashdata('error', 'Please log in to access the admin panel.');
            redirect('admin/login');
            exit;
        }

        // Real-Time Security Check: Verify user still exists, status == 1 and role == 1
        // Handles case where account is deactivated mid-session or role is changed
        $current_user = $this->db->get_where('users', ['id' => $admin_id])->row();

        if (!$current_user || (int)$current_user->status !== 1 || (int)$current_user->role !== 1) {
            $this->session->sess_destroy();
            // Start a new session just to show the error
            session_start();
            $_SESSION['error'] = 'Your account has been deactivated or unauthorized. Please log in again.';
            redirect('admin/login');
            exit;
        }

        // Dynamically populate admin user details from live database
        $this->admin_user = [
            'id'            => $current_user->id,
            'name'          => $current_user->name,
            'email'         => $current_user->email,
            'role'          => ((int)$current_user->role === 1) ? 'Admin' : 'User',
            'status'        => ((int)$current_user->status === 1) ? 'Active' : 'Inactive',
            'phone'         => $current_user->phone,
            'address'       => $current_user->address,
            'profile_image' => $current_user->profile_image
        ];
    }

    /**
     * Render an admin view wrapped with shared Header, Sidebar, and Footer layout
     * 
    /**
     * Render an admin view wrapped with shared Header, Sidebar, and Footer layout
     * 
     * @param string $view_name View filename located directly in application/views/admin/
     * @param array  $data      View variables
     */
    protected function render($view_name, $data = []) {
        $data['admin_user']  = $this->admin_user;
        $data['active_menu'] = $data['active_menu'] ?? 'dashboard';
        $data['page_title']  = $data['page_title'] ?? 'Admin Panel';
        $data['breadcrumb']  = $data['breadcrumb'] ?? 'Dashboard';

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/' . $view_name, $data);
        $this->load->view('admin/layout/footer', $data);
    }

    /**
     * Check if current request is AJAX
     */
    protected function is_ajax() {
        return $this->input->is_ajax_request() ||
               ($this->input->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest') ||
               ($this->input->get('ajax') === '1');
    }

    /**
     * Generate Bootstrap 5 server-side AJAX Pagination HTML matching Nandani theme
     * Supports:
     * - First pages: 1 2 3 ... [last]
     * - Middle pages: 1 ... 4 5 6 ... [last]
     * - Last pages: 1 ... 7 8 9
     * - Includes Prev (preview) and Next buttons
     */
    protected function build_pagination($total_rows, $per_page, $current_page) {
        $total_rows   = max(0, (int)$total_rows);
        $per_page     = max(1, (int)$per_page);
        $total_pages  = (int)ceil($total_rows / $per_page);
        $current_page = max(1, min((int)$current_page, max(1, $total_pages)));

        if ($total_rows <= 0) {
            return '';
        }

        $html = '<ul class="pagination nandani-pagination mb-0">';

        // Previous button
        if ($current_page > 1) {
            $prev = $current_page - 1;
            $html .= '<li class="page-item"><a class="page-link page-link-prev" href="#" data-page="' . $prev . '" aria-label="Previous"><i class="fa-solid fa-chevron-left me-1"></i> Prev</a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link page-link-prev" aria-disabled="true"><i class="fa-solid fa-chevron-left me-1"></i> Prev</span></li>';
        }

        // Determine pages array to render
        $items = [];
        if ($total_pages <= 5) {
            for ($i = 1; $i <= $total_pages; $i++) {
                $items[] = $i;
            }
        } else {
            if ($current_page <= 3) {
                // First case: 1, 2, 3, '...', last
                $items = [1, 2, 3, '...', $total_pages];
            } elseif ($current_page >= ($total_pages - 2)) {
                // Last case: 1, '...', total-2, total-1, total
                $items = [1, '...', $total_pages - 2, $total_pages - 1, $total_pages];
            } else {
                // Middle case: 1, '...', current-1, current, current+1, '...', total
                $items = [1, '...', $current_page - 1, $current_page, $current_page + 1, '...', $total_pages];
            }
        }

        foreach ($items as $item) {
            if ($item === '...') {
                $html .= '<li class="page-item disabled"><span class="page-link page-link-dots">&hellip;</span></li>';
            } elseif ($item === $current_page) {
                $html .= '<li class="page-item active" aria-current="page"><span class="page-link">' . $item . '</span></li>';
            } else {
                $html .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $item . '">' . $item . '</a></li>';
            }
        }

        // Next button
        if ($current_page < $total_pages) {
            $next = $current_page + 1;
            $html .= '<li class="page-item"><a class="page-link page-link-next" href="#" data-page="' . $next . '" aria-label="Next">Next <i class="fa-solid fa-chevron-right ms-1"></i></a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link page-link-next" aria-disabled="true">Next <i class="fa-solid fa-chevron-right ms-1"></i></span></li>';
        }

        $html .= '</ul>';
        return $html;
    }
}
