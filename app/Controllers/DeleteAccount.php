<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DeleteAccount extends BaseController
{
    public function index()
    {

        $data['judul'] = "Hapus Akun";
        
        return view('delete_account', $data);
    }
}
