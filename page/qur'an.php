<?php include_once('fungsi.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al-QUR'AN ONLINE</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
</head>

<body>
<?php require('navbar.php'); ?>


    <div class="container">
      <br>
      <br>
        <h1 class="text-center mt-5">Al-QUR'AN ONLINE</h1><br>
        <form action="quran_halaman.php" method="GET">
          <div class="form-group">
              <label class="mr-2" for="selectedSurah">Pilih Surah</label>
              <select name="selectedSurah" class="form-select custom-select" id="basic-usage" data-placeholder="Choose one thing" onchange="this.form.submit()">
                  <option value=""> silahkan pilih surat</option>
              <?php foreach ($dataquran['data'] as $surah) : ?>
                      <option value="<?= $surah["number"]; ?>" <?php if ($selectedKotaId == $surah["number"]) echo "selected"; ?>>
                          <?= $surah["name_id"]; ?> (<?= $surah["name_short"]; ?>)
                      </option>
                  <?php endforeach; ?>
              </select>
          </div>
        </form>
        <br>

        <?php
        $surahs = $dataquran['data'];
        $totalSurahs = count($surahs);
        $surahsPerRow = 3;

        for ($i = 0; $i < $totalSurahs; $i += $surahsPerRow) :
        ?>
            <div class="row">
                <?php
                for ($j = $i; $j < $i + $surahsPerRow && $j < $totalSurahs; $j++) :
                    $surah = $surahs[$j];
                ?>
                    <div class="col-md-4">
                        <div class="card mb-3 border border-dark rounded-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= $surah["name_id"]; ?> (<?= $surah["name_short"]; ?>)</h5>
                                <p class="card-text"><?= $surah["translation_id"]; ?></p>
                                <p class="card-text">Audio URL: <?= $surah["audio_url"]; ?></p>
                                <p class="card-text">Number of Verses: <?= $surah["number_of_verses"]; ?></p>
                                <p class="card-text">Revelation: <?= $surah["revelation_id"]; ?></p>
                                <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>


    <script>
        $('#basic-usage').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>
