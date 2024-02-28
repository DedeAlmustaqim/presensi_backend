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
    <h4 class="text-center">Bulan <?= $bulan ?> Tahun <?= $tahun ?></h4>
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

    <table width="100%" border="1" cellpadding="2" cellspacing="0">


        <tr class="text-center" style="background-color: #f2f2f2;">
            <th scope="col" width="10%">Hari</th>
            <th scope="col" width="10%">Tanggal</th>
            <th scope="col" width="10%">Masuk<br> 08:00</th>
            <th scope="col" width="10%">Pulang<br>16:00</th>
            <th scope="col">Flag TL</th>
            <th scope="col">Flag PSW</th>
            <th scope="col">Flag TK</th>
            <th scope="col">Jam Kerja</th>

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
        foreach ($data as $date => $absenData) :
            if ($date > $today) {
                continue;
            }
        ?>
            <?php foreach ($absenData as $absen) : ?>
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
                    <td class="text-center">
                        <?= $date ?>
                    </td>
                    <td class="text-center">
                        <?= $absen['jam_in'] != null ? $absen['jam_in'] : "<span class='text-danger'>Belum Absen</span>"; ?>
                    </td>
                    <td class="text-center">
                        <?= $absen['jam_out'] != null ? $absen['jam_out'] : "<span class='text-danger'>Belum Absen</span>"; ?>
                    </td>
                    <td class="text-center">
                        <?php
                        // Cek apakah jam masuk tidak ada (null)
                        if ($absen['jam_in'] === null) {
                            echo '-'; // Pengguna belum absen
                        } else {
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
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <?php
                        // Cek apakah jam pulang tidak ada (null)
                        if ($absen['jam_out'] === null) {
                            echo '-'; // Pengguna belum pulang
                        } else {
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
                        }
                        ?>
                    </td>
                    <td class="text-center"><?php if (($absen['jam_in'] == null  && ($absen['jam_out'] == null))) {
                                                $TK++;
                                                echo '<span class="text-danger">TK</span>';
                                            } ?></td>


                    <td class="text-center">
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
                    </td>

                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>


    </table>
    <br>
    <table class="text-utama" border="1" cellpadding="3" width="100%" >
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
                <td style="text-align: right;"><?php echo $TL1 ?></td>
                <td style="text-align: right;"><?php echo "0.5%" ?></td>
                <td style="text-align: right;"><?php echo $TL1 * 0.5; ?>%</td>
            </tr>
            <tr>
                <td>TL2</td>
                <td style="text-align: right;"><?php echo $TL2 ?></td>
                <td style="text-align: right;"><?php echo "1%" ?></td>
                <td style="text-align: right;"><?php echo $TL2 * 1; ?>%</td>
            </tr>
            <tr>
                <td>TL3</td>
                <td style="text-align: right;"><?php echo $TL3 ?></td>
                <td style="text-align: right;"><?php echo "1.25%" ?></td>
                <td style="text-align: right;"><?php echo $TL3 * 1.25; ?>%</td>
            </tr>
            <tr>
                <td>TL4</td>
                <td style="text-align: right;"><?php echo $TL4 ?></td>
                <td style="text-align: right;"><?php echo "1.5%" ?></td>
                <td style="text-align: right;"><?php echo $TL4 * 1.5; ?>%</td>
            </tr>
            <tr>
                <td>PSW1</td>
                <td style="text-align: right;"><?php echo $PSW1 ?></td>
                <td style="text-align: right;"><?php echo "0.5%" ?></td>
                <td style="text-align: right;"><?php echo $PSW1 * 0.5; ?>%</td>
            </tr>
            <tr>
                <td>PSW2</td>
                <td style="text-align: right;"><?php echo $PSW2 ?></td>
                <td style="text-align: right;"><?php echo "1%" ?></td>
                <td style="text-align: right;"><?php echo $PSW2 * 1; ?>%</td>
            </tr>
            <tr>
                <td>PSW3</td>
                <td style="text-align: right;"><?php echo $PSW3 ?></td>
                <td style="text-align: right;"><?php echo "1.25%" ?></td>
                <td style="text-align: right;"><?php echo $PSW3 * 1.25; ?>%</td>
            </tr>
            <tr>
                <td>PSW4</td>
                <td style="text-align: right;"><?php echo $PSW4 ?></td>
                <td style="text-align: right;"><?php echo "1.55%" ?></td>
                <td style="text-align: right;"><?php echo $PSW4 * 1.55; ?>%</td>
            </tr>
            <tr>
                <td>TK</td>
                <td style="text-align: right;"><?php echo $TK ?></td>
                <td style="text-align: right;"><?php echo "3%" ?></td>
                <td style="text-align: right;"><?php echo $TK * 3; ?>%</td>
            </tr>
            <!-- <tr>
                <td>THKC 1</td>
                <td>onprogress</td>
                <td><?php echo "?%" ?></td>
                <td>onprogress </td>
            </tr>
            <tr>
                <td>THKC 2</td>
                <td>onprogress</td>
                <td><?php echo "?%" ?></td>
                <td>onprogress </td>
            </tr>
            <tr>
                <td>THKC 3</td>
                <td>onprogress</td>
                <td><?php echo "?%" ?></td>
                <td>onprogress </td>
            </tr>
            <tr>
                <td>Tidak Upacara</td>
                <td>onprogress</td>
                <td><?php echo "?%" ?></td>
                <td>onprogress </td>
            </tr>
            <tr>
                <td>LHKPN/ LHKASN </td>
                <td>onprogress</td>
                <td><?php echo "?%" ?></td>
                <td>onprogress </td>
            </tr>
            <tr>
                <td>TPTGR </td>
                <td>onprogress</td>
                <td><?php echo "?%" ?></td>
                <td>onprogress </td>
            </tr> -->
            <?php
            // Menghitung jumlah total potongan untuk setiap kategori
            $total_potongan = ($TL1 * 0.5) + ($TL2 * 1) + ($TL3 * 1.25) + ($TL4 * 3) + ($PSW1 * 0.5) + ($PSW2 * 1) + ($PSW3 * 1.25) + ($PSW4 * 3) + ($TK * 6);

            // Menghitung jumlah total dari semua kategori


            // Menghitung jumlah total persen

            ?>
            <tr style="background-color: #f2f2f2;">
                <td colspan="3">Total Pengurangan</td>
                <td style="text-align: right;"><?= $total_potongan ?>%</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <td colspan="3">Total Skor DK (Disiplin Kerja) <br>(100% - Total Pengurangan %) </td>
                <td style="text-align: right;"><?= 100 - $total_potongan ?>%</td>
            </tr>
        </tbody>
    </table>



    <footer>
        <table width="100%">
            <tr>
                <td width="85%">
                    <i><u>
                            <font size="10px">Printed by SIAMEL <?php echo date("d-m-Y") ?> <?php echo date("H:i:s") ?> WIB</font>
                        </u></i>
                </td>
                <td>
                    <i><u>
                            <font size="10px"><?php echo base_url() ?></font>
                        </u></i>
                </td>
            </tr>
    </footer>
</body>

</html>