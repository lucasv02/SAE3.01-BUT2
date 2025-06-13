<?php

// Connexion à la base de données
$cnx=mysqli_connect("di2s6.myd.infomaniak.com","di2s6_sae","saqfy8-tutxus-xeDzaq"); // Connexion à MySQL (aucun mot de passe spécifié, à sécuriser dans un environnement de production)
$bd=mysqli_select_db($cnx,"di2s6_sae"); // Sélection de la base de données "auth"
$table="utilisateur"; // Nom de la table dans la base de données

if (isset($_POST['identifiant'], $_POST['password'])) {
    session_start(); // nécessaire pour récupérer la valeur du captcha

    if (!isset($_POST['captcha']) || $_POST['captcha'] != $_SESSION['captcha-result']) {
        header('Location: /inscription.php?erreur=2'); // erreur spéciale captcha
        exit;
    }
    $login = $_POST['identifiant'];
    $password = md5($_POST['password']);


    $sql = "SELECT `login`, `password` FROM $table WHERE `login`='$login' AND `password`='$password'";
    $resultat = mysqli_query($cnx, $sql);

    if (!$resultat) {
        error_log("Erreur lors de l'exécution de la requête SELECT: " . mysqli_error($cnx));
        die("Erreur lors de l'exécution de la requête");
    }

    if (mysqli_num_rows($resultat)==1) {
        header('Location: /inscription.php?erreur=1');
    }
    else {
        $sqlInsert = "INSERT INTO $table (login,password) VALUES ('$login','$password');";
        mysqli_query($cnx,$sqlInsert);
        header('Location: /inscription.php?ok=1');
    }
}