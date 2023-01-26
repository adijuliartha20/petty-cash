<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/coba', 'Coba::index');
$routes->get('/users', 'Admin\Users::index');

$routes->get('/kota/edit/(:segment)', 'Admin\Kota::edit/$1');
$routes->get('/kota/create', 'Admin\Kota::create');
$routes->post('/kota/save', 'Admin\Kota::save');
$routes->post('/kota/update', 'Admin\Kota::update');
$routes->delete('/kota/(:num)', 'Admin\Kota::delete/$1');
$routes->get('/kota', 'Admin\Kota::index');

$routes->get('/area/edit/(:segment)', 'Admin\Area::edit/$1');
$routes->get('/area/create', 'Admin\Area::create');
$routes->post('/area/save', 'Admin\Area::save');
$routes->post('/area/update', 'Admin\Area::update');
$routes->delete('/area/(:num)', 'Admin\Area::delete/$1');
$routes->get('/area', 'Admin\Area::index');

$routes->get('/site/edit/(:segment)', 'Admin\Site::edit/$1');
$routes->get('/site/create', 'Admin\Site::create');
$routes->post('/site/save', 'Admin\Site::save');
$routes->post('/site/update', 'Admin\Site::update');
$routes->delete('/site/(:num)', 'Admin\Site::delete/$1');
$routes->get('/site', 'Admin\Site::index');

$routes->get('/user-group/edit/(:segment)', 'Admin\UserGroup::edit/$1');
$routes->get('/user-group/create', 'Admin\UserGroup::create');
$routes->post('/user-group/save', 'Admin\UserGroup::save');
$routes->post('/user-group/update', 'Admin\UserGroup::update');
$routes->delete('/user-group/(:num)', 'Admin\UserGroup::delete/$1');
$routes->get('/user-group', 'Admin\UserGroup::index');

$routes->get('/petty-cash-group/edit/(:segment)', 'Admin\PettyCashGroup::edit/$1');
$routes->get('/petty-cash-group/create', 'Admin\PettyCashGroup::create');
$routes->post('/petty-cash-group/save', 'Admin\PettyCashGroup::save');
$routes->post('/petty-cash-group/update', 'Admin\PettyCashGroup::update');
$routes->delete('/petty-cash-group/(:num)', 'Admin\PettyCashGroup::delete/$1');
$routes->get('/petty-cash-group', 'Admin\PettyCashGroup::index');

$routes->get('/user-petty-cash/edit/(:segment)', 'Admin\UserPettyCash::edit/$1');
$routes->get('/user-petty-cash/create', 'Admin\UserPettyCash::create');
$routes->post('/user-petty-cash/save', 'Admin\UserPettyCash::save');
$routes->post('/user-petty-cash/update', 'Admin\UserPettyCash::update');
$routes->delete('/user-petty-cash/(:num)', 'Admin\UserPettyCash::delete/$1');
$routes->get('/user-petty-cash', 'Admin\UserPettyCash::index');


$routes->get('/', 'Home::index');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
