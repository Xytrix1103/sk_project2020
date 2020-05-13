<?php 

    //Mulakan sesi

    session_start();

    //Memastikan pengguna telah login sebelum mengakses laman ini

    if(!isset($_SESSION['pengguna'])) {
        header("Location: logMasuk.php");
        die();
    }

    include('penempahanQuery.php');

    //Mengisytiharkan pembolehubah global 'wayang' dan nilainya merupakan nilai 'wayang' melalui cara POST dari borang sebelumnya

    global $wayang;
    $wayang = $_POST['wayang'];

    //Memanggil fungsi 'wayang'

    wayang();

    //Memberikan nilai kepada pembolehubah 'idWayang', 'urlGambar', 'namaWayang', 'tempohWayang', 'infoWayang' berdasarkan baris data yang mempunyai nilai 'idWayang' yang sama dengan pembolehubah 'wayang'

    for($x = 0; $x < $count; $x ++) {

        if ($dataWayang[$x]['idWayang'] == $wayang) {

            $idWayang = $dataWayang[$x]['idWayang'];
            $urlGambar = $dataWayang[$x]['urlGambar'];
            $namaWayang = $dataWayang[$x]['namaWayang'];
            $tempohWayang = $dataWayang[$x]['tempohWayang'];
            $infoWayang = $dataWayang[$x]['infoWayang'];

        }
        
    }

    //Menisytiharkan pembolehubah global 'tarikh' dan nilainya ialah nilai 'tarikhMT' yang didapati melalui cara POST dari borang sebelumnya

    global $tarikh;
    $tarikh = $_POST['tarikhMT'];
    
    $tarikhSplit = explode("-", $tarikh);

    //Memanggil fungsi tarikhUnik dan masaMT

    tarikhUnik($wayang);

    masaMT($wayang, $tarikh);

?>

<!DOCTYPE html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/pemilihanMasa.css">


    <head>

        <title>Cinema HSY - Pilih Masa</title>

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
                                            <li><a href="pengguna.php" class="">Jadual Pengguna</a></li>
                                            <li><a href="jualan.php" class="">Rekod Jualan</a></li>'; 

                                }

                            ?>

                        </ul>

                    </div>

                    <a role="button" id="logoutButton" href="logKeluar.php">Log Keluar</a>

                </div>   

                <div id="main-body" style="width:80%">

                    <div class="container" id="tiket">

                        <div class="row" id="title">

                            <h3> Pemilihan Masa </h3>

                        </div>

                        <div id="pilihan">

                            <div class="row pilihMasa">

                                <div id="imej">

                                    <img class="portrait" src="./img/<?php echo $urlGambar; ?>">

                                </div>

                                <div id="maklumat" style="width:55vw;">

                                    <h4 class="namaWayang" style="margin:20px;font-weight:lighter;"><span style="font-weight:bold;font-size:45px;margin-right: 20px;"><?php echo $namaWayang . "</span>" . $tempohWayang . " minit"; ?></h4>
                                    <h5 style="margin:40px 20px;font-weight:lighter;"><?php echo $infoWayang; ?></h5>

                                </div>

                            </div>

                            <div class="row masaMT">
                            
                                <h3 class="pilihHeading">Pilih Masa Tayangan Untuk
                                
                                    <?php 

                                        //Dapatkan bulan masa tayangan yang ingin dipaparkan dan memaparkan

                                        switch ($tarikhSplit[1]) {
                                            case "01":
                                                $bulan = "Jan";
                                            break;

                                            case "02":
                                                $bulan = "Feb";
                                            break;

                                            case "03":
                                                $bulan = "Mac";
                                            break;

                                            case "04":
                                                $bulan = "Apr";
                                            break;

                                            case "05":
                                                $bulan = "Mei";
                                            break;

                                            case "06":
                                                $bulan = "Jun";
                                            break;

                                            case "07":
                                                $bulan = "Jul";
                                            break;

                                            case "08":
                                                $bulan = "Ogo";
                                            break;

                                            case "09":
                                                $bulan = "Sep";
                                            break;

                                            case "10":
                                                $bulan = "Okt";
                                            break;

                                            case "11":
                                                $bulan = "Nov";
                                            break;

                                            case "12":
                                                $bulan = "Dis";
                                            break;
                                        }
                                        
                                        echo $tarikhSplit[2] . " " . $bulan . " " . $tarikhSplit[0] . "</h3>";

                                    ?>

                                <form action="kedudukan.php" method="POST">

                                    <div class="row" style="vertical-align:middle;margin: 30px 0px;">

                                        <?php

                                            //Memaparkan masa tayangan berdasarkan tarikh tayangan yang telah dipilih

                                            echo '<button class="tarikh" disabled>';
                                            $tarikhPerkataan = $tarikhSplit[2] . " " . $bulan . " " . $tarikhSplit[0];
                                            echo $tarikhPerkataan . "</button>";

                                            for ($a = 0; $a < count($dataMasaMT); $a ++) {
                                                $tarikhValue = $tarikh . "," . $tarikhPerkataan;
                                                echo ('<input type="hidden" name="wayang" value="');
                                                echo $idWayang;
                                                echo ('">');
                                                echo ('<input type="hidden" name="tarikh" value="');
                                                echo $tarikhValue;
                                                echo ('">');
                                                echo ('<button class="masa" type="submit" name="masa" value="');
                                                echo $dataMasaMT[$a]['masaMT'];
                                                echo ('">');
                                                echo $dataMasaMT[$a]['masaMT'];
                                                echo ('</button>');                  
                                            }

                                        ?>

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
