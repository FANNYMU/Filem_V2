<?php
session_start();
require 'db.php';

// Periksa apakah parameter 'id' ada dalam URL
if (isset($_GET['thumbnail'])) {
    // Ambil id video dari URL
    $video_id = $_GET['thumbnail'];

    // Ambil informasi video dari database
    $stmt = $pdo->prepare('SELECT * FROM videos WHERE id = ?');
    $stmt->execute([$video_id]);
    $video = $stmt->fetch();


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($video['thumbnail']); ?></title>
    <link rel="Icon" href="./assets/images/logoYoutube.svg" type="image/x-icon">
</head>
<body>
    <img src="uploads/videos/<?php echo htmlspecialchars($video['thumbnail']); ?>" alt="Tidak Di Temukan">
</body>
</html>