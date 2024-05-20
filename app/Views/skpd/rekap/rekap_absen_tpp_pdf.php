<!DOCTYPE html>
<html>

<head>
    <title><?= $nama . '_' . $bulan . '_' . $tahun ?></title>
    <style>
        /** Define the margins of your page **/
        @page {
            margin-top: 30;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 20px;
            right: 20px;
            height: 30px;

            /** Extra personal styles **/
            color: #000000;
            text-align: center;
            line-height: 30px;
        }

        table {
            border-collapse: collapse;
            font-size: 14px;
        }



        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 40px;

            /** Extra personal styles **/
            color: #000000;
            text-align: left;
            line-height: 35px;
        }

        h1 {
            display: block;
            font-size: 24px;
            margin-top: 0.2em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h2 {
            display: block;
            font-size: 12;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h3 {
            display: block;
            font-size: 1.0em;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h4 {
            display: block;
            font-size: 0.8em;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        .text_td {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 8px;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            padding: 2;
        }

        .text_utama {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            padding: 2;
        }


        .text-center {

            text-align: center;
        }

        .text-right {

            text-align: right;
        }

        .text-left {

            text-align: left;
        }

        .text-danger {
            color: red;
        }
    </style>
</head>


<body>


    <h4 class="text-center">REKAP KEHADIRAN PEGAWAI <br> <?= $unit ?> </h4>
    <h4 class="text-center">Bulan <?= bulan($bulan) ?> Tahun <?= $tahun ?></h4>
    <br>
    <table width="100%" border="0">
        <tr>
            <td width="10%">Nama</td>
            <td width="2%">:</td>
            <td class="text_left"><?= $nama ?></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td><?= $nip ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= $jabatan ?></td>
        </tr>
    </table>
    <br>

    <table width="100%" border="1" cellpadding="5" cellspacing="0">


        <tr class="text-center" style="background-color: #f2f2f2;">
            <th scope="col" width="10%">Hari</th>
            <th scope="col" width="15%">Tanggal</th>
            <th scope="col" width="15%">Masuk<br> <?= $jam_masuk ?></th>
            <th scope="col" width="15%">Pulang<br><?= $jam_pulang ?></th>
            <th scope="col" width="15%">Flag TL</th>
            <th scope="col" width="15%">Flag PSW</th>
            <th scope="col" width="15%">Flag TK</th>


        </tr>

        <?php
                        $today = date('Y-m-d'); // Tanggal hari ini
                        $TL1 = 0;
                        $TL2 = 0;
                        $TL3 = 0;
                        $TL4 = 0;
                        $PSW1 = 0;
                        $PSW2 = 0;
                        $PSW3 = 0;
                        $PSW4 = 0;
                        $TK = 0;
                        $THKC1 = 0;
                        $THKC2 = 0;
                        $THKC3 = 0;
                        $LHKPN = 0;
                        $TPTGR = 0;
                        $IZIN_IN = 0;
                        $IZIN_OUT = 0;


                        foreach ($data as $date => $absenData) :
                            if ($date > $today) {
                                continue;
                            }
                        ?>
                            <?php foreach ($absenData as $absen) : ?>
                                <?php

                                if ($absen['id_ket_in'] == 5) {
                                    $IZIN_IN++;
                                }
                                if ($absen['id_ket_out'] == 5) {
                                    $IZIN_OUT++;
                                }
                                // if ($absen['id_ket_in'] == 7 && $absen['id_ket_out'] == 7) {
                                //     $THKC1++;
                                // }
                                // if ($absen['id_ket_in'] == 8 && $absen['id_ket_out'] == 8) {
                                //     $THKC2++;
                                // }
                                // if ($absen['id_ket_in'] == 9 && $absen['id_ket_out'] == 9) {
                                //     $THKC3++;
                                // }
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        // Array nama-nama hari dalam bahasa Indonesia
                                        $dayNames = array(
                                            'Minggu', 'Senin', 'Selasa', 'Rabu',
                                            'Kamis', 'Jumat', 'Sabtu'
                                        );

                                        // Tanggal yang ingin dikonversi
                                        $dateConvert = $date;

                                        // Mengonversi tanggal menjadi nama hari
                                        $dayOfWeek = date('w', strtotime($dateConvert));
                                        $dayName = $dayNames[$dayOfWeek];

                                        // Output nama hari
                                        echo $dayName; // Output: Jumat
                                        ?>
                                    </td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($date)) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($absen['id_ket_in'] == 1) {
                                            echo  $absen['jam_in'];
                                        } else if ($absen['id_ket_in'] == 2) {
                                            echo  "Tugas Dinas";
                                        } else if ($absen['id_ket_in'] == 3) {
                                            echo  "Dinas Dalam Daerah";
                                        } else if ($absen['id_ket_in'] == 4) {
                                            echo  "Dinas Luar Daerah";
                                        } else if ($absen['id_ket_in'] == 5) {

                                            echo  "Izin Alasan Tertentu";
                                        } else if ($absen['id_ket_in'] == 6) {
                                            echo  "Izin Sakit";
                                        } else if ($absen['id_ket_in'] == 7) {
                                            echo  "Cuti Besar <br> (THKC 1)";
                                        } else if ($absen['id_ket_in'] == 8) {
                                            echo  "Cuti Sakit <br> (THKC 2)";
                                        } else if ($absen['id_ket_in'] == 9) {
                                            echo  "Cuti Tahunan <br> (THKC 3)";
                                        } else {

                                            echo "<p class='text-danger'>Belum Absen</p>";
                                        }
                                        ?>

                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($absen['id_ket_out'] == 1) {
                                            echo  $absen['jam_out'];
                                        } else if ($absen['id_ket_out'] == 2) {
                                            echo  "Tugas Dinas";
                                        } else if ($absen['id_ket_out'] == 3) {
                                            echo  "Dinas Dalam Daerah";
                                        } else if ($absen['id_ket_out'] == 4) {
                                            echo  "Dinas Luar Daerah";
                                        } else if ($absen['id_ket_out'] == 5) {

                                            echo  "Izin Alasan Tertentu";
                                        } else if ($absen['id_ket_out'] == 6) {
                                            echo  "Izin Sakit";
                                        } else if ($absen['id_ket_in'] == 7) {
                                            echo  "Cuti Besar <br> (THCK 1)";
                                        } else if ($absen['id_ket_in'] == 8) {
                                            echo  "Cuti Sakit <br> (THCK 2)";
                                        } else if ($absen['id_ket_in'] == 9) {
                                            echo  "Cuti Tahunan <br> (THCK 3)";
                                        } else {
                                            echo "<p class='text-danger'>Belum Absen</p>";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        // Cek apakah jam masuk tidak ada (null)
                                        if ($absen['jam_in'] === null) {
                                            if ($absen['id_ket_in'] == null && $absen['id_ket_out'] != null) {
                                                $TL4++;
                                                echo "<p class='text-danger'>TL 4</p>"; // Pengguna belum pulang
                                            } else {
                                                echo "-";
                                            }
                                        } else {
                                            if ($absen['id_ket_in'] == 1) {
                                                // Hitung selisih waktu dari jam masuk dengan jam 08:00
                                                $jamMasuk = strtotime($absen['jam_in']);
                                                $jamTepat = strtotime($jam_masuk);
                                                $selisih = $jamMasuk - $jamTepat;

                                                // Hitung dalam menit
                                                $selisihMenit = round($selisih / 60);

                                                // Tentukan status keterlambatan
                                                if ($selisihMenit >= 1 && $selisihMenit <= 29) {
                                                    $TL1++;
                                                    echo 'TL1 <br><span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                                                } elseif ($selisihMenit >= 30 && $selisihMenit <= 59) {
                                                    $TL2++;
                                                    echo 'TL2 <br><span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                                                } elseif ($selisihMenit >= 60 && $selisihMenit <= 89) {
                                                    $TL3++;
                                                    echo 'TL3 <br><span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                                                } elseif ($selisihMenit > 89) {
                                                    $TL4++;
                                                    echo 'TL4 <br><span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                                                } else {
                                                    // Tidak terlambat
                                                    echo '-';
                                                }
                                            } else {
                                                echo '-';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        // Cek apakah jam pulang tidak ada (null)
                                        if ($absen['jam_out'] === null) {
                                            if ($absen['id_ket_in'] != null && $absen['id_ket_out'] == null) {
                                                $PSW4++;
                                                echo "<p class='text-danger'>PSW4 </p>"; // Pengguna belum pulang
                                            } else {
                                                echo "-";
                                            }
                                        } else {
                                            if ($absen['id_ket_out'] == 1) {
                                                // Hitung selisih waktu dari jam pulang dengan jam 16:00
                                                $jamPulang = strtotime($absen['jam_out']);
                                                $jamTepatPulang = strtotime($jam_pulang);
                                                $selisihPulang = $jamTepatPulang - $jamPulang;

                                                // Hitung dalam menit
                                                $selisihMenitPulang = round($selisihPulang / 60);

                                                // Tentukan status pulang lebih cepat
                                                if ($selisihMenitPulang >= 1 && $selisihMenitPulang <= 29) {
                                                    $PSW1++;
                                                    echo 'PSW1<br><span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                                                } elseif ($selisihMenitPulang >= 30 && $selisihMenitPulang <= 59) {
                                                    $PSW2++;
                                                    echo 'PSW2<br><span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                                                } elseif ($selisihMenitPulang >= 60 && $selisihMenitPulang <= 89) {
                                                    $PSW3++;
                                                    echo 'PSW3<br><span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                                                } elseif ($selisihMenitPulang > 89) {
                                                    $PSW4++;
                                                    echo 'PSW4<br> <span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                                                } else {
                                                    // Tidak pulang lebih cepat
                                                    echo '-';
                                                }
                                            } else {
                                                // Tidak pulang lebih cepat
                                                echo '-';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><?php if (($absen['jam_in'] == null  && ($absen['jam_out'] == null))) {
                                                                if ($absen['id_ket_in'] == null && $absen['id_ket_out'] == null) {
                                                                    $TK++;
                                                                    echo '<span class="text-danger">TK</span>';
                                                                }
                                                            } ?></td>


                                    <!-- <td class="text-center">
                                <?php
                                // Waktu awal (dalam format H:i:s)
                                $time1 = '12:00:00';




                                if ($absen['jam_in'] == null) {
                                    $time2 = '12:00:00';
                                } else {
                                    $time2 = $absen['jam_in'];
                                }
                                // Mengonversi waktu string menjadi objek DateTime
                                $dateTime1 = DateTime::createFromFormat('H:i:s', $time1);
                                $dateTime2 = DateTime::createFromFormat('H:i:s', $time2);

                                // Memeriksa apakah konversi berhasil
                                if ($dateTime1 !== false && $dateTime2 !== false) {
                                    // Menghitung perbedaan waktu
                                    $interval1 = $dateTime1->diff($dateTime2);

                                    // Menghitung total detik dari perbedaan waktu
                                    $totalSeconds1 = $interval1->h * 3600 + $interval1->i * 60 + $interval1->s;

                                    // Menghitung jam, menit, dan detik dari total detik
                                    $hours1 = floor($totalSeconds1 / 3600);
                                    $minutes1 = floor(($totalSeconds1 % 3600) / 60);
                                    $seconds1 = $totalSeconds1 % 60;
                                }
                                ?>

                                <?php
                                // Inisialisasi waktu awal dan waktu akhir
                                $time1 = ($absen['jam_out'] == null) ? '13:00:00' : $absen['jam_out'];
                                $time2 = '13:00:00';

                                // Mengonversi waktu string menjadi objek DateTime
                                $dateTime1 = DateTime::createFromFormat('H:i:s', $time1);
                                $dateTime2 = DateTime::createFromFormat('H:i:s', $time2);

                                // Memeriksa apakah konversi berhasil
                                if ($dateTime1 !== false && $dateTime2 !== false) {
                                    // Menghitung perbedaan waktu
                                    $interval2 = $dateTime1->diff($dateTime2);

                                    // Menghitung total detik dari perbedaan waktu
                                    $totalSeconds2 = $interval2->h * 3600 + $interval2->i * 60 + $interval2->s;

                                    // Menghitung jam, menit, dan detik dari total detik
                                    $hours2 = floor($totalSeconds2 / 3600);
                                    $minutes2 = floor(($totalSeconds2 % 3600) / 60);
                                    $seconds2 = $totalSeconds2 % 60;
                                }

                                ?>

                                <?php
                                // Menghitung total jam kerja
                                $totalHours = isset($hours1) ? $hours1 : 0;
                                $totalMinutes = isset($minutes1) ? $minutes1 : 0;
                                $totalSeconds = isset($seconds1) ? $seconds1 : 0;

                                $totalHours += isset($hours2) ? $hours2 : 0;
                                $totalMinutes += isset($minutes2) ? $minutes2 : 0;
                                $totalSeconds += isset($seconds2) ? $seconds2 : 0;

                                // Mengonversi detik ke menit jika lebih dari 60
                                $totalMinutes += floor($totalSeconds / 60);
                                $totalSeconds %= 60;

                                // Mengonversi menit ke jam jika lebih dari 60
                                $totalHours += floor($totalMinutes / 60);
                                $totalMinutes %= 60;


                                if ($totalHours == 0 && $totalMinutes == 0 && $totalSeconds == 0) {
                                    echo "";
                                } else {
                                    echo "$totalHours jam, $totalMinutes menit, $totalSeconds detik";
                                }
                                ?>
                            </td> -->

                                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>


    </table>
    <br>
    <h4>Perhitungan Kredit Skor berdasarkan Peraturan Bupati Barito Timur No 14 Tahun 2023</h4><br>
    <table class="text-utama" border="1" cellpadding="3" width="100%">
        <thead class="">
            <tr class="text-center">
                <th width="40%" scope="col" style="background-color: #f2f2f2;">Flag</th>
                <th scope="col" style="text-align: center;" style="background-color: #f2f2f2;">Jumlah Flag</th>
                <th scope="col" style="text-align: center;" style="background-color: #f2f2f2;">Pengurangan</th>
                <th scope="col" style="text-align: center;" style="background-color: #f2f2f2;">Jumlah Flag X Pengurangan</th>
            </tr>
        </thead>
        <tbody>
        <tr>
                            <td>TL1</td>
                            <td><?php echo $TL1 ?></td>
                            <td><?php echo "0.5%" ?></td>
                            <td><?php echo $TL1 * 0.5; ?>%</td>
                            
                        </tr>
                        <tr>
                            <td>TL2</td>
                            <td><?php echo $TL2 ?></td>
                            <td><?php echo "1%" ?></td>
                            <td><?php echo $TL2 * 1; ?>%</td>
                            
                        </tr>
                        <tr>
                            <td>TL3</td>
                            <td><?php echo $TL3 ?></td>
                            <td><?php echo "1.25%" ?></td>
                            <td><?php echo $TL3 * 1.25; ?>%</td>
                            
                        </tr>
                        <tr>
                            <td>TL4</td>
                            <td><?php echo $TL4 ?></td>
                            <td><?php echo "1.5%" ?></td>
                            <td><?php echo $TL4 * 1.5; ?>%</td>
                            
                        </tr>
                        <tr>
                            <td>PSW1</td>
                            <td><?php echo $PSW1 ?></td>
                            <td><?php echo "0.5%" ?></td>
                            <td><?php echo $PSW1 * 0.5; ?>%</td>
                           
                        </tr>
                        <tr>
                            <td>PSW2</td>
                            <td><?php echo $PSW2 ?></td>
                            <td><?php echo "1%" ?></td>
                            <td><?php echo $PSW2 * 1; ?>%</td>
                            
                        </tr>
                        <tr>
                            <td>PSW3</td>
                            <td><?php echo $PSW3 ?></td>
                            <td><?php echo "1.25%" ?></td>
                            <td><?php echo $PSW3 * 1.25; ?>%</td>
                           
                        </tr>
                        <tr>
                            <td>PSW4</td>
                            <td><?php echo $PSW4 ?></td>
                            <td><?php echo "1.55%" ?></td>
                            <td><?php echo $PSW4 * 1.55; ?>%</td>
                           
                        </tr>

                        <tr>
                            <td>Izin pada Jam Masuk</td>
                            <td><?php echo $IZIN_IN ?></td>
                            <td><?php echo "0,5%" ?></td>
                            <td><?php echo $IZIN_IN * 0.5; ?>%</td>
                            
                        </tr>
                        <tr>
                            <td>Izin pada Jam Pulang</td>
                            <td><?php echo $IZIN_OUT ?></td>
                            <td><?php echo "0,5%" ?></td>
                            <td><?php echo $IZIN_OUT * 0.5; ?>%</td>
                           
                        </tr>
                        <tr>
                            <td>THKC 1</td>
                            <td><?= $countCutiBesar->jumlah_baris ?></td>
                            <td><?php echo "1%" ?></td>
                            <td><?= $countCutiBesar->total_subtraction ?? 0 ?>%</td>
                            
                        </tr>
                        <tr>
                            <td>THKC 2</td>
                            <td><?= $countCutiSakit->jumlah_baris ?></td>
                            <td><?php echo "2%" ?></td>
                            <td><?= $countCutiSakit->total_subtraction ?? 0 ?>%</td>
                           
                        </tr>
                        <tr>
                            <td>THKC 3</td>
                            <td><?= $countCutiTahunan->jumlah_baris ?></td>
                            <td><?php echo "3%" ?></td>
                            <td><?php echo $countCutiTahunan->total_subtraction ?? 0?>%</td>
                           
                        </tr>
                        <tr>
                            <td>TK</td>
                            <td><?php echo $TK ?></td>
                            <td><?php echo "3%" ?></td>
                            <td><?php echo $TK * 3; ?>%</td>
                           
                        </tr>
                        <tr>
                            <td>Tidak Upacara</td>
                            <td><?php echo $keg; ?></td>
                            <td><?php echo "3%" ?></td>
                            <td><?php echo $keg * 3 ?>%</td>
                           
                        </tr>
                        <tr>
                            <td>LHKPN/ LHKASN </td>
                            <td><?php if ($user->lhkpn_lhasn == "true") {
                                    echo "Sudah";
                                } else {

                                    echo "Belum";
                                }  ?></td>
                            <!-- <td><?php echo $user->lhkpn_lhasn; ?></td> -->
                            <td><?php echo "5%" ?></td>
                            <td><?php if ($user->lhkpn_lhasn == "true") {

                                    echo "0%";
                                } else {
                                    $LHKPN = 5;
                                    echo "5%";
                                }  ?></td>
                            

                        </tr>
                        <tr>
                            <td>TPTGR </td>
                            <td><?php if ($user->tptgr == "true") {
                                    echo "Sudah";
                                } else {
                                    echo "Belum";
                                }  ?></td>
                            <td><?php echo "5%" ?></td>
                            <td><?php if ($user->tptgr == "true") {
                                    echo "0%";
                                } else {
                                    $TPTGR = 5;
                                    echo "5%";
                                }  ?></td>
                            

                        </tr>
                        <?php
                        // Menghitung jumlah total potongan untuk setiap kategori
                        $total_potongan = ($TL1 * 0.5) +
                            ($TL2 * 1) +
                            ($TL3 * 1.25) +
                            ($TL4 * 1.5) +
                            ($PSW1 * 0.5) +
                            ($PSW2 * 1) +
                            ($PSW3 * 1.25) +
                            ($PSW4 * 1.55) +
                            ($IZIN_IN * 0.5) +
                            ($IZIN_OUT * 0.5) +
                            ($PSW4 * 1.55) +
                            ($countCutiBesar->total_subtraction ?? 0) +
                            ($countCutiSakit->total_subtraction ?? 0 ) +
                            ($countCutiTahunan->total_subtraction ?? 0) +
                            ($TK * 3) +
                            ($keg * 3) +
                            $LHKPN +
                            $TPTGR;

                        // Menghitung jumlah total dari semua kategori


                        // Menghitung jumlah total persen

                        ?>
                        <tr>
                            <td colspan="3">Total Pengurangan</td>
                            <td><?= $total_potongan ?>%</td>
                           
                        </tr>
                        <tr>
                            <td colspan="3">Total Skor DK (Disiplin Kerja) <br>(100% - Total Pengurangan %) </td>
                            <td><?= 100 - $total_potongan ?>%</td>
                            
                        </tr>
        </tbody>
    </table>



   
</body>

</html>