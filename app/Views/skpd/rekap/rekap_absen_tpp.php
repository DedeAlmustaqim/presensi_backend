<?= $this->extend('layout/template_skpd') ?>

<?= $this->section('content_skpd') ?>

<!-- Memuat helper Time -->
<?= helper('time'); ?>

<!-- Mengatur lokal menjadi Bahasa Indonesia -->
<?php setlocale(LC_TIME, 'id_ID'); ?>



<div class="card card-bordered card-preview">
    <div class="card-inner">
        <a target="_blank" href="<?php echo base_url() ?>/skpd/rekap/view_absen_tpp_pdf/<?= $id ?>/<?= $bulan ?>/<?= $tahun ?>" class="btn btn-secondary mb-1">Cetak PDF</a>
        <hr>
        <table width="100%" border="0" class="mb-2">
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
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col" width="10%">Hari</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Masuk<br><?= $jam_masuk ?></th>
                    <th scope="col">Pulang<br><?= $jam_pulang ?></th>
                    <th scope="col">Flag TL</th>
                    <th scope="col">Flag PSW</th>
                    <th scope="col">Flag TK</th>
                    <th scope="col">Jam Kerja</th>

                </tr>
            </thead>
            <tbody>
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
                            <td>
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

            </tbody>
        </table>
        <hr>
        <table class="table table-bordered" width="50%">
            <thead class="table-dark">
                <tr class="text-center">

                    <th scope="col">Flag</th>
                    <th scope="col">Jumlah Flag</th>
                    <th scope="col">Pengurangan</th>
                    <th scope="col">Jumlah Flag x Pengurangan</th>



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
                    <td>TK</td>
                    <td><?php echo $TK ?></td>
                    <td><?php echo "3%" ?></td>
                    <td><?php echo $TK * 3; ?>%</td>
                </tr>
                <tr>
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
                </tr>
                <?php
                // Menghitung jumlah total potongan untuk setiap kategori
                $total_potongan = ($TL1 * 0.5) + ($TL2 * 1) + ($TL3 * 1.25) + ($TL4 * 3) + ($PSW1 * 0.5) + ($PSW2 * 1) + ($PSW3 * 1.25) + ($PSW4 * 3) + ($TK * 6);

                // Menghitung jumlah total dari semua kategori


                // Menghitung jumlah total persen

                ?>
                <tr>
                    <td colspan="3">Total Pengurangan</td>
                    <td><?= $total_potongan ?>%</td>
                </tr>
                <tr>
                    <td colspan="3">Total Skor DK (Disiplin Kerja) <br>(100% - Total Pengurangan %) </td>
                    <td><?= 100-$total_potongan ?>%</td>
                </tr>
            </tbody>
        </table>

        <!-- <?php
        $flags = array(
            "Flag" => array("Jumlah Flag", "Potongan (%)", "Total"),
            "TL1" => array($TL1, "0.5%", $TL1 * 0.5),
            "TL2" => array($TL2, "1%", $TL2 * 1),
            "TL3" => array($TL3, "1.25%", $TL3 * 1.25),
            "TL4" => array($TL4, "3%", $TL4 * 3),
            "PSW1" => array($PSW1, "0.5%", $PSW1 * 0.5),
            "PSW2" => array($PSW2, "1%", $PSW2 * 1),
            "PSW3" => array($PSW3, "1.25%", $PSW3 * 1.25),
            "PSW4" => array($PSW4, "3%", $PSW4 * 3),
            "TK" => array($TK, "3%", $TK * 3),
            "THKC 1" => array("?", "?%", "?"),
            "THKC 2" => array("?", "?%", "?"),
            "THKC 3" => array("?", "?%", "?"),
            "Tidak Upacara" => array("?", "?%", "?"),
            "LHKPN/LHKASN" => array("?", "?%", "?"),
            "TPTGR" => array("?", "?%", "?"),
        );

        echo "<table class='table table-bordered wrap' width='80%'>";
        echo "<thead class='table-dark '>";
        echo "<tr class='text-center'>";
        foreach ($flags as $flag => $data) {
            echo "<th scope='col'>$flag</th>";
        }
        echo "</tr></thead><tbody class='no-wrap'>";

        for ($i = 0; $i < 3; $i++) {
            echo "<tr>";
            foreach ($flags as $flag => $data) {
                echo "<td>{$data[$i]} </td>";
            }
            echo "</tr>";
        }

        echo "</tbody></table>";
        ?> -->

    </div>
</div>


<?= $this->endSection() ?>