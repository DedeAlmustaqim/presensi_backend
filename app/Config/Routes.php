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
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->setAutoRoute(true);
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
$routes->get('/qrscan', 'Qr_code_scan::index');
$routes->get('/login', 'Login::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/', 'Auth::login');

//Admin 
$routes->get('admin/dashboard','Admin\Dashboard::index');
$routes->get('admin/administrator','Admin\Pengaturan::administrator');
$routes->get('admin/op_qr','Admin\Pengaturan::op_qr');
$routes->get('admin/json_administrator','Admin\Pengaturan::json_administrator');
$routes->get('admin/json_op_qr','Admin\Pengaturan::json_op_qr');
$routes->post('admin/tambah_adm','Admin\Pengaturan::tambah_adm');
$routes->post('admin/tambah_op_qr','Admin\Pengaturan::tambah_op_qr');
$routes->get('admin/get_adm/(:alphanum)','Admin\Pengaturan::get_adm/$1');
$routes->get('admin/get_op_qr/(:alphanum)','Admin\Pengaturan::get_op_qr/$1');
$routes->post('admin/update_adm','Admin\Pengaturan::update_adm');
$routes->post('admin/update_op_qr','Admin\Pengaturan::update_op_qr');
$routes->post('admin/del_unit/(:alphanum)','Admin\Pengaturan::del_unit/$1');
$routes->get('admin/unit','Admin\Pengaturan::unit');
$routes->get('admin/json_unit','Admin\Pengaturan::json_unit');
$routes->post('admin/tambah_unit','Admin\Pengaturan::tambah_unit');
$routes->get('admin/get_unit/(:alphanum)','Admin\Pengaturan::get_unit/$1');
$routes->post('admin/update_unit','Admin\Pengaturan::update_unit');
$routes->post('admin/del_unit/(:alphanum)','Admin\Pengaturan::del_unit/$1');

//SKPD
$routes->get('skpd/dashboard','Skpd\Dashboard::index');
$routes->get('admin/get_adm/(:alphanum)','Admin\Pengaturan::get_adm/$1');
$routes->get('skpd/unit','Skpd\Pengaturan::unit');
$routes->get('skpd/get_unit/(:alphanum)','Skpd\Pengaturan::get_unit/$1');
$routes->post('skpd/update_unit','Skpd\Pengaturan::update_unit');
$routes->get('skpd/jadwal','Skpd\Pengaturan::jadwal');
$routes->get('skpd/get_jadwal/(:alphanum)','Skpd\Pengaturan::get_jadwal/$1');
$routes->post('skpd/update_jadwal','Skpd\Pengaturan::update_jadwal');

//PEGAWAI
$routes->get('skpd/pegawai','Skpd\Pegawai::index');
$routes->get('skpd/json_pegawai','Skpd\Pegawai::json_pegawai');
$routes->post('skpd/tambah_peg','Skpd\Pegawai::tambah_peg');
$routes->post('skpd/del_peg/(:alphanum)','Skpd\Pegawai::del_peg/$1');
$routes->get('skpd/get_peg/(:alphanum)','Skpd\Pegawai::get_peg/$1');
$routes->post('skpd/update_peg','Skpd\Pegawai::update_peg');
$routes->post('skpd/ress_pass/(:alphanum)','Skpd\Pegawai::ress_pass/$1');
$routes->post('skpd/res_dev/(:alphanum)','Skpd\Pegawai::res_dev/$1');

//API
$routes->get('api/getqr/(:alphanum)','Api\Qrscan::GetQr/$1');
$routes->get('api/banner','Api\Resource::banner_promo');
$routes->post('api/post_qr','Api\QrScan::post_qr');
$routes->post('api/cek_qr','Api\QrScan::cek_qr');
$routes->post('api/post_qr_out','Api\QrScan::post_qr_out');
$routes->post('api/get_user','Api\User::get_user');
$routes->post('api/get_rekap','Api\User::get_rekap');
$routes->post('api/get_ijin','Api\User::get_ijin');
$routes->post('api/post_ijin','Api\User::post_ijin');
$routes->post('api/jadwal','Api\Resource::jadwal');
$routes->post('api/get_pagi','Api\Resource::get_pagi_absen');
$routes->post('api/get_unit','Api\Resource::get_unit');
$routes->post('api/login', 'Api\AuthController::login',['filter'=>'cors']);

$routes->get('api/broadcast','Api\Broadcast::index');
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
