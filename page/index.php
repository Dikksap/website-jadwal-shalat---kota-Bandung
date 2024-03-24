<?php include_once('fungsi.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JADWAL SHOLAT</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <style>
        @media (max-width: 575.98px) {
            .jadwal {
                max-width: 250px;
            }

            .head h1 {
                font-size: 27px;
            }

            .text-small tbody,
            thead {
                font-size: 8px;
            }

            .tanggal {
                font-size: 8px;
            }
        }

        @font-face {
            font-family: arab;
            src: url(../hidyatullah.ttf);
        }

        body {
            padding-top: 70px;
        }

        .head {
            font-family: arab;
            color: #20913e;
            font-size: 50px;
            font-weight: bold;
            margin-top: 10px;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <?php
require('navbar.php');
?>
  

    <div style="background-image: url('../bg.jpg');">

        <div class="container mt-0" style=" background-color: rgba(255, 255, 255, 0.75);">
            <div id="home" class="head">
                <h1 class="text-center mb-4 mt-5">Waktu Shalat</h1>
            </div>




<div class="container" style="">
    <form class="">
        
<div class="container">
  <div class="row">
    <div class="col-sm">
    <div class="form-group">
            <label class="mr-2" for="tahun">Pilih Tahun:</label>
            <select class="form-control custom-select" id="tahun" name="tahun" onchange="this.form.submit()">
                <?php
                // Menampilkan opsi tahun dari 2023 sampai tahun sekarang
                for ($i = 2019; $i <= date('Y'); $i++) {
                    $selected = ($i == $selectedYear) ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-sm">
    <div class="form-group ">
            <label class="mr-2" for="bulan">Pilih Bulan:</label>
            <select class="form-control custom-select" id="bulan" name="bulan" onchange="this.form.submit()">
                <?php
                // Menampilkan opsi bulan dari 1 sampai 12
                for ($i = 1; $i <= 12; $i++) {
                    $formattedMonth = sprintf('%02d', $i);
                    $selected = ($i == $selectedMonth) ? 'selected' : '';
                    echo "<option value=\"$formattedMonth\" $selected>$formattedMonth</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-sm">
    <div class="form-group">
            <label class="mr-2" for="selectedKota">Pilih Kota:</label>
            <select name="selectedKota" class="form-select custom-select" id="basic-usage" data-placeholder="Choose one thing" onchange="this.form.submit()">
                <?php foreach ($dataKota['data'] as $kota) : ?>
                    <option value="<?= $kota["id"]; ?>" <?php if ($selectedKotaId == $kota["id"]) echo "selected"; ?>>
                        <?= $kota["lokasi"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
  </div>
</div>

    </form>
</div>


            <!-- Tabel untuk menampilkan jadwal sholat -->
            <div id="table-container" class="table-responsive" style="overflow: auto; max-height: 300px;">
                <table class="table table-striped table-bordered">
                    <thead class="bg-success text-white" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="text-center">TANGGAL</th>
                            <th class="text-center">SHUBUH</th>
                            <th class="text-center">IMSYAK</th>
                            <th class="text-center">DZHUHUR</th>
                            <th class="text-center">ASHAR</th>
                            <th class="text-center">MAGRIB</th>
                            <th class="text-center">ISYA</th>
                        </tr>
                    </thead>
                    <tbody class="tanggal">
                        <?php if (empty($datajadwal['data']['jadwal'])) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Data belum ada</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($datajadwal['data']['jadwal'] as $jadwal) : ?>
                                <tr>
                                    <td class="text-center"><?= $jadwal["tanggal"]; ?></td>
                                    <td class="text-center"><?= $jadwal["subuh"]; ?></td>
                                    <td class="text-center"><?= $jadwal["imsak"]; ?></td>
                                    <td class="text-center"><?= $jadwal["dzuhur"]; ?></td>
                                    <td class="text-center"><?= $jadwal["ashar"]; ?></td>
                                    <td class="text-center"><?= $jadwal["maghrib"]; ?></td>
                                    <td class="text-center"><?= $jadwal["isya"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center"><button type="button" class="btn btn-success" id="button"> Tampilkan semua data</button></div>

            <br>

            <?php require('artikel.php'); ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            // Flag to track whether max-height is enabled or disabled
            var isMaxHeightEnabled = true;

            // Function to toggle max-height property
            function toggleMaxHeight() {
                if (isMaxHeightEnabled) {
                    // Disable max-height property
                    $("#table-container").css("max-height", "none");
                } else {
                    // Enable max-height property with a specific value (e.g., 300px)
                    $("#table-container").css("max-height", "300px");
                }
                // Toggle the flag
                isMaxHeightEnabled = !isMaxHeightEnabled;
            }

            // Add an event listener to the button
            $("#button").click(function () {
                // Call the toggle function when the button is clicked
                toggleMaxHeight();
            });
        });
    </script>

    <script>
        $('#basic-usage').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>

</body>

</html>
