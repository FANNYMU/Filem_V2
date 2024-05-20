<?php
session_start();
require 'db.php';

// Periksa apakah parameter 'id' ada dalam URL
if (isset($_GET['id'])) {
    // Ambil id video dari URL
    $video_id = $_GET['id'];

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
    <title><?php echo htmlspecialchars($video['description']); ?></title>
    <link rel="Icon" href="./assets/images/logoYoutube.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<style>
    /* styles.css */
body {
      font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-style: normal;
    background-color: #0f0f0f;
    color: #fff;
}

.container {
    margin-top: 50px;
}


.video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px;
    height: 0;
    overflow: hidden;
}

.video-container iframe,
.video-container object,
.video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.video-title {
    font-size: 24px;
    margin-bottom: 20px;
}

.video-description {
    font-size: 16px;
    margin-bottom: 20px;
}

.video-details {
    font-size: 14px;
    color: #888;
}

.video-details span {
    margin-right: 20px;
}

.delete {
    background-color: #0f0f0f;
    border: none;
}

.btn1 {
    background-color: #0f0f0f;
    border: none;
}

.btn2 {
background: #1f00ff;
background: linear-gradient(180deg,#1f00ff 20%, #9400ff 80%);
background: -webkit-linear-gradient(180deg,#1f00ff 20%, #9400ff 80%);
background: -moz-linear-gradient(180deg,#1f00ff 20%, #9400ff 80%);
border-radius: 10px;
}


.tontonan {
    text-decoration: none;
}


.btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;

}


.button1 {
    background-color: #0f0f0f;
    border: #0f0f0f;
}

@media only screen and (max-width: 600px) {
    .videoLink {
        width: 100%;
        height: 15rem;
    }
}
@media only screen and (min-width: 1200px) {
    .videoLink {
        width: 100%;
        height: 40rem;
    }
}
</style>


    <!-- Tambahkan tombol untuk membuka sidebar -->
    <div class="container-fluid">
        <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776;</span>
    </div>

    <!-- SideBar -->
<style>
    .sidenav {
    height: 100%;
    width: 250px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: -250px;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    }

    .sidenav a {
        padding: 10px 15px;
        text-decoration: none;
        font-size: 18px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    #main {
        transition: margin-left .5s;
        padding: 16px;
    }

    .content {
        margin-left: 250px;
        padding: 20px;
    }
</style>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="../Streaming/index.php">Home</a>
    <a href="../Streaming/upload.php">Upload</a>
    <a href="../Streaming/login.php">Login</a>
    <a href="../Streaming/register.php">Register</a>
    <a href="../Streaming/history.php">History</a>

    <!-- PHP DELETE -->
    <?php
    // Periksa apakah pengguna sudah masuk
    if (isset($_SESSION['user_id'])) {
        // Periksa apakah pengguna yang masuk adalah pemilik video
        if ($_SESSION['user_id'] == $video['user_id']) {
            // Tampilkan tombol hapus jika pengguna adalah pemilik video
            echo '<a href="delete.php?id=' . $video_id . '">Hapus Video</a>';
        }
    } else {
        // Redirect atau tampilkan pesan jika pengguna belum masuk
        echo "Anda harus masuk untuk menghapus video.";
    }
    ?>
    <!-- PHP DELETE -->
</div>

<script>
    // Fungsi untuk membuka sidebar
    function openNav() {
        document.getElementById("mySidenav").style.left = "0";
        document.getElementById("main").style.marginLeft = "250px";
    }

    // Fungsi untuk menutup sidebar
    function closeNav() {
        document.getElementById("mySidenav").style.left = "-250px";
        document.getElementById("main").style.marginLeft= "0";
    }
</script>

<!-- SideBar -->

<div class="container">
    <?php if (strpos($video['filename'], 'youtube.com') !== false || strpos($video['filename'], 'youtu.be') !== false): ?>
        <!-- Jika video dari YouTube -->
        <div class="video-container">
            <iframe width="560" height="315" src="<?php echo htmlspecialchars($video['filename']); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    <?php else: ?>
        <!-- Jika video dari directory -->
        <video class="videoLink" width="560" height="315" controls autoplay>
            <source src="uploads/videos/<?php echo htmlspecialchars($video['filename']); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    <?php endif; ?>

    <!-- Tambahkan tombol di bawah video -->
    <form class="button1" action="add_to_history.php" method="post">
        <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
        <button class="btn" type="submit" onclick="tombol()">Tambahkan ke Riwayat Tontonan</button>
    </form>

    <p><?php echo nl2br(htmlspecialchars($video['description'])); ?></p>
    <small>Uploaded on <?php echo $video['upload_date']; ?></small>

    <form action="delete.php" method="post" class="delete">
        <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
    </form>
</div>

</body>

<script>
function tombol(){
    alert("Ditambahkan Ke History")
}
</script>
</html>

