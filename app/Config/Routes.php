<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/laporan', 'Home::report');
$routes->get('/transaksi', 'TransaksiController::index');

// Supplier
$routes->get('/supplier', 'SupplierController::index');
$routes->get('/supplier/create', 'SupplierController::create');
$routes->post('/supplier/store', 'SupplierController::store');
$routes->get('/supplier/edit/(:num)', 'SupplierController::edit/$1');
$routes->post('/supplier/update/(:num)', 'SupplierController::update/$1');
$routes->post('/supplier/delete/(:num)', 'SupplierController::delete/$1');

// Barang
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/create', 'Barang::create');
$routes->post('/barang/store', 'Barang::store');
$routes->get('/barang/edit/(:segment)', 'Barang::edit/$1');
$routes->post('/barang/update/(:segment)', 'Barang::update/$1');
$routes->get('/barang/delete/(:segment)', 'Barang::delete/$1');

//Transaksi
$routes->get('/', 'TransaksiController::index');  // Set the default route to the Barang controller's index method
$routes->get('/transaksi', 'TransaksiController::index');  // Route to display the barang table
$routes->post('/transaksi/processTransaction', 'TransaksiController::processTransaction');  // Route to handle the transaction form submission



service('auth')->routes($routes);
