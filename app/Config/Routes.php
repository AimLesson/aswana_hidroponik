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
$routes->get('/supplier/create', 'SupplierController::create');
$routes->post('/supplier/store', 'SupplierController::store');
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/create', 'Barang::create');
$routes->post('/barang/store', 'Barang::store');

// Supplier routes
$routes->group('supplier', ['filter' => 'group:superadmin'], static function ($routes) {
    $routes->get('edit/(:num)', 'SupplierController::edit/$1');
    $routes->post('update/(:num)', 'SupplierController::update/$1');
    $routes->get('delete/(:num)', 'SupplierController::delete/$1'); // Change this line to use GET method
});


// Barang routes
$routes->group('barang', ['filter' => 'group:superadmin'], static function ($routes) {
    $routes->get('edit/(:segment)', 'Barang::edit/$1');
    $routes->post('update/(:segment)', 'Barang::update/$1');
    $routes->get('delete/(:segment)', 'Barang::delete/$1');
});

// Transaksi routes
$routes->group('transaksi', ['filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->get('/', 'TransaksiController::index'); // Default route to TransaksiController index method
    $routes->post('processTransaction', 'TransaksiController::processTransaction'); // Route to handle the transaction form submission
});

// Additional routes for authentication
service('auth')->routes($routes);
