<?php
    
    include ("./includes/mula.php");

    //Memastikan hanya pengguna yang merupakan pengurus yang dapat mengakses laman ini

    include ("./includes/pengurusValidation.php");

    //Mewujudkan hubungan dengan pangkalan data 'pawagam'

    $namaPelayan = "localhost";
    $nama_pengguna = "root";
    $kataLaluan = "";
    $namaPD = "pawagam";
    
    $hubungan = new mysqli($namaPelayan, $nama_pengguna, $kataLaluan, $namaPD);

    // Menguji hubungan

    if ($hubungan->connect_error) {
        die("connection failed: " . $hubungan->connect_error);
    }

    //Menentukan query yang ingin dilakukan

    $sql = "SELECT idBilik FROM bilik";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan 'data' jika query berjaya dilakukan

    if ($hubungan->query($sql) == TRUE){

        $dataBilik = [];

        while ($baris = $keputusan->fetch_assoc()) {

            array_push($dataBilik, $baris);

        }

    } else {

        echo "Error" . $sql . "<br>" . $hubungan->error;
        
    }

    
    $sql = "SELECT idWayang, namaWayang FROM wayang";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan 'data' jika query berjaya dilakukan

    if ($hubungan->query($sql) == TRUE){

        $dataWayang = [];

        while ($baris = $keputusan->fetch_assoc()) {

            array_push($dataWayang, $baris);

        }

    } else {

        echo "Error" . $sql . "<br>" . $hubungan->error;
        
    }

    //Menamatkan hubungan

    $hubungan->close();

?>

<!DOCTYPE html>

    <head>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <meta name="viewport" content="width = device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/tambahMT.css">

        <title>Cinema HSY - Tambah Masa Tayangan</title>

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

                            <li><a href="lamanUtama.php" class="">Menu Utama</a></li>
                            <li><a href="akaun.php" class="">Akaun Saya</a></li>
                            <li><a href="penempahan.php" class="">Penempahan Tiket</a></li>
                            <li><a href="pilihanPendaftaran.php" class="">Pendaftaran Pengguna Baru</li>   
                            <ul>
                                <li><a href="pendaftaran.php" class="">Masukkan Data</li>
                                <li><a href="muatnaikCSV.php" class="">Muat Naik Fail CSV</li>
                            </ul>
                            <li><a href="tambahWayang.php" class="">Tambah Wayang</a></li>
                            <li><a href="tambahMT.php" class="active">Tambah Masa Tayangan</a></li>
                            <li><a href="pengguna.php" class="">Jadual Pengguna</a></li>
                            <li><a href="jualan.php" class="">Rekod Jualan</a></li>
                            
                        </ul>

                    </div>

                    <a role="button" id="logoutButton" href="logKeluar.php">Log Keluar</a>

                </div>

                <div id="main-body" style="width:80%">  

                    <div class="container" id="pendaftaran">

                        <div class="row" id="title">

                            <h3> Tambah Masa Tayangan </h3>

                        </div>

                        <form action="tambahMTValidation.php" method="POST">

                            <div class="container">

                                <label for="bilik" style="margin-bottom:10px;"><b>Bilik</b></label></br>
                                <select id="bilik" name="bilik" style="margin-bottom:20px;height:50px;width:170px;text-align:center;" required>
                                    
                                    <?php

                                        for ($x = 0; $x < count($dataBilik); $x ++) {

                                            echo '<option value="' . $dataBilik[$x]['idBilik'] . '">' . $dataBilik[$x]['idBilik'] . '</option>';

                                        }

                                    ?>

                                </select>
                                
                                </br>

                                <label for="tarikhMasaMT" style="margin-bottom:10px;"><b>Tarikh dan Masa Tayangan</b></label>
                                <input style="margin-bottom:20px;" type="text" placeholder="Sila masukkan dalam format (tahun-bulan-hari jam:minit:00) e.g. 2020-06-20 15:30:00." name="tarikhMasaMT" required>
                                
                                <label for="wayang" style="margin-bottom:10px;"><b>Wayang</b></label></br>
                                <select id="wayang" name="wayang" style="margin-bottom:20px;height:50px;width:170px;text-align:center;" required>
                                    
                                    <?php

                                        for ($x = 0; $x < count($dataWayang); $x ++) {

                                            echo '<option value="' . $dataWayang[$x]['idWayang'] . '">' . $dataWayang[$x]['idWayang'] . "- " . $dataWayang[$x]['namaWayang'] . '</option>';

                                        }

                                    ?>

                                </select>

                                </br>

                                <label for="harga" style="margin-bottom:10px;"><b>Harga Masa Tayangan</b></label></br>
                                <input type="number" name="harga" id="harga" style="margin-bottom: 3vh;">

                                <button class="tambah" type="submit" style="font-size:20px;">Tambah</button>

                            </div>

                        </form>
                        
                    </div>

                </div>

            </div>

        </div>

    </body>

</html>
