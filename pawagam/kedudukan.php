<?php 

    //Mulakan sesi

    session_start();

    //Memastikan pengguna telah login sebelum mengakses laman ini

    if(!isset($_SESSION['pengguna'])) {
        header("Location: login.php");
        die();
    }

    //Mengisytiharkan pembolehubah global 'wayang', 'tarikh', dan 'masa' dengan nilai yang didapati malalui cara POST

    global $wayang;
    $wayang = $_POST['wayang'];

    global $tarikh;
    $tarikh = explode(",", $_POST['tarikh']);

    global $masa;
    $masa = $_POST['masa'];

    include 'penempahanQuery.php';

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

    $tarikhSQL = $tarikh[0];

    //Memanggil fungsi 'bilikMT', 'bilik', 'TDTiket', dan 'TD'

    bilikMT($idWayang, $tarikhSQL, $masa);

    bilik ($idBilik);

    TDTiket($tarikhSQL, $masa);
    
    TD($dataTDTiket);

?>

<!DOCTYPE html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/kedudukan.css">


    <head>

        <title>Cinema HSY - Kedudukan</title>

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

                    </div>

                    <a role="button" id="logoutButton" href="logKeluar.php">Log Keluar</a>

                </div>   

                <div id="main-body" style="width:80%">
                
                    <div class="kedudukan" style="width:100%">

                        <div class="container" style="width:100%;text-align:center;">

                            <div class="row desc" style="width:100%;text-align:center;display:block;">

                                <!-- Memaparkan info wayang dan masa tayangan -->

                                <h4><?php echo $namaWayang . "<span> | </span>" . $tempohWayang . "minit" . "<span> | </span>" . $tarikh[1] . "<span> | </span>" . $masa . "<span> | </span>" . "Bilik" . " " . $dataBilik[0]['noBilik']; ?></h4> 

                            </div>

                        </div>

                        <form action="pilihanTiket.php" method="POST">

                            <div class="row screen">
                                
                                <h5>Screen</h5>

                            </div>

                            <?php

                                //Memaparkan pelan bilik

                                echo '<div class="pelanBilik">';
                                echo '<input type="hidden" name="desc" value="';
                                echo $namaWayang . "<span> | </span>" . $tempohWayang . "minit" . "<span> | </span>" . $tarikh[1] . "<span> | </span>" . $masa . "<span> | </span>" . "Bilik" . " " . $dataBilik[0]['noBilik'];
                                echo '">';
                                echo '<input type="hidden" name="idMT" value="';
                                echo $idMT;
                                echo '">';
                                echo '<input type="hidden" name="wayang" value="';
                                echo $wayang;
                                echo '">';
                                echo '<input type="hidden" name="masa" value="';
                                echo $masa;
                                echo '">';
                                echo '<input type="hidden" name="tarikh" value="';
                                echo $tarikhSQL;
                                echo '">';
                                echo '<table class="pelan">';


                                if ($dataBilik[0]['saizBilik'] == 140) {

                                    $rowLetter = array("J", "I", "H", "G", "F", "E", "D", "C", "B", "A");

                                    for ($baris = 0; $baris < count($rowLetter); $baris ++) {
                                        echo '<tr>';
                                        for ($seat = 1; $seat < 15; $seat ++) {

                                            $seatID = $rowLetter[$baris] . sprintf('%02d', $seat);

                                            if (count($dataTD) >= 1) {

                                                foreach ($dataTD as $key => $value) {

                                                    if ($seatID == $value) {

                                                        $match = true;
                                                        break;

                                                    } elseif ($seatID != $value) {

                                                        $match = false;

                                                    }

                                                }                                                

                                            } else {

                                                $match = false;

                                            }

                                            if ($match == true) {

                                                if ($seat == 2 || $seat == 12) {

                                                    echo '<td>';
                                                    echo '<input type="checkbox" id="';
                                                    echo $seatID;
                                                    echo '" disabled checked >';
                                                    echo '<label for="';
                                                    echo $seatID;
                                                    echo '">';
                                                    echo $seatID;
                                                    echo '</label>';
                                                    echo '</td>';
                                                    echo '<td></td>';

                                                    unset($match);

                                                } else {

                                                    echo '<td>';
                                                    echo '<input type="checkbox" id="';
                                                    echo $seatID;
                                                    echo '" checked disabled>';
                                                    echo '<label for="';
                                                    echo $seatID;
                                                    echo '">';
                                                    echo $seatID;
                                                    echo '</label>';
                                                    echo '</td>';

                                                    unset($match);

                                                }

                                            } elseif ($match == false) {

                                                if ($seat == 2 || $seat == 12) {
                                                    
                                                    echo '<td>';
                                                    echo '<input type="checkbox" id="';
                                                    echo $seatID;
                                                    echo '" name="seat[]" value="';
                                                    echo $seatID;
                                                    echo '">';
                                                    echo '<label for="';
                                                    echo $seatID;
                                                    echo '">';
                                                    echo $seatID;
                                                    echo '</label>';
                                                    echo '</td>';
                                                    echo '<td></td>';

                                                    unset($match);


                                                } else {

                                                    echo '<td>';
                                                    echo '<input type="checkbox" id="';
                                                    echo $seatID;
                                                    echo '" name="seat[]" value="';
                                                    echo $seatID;
                                                    echo '">';
                                                    echo '<label for="';
                                                    echo $seatID;
                                                    echo '">';
                                                    echo $seatID;
                                                    echo '</label>';
                                                    echo '</td>';

                                                    unset($match);


                                                }                                                

                                            }

                                        }
                                        echo '</tr>';
                                    }

                                }

                                echo '</table>';
                                echo '</div>';

                            ?>

                            <div class="butang">

                                <button type="submit" class="hantar"> Teruskan </button>

                            </div>

                        </form>

                    </div>
                
                </div>

            </div>

        </div>

    </body>

</html>
