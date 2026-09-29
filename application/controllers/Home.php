<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('General_model');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form', 'html']);
    }

    /**
     * Home Page (User Side)
     */
    public function index()
    {
        // 1. Fetch Active Hero Slides ordered by sort_order
        $hero_slides = $this->db->where('status', 'active')
                                ->order_by('sort_order', 'ASC')
                                ->order_by('id', 'ASC')
                                ->get('hero_slides')
                                ->result();

        // 2. Fetch Active Brands (Top 4 for spotlight showcase)
        $brands = $this->db->select('brands.*, categories.name as category_name')
                           ->from('brands')
                           ->join('categories', 'categories.id = brands.category_id', 'left')
                           ->where('brands.status', 'active')
                           ->order_by('brands.id', 'ASC')
                           ->limit(4)
                           ->get()
                           ->result();

        // 3. Fetch Active Product Categories
        $categories = $this->db->where('type', 'product')
                               ->where('status', 'active')
                               ->order_by('sort_order', 'ASC')
                               ->order_by('id', 'ASC')
                               ->get('categories')
                               ->result();

        // 4. Fetch Active Products (with category & brand info)
        $this->db->select('products.*, categories.name as category_name, brands.name as brand_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->join('brands', 'brands.id = products.brand_id', 'left');
        $this->db->where('products.status', 'active');
        $this->db->order_by('products.id', 'DESC');
        $products = $this->db->get()->result();

        // 5. Fetch Active Gallery Preview Items (up to 4 items for homepage)
        $gallery_items = $this->db->where('status', 'active')
                                  ->order_by('id', 'DESC')
                                  ->limit(4)
                                  ->get('gallery')
                                  ->result();

        // 6. Fetch Website Settings
        $settings_row = $this->db->get_where('settings', ['id' => 1])->row_array();
        $settings = !empty($settings_row) ? $settings_row : [];

        // 7. Counts for stats section
        $brand_count   = $this->db->where('status', 'active')->count_all_results('brands');
        $product_count = $this->db->where('status', 'active')->count_all_results('products');

        $data = [
            'page_title'       => 'Nandani - Kitchen Appliance Distributors',
            'meta_description' => 'Nandani - Trusted distributors of premium kitchen appliances across India. From manufacturing legacy to authorized distribution excellence.',
            'active_menu'      => 'home',
            'hero_slides'      => $hero_slides,
            'brands'           => $brands,
            'categories'       => $categories,
            'products'         => $products,
            'gallery_items'    => $gallery_items,
            'settings'         => $settings,
            'brand_count'      => $brand_count,
            'product_count'    => $product_count
        ];

        $this->load->view('header', $data);
        $this->load->view('home_view', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Handle Contact Enquiry form submit from Home page
     */
    public function contact_submit()
    {
        $this->form_validation->set_rules('name', 'Your Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[7]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|max_length[150]');
        $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('message', 'Message', 'trim|max_length[1000]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('contact_error', validation_errors('<span>', '</span><br>'));
            redirect(site_url('#contact'));
            return;
        }

        $insert_data = [
            'name'       => $this->input->post('name', TRUE),
            'phone'      => $this->input->post('phone', TRUE),
            'email'      => $this->input->post('email', TRUE),
            'city'       => $this->input->post('city', TRUE),
            'subject'    => 'Website Inquiry (Home)',
            'message'    => $this->input->post('message', TRUE) ?: '',
            'status'     => 'new',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $inserted = $this->General_model->insert('contact_enquiries', $insert_data);

        if ($inserted) {
            $this->session->set_flashdata('contact_success', 'Thank you for reaching out! Our team will contact you shortly.');
        } else {
            $this->session->set_flashdata('contact_error', 'Something went wrong while submitting your inquiry. Please try again.');
        }

        redirect(site_url('#contact'));
    }

    /**
     * Stubs for remaining pages (to prevent broken links when clicking navbar during testing)
     */
    /**
     * About Us Page
     */
    public function about()
    {
        $settings_row = $this->db->get_where('settings', ['id' => 1])->row_array();
        $categories = $this->db->where('type', 'product')
                               ->where('status', 'active')
                               ->order_by('sort_order', 'ASC')
                               ->order_by('id', 'ASC')
                               ->get('categories')
                               ->result();

        $data = [
            'page_title'       => 'About Us - Nandani | Kitchen Appliance Distributors',
            'meta_description' => 'Discover Nandani\'s journey from a trusted kitchen appliance manufacturer to India\'s leading authorized distributor.',
            'active_menu'      => 'about',
            'settings'         => !empty($settings_row) ? $settings_row : [],
            'categories'       => $categories,
            'extra_css'        => ['page-banner.css', 'about-intro.css', 'mission-vision.css', 'timeline.css', 'founder.css']
        ];

        $this->load->view('header', $data);
        $this->load->view('about_view', $data);
        $this->load->view('footer', $data);
    }

    public function brands()
    {
        redirect('brands');
    }

    public function products()
    {
        $this->_stub_page('products', 'Products Catalogue - Nandani');
    }

    public function gallery()
    {
        $this->_stub_page('gallery', 'Gallery - Nandani');
    }

    public function contact()
    {
        $this->_stub_page('contact', 'Contact Us - Nandani');
    }

    public function distributor()
    {
        $this->_stub_page('distributor', 'Become a Distributor - Nandani');
    }

    private function _stub_page($page_name, $title)
    {
        $settings_row = $this->db->get_where('settings', ['id' => 1])->row_array();
        $categories = $this->db->where('type', 'product')->where('status', 'active')->get('categories')->result();
        
        $data = [
            'page_title'  => $title,
            'active_menu' => $page_name,
            'settings'    => !empty($settings_row) ? $settings_row : [],
            'categories'  => $categories
        ];

        // If the view exists, load it, otherwise redirect to home
        if (file_exists(APPPATH . 'views/' . $page_name . '_view.php')) {
            $this->load->view('header', $data);
            $this->load->view($page_name . '_view', $data);
            $this->load->view('footer', $data);
        } else {
            // For now, redirect or show home
            redirect(site_url(''));
        }
    }
}
