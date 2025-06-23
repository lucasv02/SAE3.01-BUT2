<?php
session_start();

// (Décommenter en cas de besoin pour le debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Chargement des variables d'environnement
require_once __DIR__ . '/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

// Connexion à la base de données
$cnx = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$cnx) {
    die("Erreur de connexion à la base de données.");
}

if (
    isset($_POST['identifiant']) &&
    isset($_POST['password']) &&
    isset($_POST['captcha']) &&
    isset($_SESSION['captcha-result'])
) {
    // Vérification du captcha
    if ($_POST['captcha'] != $_SESSION['captcha-result']) {
        header("location: /login.php?erreur=2");
        exit();
    }

    $login = $_POST['identifiant'];
    $password = md5($_POST['password']); // ⚠️ md5 = faible, à améliorer plus tard
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

    // Requête pour vérifier identifiants
    $stmt = mysqli_prepare($cnx, "SELECT * FROM utilisateur WHERE `login` = ? AND `password` = ?");
    mysqli_stmt_bind_param($stmt, "ss", $login, $password);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);

    if (!$resultat) {
        die("Erreur SQL : " . mysqli_error($cnx));
    }

    if (mysqli_num_rows($resultat) === 1) {
        // ✅ Connexion réussie
        $row = mysqli_fetch_assoc($resultat);
        $_SESSION["login"] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['identifiant'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['permission'] = $row['permission'];

        // Journalisation
        $action = "Connexion réussie";
        $id_utilisateur = $row['id'];

        $stmtLog = mysqli_prepare($cnx, "INSERT INTO admin_log (id_utilisateur, action, ip_adresse) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmtLog, "iss", $id_utilisateur, $action, $ip);
        mysqli_stmt_execute($stmtLog);

        header('Location: /index.php');
        exit();
    } else {
        // ❌ Échec de connexion → Tentative de log
        $action = "Échec de connexion pour l'identifiant '$login'";
        $id_utilisateur = null;

        // Vérifie si l'utilisateur existe pour récupérer son ID
        $stmtUser = mysqli_prepare($cnx, "SELECT id FROM utilisateur WHERE `login` = ?");
        mysqli_stmt_bind_param($stmtUser, "s", $login);
        mysqli_stmt_execute($stmtUser);
        $resultUser = mysqli_stmt_get_result($stmtUser);

        if ($rowUser = mysqli_fetch_assoc($resultUser)) {
            $id_utilisateur = $rowUser['id'];
        }

        $stmtLog = mysqli_prepare($cnx, "INSERT INTO admin_log (id_utilisateur, action, ip_adresse) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmtLog, "iss", $id_utilisateur, $action, $ip);
        mysqli_stmt_execute($stmtLog);

        header('Location: /login.php?erreur=1');
        exit();
    }
} else {
    // ❌ Paramètres manquants
    header('Location: /login.php?erreur=1');
    exit();
}
