<?php
session_start();

// Load environment variables from env.php
require_once __DIR__ . '/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$cnx = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$table = "utilisateur";

if (
    isset($_POST['identifiant']) &&
    isset($_POST['password']) &&
    isset($_POST['captcha']) &&
    isset($_SESSION['captcha-result'])
) {
    // Check captcha
    if ($_POST['captcha'] != $_SESSION['captcha-result']) {
        header("location: /login.php?erreur=2");
        exit();
    }

    $login = $_POST['identifiant'];
    $password = md5($_POST['password']);

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($cnx, "SELECT * FROM $table WHERE `login` = ? AND `password` = ?");
    mysqli_stmt_bind_param($stmt, "ss", $login, $password);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultat) == 1) {
        $row = mysqli_fetch_assoc($resultat);

        $_SESSION["login"] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['identifiant'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['permission'] = $row['permission'];
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