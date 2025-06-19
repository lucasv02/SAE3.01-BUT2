<?php
session_start();

$message_resultat = 'En attente de saisie de paramètres...';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = isset($_POST['message']) ? $_POST['message'] : null;
    $action = isset($_POST['chiffrer_dechiffrer']) ? $_POST['chiffrer_dechiffrer'] : null;

    if ($message !== null && $action !== null) {
        if ($action == 'chiffrer') {
            $message_chiffre = chiffrer($message);
            $message_resultat = "$message_chiffre est votre message chiffré.";
        } else if ($action == 'dechiffrer') {
            $message_chiffre = dechiffrer($message);
            $message_resultat = "$message_chiffre est votre message de dechiffré.";
        }
    } else if ($message !== null && $action == null) {
        $message_resultat = "Erreur : vous n'avez pas selectionner l'action à effectuer sur votre message. ";
    } else {
        $message_resultat = "Erreur : aucun message n'est saisi.";
    }
}


/*
 * Méthode de chiffrement
 * @message (string) : message saisi par l'utilisateur à chiffrer
 * @return (string) : message chiffré
 */
function chiffrer($message)
{
    $message = strtoupper($message);
    $message = preg_replace('/[^A-Z0-9]/', '', $message);

    $lignes = ['A', 'D', 'F', 'G', 'V', 'X'];
    $colonnes = ['A', 'D', 'F', 'G', 'V', 'X'];
    $grille = [
        ['G', 'E', 'H', 'I', 'M', 'S'],
        ['C', 'R', 'F', 'T', 'D', 'U'],
        ['N', 'K', 'A', 'B', 'J', 'L'],
        ['O', 'P', 'Q', 'V', 'W', 'X'],
        ['Y', 'Z', '0', '1', '2', '3'],
        ['4', '5', '6', '7', '8', '9']
    ];

    $substitution = [];
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 6; $j++) {
            $lettre = $grille[$i][$j];
            $substitution[$lettre] = $lignes[$i] . $colonnes[$j];
        }
    }

    $message_chiffre = '';
    $chars = str_split($message);
    foreach ($chars as $c) {
        if (isset($substitution[$c])) {
            $message_chiffre .= $substitution[$c];
        }
    }

    return $message_chiffre;
}


/*
 * Méthode de déchiffrement
 * @message (string) : message saisi par l'utilisateur à déchiffrer
 * @return (string) : message déchiffré
 */
function dechiffrer($message)
{
    $lignes = ['A', 'D', 'F', 'G', 'V', 'X'];
    $colonnes = ['A', 'D', 'F', 'G', 'V', 'X'];
    $grille = [
        ['G', 'E', 'H', 'I', 'M', 'S'],
        ['C', 'R', 'F', 'T', 'D', 'U'],
        ['N', 'K', 'A', 'B', 'J', 'L'],
        ['O', 'P', 'Q', 'V', 'W', 'X'],
        ['Y', 'Z', '0', '1', '2', '3'],
        ['4', '5', '6', '7', '8', '9']
    ];

    $inverse = [];
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 6; $j++) {
            $coord = $lignes[$i] . $colonnes[$j];
            $inverse[$coord] = $grille[$i][$j];
        }
    }

    // Met le message en majuscule
    $message = strtoupper($message);
    $message = preg_replace('/[^ADFGVX]/', '', $message);

    if (strlen($message) % 2 != 0) {
        return "Erreur : le code doit avoir un nombre pair de caractères.";
    }

    $dechiffre = '';
    for ($i = 0; $i < strlen($message); $i += 2) {
        $pair = $message[$i] . $message[$i + 1];
        if (isset($inverse[$pair])) {
            $dechiffre .= $inverse[$pair];
        } else {
            $dechiffre .= '?';
        }
    }

    return $dechiffre;
}

echo '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="img/logo.png" />
  <title>Relax Maths</title>
  <link rel="stylesheet" href="css/crypto.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

echo '<body>';

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    include 'php/menu-c.php';
    echo '
<main class="cryptographie">
    <div class="formulaire">
        <div class="titre">
            <h1>Module de Cryptographie</h1>
        </div>
        <div class="intro">
            <p>Entrez le message que vous souhaitez chiffrer à l\'aide du système ADFGVX.</p>
        </div>
        <div class="formulaire_crypto">
            <form id="formulaire_crypto" method="POST" action="">
                <div class="form-group">
                    <label for="message">Message :</label>
                    <input type="text" id="message" name="message" placeholder="Exemple : perdu" required>
                </div>
                <div class="form-group">
                    <select id="chiffrer_dechiffrer" name="chiffrer_dechiffrer">
                        <option value="chiffrer">Chiffrer</option>
                        <option value="dechiffrer">Dechiffrer</option>
                    </select>
                </div>
                <button type="submit" class="btn-submit">Valider</button>
            </form>
        </div>
    </div>
    <div class="resultat">
        <p>' . htmlspecialchars($message_resultat) . '</p>
    </div>
</main>
<script src="js/accueil.js"></script>
';
    include 'php/footer.php';
} else {
    include 'php/menu-nc.php';
    echo '
    <div class="text-content">
        <h1>Accès refusée</h1>
        <br>
        <p>Vous devez être authentifié afin d\'accéder à cette page</p>
    </div>';
    include 'php/footer.php';
}

echo '</body>';