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
  <script src="/js/menu.js" defer></script> <!--  Téléchargement du JS en mm temps que les pages-->
</head>
<body>

<div class="wrapper">';
// Vérification si un utilisateur est connecté, si oui, le menu connecté apparait, sinon le menu non connecté
if (isset($_SESSION['login']) && $_SESSION['login']) { // isset permet de vérifer si la variable existe dans la session
    include 'php/menu-c.php';

    // Menu personnalisé avec le nom de l'utilsiateur
    echo '
  <div class="content">
    <div class="text-content">
      <h1>Bienvenue ' . htmlspecialchars($_SESSION['identifiant']) . '.</h1>
      <p>Une vidéo de présentation de notre IUT ci-dessous !</p>
    </div>

    <!-- Video -->
    <div class="video">
      <video controls width="800">
        <source src="../img/iut-velizy.mp4" type="video/mp4" />
        Votre navigateur ne prend pas en charge la vidéo.
      </video>
    </div>
  </div>';
} else {
    include 'php/menu-nc.php';// Inclusion du menu non connectée (visiteur)
    echo '
  <script src="js/menu.js"></script>

    <!-- Message pour les visiteurs-->
  <div class="content">
    <div class="text-content">
      <h1>Bienvenue sur Relax Maths</h1>
      <p>Inscrivez-vous pour accéder à nos modules de calcul.</p>
    </div>

    <div class="video">
      <video controls width="800">
        <source src="../img/iut-velizy.mp4" type="video/mp4" />
        Votre navigateur ne prend pas en charge la vidéo.
      </video>
    </div>
  </div>';
}

include 'php/footer.php'; // Bannière bas du site web

echo '</div>
</body>
</html>';
