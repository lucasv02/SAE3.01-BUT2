<?php

session_start();

// Mise en place du Header
echo '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="img/logo.png" />
  <title>Relax Maths</title>
  <link rel="stylesheet" href="css/construction.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

echo '<body>';


if (isset($_SESSION['login']) && $_SESSION['login']) {
    include 'php/menu-c.php';

        echo'
    <script src="../js/accueil.js"></script>
    
    <div class="text-content">
      <h1>Page en Construction</h1>
      <br>
      <p>Revenez dans deux semaines...</p>
    </div>
    ';
} else {
    include 'php/menu-nc.php';
    echo '
    <div class="text-content">
        <h1>Accès refusé</h1>
        <br>
        <p>Vous devez être authentifié afin d\'accéder à cette page</p>
    </div>';
}



include 'php/footer.php';

echo'
</body>
';



