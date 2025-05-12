<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$message_resultat = 'En attente de saisie de paramètres...'; // Déplacement de cette ligne en dehors du bloc POST

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Vérification et récupération des valeurs
    $message = ($_POST['message']) ;
    $action = ($_POST['chiffrer_dechiffrer']) ;
    $message_chiffre = '';


    if ($message !== null && $action !== null) {
        if ($message !== null && $action == 'chiffrer') {
            $message_chiffre = chiffrer($message);
            $message_resultat = "$message_chiffre est votre message chiffré.";
        } else if ($message !== null && $action == 'dechiffrer') {
            $message_chiffre = dechiffrer($message);
            $message_resultat = "$message_chiffre est votre message de dechiffré.";
        }

    } else if ($message !== null && $action == null) {
        $message_resultat = "Erreur : vous n'avez pas selectionner l'action à effectuer sur votre message. ";
    } else {
        $message_resultat = "Erreur : aucun message n'est saisi.";
    }
}

function chiffrer($message) {
    $lignes = ['A', 'D', 'F', 'G', 'V', 'X'];
    $colonnes = ['A', 'D', 'F', 'G', 'V', 'X'];

    // Grille de l'énoncé (en minuscules pour cohérence)
    $grille = [
        ['G', 'E', 'H', 'I', 'M', 'S'],
        ['C', 'R', 'F', 'T', 'D', 'U'],
        ['N', 'K', 'A', 'B', 'J', 'L'],
        ['O', 'P', 'Q', 'V', 'W', 'X'],
        ['Y', 'Z', '0', '1', '2', '3'],
        ['4', '5', '6', '7', '8', '9']
    ];

    // Création de la table de substitution : lettre -> coordonnées ADFGVX
    $substitution = [];
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 6; $j++) {
            $lettre = $grille[$i][$j];
            $substitution[$lettre] = $lignes[$i] . $colonnes[$j];
        }
    }

    // Nettoyage du message : minuscules, suppression des caractères non valides
    $message = strtolower($message);
    $message = preg_replace('/[^a-z0-9]/', '', $message);  // on garde que a-z et 0-9

    // Chiffrement
    $message_chiffre = '';
    $chars = str_split($message);
    foreach ($chars as $c) {
        if (isset($substitution[$c])) {
            $message_chiffre .= $substitution[$c];
        }
    }

    return $message_chiffre;
}

function dechiffrer($message) {
    $lignes = ['A', 'D', 'F', 'G', 'V', 'X'];
    $colonnes = ['A', 'D', 'F', 'G', 'V', 'X'];

    // Grille de l'énoncé (en minuscules)
    $grille = [
        ['G', 'E', 'H', 'I', 'M', 'S'],
        ['C', 'R', 'F', 'T', 'D', 'U'],
        ['N', 'K', 'A', 'B', 'J', 'L'],
        ['O', 'P', 'Q', 'V', 'W', 'X'],
        ['Y', 'Z', '0', '1', '2', '3'],
        ['4', '5', '6', '7', '8', '9']
    ];

    // Inversion de la grille : coord ADFGVX -> lettre
    $inverse = [];
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 6; $j++) {
            $coord = $lignes[$i] . $colonnes[$j];
            $inverse[$coord] = $grille[$i][$j];
        }
    }

    // Nettoyage du code
    $message = strtoupper($message);
    $message = preg_replace('/[^ADFGVX]/', '', $message);

    // Vérification de la longueur paire
    if (strlen($message) % 2 != 0) {
        return "Erreur : le code doit avoir un nombre pair de caractères.";
    }

    // Déchiffrement
    $dechiffre = '';
    for ($i = 0; $i < strlen($message); $i += 2) {
        $pair = $message[$i] . $message[$i + 1];
        if (isset($inverse[$pair])) {
            $dechiffre .= $inverse[$pair];
        } else {
            $dechiffre .= '?'; // symbole pour erreur de correspondance
        }
    }

    return $dechiffre;
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
  <link rel="stylesheet" href="css/crypto.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

include 'php/menu-c.php';

echo '<body>
<main class="crytpographie">
    <div class="formulaire">
        <div class="titre">
            <h1>Module de Cryptographie</h1>
        </div>

        <div class="intro">
            <p>Entrez le message que vous souhaitez chiffrer à l\'aide du système ADFGVX.</p>
        </div>

        <!-- Bloc du formulaire -->
        <div class="formulaire_crypto">
            <form id="formulaire_crypto" method="POST" action="">

                <div class="form-group">
                    <label for="message">Message :</label>
                    <input type="text" required placeholder="perdu">
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
        <p>';
echo htmlspecialchars($message_resultat);
echo '</p>
    </div>
</main>

<script src="js/accueil.js"></script>

</body>
';

include 'php/footer.php';


