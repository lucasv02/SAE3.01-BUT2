<?php

$cnx = mysqli_connect("di2s6.myd.infomaniak.com", "di2s6_sae", "saqfy8-tutxus-xeDzaq");
$bd = mysqli_select_db($cnx, "di2s6_sae");//on choisi la base de donnée
$table = "utilisateur"; //nom de table dans la BDD


if (isset($_POST['identifiant']) && isset($_POST['password'])) {
    $login = $_POST['identifiant'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM $table WHERE `login`='.$login.' AND `password`='.$password.'";
    $resultat = mysqli_query($cnx, $sql);

    if (mysqli_num_rows($resultat)==1) {
        session_start();
        $_SESSION["login"] = true;
        $_SESSION['identifiant'] = $login;
        $_SESSION['password'] = $password;
        header('Location ../compte.php');

    }
    else {
        header('Location ../connexion.php?erreur=1');
        exit(0);
    }
}