<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Dashboard Controller
 * Computes live operational metrics, category distributions, monthly enquiry trends,
 * and recent leads for the redesigned enterprise dashboard.
 */
class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Dashboard landing page
     */
    public function index() {
        // 1. Primary Portfolio & Catalog Counters
        $total_products = $this->db->table_exists('products') 
            ? (int)$this->db->count_all('products') 
            : 0;
        $active_products = $this->db->table_exists('products') 
            ? (int)$this->db->where('status', 'active')->count_all_results('products') 
            : 0;

        $total_brands = $this->db->table_exists('brands') 
            ? (int)$this->db->count_all('brands') 
            : 0;
        $active_brands = $this->db->table_exists('brands') 
            ? (int)$this->db->where('status', 'active')->count_all_results('brands') 
            : 0;

        $total_categories = $this->db->table_exists('categories') 
            ? (int)$this->db->count_all('categories') 
            : 0;
        $product_categories = $this->db->table_exists('categories') 
            ? (int)$this->db->where('type', 'product')->count_all_results('categories') 
            : 0;
        $gallery_categories = $this->db->table_exists('categories') 
            ? (int)$this->db->where('type', 'gallery')->count_all_results('categories') 
            : 0;

        $total_slides = $this->db->table_exists('hero_slides') 
            ? (int)$this->db->count_all('hero_slides') 
            : 0;
        $active_slides = $this->db->table_exists('hero_slides') 
            ? (int)$this->db->where('status', 'active')->count_all_results('hero_slides') 
            : 0;

        $total_gallery = $this->db->table_exists('gallery') 
            ? (int)$this->db->count_all('gallery') 
            : 0;
        $active_gallery = $this->db->table_exists('gallery') 
            ? (int)$this->db->where('status', 'active')->count_all_results('gallery') 
            : 0;

        // 2. Enquiries Pipeline Counts & Statuses
        $contact_total = $this->db->table_exists('contact_enquiries') 
            ? (int)$this->db->count_all('contact_enquiries') 
            : 0;
        $contact_new = $this->db->table_exists('contact_enquiries') 
            ? (int)$this->db->where('status', 'new')->count_all_results('contact_enquiries') 
            : 0;
        $contact_contacted = $this->db->table_exists('contact_enquiries') 
            ? (int)$this->db->where('status', 'contacted')->count_all_results('contact_enquiries') 
            : 0;
        $contact_closed = $this->db->table_exists('contact_enquiries') 
            ? (int)$this->db->where('status', 'closed')->count_all_results('contact_enquiries') 
            : 0;

        $distributor_total = $this->db->table_exists('distributor_enquiries') 
            ? (int)$this->db->count_all('distributor_enquiries') 
            : 0;
        $distributor_new = $this->db->table_exists('distributor_enquiries') 
            ? (int)$this->db->where('status', 'new')->count_all_results('distributor_enquiries') 
            : 0;
        $distributor_contacted = $this->db->table_exists('distributor_enquiries') 
            ? (int)$this->db->where('status', 'contacted')->count_all_results('distributor_enquiries') 
            : 0;
        $distributor_closed = $this->db->table_exists('distributor_enquiries') 
            ? (int)$this->db->where('status', 'closed')->count_all_results('distributor_enquiries') 
            : 0;

        $total_enquiries = $contact_total + $distributor_total;
        $total_new_enquiries = $contact_new + $distributor_new;

        // 3. Product Badge Stats
        $product_badges = [
            'new'        => 0,
            'bestseller' => 0,
            'none'       => 0
        ];
        if ($this->db->table_exists('products')) {
            $badge_rows = $this->db->select('badge, COUNT(*) as count')
                ->group_by('badge')
                ->get('products')->result();
            foreach ($badge_rows as $br) {
                if (isset($product_badges[$br->badge])) {
                    $product_badges[$br->badge] = (int)$br->count;
                }
            }
        }

        // 4. Category Breakdown for Doughnut Chart
        $category_distribution = [];
        if ($this->db->table_exists('categories')) {
            $cat_rows = $this->db->select('categories.name, COUNT(products.id) as product_count')
                ->from('categories')
                ->where('categories.type', 'product')
                ->join('products', 'products.category_id = categories.id', 'left')
                ->group_by('categories.id')
                ->get()->result();
            foreach ($cat_rows as $cr) {
                $category_distribution[] = [
                    'name'  => $cr->name,
                    'count' => (int)$cr->product_count
                ];
            }
        }

        // 5. Monthly Trend Data for Last 6 Months (Contact vs Distributor)
        $months = [];
        $contact_trend = [];
        $distributor_trend = [];

        for ($i = 5; $i >= 0; $i--) {
            $month_key = date('Y-m', strtotime("-$i months"));
            $month_label = date('M Y', strtotime("-$i months"));
            $months[] = $month_label;

            $c_count = 0;
            if ($this->db->table_exists('contact_enquiries')) {
                $c_row = $this->db->select('COUNT(*) as c')
                    ->where("DATE_FORMAT(created_at, '%Y-%m') =", $month_key)
                    ->get('contact_enquiries')->row();
                $c_count = (int)($c_row->c ?? 0);
            }
            $contact_trend[] = $c_count;

            $d_count = 0;
            if ($this->db->table_exists('distributor_enquiries')) {
                $d_row = $this->db->select('COUNT(*) as c')
                    ->where("DATE_FORMAT(created_at, '%Y-%m') =", $month_key)
                    ->get('distributor_enquiries')->row();
                $d_count = (int)($d_row->c ?? 0);
            }
            $distributor_trend[] = $d_count;
        }

        // 6. Recent Combined Inquiries (Top 6 latest leads)
        $recent_enquiries = [];
        if ($this->db->table_exists('contact_enquiries')) {
            $contacts = $this->db->select("id, name, email, phone, city, subject as title_info, message, status, created_at, 'contact' as type")
                ->order_by('created_at', 'DESC')
                ->limit(6)
                ->get('contact_enquiries')->result();
            foreach ($contacts as $c) {
                $recent_enquiries[] = $c;
            }
        }
        if ($this->db->table_exists('distributor_enquiries')) {
            $distributors = $this->db->select("id, name, email, phone, city, business_name as title_info, message, status, created_at, 'distributor' as type")
                ->order_by('created_at', 'DESC')
                ->limit(6)
                ->get('distributor_enquiries')->result();
            foreach ($distributors as $d) {
                $recent_enquiries[] = $d;
            }
        }
        usort($recent_enquiries, function($a, $b) {
            return strtotime($b->created_at) - strtotime($a->created_at);
        });
        $recent_enquiries = array_slice($recent_enquiries, 0, 6);

        // 7. Site Settings for Support Info
        $settings = null;
        if ($this->db->table_exists('settings')) {
            $settings = $this->db->order_by('id', 'ASC')->limit(1)->get('settings')->row();
        }

        $data = [
            'page_title'            => 'Admin Dashboard',
            'breadcrumb'            => 'Dashboard',
            'active_menu'           => 'dashboard',
            'today_date'            => date('l, F j, Y'),
            
            // Primary Counts
            'total_products'        => $total_products,
            'active_products'       => $active_products,
            'total_brands'          => $total_brands,
            'active_brands'         => $active_brands,
            'total_categories'      => $total_categories,
            'product_categories'    => $product_categories,
            'gallery_categories'    => $gallery_categories,
            'total_slides'          => $total_slides,
            'active_slides'         => $active_slides,
            'total_gallery'         => $total_gallery,
            'active_gallery'        => $active_gallery,
            
            // Enquiry Metrics
            'total_enquiries'       => $total_enquiries,
            'total_new_enquiries'   => $total_new_enquiries,
            'contact_total'         => $contact_total,
            'contact_new'           => $contact_new,
            'contact_contacted'     => $contact_contacted,
            'contact_closed'        => $contact_closed,
            'distributor_total'     => $distributor_total,
            'distributor_new'       => $distributor_new,
            'distributor_contacted' => $distributor_contacted,
            'distributor_closed'    => $distributor_closed,

            // Chart Data
            'months'                => $months,
            'contact_trend'         => $contact_trend,
            'distributor_trend'     => $distributor_trend,
            'product_badges'        => $product_badges,
            'category_distribution' => $category_distribution,

            // Activity & Settings
            'recent_enquiries'      => $recent_enquiries,
            'settings'              => $settings
        ];

        $this->render('dashboard_view', $data);
    }
}
