<?php

    function wayang() {

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

        //Menentukan query iaitu mendapatkan segala maklumat daripada jadual 'wayang'

        $sql = "SELECT * FROM wayang";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Masukkan data ke dalam tatasusunan global 'dataWayang' jika query berjaya dilakukan

        if ($hubungan->query($sql) == TRUE){

            global $dataWayang;
            $dataWayang = [];

            while ($baris = $keputusan->fetch_assoc()) {

                array_push($dataWayang, $baris);

            }

        } else {

            echo "Error" . $sql . "<br>" . $hubungan->error;

        }

        //Menamatkan hubungan

        $hubungan->close();

        //Memulangkan pembolehubah global 'count'
        
        global $count;
        $count = count($dataWayang);
        return $count;

    }

    function MT ($wayang) {

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

        //Menentukan query iaitu mendapatkan maklumat daripada jadual masa_tayangan

        $sql = "SELECT idMT, DATE(tarikhMasaMT) AS tarikhMT, TIME_FORMAT(TIME(tarikhMasaMT), '%h:%i %p') AS masaMT, hargaMT FROM masa_tayangan WHERE idWayang = '$wayang' ORDER BY UNIX_TIMESTAMP(tarikhMasaMT) ASC";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Masukkan data ke dalam tatasusunan global 'dataMTInfo' jika query berjaya dilakukan

        if ($hubungan->query($sql) == TRUE){

            global $dataMTInfo;
            $dataMTInfo = [];

            while ($baris = $keputusan->fetch_assoc()) {

                array_push($dataMTInfo, $baris);

            }

        } else {

            echo "Error" . $sql . "<br>" . $hubungan->error;

        }

        //Menamatkan hubungan

        $hubungan->close();

    }

    function tarikhUnik($wayang) {

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

        //Menentukan query iaitu mendapatkan maklumat daripada jadual 'masa_tayangan'

        $sql = "SELECT DATE(tarikhMasaMT) AS tarikh FROM masa_tayangan WHERE idWayang = '$wayang' ORDER BY UNIX_TIMESTAMP(tarikhMasaMT) ASC";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Masukkan data ke dalam tatasusunan global 'dataTarikhUnik' jika query berjaya dilakukan
    
        if ($hubungan->query($sql) == TRUE){

            global $dataTarikhUnik;
            $dataTarikhUnik = [];

            while ($baris = $keputusan->fetch_assoc()) {

                array_push($dataTarikhUnik, $baris);

            }
            
        } else {

            echo "Error" . $sql . "<br>" . $hubungan->error;
            
        }

        //Menamatkan hubungan
    
        $hubungan->close();

    }

    function masaMT ($wayang, $tarikh) {

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

        //Menentukan query iaitu mendapatkan maklumat daripada jadual 'masa_tayangan'

        $sql = "SELECT TIME_FORMAT(TIME(tarikhMasaMT), '%h:%i %p')  AS masaMT FROM masa_tayangan WHERE idWayang = '$wayang' AND DATE(tarikhMasaMT) = '$tarikh' ORDER BY UNIX_TIMESTAMP(tarikhMasaMT) ASC";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Masukkan data ke dalam tatasusunan global 'dataMasaMT' jika query berjaya dilakukan
    
        if ($hubungan->query($sql) == TRUE){

            global $dataMasaMT;
            $dataMasaMT = [];

            while ($baris = $keputusan->fetch_assoc()) {

                array_push($dataMasaMT, $baris);

            }

        } else {

            echo "Error" . $sql . "<br>" . $hubungan->error;

        }

        //Menamatkan hubungan

        $hubungan->close();

    }

    function bilikMT($wayang, $tarikh, $masa) {

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

        //Menentukan query iaitu mendapatkan maklumat daripada jadual 'masa_tayangan'
    
        $sql = "SELECT * FROM masa_tayangan WHERE idWayang = '$wayang' AND DATE(tarikhMasaMT) = '$tarikh' AND TIME_FORMAT(TIME(tarikhMasaMT), '%h:%i %p') = '$masa'";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Masukkan data ke dalam tatasusunan global 'dataBilikMT' jika query berjaya dilakukan
    
        if ($hubungan->query($sql) == TRUE){

            global $dataBilikMT;
            $dataBilikMT = [];

            while ($baris = $keputusan->fetch_assoc()) {

                array_push($dataBilikMT, $baris);

            }

        } else {

            echo "Error" . $sql . "<br>" . $hubungan->error;

        }

        //Mengisytiharkan dan memeberikan nilai kepada pembolehubah global 'idBilik' dan 'idMT'
        
        global $idBilik;
        $idBilik = $dataBilikMT[0]['idBilik'];
        global $idMT;
        $idMT = $dataBilikMT[0]['idMT'];

        //Menamatkan hubungan

        $hubungan->close();
        
    }

    function bilik($idBilik) {

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

        //Menentukan query iaitu mendapatkan maklumat daripada jadual 'bilik'

        $sql = "SELECT * FROM bilik WHERE idBilik = '$idBilik'";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Masukkan data ke dalam tatasusunan global 'dataBilik' jika query berjaya dilakukan
    
        if ($hubungan->query($sql) == TRUE){

            global $dataBilik;
            $dataBilik = [];

            while ($baris = $keputusan->fetch_assoc()) {

                array_push($dataBilik, $baris);

            }

        } else {

            echo "Error" . $sql . "<br>" . $hubungan->error;

        }

        //Menamatkan hubungan

        $hubungan->close();

    }

    function hargaMT($idMT) {

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

        //Menentukan query iaitu mendapatkan maklumat daripada jadual 'masa_tayangan'

        $sql = "SELECT hargaMT FROM masa_tayangan WHERE idMT = '$idMT'";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Masukkan data ke dalam tatasusunan global 'dataHarga' jika query berjaya dilakukan

        if ($hubungan->query($sql) == TRUE){

            global $dataHarga;
            $dataHarga = [];

            while ($baris = $keputusan->fetch_assoc()) {

                array_push($dataHarga, $baris);

            }

        } else {

            echo "Error" . $sql . "<br>" . $hubungan->error;

        }

        //Menamatkan hubungan

        $hubungan->close();

    }

    function TDTiket($tarikh, $masa) {

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

        //Menentukan query iaitu mendapatkan maklumat daripada gabungan jadual 'tiket' dan 'masa_tayangan'

        $sql = "SELECT tiket.idTiket FROM tiket INNER JOIN masa_tayangan WHERE DATE(masa_tayangan.tarikhMasaMT) = '$tarikh' AND TIME_FORMAT(TIME(masa_tayangan.tarikhMasaMT), '%h:%i %p') = '$masa' AND tiket.idMT = masa_tayangan.idMT";

        //Menjalankan query

        $keputusan = $hubungan->query($sql);

        //Masukkan data ke dalam tatasusunan global 'dataTDTiket' jika query berjaya dilakukan

        if ($hubungan->query($sql) == TRUE){

            global $dataTDTiket;
            $dataTDTiket = [];

            while ($baris = $keputusan->fetch_assoc()) {

                array_push($dataTDTiket, $baris['idTiket']);

            }

        } else {

            echo "Error" . $sql . "<br>" . $hubungan->error;

        }

        //Menamatkan hubungan

        $hubungan->close();
    
    }

    function TD($data) {

        //Mengisytiharkan tatasusunan global 'dataTD'

        global $dataTD;
        $dataTD = array();

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

        for ($x = 0; $x < count($data); $x ++) {

            $idTiket = $data[$x];

            //Menentukan query iaitu mendapatkan maklumat daripada jadual 'tempat_duduk'

            $sql = "SELECT kedudukanTD from tempat_duduk WHERE idTiket = '$idTiket'";

            //Menjalankan query

            $keputusan = $hubungan->query($sql);

            //Masukkan data ke dalam tatasusunan global 'dataTD' jika query berjaya dilakukan

            if ($hubungan->query($sql) == TRUE){

                while ($baris = $keputusan->fetch_assoc()) {

                    array_push($dataTD, strval($baris['kedudukanTD']));

                }

            } else {

                echo "Error" . $sql . "<br>" . $hubungan->error;

            }        

        }

        //Menamatkan hubungan

        $hubungan->close();

    }

?>