<?php
session_start();

// Load environment variables from env.php
require_once __DIR__ . '/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$cnx = mysqli_connect($db_host, $db_user, $db_pass);
$bd = mysqli_select_db($cnx, $db_name);
$table = "utilisateur";

if (isset($_POST['identifiant']) &&
    isset($_POST['password']) &&
    isset($_POST['captcha']) &&
    isset($_SESSION['captcha-result'])
) {
    // Vérifie si le captcha est correct
    if ($_POST['captcha'] != $_SESSION['captcha-result']) {
        header("location: /login.php?erreur=2");
        exit();
    }


    $login = $_POST['identifiant'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM $table WHERE `login`='$login' AND `password`='$password'";
    $resultat = mysqli_query($cnx, $sql);

    if (mysqli_num_rows($resultat) == 1) {
        $_SESSION["login"] = true;
        $_SESSION['identifiant'] = $login;
        $_SESSION['password'] = $password;
        header('Location: /index.php');
        exit();
    } else {
        header('Location: /login.php?erreur=1');
        exit(0);
    }
} else {
    header('Location: /login.php?erreur=1');
    exit();
}