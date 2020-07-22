<?php

    //Mulakan sesi
    session_start();
        
    //Memastikan hanya pengguna yang merupakan pengurus yang dapat mengakses laman ini
    include ("./includes/pengurusValidation.php");

    //Mewujudkan hubungan dengan pangkalan data 'pawagam'
    $namaPelayan = "localhost";
    $nama_pengguna = "root";
    $kataLaluan = "";
    $namaPD = "pawagam";

    $hubungan = new mysqli($namaPelayan, $nama_pengguna, $kataLaluan, $namaPD);

    // Menguji hubungan
    if ($hubungan->connect_error) {
        die("Connection failed: " . $hubungan->connect_error);
    }

    //Menentukan query iaitu mendapatkan segala maklumat daripada jadual 'pengguna'
    $sql = "SELECT * FROM pengguna";

    //Menjalankan query
    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan 'datapengguna' jika query berjaya dilakukan
    if ($hubungan->query($sql) == TRUE){
        $dataPengguna = [];
        while ($baris = $keputusan->fetch_assoc()) {
            array_push($dataPengguna, $baris);
        }
        unset($keputusan);
    } else {
        echo "Error" . $sql . "<br>" . $hubungan->error;
    }

    //Jika memastikan suatu fail telah dimuatnaik, mendapatkan maklumat dari fail CSV yang telah dimuatnaik dalam jenis string lalu menjadikannya suatu tatasusunan. Seterusnya, semua maklumat dalam fail CSV dimasukkan ke dalam pangkalan data ke dalam jadual 'pengguna'
    if(isset($_SESSION['fail'])){
        $csv = "./muatnaik/" . $_SESSION['fail'];
        $csvArray = array_map('str_getcsv', file($csv));
        array_shift($csvArray);
        $counter = count($csvArray);
        $x = 1;
        for ($i = 0; $i < (count($csvArray)); $i++) {
            if ($x <= $counter) {            
                $nama = $csvArray[$i][0];
                $noKP = $csvArray[$i][1];
                $username = $csvArray[$i][2];
                $kataLaluan = $csvArray[$i][3];
                $telefon = $csvArray[$i][4];
                $jenis = $csvArray[$i][5];
                $sql = "INSERT INTO pengguna(namaPengguna, noKPPengguna, usernamePengguna, passwordPengguna, telefonPengguna, jenisPengguna) VALUES ('$nama','$noKP','$username','$kataLaluan','$telefon','$jenis');";
                $keputusan = $hubungan->query($sql);
                $x = $x + 1;
            }
        }

        //Jika memastikan bahawa semua fail telah dimuatnaik, pengguna dimaklumkan bahawa proses muat naik berjaya dilaksanakan dan dihantar semula ke laman sebelumnya selepas memusnahkan pembolehubah sesi 'fail'
        if ($x == $counter + 1){
            unset($_SESSION['fail']);
            $hubungan->close();         
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Anda berjaya memuat naik fail CSV.')
            window.location.href='./muatnaikCSV.php';
            </SCRIPT>");
        } else {
            unset($_SESSION['fail']);
            $hubungan->close(); 
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Anda gagal memuat naik fail CSV anda. Sila cuba sekali lagi.')
            window.location.href='./muatnaikCSV.php';
            </SCRIPT>");
        }      
    }

?>