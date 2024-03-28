<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ConfigModel;
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

    public function user()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $model = new UnitModel();
            $skpd = $model->whereNotIn('id', [1])->findAll();

            $data = array(
                'judul' => 'Pengaturan - Pengguna',
                'sub_judul' => session('ses_nm'),
                'skpd' => $skpd
            );
            return view('admin/user', $data);
        }
    }
    public function json_user($id)
    {

        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $db = db_connect();
            $builder = $db->table('users')->select('users.id, 
            users.`name`, 
            users.email, 
            users.email_verified_at, 
            users.nik, 
            users.`password`, 
            users.remember_token, 
            users.created_at, 
            users.updated_at, 
            users.nip, 
            users.id_unit, 
            users.jabatan, 
            users.img, 
            users.username, 
            users.current_login, 
            users.sort, 
            tbl_unit.nm_unit')
                ->join('tbl_unit', 'users.id_unit = tbl_unit.id', 'left')
                ->where('tbl_unit.id', $id)
                ->whereNotIn('users.id', [1])
                ->orderBy('tbl_unit.id', 'asc')
                ->orderBy('users.sort', 'asc');

            return DataTable::of($builder)->toJson();
        }
    }

    public function json_unit()
    {

        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $db = db_connect();
            $builder = $db->table('tbl_unit')->select('tbl_unit.id, 
            tbl_unit.nm_unit, 
            tbl_unit.pimpinan, 
            tbl_unit.gol, 
            tbl_unit.jabatan, 
            tbl_unit.lat, 
            tbl_unit.`long`, 
            tbl_unit.radius, 
            tbl_unit.jam_masuk, 
            tbl_unit.jam_pulang, 
            tbl_unit.hari_kerja, 
            tbl_unit.created_at, 
            tbl_unit.updated_at')
                ->whereNotIn('tbl_unit.id', [1])
                ->orderBy('created_at', 'asc');

            return DataTable::of($builder)->toJson();
        }
    }

    public function tambah_unit()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {

            $model = new UnitModel();
            if (!$this->validate([
                'nm_unit'     => ['label' => 'Nama Unit', 'rules' => 'required'],
                'lat'     => ['label' => 'Latitude', 'rules' => 'required|decimal'],
                'long'     => ['label' => 'Longitude', 'rules' => 'required|decimal'],
                'jam_masuk'     => ['label' => 'Jam Masuk', 'rules' => 'required'],
                'jam_pulang'     => ['label' => 'Jam Pulang', 'rules' => 'required'],
                'h_kerja'     => ['label' => 'Hari Kerja', 'rules' => 'required'],

            ])) {

                $respond = [
                    'success' => false,
                    'nm_unit_error' => \Config\Services::validation()->getError('nm_unit'),
                    'lat_error' => \Config\Services::validation()->getError('lat'),
                    'long_error' => \Config\Services::validation()->getError('long'),
                    'jam_masuk_error' => \Config\Services::validation()->getError('jam_masuk'),
                    'jam_pulang_error' => \Config\Services::validation()->getError('jam_pulang'),
                    'h_kerja_error' => \Config\Services::validation()->getError('h_kerja'),

                ];

                return json_encode($respond);
            }

            $nm_unit = $this->request->getVar('nm_unit');
            $lat = $this->request->getVar('lat');
            $long = $this->request->getVar('long');
            $jam_masuk = $this->request->getVar('jam_masuk');
            $jam_pulang = $this->request->getVar('jam_pulang');
            $hari_kerja = $this->request->getVar('hari_kerja');


            $data = [

                'nm_unit'           => $nm_unit,
                'lat'           => $lat,
                'long'           => $long,
                'jam_masuk'           => $jam_masuk,
                'jam_pulang'           => $jam_pulang,
                'hari_kerja'           => $hari_kerja,

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
    }

    public function get_unit($id_unit)
    {
        $model = new UnitModel();

        $data = $model->where('id', $id_unit)->first();

        return json_encode($data);
    }

    public function update_unit()
    {
        $model = new UnitModel();
        if (!$this->validate([
            'nm_unit_edit'     => ['label' => 'Nama Unit', 'rules' => 'required'],
            'lat_edit'     => ['label' => 'Latitude', 'rules' => 'required|decimal'],
            'long_edit'     => ['label' => 'Longitude', 'rules' => 'required|decimal'],
            'jam_masuk_edit'     => ['label' => 'Jam Masuk', 'rules' => 'required'],
            'jam_pulang_edit'     => ['label' => 'jam Pulang', 'rules' => 'required'],
            'h_kerja_edit'     => ['label' => 'Hari Kerja', 'rules' => 'required'],

        ])) {

            $respond = [
                'success' => false,
                'nm_unit_error' => \Config\Services::validation()->getError('nm_unit_edit'),
                'lat_edit_error' => \Config\Services::validation()->getError('lat_edit'),
                'long_edit_error' => \Config\Services::validation()->getError('long_edit'),
                'jam_masuk_edit_error' => \Config\Services::validation()->getError('jam_masuk_edit'),
                'jam_pulang_edit_error' => \Config\Services::validation()->getError('jam_pulang_edit'),
                'h_kerja_edit_error' => \Config\Services::validation()->getError('h_kerja_edit'),

            ];

            return json_encode($respond);
        }

        $id = $this->request->getVar('id_unit_skpd_edit');

        $data = [
            'nm_unit'           => $this->request->getVar('nm_unit_edit'),
            'lat'           => $this->request->getVar('lat_edit'),
            'long'           => $this->request->getVar('long_edit'),
            'jam_masuk'           => $this->request->getVar('jam_masuk_edit'),
            'jam_pulang'           => $this->request->getVar('jam_pulang_edit'),
            'hari_kerja'           => $this->request->getVar('h_kerja_edit'),



        ];
        $result = $model->update($id, $data);
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


        $data = $model->where('id', $id_unit)->delete();


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
            $builder = $db->table('tbl_admin')->select('tbl_admin.id, 
            tbl_admin.username, 
            tbl_admin.nama, 
            tbl_admin.nip, 
            tbl_admin.email, 
            tbl_admin.created_at, 
            tbl_admin.updated_at, 
            tbl_admin.last_login, 
            tbl_akses.hak_akses, 
            
            tbl_unit.id as id_unit,
            tbl_unit.nm_unit',)
                ->join('tbl_akses', 'tbl_admin.id_akses = tbl_akses.id_akses', 'left')
                ->join('tbl_unit', 'tbl_admin.id_unit = tbl_unit.id', 'left')
                ->where('tbl_admin.id_akses', 2)
                ->orderBy('created_at', 'asc');

            return DataTable::of($builder)->toJson();;
        }
    }

    public function tambah_adm()
    {


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

            'id_akses'           => 2,
            'username'           => $username,
            'password'           => password_hash('adminSKPD6213', PASSWORD_DEFAULT),
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

        $data = $model->where('id', $id_user)->first();

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

    public function reset_adm($id)
    {
        $model = new TblAdmin();
        
       


        $data = [

            'password'           => password_hash('adminSKPD6213', PASSWORD_DEFAULT),
            'updated_at'           => date('Y/m/d H:i:s'),
        ];

        $result = $model->update_adm($data, $id);

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
            $builder = $db->table('tbl_admin')->select('tbl_admin.id, 
            tbl_admin.username, 
            tbl_admin.nama, 
            tbl_admin.nip, 
            tbl_admin.email, 
            tbl_admin.created_at, 
            tbl_admin.updated_at, 
            tbl_admin.last_login, 
            tbl_akses.hak_akses, 
            
            tbl_unit.id as id_unit,
            tbl_unit.nm_unit',)
                ->join('tbl_akses', 'tbl_admin.id_akses = tbl_akses.id_akses', 'left')
                ->join('tbl_unit', 'tbl_admin.id_unit = tbl_unit.id', 'left')
                ->where('tbl_admin.id_akses', 3)
                ->orderBy('tbl_unit.id', 'asc');

            return DataTable::of($builder)->toJson();;
        }
    }

    public function tambah_op_qr()
    {


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
            'id_akses'           => 3,
            'username'           => $username,
            'password'           => password_hash('operatorQR6213', PASSWORD_DEFAULT),
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

        $data = $model->where('id', $id_user)->first();

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

    public function reset_op($id)
    {
        $model = new TblAdmin();
        
       


        $data = [

            'password'           => password_hash('operatorQR6213', PASSWORD_DEFAULT),
            'updated_at'           => date('Y/m/d H:i:s'),
        ];

        $result = $model->update_adm($data, $id);

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
    public function config()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {



            $data = array(
                'judul' => 'Pengaturan - Umum',
                'sub_judul' => session('ses_nm'),


            );
            return view('admin/config', $data);
        }
    }

    public function get_config()
    {
        if (session('akses') == '1') {
            $db = db_connect();
            $data = $db->table('tbl_config')->get()->getRowArray();
            return json_encode($data);
        } else {
            return redirect('login');
        }
    }

    public function update_config()
    {
        $model = new ConfigModel();
        if (!$this->validate([
            'nm_pemda'     => ['label' => 'Pemda', 'rules' => 'required'],
            'jam_masuk'     => ['label' => 'Jam Masuk', 'rules' => 'required'],
            'jam_pulang'     => ['label' => 'Jam Pulang', 'rules' => 'required'],
            'qr_time_in_start'     => ['label' => 'QR IN Start', 'rules' => 'required'],
            'qr_time_in_end'     => ['label' => 'QR Out End', 'rules' => 'required'],
            'qr_time_out_start'     => ['label' => 'QR In Start', 'rules' => 'required'],
            'qr_time_out_end'     => ['label' => 'QR Out End', 'rules' => 'required'],
            'radius_config'     => ['label' => 'Radius', 'rules' => 'required'],
            'versi_apk'     => ['label' => 'Versi APK', 'rules' => 'required'],

        ])) {

            $respond = [
                'success_error' => false,
                'nm_pemda_error' => \Config\Services::validation()->getError('nm_pemda'),
                'jam_masuk_error' => \Config\Services::validation()->getError('jam_masuk'),
                'jam_pulang_error' => \Config\Services::validation()->getError('jam_pulang'),
                'qr_time_in_start_error' => \Config\Services::validation()->getError('qr_time_in_start'),
                'qr_time_in_end_error' => \Config\Services::validation()->getError('qr_time_in_end'),
                'qr_time_out_start_error' => \Config\Services::validation()->getError('qr_time_out_start'),
                'qr_time_out_end_error' => \Config\Services::validation()->getError('qr_time_out_end'),
                'radius_config_error' => \Config\Services::validation()->getError('radius_config'),
                'versi_apk_error' => \Config\Services::validation()->getError('versi_apk'),


            ];

            return json_encode($respond);
        }

        $nm_pemda = $this->request->getVar('nm_pemda');
        $jam_masuk = $this->request->getVar('jam_masuk');
        $jam_pulang = $this->request->getVar('jam_pulang');
        $qr_time_in_start = $this->request->getVar('qr_time_in_start');
        $qr_time_in_end = $this->request->getVar('qr_time_in_end');
        $qr_time_out_start = $this->request->getVar('qr_time_out_start');
        $qr_time_out_end = $this->request->getVar('qr_time_out_end');
        $radius_config = $this->request->getVar('radius_config');
        $versi_apk = $this->request->getVar('versi_apk');


        $data = [


            'nm_pemda'                  => $nm_pemda,
            'qr_time_in_start'          => $qr_time_in_start,
            'qr_time_in_end'            => $qr_time_in_end,
            'qr_time_out_start'         => $qr_time_out_start,
            'qr_time_out_end'           => $qr_time_out_end,
            'radius'                    => $radius_config,
            'versi_apk'                 => $versi_apk,
            'jam_masuk'                 => $jam_masuk,
            'jam_pulang'                => $jam_pulang,

        ];

        $result = $model->update(1, $data);

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
