<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');


//<----- BARANG ------>
$routes->get('barang', 'Barang::index');
$routes->get('barang/new', 'Barang::new');
$routes->post('barang/create', 'Barang::create');

$routes->get('barang/edit/(:num)', 'Barang::edit/$1');
$routes->post('barang/update/(:num)', 'Barang::update/$1');

$routes->get('barang/delete/(:num)', 'Barang::delete/$1');

//<----- PELANGGAN ----->
$routes->get('pelanggan', 'pelanggan::index');
$routes->get('pelanggan/new', 'pelanggan::new');
$routes->post('pelanggan/create', 'pelanggan::create');

$routes->get('pelanggan/edit/(:num)', 'pelanggan::edit/$1');
$routes->post('pelanggan/update/(:num)', 'pelanggan::update/$1');

$routes->get('pelanggan/delete/(:num)', 'pelanggan::delete/$1');

//<----- TRANSAKSI ----->
$routes->get('transaksi', 'transaksi::index');
$routes->get('transaksi/new', 'transaksi::new');
$routes->post('transaksi/create', 'transaksi::create');

$routes->get('transaksi/edit/(:num)', 'transaksi::edit/$1');
$routes->post('transaksi/update/(:num)', 'transaksi::update/$1');

$routes->get('transaksi/delete/(:num)', 'transaksi::delete/$1');

//<----- DETAIL TRANSAKSI ----->
$routes->get('detailtransaksi', 'detailtransaksi::index');
$routes->get('detailtransaksi/new', 'detailtransaksi::new');
$routes->post('detailtransaksi/create', 'detailtransaksi::create');

$routes->get('detailtransaksi/edit/(:num)', 'detailtransaksi::edit/$1');
$routes->post('detailtransaksi/update/(:num)', 'detailtransaksi::update/$1');

$routes->get('detailtransaksi/delete/(:num)', 'detailtransaksi::delete/$1');

$routes->get('transaksi/show/(:num)', 'Transaksi::show/$1');


