<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

use App\Libraries\JWTCI4;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (!$this->validate([
            'username'     => 'required',
            'password'     => 'required|min_length[6]',
        ])) {

            $respon = [
                'success' => false,
                'msg' => \Config\Services::validation()->getErrors(),

            ];
            return $this->response->setJSON($respon);
        }
        $db = db_connect();
        $userModel = new UserModel($db);

        $imeiNo = $this->request->getVar('imeiNo');
        $modelName = $this->request->getVar('modelName');
        $manufacturerName = $this->request->getVar('manufacturerName');
        $deviceName = $this->request->getVar('deviceName');
        $productName = $this->request->getVar('productName');



        $user = $userModel->table('tbl_user')->where('username', $this->request->getVar('username'))->first();
        if ($user) {
            if (password_verify($this->request->getVar('password'), $user['password'])) {

                if ($user['imeiNo'] == null) {
                    $data = [
                        'imeiNo'           => $imeiNo,

                        'modelName'        => $modelName,
                        'manufacturerName'        => $manufacturerName,
                        'deviceName'       => $deviceName,
                        'productName'     => $productName,

                    ];
                    $result = $userModel->update_user($data, $this->request->getVar('username'));
                    $jwt = new JWTCI4;
                    $token = $jwt->token();
                    $respon = [
                        'success' => true,
                        'id_user' => $user['id_user'],
                        'id_unit' => $user['id_unit'],
                        'username' => $user['username'],
                        'nama' => $user['nama'],
                        'token' => $token,
                    ];
                    return $this->response->setJSON($respon);
                } else if ($imeiNo == $user['imeiNo']) {
                    $jwt = new JWTCI4;
                    $token = $jwt->token();
                    $respon = [
                        'success' => true,
                        'id_user' => $user['id_user'],
                        'id_unit' => $user['id_unit'],
                        'username' => $user['username'],
                        'nama' => $user['nama'],
                        'token' => $token,
                    ];
                    return $this->response->setJSON($respon);

                } else if ($imeiNo != $user['imeiNo']) {
                    $respon = [
                        'success' => false,
                        'msg' => 'Anda menggunakan Perangkat yang berbeda hubungi Admin untuk ganti Perangkat',
                        'sub_msg' => 'Perangkat sebelumnya '.$manufacturerName." ".$productName

                    ];
                    return $this->response->setJSON($respon);
                }
            } else {
                $respon = [
                    'success' => false,
                    'msg' => 'Username/Password salah',
                    'sub_msg' => ''
                    

                ];
                return $this->response->setJSON($respon);
            }
        } else {
            $respon = [
                'success' => false,
                'msg' => 'Pengguna tidak ditemukan',
                'sub_msg' => ''

            ];
            return $this->response->setJSON($respon);
        }
    }
}
