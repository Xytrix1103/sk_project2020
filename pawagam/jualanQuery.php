<?php

    include ("./includes/pengurusValidation.php");

    //Mengisytiharkan pembolehubah global
    global $dataBaru;
    $dataBaru = [];
    global $pass;

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

    //Menentukan query iaitu mendapatkan semua nilai 'idWayang' dan 'namaWayang' dari jadual 'wayang'
    $sql = "SELECT idWayang, namaWayang FROM wayang";

    //Menjalankan query
    $keputusan = $hubungan->query($sql);

    //Masukkan data ke dalam tatasusunan global 'data' jika query berjaya dilakukan
    if($keputusan == true) {
        global $data;
        $data = [];
        while ($baris = $keputusan->fetch_assoc()) {
            array_push($data, $baris);
        }
    } else {
        echo "Error" . $sql . "<br>" . $hubungan->error;
    }

    //Pembolehubah 'keputusan' dimusnahkan
    unset($keputusan);

    //Menentukan query SQL yang kedua iaitu menggabungkan jadual 'tiket' dan 'masa_tayangan', kemudian mendapatkan 'idTiket' dan 'jualanTiket' dari jadual 'tiket' serta 'idWayang', 'idBilik', 'tarikhMasaMT' dan nilai bulan dari 'tarikhMasaMT' daripada jadual masa_tayangan
    $sql = "SELECT tiket.idTiket, masa_tayangan.idWayang, masa_tayangan.idBilik, masa_tayangan.tarikhMasaMT, tiket.jualanTiket, EXTRACT(MONTH FROM masa_tayangan.tarikhMasaMT) AS bulan FROM tiket INNER JOIN masa_tayangan WHERE masa_tayangan.idMT = tiket.idMT";

    //Menjalankan query
    $keputusan = $hubungan -> query($sql);

    //Masukkan data ke dalam tatasusunan global 'dataTiket' jika query berjaya dilakukan dan memastikan 'dataTiket' bukan tatasusunan kosong
    if($keputusan == true) {
        global $dataTiket;
        $dataTiket = [];
        while ($baris = $keputusan->fetch_assoc()) {
            array_push($dataTiket, $baris);
        }
        if(count($dataTiket) >= 1) {
            $pass = true;
        } else {
            $pass = false;
        }
    } else {
        echo "Error" . $sql . "<br>" . $hubungan->error;
    }

    //Memusnahkan pembolehubah 'keputusan' sekali lagi
    unset($keputusan);

    //Mendapatkan nama wayang dari jadual wayang berdasarkan ID wayang
    for($x = 0; $x < count($dataTiket); $x++) {
        $id = $dataTiket[$x]['idWayang'];

        //Menentukan query iaitu mendapatkan semua nilai namaWayang dari jadual wayang berdasarkan ID wayang yang ditetapkan
        $sql = "SELECT namaWayang FROM wayang WHERE idWayang = '$id'";

        //Menjalankan query
        $keputusan = $hubungan -> query($sql);

        //Jika query dilakukan dengan berjaya, mengisytiharkan elemen baru iaitu 'namaWayang' dengan nilai keputusan query
        if($keputusan == true) {
            while ($baris = $keputusan->fetch_assoc()) {
                $dataTiket[$x]['namaWayang'] = $baris['namaWayang'];
            }
        } else {
            echo "Error" . $sql . "<br>" . $hubungan->error;
        }
    }

    //Menentukan adakah pengguna telah memilih pilihan wayang dan bulan dalam borang sebelumnya. Berdasarkan pilihan pengguna, pembolehubah baru iaitu tatasusunan 'dataBaru' diwujudkan. Semua nilai dalam 'dataTiket' yang mematuhi pilihan pengguna dimasukkan ke dalam 'dataBaru'
    if(isset($_POST['wayang']) && isset($_POST['bulan'])) {
        if($_POST['wayang'] != null) {
            if($_POST['bulan'] != null) {
                $y = 0;
                for ($x = 0; $x < count($dataTiket); $x ++) {
                    if ($dataTiket[$x]['idWayang'] == $_POST['wayang'] && $dataTiket[$x]['bulan'] == $_POST['bulan']) {
                        $dataBaru[$y]['idTiket'] = $dataTiket[$x]['idTiket'];
                        $dataBaru[$y]['idWayang'] = $dataTiket[$x]['idWayang'];
                        $dataBaru[$y]['idBilik'] = $dataTiket[$x]['idBilik'];
                        $dataBaru[$y]['tarikhMasaMT'] = $dataTiket[$x]['tarikhMasaMT'];
                        $dataBaru[$y]['jualanTiket'] = $dataTiket[$x]['jualanTiket'];
                        $dataBaru[$y]['bulan'] = $dataTiket[$x]['bulan']; 
                        $dataBaru[$y]['namaWayang'] = $dataTiket[$x]['namaWayang'];
                        $y += 1;
                    }
                }
            } else {
                $y = 0;
                for ($x = 0; $x < count($dataTiket); $x ++) {
                    if ($dataTiket[$x]['idWayang'] == $_POST['wayang']) {
                        $dataBaru[$y]['idTiket'] = $dataTiket[$x]['idTiket'];
                        $dataBaru[$y]['idWayang'] = $dataTiket[$x]['idWayang'];
                        $dataBaru[$y]['idBilik'] = $dataTiket[$x]['idBilik'];
                        $dataBaru[$y]['tarikhMasaMT'] = $dataTiket[$x]['tarikhMasaMT'];
                        $dataBaru[$y]['jualanTiket'] = $dataTiket[$x]['jualanTiket'];
                        $dataBaru[$y]['bulan'] = $dataTiket[$x]['bulan']; 
                        $dataBaru[$y]['namaWayang'] = $dataTiket[$x]['namaWayang'];
                        $y += 1;
                    }
                }
            }
        } else {
            if($_POST['bulan'] != null) {
                $y = 0;
                for ($x = 0; $x < count($dataTiket); $x ++) {
                    if ($dataTiket[$x]['bulan'] == $_POST['bulan']) {
                        $dataBaru[$y]['idTiket'] = $dataTiket[$x]['idTiket'];
                        $dataBaru[$y]['idWayang'] = $dataTiket[$x]['idWayang'];
                        $dataBaru[$y]['idBilik'] = $dataTiket[$x]['idBilik'];
                        $dataBaru[$y]['tarikhMasaMT'] = $dataTiket[$x]['tarikhMasaMT'];
                        $dataBaru[$y]['jualanTiket'] = $dataTiket[$x]['jualanTiket'];
                        $dataBaru[$y]['bulan'] = $dataTiket[$x]['bulan']; 
                        $dataBaru[$y]['namaWayang'] = $dataTiket[$x]['namaWayang'];
                        $y += 1;
                    }
                }
            } else {
                unset($dataBaru);
            }
        }
    } else {
        unset($dataBaru);
    }

    //Nilai 'wayang' dan 'bulan' melalui cara POST dimusnahkan jika wujud untuk mengelakkan kekeliruan
    if(isset($_POST['wayang']) && isset($_POST['bulan'])) {
        unset($_POST['wayang']);
        unset($_POST['bulan']);
    }

?>