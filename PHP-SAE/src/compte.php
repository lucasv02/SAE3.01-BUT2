<?php

session_start();

echo '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Bienvenue sur ton compte</title>
  
</head>';

echo '<body>
    <h1>Bienvenue sur ton compte</h1>
    <p>Votre identifiant : ' . htmlspecialchars($_SESSION['identifiant']) . '</p>
    <a href="deconnexion.php">Déco</a>
</body>';