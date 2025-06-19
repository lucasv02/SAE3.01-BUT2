<?php

// Récupère les variables d'environnement de env.php
require_once __DIR__ . '/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$cnx = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$table = "utilisateur";


if (isset($_POST['identifiant'], $_POST['password'])) {
    session_start();

    if (!isset($_POST['captcha']) || $_POST['captcha'] != $_SESSION['captcha-result']) {
        header('Location: /inscription.php?erreur=2');
        exit;
    }

    $login = $_POST['identifiant'];
    // chiffrement du mot de passe
    $password = md5($_POST['password']);

    $stmt = mysqli_prepare($cnx, "SELECT `login`, `password` FROM $table WHERE `login` = ? AND `password` = ?");
    mysqli_stmt_bind_param($stmt, "ss", $login, $password);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);

    if (!$resultat) {
        error_log("Erreur lors de l'exécution de la requête SELECT: " . mysqli_error($cnx));
        die("Erreur lors de l'exécution de la requête");
    }

    if (mysqli_num_rows($resultat) == 1) {
        header('Location: /inscription.php?erreur=1');
    } else {

        $stmtInsert = mysqli_prepare($cnx, "INSERT INTO $table (`login`, `password`) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmtInsert, "ss", $login, $password);
        mysqli_stmt_execute($stmtInsert);
        header('Location: /inscription.php?ok=1');
    }
}