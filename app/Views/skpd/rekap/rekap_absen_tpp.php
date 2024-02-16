<?= $this->extend('layout/template_skpd') ?>

<?= $this->section('content_skpd') ?>

<!-- Memuat helper Time -->
<?= helper('time'); ?>

<!-- Mengatur lokal menjadi Bahasa Indonesia -->
<?php setlocale(LC_TIME, 'id_ID'); ?>


<div class="card card-bordered card-preview">
    <div class="card-inner">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col" width="10%">Hari</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Masuk</th>
                    <th scope="col">Pulang</th>
                    <th scope="col">Flag TL</th>
                    <th scope="col">Flag PSW</th>
                    <th scope="col">Flag TK</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $today = date('Y-m-d'); // Tanggal hari ini
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
                            <td><?= $absen['jam_in'] ?></td>
                            <td><?= $absen['jam_out'] ?></td>
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
                                        echo 'TL1 <br><span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                                    } elseif ($selisihMenit >= 30 && $selisihMenit <= 59) {
                                        echo 'TL2 <br><span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                                    } elseif ($selisihMenit >= 60 && $selisihMenit <= 89) {
                                        echo 'TL3 <br><span class="text-danger">(terlambat ' . $selisihMenit . ' menit)</span>';
                                    } elseif ($selisihMenit > 89) {
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
                                        echo 'PSW1<br><span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                                    } elseif ($selisihMenitPulang >= 30 && $selisihMenitPulang <= 59) {
                                        echo 'PSW2<br><span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                                    } elseif ($selisihMenitPulang >= 60 && $selisihMenitPulang <= 89) {
                                        echo 'PSW3<br><span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                                    } elseif ($selisihMenitPulang > 89) {
                                        echo 'PSW4<br> <span class="text-danger"> (' . abs($selisihMenitPulang) . ' menit lebih cepat)</span>';
                                    } else {
                                        // Tidak pulang lebih cepat
                                        echo '-';
                                    }
                                }
                                ?>
                            </td>
                            <td class="text-center"><?php if (($absen['jam_in'] == null  && ($absen['jam_out'] == null))) {
                                                        echo 'TK';
                                                    } ?></td>

                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>


<?= $this->endSection() ?>