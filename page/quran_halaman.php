<?php
require_once 'fungsi.php';

// Path ke file JSON
$file_path = __DIR__ . '/quran-json/surah/' . $selectedSurah . '.json';

// Baca isi file JSON
$json_data = file_get_contents($file_path);

// Decode JSON menjadi array
$data_surat = json_decode($json_data, true);

// Cek apakah decoding berhasil
if ($data_surat === null) {
    die ("Error decoding JSON");
}

$data_surat_info = $data_surat[$selectedSurah];
$data_surat_info_latin = $data_surat_info['translations'];
$data_ayat = $data_surat_info;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">


    <style>
           body{
  background-color: rgba(0, 144, 0, 1);
  background-image: url("../bg4.png");
  }

  .katibeh-regular {
  font-family: "Katibeh", serif;
  font-weight: 400;
  font-style: normal;
}


    </style>
   
</head>

<body>
<?php require('navbar2.php') ?>

    <div class="mt-15 px-5 md:px-28 lg:px-48" >
        <ul class="text-center text-white katibeh-regular">
            <li>
                <h1 class=" text-6xl md:text-6xl lg:text-8xl mb-4">
                    <?= $data_surat_info['name'] ?>
                </h1>
            </li>
            <li class="mt-4 mb-2">
                <p class="text-2xl md:text-4xl lg:text-6xl ">
                    <?= $data_surat_info['name_latin'] ?>
                </p>
            </li>
            <li class="text-2xl md:text-4xl lg:text-6xl mb-2">
                <?= $data_surat_info_latin['id']['name'] ?>
            </li>
        </ul>

         <?php $no_ayat = 1; ?>
         <?php foreach ($data_ayat['text'] as $key => $arabic_text): ?>
            
            
            <div class=" mb-10 flex flex-col gap-2 relative flex flex-col mt-6  shadow-md bg-clip-border bg-emerald-100 rounded-xl  ">
            <p class="mb-0 mt-2 mx-2 text-xl ">
                <?= $no_ayat ?>
            </p>
                <p class="text-end text-2xl md:text-4xl lg:text-8xl mx-8 katibeh-regular">
                            <?= $arabic_text ?>
                        </p>
                        
                        <p class="m-5 text-base md:text-4xl lg:text-4x ">
                            <?= $data_ayat['translations']['id']['text'][$key] ?>
                        </p>
                       
                    </div>
                    
                    <?php $no_ayat++; ?>
                    <?php endforeach; ?>

   
                    
    </body>

</html>