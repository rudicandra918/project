<?php
// API URL for prayer schedule
$api_url = "https://api.myquran.com/v2/sholat/jadwal/0412/" . date("Y-m-d");

// Get data from the API
$data = file_get_contents($api_url);

// Check if data is fetched successfully
if ($data === FALSE) {
    echo "Error: Failed to fetch data from the API.";
} else {
    $data = json_decode($data, true);
    // Display prayer schedule data or error message
    if (isset($data['error'])) {
        echo "Error: " . $data['error'];
    } elseif (isset($data['data']) && isset($data['data']['jadwal'])) {
        $jadwal = $data['data']['jadwal'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jadwal Sholat</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="text-center">Jadwal Sholat untuk <?= $jadwal['tanggal'] ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Imsak</td>
                                <td><?= $jadwal['imsak'] ?></td>
                            </tr>
                            <tr>
                                <td>Subuh</td>
                                <td><?= $jadwal['subuh'] ?></td>
                            </tr>
                            <tr>
                                <td>Terbit</td>
                                <td><?= $jadwal['terbit'] ?></td>
                            </tr>
                            <tr>
                                <td>Dhuha</td>
                                <td><?= $jadwal['dhuha'] ?></td>
                            </tr>
                            <tr>
                                <td>Dzuhur</td>
                                <td><?= $jadwal['dzuhur'] ?></td>
                            </tr>
                            <tr>
                                <td>Ashar</td>
                                <td><?= $jadwal['ashar'] ?></td>
                            </tr>
                            <tr>
                                <td>Maghrib</td>
                                <td><?= $jadwal['maghrib'] ?></td>
                            </tr>
                            <tr>
                                <td>Isya</td>
                                <td><?= $jadwal['isya'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    } else {
        echo "Gagal memuat data jadwal sholat. Data tidak tersedia atau terjadi masalah dengan koneksi.";
    }
}
?>
