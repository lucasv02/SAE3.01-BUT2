<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$message_resultat = 'En attente de saisie de paramètres...'; // Déplacement de cette ligne en dehors du bloc POST

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Vérification et récupération des valeurs
    $moyenne = ($_POST['moyenne']) ;
    $ecart_type = ($_POST['ecart_type']) ;
    $borne_sup = ($_POST['borne_sup']) ;
    $nb_rectangle = ($_POST['nb_rectangle']);

    if ($ecart_type !== null  && $borne_sup !== null && $nb_rectangle !== null) {
        if (($ecart_type <= 0)){
            $message_resultat = "Erreur : L'écart-type est inférieur ou égal à 0, veuillez saisir une valeur positive.";
        } else if (($nb_rectangle <= 0)) {
            $message_resultat = "Erreur : Le nombre de rectangles médians est inférieur ou égal à 0, veuillez saisir une valeur positive.";
        } else if (($nb_rectangle > 5000000)) {
            $message_resultat = "Veuillez saisir un nombre de rectangles médians inférieur ou égal à 5 000 000.";
        } else {
            $resultat = methode_rectangles($moyenne, $ecart_type, $borne_sup, $nb_rectangle);
            // Vérification si le résultat est nul
            if ($resultat !== null) {
                $message_resultat = "Le résultat de l'intégrale est : " . $resultat;
            }
            if ($resultat == "valeurs_non_cohérentes") {
                $message_resultat = "Les valeurs saisies ne produisent pas de résultats mathématiques cohérents.\n Veuillez saisir de nouvelles valeurs plus adaptées.";
            }
            else if ($resultat == null) {
                $message_resultat = "Erreur : Le calcul n'a pas pu être effectué.";
            }
        }
    } else {
        $message_resultat = "Erreur : certaines valeurs sont manquantes.";
    }
}

function loi_normale($point_median, $moyenne, $ecart_type) {
    // Vérification que l'écart-type est positif
    if ($ecart_type <= 0) {
        return 0; // Si l'écart-type est incorrect, on retourne 0
    }

    // Calcul de la loi normale
    return (1/(sqrt(2 * pi()*$ecart_type))) * (exp(-(1/2)*((($point_median - $moyenne)/$ecart_type)**2)));  #SEPH

}

function methode_rectangles($moyenne, $ecart_type, $borne_sup, $nb_rectangle) {
    $borne_inf = -5*$ecart_type;
    $largeur_rect = ($borne_sup - $borne_inf) / $nb_rectangle;
    $res = 0.0;

    for ($i = 0; $i < $nb_rectangle; $i++) {
        $point_median = $borne_inf + ($i + 0.5) * $largeur_rect;
        $res += loi_normale($point_median, $moyenne, $ecart_type) * $largeur_rect;
    }
    if ($res > 1) {
        return "valeurs_non_cohérentes";
    }
    return $res;
}


echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" />
    <title>Relax Maths - Module Calcul</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/modules.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>
';

echo '<body>';



if (isset($_SESSION['login']) || isset($_SESSION['login']) == true) {

    include 'php/menu-c.php';

echo'
    
<main class="modules-calcul">
    <div class="formulaire">
        <div class="titre">
            <h1>Modules de Calcul</h1>
        </div>

        <div class="intro">
            <p>Sélectionnez vos paramètres de calcul et obtenez vos résultats en un clic.</p>
        </div>

        <!-- Bloc du formulaire -->
        <div class="formulaire_calc">
            <form id="formulaire_calc" method="POST" action="">

                <div class="form-group">
                    <label for="moyenne">Moyenne :</label>
                    <input type="number" step="0.01" id="moyenne" name="moyenne" placeholder="Entrez la valeur de la moyenne." required>
                </div>

                <div class="form-group">
                    <label for="ecart_type">Ecart type :</label>
                    <input type="number" min="0.1" step="0.01" id="ecart_type" name="ecart_type" placeholder="Entrez la valeur de l\'écart type." required>
                </div>

                <div class="form-group">
                    <label for="borne_sup">Borne supérieure :</label>
                    <input type="number" step="0.01" id="borne_sup" name="borne_sup" placeholder="Entrez la valeur de la borne supérieure." required>
                </div>

                <div class="form-group">
                    <label for="nb_rectangle">Nombre de subdivisions :</label>
                    <input type="number" step="0.01" id="nb_rectangle" name="nb_rectangle" placeholder="Entrez le nombre de rectangles médians." required>
                </div>

                <div class="form-group">
                    <p>Méthode des Rectangles</p>
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
';

    include 'php/footer.php';
} else {
    include 'php/menu-nc.php';
    echo '
    <div class="text-content">
        <h1>Accès refusée</h1>
        <br>
        <p>Vous devez être authentifier afin d\accéder à cette page</p>
    </div>';

    include 'php/footer.php';
}

echo '</body>';