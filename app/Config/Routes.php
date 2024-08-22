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
$routes->get('/', 'Home::landing');
$routes->get('/product', 'Home::produk');
$routes->get('/aboutus', 'Home::aboutus');
$routes->get('/admin', 'Home::index');
$routes->get('/laporan', 'Home::report');
$routes->get('/transaksi', 'TransaksiController::index');
$routes->get('/supplier', 'SupplierController::index');
$routes->get('/supplier/create', 'SupplierController::create');
$routes->post('/supplier/store', 'SupplierController::store');
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/create', 'Barang::create');
$routes->post('/barang/store', 'Barang::store');

// Supplier routes
$routes->get('supplier/edit/(:num)', 'SupplierController::edit/$1', ['filter' => 'group:admin,superadmin']);
$routes->post('supplier/update/(:num)', 'SupplierController::update/$1', ['filter' => 'group:superadmin']);
$routes->get('supplier/delete/(:num)', 'SupplierController::delete/$1', ['filter' => 'group:superadmin']);

// Barang routes
$routes->get('barang/edit/(:segment)', 'Barang::edit/$1', ['filter' => 'group:admin,superadmin']);
$routes->post('barang/update/(:segment)', 'Barang::update/$1', ['filter' => 'group:admin,superadmin']);
$routes->get('barang/delete/(:segment)', 'Barang::delete/$1', ['filter' => 'group:admin,superadmin']);

// Transaksi routes
$routes->get('transaksi', 'TransaksiController::index', ['filter' => 'group:admin,superadmin']);
$routes->post('transaksi/processTransaction', 'TransaksiController::processTransaction', ['filter' => 'group:admin,superadmin']);

$routes->get('/report/get/(:num)', 'TransaksiController::getTransaction/$1', ['filter' => 'group:admin,superadmin']);
$routes->post('/report/update/(:num)', 'TransaksiController::update/$1', ['filter' => 'group:superadmin']);
$routes->delete('/report/delete/(:num)', 'TransaksiController::delete/$1', ['filter' => 'group:superadmin']);


// Additional routes for authentication
service('auth')->routes($routes);
