<?php
session_start();
require 'db.php';

// Pastikan pengguna sudah masuk
if (!isset($_SESSION['user_id'])) {
    // Redirect ke halaman login jika pengguna belum masuk
    header('Location: login.php');
    exit;
}

// Ambil ID video dari permintaan POST
if (isset($_POST['video_id'])) {
    $video_id = $_POST['video_id'];
    
    // Ambil ID pengguna dari sesi
    $user_id = $_SESSION['user_id'];
    
    try {
        // Masukkan data tontonan ke dalam tabel watch_history
        $stmt = $pdo->prepare('INSERT INTO watch_history (user_id, video_id) VALUES (?, ?)');
        $stmt->execute([$user_id, $video_id]);
        
        // Redirect kembali ke halaman view.php setelah memasukkan ke dalam history
        header('Location: view.php?id=' . $video_id);
        exit;
    } catch (PDOException $e) {
        // Tangani kesalahan jika terjadi kesalahan saat memasukkan ke dalam database
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect ke halaman view.php jika tidak ada ID video yang diberikan
    header('Location: view.php');
    exit;
}
?>
