<?php

namespace App\Controllers\Skpd;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session('akses') == 2) {
            $data = array(
                'judul' => 'Dashboard Admin SKPD',
                'sub_judul' => 'Selamat Datang! ' . session('ses_nm'),
            );
            return view('skpd/dashboard', $data);
        } else {
            return redirect('login');
        }
    }
}
