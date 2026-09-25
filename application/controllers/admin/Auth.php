<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authentication Controller
 * Handles Admin Login, Logout, and Simplified Forgot Password
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form', 'html']);
        $this->load->model('General_model');
    }

    /**
     * Admin Login Page & Authentication Handler
     */
    public function login() {
        // If already logged in, redirect to dashboard
        if ($this->session->userdata('admin_logged_in') && $this->session->userdata('admin_id')) {
            redirect('admin/dashboard');
            return;
        }

        $data = [
            'page_title' => 'Admin Login'
        ];

        // Handle POST submission
        if ($this->input->method() === 'post') {
            // Server-side validation
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() === TRUE) {
                $email = $this->input->post('email', TRUE);
                $password = $this->input->post('password');

                $generic_error = 'Invalid username or password';

                // Server-side check order:
                // 1. Verify email exists
                $user = $this->db->get_where('users', ['email' => $email])->row();

                if (!$user) {
                    $this->session->set_flashdata('login_error', $generic_error);
                    redirect('admin/login');
                    return;
                }

                // 2. Verify password hash matches
                if (!password_verify($password, $user->password)) {
                    $this->session->set_flashdata('login_error', $generic_error);
                    redirect('admin/login');
                    return;
                }

                // 3. Verify status = 1 (Active)
                if ((int)$user->status !== 1) {
                    $this->session->set_flashdata('login_error', $generic_error);
                    redirect('admin/login');
                    return;
                }

                // 4. Verify role = 1 (Admin)
                if ((int)$user->role !== 1) {
                    $this->session->set_flashdata('login_error', $generic_error);
                    redirect('admin/login');
                    return;
                }

                // Regenerate session ID on successful authentication for session fixation protection
                $this->session->sess_regenerate(TRUE);

                // Set secure admin session
                $session_data = [
                    'admin_id'        => $user->id,
                    'admin_name'      => $user->name,
                    'admin_email'     => $user->email,
                    'admin_role'      => 'Admin',
                    'admin_logged_in' => TRUE
                ];
                $this->session->set_userdata($session_data);

                redirect('admin/dashboard');
                return;
            }
        }

        // Standalone login view
        $this->load->view('admin/login_view', $data);
    }

    /**
     * Admin Logout Handler
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    /**
     * Simplified Forgot Password Page & Handler
     */
    public function forgot_password() {
        // TODO: replace with email verification token flow
        // Current simplified flow: verifies email exists, collects new password + confirmation,
        // re-hashes securely, and updates password immediately.

        $data = [
            'page_title' => 'Reset Password'
        ];

        if ($this->input->method() === 'post') {
            // Server-side validation
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[new_password]', [
                'matches' => 'The Confirm New Password does not match the New Password.'
            ]);

            if ($this->form_validation->run() === TRUE) {
                $email = $this->input->post('email', TRUE);
                $new_password = $this->input->post('new_password');

                // Check if account with email exists
                $user = $this->db->get_where('users', ['email' => $email])->row();

                if (!$user) {
                    $this->session->set_flashdata('error', 'No account found with this email address.');
                    redirect('admin/forgot-password');
                    return;
                }

                // Check if account is admin and active
                if ((int)$user->role !== 1 || (int)$user->status !== 1) {
                    $this->session->set_flashdata('error', 'Unable to reset password for this account.');
                    redirect('admin/forgot-password');
                    return;
                }

                // Re-hash password securely with bcrypt
                $new_hash = password_hash($new_password, PASSWORD_BCRYPT);

                // Update users table via parameterized Query Builder
                $this->db->where('id', $user->id)->update('users', [
                    'password' => $new_hash
                ]);

                $this->session->set_flashdata('login_success', 'Password reset successfully! You can now log in with your new password.');
                redirect('admin/login');
                return;
            }
        }

        // Standalone forgot password view
        $this->load->view('admin/forgot_password_view', $data);
    }
}
