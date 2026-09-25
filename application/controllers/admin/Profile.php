<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profile Controller
 * Handles Admin Profile Settings and Password Modification
 * Protected by Admin_Controller session and database status checks
 */
class Profile extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'upload']);
    }

    /**
     * Profile Settings Page
     */
    public function index() {
        $user_id = $this->admin_user['id'];
        $user = $this->db->get_where('users', ['id' => $user_id])->row();

        $data = [
            'page_title'  => 'Profile Settings',
            'breadcrumb'  => 'Profile Settings',
            'active_menu' => 'profile',
            'user'        => $user
        ];

        $this->render('profile_view', $data);
    }

    /**
     * Update Profile Information Handler
     */
    public function update() {
        $user_id = $this->admin_user['id'];
        $user = $this->db->get_where('users', ['id' => $user_id])->row();

        if (!$user) {
            $this->session->set_flashdata('error', 'User record not found.');
            redirect('admin/login');
            return;
        }

        // Server-side validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|max_length[150]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|max_length[20]');
        $this->form_validation->set_rules('address', 'Address', 'trim|max_length[500]');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'page_title'  => 'Profile Settings',
                'breadcrumb'  => 'Profile Settings',
                'active_menu' => 'profile',
                'user'        => $user
            ];
            $this->render('profile_view', $data);
            return;
        }

        $name = $this->input->post('name', TRUE);
        $email = $this->input->post('email', TRUE);
        $phone = $this->input->post('phone', TRUE) ?: '';
        $address = $this->input->post('address', TRUE) ?: '';

        // Check if email changed and is already taken by another user
        if ($email !== $user->email) {
            $existing = $this->db->where('email', $email)
                                 ->where('id !=', $user_id)
                                 ->get('users')
                                 ->row();
            if ($existing) {
                $this->session->set_flashdata('error', 'This email address is already in use by another account.');
                redirect('admin/profile');
                return;
            }
        }

        $update_data = [
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'address' => $address
        ];

        // Handle Profile Image Upload (Optional)
        if (!empty($_FILES['profile_image']['name'])) {
            $upload_path = FCPATH . 'uploads/avatars/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, TRUE);
            }

            $config = [
                'upload_path'   => $upload_path,
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size'      => 2048, // 2MB max
                'file_name'     => 'avatar_' . $user_id . '_' . time(),
                'overwrite'     => TRUE
            ];

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('profile_image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('admin/profile');
                return;
            } else {
                $upload_res = $this->upload->data();
                $update_data['profile_image'] = 'uploads/avatars/' . $upload_res['file_name'];
            }
        }

        // Note: role and status are deliberately excluded — never editable from this page.
        $this->db->where('id', $user_id)->update('users', $update_data);

        $this->session->set_flashdata('success', 'Profile settings updated successfully!');
        redirect('admin/profile');
    }

    /**
     * Change Password Page
     */
    public function change_password() {
        $data = [
            'page_title'  => 'Change Password',
            'breadcrumb'  => 'Change Password',
            'active_menu' => 'change_password'
        ];

        $this->render('change_password_view', $data);
    }

    /**
     * Update Password Handler
     */
    public function update_password() {
        $user_id = $this->admin_user['id'];
        $user = $this->db->get_where('users', ['id' => $user_id])->row();

        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('admin/login');
            return;
        }

        // Server-side validation
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[new_password]', [
            'matches' => 'The Confirm New Password does not match the New Password.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'page_title'  => 'Change Password',
                'breadcrumb'  => 'Change Password',
                'active_menu' => 'change_password'
            ];
            $this->render('change_password_view', $data);
            return;
        }

        $current_password = $this->input->post('current_password');
        $new_password     = $this->input->post('new_password');

        // Server-side: verify Current Password matches the stored hash BEFORE accepting the new one
        if (!password_verify($current_password, $user->password)) {
            $this->session->set_flashdata('error', 'Your current password does not match our records. Nothing was changed.');
            redirect('admin/change-password');
            return;
        }

        // Re-hash new password with strong bcrypt algorithm
        $new_hash = password_hash($new_password, PASSWORD_BCRYPT);

        // Update database through parameterized query
        $this->db->where('id', $user_id)->update('users', [
            'password' => $new_hash
        ]);

        $this->session->set_flashdata('success', 'Your password has been changed successfully!');
        redirect('admin/change-password');
    }
}
