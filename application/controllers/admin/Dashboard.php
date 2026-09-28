<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Dashboard Controller
 * Displays welcome banner and live count statistics using the shared admin layout
 */
class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Dashboard landing page
     * Pulls live counts from modules, gracefully handling missing/empty tables
     */
    public function index() {
        // Safe live count queries - return 0 if table does not exist or is empty
        $total_products = $this->db->table_exists('products') 
            ? (int)$this->db->count_all('products') 
            : 0;

        $total_brands = $this->db->table_exists('brands') 
            ? (int)$this->db->count_all('brands') 
            : 0;

        $total_gallery = $this->db->table_exists('gallery') 
            ? (int)$this->db->count_all('gallery') 
            : 0;

        $contact_count = $this->db->table_exists('contact_enquiries') 
            ? (int)$this->db->count_all('contact_enquiries') 
            : 0;

        $distributor_count = $this->db->table_exists('distributor_enquiries') 
            ? (int)$this->db->count_all('distributor_enquiries') 
            : 0;

        $total_enquiries = $contact_count + $distributor_count;

        $data = [
            'page_title'      => 'Dashboard',
            'breadcrumb'      => 'Dashboard',
            'active_menu'     => 'dashboard',
            'today_date'      => date('l, F j, Y'),
            'total_products'  => $total_products,
            'total_brands'    => $total_brands,
            'total_gallery'   => $total_gallery,
            'total_enquiries' => $total_enquiries
        ];

        $this->render('dashboard_view', $data);
    }
}
