<?php
session_start();

// Pastikan pengguna yang masuk
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

// Ambil ID pengguna yang masuk dari sesi
$user_id = $_SESSION['user_id'];

// Query untuk mengambil riwayat tontonan pengguna
$sql = "SELECT videos.id AS video_id, videos.title, videos.description, videos.filename, videos.thumbnail, watch_history.watched_at
        FROM watch_history
        JOIN videos ON watch_history.video_id = videos.id
        WHERE watch_history.user_id = ?
        ORDER BY watch_history.watched_at DESC";

$stmt = $pdo->query('SELECT * FROM videos ORDER BY upload_date DESC');
$videos = $stmt->fetchAll();

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$watch_history = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch History</title>
    <link rel="shortcut icon" href="./assets/images/logoYoutube.svg" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    body {
        background-color: #0f0f0f;
        color: #ffffff;
    }
    
    


        .list {
        display: grid;
        grid-template-columns: max-content;
        gap: 20px;
    }

    .video-item {
        border: 1px solid #ddd;
        border-radius: 12px;
        overflow: hidden;
    }

    .video-item img {
        width: 55rem;
        height: auto;
        cursor: pointer;
    }

    .video-item h2 {
        font-size: 18px;
        margin: 10px 0;
    }

    .video-item p {
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Jumlah baris sebelum ditampilkan ellipsis */
        -webkit-box-orient: vertical;
        white-space: nowrap; /* Menyediakan ruang tambahan untuk menampilkan elipsis */
    }

    .video-item small {
        color: #888;
        font-size: 12px;
    }
</style>

<body>

    <!-- Tambahkan tombol untuk membuka sidebar -->
    <div class="container-fluid">
        <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776;</span>
    </div>

    <!-- Sertakan sidebar.php di sini -->
    <?php include './sideBar/sidebar.php'; ?>

<div class="container">
    <h1>Watch History</h1>
    <?php if (empty($watch_history)): ?>
        <p>No videos watched yet.</p>
    <?php else: ?>
                <?php foreach ($watch_history as $history): ?>
                <div class="container mt-3 list">
                    <div class="video-item">
                        <img src="uploads/videos/<?php echo htmlspecialchars($history['thumbnail']); ?>" alt="<?php echo htmlspecialchars($history['title']); ?>">
                        <h2><?php echo htmlspecialchars($history['title']); ?></h2>
                        
                        <p><?php echo nl2br(htmlspecialchars($history['description'])); ?></p>
                        
                        <?php echo htmlspecialchars($history['watched_at']); ?>
                        
                    </div>
                    
                </div>
                <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
