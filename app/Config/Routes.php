<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);
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

$routes->match(['get', 'post'], 'SignupController/store', 'SignupController::store', ['filter' => 'noauthGuard']);
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'SigninController::loginAuth', ['filter' => 'noauthGuard']);
$routes->match(['get', 'post'], 'ConteudoController/store', 'ConteudoController::store', ['filter' => 'adminauthGuard']);
$routes->match(['get', 'post'], 'ConteudoController/update', 'ConteudoController::update', ['filter' => 'adminauthGuard']);
$routes->match(['get', 'post'], 'UserController/update', 'UserController::update', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], 'UserController/changepassword', 'UserController::changepassword', ['filter' => 'authGuard']);

$routes->get('login', 'SigninController::login', ['filter' => 'noauthGuard']);
$routes->get('logout', 'SigninController::logout', ['filter' => 'authGuard']);
$routes->get('cadastro', 'SignupController::register', ['filter' => 'noauthGuard']);
$routes->get('/', 'Home::index');
$routes->get('profile/(:num)', 'UserController::index/$1');
$routes->get('users', 'UserController::list', ['filter' => 'adminauthGuard']);
$routes->get('user/edit/(:num)', 'UserController::edit/$1', ['filter' => 'authGuard']);
$routes->get('user/delete/(:num)', 'UserController::delete/$1', ['filter' => 'authGuard']);
$routes->get('user/alterpassword', 'UserController::alterpassword', ['filter' => 'authGuard']);
$routes->get('create', 'ConteudoController::create', ['filter' => 'adminauthGuard']); //ConteudoController
$routes->get('conteudo/delete/(:num)', 'ConteudoController::delete/$1', ['filter' => 'adminauthGuard']);
$routes->get('conteudo/edit/(:num)', 'ConteudoController::edit/$1', ['filter' => 'adminauthGuard']);

$routes->get('conteudo/(:num)', 'ConteudoController::show/$1');


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
