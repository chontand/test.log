<?php

require 'DBanek.php';

if (isset($_POST['addAnekdot'])) {
    session_start();
    if (!empty($_POST['anekdot'])) {
        $anekdot = htmlspecialchars($_POST['anekdot']);
        $kat = $_POST['kategories_naw'];
        $hodnota = 0;
        $point = [];
        $id = "a" . uniqid();
        $width = 0;
        $time =  date('Y-m-d H:i:s');
        $volil = [];

        $_SESSION['anekdot'] = $anekdot;


        addAnekdot($data, $id,  $_SESSION['username'], $kat, $anekdot, $point, $hodnota,  $width, $time, $volil);


        header('Location: ../index.php#');
    } else {
        $_SESSION['anekdot_error'] = 'Pole musí být vyplněno.';
        header("Location:" . $_SERVER['HTTP_REFERER']);
    }
}
