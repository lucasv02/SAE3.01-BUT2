<?php
session_start();

// Style css
echo "<style>";
include("E:\INF2-FA\SAÉ\SAE_3_01\SAE_Dev_App_Github\PHP-SAE\SAE_Dev_Application\PHP\css\menu.css");
echo "</style>";

// Contenu de la page
echo '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>RelaxMaths</title>
</head>
<body>';

//if ($_SESSION['user_login'] != null) {
    echo ';

echo "<script>";
include("E:\INF2-FA\SAÉ\SAE_3_01\SAE_Dev_App_Github\PHP-SAE\SAE_Dev_Application\PHP\js\menu.js");
echo "</script>";

//} else {
//    echo "
//    <nav class='ButtonMenu'>
//        <a href='connexion.php''>Se connecter</a>
//        <a href='inscription.php'>S'inscrire</a>
//    </nav>";
//}
