<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth\Login::index');

$routes->get('login', 'Auth\Login::index');
$routes->post('login', 'Auth\Login::authenticate');
$routes->get('home', 'Home::index');

$routes->get('logout', 'Auth\Login::logout');

$routes->get('register', 'Auth\Register::index');
$routes->post('register/create', 'Auth\Register::create');

$routes->get('business/create', 'Business::create');
$routes->post('business/store', 'Business::store');
$routes->get('business/profile', 'Business::profile');
$routes->post('business/profile/update', 'Business::update');

$routes->get('business/create', 'Master\Business::create');
$routes->post('business/store', 'Master\Business::store');

$routes->get('products', 'Master\Product::index');
$routes->get('products/create', 'Master\Product::create');
$routes->post('products/store', 'Master\Product::store');

$routes->get('customers', 'Master\Customer::index');
$routes->get('customers/create', 'Master\Customer::create');
$routes->post('customers/store', 'Master\Customer::store');

$routes->get('channels', 'Master\Channel::index');
$routes->get('channels/create', 'Master\Channel::create');
$routes->post('channels/store', 'Master\Channel::store');

$routes->get('sales/input', 'Sales\Input::index');
$routes->post('sales/store', 'Sales\Input::store');
$routes->get('sales/history', 'Sales\History::index');