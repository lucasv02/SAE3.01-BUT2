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
  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

include 'php/menu-nc.php';

echo '<body>

    <div class="conteneur-formulaire">
        <div class="formulaire">
            <img id="logo" src="img/logo.png" alt="logo représentant une calculatrice">
            <h1 id="titre-login">Relax Maths</h1>
            <p id="explicatif">Connectez-vous à votre compte</p>

            <form action="login.php" method="post">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" placeholder="Adresse mail" required>
                <br>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <a id="mdp-oublie" href="mdpOublie.php">Mot de passe oublié ?</a>
                <br>
                <button class="button-connexion" type="submit">Connexion</button>
            </form>
        </div>
    </div>

</body>';

include 'php/footer.php';
