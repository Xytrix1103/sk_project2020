<?php 

    include ("./includes/mula.php");

    $info = $_POST['info'];
    $info = explode(" | ", $info);

    include ("./includes/penempahanQuery.php");

    $seat = $_POST['seat'];

    global $idMT;
    $idMT = $_POST['idMT'];

    hargaMT($idMT);

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $tarikh = date('Y-m-d');

?>

<!DOCTYPE html>
    <head>    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/bayaran.css">
        <title>Cinema HSY - Bayaran</title>
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
                    <div class="container" id="bayaran">
                        <div class="tajuk">
                            <h1 style="font-weight:bold;text-transform:uppercase;">e-Tiket untuk Cinema HSY</h1>
                        </div>
                        <div class="info">
                            <h4>Dikendali Oleh: <?php echo $_SESSION['nama'];?></h4>
                        </div>
                        <div class="info">
                            <h4>Tarikh Jualan: <?php echo $tarikh;?></h4>
                        </div>
                        <div class="info">
                            <h4>Nama Wayang: <?php echo $info[0];?></h4>
                        </div>
                        <div class="info">
                            <h4>Tarikh Tayangan: <?php echo $info[2];?></h4>
                        </div>
                        <div class="info">
                            <h4>Masa: <?php echo $info[3];?></h4>
                        </div>
                        <div class="info">
                            <h4>Bilik: <?php echo $info[4];?></h4>
                        </div>
                        <div class="info" style="margin-bottom: 10vh;">
                            <h4>Kedudukan: <?php echo $seat; ?></h4>
                        </div>
                        <div class="container" id="main" style="margin-top:4vh;width:100%;">
                            <div class="row" style="width: 100%;margin-bottom:20px;">
                                <h2>Pengesahan Pembelian</h2>
                            </div>
                            <div class="row" id="jadualTiket" style="width:100%;">
                                <table class="jadualTiket">
                                    <thead>
                                        <tr>
                                            <td style="width: 40%;">Jenis Tiket</td>
                                            <td style="width: 10%;">Bil.</td>
                                            <td style="width: 20%;">Harga (RM)</td>
                                            <td style="width: 20%;">Jumlah (RM)</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 40%;">Tiket Warga Emas</td>
                                            <td style="width: 10%;"><?php echo $_POST['wargaEmas'];?></td>
                                            <td style="width: 20%;border-right: 5px solid white;"><?php echo ($dataHarga[0]['hargaMT'] - 3);?></td>
                                            <td style="width: 30%;"><?php $wargaEmas = $_POST['wargaEmas'] * ($dataHarga[0]['hargaMT'] - 3); echo $wargaEmas; ?></td>
                                        </tr>
                                        <tr>

                                            <td style="width: 40%;">Tiket Dewasa</td>
                                            <td style="width: 10%;"><?php echo $_POST['dewasa'];?></td>
                                            <td style="width: 20%;border-right: 5px solid white;"><?php echo $dataHarga[0]['hargaMT'];?></td>
                                            <td style="width: 30%;"><?php $dewasa = ($_POST['dewasa'] * ($dataHarga[0]['hargaMT'])); echo $dewasa;?></td>
                                        </tr>
                                        <tr style="border-bottom: 5px solid white;">
                                            <td style="width: 40%;">Tiket Kanak-Kanak</td>
                                            <td style="width: 10%;"><?php echo $_POST['kanak'];?></td>
                                            <td style="width: 20%;border-right: 5px solid white;"><?php echo $dataHarga[0]['hargaMT'] - 3;?></td>
                                            <td style="width: 30%;"><?php $kanak = ($_POST['kanak'] * ($dataHarga[0]['hargaMT'] - 3)); echo $kanak;?></td>
                                        </tr>
                                        <tr style="border-bottom: 5px solid white;">
                                            <td style="width: 70%;text-align: right;border-right: 5px solid white;" colspan="3">Jumlah Perlu Dibayar</td>
                                            <td style="width: 30%;"><?php echo ($wargaEmas + $dewasa + $kanak);?></td>
                                        </tr>
                                    </tbody>                              
                                </table>

                                    <?php 

                                        $cetakDiv='<div class="container" id="bayaran">
                                                <div class="tajuk">
                                                    <h1 style="font-weight:bold;text-transform:uppercase;">e-Tiket untuk Cinema HSY</h1>
                                                </div>
                                                <div class="info">
                                                    <h4>Dikendali Oleh: ' . $_SESSION['nama'] . '</h4>
                                                </div>
                                                <div class="info">
                                                    <h4>Tarikh Jualan: ' . $tarikh . '</h4>
                                                </div>
                                                <div class="info">
                                                    <h4>Nama Wayang: ' . $info[0] . '</h4>
                                                </div>
                                                <div class="info">
                                                    <h4>Tarikh Tayangan: ' . $info[2] . '</h4>
                                                </div>
                                                <div class="info">
                                                    <h4>Masa: ' . $info[3] . '</h4>
                                                </div>
                                                <div class="info">
                                                    <h4>Bilik: ' . $info[4] . '</h4>
                                                </div>
                                                <div class="info" style="margin-bottom: 10vh;">
                                                    <h4>Kedudukan: ' . $seat . '</h4>
                                                </div>
                                                <div class="container" id="main" style="margin-top:4vh;width:100%;">
                                                    <div class="row" style="width: 100%;margin-bottom:20px;">
                                                        <h2>Pengesahan Pembelian</h2>
                                                    </div>
                                                    <div class="row" id="jadualTiket" style="width:100%;">
                                                        <table class="jadualTiket">
                                                            <thead>
                                                                <tr>
                                                                    <td style="width: 40%;">Jenis Tiket</td>
                                                                    <td style="width: 10%;">Bil.</td>
                                                                    <td style="width: 20%;">Harga (RM)</td>
                                                                    <td style="width: 20%;">Jumlah (RM)</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 40%;">Tiket Warga Emas</td>
                                                                    <td style="width: 10%;">' . $_POST['wargaEmas'] . '</td>
                                                                    <td style="width: 20%;border-right: 5px solid black;">' . ($dataHarga[0]['hargaMT'] - 3) . '</td>
                                                                    <td style="width: 30%;">' . $_POST['wargaEmas'] * ($dataHarga[0]['hargaMT'] - 3) . '</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%;">Tiket Dewasa</td>
                                                                    <td style="width: 10%;">' . $_POST['dewasa'] . '</td>
                                                                    <td style="width: 20%;border-right: 5px solid black;">' . $dataHarga[0]['hargaMT'] . '</td>
                                                                    <td style="width: 30%;">' . $_POST['dewasa'] * ($dataHarga[0]['hargaMT']) . '</td>
                                                                </tr>
                                                                <tr style="border-bottom: 5px solid black;">
                                                                    <td style="width: 40%;">Tiket Kanak-Kanak</td>
                                                                    <td style="width: 10%;">' . $_POST['kanak'] . '</td>
                                                                    <td style="width: 20%;border-right: 5px solid black;">' . ($dataHarga[0]['hargaMT'] - 3) . '</td>
                                                                    <td style="width: 30%;">' . $_POST['kanak'] * ($dataHarga[0]['hargaMT'] - 3) . '</td>
                                                                </tr>
                                                                <tr style="border-bottom: 5px solid black;">
                                                                    <td style="width: 70%;text-align: right;border-right: 5px solid black;" colspan="3">Jumlah Perlu Dibayar</td>
                                                                    <td style="width: 30%;">' . ($wargaEmas + $dewasa + $kanak) . '</td>
                                                                </tr>
                                                            </tbody>                              
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';

                                    ?>

                                <form id="idMT" action="tiketInsert.php" method="POST">
                                    <input type="hidden" name="cetak" value='<?php echo $cetakDiv;?>'>        
                                    <input type="hidden" name="idMT" value="<?php echo $idMT; ?>">
                                    <input type="hidden" name="seat" value="<?php echo $seat;?>">
                                    <input type="hidden" name="jualan" value="<?php echo ($wargaEmas + $dewasa + $kanak);?>">
                                    <button type="submit" class="hantar">Meneruskan</button>                            
                                </form>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>