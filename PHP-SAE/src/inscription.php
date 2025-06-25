<?php

$message = "";
if (isset($_GET["erreur"])) {
    if ($_GET["erreur"] == 2) {
        $message = "Erreur dans le captcha. Veuillez réessayer.";
    } else {
        $message = "Un compte est déjà existant.";
    }
    $typeMessage = "erreur";
}

if (isset($_GET["ok"])) {
    $message = "Votre compte a été créé avec succès";
    header('Location: /login.php');
    exit();
}

// Mise en place du Header
echo '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="img/logo.png" />
  <title>Relax Maths</title>
  <link rel="stylesheet" href="css/inscription.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="/js/menu.js" defer></script>
</head>
<body>';

include 'php/menu-nc.php';

echo '
  <script src="/js/menu.js" defer></script>
<div class="wrapper">
    <div class="conteneur-formulaire">
        <div class="formulaire">
            <img id="logo" src="img/logo.png" alt="logo représentant une calculatrice" />
            <h1 id="titre-login">Relax Maths</h1>
            <h2 id="explicatif">Inscription sur la plateforme</h2>

            <form action="/php/formulaireBd.php" method="POST">
                <label for="identifiant">Identifiant</label>
                <input type="text" name="identifiant" id="identifiant" placeholder="identifiant" required />

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required />';

include 'php/captcha.php';

echo '
                <p class="message">' . htmlspecialchars($message) . '</p>
                <button class="button-connexion" type="submit">S\'inscrire</button>
            </form>
        </div>
    </div>
</div>';

include 'php/footer.php';

echo '
</body>
</html>';
