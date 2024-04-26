<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->group('authentication', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::login');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::register');
});


$routes->get('/', 'Home::display');
$routes->get('/info', 'Home::info');
$routes->get('/TugasB', 'C_mahasiswa::table1');
$routes->get('/Mahasiswa', 'CMahasiswa::table');
$routes->get('/Barang', 'C_alattulis::display');
$routes->get('barang/delete/(:segment)', 'C_alattulis::delete/$1');
$routes->get('barang/view/(:segment)', 'C_alattulis::view/$1');
$routes->get('/barang/create', 'C_alattulis::create');
$routes->post('/barang/store', 'C_alattulis::store');
$routes->get('validation', 'C_validation::index');
$routes->post('validation/submit', 'C_validation::submit');
$routes->get('barang/edit/(:segment)', 'C_alattulis::edit/$1');
$routes->post('/barang/update/(:segment)', 'C_alattulis::update/$1');
