<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hero_slider Controller
 * Manages homepage hero banner slides with a strict 5-slide limit,
 * transaction-safe sequential reordering (drag-and-drop & up/down controls),
 * and media management.
 */
class Hero_slider extends Admin_Controller {

    const MAX_SLIDES = 5;

    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'upload']);
    }

    /**
     * List all hero slides with ordering and management controls
     */
    public function index() {
        // Fetch all slides ordered strictly by sort_order ASC, then id ASC
        $slides = $this->db->order_by('sort_order', 'ASC')
                           ->order_by('id', 'ASC')
                           ->get('hero_slides')
                           ->result();

        $slide_count = count($slides);
        $active_count = 0;
        foreach ($slides as $s) {
            if ($s->status === 'active') {
                $active_count++;
            }
        }

        $data = [
            'page_title'   => 'Hero Slider Management',
            'breadcrumb'   => 'Hero Slider',
            'active_menu'  => 'hero_slider',
            'slides'       => $slides,
            'slide_count'  => $slide_count,
            'active_count' => $active_count,
            'max_slides'   => self::MAX_SLIDES,
            'can_add'      => ($slide_count < self::MAX_SLIDES)
        ];

        $this->render('hero_slider_view', $data);
    }

    /**
     * Add new hero slide
     * Blocks insertion if 5 slides already exist
     */
    public function add() {
        if ($this->input->method() !== 'post') {
            redirect('admin/hero-slider');
            return;
        }

        // 1. STRICT SERVER-SIDE COUNT CHECK (Active or Inactive)
        $total_existing = $this->db->count_all('hero_slides');
        if ($total_existing >= self::MAX_SLIDES) {
            $this->session->set_flashdata('error', 'Maximum of 5 slides reached. Please edit or delete existing slides before adding a new one.');
            redirect('admin/hero-slider');
            return;
        }

        // 2. FORM VALIDATION
        $this->form_validation->set_rules('heading_text', 'Heading Text', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('tag_text', 'Tag Text', 'trim|max_length[100]');
        $this->form_validation->set_rules('highlighted_word', 'Highlighted Word', 'trim|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('button1_text', 'Button 1 Text', 'trim|max_length[50]');
        $this->form_validation->set_rules('button1_link', 'Button 1 Link', 'trim|max_length[255]|callback__validate_button_link');
        $this->form_validation->set_rules('button2_text', 'Button 2 Text', 'trim|max_length[50]');
        $this->form_validation->set_rules('button2_link', 'Button 2 Link', 'trim|max_length[255]|callback__validate_button_link');
        $this->form_validation->set_rules('status', 'Status', 'trim|in_list[active,inactive]');
        $this->form_validation->set_rules('sort_order', 'Sort Order', 'trim|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/hero-slider');
            return;
        }

        // 3. IMAGE UPLOAD (Required for new slide)
        if (empty($_FILES['image']['name'])) {
            $this->session->set_flashdata('error', 'Slide image is required. Please upload an image.');
            redirect('admin/hero-slider');
            return;
        }

        $image_name = $this->_handle_image_upload('image');
        if (!$image_name) {
            // Upload error flashdata set in _handle_image_upload
            redirect('admin/hero-slider');
            return;
        }

        // Determine sort order
        $req_sort = (int)$this->input->post('sort_order', TRUE);
        $sort_order = ($req_sort > 0) ? $req_sort : ($total_existing + 1);

        $insert_data = [
            'image'            => $image_name,
            'tag_text'         => $this->input->post('tag_text', TRUE) ?: null,
            'heading_text'     => $this->input->post('heading_text', TRUE),
            'highlighted_word' => $this->input->post('highlighted_word', TRUE) ?: null,
            'description'      => $this->input->post('description', TRUE) ?: null,
            'button1_text'     => $this->input->post('button1_text', TRUE) ?: null,
            'button1_link'     => $this->input->post('button1_link', TRUE) ?: null,
            'button2_text'     => $this->input->post('button2_text', TRUE) ?: null,
            'button2_link'     => $this->input->post('button2_link', TRUE) ?: null,
            'status'           => ($this->input->post('status', TRUE) === 'inactive') ? 'inactive' : 'active',
            'sort_order'       => $sort_order,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s')
        ];

        $inserted_id = $this->General_model->insert('hero_slides', $insert_data);

        if ($inserted_id) {
            // Normalize order numbers sequentially inside transaction
            $this->_resequence_order();
            $this->session->set_flashdata('success', 'Slide added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to save slide to database.');
        }

        redirect('admin/hero-slider');
    }

    /**
     * Edit slide handler
     */
    public function edit($id = null) {
        $id = (int)$id;
        $slide = $this->General_model->getOne('hero_slides', ['id' => $id]);

        if (!$slide) {
            $this->session->set_flashdata('error', 'Slide not found.');
            redirect('admin/hero-slider');
            return;
        }

        if ($this->input->method() !== 'post') {
            redirect('admin/hero-slider');
            return;
        }

        // Form validation
        $this->form_validation->set_rules('heading_text', 'Heading Text', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('tag_text', 'Tag Text', 'trim|max_length[100]');
        $this->form_validation->set_rules('highlighted_word', 'Highlighted Word', 'trim|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('button1_text', 'Button 1 Text', 'trim|max_length[50]');
        $this->form_validation->set_rules('button1_link', 'Button 1 Link', 'trim|max_length[255]|callback__validate_button_link');
        $this->form_validation->set_rules('button2_text', 'Button 2 Text', 'trim|max_length[50]');
        $this->form_validation->set_rules('button2_link', 'Button 2 Link', 'trim|max_length[255]|callback__validate_button_link');
        $this->form_validation->set_rules('status', 'Status', 'trim|in_list[active,inactive]');
        $this->form_validation->set_rules('sort_order', 'Sort Order', 'trim|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/hero-slider');
            return;
        }

        $image_name = $slide->image;
        if (!empty($_FILES['image']['name'])) {
            $uploaded_image = $this->_handle_image_upload('image');
            if ($uploaded_image) {
                // Delete old image file if exists
                $old_file = FCPATH . 'uploads/hero_slider/' . $slide->image;
                if (!empty($slide->image) && file_exists($old_file)) {
                    @unlink($old_file);
                }
                $image_name = $uploaded_image;
            } else {
                redirect('admin/hero-slider');
                return;
            }
        }

        $sort_order = (int)$this->input->post('sort_order', TRUE);
        if ($sort_order <= 0) {
            $sort_order = $slide->sort_order;
        }

        $update_data = [
            'image'            => $image_name,
            'tag_text'         => $this->input->post('tag_text', TRUE) ?: null,
            'heading_text'     => $this->input->post('heading_text', TRUE),
            'highlighted_word' => $this->input->post('highlighted_word', TRUE) ?: null,
            'description'      => $this->input->post('description', TRUE) ?: null,
            'button1_text'     => $this->input->post('button1_text', TRUE) ?: null,
            'button1_link'     => $this->input->post('button1_link', TRUE) ?: null,
            'button2_text'     => $this->input->post('button2_text', TRUE) ?: null,
            'button2_link'     => $this->input->post('button2_link', TRUE) ?: null,
            'status'           => ($this->input->post('status', TRUE) === 'inactive') ? 'inactive' : 'active',
            'sort_order'       => $sort_order,
            'updated_at'       => date('Y-m-d H:i:s')
        ];

        $this->General_model->update('hero_slides', ['id' => $id], $update_data);

        // Normalize ordering if sort order was updated
        $this->_resequence_order();

        $this->session->set_flashdata('success', 'Slide updated successfully.');
        redirect('admin/hero-slider');
    }

    /**
     * Delete slide
     */
    public function delete($id = null) {
        $id = (int)$id;
        $slide = $this->General_model->getOne('hero_slides', ['id' => $id]);

        if (!$slide) {
            $this->session->set_flashdata('error', 'Slide not found.');
            redirect('admin/hero-slider');
            return;
        }

        // Delete image file from filesystem
        if (!empty($slide->image)) {
            $file_path = FCPATH . 'uploads/hero_slider/' . $slide->image;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        // Delete row
        $this->db->delete('hero_slides', ['id' => $id]);

        // Resequence remaining rows so order numbers are contiguous (1, 2, 3...)
        $this->_resequence_order();

        $this->session->set_flashdata('success', 'Slide deleted successfully.');
        redirect('admin/hero-slider');
    }

    /**
     * Toggle active/inactive status
     */
    public function toggle_status($id = null) {
        $id = (int)$id;
        $slide = $this->General_model->getOne('hero_slides', ['id' => $id]);

        if (!$slide) {
            if ($this->input->is_ajax_request()) {
                return $this->output->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(['status' => 'error', 'message' => 'Slide not found']));
            }
            $this->session->set_flashdata('error', 'Slide not found.');
            redirect('admin/hero-slider');
            return;
        }

        $new_status = ($slide->status === 'active') ? 'inactive' : 'active';
        $this->General_model->update('hero_slides', ['id' => $id], [
            'status'     => $new_status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if ($this->input->is_ajax_request()) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'status'     => 'success',
                    'new_status' => $new_status,
                    'message'    => 'Slide status updated to ' . ucfirst($new_status)
                ]));
        }

        $this->session->set_flashdata('success', 'Slide status updated to ' . ucfirst($new_status) . '.');
        redirect('admin/hero-slider');
    }

    /**
     * Move slide up or down by 1 position inside a single transaction
     */
    public function move($id = null, $direction = 'up') {
        $id = (int)$id;
        $direction = strtolower($direction);

        if (!in_array($direction, ['up', 'down'])) {
            redirect('admin/hero-slider');
            return;
        }

        $this->db->trans_start();

        // Fetch all slides ordered by sort_order ASC, id ASC
        $slides = $this->db->order_by('sort_order', 'ASC')
                           ->order_by('id', 'ASC')
                           ->get('hero_slides')
                           ->result();

        $target_index = -1;
        foreach ($slides as $index => $s) {
            if ((int)$s->id === $id) {
                $target_index = $index;
                break;
            }
        }

        if ($target_index !== -1) {
            if ($direction === 'up' && $target_index > 0) {
                // Swap with previous element
                $temp = $slides[$target_index];
                $slides[$target_index] = $slides[$target_index - 1];
                $slides[$target_index - 1] = $temp;
            } elseif ($direction === 'down' && $target_index < count($slides) - 1) {
                // Swap with next element
                $temp = $slides[$target_index];
                $slides[$target_index] = $slides[$target_index + 1];
                $slides[$target_index + 1] = $temp;
            }

            // Write contiguous sort_order (1, 2, 3...) for all affected items
            foreach ($slides as $idx => $item) {
                $new_order = $idx + 1;
                $this->db->where('id', $item->id)->update('hero_slides', ['sort_order' => $new_order]);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Failed to update slide order.');
        } else {
            $this->session->set_flashdata('success', 'Slide display order updated.');
        }

        redirect('admin/hero-slider');
    }

    /**
     * AJAX drag-and-drop reorder endpoint
     * Updates sort_order for all affected rows inside a single transaction
     */
    public function reorder() {
        if ($this->input->method() !== 'post') {
            return $this->output->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(['status' => 'error', 'message' => 'Method not allowed']));
        }

        $order = $this->input->post('order');
        if (empty($order) || !is_array($order)) {
            return $this->output->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => 'error', 'message' => 'Invalid order data provided']));
        }

        $this->db->trans_start();

        foreach ($order as $index => $slide_id) {
            $slide_id = (int)$slide_id;
            $new_sort = $index + 1; // 1-based sequential ordering
            $this->db->where('id', $slide_id)->update('hero_slides', ['sort_order' => $new_sort]);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return $this->output->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(['status' => 'error', 'message' => 'Failed to persist new slide order']));
        }

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'status'  => 'success',
                'message' => 'Slide display order updated successfully.'
            ]));
    }

    /**
     * AJAX endpoint to fetch single slide data as JSON for editing/preview
     */
    public function get_slide($id = null) {
        $id = (int)$id;
        $slide = $this->General_model->getOne('hero_slides', ['id' => $id]);

        if (!$slide) {
            return $this->output->set_content_type('application/json')
                ->set_status_header(404)
                ->set_output(json_encode(['status' => 'error', 'message' => 'Slide not found']));
        }

        $slide->image_url = base_url('uploads/hero_slider/' . $slide->image);

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'success', 'data' => $slide]));
    }

    /**
     * Re-sequence all slides to strictly contiguous numbers (1, 2, 3...)
     * Runs inside a single transaction
     */
    private function _resequence_order() {
        $this->db->trans_start();
        $slides = $this->db->order_by('sort_order', 'ASC')
                           ->order_by('id', 'ASC')
                           ->get('hero_slides')
                           ->result();

        $seq = 1;
        foreach ($slides as $s) {
            if ((int)$s->sort_order !== $seq) {
                $this->db->where('id', $s->id)->update('hero_slides', ['sort_order' => $seq]);
            }
            $seq++;
        }
        $this->db->trans_complete();
    }

    /**
     * File upload handler for slide images
     */
    private function _handle_image_upload($field_name) {
        $upload_dir = FCPATH . 'uploads/hero_slider/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $config['upload_path']   = $upload_dir;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 5120; // 5MB in KB
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field_name)) {
            $this->session->set_flashdata('error', 'Image Upload Error: ' . $this->upload->display_errors('', ''));
            return false;
        }

        $upload_data = $this->upload->data();
        return $upload_data['file_name'];
    }

    /**
     * Custom validation callback for button links
     * Validates that links are well-formed URLs (https://...) or valid relative paths (/path, #anchor)
     */
    public function _validate_button_link($link) {
        if (empty($link)) {
            return TRUE; // Optional field
        }

        $link = trim($link);

        // Disallow dangerous URI schemes
        if (preg_match('/^(javascript|data|vbscript):/i', $link)) {
            $this->form_validation->set_message('_validate_button_link', 'The {field} cannot contain executable script schemes.');
            return FALSE;
        }

        // Allow well-formed absolute URLs (http, https, protocol-relative)
        if (filter_var($link, FILTER_VALIDATE_URL) !== FALSE) {
            return TRUE;
        }

        // Allow well-formed relative paths, hash anchors, or query paths
        // e.g. /products, /contact, #explore, /products?cat=stove, products/gas-stoves
        if (preg_match('/^(\/|#|\?|[a-zA-Z0-9_\-\.\/]+$)/', $link)) {
            return TRUE;
        }

        $this->form_validation->set_message('_validate_button_link', 'The {field} must be a valid URL (e.g. https://example.com) or relative path (e.g. /products).');
        return FALSE;
    }
}
