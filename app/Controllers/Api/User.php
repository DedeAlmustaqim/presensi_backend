<?php

namespace App\Controllers\Api;

use App\Models\AbsenModel;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    use ResponseTrait;
    public function get_user()
    {
        $idUser = $this->request->getVar('id_user');
        $model = new UserModel();
        $data["data"] = $model
            ->select('tbl_user.id, 
        tbl_user.nip, 
        tbl_user.nama, 
        tbl_user.id_unit, 
        tbl_user.jabatan, 
        tbl_user.img, 
        tbl_unit.nm_unit, 
        tbl_unit.lat, 
        tbl_unit.long, 
        tbl_unit.radius, 
        tbl_user.id_user')
        ->select('TIME_FORMAT(tbl_qr_scan.qr_time_in_start,"%H:%i") as qr_time_in_start, 
        TIME_FORMAT(tbl_qr_scan.qr_time_in_end,"%H:%i") as qr_time_in_end,')
        ->select('TIME_FORMAT(tbl_qr_scan.qr_time_out_start,"%H:%i") as qr_time_out_start, 
        TIME_FORMAT(tbl_qr_scan.qr_time_out_end,"%H:%i") as qr_time_out_end,  tbl_unit.nm_unit')
        ->join('tbl_unit', 'tbl_user.id_unit = tbl_unit.id_unit', 'left')
        ->join('tbl_qr_scan', 'tbl_user.id_unit = tbl_qr_scan.id_unit', 'left')
            ->where('id_user', $idUser)
            ->first();
        return $this->respond($data);
    }

    public function get_rekap()
    {
        $id_user = $this->request->getVar('id_user');
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');

        if ($bulan == 'Januari') {
            $bulan = 1;
        } else if ($bulan == 'Februari') {
            $bulan = 2;
        } else if ($bulan == 'Maret') {
            $bulan = 3;
        } else if ($bulan == 'April') {
            $bulan = 4;
        } else if ($bulan == 'Mei') {
            $bulan = 5;
        } else if ($bulan == 'Juni') {
            $bulan = 6;
        } else if ($bulan == 'Juli') {
            $bulan = 7;
        } else if ($bulan == 'Agustus') {
            $bulan = 8;
        } else if ($bulan == 'September') {
            $bulan = 9;
        } else if ($bulan == 'Oktober') {
            $bulan = 10;
        } else if ($bulan == 'November') {
            $bulan = 11;
        } else if ($bulan == 'Desember') {
            $bulan = 12;
        }

        $model = new UserModel();
        $data['data'] = $model->get_rekap($id_user, $tahun, $bulan);
        return $this->respond($data);
    }

    public function get_ijin()
    {
        $id_user = $this->request->getVar('id_user');
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');

        if ($bulan == 'Januari') {
            $bulan = 1;
        } else if ($bulan == 'Februari') {
            $bulan = 2;
        } else if ($bulan == 'Maret') {
            $bulan = 3;
        } else if ($bulan == 'April') {
            $bulan = 4;
        } else if ($bulan == 'Mei') {
            $bulan = 5;
        } else if ($bulan == 'Juni') {
            $bulan = 6;
        } else if ($bulan == 'Juli') {
            $bulan = 7;
        } else if ($bulan == 'Agustus') {
            $bulan = 8;
        } else if ($bulan == 'September') {
            $bulan = 9;
        } else if ($bulan == 'Oktober') {
            $bulan = 10;
        } else if ($bulan == 'November') {
            $bulan = 11;
        } else if ($bulan == 'Desember') {
            $bulan = 12;
        }

        $model = new UserModel();
        $data['data'] = $model->get_ijin($id_user, $tahun, $bulan);
        return $this->respond($data);
    }

    public function post_ijin()
    {
        $db = db_connect();
        $modelAbsen = new AbsenModel($db);
       


        $id_user = $this->request->getVar('id_user');
        $tgl = $this->request->getVar('tgl');
        $id_ket = $this->request->getVar('id_ket');
        $ket = $this->request->getVar('ket');
        $kondisi = $this->request->getVar('kondisi');
        

        if($id_ket == "Tanpa Ket."){
            $id_ket_convert = 2;
        }else if($id_ket == "Dinas Luar"){
            $id_ket_convert = 3;
        }else if($id_ket == "Sakit"){
            $id_ket_convert = 4;
        }else if($id_ket == "Hal Lainnya"){
            $id_ket_convert = 5;
        }

        

        //Kondisi 1
        if ($kondisi == 1) {
            $cek_tgl = $db->table('tbl_absen')
                ->select('tgl_in')
                ->where('tgl_in', $tgl)
                ->where('id_user', $id_user)
                ->countAllResults();
            if ($cek_tgl) {
                $respond = [
                    'success' => false,
                    'judul'     => "Gagal",
                    'msg'       => 'Anda sudah Absen Masuk pada ' . $tgl,
                ];
                return $this->response->setJSON($respond);
            } else {
                $data = [
                    'tgl_in'           => $tgl,
                    'jam_in'           => date('H:i:s'),
                    'id_ket_in'        => $id_ket_convert,
                    'id_ket_out'        => 0,
                    'id_user'       => $id_user,
                    'ket_absen_in'     => $ket,
                    'stts_ijin'     => 1,

                ];
                $result = $modelAbsen->add($data);
                if ($result) {
                    $respond = [
                        'success'   => true,
                        'judul'     => "Berhasil",
                        'msg'       => 'Berhasil Ijin pada Jam Masuk, Tanggal Ijin ' . $tgl,

                    ];
                    return $this->respondCreated($respond);
                } else {
                    $respond = [
                        'success' => false,
                        'judul'     => "Gagal",
                        'msg'       => 'Terjadi Kesalahan',
                    ];
                    return $this->respondCreated($respond);
                }
            }
        }
        // Kondisi 2
        if ($kondisi == 2) {
            $cek_tgl_in = $db->table('tbl_absen')
                ->select('tgl_in')
                ->where('tgl_in', $tgl)
                ->where('id_user', $id_user)
                ->countAllResults();
            if ($cek_tgl_in) {
                $cek_tgl = $db->table('tbl_absen')
                    ->select('tgl_out')
                    ->where('tgl_out', $tgl)
                    ->where('id_user', $id_user)
                    ->countAllResults();
                if ($cek_tgl) {
                    $respond = [
                        'success' => false,
                        'judul'     => "Gagal",
                        'msg'       => 'Anda sudah Absen Pulang pada ' . $tgl,
                    ];
                    return $this->response->setJSON($respond);
                } else {
                    $data = [
                        'tgl_out'           => $tgl,
                        'jam_out'           => date('H:i:s'),
                        'id_ket_out'        => $id_ket_convert,
                        'id_user'       => $id_user,
                        'ket_absen_out'     => $ket,
                        'stts_ijin'     => 1,

                    ];
                    $result = $modelAbsen->update_absen($data, $tgl);
                    if ($result) {
                        $respond = [
                            'success'   => true,
                            'judul'     => "Berhasil",
                            'msg'       => 'Berhasil Ijin pada Jam Pulang, Tanggal Ijin ' . $tgl,

                        ];
                        return $this->respondCreated($respond);
                    } else {
                        $respond = [
                            'success' => false,
                            'judul'     => "Gagal",
                            'msg'       => 'Terjadi Kesalahan',
                        ];
                        return $this->respondCreated($respond);
                    }
                }
            }else{
                $respond = [
                    'success' => false,
                    'judul'     => "Gagal",
                    'msg'       => 'Anda belum Absen Masuk, Lakukan Absen Masuk terlebih dulu atau Ajukan Ijin',
                ];
                return $this->respondCreated($respond);
            }
        }
        //Kondisi 3
        if ($kondisi == 3) {
            $cek_tgl_in = $db->table('tbl_absen')
                ->select('tgl_in')
                ->where('tgl_in', $tgl)
                ->where('id_user', $id_user)
                ->countAllResults();
            if ($cek_tgl_in) {
                $respond = [
                    'success' => false,
                    'judul'     => "Gagal",
                    'msg'       => 'Anda sudah Absen Masuk pada ' . $tgl,
                ];
                return $this->respondCreated($respond);
            } else {
                $cek_tgl_out = $db->table('tbl_absen')
                    ->select('tgl_out')
                    ->where('tgl_out', $tgl)
                    ->where('id_user', $id_user)
                    ->countAllResults();
                if ($cek_tgl_out) {
                    $respond = [
                        'success' => false,
                        'judul'     => "Gagal",
                        'msg'       => 'Anda sudah Absen Pulang pada ' . $tgl,
                    ];
                    return $this->respondCreated($respond);
                } else {
                    $data = [
                        'tgl_in'           => $tgl,
                        'tgl_out'           => $tgl,
                        'jam_in'           => date('H:i:s'),
                        'jam_out'           => date('H:i:s'),
                        'id_ket_in'        => $id_ket_convert,
                        'id_ket_out'        => $id_ket_convert,
                        'id_user'       => $id_user,
                        'ket_absen_in'     => $ket,
                        'ket_absen_out'     => $ket,
                        'stts_ijin'     => 1,

                    ];

                    $result1 = $modelAbsen->add($data);
                    // $modelOut->add($data1);
                    if ($result1) {
                        $respond = [
                            'success' => true,
                            'judul'     => "Berhasil",
                            'msg'       => 'Berhasil Ijin pada Jam Sehari Penuh pada ' . $tgl,
                        ];
                        return $this->respondCreated($respond);
                    } else {
                        $respond = [
                            'success' => false,
                            'judul'     => "gagal",
                            'msg'       => 'Terjadi Kesalahan ',
                        ];
                        return $this->respondCreated($respond);
                    }
                }
            }
        }
    }
}
