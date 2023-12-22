<?php
// Assuming your JSON files are organized in a directory structure like 'adzan/bandung/2023/12.json'

// Mendapatkan nilai tahun dari parameter URL atau menggunakan nilai default
$selectedYear = isset($_GET['tahun']) ? $_GET['tahun'] : 2023;

// Mendapatkan nilai bulan dari parameter URL atau menggunakan nilai default
$selectedMonth = isset($_GET['bulan']) ? $_GET['bulan'] : 12;

// Memastikan nilai bulan dan tahun antara rentang yang diinginkan
$selectedMonth = max(1, min(12, $selectedMonth));
$selectedYear = max(2023, min(date('Y'), $selectedYear));

// Mengonversi bulan menjadi format dengan dua digit (01, 02, ..., 09)
$selectedMonthFormatted = sprintf('%02d', $selectedMonth);

// Menyusun path ke file JSON
$jsonFilePath = 'adzan/bandung/' . $selectedYear . '/' . $selectedMonthFormatted . '.json';

// Membaca konten dari file JSON
$data = file_get_contents($jsonFilePath);

// Men-decode JSON menjadi array
$jadwalList = json_decode($data, true);

// Check if $jadwalList is an array
if (is_array($jadwalList)) {
    $selectedMonthData = $jadwalList;
} else {
    // Handle the case where $jadwalList is not an array (possibly a string)
    echo "Error: Invalid data format.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JADWAL SHOLAT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    @font-face {
        font-family: arab;
        src: url(hidyatullah.ttf);
    }

    body {
        padding-top: 70px;
    }
    h1 {
        font-family: arab;
        color: #20913e;
        font-size: 50px;
        font-weight: bold;
        margin-top: 80px;
        padding-top: 20px;
    }
</style>
</head>

<body>
            
<nav class="navbar navbar-expand-lg navbar-light p-3 fixed-top" style="background: linear-gradient(45deg, #20913e, #FFD700); box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
  <div class="container-fluid">
 <!-- Bagian Kiri (Teks dan Gambar Icon) -->
    <a href="#" class="navbar-brand text-white font-weight-bold">
      <img src="moon.png" class="rounded float-start" width="50px" alt="Moon Icon">
    </a>

    <!-- Bagian Tengah (Navigasi Home) -->
    <a class="navbar-brand mx-auto text-white font-weight-bold" style="font-size:30px;" href="#">Home</a>

    <!-- Bagian Kanan (Ikon Media Sosial) -->
    <div class="d-flex justify-content-end">
       
      <a href="https://www.instagram.com/dikksap?igsh=YzVkODRmOTdmMw==">
        <ul><img src="instagram.png" width="30px"></ul>
        <ul> @dikksap</ul>
        
        
      </a>
    </div>

  </div>
</nav> 
        <h1 class="text-center mb-4 mt-5">Jadwal  Shalat  Bandung</h1>

        <!-- Form untuk memilih tahun dan bulan -->
        <form class="form-inline mb-4 justify-content-center">
            <label class="mr-2" for="tahun">Pilih Tahun:</label>
            <select class="form-control mr-3" id="tahun" name="tahun" onchange="this.form.submit()">
                <?php
                // Menampilkan opsi tahun dari 2023 sampai tahun sekarang
                for ($i = 2019; $i <= date('Y'); $i++) {
                    $selected = ($i == $selectedYear) ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>

            <label class="mr-2" for="bulan">Pilih Bulan:</label>
            <select class="form-control" id="bulan" name="bulan" onchange="this.form.submit()">
                <?php
                // Menampilkan opsi bulan dari 1 sampai 12
                for ($i = 1; $i <= 12; $i++) {
                    $formattedMonth = sprintf('%02d', $i);
                    $selected = ($i == $selectedMonth) ? 'selected' : '';
                    echo "<option value=\"$formattedMonth\" $selected>$formattedMonth</option>";
                }
                ?>
            </select>
        </form>

        <!-- Tabel untuk menampilkan jadwal sholat -->
<div id="table-container" style="overflow: auto; max-height: 300px;" class="container">
    <table class="table table-striped table-bordered">
        <thead class="bg-success text-white" style="position: sticky; top: 0; z-index: 1;">
            <tr>
                <th class="text-center">TANGGAL</th>
                <th class="text-center">SHUBUH</th>
                <th class="text-center">DZHUHUR</th>
                <th class="text-center">ASHAR</th>
                <th class="text-center">MAGRIB</th>
                <th class="text-center">ISYA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($selectedMonthData as $jadwal) : ?>
                <tr>
                    <td class="text-center"><?= $jadwal["tanggal"]; ?></td>
                    <td class="text-center"><?= $jadwal["shubuh"]; ?></td>
                    <td class="text-center"><?= $jadwal["dzuhur"]; ?></td>
                    <td class="text-center"><?= $jadwal["ashr"]; ?></td>
                    <td class="text-center"><?= $jadwal["magrib"]; ?></td>
                    <td class="text-center"><?= $jadwal["isya"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
</div>

<div class="d-flex justify-content-center"><button type="button" class="btn btn-success" id="button"> Tampilkan semua data</button></div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function () {
        // Add an event listener to the button
        $("#button").click(function () {
            // Disable max-height property when the button is clicked
            $("#table-container").css("max-height", "none");
        });
    });
</script>
</body>

</html>
