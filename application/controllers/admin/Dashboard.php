<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Dashboard Controller
 */
class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // Retrieve statistics for overview cards
        $categories_total = $this->db->count_all('categories');
        $categories_product = $this->db->where('type', 'product')->count_all_results('categories');
        $categories_gallery = $this->db->where('type', 'gallery')->count_all_results('categories');
        $categories_brand = $this->db->where('type', 'brand')->count_all_results('categories');

        // Recent categories
        $recent_categories = $this->db->order_by('id', 'DESC')->limit(5)->get('categories')->result();

        $data = [
            'page_title'        => 'Admin Dashboard',
            'breadcrumb'        => 'Dashboard',
            'active_menu'       => 'dashboard',
            'stats'             => [
                'total_categories'   => $categories_total,
                'product_categories' => $categories_product,
                'gallery_categories' => $categories_gallery,
                'brand_categories'   => $categories_brand
            ],
            'recent_categories' => $recent_categories
        ];

        $this->render('dashboard_view', $data);
    }
}
