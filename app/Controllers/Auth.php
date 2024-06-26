<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Service\UserActivityLogger;
use App\Models\TblAdmin;

class Auth extends BaseController
{
    protected $userActivityLogger;
    public function __construct()
    {
        $this->userActivityLogger = new UserActivityLogger(new \App\Models\UserActivityModel());
    }

    public function login()
    {
        $userModel = new TblAdmin();
        $request = service('request');
        $ip = $request->getIPAddress();
        $user = $userModel->table('tbl_admin')
            ->where('username', $this->request->getVar('username'))
            ->join('tbl_akses', 'tbl_admin.id_akses = tbl_akses.id_akses', 'left')
            ->first();
        if ($user) {
            if (password_verify($this->request->getVar('password'), $user['password'])) {

                session()->set('masuk', true);
                if ($user['id_akses'] == '1') { //Akses admin
                    session()->set('login', true);
                    session()->set('akses', '1');
                    session()->set('hak_akses', $user['hak_akses']);
                    session()->set('ses_id', $user['id']);
                    session()->set('ses_user', $user['username']);
                    session()->set('ses_nm', $user['nama']);
                    $this->userActivityLogger->logActivity($user['nama'], 'Login IP Address '.$ip,'Hak Akses ' . $user['hak_akses']);

                    return redirect('admin/dashboard');
                } else if ($user['id_akses'] == '2') { //
                    session()->set('login', true);

                    session()->set('akses', '2');
                    session()->set('hak_akses', $user['hak_akses']);
                    session()->set('ses_id', $user['id']);
                    session()->set('ses_user', $user['username']);
                    session()->set('ses_nm', $user['nama']);
                    session()->set('ses_id_unit', $user['id_unit']);
                    $this->userActivityLogger->logActivity($user['nama'], 'Login IP Address '.$ip,'Hak Akses ' . $user['hak_akses']);

                    return redirect('skpd/dashboard');
                } else if ($user['id_akses'] == '3') { //
                    session()->set('login', true);

                    session()->set('akses', '3');
                    session()->set('hak_akses', $user['hak_akses']);
                    session()->set('ses_id', $user['id']);
                    session()->set('ses_user', $user['username']);
                    session()->set('ses_nm', $user['nama']);
                    session()->set('ses_id_unit', $user['id_unit']);
                    $this->userActivityLogger->logActivity($user['nama'], 'Login IP Address '.$ip,'Hak Akses ' . $user['hak_akses']);

                    return redirect('qrscan');
                } else if ($user['id_akses'] == '4') { //
                    session()->set('login', true);
                    $this->userActivityLogger->logActivity($user['nama'], 'Login IP Address '.$ip,'Hak Akses ' . $user['hak_akses']);

                    session()->set('akses', '4');
                    session()->set('hak_akses', $user['hak_akses']);
                    session()->set('ses_id', $user['id']);
                    session()->set('ses_user', $user['username']);
                    session()->set('ses_nm', $user['nama']);
                    session()->set('ses_id_unit', $user['id_unit']);

                    return redirect('admin/dashboard');
                }
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
    function logout()
    {
        session()->destroy();
        return redirect('login');
    }
}
