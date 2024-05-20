<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #101010;
    }

    .btn {
        background: #ffff00;
background: linear-gradient(0deg,#ffff00 20%, #9400ff 80%);
background: -webkit-linear-gradient(0deg,#ffff00 20%, #9400ff 80%);
background: -moz-linear-gradient(0deg,#ffff00 20%, #9400ff 80%);
        border-radius: 10px;
        font-size: 100px;
        cursor: pointer;
    }

    .btn:hover {
        background:#9400ff;
background: linear-gradient(0deg,#9400ff 20%, #1f00ff 80%);
background: -webkit-linear-gradient(0deg,#9400ff 20%, #1f00ff 80%);
background: -moz-linear-gradient(0deg,#9400ff 20%, #1f00ff 80%);
    }

</style>  
   
<body>
    
    <!-- Tambahkan tombol di bawah video -->
 <form  class="button1" action="../add_to_history.php" method="post">
     <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
     <button class="btn" type="submit"><span>Tambahkan ke Riwayat Tontonan</span></button>
 </form>
</body>