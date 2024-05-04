<?php

namespace App\Controllers\Skpd;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use \Hermawan\DataTables\DataTable;
use Dompdf\Dompdf;
use Dompdf\Options;

class Rekap extends BaseController
{

    public function rekap_pegawai()
    {
        $modelUnit = new UnitModel();
            $unit = $modelUnit->where('id', session('ses_id_unit'))->first();

            $data = array(
                'judul' => 'Rekap Absensi Pegawai',
                'sub_judul' => $unit['nm_unit'],
                'unit' => $unit['nm_unit'],
            );
            return view('skpd/rekap/pegawai', $data);
    }

    public function json_rekap($month, $year)
    {
        if ((session('akses') != '2')) {
            return redirect('login');
        } else {

            $db = db_connect();
            $builder = $db->table('tpp')->select('tpp.id, 
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
            users.`name`, 
            users.nip,tpp.updated_at,tpp.updated_by')
                ->join('users', 'tpp.id_user = users.id', 'left')
                ->where('users.id_unit', session('ses_id_unit'))
                ->where('tpp.month', $month)
                ->where('tpp.year', $year)

                ->orderBy('users.sort', 'asc')
                ->orderBy('users.nip', 'asc');


            return DataTable::of($builder)->toJson();;
        }
    }

    public function get_absen_user($id, $month, $year)
    {
        
        $db = db_connect();
        $model = new AbsenModel();
        $user = $db->table('users')->where('users.id', $id)->get()->getRow();
        $unit = $db->table('tbl_unit')->where('id', $user->id_unit)->get()->getRow();
        // Mendapatkan jumlah hari dalam bulan
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Array untuk menyimpan hasil
        $data = [];
        // Mendapatkan tanggal-tanggal yang ingin dilewati dari database
        $resultDateToSkip = $db->table('date_to_skip')
            ->select('date_to_skip')
            ->where('MONTH(date_to_skip)', $month)
            ->get()
            ->getResultArray();

        // Mengonversi hasil dari objek hasil query menjadi array
        $datesToSkip = array_column($resultDateToSkip, 'date_to_skip');
        // Looping semua tanggal dalam bulan
        for ($day = 1; $day <= $daysInMonth; $day++) {
            // Format tanggal sesuai dengan tanggal looping
            $date = sprintf("%04d-%02d-%02d", $year, $month, $day);
            // Periksa apakah tanggal termasuk dalam tanggal-tanggal yang ingin dilewati
            if (in_array($date, $datesToSkip)) {
                // Jika tanggal termasuk dalam tanggal-tanggal yang ingin dilewati, lewati dan lanjutkan ke tanggal berikutnya
                continue;
            }

            if ($unit->hari_kerja == 5) {
                // Periksa apakah hari adalah Sabtu 
                $dayOfWeek = date('N', strtotime($date)); // 1 (for Monday) through 7 (for Sunday)
                if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                    // Jika hari adalah Sabtu, lewati dan lanjutkan ke tanggal berikutnya
                    continue;
                }
            }

            if ($unit->hari_kerja == 6) {
                $dayOfSunday = date('N', strtotime($date)); // 1 (for Monday) through 7 (for Sunday)
                if ($dayOfSunday == 7) {
                    // Jika hari adalah  Minggu, lewati dan lanjutkan ke tanggal berikutnya
                    continue;
                }
            }

            // Query untuk tanggal tertentu
            $result = $model->where('id_user', $id)
                ->where('DATE(created_at)', $date)
                ->findAll();

            // Jika ada data untuk tanggal ini
            if (!empty($result)) {
                // Menambahkan hasil ke dalam array
                $data[$date] = $result;
            } else {
                // Jika tidak ada data, tambahkan entri dengan data null
                $data[$date] = [
                    [
                        'id_absen' => null,
                        'id_user' => $id,
                        'tgl_in' => null,
                        'id_ket_in' => null,
                        'jam_in' => null,
                        'ket_absen_in' => null,
                        'tgl_out' => null,
                        'id_ket_out' => null,
                        'jam_out' => null,
                        'ket_absen_out' => null,
                        'created_at' => null,
                    ]
                ];
            }
        }

        return $data;
    }

    public function view_absen($id, $month, $year)
    {
       
        helper(['time']);
        helper('tanggal_indo_helper');
        $user = new UserModel();
        // Panggil fungsi untuk mendapatkan data absen
        $data = $this->get_absen_user($id, $month, $year);
        $name = $user->where('id', $id)->first();
        // Load view dan kirimkan data absen ke dalam view
        return view('skpd/rekap/rekap_absen_per_peg', [
            'data' => $data,
            'judul' => $name['name'],
            'sub_judul' => bulan($month)

        ]);
    }

