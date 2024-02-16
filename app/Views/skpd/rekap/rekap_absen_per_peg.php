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
                    <th scope="col">Jam Kerja Masuk<br>(12:00 - Jam Masuk)</th>
                    <th scope="col">Jam Kerja Pulang<br>(Jam Pulang - 13:00)</th>
                    <th scope="col">Total Jam Kerja<br>(Jam Kerja Masuk + Jam Kerja Pulang)</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $date => $absenData) : ?>
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
                            <td><?php
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

                                    // Output perbedaan waktu dalam jam, menit, dan detik
                                    if ($hours1 == 0 && $minutes1 == 0 && $seconds1 == 0) {
                                        echo "";
                                    } else {
                                        echo "$hours1 jam, $minutes1 menit, $seconds1 detik";
                                    }
                                } else {
                                    echo "";
                                }
                                ?>

                            </td>
                            <td>

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

                                    // Output perbedaan waktu dalam jam, menit, dan detik
                                    if ($hours2 == 0 && $minutes2 == 0 && $seconds2 == 0) {
                                        echo "";
                                    } else {
                                        echo "$hours2 jam, $minutes2 menit, $seconds2 detik";
                                    }
                                } else {
                                    echo "";
                                }

                                ?>
                            </td>
                            <td>
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
                <tr>
                    <td colspan="6">Total</td>
                    <td><?php
                        $totalHoursAll = 0;
                        $totalMinutesAll = 0;
                        $totalSecondsAll = 0;

                        foreach ($data as $date => $absenData) {
                            foreach ($absenData as $absen) {
                                // Kalkulasi jam kerja masuk
                                $time1 = '12:00:00';
                                $time2 = $absen['jam_in'] ?? '12:00:00';
                                $dateTime1 = DateTime::createFromFormat('H:i:s', $time1);
                                $dateTime2 = DateTime::createFromFormat('H:i:s', $time2);
                                $interval1 = $dateTime1->diff($dateTime2);
                                $totalSeconds1 = $interval1->h * 3600 + $interval1->i * 60 + $interval1->s;
                                $hours1 = floor($totalSeconds1 / 3600);
                                $minutes1 = floor(($totalSeconds1 % 3600) / 60);
                                $seconds1 = $totalSeconds1 % 60;

                                // Kalkulasi jam kerja pulang
                                $time1 = $absen['jam_out'] ?? '13:00:00';
                                $time2 = '13:00:00';
                                $dateTime1 = DateTime::createFromFormat('H:i:s', $time1);
                                $dateTime2 = DateTime::createFromFormat('H:i:s', $time2);
                                $interval2 = $dateTime1->diff($dateTime2);
                                $totalSeconds2 = $interval2->h * 3600 + $interval2->i * 60 + $interval2->s;
                                $hours2 = floor($totalSeconds2 / 3600);
                                $minutes2 = floor(($totalSeconds2 % 3600) / 60);
                                $seconds2 = $totalSeconds2 % 60;

                                // Kalkulasi total jam kerja
                                $totalHours = $hours1 + $hours2;
                                $totalMinutes = $minutes1 + $minutes2;
                                $totalSeconds = $seconds1 + $seconds2;

                                // Koreksi jika ada overflow
                                $totalMinutes += floor($totalSeconds / 60);
                                $totalSeconds %= 60;
                                $totalHours += floor($totalMinutes / 60);
                                $totalMinutes %= 60;

                                // Total seluruh jam kerja
                                $totalHoursAll += $totalHours;
                                $totalMinutesAll += $totalMinutes;
                                $totalSecondsAll += $totalSeconds;

                                // Koreksi jika ada overflow
                                $totalMinutesAll += floor($totalSecondsAll / 60);
                                $totalSecondsAll %= 60;
                                $totalHoursAll += floor($totalMinutesAll / 60);
                                $totalMinutesAll %= 60;
                            }
                        }

                       

                        if ($totalHoursAll == 0 && $totalMinutesAll == 0 && $totalSecondsAll == 0) {
                            echo "";
                        } else {
                            echo "$totalHoursAll jam, $totalMinutesAll menit, $totalSecondsAll detik";
                        }
                        ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?= $this->endSection() ?>