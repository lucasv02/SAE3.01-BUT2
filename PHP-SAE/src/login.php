<?php
session_start();
$message = "";
if (isset($_GET["erreur"])) {
    switch ($_GET["erreur"]) {
        case 1:
            $message = "Erreur de mot de passe ou compte inconnu.";
            break;
        case 2:
            $message = "Erreur de connexion à la base de données.";
    }
}


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
    <script src="/js/menu.js" defer></script>
</head>';



echo '<body>

<div class="wrapper">';

include 'php/menu-nc.php';

echo'
  <script src="/js/menu.js" defer></script>
    <div class="conteneur-formulaire">
        <div class="formulaire">
            <img id="logo" src="img/logo.png" alt="logo représentant une calculatrice">
            <h1 id="titre-login">Relax Maths</h1>
            <h2 id="explicatif">Connectez-vous à votre compte</h2>

            <form action="/php/connexion.php" method="POST">
                <label for="identifiant">Identifiant</label>
                <input type="text" name="identifiant" id="identifiant" placeholder="identifiant" required>
                <br>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <a id="mdp-oublie" href="mdpOublie.php">Mot de passe oublié ?</a>
                <br>';
            echo'                
                <p class="message">'.$message.'</p>
                <br>
                <button class="button-connexion" type="submit">Connexion</button>
            </form>
        </div>
    </div>';

include 'php/footer.php';

echo'
</div>
</body>';



