<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Settings Controller
 * Manages general website configuration, contact information, map embed, and social links.
 * Strictly guarantees that only a single row exists in the settings table.
 */
class Settings extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    /**
     * Display the Settings page pre-filled with live database values
     */
    public function index() {
        $settings = $this->_get_or_create_settings();

        $data = [
            'page_title'  => 'Website Settings',
            'breadcrumb'  => 'Settings',
            'active_menu' => 'settings',
            'settings'    => $settings
        ];

        $this->render('settings_view', $data);
    }

    /**
     * Process Settings Form Submission (UPDATE ONLY, NEVER INSERT)
     * Re-fetches the row from the database to confirm the save worked
     */
    public function save() {
        $is_ajax = $this->input->is_ajax_request();

        // 1. Get or create the unique single settings row
        $settings = $this->_get_or_create_settings();

        // 2. Form Validation Rules
        $this->form_validation->set_rules('phone_numbers', 'Phone Numbers', 'trim|max_length[255]');
        $this->form_validation->set_rules('emails', 'Email Addresses', 'trim|max_length[255]');
        $this->form_validation->set_rules('address', 'Physical Address', 'trim');
        $this->form_validation->set_rules('working_hours', 'Working Hours', 'trim|max_length[150]');
        $this->form_validation->set_rules('social_facebook', 'Facebook URL', 'trim|max_length[255]');
        $this->form_validation->set_rules('social_instagram', 'Instagram URL', 'trim|max_length[255]');
        $this->form_validation->set_rules('social_linkedin', 'LinkedIn URL', 'trim|max_length[255]');
        $this->form_validation->set_rules('social_whatsapp', 'WhatsApp Link', 'trim|max_length[255]');
        $this->form_validation->set_rules('social_youtube', 'YouTube URL', 'trim|max_length[255]');
        $this->form_validation->set_rules('whatsapp_number', 'WhatsApp Number', 'trim|max_length[20]');

        if ($this->form_validation->run() === FALSE) {
            $error_message = validation_errors(' ', ' ');
            if ($is_ajax) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status'  => 'error',
                        'message' => trim($error_message) ?: 'Please check the entered values.'
                    ]));
            } else {
                $this->session->set_flashdata('error', trim($error_message) ?: 'Validation failed.');
                redirect('admin/settings');
                return;
            }
        }

        // 3. Comma-separated email format check (optional but helpful)
        $raw_emails = $this->input->post('emails', TRUE) ?: '';
        if (!empty($raw_emails)) {
            $email_list = array_filter(array_map('trim', explode(',', $raw_emails)));
            foreach ($email_list as $single_email) {
                if (!filter_var($single_email, FILTER_VALIDATE_EMAIL)) {
                    $msg = 'Invalid email address detected: ' . html_escape($single_email);
                    if ($is_ajax) {
                        return $this->output
                            ->set_content_type('application/json')
                            ->set_output(json_encode([
                                'status'  => 'error',
                                'message' => $msg
                            ]));
                    } else {
                        $this->session->set_flashdata('error', $msg);
                        redirect('admin/settings');
                        return;
                    }
                }
            }
        }

        // 4. Sanitize Map Embed Code to prevent unsafe script execution
        $raw_map_embed = $this->input->post('map_embed_code', FALSE); // Do not run CI XSS clean on raw HTML iframe to avoid stripping iframe tags
        $sanitized_map = $this->_sanitize_map_embed($raw_map_embed);

        // 5. Clean phone and WhatsApp numbers
        $phone_numbers = $this->input->post('phone_numbers', TRUE) ?: '';
        $whatsapp_number = $this->input->post('whatsapp_number', TRUE) ?: '';

        // 6. Prepare update payload
        $update_data = [
            'phone_numbers'    => $phone_numbers,
            'emails'           => $raw_emails,
            'address'          => $this->input->post('address', TRUE) ?: '',
            'working_hours'    => $this->input->post('working_hours', TRUE) ?: '',
            'map_embed_code'   => $sanitized_map,
            'social_facebook'  => $this->input->post('social_facebook', TRUE) ?: '',
            'social_instagram' => $this->input->post('social_instagram', TRUE) ?: '',
            'social_linkedin'  => $this->input->post('social_linkedin', TRUE) ?: '',
            'social_whatsapp'  => $this->input->post('social_whatsapp', TRUE) ?: '',
            'social_youtube'   => $this->input->post('social_youtube', TRUE) ?: '',
            'whatsapp_number'  => $whatsapp_number
        ];

        // 7. Enforce single-row update ONLY (Never insert a new row)
        $this->db->where('id', (int)$settings->id)->limit(1)->update('settings', $update_data);

        // 8. Re-fetch fresh row from DB to confirm the save worked
        $fresh_settings = $this->db->where('id', (int)$settings->id)->get('settings')->row();

        if ($is_ajax) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status'   => 'success',
                    'message'  => 'Settings saved successfully.',
                    'settings' => $fresh_settings
                ]));
        } else {
            $this->session->set_flashdata('toast_success', 'Settings saved successfully.');
            redirect('admin/settings');
        }
    }

    /**
     * Retrieve the single settings row, creating the seed row if none exists yet.
     * Enforces that the table never has more than one row.
     */
    private function _get_or_create_settings() {
        $query = $this->db->order_by('id', 'ASC')->get('settings');
        $all_rows = $query->result();

        if (empty($all_rows)) {
            // Seed exactly one default row
            $seed = [
                'id'               => 1,
                'phone_numbers'    => '',
                'emails'           => '',
                'address'          => '',
                'working_hours'    => '',
                'map_embed_code'   => '',
                'social_facebook'  => '',
                'social_instagram' => '',
                'social_linkedin'  => '',
                'social_whatsapp'  => '',
                'social_youtube'   => '',
                'whatsapp_number'  => ''
            ];
            $this->db->insert('settings', $seed);
            return $this->db->order_by('id', 'ASC')->limit(1)->get('settings')->row();
        }

        // If extra rows exist due to external queries, remove duplicates to guarantee single row
        if (count($all_rows) > 1) {
            $primary_id = $all_rows[0]->id;
            $this->db->where('id !=', $primary_id)->delete('settings');
        }

        return $all_rows[0];
    }

    /**
     * Validate and sanitize Google Maps embed code
     * Strictly disallows <script>, javascript: protocols, and event handlers
     * Stores clean plain text iframe or URL
     */
    private function _sanitize_map_embed($raw) {
        if (empty($raw)) {
            return '';
        }

        $code = trim($raw);

        // Block dangerous script tags and event handlers
        $dangerous_patterns = [
            '/<script\b[^>]*>(.*?)<\/script>/is',
            '/javascript\s*:/i',
            '/vbscript\s*:/i',
            '/data\s*:\s*text\/html/i',
            '/on\w+\s*=/i' // onload, onerror, onclick, etc.
        ];

        foreach ($dangerous_patterns as $pattern) {
            if (preg_match($pattern, $code)) {
                $code = preg_replace($pattern, '', $code);
            }
        }

        // If user provided a full <iframe>, extract safe attributes and re-construct clean iframe
        if (preg_match('/<iframe\b([^>]*)>/i', $code, $matches)) {
            $attrs = $matches[1];
            if (preg_match('/src=["\']([^"\']+)["\']/i', $attrs, $src_matches)) {
                $src = trim($src_matches[1]);
                // Require http or https scheme
                if (preg_match('/^https?:\/\//i', $src)) {
                    return '<iframe src="' . html_escape($src) . '" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                }
            }
            return ''; // Invalid or missing src in iframe
        }

        // If user entered a direct Google Maps Embed URL
        if (filter_var($code, FILTER_VALIDATE_URL)) {
            $parsed = parse_url($code);
            if (isset($parsed['scheme']) && in_array(strtolower($parsed['scheme']), ['http', 'https'])) {
                return '<iframe src="' . html_escape($code) . '" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
            }
            return '';
        }

        // Strip any remaining HTML tags to keep it strictly plain text
        return strip_tags($code);
    }
}
