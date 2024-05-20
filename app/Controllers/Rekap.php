<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\CutiModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use \Hermawan\DataTables\DataTable;
use Dompdf\Dompdf;
use Dompdf\Options;

class Rekap extends BaseController
{

    

    

    

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


   

    public function view_absen_tpp_pdf($id, $month, $year)
    {
        $db = db_connect();
        helper(['time']);
        helper('tanggal_indo_helper');
        $cutiModel = new CutiModel();
        // Panggil fungsi untuk mendapatkan data absen
        $data = $this->get_absen_user($id, $month, $year);
        $user = $db->table('users')->where('users.id', $id)->get()->getRow();
        $upacara = $db->table('tbl_subtraction')->where('id_user', $id)->where('year', $year)->where('month', $month)->get()->getRow();
        $unit = $db->table('tbl_unit')->where('id', $user->id_unit)->get()->getRow();
        $countCutiBesar = $cutiModel->countCutiByMonth($id, $month, 7);
        $countCutiSakit = $cutiModel->countCutiByMonth($id, $month, 8);
        $countCutiTahunan = $cutiModel->countCutiByMonth($id,$month, 9);
        // Load view dan kirimkan data absen ke dalam view
        if (!$upacara) {
            $keg = '0';
        } else {
            $keg = $upacara->keg;
        }
        // Load view dan kirimkan data absen ke dalam view
        $dataPrint = [
            'countCutiBesar' => $countCutiBesar,
            'countCutiSakit' => $countCutiSakit,
            'countCutiTahunan' => $countCutiTahunan,
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
        exit();
    }

    

}
