<?php

namespace App\Controllers;

use App\Models\ConfigModel;
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

    public function jsonsss_user($id)
    {
        $today = date('Y-m-d');
        $db = db_connect();
        $builder = $db->table('users')
            ->select('users.id, users.name, users.jabatan, COALESCE(tbl_absen.jam_in, "Belum Absen") AS jam_in, COALESCE(tbl_absen.jam_out, "Belum Absen") AS jam_out, users.img,')
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

    public function json_user($id)
    {

        $db = db_connect();

        $query = $db->table('users')
            ->select('users.id, users.name, users.jabatan, COALESCE(tbl_absen.jam_in, "Belum Absen") AS jam_in, COALESCE(tbl_absen.jam_out, "Belum Absen") AS jam_out, users.img,')
            ->join('tbl_absen', 'users.id = tbl_absen.id_user AND DATE(tbl_absen.created_at) = CURDATE()', 'left')
            ->where('users.id_unit', $id)
            ->orderBy('users.sort', 'asc');
        return DataTable::of($query)->toJson();
    }

    public function get_kode_qr($id)
    {
        $db = db_connect();
        $data1 = $db->table('tbl_unit')->select('*')->where('id', $id)->get()->getFirstRow();
        $data2 = $db->table('tbl_config')->get()->getFirstRow();

     
        if ($data1 && $data2) {
          
            $result = [
                'id' => $data1->id,
                'id_unit' => $data1->id,
                'qr_in' => $data1->qr_in,
                'qr_out' => $data1->qr_out,
                'nm_pemda' => $data2->nm_pemda,  // Mengambil properti dari $data2
                'qr_time_in_start' => $data2->qr_time_in_start,
                'qr_time_in_end' => $data2->qr_time_in_end,
                'qr_time_out_start' => $data2->qr_time_out_start,
                'qr_time_out_end' => $data2->qr_time_out_end,
                'radius' => $data2->radius,
            ];
    

            // Kembalikan data yang digabungkan sebagai JSON
            return $this->response->setJSON($result);
        } else {
            // Tangani kasus di mana salah satu dari $data1 atau $data2 adalah null
            return $this->response->setJSON(['error' => 'Data tidak ditemukan.']);
        }
    }
}
