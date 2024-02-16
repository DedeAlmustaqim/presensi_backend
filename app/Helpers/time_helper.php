<?php

namespace App\Helpers;

use DateTime;

if (!function_exists('hitungTotalWaktu')) {
    function hitungTotalWaktu($time1, $time2)
    {
        $dateTime1 = DateTime::createFromFormat('H:i:s', $time1);
        $dateTime2 = DateTime::createFromFormat('H:i:s', $time2);

        // Memeriksa apakah konversi berhasil
        if ($dateTime1 !== false && $dateTime2 !== false) {
            // Menghitung perbedaan waktu
            $interval = $dateTime1->diff($dateTime2);

            // Menghitung total detik dari perbedaan waktu
            $totalSeconds = $interval->h * 3600 + $interval->i * 60 + $interval->s;

            // Menghitung jam, menit, dan detik dari total detik
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;

            // Output perbedaan waktu dalam jam, menit, dan detik
            return "$hours jam, $minutes menit, $seconds detik";
        } else {
            return "";
        }
    }
}
