<?php

namespace App\Controllers\Skpd;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session('akses') == 2) {

            $db = db_connect();
            $unit = $db->table('tbl_unit')->where('id', session('ses_id_unit'))->get()->getRow();
            $userCount = $db->table('users')->where('id_unit', session('ses_id_unit'))->countAllResults();

            $data = array(
                'judul' =>  $unit->nm_unit,
                'sub_judul' => 'Selamat Datang! ' . session('ses_nm'),
            );
            return view('skpd/dashboard', $data);
        } else {
            return redirect('login');
        }
    }
}
