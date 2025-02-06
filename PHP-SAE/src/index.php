<?php

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

include 'php/menu-nc.php';

echo '<body>
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

</body>';

include 'php/footer.php';
