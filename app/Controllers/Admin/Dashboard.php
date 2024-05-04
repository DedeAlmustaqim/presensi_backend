<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
      
        $data = array(
            'judul' => 'Dashboard ',
            'sub_judul' => 'Selamat Datang! ' . session('ses_nm'),
        );
        return view('admin/dashboard', $data);
    }
}
