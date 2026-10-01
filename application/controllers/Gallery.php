<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gallery Controller (Frontend)
 * Handles "Gallery" visual journey page displaying real gallery media from database,
 * interactive category filtering, and GLightbox popup preview.
 */
class Gallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'html', 'text', 'form']);
        $this->load->model('General_model');
    }

    /**
     * Display Gallery page
     *
     * @param string|null $category_slug Optional category filter slug from URI
     */
    public function index($category_slug = null) {
        // Fetch site settings
        $settings_row = $this->db->get_where('settings', ['id' => 1])->row_array();

        // Extract primary phone and email for views
        $phone_display = '+91 123 456 7890';
        $phone_raw = '+911234567890';
        if (!empty($settings_row['phone_numbers'])) {
            $phones = array_map('trim', explode(',', $settings_row['phone_numbers']));
            if (!empty($phones[0])) {
                $phone_display = $phones[0];
                $phone_raw = preg_replace('/[^0-9+]/', '', $phones[0]);
            }
        }

        $email_display = 'info@nandani.com';
        if (!empty($settings_row['emails'])) {
            $emails = array_map('trim', explode(',', $settings_row['emails']));
            if (!empty($emails[0])) {
                $email_display = $emails[0];
            }
        }

        // Fetch active product categories for footer
        $categories = $this->db->where('type', 'product')
                               ->where('status', 'active')
                               ->order_by('sort_order', 'ASC')
                               ->order_by('name', 'ASC')
                               ->get('categories')
                               ->result();

        // Fetch active gallery categories
        $gallery_categories = $this->db->where('type', 'gallery')
                                       ->where('status', 'active')
                                       ->order_by('sort_order', 'ASC')
                                       ->order_by('name', 'ASC')
                                       ->get('categories')
                                       ->result();

        // Fetch active gallery items strictly from DB (no dummy data)
        $this->db->select('gallery.*, categories.name AS category_name, categories.type AS category_type');
        $this->db->from('gallery');
        $this->db->join('categories', 'categories.id = gallery.category_id', 'left');
        $this->db->where('gallery.status', 'active');
        $this->db->order_by('gallery.id', 'DESC');
        $gallery_items = $this->db->get()->result();

        $selected_category = $this->input->get('category', TRUE) ?? $category_slug;

        $data = [
            'page_title'         => 'Gallery - Nandani | Kitchen Appliance Distributors',
            'meta_description'   => 'Explore Nandani\'s gallery - warehouse, events, product showcases, and team moments.',
            'active_menu'        => 'gallery',
            'settings'           => !empty($settings_row) ? $settings_row : [],
            'phone_display'      => $phone_display,
            'phone_raw'          => $phone_raw,
            'email_display'      => $email_display,
            'categories'         => $categories,
            'gallery_categories' => $gallery_categories,
            'gallery_items'      => $gallery_items,
            'selected_category'  => $selected_category,
            'extra_css'          => [
                'page-banner.css',
                'common.css',
                'gallery-page.css',
                'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css'
            ],
            'extra_js'           => [
                'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js',
                'gallery-filter.js'
            ]
        ];

        $this->load->view('header', $data);
        $this->load->view('gallery_view', $data);
        $this->load->view('footer', $data);
    }
}
