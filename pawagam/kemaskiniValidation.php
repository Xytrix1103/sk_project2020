<?php

    include ("./includes/mula.php");

    //Memastikan hanya pengguna yang merupakan pengurus serta maklumat dari laman tertentu yang dapat mengakses laman ini
    if($_SESSION['jenis'] != 'pengurus') {
        if(isset($_POST['auth']) && $_POST['auth'] == 'pass') {
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Anda tidak dibenarkan mengakses laman ini. Sila menghubungi pengurus anda untuk maklumat lanjut.')
            window.location.href='./lamanUtama.php';
            </SCRIPT>");
        }
    }

    //Menerima nilai POST dari laman sebelumnya ke dalam pembolehubah
    $nama = $_POST['nama'];
    $noKP = $_POST['noKP'];
    $namaPengguna = $_POST['namaPengguna'];
    $passwordPengguna = $_POST['kataLaluan'];
    $telefon = $_POST['telefon'];
    $id = $_POST['id'];

    //Menerima nilai POST dari data 'jenis' jika wujud
    if(isset($_POST['jenis'])) {
        $jenis = $_POST['jenis'];
    } else {
        $jenis = $_SESSION['jenis'];
    }

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

    //Menentukan query yang ingin dilakukan iaitu melakukan kemaskini ke atas maklumat peribadi pengguna yang mempunyai ID yang sama dengan ID yang diterima malalui borang 
    $sql = "UPDATE pengguna SET namaPengguna = '$nama', noKPPengguna = '$noKP', usernamePengguna = '$namaPengguna', passwordPengguna = '$passwordPengguna', telefonPengguna = '$telefon', jenisPengguna = '$jenis' WHERE idPengguna = '$id'";

    if(isset($_POST['jenis'])) {
        $sql = "UPDATE pengguna SET namaPengguna = '$nama', noKPPengguna = '$noKP', usernamePengguna = '$namaPengguna', passwordPengguna = '$passwordPengguna', telefonPengguna = '$telefon' WHERE idPengguna = '$id'";
    }

    //Menjalankan query
    $keputusan = $hubungan->query($sql);

    //Memaklumkan pengguna bahawa query telah berjaya atau gagal dilakukan, seterusnya menghantarnya semula ke laman sebelumnya
    if ($keputusan == TRUE){
        if(isset($_POST['auth']) && $_POST['auth'] == 'pass') {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Maklumat anda telah berjaya diubah.')
            window.location.href='./akaun.php';
            </SCRIPT>");
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Rekod telah berjaya dikemaskini.')
            window.location.href='./pengguna.php';
            </SCRIPT>");
        }
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Kemaskini/Perubahan gagal dilakukan. Sila cuba semula')
        window.location.href='./pengguna.php';
        </SCRIPT>");
    }

    //Menamatkan hubungan
    $hubungan->close();

?>