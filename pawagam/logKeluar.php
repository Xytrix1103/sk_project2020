<?php

    session_start(); //Mulakan sesi yang sama
    session_destroy(); //Memusnahkan sesi
    header("Location: logMasuk.php"); //Menghantar pengguna semula ke laman log masuk
    exit(); //Menamatkan skrip

?>