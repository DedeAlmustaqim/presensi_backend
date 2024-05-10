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
$routes->get('/get_user/(:alphanum)', 'Qr_code_scan::json_user/$1');
$routes->get('/get_qr/(:alphanum)', 'Qr_code_scan::get_kode_qr/$1');
$routes->get('/login', 'Login::index');
$routes->get('/privacy_policy', 'Privacy::index');
$routes->get('/privacypolicy', 'Privacy::index');
$routes->get('/delete_account', 'DeleteAccount::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/', 'Auth::login');

//Admin 
$routes->group('admin',  function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index', ['filter' => 'checkaccessadminviewer']);
    $routes->get('administrator', 'Admin\Pengaturan::administrator', ['filter' => 'checkaccessadmin']);
    $routes->get('op_qr', 'Admin\Pengaturan::op_qr', ['filter' => 'checkaccessadmin']);
    $routes->get('json_administrator', 'Admin\Pengaturan::json_administrator', ['filter' => 'checkaccessadmin']);
    $routes->get('json_op_qr', 'Admin\Pengaturan::json_op_qr', ['filter' => 'checkaccessadmin']);
    $routes->post('tambah_adm', 'Admin\Pengaturan::tambah_adm', ['filter' => 'checkaccessadmin']);
    $routes->post('tambah_op_qr', 'Admin\Pengaturan::tambah_op_qr', ['filter' => 'checkaccessadmin']);
    $routes->get('get_adm/(:alphanum)', 'Admin\Pengaturan::get_adm/$1', ['filter' => 'checkaccessadmin']);
    $routes->get('get_op_qr/(:alphanum)', 'Admin\Pengaturan::get_op_qr/$1', ['filter' => 'checkaccessadmin']);
    $routes->post('update_adm', 'Admin\Pengaturan::update_adm', ['filter' => 'checkaccessadmin']);
    $routes->post('update_op_qr', 'Admin\Pengaturan::update_op_qr', ['filter' => 'checkaccessadmin']);
    $routes->post('del_unit/(:alphanum)', 'Admin\Pengaturan::del_unit/$1', ['filter' => 'checkaccessadmin']);
    $routes->get('unit', 'Admin\Pengaturan::unit', ['filter' => 'checkaccessadmin']);
    $routes->get('json_unit', 'Admin\Pengaturan::json_unit', ['filter' => 'checkaccessadmin']);
    $routes->get('json_user/(:alphanum)', 'Admin\Pengaturan::json_user/$1', ['filter' => 'checkaccessadminviewer']);
    $routes->post('tambah_unit', 'Admin\Pengaturan::tambah_unit', ['filter' => 'checkaccessadmin']);
    $routes->get('get_unit/(:alphanum)', 'Admin\Pengaturan::get_unit/$1', ['filter' => 'checkaccessadmin']);
    $routes->post('update_unit', 'Admin\Pengaturan::update_unit', ['filter' => 'checkaccessadmin']);
    $routes->post('del_unit/(:alphanum)', 'Admin\Pengaturan::del_unit/$1', ['filter' => 'checkaccessadmin']);
    $routes->post('reset_adm/(:alphanum)', 'Admin\Pengaturan::reset_adm/$1', ['filter' => 'checkaccessadmin']);
    $routes->post('reset_op/(:alphanum)', 'Admin\Pengaturan::reset_op/$1', ['filter' => 'checkaccessadmin']);
    $routes->get('config', 'Admin\Pengaturan::config', ['filter' => 'checkaccessadmin']);
    $routes->get('user', 'Admin\Pengaturan::user', ['filter' => 'checkaccessadminviewer']);
    $routes->post('update_config', 'Admin\Pengaturan::update_config', ['filter' => 'checkaccessadmin']);
    $routes->get('get_config', 'Admin\Pengaturan::get_config', ['filter' => 'checkaccessadmin']);
    $routes->get('date_to_skip', 'Admin\DatetoSkipController::index', ['filter' => 'checkaccessadminviewer']);
    $routes->get('json_date_to_skip', 'Admin\DatetoSkipController::json_date_to_skip', ['filter' => 'checkaccessadminviewer']);
    $routes->post('add_date_to_skip', 'Admin\DatetoSkipController::add_date_to_skip', ['filter' => 'checkaccessadmin']);
    $routes->get('get_peg/(:alphanum)', 'Admin\Pengaturan::get_peg/$1', ['filter' => 'checkaccessadminviewer']);
    $routes->get('logger', 'Admin\Logger::index', ['filter' => 'checkaccessadmin']);
    $routes->get('json_logger', 'Admin\Logger::json_logger', ['filter' => 'checkaccessadmin']);

    //Banner
    $routes->get('banner', 'Admin\Banner::index', ['filter' => 'checkaccessadmin']);
    $routes->get('json_banner', 'Admin\Banner::json_banner', ['filter' => 'checkaccessadmin']);
    $routes->post('add_banner', 'Admin\Banner::add_banner', ['filter' => 'checkaccessadmin']);
    $routes->post('del_banner/(:alphanum)', 'Admin\Banner::del_banner/$1', ['filter' => 'checkaccessadmin']);

    //Notif
    $routes->get('notif', 'Admin\NotifController::index', ['filter' => 'checkaccessadmin']);
    $routes->get('json_notif', 'Admin\NotifController::json_notif', ['filter' => 'checkaccessadmin']);
    $routes->post('add_notif', 'Admin\NotifController::add_notif', ['filter' => 'checkaccessadmin']);
    $routes->post('update_notif', 'Admin\NotifController::update_notif', ['filter' => 'checkaccessadmin']);
    $routes->get('get_notif/(:alphanum)', 'Admin\NotifController::get_notif/$1', ['filter' => 'checkaccessadmin']);
    $routes->post('del_notif/(:alphanum)', 'Admin\NotifController::del_notif/$1', ['filter' => 'checkaccessadmin']);

    $routes->get('absensi', 'Admin\Absensi::index', ['filter' => 'checkaccessadminviewer']);
    $routes->get('get_user_dropdwon/(:alphanum)', 'Admin\Absensi::get_user/$1', ['filter' => 'checkaccessadminviewer']);
    $routes->get('json_absensi/(:alphanum)/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Absensi::json_absensi/$1/$2/$3/$4', ['filter' => 'checkaccessadminviewer']);
    $routes->get('get_upacara/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Absensi::get_upacara/$1/$2/$3');
    $routes->get('get_subtraction/(:alphanum)', 'Admin\Absensi::get_subtraction/$1');
    $routes->post('subtraction', 'Admin\Absensi::subtraction', ['filter' => 'checkaccessadminviewer']);
    $routes->post('posted_tpp', 'Admin\Absensi::posted_tpp', ['filter' => 'checkaccessadminviewer']);
    $routes->post('get_ket', 'Admin\Absensi::get_ket', ['filter' => 'checkaccessadminviewer']);
    $routes->get('get_tpp_by_id/(:alphanum)', 'Admin\Absensi::get_tpp_by_id/$1', ['filter' => 'checkaccessadminviewer']);
});







