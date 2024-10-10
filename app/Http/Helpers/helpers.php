<?php

function format_uang($angka)
{
    return "Rp. " . number_format($angka, 0, ',', '.');
}


function terbilang($angka)
{
    $angka = abs($angka);
    $baca = [
        '',
        'Satu',
        'Dua',
        'Tiga',
        'Empat',
        'Lima',
        'Enam',
        'Tujuh',
        'Delapan',
        'Sembilan',
        'Sepuluh',
        'Sebelas',
        'Dua Belas',
        'Tiga Belas',
        'Empat Belas',
        'Lima Belas',
        'Enam Belas',
        'Tujuh Belas',
        'Delapan Belas',
        'Sembilan Belas'
    ];

    $puluhan = ['', '', 'Dua Puluh', 'Tiga Puluh', 'Empat Puluh', 'Lima Puluh', 'Enam Puluh', 'Tujuh Puluh', 'Delapan Puluh', 'Sembilan Puluh'];

    if ($angka < 20) {
        $terbilang = ' ' . $baca[$angka];
    } elseif ($angka < 100) {
        $terbilang = ' ' . $puluhan[(int) ($angka / 10)];
        if ($angka % 10 !== 0) {
            $terbilang .= ' ' . $baca[$angka % 10];
        }
    } elseif ($angka < 1000) {
        $terbilang = ' ' . $baca[(int) ($angka / 100)] . ' Ratus';
        if ($angka % 100 !== 0) {
            $terbilang .= ' ' . terbilang($angka % 100);
        }
    } elseif ($angka < 1000000) {
        $terbilang = terbilang((int) ($angka / 1000)) . ' Ribu';
        if ($angka % 1000 !== 0) {
            $terbilang .= ' ' . terbilang($angka % 1000);
        }
    } elseif ($angka < 1000000000) {
        $terbilang = terbilang((int) ($angka / 1000000)) . ' Juta';
        if ($angka % 1000000 !== 0) {
            $terbilang .= ' ' . terbilang($angka % 1000000);
        }
    } elseif ($angka < 1000000000000) {
        $terbilang = terbilang((int) ($angka / 1000000000)) . ' Miliar';
        if ($angka % 1000000000 !== 0) {
            $terbilang .= ' ' . terbilang($angka % 1000000000);
        }
    } else {
        $terbilang = 'Angka terlalu besar untuk dikonversi.';
    }

    return $terbilang;
}


function tanggal_indonesia($tgl, $tampil_hari = true)
{
    $nama_hari = array(
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );
    $nama_bulan = array(
        1 =>
            'Januari',
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
    );

    $tahun = substr($tgl, 0, 4);
    $bulan = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $text = '';

    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari = $nama_hari[$urutan_hari];
        $text .= "$hari, $tanggal $bulan $tahun";
    } else {
        $text .= "$tanggal $bulan $tahun";
    }

    return $text;
}

function tambah_nol_didepan($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}
