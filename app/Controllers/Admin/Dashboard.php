<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = array(
            'judul' => 'Dashboard Admin',
            'sub_judul' => 'Selamat Datang! ' . session('ses_nm'),
            'judul' => 'Dashboard Admin',
        );
        return view('admin/dashboard', $data);
    }
}
