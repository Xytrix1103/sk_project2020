<?php 

    include ("./includes/mula.php");

?>

<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/lamanUtama.css">
        <title>Cinema HSY - Laman Utama</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" id="header">
                <div class="col-md-12" id="nama" style="background-color:black;">
                    <a href="lamanUtama.php"><img id="logo" src="./img/cinemaHSY.png"></a>
                </div>
            </div>
            <div class="row" id="line"><div class="col-md-12"></div></div>
            <div class="row">
                <div id="sidebar">
                    <center>
                        <img id="user" src="./img/user_icon.png">
                        <h4 style="margin:20px;font-weight:800">Pengguna: <?php echo ($_SESSION['nama']); ?></h4>
                    <center>
                    <div id="navigationMenu">
                        <ul id="navbar">

                            <?php
                            
                                //Memaparkan menu sisi yang berbeza berdasarkan berdasarkan jenis pengguna yang log masuk untuk tujuan keselematan

                                if ($_SESSION['jenis'] == "pekerja") {
                                    echo '  <li><a href="lamanUtama.php" class="active">Menu Utama</a></li>
                                            <li><a href="akaun.php" class="">Akaun Saya</a></li>
                                            <li><a href="penempahan.php" class="">Penempahan Tiket</a></li>';
                                } else {
                                    echo '  <li><a href="lamanUtama.php" class="active">Menu Utama</a></li>
                                            <li><a href="akaun.php" class="">Akaun Saya</a></li>
                                            <li><a href="penempahan.php" class="">Penempahan Tiket</a></li>
                                            <li><a href="pilihanPendaftaran.php" class="">Pendaftaran Pengguna </li>   
                                            <ul>
                                                <li><a href="pendaftaran.php" class="">Masukkan Data</li>
                                                <li><a href="muatnaikCSV.php" class="">Muat Naik Fail CSV</li>
                                            </ul>
                                            <li><a href="tambahWayang.php" class="">Tambah Wayang</a></li>
                                            <li><a href="tambahMT.php" class="">Tambah Masa Tayangan</a></li>
                                            <li><a href="pengguna.php" class="">Jadual Pengguna</a></li>
                                            <li><a href="jualan.php" class="">Rekod Jualan</a></li>'; 
                                }

                            ?>

                        </ul>
                    </div>
                    <a role="button" id="logoutButton" href="logKeluar.php">Log Keluar</a>
                </div>
                <div id="main-body" style="width:80%">
                </div>
            </div>
        </div>
    </body>
</html>