<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\QrScanModel;
use App\Models\TblAdmin;
use App\Models\UnitModel;
use \Hermawan\DataTables\DataTable;

class Pengaturan extends BaseController
{
    protected $akses;
    public function __construct()
    {
        $this->akses = session('akses');
    }

    public function unit()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $data = array(
                'judul' => 'Pengaturan - Admin SKPD',
                'sub_judul' => session('ses_nm'),
            );
            return view('admin/unit', $data);
        }
    }

    public function json_unit()
    {

        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $db = db_connect();
            $builder = $db->table('tbl_unit')->select('tbl_unit.id_unit, 
            tbl_unit.nm_unit, 
            tbl_unit.pimpinan, 
            tbl_unit.gol, 
            tbl_unit.jabatan, 
            tbl_unit.lat, 
            tbl_unit.`long`, 
            tbl_unit.radius, 
            tbl_unit.created_at, 
            tbl_unit.updated_at')->orderBy('created_at', 'asc');

            return DataTable::of($builder)->toJson();;
        }
    }

    public function tambah_unit()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < 25; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $model = new UnitModel();
            if (!$this->validate([
                'nm_unit'     => ['label' => 'Nama Unit', 'rules' => 'required'],
                'lat'     => ['label' => 'Latitude', 'rules' => 'required|decimal'],
                'long'     => ['label' => 'Longitude', 'rules' => 'required|decimal'],

            ])) {

                $respond = [
                    'success' => false,
                    'nm_unit_error' => \Config\Services::validation()->getError('nm_unit'),
                    'latt_error' => \Config\Services::validation()->getError('lat'),
                    'long_error' => \Config\Services::validation()->getError('long'),

                ];

                return json_encode($respond);
            }

            $nm_unit = $this->request->getVar('nm_unit');
            $lat = $this->request->getVar('lat');
            $long = $this->request->getVar('long');
            $radius = $this->request->getVar('radius');

            $data = [
                'id_unit'           => $randomString,
                'nm_unit'           => $nm_unit,
                'lat'           => $lat,
                'long'           => $long,
                'radius'           => $radius,
                'created_at'           => date('Y/m/d H:i:s'),
            ];

            $data2 = [
                'id_unit'           => $randomString,
                
                'qr_time_in_start'           => date('08:00:00'),
                'qr_time_in_end'           => date('12:00:00'),
                'qr_time_out_start'           => date('15:30:00'),
                'qr_time_out_end'           => date('16:30:00'),
             
            ];

            $result = $model->add($data);
            $result2 = $model->add_qr($data2);

            if ($result) {
                $respond = [
                    'success' => true,
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

    public function get_unit($id_unit)
    {
        $model = new UnitModel();

        $data = $model->where('id_unit', $id_unit)->first();

        return json_encode($data);
    }

    public function update_unit()
    {
        $model = new UnitModel();
        if (!$this->validate([
            'nm_unit_edit'     => ['label' => 'Nama Unit', 'rules' => 'required'],
            'lat_edit'     => ['label' => 'Latitude', 'rules' => 'required|decimal'],
            'long_edit'     => ['label' => 'Longitude', 'rules' => 'required|decimal'],
            'radius_edit'     => ['label' => 'Radius', 'rules' => 'required|decimal'],

        ])) {

            $respond = [
                'success' => false,
                'nm_unit_error' => \Config\Services::validation()->getError('nm_unit_edit'),
                'lat_edit_error' => \Config\Services::validation()->getError('lat_edit'),
                'long_edit_error' => \Config\Services::validation()->getError('long_edit'),
                'radius_edit_error' => \Config\Services::validation()->getError('radius_edit'),

            ];

            return json_encode($respond);
        }

        $id_unit = $this->request->getVar('id_unit');

        $data = [
            'nm_unit'           => $this->request->getVar('nm_unit_edit'),
            'lat'           => $this->request->getVar('lat_edit'),
            'long'           => $this->request->getVar('long_edit'),
            'radius'           => $this->request->getVar('radius_edit'),


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

    public function del_unit($id_unit)
    {
        $model = new UnitModel();
        $modelQr = new QrScanModel();

        $data = $model->where('id_unit', $id_unit)->delete();
        $data2 = $modelQr->where('id_unit', $id_unit)->delete();

        return json_encode($data);
    }

    public function administrator()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $model = new UnitModel();
            $skpd = $model->findAll();

            $data = array(
                'judul' => 'Pengaturan - Administrator',
                'sub_judul' => session('ses_nm'),
                'skpd' => $skpd,

            );
            return view('admin/administrator', $data);
        }
    }

    public function json_administrator()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $db = db_connect();
            $builder = $db->table('tbl_admin')->select('tbl_admin.id_user, 
            tbl_admin.username, 
            tbl_admin.nama, 
            tbl_admin.nip, 
            tbl_admin.email, 
            tbl_admin.created_at, 
            tbl_admin.updated_at, 
            tbl_admin.last_login, 
            tbl_akses.hak_akses, 
            
            tbl_unit.id_unit,
            tbl_unit.nm_unit',)
                ->join('tbl_akses', 'tbl_admin.id_akses = tbl_akses.id_akses', 'left')
                ->join('tbl_unit', 'tbl_admin.id_unit = tbl_unit.id_unit', 'left')
                ->where('tbl_admin.id_akses', 2)
                ->orderBy('created_at', 'asc');

            return DataTable::of($builder)->toJson();;
        }
    }

    public function tambah_adm()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 16; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $model = new TblAdmin();
        if (!$this->validate([
            'username_adm'     => ['label' => 'Username', 'rules' => 'required|min_length[6]'],
            'nama_adm'     => ['label' => 'Nama', 'rules' => 'required'],
            'id_unit_adm'     => ['label' => 'SKPD', 'rules' => 'required'],


        ])) {

            $respond = [
                'success' => false,
                'username_adm_error' => \Config\Services::validation()->getError('username_adm'),
                'nama_adm_error' => \Config\Services::validation()->getError('nama_adm'),
                'id_unit_error' => \Config\Services::validation()->getError('id_unit_adm'),

            ];

            return json_encode($respond);
        }

        $username = $this->request->getVar('username_adm');
        $nama = $this->request->getVar('nama_adm');
        $id_unit = $this->request->getVar('id_unit_adm');


        $data = [
            'id_user'           => $randomString,
            'id_akses'           => 2,
            'username'           => $username,
            'password'           => password_hash('PresensiAdminSKPD', PASSWORD_DEFAULT),
            'nama'           => $nama,
            'id_unit'           => $id_unit,
            'created_at'           => date('Y/m/d H:i:s'),
        ];

        $result = $model->add($data);

        if ($result) {
            $respond = [
                'success' => true,
            ];
            return json_encode($respond);
        } else {
            $respond = [
                'success' => false,
            ];
            return json_encode($respond);
        }
    }

    public function get_adm($id_user)
    {
        $model = new TblAdmin();

        $data = $model->where('id_user', $id_user)->first();

        return json_encode($data);
    }

    public function update_adm()
    {
        $model = new TblAdmin();
        if (!$this->validate([
            'username_adm_edit'     => ['label' => 'Username', 'rules' => 'required|min_length[6]'],
            'nama_adm_edit'     => ['label' => 'Nama', 'rules' => 'required'],
            'id_unit_adm_edit'     => ['label' => 'SKPD', 'rules' => 'required'],

        ])) {

            $respond = [
                'success' => false,
                'username_adm_error_edit' => \Config\Services::validation()->getError('username_adm_edit'),
                'nama_adm_error_edit' => \Config\Services::validation()->getError('nama_adm_edit'),
                'id_unit_error_edit' => \Config\Services::validation()->getError('id_unit_adm_edit'),


            ];

            return json_encode($respond);
        }

        $id_user = $this->request->getVar('id_user_adm');
        $username = $this->request->getVar('username_adm_edit');
        $nama = $this->request->getVar('nama_adm_edit');
        $id_unit = $this->request->getVar('id_unit_adm_edit');


        $data = [


            'username'           => $username,
            'nama'           => $nama,
            'id_unit'           => $id_unit,
            'updated_at'           => date('Y/m/d H:i:s'),
        ];

        $result = $model->update_adm($data, $id_user);

        if ($result) {
            $respond = [
                'success' => true,
            ];
            return json_encode($respond);
        } else {
            $respond = [
                'success' => false,
            ];
            return json_encode($respond);
        }
    }

    public function op_qr()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $model = new UnitModel();
            $skpd = $model->findAll();

            $data = array(
                'judul' => 'Pengaturan - Operator Kode QR',
                'sub_judul' => session('ses_nm'),
                'skpd' => $skpd,

            );
            return view('admin/op_qr', $data);
        }
    }
    public function json_op_qr()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $db = db_connect();
            $builder = $db->table('tbl_admin')->select('tbl_admin.id_user, 
            tbl_admin.username, 
            tbl_admin.nama, 
            tbl_admin.nip, 
            tbl_admin.email, 
            tbl_admin.created_at, 
            tbl_admin.updated_at, 
            tbl_admin.last_login, 
            tbl_akses.hak_akses, 
            
            tbl_unit.id_unit,
            tbl_unit.nm_unit',)
                ->join('tbl_akses', 'tbl_admin.id_akses = tbl_akses.id_akses', 'left')
                ->join('tbl_unit', 'tbl_admin.id_unit = tbl_unit.id_unit', 'left')
                ->where('tbl_admin.id_akses', 3)
                ->orderBy('created_at', 'asc');

            return DataTable::of($builder)->toJson();;
        }
    }

    public function tambah_op_qr()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 16; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $model = new TblAdmin();
        if (!$this->validate([
            'username_op_qr'     => ['label' => 'Username', 'rules' => 'required|min_length[6]'],
            'nama_op_qr'     => ['label' => 'Nama', 'rules' => 'required'],
            'id_unit_op_qr'     => ['label' => 'SKPD', 'rules' => 'required'],


        ])) {

            $respond = [
                'success' => false,
                'username_op_qr_error' => \Config\Services::validation()->getError('username_op_qr'),
                'nama_op_qr_error' => \Config\Services::validation()->getError('nama_op_qr'),
                'id_unit_error' => \Config\Services::validation()->getError('id_unit_op_qr'),

            ];

            return json_encode($respond);
        }

        $username = $this->request->getVar('username_op_qr');
        $nama = $this->request->getVar('nama_op_qr');
        $id_unit = $this->request->getVar('id_unit_op_qr');


        $data = [
            'id_user'           => $randomString,
            'id_akses'           => 3,
            'username'           => $username,
            'password'           => password_hash('PresensiOpQr', PASSWORD_DEFAULT),
            'nama'           => $nama,
            'id_unit'           => $id_unit,
            'created_at'           => date('Y/m/d H:i:s'),
        ];

        $result = $model->add($data);

        if ($result) {
            $respond = [
                'success' => true,
            ];
            return json_encode($respond);
        } else {
            $respond = [
                'success' => false,
            ];
            return json_encode($respond);
        }
    }

    public function get_op_qr($id_user)
    {
        $model = new TblAdmin();

        $data = $model->where('id_user', $id_user)->first();

        return json_encode($data);
    }

    public function update_op_qr()
    {
        $model = new TblAdmin();
        if (!$this->validate([
            'username_op_qr_edit'     => ['label' => 'Username', 'rules' => 'required|min_length[6]'],
            'nama_op_qr_edit'     => ['label' => 'Nama', 'rules' => 'required'],
            'id_unit_op_qr_edit'     => ['label' => 'SKPD', 'rules' => 'required'],

        ])) {

            $respond = [
                'success' => false,
                'username_op_qr_error_edit' => \Config\Services::validation()->getError('username_op_qr_edit'),
                'nama_op_qr_error_edit' => \Config\Services::validation()->getError('nama_op_qr_edit'),
                'id_unit_error_edit' => \Config\Services::validation()->getError('id_unit_op_qr_edit'),


            ];

            return json_encode($respond);
        }

        $id_user = $this->request->getVar('id_user_op_qr_edit');
        $username = $this->request->getVar('username_op_qr_edit');
        $nama = $this->request->getVar('nama_op_qr_edit');
        $id_unit = $this->request->getVar('id_unit_op_qr_edit');


        $data = [


            'username'           => $username,
            'nama'           => $nama,
            'id_unit'           => $id_unit,
            'updated_at'           => date('Y/m/d H:i:s'),
        ];

        $result = $model->update_adm($data, $id_user);

        if ($result) {
            $respond = [
                'success' => true,
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
