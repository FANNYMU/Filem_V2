<?php
session_start();
require 'db.php';

// Periksa apakah pengguna yang masuk
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Memeriksa apakah URL video YouTube disediakan
    if (!empty($_POST['video_url'])) {
        $video_url = $_POST['video_url'];

        // Memeriksa apakah thumbnail diunggah
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
            // Mendapatkan informasi file thumbnail
            $thumbnail = $_FILES['thumbnail'];
            $thumbnail_extension = pathinfo($thumbnail['name'], PATHINFO_EXTENSION);
            $thumbnail_filename = uniqid() . '.' . $thumbnail_extension;
            $thumbnail_path = 'uploads/videos/' . $thumbnail_filename;

            // Pindahkan file thumbnail ke direktori yang ditentukan
            if (move_uploaded_file($thumbnail['tmp_name'], $thumbnail_path)) {
                // Masukkan detail video ke dalam database
                $stmt = $pdo->prepare('INSERT INTO videos (user_id, filename, title, description, thumbnail) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$user_id, $video_url, $title, $description, $thumbnail_filename]);

                // Set pesan sukses
                $success = "Video berhasil diunggah.";
            } else {
                $error = "Maaf, ada kesalahan saat mengunggah thumbnail.";
            }
        } else {
            $error = "Silakan unggah thumbnail.";
        }
    } else {
        $error = "Silakan masukkan URL video YouTube.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <link rel="Icon" href="./assets/images/logoYoutube.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<style>
    .tutor {
        font-size: 2rem;
    }
</style>

<body>

    <!-- Tambahkan tombol untuk membuka sidebar -->
    <div class="container-fluid">
        <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776;</span>
    </div>

    <!-- Sertakan sidebar.php di sini -->
    <?php include './sideBar/sidebar.php'; ?>

    <h1>Upload Video</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <a class="tutor" href="../Streaming/tutorials/index.html">Tutorial</a>

        <label for="title">Judul:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="description">Deskripsi:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="video_url">URL Video YouTube Emblede src:</label>
        <input type="url" name="video_url" id="video_url"><br>

        <label for="video_file">atau Unggah Video:</label>
        <input type="file" name="video_file" id="video_file" accept="video/*"><br>

        <label for="thumbnail">Thumbnail:</label>
        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required><br>
        
        <input type="submit" value="Unggah Video">
    </form>
</body>
</html>