    public function view_absen_tpp($id, $month, $year)
    {
     
        $db = db_connect();
        helper(['time']);
        helper('tanggal_indo_helper');
        $user = new UserModel();
        // Panggil fungsi untuk mendapatkan data absen
        $data = $this->get_absen_user($id, $month, $year);
        $user = $db->table('users')->where('users.id', $id)->get()->getRow();
        $upacara = $db->table('tbl_subtraction')->where('id_user', $id)->where('year', $year)->where('month', $month)->get()->getRow();
        $unit = $db->table('tbl_unit')->where('id', $user->id_unit)->get()->getRow();
        $tpp = $db->table('tpp')->where('id_user', $id)->where('month', $month)->where('year', $year)->get()->getFirstRow();

        // Load view dan kirimkan data absen ke dalam view
        if (!$upacara) {
            $keg = '0';
        } else {
            $keg = $upacara->keg;
        }
        return view('skpd/rekap/rekap_absen_tpp', [
            'tl1_rekap' => $tpp->tl1 ?? 0.00,
            'tl2_rekap' => $tpp->tl2 ?? 0.00,
            'tl3_rekap' => $tpp->tl3 ?? 0.00,
            'tl4_rekap' => $tpp->tl4 ?? 0.00,
            'psw1_rekap' => $tpp->psw1 ?? 0.00,
            'psw2_rekap' => $tpp->psw2 ?? 0.00,
            'psw3_rekap' => $tpp->psw3 ?? 0.00,
            'psw4_rekap' => $tpp->psw4 ?? 0.00,
            'thck1_rekap' => $tpp->thck1 ?? 0.00,
            'thck2_rekap' => $tpp->thck2 ?? 0.00,
            'thck3_rekap' => $tpp->thck3 ?? 0.00,
            'tk_rekap' => $tpp->tk ?? 0.00,
            'tu_rekap' => $tpp->tu ?? 0.00,
            'lhkpn_rekap' => $tpp->lhkpn ?? 0.00,
            'tptgr_rekap' => $tpp->tptgr ?? 0.00,
            'dk_rekap' => $tpp->dk ?? 0.00,
            'subtraction_rekap' => $tpp->subtraction ?? 0.00,
            'user' => $user,
            'data' => $data,
            'keg' => $keg,
            'judul' => $user->name,
            'nama' => $user->name,
            'jabatan' => $user->jabatan,
            'nip' => $user->nip,
            'sub_judul' => '',
            'bulan' => $month,
            'tahun' => $year,
            'id' => $id,
            'jam_masuk' => $unit->jam_masuk,
            'jam_pulang' => $unit->jam_pulang,
            'hari_kerja' => $unit->hari_kerja,
        ]);
    }

    public function view_absen_tpp_pdf($id, $month, $year)
    {
        $db = db_connect();
        helper(['time']);
        helper('tanggal_indo_helper');

        // Panggil fungsi untuk mendapatkan data absen
        $data = $this->get_absen_user($id, $month, $year);
        $user = $db->table('users')->where('users.id', $id)->get()->getRow();
        $upacara = $db->table('tbl_subtraction')->where('id_user', $id)->where('year', $year)->where('month', $month)->get()->getRow();
        $unit = $db->table('tbl_unit')->where('id', $user->id_unit)->get()->getRow();
        // Load view dan kirimkan data absen ke dalam view
        if (!$upacara) {
            $keg = '0';
        } else {
            $keg = $upacara->keg;
        }
        // Load view dan kirimkan data absen ke dalam view
        $dataPrint = [
            'user' => $user,
            'unit' => $unit->nm_unit,
            'data' => $data,
            'keg' => $keg,
            'judul' => $user->name,
            'nama' => $user->name,
            'jabatan' => $user->jabatan,
            'nip' => $user->nip,
            'sub_judul' => '',
            'bulan' => $month,
            'tahun' => $year,
            'id' => $id,
            'jam_masuk' => $unit->jam_masuk,
            'jam_pulang' => $unit->jam_pulang,
            'hari_kerja' => $unit->hari_kerja,
        ];

        // Membuat options untuk domPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        // Membuat instance dari Dompdf dengan options
        $dompdf = new Dompdf($options);

        // Render view ke dalam HTML
        $html = view('skpd/rekap/rekap_absen_tpp_pdf', $dataPrint);

        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($html);

        // Mengatur ukuran dan orientasi halaman
        $dompdf->setPaper('Legal', 'potrait');

        // Render HTML ke dalam PDF
        $dompdf->render();

        // Mengirimkan output PDF ke browser
        $dompdf->stream($user->name . '_' . bulan($month) . '_' . $year . '.pdf', [
            'Attachment' => false
        ]);
    }

