<?php 

    // pemboleh ubah 'dataBaru' dimusnahkan jika wujud

    if (isset($dataBaru)) {

        unset($dataBaru);

    }

    include('jualanQuery.php');

    //Jika wujud pembolehubah 'dataBaru', nilai pembolehubah 'dataBaru' diberikan kepasa pembolehubah 'dataTiket'

    if (isset($dataBaru)) {

        $dataTiket = $dataBaru;

    }

?>

<!DOCTYPE html>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/jualan.css">


    <head>

        <title>Cinema HSY - Jualan</title>

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
                            <li><a href="pengguna.php" class="">Jadual Pengguna</a></li>
                            <li><a href="jualan.php" class="active">Rekod Jualan</a></li>
                            
                        </ul>

                    </div>

                    <a role="button" id="logoutButton" href="logKeluar.php">Log Keluar</a>

                </div>

                <div id="main-body" style="width:80%">

                    <div class="container" style="width:100%;text-align:center;">

                        <div class="row" id="title">

                            <h3> Jualan </h3>   

                        </div>
                        
                        <div class="jualan">

                            <form action="jualan.php" method="POST">

                                <select class="dropdown" name="wayang">

                                    <option value="" selected>*Sila memilih satu wayang*</option>

                                    <?php

                                        //bagi setiap elemen dalam tatasusunan '$data', memaparkan satu tag <option> yang mengangungi maklumat elemen data tersebut 

                                        for ($x = 0; $x < count($data); $x ++) {

                                            echo '<option value="' . $data[$x]['idWayang'] . '">' . $data[$x]['namaWayang'] . '</option>';

                                        }

                                    ?>

                                </select>

                                <select class="dropdown" name="bulan">

                                    <option value="" selected>*Sila memilih satu bulan*</option>
                                    <option value="1">Januari 2020</option>
                                    <option value="2">Februari 2020</option>
                                    <option value="3">Mac 2020</option>
                                    <option value="4">April 2020</option>
                                    <option value="5">Mei 2020</option>
                                    <option value="6">Jun 2020</option>
                                    <option value="7">Julai 2020</option>
                                    <option value="8">Ogos 2020</option>
                                    <option value="9">September 2020</option>
                                    <option value="10">Oktober 2020</option>
                                    <option value="11">November</option>
                                    <option value="12">Disember</option>
                                    
                                </select>

                                <button type="submit" class="pendaftaran" style="font-size:20px;"> Cari </button> 

                            </form>

                            <div class="row" style="width:100%;">

                                <table class="jadualTiket">

                                    <thead>

                                        <tr>

                                            <td>ID Tiket</td>
                                            <td>Nama Wayang</td>
                                            <td>Bilik</td>
                                            <td>Masa dan Tarikh</td>
                                            <td>Jumlah Bayaran</td>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                            //Maklumat dalam '$dataTiket' dipaparkan dalam bentuk jadual. Jumlah jualan tiket juga dipaparkan dalam jadual

                                            $jumlah = 0;

                                            for ($x = 0; $x < count($dataTiket); $x ++) {

                                                echo '<tr>';

                                                echo '<td>' . $dataTiket[$x]['idTiket'] . '</td>';
                                                echo '<td>' . $dataTiket[$x]['namaWayang'] . '</td>';
                                                echo '<td>' . $dataTiket[$x]['idBilik'] . '</td>';
                                                echo '<td>' . $dataTiket[$x]['tarikhMasaMT'] . '</td>';
                                                echo '<td>' . $dataTiket[$x]['jualanTiket'] . '</td>';

                                                echo '</tr>';

                                                $jumlah += $dataTiket[$x]['jualanTiket'];

                                            }

                                            if(count($dataTiket) < 1) {

                                                echo '<tr>';

                                                echo '<td colspan = "5"> Minta maaf, tiada rekod yang mematuhi permintaan anda. </td>';

                                                echo '<tr>';

                                            } else {

                                                echo '<tr style="border-top: 5px solid white; border-bottom: 5px solid white;">';

                                                echo '<td colspan = "4" style="text-align: right;"> Jumlah Jualan: </td>';
                                                echo '<td>' . $jumlah . '</td>';

                                                echo '</tr>';

                                            }

                                        ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>