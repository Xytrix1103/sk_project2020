<?php 

    include ("./includes/mula.php");

    //Menerima nilai melalui cara POST

    $seat = $_POST['seat'];

    $seatString = implode(", ", $seat);

    //mengisytiharkan pembolehubah global 'wayang' dengan nilai yang didapati melalui cara POST

    global $idMT;
    $idMT = $_POST['idMT'];

    global $wayang;
    $wayang = $_POST['wayang'];

    global $masa;
    $masa = $_POST['masa'];

    global $tarikh;
    $tarikh = $_POST['tarikh'];

    include ("./includes/penempahanQuery.php");

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

    bilikMT($wayang, $tarikh, $masa);
?>

<!DOCTYPE html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/tiket.css">


    <head>

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

                    <div class="jenisTiket">
                
                        <div class="container" style="width:100%;text-align:center;">

                            <div class="row desc" style="width:100%;text-align:center;display:block;">

                                <h4><?php echo $_POST['desc'];?></h4> 

                            </div>

                            <form action="bayaran.php" method="POST">

                                <div class="tiket">

                                    <label>Tiket Warga Emas - RM <?php echo $dataBilikMT[0]['hargaMT'] - 3; ?> </label>

                                    <select class="dropdown" name="wargaEmas">

                                        <?php

                                            //Memaparkan tag <option> untuk setiap elemen tatasusunan 'seat'

                                            for ($counter = 0; $counter <= count($seat); $counter ++) {
                                                echo '<option value="';
                                                echo $counter;
                                                echo '">';
                                                echo $counter;
                                                echo '</option>';
                                            }

                                        ?>

                                    </select>

                                </div>

                                <div class="tiket">

                                    <label>Tiket Dewasa - RM <?php echo $dataBilikMT[0]['hargaMT']; ?> </label>

                                    <select class="dropdown" name="dewasa">

                                        <?php

                                            //Memaparkan tag <option> untuk setiap elemen tatasusunan 'seat'

                                            for ($counter = 0; $counter <= count($seat); $counter ++) {
                                                echo '<option value="';
                                                echo $counter;
                                                echo '">';
                                                echo $counter;
                                                echo '</option>';
                                            }

                                        ?>

                                    </select>

                                </div>

                                <div class="tiket">

                                    <label>Tiket Kanak-Kanak - RM <?php echo $dataBilikMT[0]['hargaMT'] - 3; ?> </label>
                                    
                                    <select class="dropdown" name="kanak">

                                        <?php

                                            //Memaparkan tag <option> untuk setiap elemen tatasusunan 'seat'

                                            for ($counter = 0; $counter <= count($seat); $counter ++) {
                                                echo '<option value="';
                                                echo $counter;
                                                echo '">';
                                                echo $counter;
                                                echo '</option>';
                                            }

                                        ?>

                                    </select>

                                </div>

                                <div class="butang">

                                    <input type="hidden" name="idMT" value="<?php echo $idMT; ?>">
                                    <input type="hidden" name="info" value="<?php echo $_POST['desc'];?>">  
                                    <input type="hidden" name="seat" value="<?php echo $seatString; ?>">     
                                    <button type="submit" class="hantar"> Teruskan </button>

                                </div>                                

                            </form>

                        </div>

                    </div>

                </div>