<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Contact Controller (Frontend)
 * Handles "Contact Us" page displaying live contact details from settings,
 * interactive Google Maps embed, social channels, and enquiry submission
 * directly synced with the Admin Enquiry panel.
 */
class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'html', 'text', 'form']);
        $this->load->library(['session', 'form_validation']);
        $this->load->model('General_model');
    }

    /**
     * Display Contact Us Page
     */
    public function index() {
        // Fetch site settings
        $settings_row = $this->db->get_where('settings', ['id' => 1])->row_array();
        $settings = !empty($settings_row) ? $settings_row : [];

        // Parse phone numbers
        $phone_numbers = [];
        $phone_raw_primary = '+911234567890';
        $phone_display_primary = '+91 123 456 7890';
        if (!empty($settings['phone_numbers'])) {
            $raw_phones = array_map('trim', explode(',', $settings['phone_numbers']));
            foreach ($raw_phones as $idx => $p) {
                if (!empty($p)) {
                    $clean = preg_replace('/[^0-9+]/', '', $p);
                    $phone_numbers[] = [
                        'display' => $p,
                        'raw'     => $clean
                    ];
                    if ($idx === 0) {
                        $phone_display_primary = $p;
                        $phone_raw_primary = $clean;
                    }
                }
            }
        }

        // Parse email addresses
        $emails = [];
        $email_primary = 'info@nandani.com';
        if (!empty($settings['emails'])) {
            $raw_emails = array_map('trim', explode(',', $settings['emails']));
            foreach ($raw_emails as $idx => $e) {
                if (!empty($e)) {
                    $emails[] = $e;
                    if ($idx === 0) {
                        $email_primary = $e;
                    }
                }
            }
        }

        // Physical address
        $address = !empty($settings['address'])
            ? $settings['address']
            : "Plot 101, Industrial Area\nRajkot, Gujarat - 360002";

        // Working hours
        $working_hours = !empty($settings['working_hours'])
            ? $settings['working_hours']
            : "Mon - Sat: 9:00 AM - 7:00 PM\nSunday: Closed";

        // Map embed code
        $map_embed_code = !empty($settings['map_embed_code']) ? $settings['map_embed_code'] : '';

        // Fetch active product categories for footer
        $categories = $this->db->where('type', 'product')
                               ->where('status', 'active')
                               ->order_by('sort_order', 'ASC')
                               ->order_by('name', 'ASC')
                               ->get('categories')
                               ->result();

        // Optional pre-filled enquiry parameters (e.g., from products quick view or catalogue)
        $prefill_enquiry = $this->input->get('enquiry', TRUE) ?: '';
        $prefill_subject = $this->input->get('subject', TRUE) ?: (!empty($prefill_enquiry) ? 'Product Enquiry' : 'General Enquiry');

        $data = [
            'page_title'            => 'Contact Us - Nandani | Kitchen Appliance Distributors',
            'meta_description'      => 'Get in touch with Nandani for product enquiries, distributorship opportunities, or general questions.',
            'active_menu'           => 'contact',
            'settings'              => $settings,
            'phone_numbers'         => $phone_numbers,
            'phone_display'         => $phone_display_primary,
            'phone_raw'             => $phone_raw_primary,
            'emails'                => $emails,
            'email_display'         => $email_primary,
            'address'               => $address,
            'working_hours'         => $working_hours,
            'map_embed_code'        => $map_embed_code,
            'categories'            => $categories,
            'prefill_enquiry'       => $prefill_enquiry,
            'prefill_subject'       => $prefill_subject,
            'extra_css'             => ['page-banner.css', 'contact-page.css'],
            'extra_js'              => ['contact-form.js']
        ];

        $this->load->view('header', $data);
        $this->load->view('contact_view', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Submit Contact Form (Handles both AJAX and standard POST)
     */
    public function submit() {
        $is_ajax = $this->input->is_ajax_request();

        // Set Validation Rules
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[7]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|max_length[150]');
        $this->form_validation->set_rules('city', 'City', 'trim|max_length[100]');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|max_length[150]');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[5]|max_length[2000]');

        if ($this->form_validation->run() === FALSE) {
            $errors = validation_errors('<div>', '</div>');
            if ($is_ajax) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status'  => 'error',
                        'message' => $errors
                    ]));
            } else {
                $this->session->set_flashdata('contact_error', $errors);
                redirect('contact');
                return;
            }
        }

        $name    = $this->input->post('name', TRUE);
        $phone   = $this->input->post('phone', TRUE);
        $email   = $this->input->post('email', TRUE);
        $city    = $this->input->post('city', TRUE) ?: '';
        $subject = $this->input->post('subject', TRUE) ?: 'General Enquiry';
        $message = $this->input->post('message', TRUE);

        $insert_data = [
            'name'       => $name,
            'phone'      => $phone,
            'email'      => $email,
            'city'       => $city,
            'subject'    => $subject,
            'message'    => $message,
            'status'     => 'new',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $inserted = $this->General_model->insert('contact_enquiries', $insert_data);

        if ($inserted) {
            $success_msg = "Thank you! Your message has been sent successfully. Our team will get back to you soon.";
            if ($is_ajax) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status'  => 'success',
                        'message' => $success_msg
                    ]));
            } else {
                $this->session->set_flashdata('contact_success', $success_msg);
                redirect('contact');
                return;
            }
        } else {
            $fail_msg = "We were unable to submit your message at this time. Please try again or call us directly.";
            if ($is_ajax) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status'  => 'error',
                        'message' => $fail_msg
                    ]));
            } else {
                $this->session->set_flashdata('contact_error', $fail_msg);
                redirect('contact');
                return;
            }
        }
    }
}
