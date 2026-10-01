<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product Controller (Frontend)
 * Handles "Products" page displaying real products from database,
 * interactive category filtering, instant live search, quick view modal,
 * and catalogue download.
 */
class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'html', 'text', 'form']);
        $this->load->model('General_model');
    }

    /**
     * Display Products Catalogue page
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

        // Fetch active product categories for footer and filter buttons
        $categories = $this->db->where('type', 'product')
                               ->where('status', 'active')
                               ->order_by('sort_order', 'ASC')
                               ->order_by('name', 'ASC')
                               ->get('categories')
                               ->result();

        // Fetch active brands
        $brands = $this->db->where('status', 'active')
                           ->order_by('name', 'ASC')
                           ->get('brands')
                           ->result();

        // Fetch active products strictly from DB (no dummy data)
        $this->db->select('products.*, brands.name AS brand_name, brands.logo_image AS brand_logo, categories.name AS category_name, categories.type AS category_type');
        $this->db->from('products');
        $this->db->join('brands', 'brands.id = products.brand_id', 'left');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->where('products.status', 'active');
        $this->db->order_by('products.id', 'DESC');
        $products = $this->db->get()->result();

        $selected_cat = $this->input->get('category', TRUE) ?? $category_slug;
        $selected_brand = $this->input->get('brand', TRUE);
        $search_query = $this->input->get('q', TRUE);

        $data = [
            'page_title'       => 'Products - Nandani | Kitchen Appliance Catalogue',
            'meta_description' => 'Explore Nandani\'s complete range of kitchen appliances - Gas Stoves, Mixer Grinders, Cookware, Chimneys and more from reputed brands.',
            'active_menu'      => 'products',
            'settings'         => !empty($settings_row) ? $settings_row : [],
            'phone_display'    => $phone_display,
            'phone_raw'        => $phone_raw,
            'email_display'    => $email_display,
            'categories'       => $categories,
            'brands'           => $brands,
            'products'         => $products,
            'total_products'   => count($products),
            'selected_cat'     => $selected_cat,
            'selected_brand'   => $selected_brand,
            'search_query'     => $search_query,
            'extra_css'        => ['page-banner.css', 'common.css', 'products-page.css'],
            'extra_js'         => ['product-filter.js']
        ];

        $this->load->view('header', $data);
        $this->load->view('products_view', $data);
        $this->load->view('footer', $data);
    }
}
