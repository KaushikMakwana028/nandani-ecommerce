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

        // Get product counts per brand
        $brand_product_counts = [];
        $counts_query = $this->db->select('brand_id, COUNT(*) as cnt')
                                 ->where('status', 'active')
                                 ->group_by('brand_id')
                                 ->get('products')
                                 ->result();
        foreach ($counts_query as $c) {
            $brand_product_counts[$c->brand_id] = (int)$c->cnt;
        }
        $total_all_products = array_sum($brand_product_counts);

        $selected_cat = $this->input->get('category', TRUE) ?? $category_slug;
        $selected_brand = $this->input->get('brand', TRUE);
        $search_query = $this->input->get('q', TRUE);

        // Resolve brand if selected
        $current_brand = null;
        if (!empty($selected_brand)) {
            if (is_numeric($selected_brand)) {
                $current_brand = $this->db->where('id', (int)$selected_brand)
                                          ->where('status', 'active')
                                          ->get('brands')
                                          ->row();
            } else {
                $clean_brand = strtolower(trim($selected_brand));
                $clean_brand_spaces = str_replace('-', ' ', $clean_brand);
                $current_brand = $this->db->where('status', 'active')
                                          ->group_start()
                                              ->where('LOWER(name)', $clean_brand)
                                              ->or_where('LOWER(name)', $clean_brand_spaces)
                                          ->group_end()
                                          ->get('brands')
                                          ->row();
            }
        }

        // Fetch active products strictly from DB (filtered by brand if requested)
        $this->db->select('products.*, brands.name AS brand_name, brands.logo_image AS brand_logo, categories.name AS category_name, categories.type AS category_type');
        $this->db->from('products');
        $this->db->join('brands', 'brands.id = products.brand_id', 'left');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->where('products.status', 'active');

        if (!empty($current_brand)) {
            $this->db->where('products.brand_id', $current_brand->id);
        } elseif (!empty($selected_brand)) {
            if (is_numeric($selected_brand)) {
                $this->db->where('products.brand_id', (int)$selected_brand);
            } else {
                $this->db->where('products.brand_id', -1);
            }
        }

        $this->db->order_by('products.id', 'DESC');
        $products = $this->db->get()->result();

        $page_title = 'Products - Nandani | Kitchen Appliance Catalogue';
        $meta_description = 'Explore Nandani\'s complete range of kitchen appliances - Gas Stoves, Mixer Grinders, Cookware, Chimneys and more from reputed brands.';
        if (!empty($current_brand)) {
            $page_title = $current_brand->name . ' Products - Nandani | Kitchen Appliance Catalogue';
            $meta_description = 'Explore the full range of ' . $current_brand->name . ' kitchen appliances authorized and distributed by Nandani.';
        }

        $data = [
            'page_title'           => $page_title,
            'meta_description'     => $meta_description,
            'active_menu'          => 'products',
            'settings'             => !empty($settings_row) ? $settings_row : [],
            'phone_display'        => $phone_display,
            'phone_raw'            => $phone_raw,
            'email_display'        => $email_display,
            'categories'           => $categories,
            'brands'               => $brands,
            'brand_product_counts' => $brand_product_counts,
            'total_all_products'   => $total_all_products,
            'products'             => $products,
            'total_products'       => count($products),
            'selected_cat'         => $selected_cat,
            'selected_brand'       => $selected_brand,
            'current_brand'        => $current_brand,
            'search_query'         => $search_query,
            'extra_css'            => ['page-banner.css', 'common.css', 'products-page.css'],
            'extra_js'             => ['product-filter.js']
        ];

        $this->load->view('header', $data);
        $this->load->view('products_view', $data);
        $this->load->view('footer', $data);
    }
}
