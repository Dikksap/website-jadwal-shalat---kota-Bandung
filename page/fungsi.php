<?php

$selectedKotaId = $_GET['selectedKota'] ?? null;

// Cek apakah formulir dikirimkan (melalui metode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nilai ID kota yang dipilih dari formulir
    $selectedKotaId = $_POST['selectedKota']; 
}   


// Mendapatkan nilai tahun dari parameter URL atau menggunakan nilai default
$selectedYear = isset($_GET['tahun']) ? $_GET['tahun'] : 2024;

// Mendapatkan nilai bulan dari parameter URL atau menggunakan nilai default
$selectedMonth = isset($_GET['bulan']) ? $_GET['bulan'] : 1;

// Memastikan nilai bulan dan tahun antara rentang yang diinginkan
$selectedMonth = max(1, min(12, $selectedMonth));
$selectedYear = max(2023, min(date('Y'), $selectedYear));

// Mengonversi bulan menjadi format dengan dua digit (01, 02, ..., 09)
$selectedMonthFormatted = sprintf('%02d', $selectedMonth);


$url = 'https://api.myquran.com/v2/sholat/kota/semua';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$json_data = curl_exec($ch);
curl_close($ch);

// Mengonversi JSON ke array
$dataKota = json_decode($json_data, true);


$url = 'https://api.myquran.com/v2/sholat/jadwal/'.$selectedKotaId.'/'.$selectedYear.'/'.$selectedMonthFormatted;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$json_data = curl_exec($ch);
curl_close($ch);

// Mengonversi JSON ke array
$datajadwal = json_decode($json_data, true);



$url = 'https://api.myquran.com/v2/quran/surat/semua';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$json_data = curl_exec($ch);
curl_close($ch);

// Mengonversi JSON ke array
$dataquran = json_decode($json_data, true);
// Periksa apakah parameter selectedSurah ada dalam URL GET
if(isset($_GET['selectedSurah'])) {
    // Ambil nilai dari parameter selectedSurah
    $selectedSurah = $_GET['selectedSurah'];

    // Ubah nilai variabel $ayat sesuai dengan nilai dari parameter selectedSurah
    $ayat = intval($selectedSurah); // Konversi nilai ke integer jika diperlukan
}




?>