<!DOCTYPE html>
<html>

<head>
    <title><?= $nama.'_'.$bulan.'_'.$tahun ?></title>
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
    <h4 class="text-center">Bulan <?= $bulan?> Tahun  <?= $tahun ?></h4>
    <br>
    <table width="100%" border="0">
        <tr>
            <td width="10%">Nama</td>
            <td width="2%">:</td>
            <td  class="text_left"><?= $nama ?></td>
        </tr>
        <tr>
            <td >NIP</td>
            <td>:</td>
            <td><?= $nip ?></td>
        </tr>
        <tr>
            <td >Jabatan</td>
            <td>:</td>
            <td><?= $jabatan ?></td>
        </tr>
    </table>
    <br>

    <table width="100%" border="1" cellpadding="2" cellspacing="0">


        <tr class="text-center">
            <th scope="col" width="10%">Hari</th>
            <th scope="col" width="10%">Tanggal</th>
            <th scope="col" width="10%">Masuk<br> 08:00</th>
            <th scope="col" width="10%">Pulang<br>16:00</th>
            <th scope="col">Flag TL</th>
            <th scope="col">Flag PSW</th>
            <th scope="col">Flag TK</th>

        </tr>

        <?php
        $today = date('Y-m-d'); // Tanggal hari ini
        foreach ($data as $date => $absenData) :
            if ($date > $today) {
                continue;
            }
        ?>
            <?php foreach ($absenData as $absen) : ?>
                <tr class="text_utama">
                    <td class="text-left">
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
                    <td class="text_utama text-center">
                        <?= $date ?>
                    </td>
                    <td class="text_utama text-center"><?= $absen['jam_in'] ?></td>
                    <td class="text_utama text-center"> <?= $absen['jam_out'] ?></td>
                    <td class="text-center">
                        <?php
                        // Cek apakah jam masuk tidak ada (null)
                        if ($absen['jam_in'] === null) {
                            echo 'Belum Absen'; // Pengguna belum absen
                        } else {
                            // Hitung selisih waktu dari jam masuk dengan jam 08:00
                            $jamMasuk = strtotime($absen['jam_in']);
                            $jamTepat = strtotime('08:00');
                            $selisih = $jamMasuk - $jamTepat;

                            // Hitung dalam menit
                            $selisihMenit = round($selisih / 60);

                            // Tentukan status keterlambatan
                            if ($selisihMenit >= 1 && $selisihMenit <= 29) {
                                echo 'TL1 <span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                            } elseif ($selisihMenit >= 30 && $selisihMenit <= 59) {
                                echo 'TL2 <span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                            } elseif ($selisihMenit >= 60 && $selisihMenit <= 89) {
                                echo 'TL3 <span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                            } elseif ($selisihMenit > 89) {
                                echo 'TL4 <span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
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
                            echo 'Belum Absen'; // Pengguna belum pulang
                        } else {
                            // Hitung selisih waktu dari jam pulang dengan jam 16:00
                            $jamPulang = strtotime($absen['jam_out']);
                            $jamTepatPulang = strtotime('16:00');
                            $selisihPulang = $jamTepatPulang - $jamPulang;

                            // Hitung dalam menit
                            $selisihMenitPulang = round($selisihPulang / 60);

                            // Tentukan status pulang lebih cepat
                            if ($selisihMenitPulang >= 1 && $selisihMenitPulang <= 29) {
                                echo 'PSW1 <span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                            } elseif ($selisihMenitPulang >= 30 && $selisihMenitPulang <= 59) {
                                echo 'PSW2 <span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                            } elseif ($selisihMenitPulang >= 60 && $selisihMenitPulang <= 89) {
                                echo 'PSW3  <span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                            } elseif ($selisihMenitPulang > 89) {
                                echo 'PSW4 <span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                            } else {
                                // Tidak pulang lebih cepat
                                echo '-';
                            }
                        }
                        ?>
                    </td>
                    <td class="text-center"><?php if (($absen['jam_in'] == null  && ($absen['jam_out'] == null))) {
                                                echo 'TK';
                                            } else {
                                                echo '-';
                                            } ?></td>

                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>


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