<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UnitModel;
use App\Models\UserModel;
use \Hermawan\DataTables\DataTable;

class Absensi extends BaseController
{
    public function index()
    {
        $modelUnit = new UnitModel();
        $unit = $modelUnit->findAll();
        $data = array(
            'judul' => 'Kelola Data Absensi Pegawai',
            'sub_judul' => '',
            'unit' => $unit,
        );
        return view('admin/absensi', $data);
    }

    public function json_absensi($id, $unit, $year, $month,)
    {
        $db = db_connect();
        $builder = $db->table('tbl_absen')
            ->select(
                'tbl_absen.id_absen, 
                users.name,
                tbl_absen.id_user, 
                tbl_absen.tgl_in, 
                tbl_absen.jam_in, 
                ket_in.ket AS keterangan_in, 
                tbl_absen.tgl_out, 
                tbl_absen.jam_out, 
                ket_out.ket AS keterangan_out,
                tbl_absen.created_at,'
            )

            ->join('tbl_ket as ket_in', 'tbl_absen.id_ket_in = ket_in.id', 'left')
            ->join('tbl_ket as ket_out', 'tbl_absen.id_ket_out = ket_out.id', 'left')
            ->join('users', 'tbl_absen.id_user = users.id', 'left')
            ->join('tbl_unit', 'users.id_unit = tbl_unit.id', 'left')
            ->where('tbl_absen.id_user', $id)
            ->where('users.id_unit', $unit)
            ->where('YEAR(tbl_absen.created_at)', $year)
            ->where('MONTH(tbl_absen.created_at)', $month)
            ->orderBy('tbl_absen.created_at', 'ASC');
        return DataTable::of($builder)->toJson();
    }

    public function get_user($id)
    {
        $model = new UserModel();

        $data = $model->where('id_unit', $id)->orderBy('sort','asc')->findAll();

        return json_encode($data);
    }

    public function get_upacara($id, $month, $year)
    {

        $db = db_connect();
        $upacara = $db->table('tbl_subtraction')->where('id_user', $id)->where('year', $year)->where('month', $month)->get()->getRow();

        if ($upacara) {

            return json_encode($upacara);
        } else {

            $response = [
                'keg' => '0',


            ];
            return json_encode($response);
        }
    }
    public function get_subtraction($id)
    {

        $db = db_connect();
        $user = $db->table('users')->where('id', $id)->get()->getRow();
        if ($user) {
            $respond = [

                'lhkpn_lhasn' => $user->lhkpn_lhasn,
                'tptgr' => $user->tptgr,
            ];
            return json_encode($respond);
        } else {
            $respond = [
                'msg' => "no data",
            ];
            return json_encode($respond);
        }
    }

