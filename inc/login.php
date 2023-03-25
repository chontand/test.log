<?php

function getUserByEmail($data, $email)
{
    foreach ((array)$data as $user) {
        if ($email == $user['email']) {
            return $user;
        }
    }
    return NULL;
}

$url = __DIR__ . '/../DB/notes.json';
$data = file_get_contents($url);
$res = json_decode($data, true);

if (isset($_SESSION['hello'])) {
    $_SESSION['message'] = 'Vítejte, jste registrováni, přihlaste se!!!';
}
if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $psw = htmlspecialchars($_POST['psw']);
    $user = getUserByEmail($res, $email);

    if ($email && $psw) {
        if ($user) {
            if (password_verify($psw, $user['pswHash'])) {
                session_start();
                $_SESSION['username'] = $user['name'];
                $_SESSION['id'] = $user['id'];
                setcookie('user', $user['email'], time() + 3600, "/");
                header("Location: ../index.php?page=0");
            } else {
                session_start();
                $_SESSION['message'] = 'Nesprávné heslo nebo e-mailová adresa.';
                header("Location: ../index.php#autorization-row");
            }
        } else {
            session_start();
            $_SESSION['message'] = 'Nesprávné heslo nebo e-mailová adresa.';
            header("Location: ../index.php#autorization-row");
        }
    } else {
        session_start();
        $_SESSION['message'] = 'Nesprávné heslo nebo e-mailová adresa.';
        header("Location: ../index.php#autorization-row");
    }

    unset($_SESSION['hello']);
}
