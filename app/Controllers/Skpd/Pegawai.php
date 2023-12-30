<?php

namespace App\Controllers\Skpd;

use App\Controllers\BaseController;
use App\Models\UnitModel;
use App\Models\UserModel;
use \Hermawan\DataTables\DataTable;

class Pegawai extends BaseController
{
    public function index()
    {
        if (session('akses') == 2) {
            $modelUnit = new UnitModel();
            $unit = $modelUnit->where('id_unit', session('ses_id_unit'))->first();

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
            $db = db_connect();
            $builder = $db->table('tbl_user')->select('tbl_user.id, 
            tbl_user.nip, 
            tbl_user.nama, 
            tbl_user.id_unit, 
            tbl_user.jabatan, 
            tbl_user.img, 
            tbl_user.id_user, 
            tbl_user.username, 
            tbl_user.`password`, 
            tbl_user.imeiNo, 
            tbl_user.modelName, 
            tbl_user.manufacturerName, 
            tbl_user.deviceName, 
            tbl_user.productName, 
            tbl_unit.nm_unit',)
                ->join('tbl_unit', 'tbl_user.id_unit = tbl_unit.id_unit', 'left')
                ->where('tbl_user.id_unit', session('ses_id_unit'))
                ->orderBy('id', 'asc');

            return DataTable::of($builder)->toJson();;
        }
    }

    public function tambah_peg()
    {
        if (session('akses') == '2') {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < 25; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $model = new UserModel();
            if (!$this->validate([
                'username_peg'     => ['label' => 'Username', 'rules' => 'required'],
                'nama_peg'     => ['label' => 'Nama', 'rules' => 'required'],
                'nip_peg'     => ['label' => 'NIP', 'rules' => 'required|integer|max_length[18]|min_length[18]'],
                'jabatan_peg'     => ['label' => 'jabatan', 'rules' => 'required'],
            ])) {

                $respond = [
                    'success' => false,
                    'username_peg_error' => \Config\Services::validation()->getError('username_peg'),
                    'nama_peg_error' => \Config\Services::validation()->getError('nama_peg'),
                    'nip_peg_error' => \Config\Services::validation()->getError('nip_peg'),
                    'jabatan_peg_error' => \Config\Services::validation()->getError('jabatan_peg'),
                ];

                return json_encode($respond);
            }

            $username = $this->request->getVar('username_peg');
            $nama = $this->request->getVar('nama_peg');
            $nip = $this->request->getVar('nip_peg');
            $jabatan = $this->request->getVar('jabatan_peg');

            $data = [
                'id_user'           => $randomString,
                'nip'           => $nip,
                'nama'           => $nama,
                'id_unit'           => session('ses_id_unit'),
                'jabatan'           => $jabatan,
                'img'           => 'presensi/public/images/user_img_def.png',
                'username'           => $username,
                'password'           => password_hash('PresensiOk', PASSWORD_DEFAULT),
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
        } else {
            $respond = [
                'success' => false,
            ];
            return json_encode($respond);
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
        $data = $model->where('id_user', $id)
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
            'nip_peg_edit'     => ['label' => 'NIP', 'rules' => 'required|integer|max_length[18]|min_length[18]'],
            'jabatan_peg_edit'     => ['label' => 'jabatan', 'rules' => 'required'],


        ])) {

            $respond = [
                'success' => false,
                'username_peg_error' => \Config\Services::validation()->getError('username_peg_edit'),
                'nama_peg_error' => \Config\Services::validation()->getError('nama_peg_edit'),
                'nip_peg_error' => \Config\Services::validation()->getError('nip_peg_edit'),
                'jabatan_peg_error' => \Config\Services::validation()->getError('jabatan_peg_edit'),
            ];

            return json_encode($respond);
        }

        $id = $this->request->getVar('id_user_peg');

        $username = $this->request->getVar('username_peg_edit');
        $nama = $this->request->getVar('nama_peg_edit');
        $nip = $this->request->getVar('nip_peg_edit');
        $jabatan = $this->request->getVar('jabatan_peg_edit');
        $data = [

            'nip'           => $nip,
            'nama'           => $nama,
            'jabatan'           => $jabatan,
            'img'           => 'public/assets/img/160x160/img3.jpg',
            'username'           => $username,
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
            'password'           => password_hash('PresensiOk', PASSWORD_DEFAULT),
            
        ];
        $result = $model->update_peg($data, $id);
        return json_encode($result);
    }

    public function res_dev($id)
    {
        if (session('akses') != '2') {
            return redirect('login');
        }
        $model = new UserModel();    
   
        $data = [
            'imeiNo'           => null,
            'modelName'           => null,
            'manufacturerName'           => null,
            'deviceName'           => null,
            'productName'           => null,
            
        ];
        $result = $model->update_peg($data, $id);
        return json_encode($result);
    }
}
