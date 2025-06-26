<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . '/php/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$message_resultat = 'En attente de saisie de paramètres...';

/*
 * Méthode de calcul de la loi normale
 * @point_median (float) : point médian
 * @moyenne (float) : moyenne
 * @ecart_type (float) : écart type
 * @return (float) : résultat du calcul
 */
function loi_normale($point_median, $moyenne, $ecart_type)
{
    if ($ecart_type <= 0) {
        return 0;
    }
    return (1 / ($ecart_type * sqrt(2 * pi()))) * exp(-0.5 * pow(($point_median - $moyenne) / $ecart_type, 2));
}


/*
 * Méthode de calcul des rectangles
 * @moyenne (float) : moyenne
 * @ecart_type (float) : écart type
 * @borne_sup (float) : borne supérieure
 * @nb_rectangle (float) : nombre de rectangles
 * @return (float) : résultat du calcul
 */
function methode_rectangles($moyenne, $ecart_type, $borne_sup, $nb_rectangle)
{
    $borne_inf = $moyenne - (6 * $ecart_type);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et validation
    $moyenne = $_POST['moyenne'];
    $ecart_type = $_POST['ecart_type'];
    $borne_sup = $_POST['borne_sup'];
    $nb_rectangle = $_POST['nb_rectangle'];

    if ($ecart_type !== null && $borne_sup !== null && $nb_rectangle !== null) {
        if ($ecart_type <= 0) {
            $message_resultat = "Erreur : L'écart-type doit être positif.";
        } elseif ($nb_rectangle <= 0) {
            $message_resultat = "Erreur : Le nombre de rectangles doit être positif.";
        } elseif ($nb_rectangle > 5000000) {
            $message_resultat = "Erreur : Le nombre de rectangles doit être inférieur ou égal à 5 000 000.";
        } else {
            $resultat = methode_rectangles($moyenne, $ecart_type, $borne_sup, $nb_rectangle);

            if ($resultat !== null && $resultat !== "valeurs_non_cohérentes") {
                $message_resultat = "Le résultat de l'intégrale est : " . $resultat;

                if (isset($_SESSION['id'])) {
                    $user_id = $_SESSION['id'];
                    $date_action = date("Y-m-d H:i:s");
                    $resultat_str = (string)$resultat;

                    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
                    if (!$conn->connect_error) {
                        $stmt = $conn->prepare("INSERT INTO historique_proba (user_id, date_action, moyenne, ecart_type, borne_sup, nb_subdivision, resultat) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("issddis", $user_id, $date_action, $moyenne, $ecart_type, $borne_sup, $nb_rectangle, $resultat_str);
                        $stmt->execute();
                        $stmt->close();
                        $conn->close();
                    }
                }
            } elseif ($resultat == "valeurs_non_cohérentes") {
                $message_resultat = "Les valeurs saisies ne produisent pas de résultats mathématiques cohérents.";
            } else {
                $message_resultat = "Erreur : Le calcul n'a pas pu être effectué.";
            }
        }
    } else {
        $message_resultat = "Erreur : certaines valeurs sont manquantes.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="img/logo.png"/>
    <title>Relax Maths - Module Calcul</title>
    <link rel="stylesheet" href="css/general.css"/>
    <link rel="stylesheet" href="css/proba.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet"/>
    <script src="/js/menu.js" defer></script>
</head>
<body>
<div class="wrapper">

    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>

        <?php include 'php/menu-c.php'; ?>
        <main class="modules-calcul">
            <div class="formulaire">
                <div class="titre">
                    <h1>Modules de Calcul</h1>
                </div>
                <div class="intro">
                    <p>Sélectionnez vos paramètres de calcul et obtenez vos résultats en un clic.</p>
                </div>
                <div class="formulaire_calc">
                    <form id="formulaire_calc" method="POST" action=" ">
                        <div class="form-group">
                            <label for="moyenne">Moyenne :</label>
                            <input type="number" step="0.01" id="moyenne" name="moyenne"
                                   placeholder="Entrez la valeur de la moyenne." required/>
                        </div>
                        <div class="form-group">
                            <label for="ecart_type">Ecart type :</label>
                            <input type="number" min="0.1" step="0.01" id="ecart_type" name="ecart_type"
                                   placeholder="Entrez la valeur de l'écart type." required/>
                        </div>
                        <div class="form-group">
                            <label for="borne_sup">Borne supérieure :</label>
                            <input type="number" step="0.01" id="borne_sup" name="borne_sup"
                                   placeholder="Entrez la valeur de la borne supérieure." required/>
                        </div>
                        <div class="form-group">
                            <label for="nb_rectangle">Nombre de subdivisions :</label>
                            <input type="number" step="1" min="1" id="nb_rectangle" name="nb_rectangle"
                                   placeholder="Entrez le nombre de rectangles médians." required/>
                        </div>
                        <div class="form-group">
                            <p>Méthode des Rectangles</p>
                        </div>
                        <button type="submit" class="btn-submit">Valider</button>
                    </form>
                </div>
            </div>

            <div class="resultat">
                <p><?= htmlspecialchars($message_resultat) ?></p>
            </div>
        </main>

        <?php include 'php/footer.php'; ?>

    <?php else: ?>

        <?php include 'php/menu-nc.php'; ?>
        <script src="/js/menu.js" defer></script>
        <div class="text-content">
            <h1>Accès refusé</h1>
            <p style="margin-top: 1rem;">Vous devez être authentifié afin d'accéder à cette page.</p>
        </div>
        <?php include 'php/footer.php'; ?>

    <?php endif; ?>

</div>
</body>
</html>
