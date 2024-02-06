<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Juz Al-Quran</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Daftar Juz Al-Quran</h1>
        <form class="mb-4">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="search">Cari Juz</label>
                    <input type="text" class="form-control mb-2" id="search" placeholder="Cari Juz">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary mb-2" onclick="searchJuz()">Cari</button>
                </div>
            </div>
        </form>
        <div class="row" id="juzList">
            <?php
            $url = 'https://api.myquran.com/v2/quran/juz/semua';
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            
            if ($data && isset($data['data'])) {
                $juzArray = $data['data'];
                
                foreach ($juzArray as $juz) {
            ?>
            <div class="col-md-6 juzCard">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $juz['name']; ?></h5>
                        <p class="card-text">Mulai dari Surat: <?php echo $juz['name_start_id']; ?></p>
                        <p class="card-text">Ayat Mulai: <?php echo $juz['verse_start']; ?></p>
                        <p class="card-text">Berakhir di Surat: <?php echo $juz['name_end_id']; ?></p>
                        <p class="card-text">Ayat Berakhir: <?php echo $juz['verse_end']; ?></p>
                        <p class="card-text">Ayat Arab: <?php echo $juz['ayat_arab']; ?></p>
                        <p class="card-text">Ayat Indonesia: <?php echo $juz['ayat_indo']; ?></p>
                        <p class="card-text">Ayat Latin: <?php echo $juz['ayat_latin']; ?></p>
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
        function searchJuz() {
            var input, filter, juzList, juzCards, juzTitle, i, txtValue;
            input = document.getElementById('search');
            filter = input.value.toUpperCase();
            juzList = document.getElementById('juzList');
            juzCards = juzList.getElementsByClassName('juzCard');
            for (i = 0; i < juzCards.length; i++) {
                juzTitle = juzCards[i].getElementsByClassName("card-title")[0];
                txtValue = juzTitle.textContent || juzTitle.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    juzCards[i].style.display = "";
                } else {
                    juzCards[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
