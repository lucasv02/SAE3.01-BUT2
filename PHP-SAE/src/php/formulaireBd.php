<?php

// Connexion à la base de données
$cnx=mysqli_connect("di2s6.myd.infomaniak.com","di2s6_sae","saqfy8-tutxus-xeDzaq"); // Connexion à MySQL (aucun mot de passe spécifié, à sécuriser dans un environnement de production)
$bd=mysqli_select_db($cnx,"di2s6_sae"); // Sélection de la base de données "auth"
$table="utilisateur"; // Nom de la table dans la base de données

if (isset($_POST['ok'], $_POST['login'], $_POST['password'])) {
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    $password =


    $sql = "SELECT `login`,`password` from utilisateur where `login`='$login' and `password`='md5$password';";
    $resultat = mysqli_query($cnx,$sql);

    if (mysqli_num_rows($resultat)==1) {
        header('Location: /inscription.php?erreur=1');
    }
    else {
        $sqlInsert = "INSERT INTO $table (login,password) VALUES ('$login','$password');";
        mysqli_query($cnx,$sqlInsert);
    }
}




//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Insère un nouvel utilisateur avec le login et le mot de passe soumis
//$sqlInser="INSERT INTO $table (login, password) VALUES ('$login', '$password')";
//mysqli_query($cnx,$sqlInser); // Exécution de la requête d'insertion
//}