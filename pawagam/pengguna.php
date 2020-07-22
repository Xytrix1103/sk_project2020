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

    //Menguji hubungan

    if ($hubungan->connect_error) {
        die("Connection failed: " . $hubungan->connect_error);
    }

    //Menentukan query iaitu mendapatkan segala maklumat daripada jadual 'pengguna'

    $sql = "SELECT * FROM pengguna";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan global 'data' jika query berjaya dilakukan

    if ($hubungan->query($sql) == TRUE) {
        
        $data = [];

        while ($baris = $keputusan->fetch_assoc()) {

            array_push($data, $baris);

        }

    } else {

        echo "Error" . $sql . "<br>" . $hubungan->error;

    }

    //Menamatkan hubungan

    $hubungan->close();

?>

<!DOCTYPE html>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/pengguna.css">


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

                            <li><a href="lamanUtama.php" class="">Menu Utama</a></li>
                            <li><a href="akaun.php" class="">Akaun Saya</a></li>
                            <li><a href="penempahan.php" class="">Penempahan Tiket</a></li>
                            <li><a href="pilihanPendaftaran.php" class="">Pendaftaran Pengguna Baru</li>   
                            <ul>
                                <li><a href="pendaftaran.php" class="">Masukkan Data</li>
                                <li><a href="muatnaikCSV.php" class="">Muat Naik Fail CSV</li>
                            </ul>
                            <li><a href="tambahWayang.php" class="">Tambah Wayang</a></li>
                            <li><a href="tambahMT.php" class="">Tambah Masa Tayangan</a></li>
                            <li><a href="pengguna.php" class="active">Jadual Pengguna</a></li>
                            <li><a href="jualan.php" class="">Rekod Jualan</a></li>
                            
                        </ul>

                    </div>

                    <a role="button" id="logoutButton" href="logKeluar.php">Log Keluar</a>

                </div>

                <div id="main-body" style="width:80%">

                    <div class="container" style="width:100%;text-align:center;">

                        <div class="row" id="title">

                            <h3> Jadual Pengguna </h3>   

                        </div>

                        <div class="container" id="main" style="margin-top:4vh;width:100%;">

                            <div class="row" style="width:100%;">

                                <form action="penggunaKemaskini.php" method="POST" id="jadual">

                                    <table class="jadualPengguna">

                                        <thead>

                                            <tr>

                                                <td style="width: 5%;">ID</td>
                                                <td style="width: 15%;">Nama</td>
                                                <td style="width: 15%;">No. KP</td>
                                                <td style="width: 10%;">Username</td>
                                                <td style="width: 15%;">Password</td>
                                                <td style="width: 15%;">Telefon</td>
                                                <td style="width: 15%">Jenis</td>
                                                <td style="width: 10%;"></td>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                                //Memaparkan maklumat dalam tatasusunan 'data' dalam bentuk jadual

                                                for ($x = 0; $x < count($data); $x++) {

                                                    echo '<tr>';

                                                    echo '<td>' . $data[$x]['idPengguna'] . '</td>';
                                                    echo '<td>' . $data[$x]['namaPengguna'] . '</td>';
                                                    echo '<td>' . $data[$x]['noKPPengguna'] . '</td>';
                                                    echo '<td>' . $data[$x]['usernamePengguna'] . '</td>';
                                                    echo '<td>' . $data[$x]['passwordPengguna'] . '</td>';
                                                    echo '<td>' . $data[$x]['telefonPengguna'] . '</td>';
                                                    echo '<td>' . $data[$x]['jenisPengguna'] . '</td>';
                                                    echo '<td>';
                                                    echo '<button class="hantar" type="submit" name="idPengguna" value="';
                                                    echo $data[$x]['idPengguna'] . '">';
                                                    echo 'Ubah';
                                                    echo '</button>';
                                                    echo '</td>';

                                                    echo '</tr>';

                                                }

                                            ?>

                                        </tbody>                              

                                    </table>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
    
        </div>

    </body>

</html>