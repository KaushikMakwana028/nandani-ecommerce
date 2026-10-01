<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Category Controller
 * Handles Master Categories management for Product, Gallery, and Brand modules.
 * This is the ONLY place categories are ever created, edited, or deleted.
 */
class Category extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'upload']);
    }

    /**
     * List categories organized into three tabs with server-side filtering, pagination, and AJAX support
     */
    public function index() {
        $active_tab  = $this->input->get('tab', TRUE) ?: 'product';
        if (!in_array($active_tab, ['product', 'gallery', 'brand'])) {
            $active_tab = 'product';
        }

        $search   = trim((string)$this->input->get('q', TRUE));
        $status   = trim((string)$this->input->get('status', TRUE));
        $per_page = (int)$this->input->get('per_page', TRUE);
        $page     = max(1, (int)$this->input->get('page', TRUE));

        $allowed_per_page = [10, 25, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) {
            $per_page = 10;
        }

        // Base query builder for active tab
        $apply_filters = function($db) use ($active_tab, $search, $status) {
            $db->from('categories');
            $db->where('type', $active_tab);

            if (!empty($search)) {
                $db->group_start();
                $db->like('name', $search);
                $db->or_like('short_description', $search);
                $db->group_end();
            }

            if (in_array($status, ['active', 'inactive'], TRUE)) {
                $db->where('status', $status);
            }
        };

        // Total filtered count for active tab
        $apply_filters($this->db);
        $total_filtered = $this->db->count_all_results();

        // Paginated records for active tab
        $this->db->select('*');
        $apply_filters($this->db);
        $offset = ($page - 1) * $per_page;
        $this->db->order_by('sort_order', 'ASC')->order_by('name', 'ASC');
        $this->db->limit($per_page, $offset);
        $tab_categories = $this->db->get()->result();

        $pagination_html = $this->build_pagination($total_filtered, $per_page, $page);
        $from_entry = $total_filtered > 0 ? ($offset + 1) : 0;
        $to_entry   = min($offset + $per_page, $total_filtered);

        // Check if AJAX request
        if ($this->is_ajax()) {
            $rows_html = $this->load->view('admin/partials/category_table_rows', [
                'categories'   => $tab_categories,
                'type'         => $active_tab,
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

        // Full tab counts for badge counters
        $product_count = $this->db->where('type', 'product')->count_all_results('categories');
        $gallery_count = $this->db->where('type', 'gallery')->count_all_results('categories');
        $brand_count   = $this->db->where('type', 'brand')->count_all_results('categories');

        // Preload tab lists
        $product_categories = ($active_tab === 'product') ? $tab_categories : $this->db->where('type', 'product')->order_by('sort_order', 'ASC')->order_by('name', 'ASC')->limit($per_page)->get('categories')->result();
        $gallery_categories = ($active_tab === 'gallery') ? $tab_categories : $this->db->where('type', 'gallery')->order_by('sort_order', 'ASC')->order_by('name', 'ASC')->limit($per_page)->get('categories')->result();
        $brand_categories   = ($active_tab === 'brand') ? $tab_categories : $this->db->where('type', 'brand')->order_by('sort_order', 'ASC')->order_by('name', 'ASC')->limit($per_page)->get('categories')->result();

        $data = [
            'page_title'         => 'Categories Master',
            'breadcrumb'         => 'Categories',
            'active_menu'        => 'categories',
            'active_tab'         => $active_tab,
            'product_categories' => $product_categories,
            'gallery_categories' => $gallery_categories,
            'brand_categories'   => $brand_categories,
            'product_count'      => $product_count,
            'gallery_count'      => $gallery_count,
            'brand_count'        => $brand_count,
            'total_filtered'     => $total_filtered,
            'search_query'       => $search,
            'selected_status'    => $status,
            'per_page'           => $per_page,
            'current_page'       => $page,
            'from_entry'         => $from_entry,
            'to_entry'           => $to_entry,
            'pagination_html'    => $pagination_html
        ];

        $this->render('category_view', $data);
    }

    /**
     * Add Category Handler (POST / GET)
     */
    public function add() {
        $type = $this->input->post('type', TRUE) ?: $this->input->get('type', TRUE);
        if (!in_array($type, ['product', 'gallery', 'brand'])) {
            $type = 'product';
        }

        if ($this->input->method() === 'post') {
            // Validation rules
            $this->form_validation->set_rules('name', 'Category Name', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[active,inactive]');
            $this->form_validation->set_rules('sort_order', 'Sort Order', 'trim|integer');

            if ($type === 'product' || $type === 'brand') {
                $this->form_validation->set_rules('icon', 'Icon Class', 'trim|max_length[100]');
                $this->form_validation->set_rules('short_description', 'Short Description', 'trim|max_length[255]');
            }

            if ($this->form_validation->run() === TRUE) {
                $name        = $this->input->post('name', TRUE);
                $status      = $this->input->post('status', TRUE);
                $sort_order  = (int)$this->input->post('sort_order', TRUE);

                // Server-side check: (name, type) UNIQUE constraint verification
                $exists = $this->db->get_where('categories', [
                    'name' => $name,
                    'type' => $type
                ])->row();

                if ($exists) {
                    $this->session->set_flashdata('error', 'This category name already exists.');
                    redirect('admin/category?tab=' . $type);
                    return;
                }

                $image_path = '';
                $icon = '';
                $short_description = '';

                // Handle Product & Brand fields (image, icon, description)
                if ($type === 'product' || $type === 'brand') {
                    $raw_icon          = $this->input->post('icon', FALSE) ?: '';
                    $icon              = !empty($raw_icon) ? normalize_fa_icon($raw_icon, '') : '';
                    $short_description = strip_tags(trim($this->input->post('short_description', TRUE) ?: ''));

                    // Handle image upload if provided
                    if (!empty($_FILES['image']['name'])) {
                        $upload_path = FCPATH . 'uploads/categories/';
                        if (!is_dir($upload_path)) {
                            mkdir($upload_path, 0755, TRUE);
                        }

                        $config = [
                            'upload_path'   => $upload_path,
                            'allowed_types' => 'jpg|jpeg|png|webp|gif',
                            'max_size'      => 2048, // 2MB
                            'file_name'     => 'cat_' . time() . '_' . rand(100, 999),
                            'overwrite'     => FALSE
                        ];

                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('image')) {
                            $upload_data = $this->upload->data();
                            $image_path  = 'uploads/categories/' . $upload_data['file_name'];
                        } else {
                            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                            redirect('admin/category?tab=' . $type);
                            return;
                        }
                    }
                }

                $insert_data = [
                    'name'              => $name,
                    'type'              => $type,
                    'image'             => $image_path,
                    'icon'              => $icon,
                    'short_description' => $short_description,
                    'status'            => $status,
                    'sort_order'        => $sort_order
                ];

                $this->db->insert('categories', $insert_data);

                $this->session->set_flashdata('success', 'Category "' . html_escape($name) . '" created successfully.');
                redirect('admin/category?tab=' . $type);
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors(' ', ' '));
                redirect('admin/category?tab=' . $type);
                return;
            }
        }

        // If accessed directly via GET, render dedicated form
        $data = [
            'page_title'  => 'Add ' . ucfirst($type) . ' Category',
            'breadcrumb'  => 'Categories / Add',
            'active_menu' => 'categories',
            'type'        => $type,
            'is_edit'     => FALSE,
            'category'    => NULL
        ];

        $this->render('category_form_view', $data);
    }

    /**
     * Edit Category Handler (POST / GET)
     */
    public function edit($id = null) {
        $id = (int)$id;
        if ($id <= 0) {
            $this->session->set_flashdata('error', 'Invalid category identifier.');
            redirect('admin/category');
            return;
        }

        $category = $this->General_model->getOne('categories', ['id' => $id]);
        if (!$category) {
            $this->session->set_flashdata('error', 'Category not found or has already been deleted.');
            redirect('admin/category');
            return;
        }

        $type = $category->type;

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('name', 'Category Name', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[active,inactive]');
            $this->form_validation->set_rules('sort_order', 'Sort Order', 'trim|integer');

            if ($type === 'product' || $type === 'brand') {
                $this->form_validation->set_rules('icon', 'Icon Class', 'trim|max_length[100]');
                $this->form_validation->set_rules('short_description', 'Short Description', 'trim|max_length[255]');
            }

            if ($this->form_validation->run() === TRUE) {
                $name        = $this->input->post('name', TRUE);
                $status      = $this->input->post('status', TRUE);
                $sort_order  = (int)$this->input->post('sort_order', TRUE);

                // Server-side check: (name, type) UNIQUE constraint verification on edit
                $exists = $this->db->where('name', $name)
                                   ->where('type', $type)
                                   ->where('id !=', $id)
                                   ->get('categories')
                                   ->row();

                if ($exists) {
                    $this->session->set_flashdata('error', 'This category name already exists.');
                    redirect('admin/category?tab=' . $type);
                    return;
                }

                $update_data = [
                    'name'       => $name,
                    'status'     => $status,
                    'sort_order' => $sort_order
                ];

                if ($type === 'product' || $type === 'brand') {
                    $raw_icon                         = $this->input->post('icon', FALSE) ?: '';
                    $update_data['icon']              = !empty($raw_icon) ? normalize_fa_icon($raw_icon, '') : '';
                    $update_data['short_description'] = strip_tags(trim($this->input->post('short_description', TRUE) ?: ''));

                    // Check for new image upload
                    if (!empty($_FILES['image']['name'])) {
                        $upload_path = FCPATH . 'uploads/categories/';
                        if (!is_dir($upload_path)) {
                            mkdir($upload_path, 0755, TRUE);
                        }

                        $config = [
                            'upload_path'   => $upload_path,
                            'allowed_types' => 'jpg|jpeg|png|webp|gif',
                            'max_size'      => 2048,
                            'file_name'     => 'cat_' . time() . '_' . rand(100, 999),
                            'overwrite'     => FALSE
                        ];

                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('image')) {
                            // Delete old image if existed
                            if (!empty($category->image) && file_exists(FCPATH . $category->image)) {
                                @unlink(FCPATH . $category->image);
                            }
                            $upload_data = $this->upload->data();
                            $update_data['image'] = 'uploads/categories/' . $upload_data['file_name'];
                        } else {
                            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                            redirect('admin/category?tab=' . $type);
                            return;
                        }
                    }
                }

                $this->db->where('id', $id)->update('categories', $update_data);

                $this->session->set_flashdata('success', 'Category "' . html_escape($name) . '" updated successfully.');
                redirect('admin/category?tab=' . $type);
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors(' ', ' '));
                redirect('admin/category?tab=' . $type);
                return;
            }
        }

        // Redirect to category listing tab if accessed directly via GET
        redirect('admin/category?tab=' . $type);
    }

    /**
     * Delete Category Handler with Foreign Key / Reference Protection
     */
    public function delete($id = null) {
        $id = (int)$id;
        if ($id <= 0) {
            $this->session->set_flashdata('error', 'Invalid category identifier.');
            redirect('admin/category');
            return;
        }

        // Check if category exists
        $category = $this->General_model->getOne('categories', ['id' => $id]);
        if (!$category) {
            $this->session->set_flashdata('error', 'Category not found or has already been deleted.');
            redirect('admin/category');
            return;
        }

        $type = $category->type;
        $in_use = false;

        // 1. Check brands table reference
        if ($this->db->table_exists('brands')) {
            if ($this->db->where('category_id', $id)->count_all_results('brands') > 0) {
                $in_use = true;
            }
        }

        // 2. Check products table reference
        if (!$in_use && $this->db->table_exists('products')) {
            if ($this->db->where('category_id', $id)->count_all_results('products') > 0) {
                $in_use = true;
            }
        }

        // 3. Check gallery table reference
        if (!$in_use && $this->db->table_exists('gallery')) {
            if ($this->db->where('category_id', $id)->count_all_results('gallery') > 0) {
                $in_use = true;
            }
        }

        // If in use, block deletion and show friendly message
        if ($in_use) {
            $this->session->set_flashdata('error', "This category is in use and can't be deleted.");
            redirect('admin/category?tab=' . $type);
            return;
        }

        // If safe, delete the image file from server if exists
        if (!empty($category->image) && file_exists(FCPATH . $category->image)) {
            @unlink(FCPATH . $category->image);
        }

        // Delete from categories table
        $this->db->where('id', $id)->delete('categories');

        $this->session->set_flashdata('success', 'Category "' . html_escape($category->name) . '" deleted successfully.');
        redirect('admin/category?tab=' . $type);
    }
}
