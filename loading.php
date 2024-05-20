<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading</title>
    <link rel="shortcut icon" href="./assets/images/logoYoutube.svg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/loading.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
        background-color: #0f0f0f;
    }

    h1 {
        color: #fff;
        size: 100px;
        display: flex;
        justify-content: center;
    }
</style>
<body>
            <!-- Elemen loading -->
            <h1>LOADING...</h1>
    <!-- Elemen loading -->
    <div class="loading">
        <img class="loading-img" src="./assets/images/Loading.gif" alt="Loading...">
            <div id="speed"></div> <!-- Menampilkan kecepatan pengguna -->
    </div>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var loading = document.querySelector('.loading');
    var speedElement = document.getElementById('speed'); // Mengambil elemen untuk menampilkan kecepatan

    // Perlihatkan loading
    loading.style.display = 'flex';

    // Periksa kecepatan internet pengguna
    if (navigator.connection && navigator.connection.effectiveType) {
        var effectiveType = navigator.connection.effectiveType;

        // Menampilkan kecepatan pengguna
        speedElement.textContent = 'Kecepatan: ' + effectiveType;

        // Menentukan kecepatan loading berdasarkan tipe koneksi
        var loadingTime = 0;
        switch(effectiveType) {
            case 'slow-2g':
                loadingTime = 10000; // 10 detik untuk koneksi slow-2g
                var lokasi = "./index.php";

            window.location.href = lokasi;
                break;
            case '2g':
                loadingTime = 8000; // 8 detik untuk koneksi 2g
                var lokasi = "./index.php";

            window.location.href = lokasi;
                break;
            case '3g':
                loadingTime = 5000; // 5 detik untuk koneksi 3g
                var lokasi = "./index.php";

            window.location.href = lokasi;
                break;
            case '4g':
                loadingTime = 3000; // 3 detik untuk koneksi 4g
                var lokasi = "./index.php";

            window.location.href = lokasi;
                break;
            default:
                loadingTime = 5000; // Default 5 detik
                var lokasi = "./index.php";

            window.location.href = lokasi;
                
        }

        // Menunda penutupan loading sesuai dengan kecepatan internet pengguna
        setTimeout(function() {
            loading.style.display = 'none';
        }, loadingTime);
    } else {
        // Jika informasi kecepatan internet tidak tersedia, gunakan waktu default
        setTimeout(function() {
            loading.style.display = 'none';
            var lokasi = "./index.php";

            window.location.href = lokasi;
        }, 5000);
    }
});



</script>
</html>