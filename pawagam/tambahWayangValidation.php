<?php

    //Mulakan sesi

    session_start();
        
    //Memastikan hanya pengguna yang merupakan pengurus yang dapat mengakses laman ini

    include ("./includes/pengurusValidation.php");

    $dir_sasaran = "img/";
    $fail_sasaran = $dir_sasaran . basename($_FILES["imej"]["name"]);
    $muatNaik = 1;
    $jenisFailImej = strtolower(pathinfo($fail_sasaran,PATHINFO_EXTENSION));

    if($jenisFailImej != "jpg" && $jenisFailImej != "png" && $jenisFailImej != "jpeg"
    && $jenisFailImej != "gif" ) {

        $muatNaik = 0;

    }

    if ($muatNaik == 0) {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Wayang gagal ditambah. Sila cuba lagi.')
        window.location.href='./tambahWayang.php';
        </SCRIPT>");

    } else {

        if (move_uploaded_file($_FILES["imej"]["tmp_name"], $fail_sasaran)) {

            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Wayang telah berjaya ditambah.')
            window.location.href='./tambahWayang.php';
            </SCRIPT>");    

        } else {

            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Wayang gagal ditambah. Sila cuba lagi.')
            window.location.href='./tambahWayang.php';
            </SCRIPT>");

        }

    }

    $urlGambar = basename($_FILES["imej"]["name"]);
    $namaWayang = $_POST['namaWayang'];
    $tempohWayang = $_POST['tempohWayang'];
    $infoWayang = $_POST['infoWayang'];

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

    //Menentukan query

    $sql = "INSERT INTO wayang(namaWayang, infoWayang, tempohWayang, urlGambar) VALUES ('$namaWayang','$infoWayang','$tempohWayang','$urlGambar')";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);
    
    //Memaklumkan pengguna bahawa query telah berjaya atau gagal dilakukan, seterusnya menghantarnya semula ke laman sebelumnya
    
    if ($keputusan == TRUE){

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Wayang baru telah berjaya ditambah.')
        window.location.href='./tambahWayang.php';
        </SCRIPT>");

    } else {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Masa tayangan baru gagal ditambah. Sila cuba lagi.')
        window.location.href='./tambahWayang.php';
        </SCRIPT>");

    }

    //Menamatkan hubungan

    $hubungan->close();
?>