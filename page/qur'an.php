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

    <style>
      body{
  background-color: rgba(1, 144, 0, 1);
  }
  @font-face {
            font-family: arab;
            src: url(../Basmala.ttf);
        }
      @import url('https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
 h1{
  font-family: arab;
  font-size: 70px;
  color:white;
  margin-top: 100px;
 }
.card {
  box-sizing: border-box;
  width: 300px;
  height: 190px;
  background: rgba(255, 215, 0, 1);
  border: 1px solid white;
  box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
  backdrop-filter: blur(6px);
  border-radius: 17px;
  text-align: center;
  cursor: pointer;
  transition: all 0.5s;
  display: flex;
  align-items: center;
  justify-content: center;
  user-select: none;
  font-weight: bolder;
  color: black;
  font-family: "Noto Naskh Arabic", serif;
   font-weight: 700;
  font-style: normal;
  font-size: 150%;
  margin: auto;
}
.card:hover {
  border: 1px solid yellow;
  transform: scale(1.05);
}

.card:active {
  transform: scale(0.95) rotateZ(1.7deg);
}

.Download-button {
  display: flex;
  align-items: center;
  font-family: inherit;
  font-weight: 300;
  font-size: 17px;
  padding: 15px 20px;
  color: white;
  background: rgba(1, 144, 0, 1);
  border: none;
  box-shadow: 0 0.7em 1.5em -0.5em rgba(59, 48, 78, 0.527);
  letter-spacing: 0.05em;
  border-radius: 8px;
  cursor: pointer;
  position:relative;
  margin-top: 25px;
}

.Download-button svg {

  margin-right: 8px;
  width: 15px;
}

.Download-button:hover {
  box-shadow: 0 0.5em 1.5em -0.5em rgba(88, 71, 116, 0.627);
}

.Download-button:active {
  box-shadow: 0 0.3em 1em -0.5em rgba(88, 71, 116, 0.627);
}

.Download-button::before {
  content: "";
  width: 4px;
  height: 40%;
  background-color: white;
  position: absolute;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  left: 0;
  transition: all 0.2s;
}

.Download-button::after {
  content: "";
  width: 4px;
  height: 40%;
  background-color: white;
  position: absolute;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  right: 0;
  transition: all 0.2s;
}

.Download-button:hover::before,
.Download-button:hover::after {
  height: 60%;
}
@media screen and (max-width: 500px) {
    .text-center {
        font-size: 50px;
    }
    #txt{
      font-size: 35px;
    }
  }

    </style>
</head>

<body>
<?php require('navbar.php'); ?>


    <div class="container">
      <br>
      <br>
        <h1 class="text-center">AL-Qur'an  Online</h1><br>
        <form action="quran_halaman.php" method="GET">
          <div class="form-group">
              <label class="text-center fs-1 text-white" for="selectedSurah">Pilih Surah:</label>
              <select name="selectedSurah" class="form-select custom-select" id="basic-usage" data-placeholder="Choose one thing" onchange="this.form.submit()">
                  <option class="arabic"> silahkan pilih surat</option>
              <?php foreach ($dataquran['data'] as $surah) : ?>
                      <option value="<?= $surah["number"]; ?>" <?php if ($selectedKotaId == $surah["number"]) echo "selected"; ?>>
                          <?= $surah["name_id"]; ?> (<?= $surah["name_short"]; ?>)
                      </option>
                  <?php endforeach; ?>
              </select>
          </div>
        </form>
        <br> 
        <div class="container">
  <div class="row justify-content-center">
    <div class="col-4">
      <div class="d-flex flex-row justify-content-center align-items-center">
        <span class="m-2 ">
          <img src="../arrow.png" alt="" width="70">
        </span>
        <h1 class="fs-2 mx-3 pb-5 text-center" id="txt">Download Murottal</h1>
        <span class="m-2 ">
          <img src="../arrow.png" alt="" width="70">
        </span>
      </div>
    </div>
  </div>
</div>



        <?php
        $surahs = $dataquran['data'];
        $totalSurahs = count($surahs);
        $surahsPerRow = 3;
        $no = 1;

        for ($i = 0; $i < $totalSurahs; $i += $surahsPerRow) :
        ?>
            <div class="row justify-content-center">
                <?php
                for ($j = $i; $j < $i + $surahsPerRow && $j < $totalSurahs; $j++) :
                    $surah = $surahs[$j];
                ?>
                    <div class="col-md-4 mb-4 ">
                        <div class="card">
                            <div class="card-body">
    <h5 class="card-title fs-3"><?=$no?>.<?= $surah["name_id"]; ?> (<?= $surah["name_short"]; ?>)</h5>
    <h6 class="card-subtitle mb-2 text-muted"><?= $surah["translation_id"]; ?>(<?= $surah["revelation_id"]; ?>)</h6>
    <!-- <p class="card-text"></p> -->
    <a href="<?= $surah["audio_url"]; ?>"  class="card-link"> <button class="Download-button">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    height="16"
    width="20"
    viewBox="0 0 640 512"
  >
    <path
      d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-167l80 80c9.4 9.4 24.6 9.4 33.9 0l80-80c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-39 39V184c0-13.3-10.7-24-24-24s-24 10.7-24 24V318.1l-39-39c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9z"
      fill="white"
    ></path>
  </svg>
  <span>DOWNLOAD MUROTAL</span>
</button></a>
   
    
   
  </div>
                        </div>
                    </div>
                    <?php $no++; // Tambahkan ini untuk menambah $no setiap kali loop dijalankan
        endfor;?>

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
