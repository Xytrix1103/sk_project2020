<?php

    // //Mulakan sesi

    session_start();

    //Menentukan zon masa dan tarikh kini

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $tarikh = date('Y-m-d');

    //Mendapatkan nilai laman sebelumnya dengan cara POST

    global $idMT;
    $idMT = $_POST['idMT'];

    global $id;
    $id = $_SESSION['pengguna'];

    global $seat;
    $seat = explode(", ", $_POST['seat']);
    $harga = $_POST['jualan'];

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

    //Menentukan query iaitu mendapatkan nilai 'AUTO_INCREMENT' untuk jadual 'tiket'

    $sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'pawagam' AND TABLE_NAME = 'tiket'";
    
    //Menjalankan query

    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan 'data' jika query berjaya dilakukan

    if ($keputusan == true) {

        $data = [];

        while ($baris = $keputusan->fetch_assoc()) {

            array_push($data, $baris);

        }

        unset($keputusan);

    }

    $idTiket = $data[0]['AUTO_INCREMENT'];

    //Menentukan query iaitu memasukkan maklumat ka dalam jadual 'tiket'



    $sql = "INSERT INTO tiket(idTiket, idPengguna, idMT, tarikhJualan, jualanTiket) VALUES ('$idTiket', '$id', '$idMT', '$tarikh', '$harga')";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);

    //Menentukan sama ada query telah berjaya dilakukan

    if ($keputusan == TRUE){

        $pass = true;

    } else {

        echo "Error" . $sql . "<br>" . $hubungan->error;

    }

    if ($pass == true) {

        unset($keputusan);
        unset($pass);

    }

    //Menentukan query iaitu mendapatkan nilai 'AUTO_INCREMENT' untuk jadual 'tempat_duduk'

    $sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'pawagam' AND TABLE_NAME = 'tempat_duduk'";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan global 'dataTD' jika query berjaya dilakukan

    if ($keputusan == true) {

        $dataTD = [];

        while ($baris = $keputusan->fetch_assoc()) {

            array_push($dataTD, $baris);

        }

        unset($keputusan);

    }

    $idTD = $dataTD[0]['AUTO_INCREMENT'];

    for ($x = 0; $x < count($seat); $x ++) {

        $TD = $seat[$x];

        //Menentukan query iaitu memasukkan maklumat ke dalam jadual 'tempat_duduk'

        $sql = "INSERT INTO tempat_duduk(idTD, kedudukanTD, idTiket) VALUES ('$idTD', '$TD', '$idTiket')";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Menentukan sama ada query berjaya dilakukan

        if ($keputusan == true) {

            $pass = true;

        } else {
            
            $pass = false;

        }

        $idTD += 1;
        unset($keputusan);

        if($pass == false) {

            $final = false;
            echo "Error" . $sql . "<br>" . $hubungan->error;
            break;     

        }

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
        <link rel="stylesheet" href="./css/tiketPDF.css">

        <title>Loading</title>

    </head>

    <script>

        <?php

            $_SESSION['cetak'] = $_POST['cetak'];

        ?>

        window.open('http://localhost/pawagam/tiketPDF.php');
        window.location.replace("http://localhost/pawagam/lamanUtama.php")

    </script>

</html>