// SKPD
$routes->group('skpd',  ['filter' => 'checkaccessskpd'], function($routes) {
    $routes->get('dashboard', 'Skpd\Dashboard::index');
    $routes->get('unit', 'Skpd\Pengaturan::unit');
    $routes->get('get_unit/(:alphanum)', 'Skpd\Pengaturan::get_unit/$1');
    $routes->post('update_unit', 'Skpd\Pengaturan::update_unit');
    $routes->get('jadwal', 'Skpd\Pengaturan::jadwal');
    $routes->get('get_jadwal/(:alphanum)', 'Skpd\Pengaturan::get_jadwal/$1');
    $routes->post('update_jadwal', 'Skpd\Pengaturan::update_jadwal');
    $routes->post('reset_pass_skpd', 'Skpd\Pengaturan::reset_pass_skpd');
    $routes->post('reset_pass_qr', 'Skpd\Pengaturan::reset_pass_qr');

    // PEGAWAI
    $routes->get('pegawai', 'Skpd\Pegawai::index');
    $routes->get('json_pegawai', 'Skpd\Pegawai::json_pegawai');
    $routes->post('show_user_report', 'Skpd\Pegawai::show_user_report');
    $routes->post('tambah_peg', 'Skpd\Pegawai::tambah_peg');
    $routes->post('del_peg/(:alphanum)', 'Skpd\Pegawai::del_peg/$1');
    $routes->get('get_peg/(:alphanum)', 'Skpd\Pegawai::get_peg/$1');
    $routes->post('update_peg', 'Skpd\Pegawai::update_peg');
    $routes->post('sort_peg', 'Skpd\Pegawai::sort_peg');
    $routes->post('ress_pass/(:alphanum)', 'Skpd\Pegawai::ress_pass/$1');
    $routes->post('del_check_in/(:alphanum)', 'Skpd\Pegawai::del_check_in/$1');
    $routes->post('del_check_out/(:alphanum)', 'Skpd\Pegawai::del_check_out/$1');
    $routes->post('del_absen/(:alphanum)', 'Skpd\Pegawai::del_absen/$1');

    // ABSENSI
    $routes->get('absensi', 'Skpd\Absensi::index');
    $routes->get('json_absensi/(:alphanum)/(:alphanum)/(:alphanum)/(:alphanum)', 'Skpd\Absensi::json_absensi/$1/$2/$3/$4');
    $routes->get('get_upacara/(:alphanum)/(:alphanum)/(:alphanum)', 'Skpd\Absensi::get_upacara/$1/$2/$3');
    $routes->get('get_subtraction/(:alphanum)', 'Skpd\Absensi::get_subtraction/$1');
    $routes->post('subtraction', 'Skpd\Absensi::subtraction');
    $routes->post('posted_tpp', 'Skpd\Absensi::posted_tpp');
   
    $routes->get('get_tpp_by_id/(:alphanum)', 'Skpd\Absensi::get_tpp_by_id/$1');

    // REKAP
    
});

