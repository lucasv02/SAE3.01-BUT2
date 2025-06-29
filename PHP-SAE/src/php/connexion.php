
<?php
session_start();

// Récupère les variables d'environnement de env.php
require_once __DIR__ . '/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$cnx = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$table = "utilisateur";

// Si la connexion echoue, c'est le message case 2 dans la page de login + redirection à la page de login.
if (!$cnx) {
    header('Location: /login.php?erreur=2');
    exit();
}

// Vérifie que les données du form sont bien envoyées
if (isset($_POST['identifiant']) && isset($_POST['password'])) {

    // onn stocke le login et le mdp en le chiffrant
    $login = $_POST['identifiant'];
    $password = md5($_POST['password']);

    // Requete SQL
    $stmt = mysqli_prepare($cnx, "SELECT * FROM $table WHERE `login` = ? AND `password` = ?");
    mysqli_stmt_bind_param($stmt, "ss", $login, $password);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);

    // Si on trouve un utilisateur
    if (mysqli_num_rows($resultat) == 1) {
        $row = mysqli_fetch_assoc($resultat); // on récupère la ligne entière

        // On stock ces infos dans la session
        $_SESSION["login"] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['identifiant'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['permission'] = $row['permission'];
        header('Location: /index.php'); // on retourne vers l'accueil en mode connecté

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

        // Échec de connexion --> Tentative de log
        $action = "Échec de connexion pour l'identifiant '$login'";
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
        $id_utilisateur = null;
        // Vérifie si l'utilisateur existe pour récupérer son ID
        $stmtUser = mysqli_prepare($cnx, "SELECT id FROM utilisateur WHERE `login` = ?");
        mysqli_stmt_bind_param($stmtUser, "s", $login);
        mysqli_stmt_execute($stmtUser);
        $resultUser = mysqli_stmt_get_result($stmtUser);


        // On vérifie si le user existe quand même
        if ($rowUser = mysqli_fetch_assoc($resultUser)) {
            $id_utilisateur = $rowUser['id']; // Si oui, on recup son id pour le log
        }

        $stmtLog = mysqli_prepare($cnx, "INSERT INTO admin_log (id_utilisateur, action, ip_adresse) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmtLog, "iss", $id_utilisateur, $action, $ip);
        mysqli_stmt_execute($stmtLog);

        header('Location: /login.php?erreur=1');
        exit();
    }
} else {
    header('Location: /login.php?erreur=1');
    exit();
}
