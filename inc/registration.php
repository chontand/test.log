<?php
require '_fileDB.php';


function clear_data($val)
{
    $val = trim($val);
    $val = stripslashes($val);
    $val = htmlspecialchars($val);
    $val = strip_tags($val);
    return $val;
}

$name = $email = $psw = $psw__repeat = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addNote'])) {
    $name = clear_data($_POST["name"]);
    $email = clear_data($_POST["email"]);
    $psw = clear_data($_POST["pswHash"]);
    $psw__repeat = clear_data($_POST["psw_repeat"]);
    $phone = clear_data($_POST["phone"]);
}


$data = file_get_contents(__DIR__ . '/../DB/notes.json');

$res = json_decode($data, true);
$volil_a = [];


$pattern_phone = '/^([0-9]){9}$/';
$pattern_name = "/^[a-zA-Z]{2,20}\s+[a-zA-Z]{2,20}$/";
$pattern_email = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
$pattern_pass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/';



$err = [];
$flag = 0;
if (isset($_POST['addNote'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!preg_match($pattern_name, $name)) {
            $err['name'] = 'Pouze latinská písmena';
            $flag = 1;
        }
        if (empty($name)) {
            $err['name'] = 'Toto pole je povinné.';
            $flag = 1;
        }
        if (!preg_match($pattern_email, $email)) {
            $err['email'] = '<p class="msg">Nesprávný formát e-mailu</p>';
            $flag = 1;
        }
        if (empty($email)) {
            $err['email'] = '<p class="msg">Toto pole je povinné.</p>';
            $flag = 1;
        }
        for ($j = 0; $j < count($res); $j++) {
            if ($email == $res[$j]['email']) {
                $err['email'] = '<p class="msg">Uživatel s tímto e-mailem již existuje vyberte jiný.</p>';
                $flag = 1;
            }
        }

        if (!preg_match($pattern_pass, $psw)) {
            $err['pswHash'] = '<p class="msg">Musí být velké malé písmeno a číslo</p>';
            $flag = 1;
        }
        if (empty($psw)) {
            $err['pswHash'] = '<p class="msg">Toto pole je povinné.</p>';
            $flag = 1;
        }
        if ($_POST['pswHash'] != $_POST['psw_repeat']) {
            $err['psw_repeat'] = '<p class="msg">Musí být stejné jako předchozí</p>';
            $flag = 1;
        }
        if (empty($psw__repeat)) {
            $err['psw_repeat'] = '<p class="msg">Toto pole je povinné.</p>';
            $flag = 1;
        }
        if (!preg_match($pattern_phone, $phone)) {
            $err['phone'] = '<p class="msg">Musí být devět čísel</p>';
            $flag = 1;
        }
        if (empty($phone)) {
            $err['phone'] = '<p class="msg">Toto pole je povinné.</p>';
            $flag = 1;
        }
    }
    if ($flag == 0) {
        session_start();
        addNote($data, htmlspecialchars(trim($_POST['name'])), htmlspecialchars(trim($_POST['email'])), htmlspecialchars(trim($_POST['pswHash'])), htmlspecialchars(trim($_POST['psw_repeat'])), htmlspecialchars(trim($_POST['phone'])), $volil_a);
        header("Location:" . $_SERVER['HTTP_REFERER'] .  "#autorization-row");
        $_SESSION['hello'] = 'Hello';
    }
}
