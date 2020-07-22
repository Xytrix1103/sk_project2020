<?php 

    include ("./includes/penempahanQuery.php");

    //Memanggil fungsi 'wayang'

    wayang();

    include ("./includes/mula.php");

?>

<!DOCTYPE html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/penempahan.css">


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

                    <div class="container">

                        <div class="row" id="title">

                            <h3> Penempahan </h3>

                        </div>

                        <div id="main">

                        <?php

                            //Memaparkan info setiap wayang

                            for ($counter = 0; $counter < $count; $counter ++){

                                if ($counter % 2 == 0){

                                    echo '
                                    <div class="row movieSelection">

                                        <div class="poster" style="width:20%;">
            
                                            <center>
            
                                                <img class="portrait" src="./img/';

                                                    echo ($dataWayang[$counter]['urlGambar']);

                                                echo '" style="display:inline-block;">
        
                                            </center>
                                    
                                        </div>
                                    
                                        <div class="row" style="width:80%;padding:30px;">
            
                                            <div class="info" style="color:white;margin-right:20px;">

                                                <h2 style="font-weight:900;">';
                                                    echo ($dataWayang[$counter]['namaWayang']);
                                                echo '</h2>
            
                                                <p style="font-size:18px;">'; 

                                                    echo ($dataWayang[$counter]['infoWayang']); 

                                                echo'</p>
            
                                            </div>
            
                                            <h3 class="tempoh">';
                                            echo $dataWayang[$counter]['tempohWayang'] . " minit";
                                            echo '</h3>
                                            <form action="pemilihanTarikh.php" method="POST">
                                                <button class="buyButton" style="margin-right:0;" type="submit" name="wayang" value="';
                                                    echo $dataWayang[$counter]['idWayang'];
                                                echo '">Beli Tiket</button>
                                            </form>
                                            
                                        </div>

                                    </div>';

                                } else {
                                    
                                    echo '
                                        <div class="row movieSelection">

                                            <div class="row" style="width:80%;padding:30px;">
                
                                                <div class="info" style="color:white;text-align: right;">
                                                
                                                    <h2 style="font-weight:900;">';
                                                        echo ($dataWayang[$counter]['namaWayang']);
                                                    echo '</h2>
        
                                                    <p style="font-size:18px;">'; 

                                                        echo ($dataWayang[$counter]['infoWayang']);  

                                                    echo'</p>
                
                                                </div>
                
                                                <h3 class="tempoh">';
                                                echo $dataWayang[$counter]['tempohWayang'] . " minit";
                                                echo '</h3>
                                                <form action="pemilihanTarikh.php" method="POST" style="text-align: right;">
                                                    <button class="buyButton" type="submit" name="wayang" value="';
                                                    echo $dataWayang[$counter]['idWayang'];
                                                    echo '">Beli Tiket</button>

                                                </form>
                                                
                                            </div>';
          
                                    echo '
                                            <div class="poster" style="width:20%;">
        
                                                <center>
        
                                                    <img class="portrait" src="./img/';

                                                        echo ($dataWayang[$counter]['urlGambar']);

                                                    echo '" style="display:inline-block;">
        
                                                </center>

                                            </div>
                                    
                                        </div>';
                                                                      
                                }
                            }

                        ?>

                        </div>

                    </div>

                </div>
            
            </div>

        </div>

    </body>

</html>
