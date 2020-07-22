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

    //Menerima nilai POST dari laman sebelumnya ke dalam pembolehubah

    $idBilik = $_POST['bilik'];
    $idWayang = $_POST['wayang'];
    $hargaMT = $_POST['harga'];
    $tarikhMasaMT = $_POST['tarikhMasaMT'];

    // Menguji hubungan

    if ($hubungan->connect_error) {
        die("Connection failed: " . $hubungan->connect_error);
    }

    //Menentukan query

    $sql = "INSERT INTO masa_tayangan(idBilik, idWayang, hargaMT, tarikhMasaMT) VALUES ('$idBilik','$idWayang','$hargaMT','$tarikhMasaMT')";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);
    
    //Memaklumkan pengguna bahawa query telah berjaya atau gagal dilakukan, seterusnya menghantarnya semula ke laman sebelumnya
    
    if ($keputusan == TRUE){

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Masa tayangan baru telah berjaya ditambah.')
        window.location.href='./tambahMT.php';
        </SCRIPT>");

    } else {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Masa tayangan baru gagal ditambah. Sila cuba lagi.')
        window.location.href='./tambahMT.php';
        </SCRIPT>");

    }

    //Menamatkan hubungan

    $hubungan->close();

?>