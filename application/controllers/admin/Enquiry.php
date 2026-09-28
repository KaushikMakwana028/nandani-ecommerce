<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Enquiry Admin Controller
 * 
 * Manages customer contact inquiries and distributor dealership applications
 * across two dedicated separate pages.
 */
class Enquiry extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('General_model');
    }

    /**
     * Default redirect to Contact Enquiries
     */
    public function index() {
        redirect('admin/enquiries/contact');
    }

    /**
     * PAGE 1: Contact Enquiries Dedicated Page
     */
    public function contact() {
        // Status filter: 'all', 'new', 'contacted', 'closed'
        $status_filter = $this->input->get('status', TRUE);
        if (!in_array($status_filter, ['all', 'new', 'contacted', 'closed'], TRUE)) {
            $status_filter = 'all';
        }

        // Fetch Contact Enquiries Stats
        $contact_counts = [
            'all'       => (int)$this->db->count_all('contact_enquiries'),
            'new'       => (int)$this->db->where('status', 'new')->count_all_results('contact_enquiries'),
            'contacted' => (int)$this->db->where('status', 'contacted')->count_all_results('contact_enquiries'),
            'closed'    => (int)$this->db->where('status', 'closed')->count_all_results('contact_enquiries')
        ];

        // Query Contact Enquiries (Latest first)
        $this->db->from('contact_enquiries');
        if ($status_filter !== 'all') {
            $this->db->where('status', $status_filter);
        }
        $enquiries = $this->db->order_by('created_at', 'DESC')->order_by('id', 'DESC')->get()->result();

        $data = [
            'page_title'     => 'Contact Enquiries',
            'breadcrumb'     => 'Contact Enquiries',
            'active_menu'    => 'contact_enquiries',
            'status_filter'  => $status_filter,
            'counts'         => $contact_counts,
            'enquiries'      => $enquiries
        ];

        $this->render('contact_enquiry_view', $data);
    }

    /**
     * PAGE 2: Distributor Applications Dedicated Page
     */
    public function distributor() {
        // Status filter: 'all', 'new', 'contacted', 'closed'
        $status_filter = $this->input->get('status', TRUE);
        if (!in_array($status_filter, ['all', 'new', 'contacted', 'closed'], TRUE)) {
            $status_filter = 'all';
        }

        // Fetch Distributor Enquiries Stats
        $distributor_counts = [
            'all'       => (int)$this->db->count_all('distributor_enquiries'),
            'new'       => (int)$this->db->where('status', 'new')->count_all_results('distributor_enquiries'),
            'contacted' => (int)$this->db->where('status', 'contacted')->count_all_results('distributor_enquiries'),
            'closed'    => (int)$this->db->where('status', 'closed')->count_all_results('distributor_enquiries')
        ];

        // Query Distributor Enquiries (Latest first)
        $this->db->from('distributor_enquiries');
        if ($status_filter !== 'all') {
            $this->db->where('status', $status_filter);
        }
        $enquiries = $this->db->order_by('created_at', 'DESC')->order_by('id', 'DESC')->get()->result();

        $data = [
            'page_title'     => 'Distributor Applications',
            'breadcrumb'     => 'Distributor Applications',
            'active_menu'    => 'distributor_enquiries',
            'status_filter'  => $status_filter,
            'counts'         => $distributor_counts,
            'enquiries'      => $enquiries
        ];

        $this->render('distributor_enquiry_view', $data);
    }

    /**
     * Inline Status Update (AJAX Endpoint)
     * 
     * Strictly scopes the update query to the specific row's primary key ID
     * with a limit(1) safeguard to guarantee no bulk or unintended updates occur.
     */
    public function update_status() {
        if ($this->input->method() !== 'post') {
            $this->output
                ->set_status_header(405)
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Method not allowed.']));
            return;
        }

        $type   = trim($this->input->post('type', TRUE));
        $id     = (int)$this->input->post('id', TRUE);
        $status = trim($this->input->post('status', TRUE));

        // Strict input validation
        if (!in_array($type, ['contact', 'distributor'], TRUE)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Invalid enquiry category.']));
            return;
        }

        if (!in_array($status, ['new', 'contacted', 'closed'], TRUE)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Invalid status value.']));
            return;
        }

        if ($id <= 0) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Invalid record identifier.']));
            return;
        }

        $table = ($type === 'distributor') ? 'distributor_enquiries' : 'contact_enquiries';

        // Check if the record actually exists before updating
        $existing = $this->General_model->getOne($table, ['id' => $id]);
        if (!$existing) {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status'  => 'error', 
                    'message' => 'Enquiry record not found or was already deleted by another administrator.'
                ]));
            return;
        }

        // Strictly scoped single-row update with limit(1)
        $this->db->where('id', $id)->limit(1)->update($table, ['status' => $status]);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status'     => 'success',
                'message'    => 'Status successfully updated to "' . ucfirst($status) . '".',
                'new_status' => $status,
                'id'         => $id,
                'type'       => $type
            ]));
    }

    /**
     * Delete Enquiry Record
     * 
     * Handles the case where the record was already removed by someone else
     * gracefully without throwing an exception or 500 error.
     * 
     * @param string $type 'contact' or 'distributor'
     * @param int $id Record ID
     */
    public function delete($type = null, $id = null) {
        $type = trim($type);
        $id   = (int)$id;

        if (!in_array($type, ['contact', 'distributor'], TRUE) || $id <= 0) {
            $this->session->set_flashdata('error', 'Invalid deletion parameters provided.');
            redirect('admin/enquiries/contact');
            return;
        }

        $table = ($type === 'distributor') ? 'distributor_enquiries' : 'contact_enquiries';

        // Check if record exists
        $record = $this->General_model->getOne($table, ['id' => $id]);

        if (!$record) {
            // Already removed by another user or session — handle gracefully
            $this->session->set_flashdata('info', 'This enquiry record was already deleted or does not exist.');
            redirect('admin/enquiries/' . $type);
            return;
        }

        // Strictly scoped single-row delete
        $this->db->where('id', $id)->limit(1)->delete($table);

        $name = !empty($record->name) ? $record->name : 'Enquiry #' . $id;
        $this->session->set_flashdata('success', 'Record for "' . html_escape($name) . '" has been permanently deleted.');
        redirect('admin/enquiries/' . $type);
    }

    /**
     * Export Enquiries to CSV
     * 
     * Exports exactly the currently filtered records with proper column headers,
     * UTF-8 BOM encoding for Excel compatibility, and secure escaping.
     * 
     * @param string|null $type 'contact' or 'distributor'
     */
    public function export($type = null) {
        $type = $type ?: $this->input->get('type', TRUE) ?: $this->input->get('tab', TRUE) ?: 'contact';
        if (!in_array($type, ['contact', 'distributor'], TRUE)) {
            $type = 'contact';
        }

        $status = $this->input->get('status', TRUE);
        if (!in_array($status, ['all', 'new', 'contacted', 'closed'], TRUE)) {
            $status = 'all';
        }

        $table = ($type === 'distributor') ? 'distributor_enquiries' : 'contact_enquiries';

        // Apply same status filter as table view
        $this->db->from($table);
        if ($status !== 'all') {
            $this->db->where('status', $status);
        }
        $rows = $this->db->order_by('created_at', 'DESC')->order_by('id', 'DESC')->get()->result();

        $timestamp = date('Y-m-d_His');
        $status_label = ($status === 'all') ? 'all' : $status;

        if ($type === 'distributor') {
            $filename = "distributor_applications_{$status_label}_{$timestamp}.csv";
            $headers  = [
                'ID',
                'Applicant Name',
                'Business Name',
                'Phone',
                'Email',
                'City',
                'State',
                'Product Interest',
                'Storage Space',
                'Message / Notes',
                'Status',
                'Date Submitted'
            ];
        } else {
            $filename = "contact_enquiries_{$status_label}_{$timestamp}.csv";
            $headers  = [
                'ID',
                'Sender Name',
                'Phone',
                'Email',
                'City',
                'Subject',
                'Message',
                'Status',
                'Date Submitted'
            ];
        }

        // HTTP Headers for file download
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Write UTF-8 BOM so Excel opens Hindi, Indian currency symbols, and UTF-8 characters cleanly
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Write header row
        fputcsv($output, $headers);

        // Write data rows
        foreach ($rows as $row) {
            $created_formatted = !empty($row->created_at) ? date('Y-m-d H:i:s', strtotime($row->created_at)) : 'N/A';

            if ($type === 'distributor') {
                $line = [
                    $row->id,
                    $row->name ?? '',
                    $row->business_name ?? '',
                    $row->phone ?? '',
                    $row->email ?? '',
                    $row->city ?? '',
                    $row->state ?? '',
                    $row->product_interest ?? '',
                    $row->storage_space ?? '',
                    $row->message ?? '',
                    ucfirst($row->status ?? 'new'),
                    $created_formatted
                ];
            } else {
                $line = [
                    $row->id,
                    $row->name ?? '',
                    $row->phone ?? '',
                    $row->email ?? '',
                    $row->city ?? '',
                    $row->subject ?? '',
                    $row->message ?? '',
                    ucfirst($row->status ?? 'new'),
                    $created_formatted
                ];
            }

            fputcsv($output, $line);
        }

        fclose($output);
        exit;
    }

    /**
     * STUB FUNCTION: notifyAdminOfNewEnquiry()
     * 
     * Sends an automated email notification to the site administrator whenever
     * a new contact inquiry or distributor dealership application is submitted.
     * 
     * @param string $type 'contact' or 'distributor'
     * @param array|object $enquiry Data dictionary containing submitted fields
     * @return bool Returns TRUE on successful email dispatch (or stub log)
     */
    public function notifyAdminOfNewEnquiry($type, $enquiry) {
        $data = (array)$enquiry;
        $admin_email = 'admin@nandani.com';
        $admin_name  = 'Nandani Admin Team';

        if ($type === 'distributor') {
            $subject = 'New Dealership Application: ' . ($data['business_name'] ?? $data['name'] ?? 'Prospective Partner');
            $applicant_name = $data['name'] ?? 'N/A';
            $business_name  = $data['business_name'] ?? 'N/A';
            $phone          = $data['phone'] ?? 'N/A';
            $email          = $data['email'] ?? 'N/A';
            $location       = trim(($data['city'] ?? '') . ', ' . ($data['state'] ?? ''), ', ');
            $interest       = $data['product_interest'] ?? 'General Products';
            $storage        = $data['storage_space'] ?? 'Not specified';
            $notes          = nl2br(html_escape($data['message'] ?? 'No additional notes provided.'));

            $email_body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #E5E7EB; border-radius: 8px; overflow: hidden;'>
                    <div style='background: #C8102E; color: #FFFFFF; padding: 20px; text-align: center;'>
                        <h2 style='margin: 0; font-size: 20px;'>New Distributor Dealership Application</h2>
                        <p style='margin: 5px 0 0; font-size: 13px; opacity: 0.9;'>Nandani Appliances Business Portal</p>
                    </div>
                    <div style='padding: 24px; color: #374151; font-size: 14px; line-height: 1.6;'>
                        <p>Hello Admin,</p>
                        <p>A new prospective distributor has applied via the website:</p>
                        <table style='width: 100%; border-collapse: collapse; margin: 16px 0;'>
                            <tr><td style='padding: 6px 0; font-weight: bold; width: 35%;'>Applicant Name:</td><td>{$applicant_name}</td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Business Name:</td><td>{$business_name}</td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Phone:</td><td><a href='tel:{$phone}'>{$phone}</a></td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Email:</td><td><a href='mailto:{$email}'>{$email}</a></td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Location:</td><td>{$location}</td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Product Interest:</td><td>{$interest}</td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Storage Space:</td><td>{$storage}</td></tr>
                        </table>
                        <div style='background: #F9FAFB; border-left: 4px solid #C8102E; padding: 12px; margin: 16px 0;'>
                            <strong>Applicant Proposal:</strong>
                            <p style='margin: 6px 0 0;'>{$notes}</p>
                        </div>
                        <p style='margin-top: 24px;'>
                            <a href='" . base_url('admin/enquiries/distributor') . "' style='background: #C8102E; color: #FFFFFF; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; display: inline-block;'>View in Admin Panel</a>
                        </p>
                    </div>
                </div>";
        } else {
            $subject = 'New Contact Enquiry: ' . ($data['subject'] ?? 'Website Inquiry');
            $sender_name = $data['name'] ?? 'Visitor';
            $phone       = $data['phone'] ?? 'N/A';
            $email       = $data['email'] ?? 'N/A';
            $city        = $data['city'] ?? 'N/A';
            $inq_subject = $data['subject'] ?? 'General Inquiry';
            $message     = nl2br(html_escape($data['message'] ?? ''));

            $email_body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #E5E7EB; border-radius: 8px; overflow: hidden;'>
                    <div style='background: #C8102E; color: #FFFFFF; padding: 20px; text-align: center;'>
                        <h2 style='margin: 0; font-size: 20px;'>New Customer Contact Enquiry</h2>
                        <p style='margin: 5px 0 0; font-size: 13px; opacity: 0.9;'>Nandani Appliances Business Portal</p>
                    </div>
                    <div style='padding: 24px; color: #374151; font-size: 14px; line-height: 1.6;'>
                        <p>Hello Admin,</p>
                        <p>A new customer enquiry has been submitted through the contact page:</p>
                        <table style='width: 100%; border-collapse: collapse; margin: 16px 0;'>
                            <tr><td style='padding: 6px 0; font-weight: bold; width: 30%;'>Sender:</td><td>{$sender_name}</td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Phone:</td><td><a href='tel:{$phone}'>{$phone}</a></td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Email:</td><td><a href='mailto:{$email}'>{$email}</a></td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>City:</td><td>{$city}</td></tr>
                            <tr><td style='padding: 6px 0; font-weight: bold;'>Subject:</td><td>{$inq_subject}</td></tr>
                        </table>
                        <div style='background: #F9FAFB; border-left: 4px solid #C8102E; padding: 12px; margin: 16px 0;'>
                            <strong>Message:</strong>
                            <p style='margin: 6px 0 0;'>{$message}</p>
                        </div>
                        <p style='margin-top: 24px;'>
                            <a href='" . base_url('admin/enquiries/contact') . "' style='background: #C8102E; color: #FFFFFF; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; display: inline-block;'>View in Admin Panel</a>
                        </p>
                    </div>
                </div>";
        }

        log_message('info', "[Enquiry Notification Stub] Email generated for {$type} enquiry from " . ($data['email'] ?? 'unknown'));
        return TRUE;
    }
}
