<?php

    //Mulakan sesi

    session_start();

    //Memastikan pengguna telah login sebelum mengakses laman ini

    if(!isset($_SESSION['pengguna'])) {
        header("Location: login.php");
        die();
    }

    //Memastikan hanya pengguna yang merupakan pengurus serta maklumat dari laman tertentu yang dapat mengakses laman ini

    if($_SESSION['jenis'] != 'pengurus') {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Anda tidak dibenarkan mengakses laman ini. Sila menghubungi pengurus anda untuk maklumat lanjut.')
        window.location.href='./lamanUtama.php';
        </SCRIPT>");
    }

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

    //Menguji bahawa semua maklumat diterima melalui cara POST. Jika maklumat-maklumat tertentu dipastikan diterima, nilai diterima ke dalam pembolehubah. Jika maklumat tidak diterima, pengguna dihantar balik ke laman tersebut untuk mengisi maklumat sekali lagi dengan lengkap.

    if(isset($_POST['namaPenggunaBaru']) && isset($_POST['noKPPenggunaBaru']) && isset($_POST['usernamePenggunaBaru']) && isset($_POST['passwordPenggunaBaru']) && isset($_POST['telefonPenggunaBaru']) && isset($_POST['jenisPenggunaBaru'])) {
        
        $namaPenggunaBaru = $_POST['namaPenggunaBaru'];
        $noKPPenggunaBaru = $_POST['noKPPenggunaBaru'];
        $usernamePenggunaBaru = $_POST['usernamePenggunaBaru'];
        $passwordPenggunaBaru = $_POST['passwordPenggunaBaru'];
        $telefonPenggunaBaru  = $_POST['telefonPenggunaBaru'];
        $jenisPenggunaBaru = $_POST ['jenisPenggunaBaru'];

    } else {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Minta maaf, maklumat yang anda masukkan tidak lengkap. Sila cuba sekali lagi dan sila pastikan bahawa semua maklumat telahpun diisikan.')
        window.location.href='./akaun.php';
        </SCRIPT>");

    }

    //Menentukan query yang mendapatkan segala maklumat daripada jadual 'pengguna'

    $sql = "SELECT * FROM pengguna";

    //Menjalankan query

    $keputusan = $hubungan->query($sql);

    //Jika query berjaya dilakukan, data dimasukkan ke dalam tatasusunan 'dataPengguna' dan memusnahkan pembolehubah 'keputusan'

    if ($hubungan->query($sql) == TRUE){

        $dataPengguna = [];

        while ($baris = $keputusan->fetch_assoc()) {

            array_push($dataPengguna, $baris);

        }

        unset($keputusan);

    } else {

        echo "Error" . $sql . "<br>" . $hubungan->error;

    }

    //Membandingkan data yang diterima dengan data yang telah wujud dalam pangkalan data. Jika mempunyai maklumat unik yang sama, pengguna dihantar semula ke laman sebelumnya untuk memasukkan data sekali lagi.

    for ($x = 0; $x < count($dataPengguna); $x++) {

        if($dataPengguna[$x]['noKPPengguna'] == $noKPPenggunaBaru || $dataPengguna[$x]['usernamePengguna'] == $usernamePenggunaBaru || $dataPengguna[$x]['passwordPengguna'] == $passwordPenggunaBaru || $dataPengguna[$x]['telefonPengguna'] == $telefonpenggunaBaru) {

            $validation = false;
            
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Sila cuba lagi. Maklumat yang diisikan sudah wujud dalam sistem.')
            window.location.href='./pendaftaran.php';
            </SCRIPT>");

            break;

        } else {

            $validation = true;

        }

    }

    //Jika maklumat yang diterima dipastikan tidak wujud lagi dalam pangkalan data, maklumat dimasukkan ke dalam pangkalan data.

    if ($validation == true) {
    
        $sql = "INSERT INTO pengguna (`namaPengguna`,`noKPPengguna`,`usernamePengguna`,`passwordPengguna`,`telefonPengguna`,`jenisPengguna`) VALUES ('$namaPenggunaBaru','$noKPPenggunaBaru','$usernamePenggunaBaru','$passwordPenggunaBaru','$telefonPenggunaBaru','$jenisPenggunaBaru')" ;
        $keputusan = $hubungan->query($sql);

    }

    //Memaklumkan pengguna bahawa query telah berjaya atau gagal dilakukan, seterusnya menghantarnya semula ke laman sebelumnya
    
    if ($keputusan == TRUE){

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Pengguna baru telah berjaya didaftar.')
        window.location.href='./pendaftaran.php';
        </SCRIPT>");

    } else {

        echo "Error" . $sql . "<br>" . $hubungan->error;

    }

    //Menamatkan hubungan

    $hubungan->close();

?>