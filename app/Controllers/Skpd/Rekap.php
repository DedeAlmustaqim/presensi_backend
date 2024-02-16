<?php

namespace App\Controllers\Skpd;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use \Hermawan\DataTables\DataTable;

class Rekap extends BaseController
{

    public function rekap_pegawai()
    {
        if (session('akses') == 2) {
            $modelUnit = new UnitModel();
            $unit = $modelUnit->where('id', session('ses_id_unit'))->first();

            $data = array(
                'judul' => 'Rekap Absensi Pegawai',
                'sub_judul' => $unit['nm_unit'],
                'unit' => $unit['nm_unit'],
            );
            return view('skpd/rekap/pegawai', $data);
        } else {
            return redirect('login');
        }
    }

    public function get_absen_user($id, $month, $year)
    {
        $db = db_connect();
        $model = new AbsenModel();

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

            // Periksa apakah hari adalah Sabtu atau Minggu
            $dayOfWeek = date('N', strtotime($date)); // 1 (for Monday) through 7 (for Sunday)
            if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                // Jika hari adalah Sabtu atau Minggu, lewati dan lanjutkan ke tanggal berikutnya
                continue;
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
                        'bukti' => null,
                        'tgl_out' => null,
                        'id_ket_out' => null,
                        'jam_out' => null,
                        'ket_absen_out' => null,
                        'stts_ijin' => null,
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
        helper(['time']);
        helper('tanggal_indo_helper');
        $user = new UserModel();
        // Panggil fungsi untuk mendapatkan data absen
        $data = $this->get_absen_user($id, $month, $year);
        $name = $user->where('id', $id)->first();
        // Load view dan kirimkan data absen ke dalam view
        return view('skpd/rekap/rekap_absen_tpp', [
            'data' => $data,
            'judul' => $name['name'],
            'sub_judul' => bulan($month)

        ]);
    }
}
