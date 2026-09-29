<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Brand Controller (Frontend)
 * Handles "Our Brands" page displaying authorized brand partners,
 * interactive category filtering, trust metrics, and brand distribution cards.
 */
class Brand extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'html', 'text']);
        $this->load->model('General_model');
    }

    /**
     * Display Our Brands page
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

        // Fetch active categories (products & brand types)
        $categories = $this->db->where_in('type', ['product', 'brand'])
                               ->where('status', 'active')
                               ->order_by('sort_order', 'ASC')
                               ->order_by('name', 'ASC')
                               ->get('categories')
                               ->result();

        // Fetch active brands with joined category details
        $this->db->select('b.*, c.name AS category_name, c.type AS category_type');
        $this->db->from('brands b');
        $this->db->join('categories c', 'c.id = b.category_id', 'left');
        $this->db->where('b.status', 'active');
        $this->db->order_by('b.id', 'ASC');
        $brands = $this->db->get()->result();

        // Live count metrics
        $brand_count = count($brands);
        $product_count = $this->db->where('status', 'active')->count_all_results('products');

        $data = [
            'page_title'       => 'Our Brands - Nandani | Authorized Kitchen Appliance Distributors',
            'meta_description' => 'Nandani proudly partners with India\'s most reputed kitchen appliance brands. Explore our authorized brand portfolio.',
            'active_menu'      => 'brands',
            'settings'         => !empty($settings_row) ? $settings_row : [],
            'phone_display'    => $phone_display,
            'phone_raw'        => $phone_raw,
            'email_display'    => $email_display,
            'categories'       => $categories,
            'brands'           => $brands,
            'brand_count'      => $brand_count,
            'product_count'    => $product_count,
            'category_filter'  => $category_slug,
            'extra_css'        => ['page-banner.css', 'brands-page.css'],
            'extra_js'         => ['filter.js']
        ];

        $this->load->view('header', $data);
        $this->load->view('brands_view', $data);
        $this->load->view('footer', $data);
    }
}
