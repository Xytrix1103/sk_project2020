<?php

    //Mulakan sesi

    session_start();

    //Mewujudkan hubungan dengan pangkalan data 'pawagam'

    $namaPelayan = "localhost";
    $nama_pengguna = "root";
    $kataLaluan = "";
    $namaPD = "pawagam";
    $usernamePengguna = $_POST['username'];
    
    $hubungan = new mysqli($namaPelayan, $nama_pengguna, $kataLaluan, $namaPD);

    // Menguji hubungan

    if ($hubungan->connect_error) {
        die("connection failed: " . $hubungan->connect_error);
    }

    //Menentukan query yang ingin dilakukan

    $sql = "SELECT * FROM pengguna WHERE usernamePengguna = '$usernamePengguna'";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan 'data' jika query berjaya dilakukan

    if ($hubungan->query($sql) == TRUE){

        $data = [];

        while ($baris = $keputusan->fetch_assoc()) {

            array_push($data, $baris);

        }

    } else {

        echo "Error" . $sql . "<br>" . $hubungan->error;
        
    }

    //Menamatkan hubungan

    $hubungan->close();

    //Menentukan bahawa kata laluan pengguna adakan betul. Jika betul, ID pengguna, nama Pengguna dan jenis pengguna dimasukkan ke dalam pembolehubah sesi agar dapat digunakan oleh laman lain

    if($_POST['kataLaluan'] == $data[0]['passwordPengguna']) {

        $_SESSION['pengguna'] = $data[0]['idPengguna'];
        $_SESSION['nama'] = $data[0]['namaPengguna'];
        $_SESSION['jenis'] = $data[0]['jenisPengguna'];
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Anda telah berjaya log masuk')
        window.location.href='./lamanUtama.php';
        </SCRIPT>");

    } else {

        $_SESSION['pengguna'] = null;
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Sila cuba lagi.')
        window.location.href='./logMasuk.php';
        </SCRIPT>");

    }

?>