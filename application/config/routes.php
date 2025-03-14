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

$route = [
    // Default Controller
    'default_controller' => 'DashboardController',

    // API Routes
    'api/product' => 'api/ApiProductController/store',

    // Product Routes
    'product' => 'ProductController/index',
    'product/add' => 'ProductController/add',
    'product/store' => 'ProductController/store',
    'product/edit/(:num)' => 'ProductController/edit/$1',
    'product/destroy/(:num)' => 'ProductController/destroy/$1',

    // Categories Routes
    'categories' => 'CategoriesController/index',
    'categories/add' => 'CategoriesController/add',
    'categories/store' => 'CategoriesController/store',
    'categories/edit/(:num)' => 'CategoriesController/edit/$1',
    'categories/destroy/(:num)' => 'CategoriesController/destroy/$1',

    // Status Routes
    'status' => 'StatusController/index',
    'status/add' => 'StatusController/add',
    'status/store' => 'StatusController/store',
    'status/edit/(:num)' => 'StatusController/edit/$1',
    'status/destroy/(:num)' => 'StatusController/destroy/$1',

    // Database Migration
    'migrate' => 'DatabaseMigrationController/migrate',

    // 404 Override
    '404_override' => '',

    // URI Dash to Underscore
    'translate_uri_dashes' => FALSE
];

