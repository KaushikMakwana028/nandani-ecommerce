<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Distributor Controller
 * 
 * Handles the public-facing "Become a Distributor" page and dealership application submissions.
 */
class Distributor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
    }

    /**
     * Display Become a Distributor page
     */
    public function index() {
        // Fetch global settings
        $settings_row = $this->db->get_where('settings', ['id' => 1])->row_array();
        $settings = !empty($settings_row) ? $settings_row : [];

        // Parse phone numbers from settings (avoid dummy data)
        $phone_list = [];
        if (!empty($settings['phone_numbers'])) {
            $raw_phones = explode(',', $settings['phone_numbers']);
            foreach ($raw_phones as $p) {
                $p_clean = trim($p);
                if (!empty($p_clean)) {
                    $phone_list[] = [
                        'display' => $p_clean,
                        'link'    => preg_replace('/[^0-9+]/', '', $p_clean)
                    ];
                }
            }
        }
        $primary_phone = !empty($phone_list) ? $phone_list[0] : null;

        // WhatsApp number from settings
        $whatsapp_clean = '';
        if (!empty($settings['whatsapp_number'])) {
            $whatsapp_clean = preg_replace('/[^0-9]/', '', $settings['whatsapp_number']);
        } elseif (!empty($primary_phone)) {
            $whatsapp_clean = preg_replace('/[^0-9]/', '', $primary_phone['link']);
        }

        // Active Product Categories for dropdown
        $categories = $this->db->where('type', 'product')
                               ->where('status', 'active')
                               ->order_by('sort_order', 'ASC')
                               ->order_by('id', 'ASC')
                               ->get('categories')
                               ->result();

        // Optional prefilled product/category interest from query params
        $prefilled_interest = trim((string)$this->input->get('interest', TRUE));

        $data = [
            'page_title'         => 'Become a Distributor - Nandani | Kitchen Appliance Distribution',
            'meta_description'   => 'Partner with Nandani and become an authorized distributor of India\'s leading kitchen appliance brands. Apply now.',
            'active_menu'        => 'distributor',
            'settings'           => $settings,
            'categories'         => $categories,
            'primary_phone'      => $primary_phone,
            'whatsapp_clean'     => $whatsapp_clean,
            'prefilled_interest' => $prefilled_interest,
            'extra_css'          => ['page-banner.css', 'distributor-page.css'],
            'extra_js'           => ['distributor-form.js']
        ];

        $this->load->view('header', $data);
        $this->load->view('distributor_view', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Handle Distributor Application Submission
     */
    public function submit() {
        $is_ajax = $this->input->is_ajax_request() || 
                   ($this->input->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest') ||
                   (strpos($this->input->server('HTTP_ACCEPT'), 'application/json') !== false);

        // Validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('business_name', 'Business/Firm Name', 'trim|required|min_length[2]|max_length[150]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[7]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|max_length[150]');
        $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('product_interest', 'Product Interest', 'trim|max_length[150]');
        $this->form_validation->set_rules('storage_space', 'Storage Space', 'trim|max_length[100]');
        $this->form_validation->set_rules('message', 'Message', 'trim|max_length[2000]');

        if ($this->form_validation->run() === FALSE) {
            $errors = validation_errors();
            if ($is_ajax) {
                $this->output
                     ->set_content_type('application/json')
                     ->set_output(json_encode([
                         'status'  => 'error',
                         'message' => strip_tags($errors) ? strip_tags($errors) : 'Please fill all required fields correctly.'
                     ]));
                return;
            } else {
                $this->session->set_flashdata('distributor_error', $errors ? $errors : 'Please fill all required fields correctly.');
                redirect('distributor#distributorForm');
                return;
            }
        }

        // Prepare insert data strictly matching distributor_enquiries table schema
        $insert_data = [
            'name'             => $this->input->post('name', TRUE),
            'business_name'    => $this->input->post('business_name', TRUE),
            'phone'            => $this->input->post('phone', TRUE),
            'email'            => $this->input->post('email', TRUE),
            'city'             => $this->input->post('city', TRUE),
            'state'            => $this->input->post('state', TRUE),
            'product_interest' => $this->input->post('product_interest', TRUE) ?: 'All Categories',
            'storage_space'    => $this->input->post('storage_space', TRUE) ?: 'Not Specified',
            'message'          => $this->input->post('message', TRUE),
            'status'           => 'new',
            'created_at'       => date('Y-m-d H:i:s')
        ];

        $inserted = $this->db->insert('distributor_enquiries', $insert_data);

        if ($inserted) {
            $success_message = 'Thank you for your application! Our team will contact you within 24-48 hours.';
            if ($is_ajax) {
                $this->output
                     ->set_content_type('application/json')
                     ->set_output(json_encode([
                         'status'  => 'success',
                         'message' => $success_message
                     ]));
                return;
            } else {
                $this->session->set_flashdata('distributor_success', $success_message);
                redirect('distributor#distributorForm');
                return;
            }
        } else {
            $fail_message = 'Failed to submit your application due to a database error. Please try again.';
            if ($is_ajax) {
                $this->output
                     ->set_content_type('application/json')
                     ->set_output(json_encode([
                         'status'  => 'error',
                         'message' => $fail_message
                     ]));
                return;
            } else {
                $this->session->set_flashdata('distributor_error', $fail_message);
                redirect('distributor#distributorForm');
                return;
            }
        }
    }
}
