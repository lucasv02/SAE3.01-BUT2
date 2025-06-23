<?php
session_start();
session_destroy();

require_once __DIR__ . '/php/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');


$cnx = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Préparation des données pour le log
$action = "Deconnexion d'un utilisateur";
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
$id_utilisateur = $_SESSION['id'];

// Insertion dans la table admin_log
$stmtLog = mysqli_prepare($cnx, "INSERT INTO admin_log (id_utilisateur, action, ip_adresse) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmtLog, "iss", $id_utilisateur, $action, $ip);
mysqli_stmt_execute($stmtLog);

header('Location: /index.php');
exit;
?>