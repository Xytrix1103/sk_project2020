<?php

    //Mulakan sesi

    session_start();
        
    //Memastikan hanya pengguna yang merupakan pengurus yang dapat mengakses laman ini

    if($_SESSION['jenis'] != 'pengurus') {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Anda tidak dibenarkan mengakses laman ini. Sila menghubungi pengurus anda untuk maklumat lanjut.')
        window.location.href='./lamanUtama.php';
        </SCRIPT>");
    }

    //Mengisytiharkan folder yang akan menyimpankan fail CSV, mendapatkan nama fail CSV yang dimuatnaik serta jenis fail yang dimuatnaik

    $folderSasaran = "muatnaik/";
    $failSasaran = $folderSasaran . basename($_FILES["failMN"]["name"]);
    $pasti = 1;
    $jenisFail = strtolower(pathinfo($failSasaran,PATHINFO_EXTENSION));

    // Memastikan jenis fail ialah CSV

    if($jenisFail != 'csv') {

        $pasti = 0;

    }

    //Memastikan bahawa pengguna telah mengakses laman ini dari laman seterusnya melalui kewujudan 'submit'

    if(isset($_POST["submit"])) {

        $pasti = 1;

    }

    //Jika fail dengan nama sama telah wujud, fail tersebut akan dipadamkan

    if (file_exists($failSasaran)) {    

        unlink($failSasaran);

    }

    //Jika jenis fail bukan CSV, pengguna gagal memasukkan maklumat dan dihantar semula ke laman sebelumnya. Jike tiada masalah, fail CSV dimuatnaik ke folder 'muatnaik'

    if ($pasti == 0) {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Anda gagal memuat naik fail CSV anda. Sila cuba sekali lagi.')
        window.location.href='./muatnaikCSV.php';
        </SCRIPT>");

    } else {

        if (move_uploaded_file($_FILES["failMN"]["tmp_name"], $failSasaran)) {

            $_SESSION['fail'] = basename($_FILES["failMN"]["name"]);
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Anda telah berjaya muat naik fail CSV.')
            window.location.href='./muatnaikCSV.php';   
            </SCRIPT>");

        } else {

            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Anda gagal memuat naik fail CSV anda. Sila cuba sekali lagi.')
            window.location.href='./muatnaikCSV.php';
            </SCRIPT>");

        }

    }

?>