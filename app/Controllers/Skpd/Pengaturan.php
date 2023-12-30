<?php

namespace App\Controllers\Skpd;

use App\Controllers\BaseController;
use App\Models\QrScanModel;
use App\Models\UnitModel;


class Pengaturan extends BaseController
{
    public function unit()
    {
        if ((session('akses') != '2')) {
            return redirect('login');
        } else {
            $data = array(
                'judul' => 'Pengaturan - SKPD',
                'sub_judul' => session('ses_nm'),
            );
            return view('skpd/unit', $data);
        }
    }

    public function get_unit($id_unit)
    {
        if (session('akses') == '2') {
            $model = new UnitModel();
            $data = $model->where('id_unit', $id_unit)->first();
            return json_encode($data);
        } else {
            return redirect('login');
        }
    }

    public function update_unit()
    {
        $model = new UnitModel();
        if (!$this->validate([
            'id_unit_skpd'     => ['label' => 'Id Unit', 'rules' => 'required'],
            'nm_unit_skpd'     => ['label' => 'Nama Unit', 'rules' => 'required'],
            'pimpinan_skpd'     => ['label' => 'Nama Pimpinan', 'rules' => 'required'],
            'gol_skpd'     => ['label' => 'Golongan', 'rules' => 'required'],
            'jabatan_skpd'     => ['label' => 'Jabatan', 'rules' => 'required'],
            'lat_skpd'     => ['label' => 'Latitude', 'rules' => 'required|decimal'],
            'long_skpd'     => ['label' => 'Longitude', 'rules' => 'required|decimal'],
            'radius_skpd'     => ['label' => 'Radius', 'rules' => 'required|decimal'],

        ])) {

            $respond = [
                'success' => false,
                'id_unit_skpd_error' => \Config\Services::validation()->getError('id_unit_skpd'),
                'nm_unit_skpd_error' => \Config\Services::validation()->getError('nm_unit_skpd'),
                'pimpinan_skpd_error' => \Config\Services::validation()->getError('pimpinan_skpd'),
                'gol_skpd_error' => \Config\Services::validation()->getError('gol_skpd'),
                'jabatan_skpd_error' => \Config\Services::validation()->getError('jabatan_skpd'),
                'lat_skpd_error' => \Config\Services::validation()->getError('lat_skpd'),
                'long_skpd_error' => \Config\Services::validation()->getError('long_skpd'),
                'radius_skpd_error' => \Config\Services::validation()->getError('radius_skpd'),

            ];

            return json_encode($respond);
        }

        $id_unit = $this->request->getVar('id_unit_skpd');

        $data = [
            'nm_unit'           => $this->request->getVar('nm_unit_skpd'),
            'pimpinan'           => $this->request->getVar('pimpinan_skpd'),
            'gol'           => $this->request->getVar('gol_skpd'),
            'jabatan'           => $this->request->getVar('jabatan_skpd'),
            'lat'           => $this->request->getVar('lat_skpd'),
            'long'           => $this->request->getVar('long_skpd'),
            'radius'           => $this->request->getVar('radius_skpd'),
            'updated_at'           => date('Y/m/d H:i:s'),


        ];
        $result = $model->update_unit($data, $id_unit);
        if ($result) {
            $respond = [
                'success'   => true,
            ];
            return json_encode($respond);
        } else {
            $respond = [
                'success' => false,

            ];
            return json_encode($respond);
        }
    }

    public function jadwal()
    {
        if ((session('akses') != '2')) {
            return redirect('login');
        } else {
            $data = array(
                'judul' => 'Pengaturan - Jadwal QR Code',
                'sub_judul' => session('ses_nm'),
            );
            return view('skpd/jadwal', $data);
        }
    }

    public function get_jadwal($id_unit)
    {
        $model = new QrScanModel();
        $data = $model->select('
        DATE_FORMAT(qr_time_in_start, "%H:%i") as qr_time_in_start,
        DATE_FORMAT(qr_time_in_end, "%H:%i") as qr_time_in_end,
        DATE_FORMAT(qr_time_out_start, "%H:%i") as qr_time_out_start,
        DATE_FORMAT(qr_time_out_end, "%H:%i") as qr_time_out_end,
        ')
            ->where('id_unit', $id_unit)
            ->first();

        return json_encode($data);
    }

    public function update_jadwal()
    {
        $model = new QrScanModel();
        if (!$this->validate([
            'id_unit_jadwal'     => ['label' => 'Id Unit', 'rules' => 'required'],
            'qr_time_in_start'     => ['label' => 'QR Masuk Mulai', 'rules' => 'required'],
            'qr_time_in_end'     => ['label' => 'QR Masuk Berakhir', 'rules' => 'required'],
            'qr_time_out_start'     => ['label' => 'QR Keluar Mulai', 'rules' => 'required'],
            'qr_time_out_end'     => ['label' => 'QR Keluar Berakhir', 'rules' => 'required'],


        ])) {

            $respond = [
                'success' => false,
                'id_unit_jadwal_error' => \Config\Services::validation()->getError('id_unit_jadwal'),
                'qr_time_in_start_error' => \Config\Services::validation()->getError('qr_time_in_start'),
                'qr_time_in_end_error' => \Config\Services::validation()->getError('qr_time_in_end'),
                'qr_time_out_start_error' => \Config\Services::validation()->getError('qr_time_out_start'),
                'qr_time_out_end_error' => \Config\Services::validation()->getError('qr_time_out_end'),
            ];

            return json_encode($respond);
        }

        $id_unit = $this->request->getVar('id_unit_jadwal');

        $data = [
            'qr_time_in_start'           => $this->request->getVar('qr_time_in_start'),
            'qr_time_in_end'           => $this->request->getVar('qr_time_in_end'),
            'qr_time_out_start'           => $this->request->getVar('qr_time_out_start'),
            'qr_time_out_end'           => $this->request->getVar('qr_time_out_end'),
           


        ];
        $result = $model->update_qrscan($data, $id_unit);
        if ($result) {
            $respond = [
                'success'   => true,
            ];
            return json_encode($respond);
        } else {
            $respond = [
                'success' => false,

            ];
            return json_encode($respond);
        }
    }
}