    public function view_rekap_tpp_pdf($month, $year)
    {
        $db = db_connect();
        helper(['time']);
        helper('tanggal_indo_helper');

        // Panggil fungsi untuk mendapatkan data absen
        $data = $db->table('tpp')->select('tpp.id, 
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
	users.`name`, 
	users.nip')
            ->join('users', 'tpp.id_user = users.id', 'left')
            ->where('tpp.month', $month)
            ->where('tpp.year', $year)
            ->where('users.id_unit', session('ses_id_unit'))
            ->orderBy('users.sort', 'ASC')
            ->get()
            ->getResult();

        $unit = $db->table('tbl_unit')->where('id', session('ses_id_unit'))->get()->getRow();

        $dataPrint = [
            'unit' => $unit->nm_unit,
            'bulan' => bulan($month),
            'tahun' => $year,
            'data' => $data,
            'kasubbag' => $unit->kasubbag,
            'nip_kasubbag' => $unit->nip_kasubbag


        ];

        // var_dump($dataPrint);
        // Membuat options untuk domPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        // Membuat instance dari Dompdf dengan options
        $dompdf = new Dompdf($options);

        // Render view ke dalam HTML
        $html = view('skpd/rekap/rekap_tpp_pdf', $dataPrint);

        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($html);

        // Mengatur ukuran dan orientasi halaman
        $dompdf->setPaper('Legal', 'landscape');

        // Render HTML ke dalam PDF
        $dompdf->render();

        // Mengirimkan output PDF ke browser
        $dompdf->stream($unit->nm_unit .'Rekap ASN & NON-ASN'. '_' . bulan($month) . '_' . $year . '.pdf', [
            'Attachment' => false
        ]);
    }

    public function view_rekap_tpp_asn_pdf($month, $year)
    {
        $db = db_connect();
        helper(['time']);
        helper('tanggal_indo_helper');

        // Panggil fungsi untuk mendapatkan data absen
        $data = $db->table('tpp')->select('tpp.id, 
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
	users.`name`, 
	users.nip')
            ->join('users', 'tpp.id_user = users.id', 'left')
            ->where('tpp.month', $month)
            ->where('tpp.year', $year)
            ->where('users.id_unit', session('ses_id_unit'))
            ->where('users.status_peg', 'ASN')
            ->orderBy('users.sort', 'ASC')
            ->get()
            ->getResult();
        $unit = $db->table('tbl_unit')->where('id', session('ses_id_unit'))->get()->getRow();

        $dataPrint = [
            'unit' => $unit->nm_unit,
            'bulan' => bulan($month),
            'tahun' => $year,
            'data' => $data,
            'kasubbag' => $unit->kasubbag,
            'nip_kasubbag' => $unit->nip_kasubbag


        ];

        // var_dump($dataPrint);
        // Membuat options untuk domPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        // Membuat instance dari Dompdf dengan options
        $dompdf = new Dompdf($options);

        // Render view ke dalam HTML
        $html = view('skpd/rekap/rekap_tpp_asn_pdf', $dataPrint);

        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($html);

        // Mengatur ukuran dan orientasi halaman
        $dompdf->setPaper('Legal', 'landscape');

        // Render HTML ke dalam PDF
        $dompdf->render();

        // Mengirimkan output PDF ke browser
        $dompdf->stream($unit->nm_unit .'Rekap ASN'. '_' . bulan($month) . '_' . $year . '.pdf', [
            'Attachment' => false
        ]);
    }

    public function view_rekap_absen_non_asn_tpp($month, $year)
    {
        $db = db_connect();
        helper(['time']);
        helper('tanggal_indo_helper');

        // Panggil fungsi untuk mendapatkan data absen
        $data = $db->table('tpp')->select('tpp.id, 
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
	users.`name`, 
	users.nip')
            ->join('users', 'tpp.id_user = users.id', 'left')
            ->where('tpp.month', $month)
            ->where('users.id_unit', session('ses_id_unit'))
            ->where('tpp.year', $year)
            ->where('users.status_peg', 'NON-ASN')
            ->orderBy('users.sort', 'ASC')
            ->get()
            ->getResult();
        $unit = $db->table('tbl_unit')->where('id', session('ses_id_unit'))->get()->getRow();

        $dataPrint = [
            'unit' => $unit->nm_unit,
            'bulan' => bulan($month),
            'tahun' => $year,
            'data' => $data,
            'kasubbag' => $unit->kasubbag,
            'nip_kasubbag' => $unit->nip_kasubbag


        ];

        // var_dump($dataPrint);
        // Membuat options untuk domPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        // Membuat instance dari Dompdf dengan options
        $dompdf = new Dompdf($options);

        // Render view ke dalam HTML
        $html = view('skpd/rekap/rekap_absen_non_asn_tpp', $dataPrint);

        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($html);

        // Mengatur ukuran dan orientasi halaman
        $dompdf->setPaper('Legal', 'landscape');

        // Render HTML ke dalam PDF
        $dompdf->render();

        // Mengirimkan output PDF ke browser
        $dompdf->stream($unit->nm_unit . '_' . bulan($month) . '_' . $year . '.pdf', [
            'Attachment' => false
        ]);
    }
}
