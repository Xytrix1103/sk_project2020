<?php

    //Mulakan sesi
    session_start();

    //Memastikan pengguna telah login sebelum mengakses laman ini
    if(!isset($_SESSION['pengguna'])) {
        header("Location: logMasuk.php");
        die();
    }

?>