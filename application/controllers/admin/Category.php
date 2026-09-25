<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Category Controller
 * Handles Master Categories management (Product, Gallery, Brand)
 */
class Category extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * List all categories with optional type filtering
     */
    public function index() {
        $type_filter = $this->input->get('type', TRUE);
        
        $where = [];
        if (!empty($type_filter) && in_array($type_filter, ['product', 'gallery', 'brand'])) {
            $where['type'] = $type_filter;
        }

        // Fetch categories ordered by sort_order and name using Query Builder / General_model
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('name', 'ASC');
        $categories = $this->db->get('categories')->result();

        // Counts per type for tab pills
        $total_count = $this->db->count_all('categories');
        $product_count = $this->db->where('type', 'product')->count_all_results('categories');
        $gallery_count = $this->db->where('type', 'gallery')->count_all_results('categories');
        $brand_count   = $this->db->where('type', 'brand')->count_all_results('categories');

        $data = [
            'page_title'    => 'Categories Master',
            'breadcrumb'    => 'Categories',
            'active_menu'   => 'categories',
            'categories'    => $categories,
            'current_type'  => $type_filter,
            'counts'        => [
                'all'     => $total_count,
                'product' => $product_count,
                'gallery' => $gallery_count,
                'brand'   => $brand_count
            ]
        ];

        $this->render('category_view', $data);
    }

    /**
     * Graceful delete with non-existent check (Global Rule 9)
     */
    public function delete($id = null) {
        $id = (int)$id;
        if ($id <= 0) {
            $this->session->set_flashdata('error', 'Invalid category identifier provided.');
            redirect('admin/category');
            return;
        }

        // Rule 9: Check if record exists; gracefully handle if already deleted
        $category = $this->General_model->getOne('categories', ['id' => $id]);
        if (!$category) {
            $this->session->set_flashdata('error', 'Category not found or has already been deleted.');
            redirect('admin/category');
            return;
        }

        // Check if any dependent items exist before deletion (Rule 2: ON DELETE RESTRICT)
        // Products check (when products table is created in step 4)
        if ($this->db->table_exists('products')) {
            $prod_count = $this->db->where('category_id', $id)->count_all_results('products');
            if ($prod_count > 0) {
                $this->session->set_flashdata('error', 'Cannot delete this category because it has linked products.');
                redirect('admin/category');
                return;
            }
        }

        // Perform delete via parameterized query builder
        $this->db->where('id', $id)->delete('categories');

        $this->session->set_flashdata('success', 'Category "' . html_escape($category->name) . '" deleted successfully.');
        redirect('admin/category');
    }
}
