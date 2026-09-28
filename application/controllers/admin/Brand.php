<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Brand Controller
 * Handles Brands management, PNG logo validation, Product Category linkage enforcement,
 * and safe deletion guarding against linked products.
 */
class Brand extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'upload']);
    }

    /**
     * List all brands with joined product category and management controls
     */
    public function index() {
        // Fetch all brands with joined category details
        $this->db->select('brands.*, categories.name AS category_name, categories.type AS category_type, categories.status AS category_status');
        $this->db->from('brands');
        $this->db->join('categories', 'categories.id = brands.category_id', 'left');
        $this->db->order_by('brands.id', 'DESC');
        $brands = $this->db->get()->result();

        // Fetch active product categories for Add/Edit dropdown
        // Strictly filters WHERE type = 'product' AND status = 'active'
        $product_categories = $this->db->where('type', 'product')
                                       ->where('status', 'active')
                                       ->order_by('sort_order', 'ASC')
                                       ->order_by('name', 'ASC')
                                       ->get('categories')
                                       ->result();

        $total_brands = count($brands);
        $active_brands = 0;
        foreach ($brands as $b) {
            if ($b->status === 'active') {
                $active_brands++;
            }
        }

        $data = [
            'page_title'         => 'Brand Management',
            'breadcrumb'         => 'Brands',
            'active_menu'        => 'brands',
            'brands'             => $brands,
            'product_categories' => $product_categories,
            'total_brands'       => $total_brands,
            'active_brands'      => $active_brands
        ];

        $this->render('brand_view', $data);
    }

    /**
     * Add new Brand handler
     */
    public function add() {
        if ($this->input->method() !== 'post') {
            redirect('admin/brands');
            return;
        }

        // Form Validation rules
        $this->form_validation->set_rules('name', 'Brand Name', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required|integer');
        $this->form_validation->set_rules('short_description', 'Short Description', 'trim|max_length[255]');
        $this->form_validation->set_rules('status', 'Status', 'trim|in_list[active,inactive]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/brands');
            return;
        }

        $category_id = (int)$this->input->post('category_id', TRUE);

        // SERVER-SIDE CATEGORY GUARD:
        // Validate category exists AND strictly has type='product'
        $category = $this->db->get_where('categories', ['id' => $category_id])->row();
        if (!$category) {
            $this->session->set_flashdata('error', 'The selected category does not exist.');
            redirect('admin/brands');
            return;
        }

        if ($category->type !== 'product') {
            $this->session->set_flashdata('error', 'Invalid category type. Brands can only be linked to Product categories.');
            redirect('admin/brands');
            return;
        }

        // SERVER-SIDE SINCE YEAR VALIDATION (1900 - current year)
        $since_year_input = trim($this->input->post('since_year', TRUE));
        $since_year = null;
        if ($since_year_input !== '') {
            $current_year = (int)date('Y');
            if (!is_numeric($since_year_input) || (int)$since_year_input < 1900 || (int)$since_year_input > $current_year) {
                $this->session->set_flashdata('error', "Since Year must be a valid 4-digit year between 1900 and {$current_year}.");
                redirect('admin/brands');
                return;
            }
            $since_year = (int)$since_year_input;
        }

        // LOGO UPLOAD & PNG VALIDATION (Required on Add)
        if (empty($_FILES['logo_image']['name'])) {
            $this->session->set_flashdata('error', 'Brand logo is required. Please upload a PNG logo.');
            redirect('admin/brands');
            return;
        }

        $logo_name = $this->_handle_logo_upload('logo_image');
        if (!$logo_name) {
            redirect('admin/brands');
            return;
        }

        $insert_data = [
            'logo_image'        => $logo_name,
            'name'              => $this->input->post('name', TRUE),
            'category_id'       => $category_id,
            'since_year'        => $since_year,
            'short_description' => $this->input->post('short_description', TRUE) ?: '',
            'status'            => ($this->input->post('status', TRUE) === 'inactive') ? 'inactive' : 'active',
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        $inserted_id = $this->General_model->insert('brands', $insert_data);

        if ($inserted_id) {
            $this->session->set_flashdata('success', 'Brand "' . htmlspecialchars($insert_data['name']) . '" created successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to save brand to database.');
        }

        redirect('admin/brands');
    }

    /**
     * Edit Brand handler
     */
    public function edit($id = null) {
        $id = (int)$id;
        $brand = $this->General_model->getOne('brands', ['id' => $id]);

        if (!$brand) {
            $this->session->set_flashdata('error', 'Brand not found.');
            redirect('admin/brands');
            return;
        }

        if ($this->input->method() !== 'post') {
            redirect('admin/brands');
            return;
        }

        // Form Validation rules
        $this->form_validation->set_rules('name', 'Brand Name', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required|integer');
        $this->form_validation->set_rules('short_description', 'Short Description', 'trim|max_length[255]');
        $this->form_validation->set_rules('status', 'Status', 'trim|in_list[active,inactive]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/brands');
            return;
        }

        $category_id = (int)$this->input->post('category_id', TRUE);

        // SERVER-SIDE CATEGORY GUARD:
        // Validate category exists AND strictly has type='product'
        $category = $this->db->get_where('categories', ['id' => $category_id])->row();
        if (!$category) {
            $this->session->set_flashdata('error', 'The selected category does not exist.');
            redirect('admin/brands');
            return;
        }

        if ($category->type !== 'product') {
            $this->session->set_flashdata('error', 'Invalid category type. Brands can only be linked to Product categories.');
            redirect('admin/brands');
            return;
        }

        // SERVER-SIDE SINCE YEAR VALIDATION (1900 - current year)
        $since_year_input = trim($this->input->post('since_year', TRUE));
        $since_year = null;
        if ($since_year_input !== '') {
            $current_year = (int)date('Y');
            if (!is_numeric($since_year_input) || (int)$since_year_input < 1900 || (int)$since_year_input > $current_year) {
                $this->session->set_flashdata('error', "Since Year must be a valid 4-digit year between 1900 and {$current_year}.");
                redirect('admin/brands');
                return;
            }
            $since_year = (int)$since_year_input;
        }

        $logo_name = $brand->logo_image;
        if (!empty($_FILES['logo_image']['name'])) {
            $uploaded_logo = $this->_handle_logo_upload('logo_image');
            if ($uploaded_logo) {
                // Delete previous logo file from disk
                $old_file = FCPATH . 'uploads/brands/' . $brand->logo_image;
                if (!empty($brand->logo_image) && file_exists($old_file)) {
                    @unlink($old_file);
                }
                $logo_name = $uploaded_logo;
            } else {
                redirect('admin/brands');
                return;
            }
        }

        $update_data = [
            'logo_image'        => $logo_name,
            'name'              => $this->input->post('name', TRUE),
            'category_id'       => $category_id,
            'since_year'        => $since_year,
            'short_description' => $this->input->post('short_description', TRUE) ?: '',
            'status'            => ($this->input->post('status', TRUE) === 'inactive') ? 'inactive' : 'active',
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        $this->General_model->update('brands', ['id' => $id], $update_data);

        $this->session->set_flashdata('success', 'Brand "' . htmlspecialchars($update_data['name']) . '" updated successfully.');
        redirect('admin/brands');
    }

    /**
     * Delete Brand handler
     * Guards against deleting brands referenced by products
     */
    public function delete($id = null) {
        $id = (int)$id;
        $brand = $this->General_model->getOne('brands', ['id' => $id]);

        if (!$brand) {
            $this->session->set_flashdata('error', 'Brand not found.');
            redirect('admin/brands');
            return;
        }

        // PRODUCTS REFERENCE CHECK:
        // Check if any products reference this brand_id
        if ($this->db->table_exists('products')) {
            $product_count = $this->db->where('brand_id', $id)->count_all_results('products');
            if ($product_count > 0) {
                $this->session->set_flashdata('error', 'This brand has products linked to it and can\'t be deleted.');
                redirect('admin/brands');
                return;
            }
        }

        // Delete logo file from disk
        if (!empty($brand->logo_image)) {
            $file_path = FCPATH . 'uploads/brands/' . $brand->logo_image;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        // Delete brand record
        $this->db->delete('brands', ['id' => $id]);

        $this->session->set_flashdata('success', 'Brand deleted successfully.');
        redirect('admin/brands');
    }

    /**
     * Toggle active/inactive status
     */
    public function toggle_status($id = null) {
        $id = (int)$id;
        $brand = $this->General_model->getOne('brands', ['id' => $id]);

        if (!$brand) {
            $this->session->set_flashdata('error', 'Brand not found.');
            redirect('admin/brands');
            return;
        }

        $new_status = ($brand->status === 'active') ? 'inactive' : 'active';
        $this->General_model->update('brands', ['id' => $id], [
            'status'     => $new_status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->session->set_flashdata('success', 'Brand status updated to ' . ucfirst($new_status) . '.');
        redirect('admin/brands');
    }

    /**
     * Handle logo file upload with strict PNG format & size validation
     */
    private function _handle_logo_upload($field_name) {
        $upload_dir = FCPATH . 'uploads/brands/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // 1. Check file extension before processing
        $filename = $_FILES[$field_name]['name'] ?? '';
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($ext !== 'png') {
            $this->session->set_flashdata('error', 'Invalid file type. Brand logos must be in PNG format (.png).');
            return false;
        }

        // 2. Configure CodeIgniter upload library strictly for PNG
        $config['upload_path']   = $upload_dir;
        $config['allowed_types'] = 'png';
        $config['max_size']      = 2048; // 2MB max
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field_name)) {
            $this->session->set_flashdata('error', 'Logo Upload Error: ' . $this->upload->display_errors('', ''));
            return false;
        }

        $upload_data = $this->upload->data();

        // 3. MIME validation: Verify it's actually an image/png
        $mime_type = mime_content_type($upload_data['full_path']);
        if ($mime_type !== 'image/png') {
            @unlink($upload_data['full_path']);
            $this->session->set_flashdata('error', 'Security Error: Uploaded file is not a valid PNG image.');
            return false;
        }

        return $upload_data['file_name'];
    }
}
