<?php

namespace App\Controllers\Api;

use App\Models\AbsenModel;
use App\Models\QrScanModel;
use App\Models\UnitModel;
use CodeIgniter\RESTful\ResourceController;
header('Access-Control-Allow-Origin: *');
class Qrscan extends ResourceController
{
    
   

    public function post_qr()
    {
        helper('tanggal_indo');
        $db = db_connect();
        $model = new AbsenModel($db);

        $postqr_in = $this->request->getVar('qr_in');
        $id_user = $this->request->getVar('id_user');
        $qr_in = substr($postqr_in, -10);
        $tgl = substr($postqr_in, 0, -10);

        $builder = $db->table('tbl_qr_scan')->select('qr_in')->where('qr_in', $qr_in)->where('tbl_user.id_user',$id_user)->join('tbl_user','tbl_user.id_unit = tbl_qr_scan.id_unit')->countAllResults();



        if ($builder) {
            $cek_tgl = $db->table('tbl_absen')->select('tgl_in')->where('tgl_in', $tgl)->where('id_user',$id_user)->countAllResults();
            if ($cek_tgl) {
                $respond = [
                    'success' => false,
                    'status'    => 0,
                    'judul'     => "Gagal",
                    'msg'       => 'Anda sudah absen masuk pada ' . date_indo($tgl),
                    'date'      => $tgl
                ];
                return $this->response->setJSON($respond);
            } else {

                $data = [
                    'tgl_in'           => $tgl,
                    'jam_in'           => date('H:i:s'),
                    'id_ket_in'        => 1,
                    'id_ket_out'        => 0,
                    'id_user'       => $id_user

                ];

                $result = $model->add($data);
                if ($result) {
                    $respond = [
                        'success' => true,
                        'status'    => 1,
                        'judul'     => "Berhasil",
                        'msg'       => 'Tanggal Absensi ' . date_indo($tgl),
                        'date'      => $tgl
                    ];
                    return $this->respondCreated($respond);
                } else {
                    $respond = [
                        'success' => false,
                        'status'    => 2,
                        'judul'     => "Gagal Absensi",
                        'msg'       => 'Terjadi Kesalahan',

                    ];
                    return $this->respondCreated($respond);
                }
            }
        } else {
            $respond = [
                'success' => false,
                'status' => 3,
                'judul' => "Gagal Absensi",
                'msg'      => 'Gagal verifikasi kode QR, silahkan coba lagi',

            ];
            return $this->respond($respond);
        }
    }

    public function post_qr_out()
    {
        helper('tanggal_indo');
        $db = db_connect();
        $modelAbsen = new AbsenModel($db);

        $postqr_out = $this->request->getVar('qr_out');
        $id_user = $this->request->getVar('id_user');
        $qr_out = substr($postqr_out, -10);
        $tgl = substr($postqr_out, 0, -10);


        $builder = $db->table('tbl_qr_scan')->select('qr_out')->where('qr_out', $qr_out)->where('tbl_user.id_user',$id_user)->join('tbl_user','tbl_user.id_unit = tbl_qr_scan.id_unit')->countAllResults();



        if ($builder) {
            $cek_tgl = $db->table('tbl_absen')->select('tgl_in')->where('tgl_in', $tgl)->where('id_user',$id_user)->countAllResults();
            if (!$cek_tgl) {
                $respond = [
                    'success' => false,
                    'status'    => 0,
                    'judul'     => "Gagal",
                    'msg'       => 'Anda belum absen masuk pada ' . date_indo($tgl) .', lakukan absen masuk atau ajukan Ijin',
                    'date'      => $tgl,
                    'qr_out'    => $qr_out,
                ];
                return $this->response->setJSON($respond);
            } else {
                $cek_tgl_out = $db->table('tbl_absen')->select('tgl_out')->where('tgl_out', $tgl)->where('id_user',$id_user)->countAllResults();
                
                if($cek_tgl_out){
                    $respond = [
                        'success' => false,
                        'status'    => 0,
                        'judul'     => "Gagal",
                        'msg'       => 'Anda sudah Absen Masuk pada ' . date_indo($tgl),
                        'date'      => $tgl,
                        'qr_out'    => $qr_out,
                    ];
                    return $this->response->setJSON($respond);
                } else  {
                    $data = [
                        'tgl_out'           => $tgl,
                        'jam_out'           => date('H:i:s'),
                        'id_ket_out'        => 1,
                        
    
                    ];
    
                    $result = $modelAbsen->update_absen($data, $tgl);
                }
                
                if ($result) {
                    $respond = [
                        'success' => true,
                        'status'    => 1,
                        'judul'     => "Berhasil",
                        'msg'       => 'Tanggal Absensi ' . date_indo($tgl),
                        'date'      => $tgl
                    ];
                    return $this->respondCreated($respond);
                } else {
                    $respond = [
                        'success' => false,
                        'status'    => 2,
                        'judul'     => "Gagal Absensi",
                        'msg'       => 'Terjadi Kesalahan',

                    ];
                    return $this->respondCreated($respond);
                }
            }
        } else {
            $respond = [
                'success' => false,
                'status' => 3,
                'judul' => "Gagal Absensi",
                'msg'      => 'Gagal verifikasi Kode QR, silahkan coba lagi',
                'qr_out'    => $qr_out,

            ];
            return $this->respond($respond);
        }
    }
}
