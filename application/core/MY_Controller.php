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

        // Ensure database and session are ready
        $this->load->library(['session']);
        $this->load->helper(['url', 'form', 'html']);
        $this->load->model('General_model');

        // Route Protection: Check if admin is logged in
        $admin_id = $this->session->userdata('admin_id');
        $is_logged_in = $this->session->userdata('admin_logged_in');

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
}
