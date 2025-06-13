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
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

echo'<body>';

if (isset($_SESSION['login']) || isset($_SESSION['login']) == true) {

    include 'php/menu.php';
    echo '
  <script src="/js/accueil.js"></script>

  <div class="content">
    <div class="text-content">
          <h1>Bienvenue ' . htmlspecialchars($_SESSION['identifiant']) . '.</h1>
      <p>Une vidéo explicative de l\application est consultable ci-dessous</p>
    </div>

    <div class ="video">
      <video controls width="800">
        <source src="../img/iut-velizy.mp4" type="video/mp4" />
      </video>
    </div>

  </div>
  ';
}
else {
    include 'php/menu-nc.php';
    echo '
  <script src="/js/accueil.js"></script>

  <div class="content">
    <div class="text-content">
      <h1>Bienvenue sur Relax Maths</h1>
      <p>Inscrivez-vous pour accéder à nos modules de calcul.</p>
    </div>

    <div class ="video">
      <video controls width="800">
        <source src="../img/iut-velizy.mp4" type="video/mp4" />
      </video>
    </div>

  </div>
  ';
}

include 'php/footer.php';

echo'

</body>';


