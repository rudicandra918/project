<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Surat Al-Quran</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Daftar Surat Al-Quran</h1>
        <form class="mb-4">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="search">Cari Surat</label>
                    <input type="text" class="form-control mb-2" id="search" placeholder="Cari Surat">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary mb-2" onclick="searchSurah()">Cari</button>
                </div>
            </div>
        </form>
        <div class="row" id="surahList">
            <?php
            $url = 'https://api.myquran.com/v2/quran/surat/semua';
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            
            if ($data && isset($data['data'])) {
                $suratArray = $data['data'];
                
                // Urutkan berdasarkan nomor surat
                usort($suratArray, function($a, $b) {
                    return strcmp($a['number'], $b['number']);
                });
                
                foreach ($suratArray as $surat) {
            ?>
            <div class="col-md-6 surahCard">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $surat['name_id']; ?> (<?php echo $surat['number']; ?>)</h5>
                        <p class="card-text">Jumlah Ayat: <?php echo $surat['number_of_verses']; ?></p>
                        <p class="card-text">Tempat Penurunan: <?php echo $surat['revelation_id']; ?></p>
                        <p class="card-text">Tafsir: <?php echo $surat['tafsir']; ?></p>
                        <audio controls>
                            <source src="<?php echo $surat['audio_url']; ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "Gagal mengambil data atau data tidak ditemukan.\n";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        function searchSurah() {
            var input, filter, surahList, surahCards, surahName, i, txtValue;
            input = document.getElementById('search');
            filter = input.value.toUpperCase();
            surahList = document.getElementById('surahList');
            surahCards = surahList.getElementsByClassName('surahCard');
            for (i = 0; i < surahCards.length; i++) {
                surahName = surahCards[i].getElementsByTagName("h5")[0];
                txtValue = surahName.textContent || surahName.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    surahCards[i].style.display = "";
                } else {
                    surahCards[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
