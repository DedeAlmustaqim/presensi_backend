<?php

namespace App\Controllers;

use App\Models\UnitModel;
use Hermawan\DataTables\DataTable;

class Qr_code_scan extends BaseController
{
    public function index()
    {
        if (session('akses') == 3) {
            $modelUnit = new UnitModel();
            $unit = $modelUnit->where('id', session('ses_id_unit'))->first();
            $data['skpd'] = $unit['nm_unit'];
            $data['masuk'] = $unit['jam_masuk'];
            $data['pulang'] = $unit['jam_pulang'];
            $data['hari_kerja'] = $unit['hari_kerja'];
            $data['judul'] = "Absensi QR Code";
            $data['sub_judul'] = "Scan QR Code untuk melakukan absensi";

            return view('qr_scan', $data);
        } else {
            return redirect('login');
        }
    }

    public function json_user($id)
    {
        $today = date('Y-m-d');
        $db = db_connect();
        $builder = $db->table('users')
            ->select('users.id, users.name, users.jabatan, tbl_absen.jam_in, tbl_absen.jam_out, users.img,')
            ->where('users.id_unit', $id)
            ->join('tbl_absen', 'users.id = tbl_absen.id_user', 'left')
            ->orderBy('users.sort', 'asc')
            ->groupStart()
            ->orWhere('tbl_absen.id_user IS NULL')
            ->orWhere('tbl_absen.created_at IS NULL')
            ->orWhere('DATE(tbl_absen.created_at)', $today)
            ->groupEnd()
            ->groupBy('users.id, users.name, users.jabatan, tbl_absen.jam_in, tbl_absen.jam_out');

        return DataTable::of($builder)->toJson();
        // var_dump($builder);
    }
}
