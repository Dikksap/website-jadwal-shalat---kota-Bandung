<?php include_once('fungsi.php'); ?>
<?php

$surat = $data_ayat['data']['name_id'];
$terjemah = $data_ayat['data']['translation_id'];
$relevansi = $data_ayat['data']['revelation_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyQuran API - Ayat Viewer</title>


  
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
 <style>
#surahContainer {
  position: relative; /* Pastikan elemen memiliki posisi relatif atau absolut */
  z-index: 0; /* Atur nilai z-index ke 0 */
}


 </style>

</head>
<body>

<div class="container">
    <h1 class=""> Surat <?= $surat ?> </h1>
    <p><?= $terjemah ?></p>
    <p><?= $relevansi ?></p>
  
  <div id="surahContainer"><hr></div>

  </div>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const surahContainer = document.getElementById("surahContainer");

      // Function to get URL parameters
      function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        const results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
      }

      // Get suratNumber from the URL parameter
      const suratNumber = getUrlParameter('selectedSurah') || 1;

      let ayatNumber = 1;

      function fetchAyat() {
        const apiUrl = `https://api.myquran.com/v2/quran/ayat/${suratNumber}/${ayatNumber}`;

        fetch(apiUrl)
          .then(response => {
            if (!response.ok) {
              throw new Error(`API Error: ${response.statusText}`);
            }
            return response.json();
          })
          .then(data => {
            const ayat = data.data[0];

            const ayatContainer = document.createElement("div");
            ayatContainer.innerHTML = `
              <p><strong>Surat:</strong> ${ayat.surah}</p>
              <p><strong>Ayat:</strong> ${ayat.ayah}</p>
              <p><strong>Arab:</strong> ${ayat.arab}</p>
              <p><strong>Latin:</strong> ${ayat.latin}</p>
              <p><strong>Terjemahan:</strong> ${ayat.text}</p>
              <audio controls>
                <source src="${ayat.audio}" type="audio/mp3">
                Your browser does not support the audio element.
              </audio>
              <hr>
            `;
            surahContainer.appendChild(ayatContainer);

            // Increment ayatNumber for the next fetch
            ayatNumber++;

            // Call fetchAyat recursively
            fetchAyat();
          })
          .catch(error => {
            console.error("Error fetching data:", error);
            // Handle the error or stop the recursion
          });
      }

      // Start fetching ayat
      fetchAyat();
    });
  </script>
</body>
</html>
