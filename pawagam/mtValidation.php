<?php

    //Mulakan sesi

    session_start();

    //Menentukan zon masa

    date_default_timezone_set("Asia/Kuala_Lumpur");

    //Mendapatkan nilai borang melalui cara POST

    $idWayang = $_POST['movie'];
    $tarikhTayangan = explode("-", $_POST['tarikh']);
    $masaTayangan = str_replace(":", "", $_POST['masa']);
    $tarikhKini = explode("-", date("Y-m-d"));
    $masaKini = str_replace(":", "", date("H:i"));
    $bilik = $_POST['bilik'];
    $harga = $_POST['harga'];
    $counter = 1;

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

    //Tentukah sama ada masa tayangan tersebut telah lepas atau belum lepas

    if ($tarikhTayangan[0] > $tarikhKini[0]) {

        $validation = true;
        $x = 1;

    } elseif ($tarikhTayangan[0] == $tarikhKini[0]) {

        if ($tarikhTayangan[1] > $tarikhKini[1]) {

            $validation = true;
            $x = 1;

        } elseif ($tarikhTayangan[1] == $tarikhKini[1]) {

            if ($tarikhTayangan[2] > $tarikhKini[2]) {

                $validation = true;
                $x = 1;

            } elseif ($tarikhTayangan[2] == $tarikhKini[2]) {
                
                if ($masaTayangan > $masaKini) {

                    $validation = true;
                    $x = 1;

                } else {

                    $validation = false;
                    $x = 0;

                }

            } else {

                $validation = false;
                $x = 0;

            }

        } else {

            $validation = false;
            $x = 0;

        }

    } else {

        $validation = false;
        $x = 0;

    }

    //Jika masa tayangan yang ingin dimasukkan adalah dalam masa depan, maklumat dimasukkan ke dalam jadual 'maasa_tayangan'

    if($x == $counter) {

        if ($validation === true) {

            $tarikhTayangan = $_POST['tarikh'];
            $masaTayangan = $_POST['masa'] . ":00";
            $tarikhMasa = $tarikhTayangan . " " . $masaTayangan;
    
            $sql = "INSERT INTO masa_tayangan (tarikhmasaMT, idBilik, idWayang, hargaMT) VALUES ('$tarikhMasa','$bilik','$idWayang','$harga')";
    
            $keputusan = $hubungan->query($sql);

            $pass = true;
            
        } else {

            $pass = false;       

        }

    } else {

        $pass = false;

    }

    //Menentukan sama ada maklumat telah dimasukkan ke dalam pangkalan data

    if ($pass == true) {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Anda berjaya masukkan masa tayangan.')
        window.location.href='./masaTayangan.php';
        </SCRIPT>");

        //Menamatkan hubungan

        $hubungan->close();         

    } else {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Anda gagal masukkan masa tayangan. Sila cuba lagi.')
        window.location.href='./masaTayangan.php';
        </SCRIPT>");

        //Menamatkan hubungan

        $hubungan->close();

    }

?>