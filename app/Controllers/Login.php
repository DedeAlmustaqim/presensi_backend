<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        if(session('masuk')==true){
            if(session('akses')==1){
                return redirect('admin/dashboard');
            }else if(session('akses')==2){
                return redirect('skpd/dashboard');
            }
            
        }
        $data['judul'] = "Login";
        $data['sub_judul'] = "Masuk untuk melanjutkan";
        return view('login', $data);
    }
}
