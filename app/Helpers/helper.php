<?php

use Carbon\Carbon;

if (!function_exists('formatTanggal')) {
    function formatTanggal($tanggal = null, $format = 'l, j F Y')
    {
        $parsedDate = Carbon::parse($tanggal)->locale('id')->settings(['formatFunction' => 'translatedFormat']);
        return $parsedDate->format($format);
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('statusMobil')) {
    function statusMobil($status)
    {
        $statusText = ($status == '0') ? 'Tidak ' : '';
        $statusIcon = '<i class="far ' . ($status == '0' ? 'fa-times-circle' : 'fa-check-circle') . ' mr-1"></i>';
        $statusClass = 'badge-' . ($status == '0' ? 'danger' : 'success');

        return "<span class='badge $statusClass small'>$statusIcon {$statusText}Tersedia</span>";
    }
}
if (!function_exists('hitungSelisihHari')) {
    function hitungSelisihHari($tanggalMulai, $tanggalSelesai)
    {
        $mulai = new \DateTime($tanggalMulai);
        $selesai = new \DateTime($tanggalSelesai);
        $selisih = $mulai->diff($selesai);

        return $selisih->days + 1;
    }
}
