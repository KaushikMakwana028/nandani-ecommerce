<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product Controller
 * Handles Product catalog management, brand and product-category linkages,
 * server-side search filtering, badges, and media handling.
 */
class Product extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'upload']);
    }

    /**
     * List products with multi-column filtering, server-side pagination and AJAX support
     */
    public function index() {
        $search      = trim((string)$this->input->get('q', TRUE));
        $category_id = (int)$this->input->get('category_id', TRUE);
        $brand_id    = (int)$this->input->get('brand_id', TRUE);
        $status      = trim((string)$this->input->get('status', TRUE));
        $badge       = trim((string)$this->input->get('badge', TRUE));
        $per_page    = (int)$this->input->get('per_page', TRUE);
        $page        = max(1, (int)$this->input->get('page', TRUE));

        $allowed_per_page = [10, 25, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) {
            $per_page = 10;
        }

        // Base query conditions builder
        $apply_filters = function($db) use ($search, $category_id, $brand_id, $status, $badge) {
            $db->from('products');
            $db->join('brands', 'brands.id = products.brand_id', 'left');
            $db->join('categories', 'categories.id = products.category_id', 'left');

            if (!empty($search)) {
                $db->group_start();
                $db->like('products.name', $search);
                $db->or_like('products.short_description', $search);
                $db->group_end();
            }

            if ($category_id > 0) {
                $db->where('products.category_id', $category_id);
            }

            if ($brand_id > 0) {
                $db->where('products.brand_id', $brand_id);
            }

            if (in_array($status, ['active', 'inactive'], TRUE)) {
                $db->where('products.status', $status);
            }

            if (in_array($badge, ['none', 'new', 'bestseller'], TRUE)) {
                $db->where('products.badge', $badge);
            }
        };

        // 1. Get filtered total count
        $apply_filters($this->db);
        $total_filtered = $this->db->count_all_results();

        // 2. Fetch paginated records with LIMIT & OFFSET
        $this->db->select('products.*, brands.name AS brand_name, brands.status AS brand_status, categories.name AS category_name, categories.type AS category_type');
        $apply_filters($this->db);
        $offset = ($page - 1) * $per_page;
        $this->db->order_by('products.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $products = $this->db->get()->result();

        // 3. Build pagination HTML
        $pagination_html = $this->build_pagination($total_filtered, $per_page, $page);
        $from_entry = $total_filtered > 0 ? ($offset + 1) : 0;
        $to_entry   = min($offset + $per_page, $total_filtered);

        // Check if AJAX request
        if ($this->is_ajax()) {
            $rows_html = $this->load->view('admin/partials/product_table_rows', [
                'products'     => $products,
                'search_query' => $search
            ], TRUE);

            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode([
                     'status'     => 'success',
                     'html'       => $rows_html,
                     'pagination' => $pagination_html,
                     'total'      => $total_filtered,
                     'from'       => $from_entry,
                     'to'         => $to_entry,
                     'message'    => "Showing {$from_entry} to {$to_entry} of {$total_filtered} items"
                 ]));
            return;
        }

        // Active brands for Add/Edit dropdown and filter
        $brands = $this->db->where('status', 'active')
                           ->order_by('name', 'ASC')
                           ->get('brands')
                           ->result();

        // Active product categories for Add/Edit dropdown and filter
        $product_categories = $this->db->where('type', 'product')
                                       ->where('status', 'active')
                                       ->order_by('sort_order', 'ASC')
                                       ->order_by('name', 'ASC')
                                       ->get('categories')
                                       ->result();

        // Count overall totals
        $total_products = $this->db->count_all('products');
        $active_products = $this->db->where('status', 'active')->count_all_results('products');

        $data = [
            'page_title'         => 'Product Management',
            'breadcrumb'         => 'Products',
            'active_menu'        => 'products',
            'products'           => $products,
            'brands'             => $brands,
            'product_categories' => $product_categories,
            'total_products'     => $total_products,
            'active_products'    => $active_products,
            'total_filtered'     => $total_filtered,
            'search_query'       => $search,
            'selected_category'  => $category_id,
            'selected_brand'     => $brand_id,
            'selected_status'    => $status,
            'selected_badge'     => $badge,
            'per_page'           => $per_page,
            'current_page'       => $page,
            'from_entry'         => $from_entry,
            'to_entry'           => $to_entry,
            'pagination_html'    => $pagination_html
        ];

        $this->render('product_view', $data);
    }

    /**
     * Add new Product handler
     */
    public function add() {
        if ($this->input->method() !== 'post') {
            redirect('admin/products');
            return;
        }

        // Form Validation rules
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('brand_id', 'Brand', 'trim|required|integer');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required|integer');
        $this->form_validation->set_rules('short_description', 'Short Description', 'trim|max_length[255]');
        $this->form_validation->set_rules('badge', 'Product Badge', 'trim|in_list[none,new,bestseller]');
        $this->form_validation->set_rules('status', 'Status', 'trim|in_list[active,inactive]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/products');
            return;
        }

        $category_id = (int)$this->input->post('category_id', TRUE);
        $brand_id    = (int)$this->input->post('brand_id', TRUE);

        // SERVER-SIDE CATEGORY GUARD:
        // Must exist AND strictly have type='product'
        $category = $this->db->get_where('categories', ['id' => $category_id])->row();
        if (!$category) {
            $this->session->set_flashdata('error', 'The selected category does not exist.');
            redirect('admin/products');
            return;
        }

        if ($category->type !== 'product') {
            $this->session->set_flashdata('error', 'Invalid category type. Products can only be linked to Product categories.');
            redirect('admin/products');
            return;
        }

        // SERVER-SIDE BRAND GUARD:
        // Must exist AND be active
        $brand = $this->db->get_where('brands', ['id' => $brand_id])->row();
        if (!$brand) {
            $this->session->set_flashdata('error', 'The selected brand does not exist.');
            redirect('admin/products');
            return;
        }

        if ($brand->status !== 'active') {
            $this->session->set_flashdata('error', 'The selected brand is inactive. Products can only be assigned to active brands.');
            redirect('admin/products');
            return;
        }

        // IMAGE UPLOAD (Required on Add)
        if (empty($_FILES['image']['name'])) {
            $this->session->set_flashdata('error', 'Product image is required. Please upload an image.');
            redirect('admin/products');
            return;
        }

        $image_name = $this->_handle_image_upload('image');
        if (!$image_name) {
            redirect('admin/products');
            return;
        }

        $insert_data = [
            'image'             => $image_name,
            'name'              => $this->input->post('name', TRUE),
            'brand_id'          => $brand_id,
            'category_id'       => $category_id,
            'short_description' => $this->input->post('short_description', TRUE) ?: '',
            'badge'             => $this->input->post('badge', TRUE) ?: 'none',
            'status'            => ($this->input->post('status', TRUE) === 'inactive') ? 'inactive' : 'active',
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        $inserted_id = $this->General_model->insert('products', $insert_data);

        if ($inserted_id) {
            $this->session->set_flashdata('success', 'Product "' . htmlspecialchars($insert_data['name']) . '" added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to save product to database.');
        }

        redirect('admin/products');
    }

    /**
     * Edit Product handler
     */
    public function edit($id = null) {
        $id = (int)$id;
        $product = $this->General_model->getOne('products', ['id' => $id]);

        if (!$product) {
            $this->session->set_flashdata('error', 'Product not found.');
            redirect('admin/products');
            return;
        }

        if ($this->input->method() !== 'post') {
            redirect('admin/products');
            return;
        }

        // Form Validation rules
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('brand_id', 'Brand', 'trim|required|integer');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required|integer');
        $this->form_validation->set_rules('short_description', 'Short Description', 'trim|max_length[255]');
        $this->form_validation->set_rules('badge', 'Product Badge', 'trim|in_list[none,new,bestseller]');
        $this->form_validation->set_rules('status', 'Status', 'trim|in_list[active,inactive]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/products');
            return;
        }

        $category_id = (int)$this->input->post('category_id', TRUE);
        $brand_id    = (int)$this->input->post('brand_id', TRUE);

        // Category Guard
        $category = $this->db->get_where('categories', ['id' => $category_id])->row();
        if (!$category) {
            $this->session->set_flashdata('error', 'The selected category does not exist.');
            redirect('admin/products');
            return;
        }

        if ($category->type !== 'product') {
            $this->session->set_flashdata('error', 'Invalid category type. Products can only be linked to Product categories.');
            redirect('admin/products');
            return;
        }

        // Brand Guard
        $brand = $this->db->get_where('brands', ['id' => $brand_id])->row();
        if (!$brand) {
            $this->session->set_flashdata('error', 'The selected brand does not exist.');
            redirect('admin/products');
            return;
        }

        $image_name = $product->image;
        if (!empty($_FILES['image']['name'])) {
            $uploaded_image = $this->_handle_image_upload('image');
            if ($uploaded_image) {
                // Delete previous image file from disk
                $old_file = FCPATH . 'uploads/products/' . $product->image;
                if (!empty($product->image) && file_exists($old_file)) {
                    @unlink($old_file);
                }
                $image_name = $uploaded_image;
            } else {
                redirect('admin/products');
                return;
            }
        }

        $update_data = [
            'image'             => $image_name,
            'name'              => $this->input->post('name', TRUE),
            'brand_id'          => $brand_id,
            'category_id'       => $category_id,
            'short_description' => $this->input->post('short_description', TRUE) ?: '',
            'badge'             => $this->input->post('badge', TRUE) ?: 'none',
            'status'            => ($this->input->post('status', TRUE) === 'inactive') ? 'inactive' : 'active',
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        $this->General_model->update('products', ['id' => $id], $update_data);

        $this->session->set_flashdata('success', 'Product "' . htmlspecialchars($update_data['name']) . '" updated successfully.');
        redirect('admin/products');
    }

    /**
     * Delete Product handler
     */
    public function delete($id = null) {
        $id = (int)$id;
        $product = $this->General_model->getOne('products', ['id' => $id]);

        if (!$product) {
            $this->session->set_flashdata('error', 'Product not found.');
            redirect('admin/products');
            return;
        }

        // Delete image file from filesystem
        if (!empty($product->image)) {
            $file_path = FCPATH . 'uploads/products/' . $product->image;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        // Delete record from database
        $this->db->delete('products', ['id' => $id]);

        $this->session->set_flashdata('success', 'Product deleted successfully.');
        redirect('admin/products');
    }

    /**
     * Toggle active/inactive status
     */
    public function toggle_status($id = null) {
        $id = (int)$id;
        $product = $this->General_model->getOne('products', ['id' => $id]);

        if (!$product) {
            $this->session->set_flashdata('error', 'Product not found.');
            redirect('admin/products');
            return;
        }

        $new_status = ($product->status === 'active') ? 'inactive' : 'active';
        $this->General_model->update('products', ['id' => $id], [
            'status'     => $new_status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->session->set_flashdata('success', 'Product status updated to ' . ucfirst($new_status) . '.');
        redirect('admin/products');
    }

    /**
     * Handle product image upload with format & size validation
     */
    private function _handle_image_upload($field_name) {
        $upload_dir = FCPATH . 'uploads/products/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $config['upload_path']   = $upload_dir;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 5120; // 5MB max
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field_name)) {
            $this->session->set_flashdata('error', 'Product Image Upload Error: ' . $this->upload->display_errors('', ''));
            return false;
        }

        $upload_data = $this->upload->data();
        return $upload_data['file_name'];
    }
}
