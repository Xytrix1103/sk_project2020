<?php 

    //Mulakan sesi

    session_start();

    //Memastikan pengguna telah login sebelum mengakses laman ini

    if(!isset($_SESSION['pengguna'])) {
        header("Location: login.php");
        die();
    }

    //Menerima nilai POST dari laman sebelumnya ke dalam pembolehubah

    $id = $_SESSION['pengguna'];

    //Mewujudkan hubungan dengan pangkalan data 'pawagam' berdasarkan pelayan 'localhost', nama pengguna 'root' dan kata laluan ''

    $namaPelayan = "localhost";
    $nama_pengguna = "root";
    $kataLaluan = "";
    $namaPD = "pawagam";
    
    $hubungan = new mysqli($namaPelayan, $nama_pengguna, $kataLaluan, $namaPD);

    // Menguji hubungan dan memulangkan kesilapan lanjut sekiranya hubungan gagal

    if ($hubungan->connect_error) {
        die("Connection failed: " . $hubungan->connect_error);
    }

    $sql = "SELECT * FROM pengguna WHERE idPengguna = '$id'";
    $keputusan = $hubungan->query($sql);

    if ($keputusan == TRUE){

        $data = [];

        while ($baris = $keputusan->fetch_assoc()) {

            array_push($data, $baris);

        }

    } else {

        echo "Error" . $sql . "<br>" . $hubungan->error;

    }

    $hubungan->close();

?>

<!DOCTYPE html>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/akaun.css">


    <head>

        <title>Cinema HSY - Akaun Saya</title>

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
                                            <li><a href="akaun.php" class="active">Akaun Saya</a></li>
                                            <li><a href="penempahan.php" class="">Penempahan Tiket</a></li>';

                                } else {

                                    echo '  <li><a href="lamanUtama.php" class="">Menu Utama</a></li>
                                            <li><a href="akaun.php" class="active">Akaun Saya</a></li>
                                            <li><a href="penempahan.php" class="">Penempahan Tiket</a></li>
                                            <li><a href="pilihanPendaftaran.php" class="">Pendaftaran Pengguna </li>   
                                            <ul>
                                                <li><a href="pendaftaran.php" class="">Masukkan Data</li>
                                                <li><a href="muatnaikCSV.php" class="">Muat Naik Fail CSV</li>
                                            </ul>
                                            <li><a href="pengguna.php" class="">Jadual Pengguna</a></li>
                                            <li><a href="jualan.php" class="">Rekod Jualan</a></li>'; 

                                }

                            ?>

                        </ul>

                    </div>

                    <a role="button" id="logoutButton" href="logKeluar.php">Log Keluar</a>

                </div>

                <div id="main-body" style="width:80%">  

                    <div class="container" style="width:100%;text-align:center;">

                        <div class="row" id="title">

                            <h3> Akaun Saya </h3>   

                        </div>

                        <div class="container" id="main" style="margin-top:4vh;width:100%;">

                            <div class="row" style="width:100%;">

                                <form action="kemaskiniValidation.php" method="POST" id="update">

                                    <div class="container">

                                        <label for="nama" style="margin-bottom:10px;"><b>Nama Pengguna</b></label>
                                        <input value="<?php echo $data[0]['namaPengguna']; ?>" style="margin-bottom:20px;" type="text" placeholder="Sila masukkan nama pengguna " name="nama" required>

                                        <label for="noKP" style="margin-bottom:10px;"><b>No. Kad Pengenalan Pengguna</b></label>
                                        <input value="<?php echo $data[0]['noKPPengguna']; ?>" style="margin-bottom:20px;" type="text" placeholder="Sila masukkan nombor kad pengenalan pengguna " name="noKP" required>
                                            
                                        <label for="username" style="margin-bottom:10px;"><b>Username Pengguna</b></label>
                                        <input value="<?php echo $data[0]['usernamePengguna']; ?>" style="margin-bottom:20px;" type="text" placeholder="Sila masukkan username pengguna " name="namaPengguna" required>

                                        <label for="kataLaluan" style="margin-bottom:10px;"><b>Password Pengguna </b></label>
                                        <input value="<?php echo $data[0]['passwordPengguna']; ?>" style="margin-bottom:20px;" type="text" placeholder="Sila masukkan kataLaluan pengguna " name="kataLaluan" required>
                                            
                                        <label for="telefon" style="margin-bottom:10px;"><b>Telefon Pengguna </b></label>
                                        <input value="<?php echo $data[0]['telefonPengguna']; ?>" style="margin-bottom:20px;" type="text" placeholder="Sila masukkan telefon pengguna " name="telefon" required>

                                        <input type="hidden" name="auth" value="pass">
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['pengguna']; ?>">
                                            
                                        <button class="update" type="submit" style="font-size:20px;">Kemaskini</button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>