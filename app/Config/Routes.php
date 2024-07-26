<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Authorization routes
$routes->group('admin', ['filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->group(
        '',
        ['filter' => ['group:admin,superadmin', 'permission:users.manage']],
        static function ($routes) {
            $routes->resource('users');
        }
    );
});

// Home routes
$routes->get('/', 'Home::index');
$routes->get('/laporan', 'Home::report');
$routes->get('/transaksi', 'TransaksiController::index');
$routes->get('/supplier', 'SupplierController::index');
$routes->get('create', 'SupplierController::create');
$routes->get('/barang', 'Barang::index');
$routes->get('create', 'Barang::create');



// Supplier routes
$routes->group('supplier', ['filter' => 'group:superadmin'], static function ($routes) {
    $routes->post('store', 'SupplierController::store');
    $routes->get('edit/(:num)', 'SupplierController::edit/$1');
    $routes->post('update/(:num)', 'SupplierController::update/$1');
    $routes->post('delete/(:num)', 'SupplierController::delete/$1');
});

// Barang routes
$routes->group('barang', ['filter' => 'group:superadmin'], static function ($routes) {
    $routes->post('store', 'Barang::store');
    $routes->get('edit/(:segment)', 'Barang::edit/$1');
    $routes->post('update/(:segment)', 'Barang::update/$1');
    $routes->get('delete/(:segment)', 'Barang::delete/$1');
});

// Transaksi routes
$routes->group('transaksi', ['filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->get('/', 'TransaksiController::index');  // Set the default route to the Barang controller's index method
    $routes->get('transaksi', 'TransaksiController::index');  // Route to display the barang table
    $routes->post('processTransaction', 'TransaksiController::processTransaction');  // Route to handle the transaction form submission
});

// Additional routes for authentication
service('auth')->routes($routes);