    public function subtraction()
    {


        $db = db_connect();


        $user = new UserModel();
        if (!$this->validate([
            'user_absen'     => ['label' => 'ID', 'rules' => 'required'],
            'bulan_absen'     => ['label' => 'Bulan', 'rules' => 'required'],
            'tahun_absen'     => ['label' => 'Tahun', 'rules' => 'required'],
            'keg_upacara'     => ['label' => 'Kegiatan', 'rules' => 'required'],
            'lhkpn_lhasn'     => ['label' => 'LHKPN', 'rules' => 'required'],
            'tptgr'     => ['label' => 'TPTGR', 'rules' => 'required'],


        ])) {

            $respond = [
                'success' => false,
                'user_absen_error' => \Config\Services::validation()->getError('user_absen'),
                'bulan_absen_error' => \Config\Services::validation()->getError('bulan_absen'),
                'tahun_absen_error' => \Config\Services::validation()->getError('tahun_absen'),
                'keg_upacara_error' => \Config\Services::validation()->getError('keg_upacara'),
                'lhkpn_lhasn_error' => \Config\Services::validation()->getError('lhkpn_lhasn'),
                'tptgr_error' => \Config\Services::validation()->getError('tptgr'),

            ];

            return json_encode($respond);
        }

        $id = $this->request->getVar('user_absen');
        $month = $this->request->getVar('bulan_absen');
        $year = $this->request->getVar('tahun_absen');
        $keg_upacara = $this->request->getVar('keg_upacara');
        $lhkpn_lhasn = $this->request->getVar('lhkpn_lhasn');
        $tptgr = $this->request->getVar('tptgr');
        $upacara = $db->table('tbl_subtraction')->where('id_user', $id)->where('year', $year)->where('month', $month)->get()->getRow();
        $data = [

            'lhkpn_lhasn'           => $lhkpn_lhasn,
            'tptgr'           => $tptgr,

        ];

        $data2 = [
            'id_user' => $id,
            'keg' => $keg_upacara,
            'month' => $month,
            'year' => $year,
        ];

        if ($upacara) {
            $result2 = $user->update_keg($data2, $id, $month, $year);
        } else {
            $result2 = $user->add_keg($data2);
        }

        $result = $user->update_peg($data, $id);
        if ($result && $result2) {
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

    public function posted_tpp()
    {

        $db = db_connect();
        $id_tpp = $this->request->getVar('id_tpp');
        $tl1 = $this->request->getVar('tl1');
        $tl2 = $this->request->getVar('tl2');
        $tl3 = $this->request->getVar('tl3');
        $tl4 = $this->request->getVar('tl4');
        $psw1 = $this->request->getVar('psw1');
        $psw2 = $this->request->getVar('psw2');
        $psw3 = $this->request->getVar('psw3');
        $psw4 = $this->request->getVar('psw4');
        $thck1 = $this->request->getVar('thck1');
        $thck2 = $this->request->getVar('thck2');
        $thck3 = $this->request->getVar('thck3');
        $tk = $this->request->getVar('tk');
        $tu = $this->request->getVar('tu');
        $lhkpn = $this->request->getVar('lhkpn');
        $tptgr = $this->request->getVar('tptgr');
        $subtraction = $this->request->getVar('subtraction');
        $dk = $this->request->getVar('dk');
        $month_tpp = $this->request->getVar('month_tpp');
        $year_tpp = $this->request->getVar('year_tpp');

        $tpp = $db->table('tpp')->where('id_user', $id_tpp)->where('month', $month_tpp)->where('year', $year_tpp)->get()->getRow();

        $data = [
            'id_user' => $id_tpp,
            'tl1' => $tl1,
            'tl2' => $tl2,
            'tl3' => $tl3,
            'tl4' => $tl4,
            'psw1' => $psw1,
            'psw2' => $psw2,
            'psw3' => $psw3,
            'psw4' => $psw4,
            'thck1' => $thck1,
            'thck2' => $thck2,
            'thck3' => $thck3,
            'tk' => $tk,
            'tu' => $tu,
            'lhkpn' => $lhkpn,
            'tptgr' => $tptgr,
            'dk' => $dk,
            'subtraction' => $subtraction,
            'month' => $month_tpp,
            'year' => $year_tpp,
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session('ses_nm'),
        ];

        if ($tpp) {
            $result = $db->table('tpp')->where('id_user', $id_tpp)->where('month', $month_tpp)->where('year', $year_tpp)->update($data);
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
        } else {
            $result = $db->table('tpp')->insert($data);
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

    public function get_ket()
    {
        if ((session('akses') != '2')) {
            return redirect('login');
        }
        $db = db_connect();

        $id = $this->request->getVar('id');
        $date = $this->request->getVar('date');

        $tanggalFormatted = date('Y-m-d', strtotime($date));
        $data1 = $db->table('off_day_in')->where('id_user', $id)->where('tgl_in_off', $tanggalFormatted)->get()->getFirstRow();
        $data2 = $db->table('off_day_out')->where('id_user', $id)->where('tgl_out_off', $tanggalFormatted)->get()->getFirstRow();

        if ($data1 && !$data2) {
            $result = [
                'tgl_in_off' => date('d-m-Y', strtotime($data1->tgl_in_off)),
                'no_surat_in' => $data1->no_surat_in,
                'ket_in' => $data1->ket_in,
                'tgl_out_off' => "-",
                'no_surat_out' => "-",
                'ket_out' => "-",
            ];
            return $this->response->setJSON($result);
        } else if (!$data1 && $data2) {
            $result = [
                'tgl_in_off' => "-",
                'no_surat_in' => "-",
                'ket_in' => "-",
                'tgl_out_off' => date('d-m-Y', strtotime($data2->tgl_out_off)),
                'no_surat_out' => $data2->no_surat_out,
                'ket_out' => $data2->ket_out,
            ];
            return $this->response->setJSON($result);
        } else if (!$data1 && !$data2) {
            $result = [
                'tgl_in_off' => "-",
                'no_surat_in' => "-",
                'ket_in' => "-",
                'tgl_out_off' => "-",
                'no_surat_out' => "-",
                'ket_out' => "-",
            ];
            return $this->response->setJSON($result);
        } else if ($data1 && $data2) {
            $result = [
                'tgl_in_off' => date('d-m-Y', strtotime($data1->tgl_in_off)),
                'no_surat_in' => $data1->no_surat_in,
                'ket_in' => $data1->ket_in,
                'tgl_out_off' => date('d-m-Y', strtotime($data2->tgl_out_off)),
                'no_surat_out' => $data2->no_surat_out,
                'ket_out' => $data2->ket_out,
            ];
            return $this->response->setJSON($result);
        }
    }

    public function get_tpp_by_id($id)
    {
        $db = db_connect();
        $data = $db->table('tpp')
            ->select('tpp.id, 
        tpp.id_user, 
        tpp.tl1, 
        tpp.tl2, 
        tpp.tl3, 
        tpp.tl4, 
        tpp.psw1, 
        tpp.psw2, 
        tpp.psw3, 
        tpp.psw4, 
        tpp.thck1, 
        tpp.thck2, 
        tpp.thck3, 
        tpp.tk, 
        tpp.tu, 
        tpp.lhkpn, 
        tpp.tptgr, 
        tpp.dk, 
        tpp.subtraction, 
        tpp.`month`, 
        tpp.`year`, 
        tpp.updated_at, 
        tpp.updated_by, 
        users.`name`, 
        users.nip')
            ->join('users', 'tpp.id_user = users.id', 'left')
            ->where('tpp.id', $id)
            ->get()->getFirstRow();
        return $this->response->setJSON($data);
    }

    public function get_count_peg()
    {
    }
}
