document.addEventListener('DOMContentLoaded', function() {
    var loading = document.querySelector('.loading');
    loading.classList.add('hidden'); // Sembunyikan loading awal

    // Perlihatkan loading
    loading.style.display = 'flex';

    // Periksa kecepatan internet pengguna
    if (navigator.connection && navigator.connection.effectiveType) {
        var effectiveType = navigator.connection.effectiveType;

        // Menentukan kecepatan loading berdasarkan tipe koneksi
        var loadingTime = 0;
        switch(effectiveType) {
            case 'slow-2g':
                loadingTime = 10000; // 10 detik untuk koneksi slow-2g
                break;
            case '2g':
                loadingTime = 8000; // 8 detik untuk koneksi 2g
                break;
            case '3g':
                loadingTime = 5000; // 5 detik untuk koneksi 3g
                break;
            case '4g':
                loadingTime = 3000; // 3 detik untuk koneksi 4g
                break;
            default:
                loadingTime = 5000; // Default 5 detik
        }

        // Menunda penutupan loading sesuai dengan kecepatan internet pengguna
        setTimeout(function() {
            loading.style.display = 'none';
        }, loadingTime);
    } else {
        // Jika informasi kecepatan internet tidak tersedia, gunakan waktu default
        setTimeout(function() {
            loading.style.display = 'none';
        }, 5000);
    }
});
