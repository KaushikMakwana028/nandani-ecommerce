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
     * List all gallery items in a responsive grid with category filter
     */
    public function index() {
        $filter_category = (int)$this->input->get('category_id', TRUE);

        // Fetch gallery items joined with categories
        $this->db->select('gallery.*, categories.name AS category_name, categories.type AS category_type');
        $this->db->from('gallery');
        $this->db->join('categories', 'categories.id = gallery.category_id', 'left');

        if ($filter_category > 0) {
            $this->db->where('gallery.category_id', $filter_category);
        }

        $this->db->order_by('gallery.id', 'DESC');
        $images = $this->db->get()->result();

        // Active gallery categories for Add/Edit dropdown and filter dropdown
        // Strictly filters WHERE type = 'gallery' AND status = 'active'
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
            'total_gallery'      => $total_gallery,
            'active_count'       => $active_count
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
