<?php 

    include ("./includes/mula.php");

    //Mewujudkan hubungan dengan pangkalan data 'pawagam'
    $namaPelayan = "localhost";
    $nama_pengguna = "root";
    $kataLaluan = "";
    $namaPD = "pawagam";
    $hubungan = new mysqli($namaPelayan, $nama_pengguna, $kataLaluan, $namaPD);

    // Menguji hubungan
    if ($hubungan->connect_error) {
        die("Connection failed: " . $hubungan->connect_error);
    }

    //Menentukan query yang ingin dilakukan iaitu mendapatkan semua nilai 'idWayang' dan 'namaWayang' dari jadual 'wayang'
    $sql = "SELECT idWayang, namaWayang FROM wayang";

    //Menjalankan query
    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan 'dataKeputusan' jika query berjaya dilakukan
    if ($hubungan->query($sql) == TRUE){
        $dataKeputusan = [];
        while ($baris = $keputusan->fetch_assoc()) {
            array_push($dataKeputusan, $baris);
        }
    } else {
        echo "Error" . $sql . "<br>" . $hubungan->error;
    }

    //Menentukan query yang ingin dilakukan iaitu mendapatkan semua nilai 'idBilik' dan 'noBilik' dari jadual 'bilik'
    $sql = "SELECT idBilik, noBilik FROM bilik";

    //Menjalankan query
    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan 'dataKeputusan2' jika query berjaya dilakukan
    if ($hubungan->query($sql) == TRUE){
        $dataKeputusan2 = [];
        while ($baris = $keputusan->fetch_assoc()) {
            array_push($dataKeputusan2, $baris);
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/masaTayangan.css">
        <title>Cinema HSY</title>
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
                                    echo '  <li><a href="lamanUtama.php" class="">Menu Utama</a></li>
                                            <li><a href="akaun.php" class="">Akaun Saya</a></li>
                                            <li><a href="penempahan.php" class="active">Penempahan Tiket</a></li>';
                                } else {
                                    echo '  <li><a href="lamanUtama.php" class="">Menu Utama</a></li>
                                            <li><a href="akaun.php" class="">Akaun Saya</a></li>
                                            <li><a href="penempahan.php" class="active">Penempahan Tiket</a></li>
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
                    <div class="container" id="movies">
                        <div class="row" id="title">
                            <h3> Penentuan Masa Tayangan </h3>
                        </div>
                        <form action="mtValidation.php" method="POST">
                            <h3 class="label">Sila pilih nama wayang: </h3>
                            <select id="namaWayang" class="namaWayang" name="movie" required>

                                <?php

                                    //Bagi setiap elemen dalam tatasusunan '$dataKeputusan', memaparkan satu tag <option> yang mengangungi maklumat elemen data tersebut 
                                    for ($x = 0; $x < count($dataKeputusan); $x ++){
                                        echo ('<option value="');
                                        echo print_r($dataKeputusan[$x]['idWayang'], true);
                                        echo ('">');
                                        echo print_r($dataKeputusan[$x]['idWayang'], true) . ". ";
                                        echo print_r($dataKeputusan[$x]['namaWayang'], true);
                                        echo ('</option>');

                                    }

                                ?>
                            
                            </select>
                            <h3 class="label">Sila pilih tarikh tayangan: </h3>
                            <input type="date" name="tarikh" class="tarikhTayangan" required>
                            <h3 class="label">Sila pilih masa tayangan: </h3>
                            <input type="time" name="masa" class="masaTayangan" required>
                            <h3 class="label">Sila pilih bilik: </h3>
                            <select id="bilik" class="bilik" name="bilik" required>

                                <?php

                                    //Bagi setiap elemen dalam tatasusunan '$dataKeputusan2', memaparkan satu tag <option> yang mengangungi maklumat elemen data tersebut 
                                    for ($y = 0; $y < count($dataKeputusan2); $y ++){
                                        echo ('<option value="');
                                        echo print_r($dataKeputusan2[$y]['idBilik'], true);
                                        echo ('">');
                                        echo print_r($dataKeputusan2[$y]['idBilik'], true) . ". ";
                                        echo "Bilik " . print_r($dataKeputusan2[$y]['noBilik'], true);
                                        echo ('</option>');
                                    }

                                ?>
                            
                            </select>
                            <h3 class="label">Sila masukkan harga: </h3>
                            <input type="number" name="harga" placeholder="1.0" step="0.1" min="5" max="25">
                            <button class="masukMT" type="submit" style="font-size:20px;">Masukkan Masa Tayangan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>