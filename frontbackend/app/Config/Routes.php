<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
// $routes->post('/user/login', 'AuthController::userLogin');
// $routes->post('/ustadz/login', 'AuthController::ustadzLogin');
// $routes->post('/test/login', 'AuthController::createe');
// $routes->get('/registrasi', 'registerController::register');


//bagian user(pengguna dan ustadz)
//login user
$routes->match(['post', 'options'], '/user/login', 'AuthController::userLogin');
//login ustadz
$routes->match(['post', 'options'], '/ustadz/login', 'AuthController::ustadzLogin');
//register user
$routes->match(['post', 'options'], '/register', 'RegisterController::createUser');
// $routes->match(['post'], '/registeranjay', 'RegisterController::index');



//bagian admin
//admin login
$routes->match(['post', 'options'], '/adminlogin', 'adminController::adminLogin');
//membaca admin
$routes->get('/admins', 'adminController::getAdmins');
//mebuat admin
$routes->match(['post', 'options'], 'admin/create', 'AuthController::createAdmin');
//edit admin
$routes->match(['put', 'options'], 'admin/edit/(:segment)', 'AuthController::editadmin/$1');
//baca admin id
$routes->get('admin/(:segment)', 'AuthController::getAdmin/$1');
//hapus admin
$routes->match(['delete', 'options'], 'admin/delete/(:num)', 'AuthController::deleteAdmin/$1');


//bagian user
//baca user
$routes->get('/user', 'AuthController::getUser');
// $routes->put('user/edit/(:num)', 'AuthController::editUser/$1');
//baca user per id
$routes->get('usera/(:segment)', 'AuthController::getUserr/$1');
//edit user
$routes->match(['put', 'options'], 'user/edit/(:segment)', 'AuthController::editUser/$1');
//hapus user
$routes->match(['delete', 'options'], 'user/delete/(:num)', 'AuthController::delete/$1');

//bagian ustadz
//baca ustadz
$routes->get('/ustadz', 'AuthController::getUstadz');
//membuat akun ustadz
$routes->match(['post', 'options'], 'ustadz/create', 'AuthController::createUstadz');
//baca ustadz per id
$routes->get('ustadz/(:segment)', 'AuthController::getUstadzz/$1');
//edit ustadz
$routes->match(['put', 'options'], 'ustadz/edit/(:segment)', 'AuthController::editustadz/$1');
//hapus akun ustadz
$routes->match(['delete', 'options'], 'ustadz/delete/(:num)', 'AuthController::deleteUstadz/$1');


//materi vidio
$routes->get('/materi', 'materiController::getMateriVidio');
//baca materi vidio perid
$routes->get('materi/vidio/(:num)', 'materiController::getMateriVidioUser/$1');
//upload vidio
$routes->post('api/upload-video', 'materiController::uploadVideo');
//edit vidio
$routes->match(['put', 'options'], 'materi/update/(:segment)', 'materiController::editVideo/$1');
//delete vidio
$routes->match(['delete', 'options'], 'materi/delete/(:num)', 'materiController::deleteVidio/$1');


//materividio
//get materi
$routes->get('/materipenjelasan', 'materiController::getMateriPenjelasann');
//get materi per id
$routes->get('materi-penjelasan/(:num)', 'materiController::getMateriPenjelasan/$1');
//create materi
$routes->match(['post', 'options'], 'materi/create', 'materiController::CreateMateriPenjelasan');
//edit materi
$routes->match(['put', 'options'], 'materip/update/(:segment)', 'materiController::editMateriPenjelasan/$1');
//delete
$routes->match(['delete', 'options'], 'materip/delete/(:num)', 'materiController::deleteMateriPenjelasan/$1');





//create ustadz dari admin
$routes->post('ustadzcreate', 'adminController::createUstadz');









// $routes->match(['post', 'option'], '/registeranjay', 'registerController::index');
// $routes->get('/register', 'registerController::index');
// $routes->get('/register/ustadz', 'registerController::createUstadz');
// $routes->get('users', 'registerController::index');
// $routes->match( ['post', 'options'], 'users-create', 'registerController::index');
// $routes->get('ustadz', 'registerController::index');
// $routes->match(['post', 'options'], 'ustadz-create', 'RegisterController::createUstadz');
// $routes->post('register', 'RegisterController::index');
