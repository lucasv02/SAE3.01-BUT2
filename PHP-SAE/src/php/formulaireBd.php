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

        // Récupération de l'id de l'utilisateur inscrit
        $stmtGet = mysqli_prepare($cnx, "SELECT id FROM $table WHERE `login` = ? AND `password` = ?");
        mysqli_stmt_bind_param($stmtGet, "ss", $login, $password);
        mysqli_stmt_execute($stmtGet);
        $resultat = mysqli_stmt_get_result($stmtGet);

        if ($row = mysqli_fetch_assoc($resultat)) {
            $id_utilisateur = $row['id'];

            // Préparation des données pour le log
            $action = "Ajout d’un utilisateur";
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

            // Insertion dans la table admin_log
            $stmtLog = mysqli_prepare($cnx, "INSERT INTO admin_log (id_utilisateur, action, ip_adresse) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmtLog, "iss", $id_utilisateur, $action, $ip);
            mysqli_stmt_execute($stmtLog);
        }

    }
}