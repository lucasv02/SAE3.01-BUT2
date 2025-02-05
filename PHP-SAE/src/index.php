<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message_resultat = '';

function calculerIntegral($a, $n) {
    if ($n <= 0) {
        return 0;
    }
    $somme = 0;
    for ($k = 0; $k < $n; $k++) { // formule somme des rectangle
        $a_k = pow($a, $k); // a^k
        $somme += $a_k;  // On ajoute f(a^k) à la somme
    }
    return $somme;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Vérification et récupération des valeurs
    $esperance = ($_POST['esperance']) ;
    $forme = ($_POST['forme']);
    $valeur_t = ($_POST['valeur_t']);
    $n =($_POST['n']);

    if ($esperance === null || $n === null || $n <= 0) {
        $message_resultat = "Erreur : certaines valeurs sont manquantes ou incorrectes.";
    } else {
        $resultat = calculerIntegral($esperance, $n);
        $message_resultat = "Le résultat du calcul est : " . $resultat;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" />
    <title>Relax Maths - Module Calcul</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modules.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
<header>
    <div class="banniere_haute">
        <img src="img/banniere_haut.svg" alt="Bannière haute">
    </div>
    <nav>
        <a href="#" class="nav-icon" aria-label="Homepage" aria-current="page">
            <img src="img/logo.png" alt="Logo Relax Maths">
            <span>Relax Maths</span>
        </a>
        <div class="main-navlinks">
            <button type="button" class="hamburger" aria-label="Barre Navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="navlinks-container">
                <a href="index.html">Accueil</a>
                <a href="modules.html">Modules</a>
                <a href="historique.html">Historique</a>
            </div>
        </div>
        <div class="nav-authentication">
            <a href="login.html" class="user-toggler" aria-label="Page de connexion">
                <img src="img/user.svg" alt="Icône utilisateur">
            </a>
            <div class="sign-btns">
                <a href="index.html" type="button" aria-label="Se connecter">
                    <button type="button" aria-label="Déconnexion">Déconnexion</button>
                </a>
            </div>
        </div>
    </nav>
</header>

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
                    <label for="esperance">Espérance :</label>
                    <input type="number" id="esperance" name="esperance" placeholder="Entrez une valeur pour l'espérance" required>
                </div>
                <div class="form-group">
                    <label for="forme">Forme :</label>
                    <input type="text" id="forme" name="forme" placeholder="Entrez la forme (par ex. linéaire)" required>
                </div>
                <div class="form-group">
                    <label for="valeur_t">Valeur t :</label>
                    <input type="text" id="valeur_t" name="valeur_t" placeholder="La valeur t tel que P(X <= t)" required>
                </div>

                <div class="form-group">
                    <label for="n">Nombre de subdivisions (n) :</label>
                    <input type="number" id="n" name="n" placeholder="Entrez le nombre de n" required>
                </div>

                <div class="form-group">
                    <p>Méthode des Rectangle</p>
                </div>
                <button type="submit" class="btn-submit">Valider</button>
            </form>
        </div>

        <?php if (!empty($message_resultat)) : ?>
            <div class="resultat">
                <p><?php echo htmlspecialchars($message_resultat); ?></p>
            </div>
        <?php endif; ?>

    </div>
</main>

<script src="js/accueil.js"></script>

<footer>
    <div class="banniere_bas">
        <img src="img/banniere_bas.svg" alt="Bannière basse">
    </div>
</footer>
</body>
</html>
