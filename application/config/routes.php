<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Frontend Routes
$route['home'] = 'Home/index';
$route['about'] = 'Home/about';
$route['brands'] = 'Brand/index';
$route['brand'] = 'Brand/index';
$route['brand/(:any)'] = 'Brand/index/$1';
$route['products'] = 'Home/products';
$route['gallery'] = 'Home/gallery';
$route['contact'] = 'Home/contact';
$route['distributor'] = 'Home/distributor';
$route['contact/submit'] = 'Home/contact_submit';

// Admin Auth & Standalone Pages
$route['admin/login'] = 'admin/auth/login';
$route['admin/logout'] = 'admin/auth/logout';
$route['admin/forgot-password'] = 'admin/auth/forgot_password';

// Admin Profile & Password Pages
$route['admin/profile'] = 'admin/profile/index';
$route['admin/profile/update'] = 'admin/profile/update';
$route['admin/change-password'] = 'admin/profile/change_password';
$route['admin/change-password/update'] = 'admin/profile/update_password';

// Admin Panel Modules Routing
$route['admin'] = 'admin/dashboard';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/category'] = 'admin/category';
$route['admin/category/(:any)'] = 'admin/category/$1';
$route['admin/category/(:any)/(:any)'] = 'admin/category/$1/$2';

// Hero Slider Module Routing
$route['admin/hero-slider'] = 'admin/hero_slider/index';
$route['admin/hero-slider/add'] = 'admin/hero_slider/add';
$route['admin/hero-slider/edit/(:num)'] = 'admin/hero_slider/edit/$1';
$route['admin/hero-slider/delete/(:num)'] = 'admin/hero_slider/delete/$1';
$route['admin/hero-slider/toggle-status/(:num)'] = 'admin/hero_slider/toggle_status/$1';
$route['admin/hero-slider/move/(:num)/(:any)'] = 'admin/hero_slider/move/$1/$2';
$route['admin/hero-slider/reorder'] = 'admin/hero_slider/reorder';
$route['admin/hero-slider/get-slide/(:num)'] = 'admin/hero_slider/get_slide/$1';
$route['admin/slider'] = 'admin/hero_slider/index';

// Brands Module Routing
$route['admin/brands'] = 'admin/brand/index';
$route['admin/brands/add'] = 'admin/brand/add';
$route['admin/brands/edit/(:num)'] = 'admin/brand/edit/$1';
$route['admin/brands/delete/(:num)'] = 'admin/brand/delete/$1';
$route['admin/brands/toggle-status/(:num)'] = 'admin/brand/toggle_status/$1';
$route['admin/brand'] = 'admin/brand/index';

// Products Module Routing
$route['admin/products'] = 'admin/product/index';
$route['admin/products/add'] = 'admin/product/add';
$route['admin/products/edit/(:num)'] = 'admin/product/edit/$1';
$route['admin/products/delete/(:num)'] = 'admin/product/delete/$1';
$route['admin/products/toggle-status/(:num)'] = 'admin/product/toggle_status/$1';
$route['admin/product'] = 'admin/product/index';

// Gallery Module Routing
$route['admin/gallery'] = 'admin/gallery/index';
$route['admin/gallery/add'] = 'admin/gallery/add';
$route['admin/gallery/edit/(:num)'] = 'admin/gallery/edit/$1';
$route['admin/gallery/delete/(:num)'] = 'admin/gallery/delete/$1';
$route['admin/gallery/toggle-status/(:num)'] = 'admin/gallery/toggle_status/$1';

// Enquiries Module Routing
$route['admin/enquiries'] = 'admin/enquiry/contact';
$route['admin/enquiries/contact'] = 'admin/enquiry/contact';
$route['admin/enquiries/distributor'] = 'admin/enquiry/distributor';
$route['admin/contact-enquiries'] = 'admin/enquiry/contact';
$route['admin/distributor-enquiries'] = 'admin/enquiry/distributor';
$route['admin/enquiries/update-status'] = 'admin/enquiry/update_status';
$route['admin/enquiries/delete/(:any)/(:num)'] = 'admin/enquiry/delete/$1/$2';
$route['admin/enquiries/export'] = 'admin/enquiry/export';
$route['admin/enquiries/export/(:any)'] = 'admin/enquiry/export/$1';
$route['admin/enquiry'] = 'admin/enquiry/contact';
$route['admin/enquiry/contact'] = 'admin/enquiry/contact';
$route['admin/enquiry/distributor'] = 'admin/enquiry/distributor';
$route['admin/enquiry/update-status'] = 'admin/enquiry/update_status';
$route['admin/enquiry/delete/(:any)/(:num)'] = 'admin/enquiry/delete/$1/$2';
$route['admin/enquiry/export'] = 'admin/enquiry/export';
// Settings Module Routing
$route['admin/settings'] = 'admin/settings/index';
$route['admin/settings/save'] = 'admin/settings/save';
$route['admin/setting'] = 'admin/settings/index';

$route['admin/(:any)'] = 'admin/$1';
$route['admin/(:any)/(:any)'] = 'admin/$1/$2';