$routes->post('skpd/get_ket', 'Skpd\Absensi::get_ket', ['filter' => 'checkaccessadminskpdviewer']);

$routes->group('skpd/rekap', ['filter' => 'checkaccessskpd'], function($routes) {
    $routes->get('pegawai', 'Skpd\Rekap::rekap_pegawai');
    $routes->get('json_rekap/(:alphanum)/(:alphanum)', 'Skpd\Rekap::json_rekap/$1/$2');
    $routes->get('view_absen/(:alphanum)/(:alphanum)/(:alphanum)', 'Skpd\Rekap::view_absen/$1/$2/$3');
    $routes->get('view_absen_tpp/(:alphanum)/(:alphanum)/(:alphanum)', 'Skpd\Rekap::view_absen_tpp/$1/$2/$3');
    $routes->get('view_absen_tpp_pdf/(:alphanum)/(:alphanum)/(:alphanum)', 'Skpd\Rekap::view_absen_tpp_pdf/$1/$2/$3');
    $routes->get('view_rekap_tpp_pdf/(:alphanum)/(:alphanum)', 'Skpd\Rekap::view_rekap_tpp_pdf/$1/$2');
    $routes->get('view_rekap_absen_non_asn_tpp/(:alphanum)/(:alphanum)', 'Skpd\Rekap::view_rekap_absen_non_asn_tpp/$1/$2');
    $routes->get('view_rekap_tpp_asn_pdf/(:alphanum)/(:alphanum)', 'Skpd\Rekap::view_rekap_tpp_asn_pdf/$1/$2');
    $routes->get('get_count_peg/(:alphanum)/(:alphanum)/(:alphanum)', 'Skpd\Rekap::get_count_peg/$1/$2/$3');

});

$routes->group('rekapitulasi', ['filter' => 'checkaccessadminviewer'], function($routes) {
    $routes->get('/', 'Admin\Rekap::rekap_pegawai');
    $routes->get('json_rekap/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Rekap::json_rekap/$1/$2/$3');
    $routes->get('view_absen/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Rekap::view_absen/$1/$2/$3');
    $routes->get('view_absen_tpp/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Rekap::view_absen_tpp/$1/$2/$3');
    $routes->get('view_absen_tpp_pdf/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Rekap::view_absen_tpp_pdf/$1/$2/$3');
    $routes->get('view_rekap_tpp_pdf/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Rekap::view_rekap_tpp_pdf/$1/$2/$3');
    $routes->get('view_rekap_absen_non_asn_tpp/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Rekap::view_rekap_absen_non_asn_tpp/$1/$2/$3');
    $routes->get('view_rekap_tpp_asn_pdf/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Rekap::view_rekap_tpp_asn_pdf/$1/$2/$3');
    $routes->get('get_count_peg/(:alphanum)/(:alphanum)/(:alphanum)', 'Admin\Rekap::get_count_peg/$1/$2/$3');

});


//API
$routes->get('api/getqr/(:alphanum)', 'Api\Qrscan::GetQr/$1');
$routes->get('api/banner', 'Api\Resource::banner_promo');
$routes->post('api/post_qr', 'Api\QrScan::post_qr');
$routes->post('api/cek_qr', 'Api\QrScan::cek_qr');
$routes->post('api/post_qr_out', 'Api\QrScan::post_qr_out');
$routes->post('api/get_user', 'Api\User::get_user');
$routes->post('api/get_rekap', 'Api\User::get_rekap');
$routes->post('api/get_ijin', 'Api\User::get_ijin');
$routes->post('api/post_ijin', 'Api\User::post_ijin');
$routes->post('api/jadwal', 'Api\Resource::jadwal');
$routes->post('api/get_pagi', 'Api\Resource::get_pagi_absen');
$routes->post('api/get_unit', 'Api\Resource::get_unit');
$routes->post('api/login', 'Api\AuthController::login', ['filter' => 'cors']);

$routes->get('api/broadcast', 'Api\Broadcast::index');
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
