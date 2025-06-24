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

    $login = $_POST['identifiant'];
    $password = md5($_POST['password']);

    print($password);
    echo $_POST['password'];


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

        // Préparation des données pour le log
        $action = "Connexion d'un utilisateur";
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

        $id_utilisateur = $_SESSION['id'];
        // Insertion dans la table admin_log
        $stmtLog = mysqli_prepare($cnx, "INSERT INTO admin_log (id_utilisateur, action, ip_adresse) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmtLog, "iss", $id_utilisateur, $action, $ip);
        mysqli_stmt_execute($stmtLog);
        exit();
    } else {

//        // Échec de connexion : log l'événement
//        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
//        $action = "Échec de connexion pour l'identifiant '$login'";
//
//        // Recherche d'un éventuel ID utilisateur connu (facultatif)
//        $stmtUser = mysqli_prepare($cnx, "SELECT id FROM $table WHERE `login` = ?");
//        mysqli_stmt_bind_param($stmtUser, "s", $login);
//        mysqli_stmt_execute($stmtUser);
//        $resultUser = mysqli_stmt_get_result($stmtUser);
//        $id_utilisateur = null;
//
//        if ($rowUser = mysqli_fetch_assoc($resultUser)) {
//            $id_utilisateur = $rowUser['id'];
//        }
//
//        // Insertion dans admin_log même si id_utilisateur est null
//        $stmtLog = mysqli_prepare($cnx, "INSERT INTO admin_log (id_utilisateur, action, ip_adresse) VALUES (?, ?, ?)");
//        mysqli_stmt_bind_param($stmtLog, "iss", $id_utilisateur, $action, $ip);
//        mysqli_stmt_execute($stmtLog);

        header('Location: /login.php?erreur=1');
        exit(0);
    }
} else {
    header('Location: /login.php?erreur=1');
    exit();
}