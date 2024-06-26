<?php

namespace App\Controllers\Skpd;

use App\Controllers\Api\User;
use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\DayOffIn;
use App\Models\UnitModel;
use App\Models\UserModel;
use \Hermawan\DataTables\DataTable;

class Pegawai extends BaseController
{
    public function index()
    {
        if (session('akses') == 2) {
            $modelUnit = new UnitModel();
            $unit = $modelUnit->where('id', session('ses_id_unit'))->first();

            $data = array(
                'judul' => 'Kelola Pegawai',
                'sub_judul' => 'SKPD : ' . $unit['nm_unit'],
                'unit' => $unit['nm_unit'],
            );
            return view('skpd/pegawai', $data);
        } else {
            return redirect('login');
        }
    }

    public function json_pegawai()
    {
        if ((session('akses') != '2')) {
            return redirect('login');
        } else {
            $idUnit = session('ses_id_unit');
            $db = db_connect();
            $builder = $db->table('users')->select('users.id, 
            users.nip, 
            users.name, 
            users.id_unit, 
            users.jabatan, 
            users.img, 
            users.id, 
            users.nik, 
            users.sort, 

            tbl_unit.nm_unit',)
                ->join('tbl_unit', 'users.id_unit = tbl_unit.id', 'left')
                ->where('users.id_unit', session('ses_id_unit'))
                // ->orderBy('CASE WHEN users.sort IS NULL THEN 1 ELSE users.sort', 'asc')
                ->orderBy('users.sort', 'asc')
                ->orderBy('users.nip', 'asc');


            return DataTable::of($builder)->toJson();;
        }
    }

    public function tambah_peg()
    {
        $model = new UserModel();

        // Ambil NIK dari inputan
        // Data valid, simpan ke database
        $nip        = $this->request->getVar('nip_peg');
        $name       = $this->request->getVar('nama_peg');
        $status       = $this->request->getVar('status_peg');
        $id_unit    = session()->get('ses_id_unit');
        $jabatan    = $this->request->getVar('jabatan_peg');
        $nik    = $this->request->getVar('nik_peg');
        $email    = $this->request->getVar('email_peg');



        if (!$this->validate([
            'nik_peg'     => ['label' => 'NIK', 'rules' => 'required'],
            'nama_peg'     => ['label' => 'Nama', 'rules' => 'required'],
            'status_peg'     => ['label' => 'Nama', 'rules' => 'required'],
            'nip_peg'     => ['label' => 'NIP', 'rules' => 'required|max_length[18]|min_length[1]'],
            'email_peg'     => ['label' => 'Email', 'rules' => 'required'],
            'jabatan_peg'     => ['label' => 'Jabatan', 'rules' => 'required'],
        ])) {
            $respond = [
                'success' => false,
                'nik_peg_error' => \Config\Services::validation()->getError('nik_peg'),
                'nama_peg_error' => \Config\Services::validation()->getError('nama_peg'),
                'status_peg_error' => \Config\Services::validation()->getError('status_peg'),
                'nip_peg_error' => \Config\Services::validation()->getError('nip_peg'),
                'email_peg_error' => \Config\Services::validation()->getError('email_peg'),
                'jabatan_peg_error' => \Config\Services::validation()->getError('jabatan_peg'),
            ];

            return json_encode($respond);
        }
        $existingUser = $model->where('nik', $nik)->first();
        if ($existingUser) {
            $respond = [
                'success' => false,
                'nik_unik_error' => 'NIK sudah digunakan. Silakan masukkan NIK yang lain.'
            ];
            return json_encode($respond);
        }




        // echo json_encode($nik);

        $user = [
            'nip' => $nip,
            'nik' => $nik,
            'name' => $name,
            'status_peg' => $status,
            'id_unit' => $id_unit,
            'jabatan' => $jabatan,
            'email' => $email,
            'username' => $nik,
            'password' => password_hash('baritotimurkab', PASSWORD_DEFAULT),
        ];

        // echo $user;

        $result = $model->add($user);


        if ($result) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false, 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function del_peg($id)
    {
        if (session('akses') == '2') {
            $model = new UserModel();
            $data = $model->where('id_user', $id)->delete();
            return json_encode($data);
        }
    }

    public function get_peg($id)
    {
        if (session('akses') != '2') {
            return redirect('login');
        }
        $model = new UserModel();
        $data = $model->where('id', $id)
            ->first();

        return json_encode($data);
    }

    public function update_peg()
    {
        if (session('akses') != '2') {
            return redirect('login');
        }
        $model = new UserModel();
        if (!$this->validate([
            'username_peg_edit'     => ['label' => 'Username', 'rules' => 'required'],
            'nama_peg_edit'     => ['label' => 'Nama', 'rules' => 'required'],
            'email_peg_edit'     => ['label' => 'Email', 'rules' => 'required'],
            'status_peg_edit'     => ['label' => 'Status', 'rules' => 'required'],
            'nip_peg_edit'     => ['label' => 'NIP', 'rules' => 'required|max_length[18]|min_length[1]'],
            'jabatan_peg_edit'     => ['label' => 'jabatan', 'rules' => 'required'],


        ])) {

            $respond = [
                'success' => false,
                'username_peg_error' => \Config\Services::validation()->getError('username_peg_edit'),
                'nama_peg_error' => \Config\Services::validation()->getError('nama_peg_edit'),
                'status_peg_edit_error' => \Config\Services::validation()->getError('status_peg_edit'),
                'email_peg_error' => \Config\Services::validation()->getError('email_peg'),
                'nip_peg_error' => \Config\Services::validation()->getError('nip_peg_edit'),
                'jabatan_peg_error' => \Config\Services::validation()->getError('jabatan_peg_edit'),
            ];

            return json_encode($respond);
        }

        $id = $this->request->getVar('id_user_peg');

        $username = $this->request->getVar('username_peg_edit');
        $nama = $this->request->getVar('nama_peg_edit');
        $status = $this->request->getVar('status_peg_edit');
        $nip = $this->request->getVar('nip_peg_edit');
        $jabatan = $this->request->getVar('jabatan_peg_edit');
        $email = $this->request->getVar('email_peg_edit');
        $data = [

            'nip'           => $nip,
            'name'           => $nama,
            'status_peg'           => $status,
            'jabatan'           => $jabatan,
            'nik'           => $username,
            'username'           => $username,
            'email'           => $email,
        ];
        $result = $model->update_peg($data, $id);
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

    public function sort_peg()
    {
        if (session('akses') != '2') {
            return redirect('login');
        }
        $model = new UserModel();
        if (!$this->validate([
            'sort_peg'     => ['label' => 'No urut', 'rules' => 'required|integer'],


        ])) {

            $respond = [
                'success' => false,
                'sort_peg_error' => \Config\Services::validation()->getError('sort'),

            ];

            return json_encode($respond);
        }

        $id = $this->request->getVar('id_user_sort_peg');

        $sort = $this->request->getVar('sort_peg');

        $data = [

            'sort'           => $sort,

        ];
        $result = $model->update_peg($data, $id);
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

    public function ress_pass($id)
    {
        if (session('akses') != '2') {
            return redirect('login');
        }
        $model = new UserModel();

        $data = [
            'password'           => password_hash('baritotimurkab', PASSWORD_DEFAULT),

        ];
        $result = $model->update_peg($data, $id);
        return json_encode($result);
    }

    public function del_check_in($id)
    {

        $db = db_connect();
        $absenModel = new AbsenModel();
        $dayIn = new DayOffIn();

        $row = $absenModel->where('id_absen', $id)->first();

        $jamIn = $row['tgl_in'];
        $jamOut = $row['tgl_out'];


        $tglIn = $row['tgl_in'];
        $cekOffIn = $db->table('off_day_in')->where('id_user', $row['id_user'])->where('tgl_in_off', $tglIn)->get()->getRow();
        if ($jamIn && $jamOut) {
            $data = [
                'tgl_in' => null,
                'jam_in' => null,
                'id_ket_in' => null,
            ];
            $result = $absenModel->update_data($data, $id);
            if ($cekOffIn) {
                $dayIn->where('id_user', $row['id_user'])->where('tgl_in_off', $tglIn)->delete();
            }
            return json_encode($result);
        } else if ($jamIn && !$jamOut) {

            $result = $absenModel->where('id_absen', $id)->delete();
            if ($cekOffIn) {
                $dayIn->where('id_user', $row['id_user'])->where('tgl_in_off', $tglIn)->delete();
            }
            return json_encode($result);
        } else if (!$jamIn && $jamOut) {
            $data = [
                'tgl_in' => null,
                'jam_in' => null,
                'id_ket_in' => null,
            ];
            $result =  $absenModel->update_data($data, $id);
            if ($cekOffIn) {
                $dayIn->where('id_user', $row['id_user'])->where('tgl_in_off', $tglIn)->delete();
            }
            return json_encode($result);
        }
    }

    public function del_check_out($id)
    {
        $db = db_connect();
        $absenModel = new AbsenModel();

        $row = $absenModel->where('id_absen', $id)->first();

        $jamIn = $row['tgl_in'];
        $jamOut = $row['tgl_out'];
        $cekOffOut = $db->table('off_day_out')->where('id_user', $row['id_user'])->where('tgl_out_off', $jamOut)->get()->getRow();
        if ($jamIn && $jamOut) {
            $data = [
                'tgl_out' => null,
                'jam_out' => null,
                'id_ket_out' => null,
            ];
            $result =  $absenModel->update_data($data, $id);
            if ($cekOffOut) {
                $db->table('off_day_out')->where('id_user', $row['id_user'])->where('tgl_out_off', $jamOut)->delete();
            }
            echo $result;
        } else if ($jamIn && !$jamOut) {
            $data = [
                'tgl_out' => null,
                'jam_out' => null,
                'id_ket_out' => null,
            ];
            $result =  $absenModel->update_data($data, $id);
            if ($cekOffOut) {
                $db->table('off_day_out')->where('id_user', $row['id_user'])->where('tgl_out_off', $jamOut)->delete();
            }
            echo $result;
        } else if (!$jamIn && $jamOut) {
            $result = $absenModel->where('id_absen', $id)->delete();
            if ($cekOffOut) {
                $db->table('off_day_out')->where('id_user', $row['id_user'])->where('tgl_out_off', $jamOut)->delete();
            }
        }
    }

    public function del_absen($id)
    {
        $db = db_connect();
        $absenModel = new AbsenModel();
        $row = $absenModel->where('id_absen', $id)->first();
        $tglIn = $row['tgl_in'];
        $tglOut = $row['tgl_out'];
        $cekOffIn = $db->table('off_day_in')->where('id_user', $row['id_user'])->where('tgl_in_off', $tglIn)->get()->getRow();
        $cekOffOut = $db->table('off_day_out')->where('id_user', $row['id_user'])->where('tgl_out_off', $tglOut)->get()->getRow();
        $result = $absenModel->where('id_absen', $id)->delete();
        if ($cekOffIn) {
            $db->table('off_day_in')->where('id_user', $row['id_user'])->where('tgl_in_off', $tglIn)->delete();
        }
        if ($cekOffOut) {
            $db->table('off_day_out')->where('id_user', $row['id_user'])->where('tgl_out_off', $tglOut)->delete();
        }
    }
}
