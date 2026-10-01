<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gallery Controller
 * Handles visual media catalog, responsive gallery grid,
 * gallery-category linkage validation, and media lifecycle management.
 */
class Gallery extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'upload']);
    }

    /**
     * List all gallery items in a responsive grid with filtering, server-side pagination, and AJAX support
     */
    public function index() {
        $search          = trim((string)$this->input->get('q', TRUE));
        $filter_category = (int)$this->input->get('category_id', TRUE);
        $status          = trim((string)$this->input->get('status', TRUE));
        $per_page        = (int)$this->input->get('per_page', TRUE);
        $page            = max(1, (int)$this->input->get('page', TRUE));

        $allowed_per_page = [12, 24, 48, 96];
        if (!in_array($per_page, $allowed_per_page)) {
            $per_page = 12;
        }

        // Query filter builder
        $apply_filters = function($db) use ($search, $filter_category, $status) {
            $db->from('gallery');
            $db->join('categories', 'categories.id = gallery.category_id', 'left');

            if (!empty($search)) {
                $db->like('gallery.title_caption', $search);
            }

            if ($filter_category > 0) {
                $db->where('gallery.category_id', $filter_category);
            }

            if (in_array($status, ['active', 'inactive'], TRUE)) {
                $db->where('gallery.status', $status);
            }
        };

        // 1. Total filtered count
        $apply_filters($this->db);
        $total_filtered = $this->db->count_all_results();

        // 2. Fetch paginated records
        $this->db->select('gallery.*, categories.name AS category_name, categories.type AS category_type');
        $apply_filters($this->db);
        $offset = ($page - 1) * $per_page;
        $this->db->order_by('gallery.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $images = $this->db->get()->result();

        // 3. Build pagination HTML
        $pagination_html = $this->build_pagination($total_filtered, $per_page, $page);
        $from_entry = $total_filtered > 0 ? ($offset + 1) : 0;
        $to_entry   = min($offset + $per_page, $total_filtered);

        // Check if AJAX request
        if ($this->is_ajax()) {
            $items_html = $this->load->view('admin/partials/gallery_grid_items', [
                'images'            => $images,
                'search_query'      => $search,
                'selected_category' => $filter_category,
                'selected_status'   => $status
            ], TRUE);

            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode([
                     'status'     => 'success',
                     'html'       => $items_html,
                     'pagination' => $pagination_html,
                     'total'      => $total_filtered,
                     'from'       => $from_entry,
                     'to'         => $to_entry,
                     'message'    => "Showing {$from_entry} to {$to_entry} of {$total_filtered} image(s)"
                 ]));
            return;
        }

        // Active gallery categories for Add/Edit dropdown and filter dropdown
        $gallery_categories = $this->db->where('type', 'gallery')
                                       ->where('status', 'active')
                                       ->order_by('sort_order', 'ASC')
                                       ->order_by('name', 'ASC')
                                       ->get('categories')
                                       ->result();

        $total_gallery = $this->db->count_all('gallery');
        $active_count  = $this->db->where('status', 'active')->count_all_results('gallery');

        $data = [
            'page_title'         => 'Gallery Management',
            'breadcrumb'         => 'Gallery',
            'active_menu'        => 'gallery',
            'images'             => $images,
            'gallery_categories' => $gallery_categories,
            'selected_category'  => $filter_category,
            'selected_status'    => $status,
            'search_query'       => $search,
            'per_page'           => $per_page,
            'current_page'       => $page,
            'from_entry'         => $from_entry,
            'to_entry'           => $to_entry,
            'total_gallery'      => $total_gallery,
            'total_filtered'     => $total_filtered,
            'active_count'       => $active_count,
            'pagination_html'    => $pagination_html
        ];

        $this->render('gallery_view', $data);
    }

    /**
     * Add new Gallery Image handler
     */
    public function add() {
        if ($this->input->method() !== 'post') {
            redirect('admin/gallery');
            return;
        }

        // Form Validation rules
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required|integer');
        $this->form_validation->set_rules('title_caption', 'Title / Caption', 'trim|max_length[150]');
        $this->form_validation->set_rules('status', 'Status', 'trim|in_list[active,inactive]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/gallery');
            return;
        }

        $category_id = (int)$this->input->post('category_id', TRUE);

        // SERVER-SIDE CATEGORY GUARD:
        // Must exist AND strictly have type='gallery'
        $category = $this->db->get_where('categories', ['id' => $category_id])->row();
        if (!$category) {
            $this->session->set_flashdata('error', 'The selected category does not exist.');
            redirect('admin/gallery');
            return;
        }

        if ($category->type !== 'gallery') {
            $this->session->set_flashdata('error', 'Invalid category type. Gallery items can only be linked to Gallery categories.');
            redirect('admin/gallery');
            return;
        }

        // IMAGE UPLOAD (Required on Add)
        if (empty($_FILES['image']['name'])) {
            $this->session->set_flashdata('error', 'Image file is required. Please upload an image.');
            redirect('admin/gallery');
            return;
        }

        $image_name = $this->_handle_image_upload('image');
        if (!$image_name) {
            redirect('admin/gallery');
            return;
        }

        $insert_data = [
            'image'         => $image_name,
            'title_caption' => $this->input->post('title_caption', TRUE) ?: '',
            'category_id'   => $category_id,
            'status'        => ($this->input->post('status', TRUE) === 'inactive') ? 'inactive' : 'active',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        $inserted_id = $this->General_model->insert('gallery', $insert_data);

        if ($inserted_id) {
            $this->session->set_flashdata('success', 'Gallery image uploaded successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to save gallery item to database.');
        }

        redirect('admin/gallery');
    }

    /**
     * Edit Gallery Item handler
     */
    public function edit($id = null) {
        $id = (int)$id;
        $item = $this->General_model->getOne('gallery', ['id' => $id]);

        if (!$item) {
            $this->session->set_flashdata('error', 'Gallery item not found.');
            redirect('admin/gallery');
            return;
        }

        if ($this->input->method() !== 'post') {
            redirect('admin/gallery');
            return;
        }

        // Form Validation rules
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required|integer');
        $this->form_validation->set_rules('title_caption', 'Title / Caption', 'trim|max_length[150]');
        $this->form_validation->set_rules('status', 'Status', 'trim|in_list[active,inactive]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/gallery');
            return;
        }

        $category_id = (int)$this->input->post('category_id', TRUE);

        // SERVER-SIDE CATEGORY GUARD:
        // Must exist AND strictly have type='gallery'
        $category = $this->db->get_where('categories', ['id' => $category_id])->row();
        if (!$category) {
            $this->session->set_flashdata('error', 'The selected category does not exist.');
            redirect('admin/gallery');
            return;
        }

        if ($category->type !== 'gallery') {
            $this->session->set_flashdata('error', 'Invalid category type. Gallery items can only be linked to Gallery categories.');
            redirect('admin/gallery');
            return;
        }

        $image_name = $item->image;
        if (!empty($_FILES['image']['name'])) {
            $uploaded_image = $this->_handle_image_upload('image');
            if ($uploaded_image) {
                // Delete previous image file from disk
                $old_file = FCPATH . 'uploads/gallery/' . $item->image;
                if (!empty($item->image) && file_exists($old_file)) {
                    @unlink($old_file);
                }
                $image_name = $uploaded_image;
            } else {
                redirect('admin/gallery');
                return;
            }
        }

        $update_data = [
            'image'         => $image_name,
            'title_caption' => $this->input->post('title_caption', TRUE) ?: '',
            'category_id'   => $category_id,
            'status'        => ($this->input->post('status', TRUE) === 'inactive') ? 'inactive' : 'active',
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        $this->General_model->update('gallery', ['id' => $id], $update_data);

        $this->session->set_flashdata('success', 'Gallery item updated successfully.');
        redirect('admin/gallery');
    }

    /**
     * Delete Gallery Item handler
     */
    public function delete($id = null) {
        $id = (int)$id;
        $item = $this->General_model->getOne('gallery', ['id' => $id]);

        if (!$item) {
            $this->session->set_flashdata('error', 'Gallery item not found.');
            redirect('admin/gallery');
            return;
        }

        // Delete image file from filesystem
        if (!empty($item->image)) {
            $file_path = FCPATH . 'uploads/gallery/' . $item->image;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        // Delete record from database
        $this->db->delete('gallery', ['id' => $id]);

        $this->session->set_flashdata('success', 'Gallery image deleted successfully.');
        redirect('admin/gallery');
    }

    /**
     * Toggle active/inactive status
     */
    public function toggle_status($id = null) {
        $id = (int)$id;
        $item = $this->General_model->getOne('gallery', ['id' => $id]);

        if (!$item) {
            $this->session->set_flashdata('error', 'Gallery item not found.');
            redirect('admin/gallery');
            return;
        }

        $new_status = ($item->status === 'active') ? 'inactive' : 'active';
        $this->General_model->update('gallery', ['id' => $id], [
            'status'     => $new_status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->session->set_flashdata('success', 'Gallery status updated to ' . ucfirst($new_status) . '.');
        redirect('admin/gallery');
    }

    /**
     * Handle gallery image upload with format & size validation
     */
    private function _handle_image_upload($field_name) {
        $upload_dir = FCPATH . 'uploads/gallery/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $config['upload_path']   = $upload_dir;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 5120; // 5MB max
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field_name)) {
            $this->session->set_flashdata('error', 'Gallery Image Upload Error: ' . $this->upload->display_errors('', ''));
            return false;
        }

        $upload_data = $this->upload->data();
        return $upload_data['file_name'];
    }
}
