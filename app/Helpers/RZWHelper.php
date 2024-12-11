<?php

namespace App\Helpers;

class RZWHelper
{
    public static function formatTanggalIndonesia($date)
    {
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $tgl = date('d', strtotime($date));
        $bln = $bulan[date('n', strtotime($date))];
        $thn = date('Y', strtotime($date));
        $jam = date('H:i:s', strtotime($date));

        return "$tgl $bln $thn | $jam";
    }

    public static function FilterName($array, $name)
    {
        $tdsData = collect($array)
                ->filter(function ($value, $key) use ($name) {
                    return str_starts_with($key, $name);
                })
                ->toArray();

        return $tdsData;
    }
}