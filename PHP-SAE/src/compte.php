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
  <link rel="stylesheet" href="css/compte.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

echo '<body>';

if (isset($_SESSION['login']) && $_SESSION['login']) {

    include 'php/menu-c.php';
    echo '
  <script src="/js/accueil.js"></script>

  <div class="text-content">
    <h1>Bienvenue sur votre espace' . htmlspecialchars($_SESSION['identifiant']) . '.!</h1>
      <br>
    <p>Revenez dans deux semaines, plus de features seront disponibles.</p>
    </div>

    <form action="changer_mdp.php" method="POST" class="form-changer-mdp">
        <h2>Changer le mot de passe</h2>
        <div class="form-group">
            <label for="ancien_mdp">Ancien mot de passe :</label>
            <input type="password" name="ancien_mdp" id="ancien_mdp" required>
        </div>

    <div class="form-group">
        <label for="nouveau_mdp">Nouveau mot de passe :</label>
        <input type="password" name="nouveau_mdp" id="nouveau_mdp" required>
    </div>

    <button type="submit" class="btn-submit">Changer</button>
    </form>

  ';
} else {
    header('Location: index.php');
}
