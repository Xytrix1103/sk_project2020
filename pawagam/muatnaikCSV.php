<?php

    //Mulakan sesi

    session_start();

    //Memastikan pengguna telah login sebelum mengakses laman ini

    if(!isset($_SESSION['pengguna'])) {
        header("Location: logMasuk.php");
        die();
    }
        
    //Memastikan hanya pengguna yang merupakan pengurus yang dapat mengakses laman ini

    if($_SESSION['jenis'] != 'pengurus') {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Anda tidak dibenarkan mengakses laman ini. Sila menghubungi pengurus anda untuk maklumat lanjut.')
        window.location.href='./lamanUtama.php';
        </SCRIPT>");
    }

?>

<!DOCTYPE html>

    <head>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <meta name="viewport" content="width = device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/muatnaikCSV.css">

        <title>Cinema HSY - Fail CSV</title>

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
                            <li><a href="pilihanPendaftaran.php" class="active">Pendaftaran Pengguna Baru</li>   
                            <ul>
                                <li><a href="pendaftaran.php" class="">Masukkan Data</li>
                                <li><a href="muatnaikCSV.php" class="active">Muat Naik Fail CSV</li>
                            </ul>
                            <li><a href="pengguna.php" class="">Jadual Pengguna</a></li>
                            <li><a href="jualan.php" class="">Rekod Jualan</a></li>
                            
                        </ul>

                    </div>

                    <a role="button" id="logoutButton" href="logKeluar.php">Log Keluar</a>

                </div> 

                <div id="main-body" style="width:80%"> 
                
                    <div class="container" id="pendaftaran">

                        <div class="row" id="title">

                            <h3> Muat Naik Fail CSV </h3>

                        </div>

                        <form id="upload" action="muatnaikValidation.php" method="POST" enctype="multipart/form-data">

                            <h5>Pilih Fail CSV untuk Dimuat Naik:</h5>

                            <input class="upload" type="file" name="failMN" id="failMN">

                            <input class="upload" type="submit" value="Muat Naik Fail" name="submit">
                            
                        </form>
                    
                        <div id="uploadFile">

                            <?php   

                                //Mendapatkan maklumat dari fail CSV yang telah dimuatnaik dalam jenis string lalu menjadikannya suatu tatasusunan. Kemudian, data dalam tatasusunan tersebut dipaperkan dalam bentuk jadual. Jika tiada fail yang dimuatnaik, jadual kosong akan dipaparkan.

                                if(isset($_SESSION['fail'])){

                                    $csv = "./muatnaik/" . $_SESSION['fail'];

                                    $csvArray = array_map('str_getcsv', file($csv));

                                    array_shift($csvArray);

                                    echo ("<h3 style='margin:30px;'>Fail CSV: ");
                                    echo ($_SESSION['fail']);
                                    echo ("</h3>");

                                    echo ('
                                    
                                    <table>
                                    
                                        <tr style="font-weight:bold;">
                                        
                                            <td>Nama Pengguna</td>
                                            <td>No KP Pengguna</td>
                                            <td>Username Pengguna</td>
                                            <td>Password Pengguna</td>
                                            <td>Telefon Pengguna</td>
                                            <td>Jenis Pengguna</td>

                                        </tr>

                                    ');

                                    for ($counter = 0; $counter < count($csvArray); $counter++){
                                        echo ('<tr>');
                                        for ($counter2 = 0; $counter2 < count($csvArray[0]); $counter2++){

                                            echo ('<td>');
                                            echo (strval($csvArray[$counter][$counter2]));
                                            echo ('</td>');    
                                        }
                                        echo ('</tr>');
                                    }
                                    echo ('</table>');

                                } else {
                                    echo ("<h3 style='margin:30px;'>Fail CSV: ");
                                    echo ("</h3>");

                                    echo ('
                                    
                                    <table>
                                    
                                        <tr style="font-weight:bold;">
                                        
                                            <td>Nama Pengguna</td>
                                            <td>No KP Pengguna</td>
                                            <td>Username Pengguna</td>
                                            <td>Password Pengguna</td>
                                            <td>Telefon Pengguna</td>
                                            <td>Jenis Pengguna</td>

                                        </tr>

                                    </table>

                                    ');              

                                }

                            ?>

                            <!-- Butang ini akan memaparkan mesej timbul yang memerlukan pengesahan pengguna untuk meneruskan. Jika mendapat pengesahan, maklumat akan dihantar ke fail insertValidation.php. -->

                            <a role="button" id="CSVsubmit" href="insertValidation.php" onclick="return confirm('Adakah anda ingin masukkan data fail CSV ke dalam pangkalan data?')">Masukkan Data Fail CSV ke dalam Pangkalan Data</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>
