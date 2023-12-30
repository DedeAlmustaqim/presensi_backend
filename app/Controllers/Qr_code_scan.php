<?php

namespace App\Controllers;

use App\Models\UnitModel;

class Qr_code_scan extends BaseController
{
    public function index()
    {
        if(session('akses')==3){
            $modelUnit = new UnitModel();
            $unit = $modelUnit->where('id', session('ses_id_unit'))->first();
            $data['skpd'] = $unit['nm_unit'];
            $data['judul'] = "Absensi QR Code";
            $data['sub_judul'] = "Scan QR Code untuk melakukan absensi";
            return view('qr_scan', $data);
            
        }else{
            return redirect('login');
        }
        
    }
}
