<?php

    session_start();
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_SESSION['file'])){

        $csv = "./muatnaik/" . $_SESSION['file'];

        $csvArray = array_map('str_getcsv', file($csv));

        array_shift($csvArray);

        $counter = count($csvArray);

        $x = 1;

        for ($i = 0; $i < (count($csvArray)); $i++) {
            
            if ($x <= $counter) {            

                $nama = $csvArray[$i][0];
                $noKP = $csvArray[$i][1];
                $username = $csvArray[$i][2];
                $password = $csvArray[$i][3];
                $telefon = $csvArray[$i][4];
                $jenis = $csvArray[$i][5];

                $sql = "INSERT INTO pengguna(namaPengguna, noKPPengguna, usernamePengguna, passwordPengguna, telefonPengguna, jenisPengguna) VALUES ('$nama','$noKP','$username','$password','$telefon','$jenis');";

                $result = $conn->query($sql);

                $x = $x + 1;

            }

        }

        if ($x == $counter + 1){
            
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Anda berjaya memuat naik fail CSV.')
            window.location.href='./pekerja.php';
            </SCRIPT>");

            $conn->close();                

        } else {

            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Anda gagal memuat naik fail CSV anda. Sila cuba sekali lagi.')
            window.location.href='./muatnaikCSV.php';
            </SCRIPT>");

            $conn->close(); 

        }      
    }

?>