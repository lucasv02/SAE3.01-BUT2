<?php
session_start();
require_once __DIR__ . '/php/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$message_resultat = 'En attente de saisie de paramètres...';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = isset($_POST['message']) ? $_POST['message'] : null;
    $action = isset($_POST['chiffrer_dechiffrer']) ? $_POST['chiffrer_dechiffrer'] : null;
    $message_chiffre = null;

    if ($message !== null && $action !== null) {
        if ($action == 'chiffrer') {
            $message_chiffre = chiffrer($message);
            $message_resultat = "$message_chiffre est votre message chiffré.";
        } elseif ($action == 'dechiffrer') {
            $message_chiffre = dechiffrer($message);
            $message_resultat = "$message_chiffre est votre message déchiffré.";
        }

        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            $donnees = $conn->real_escape_string($message);
            $resultat = $conn->real_escape_string($message_chiffre);
            $methode = $conn->real_escape_string($action);
            $date_action = date('Y-m-d H:i:s');

            $sql = "INSERT INTO historique_crypto (user_id, date_action, message, methode, resultat) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issss", $user_id, $date_action, $donnees, $methode, $resultat);
            $stmt->execute();

            if ($stmt->error) {
                echo "Erreur d'insertion : " . $stmt->error;
            }
        }
    } elseif ($message !== null && $action == null) {
        $message_resultat = "Erreur : vous n'avez pas sélectionné l'action à effectuer sur votre message.";
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

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="img/logo.png"/>
    <title>Relax Maths</title>
    <link rel="stylesheet" href="css/crypto.css"/>
    <link rel="stylesheet" href="css/general.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet"/>
    <script src="/js/menu.js" defer></script>
</head>
<body>

<?php
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    include 'php/menu-c.php';
    echo '
<script src="/js/menu.js"></script>
<main class="cryptographie">
  <div class="formulaire">
    <div class="titre">
      <h1>Module de Cryptographie</h1>
    </div>
    <div class="intro">
      <p>Entrez le message que vous souhaitez chiffrer à l&apos;aide du système ADFGVX.</p>
    </div>
    <div class="formulaire_crypto">
      <form id="formulaire_crypto" method="post" action=" ">
        <div class="form-group">
          <label for="message">Message :</label>
          <input type="text" id="message" name="message" placeholder="Exemple : perdu" required />
        </div>
        <div class="form-group">
        <label for="chiffrer_dechiffrer">Mode :</label>
          <select id="chiffrer_dechiffrer" name="chiffrer_dechiffrer">
            <option value="chiffrer">Chiffrer</option>
            <option value="dechiffrer">Déchiffrer</option>
          </select>
        </div>
        <button type="submit" class="btn-submit">Valider</button>
      </form>
    </div>
  </div>
  <div class="resultat">
    <p>' . (isset($message_resultat) ? htmlspecialchars($message_resultat) : '') . '</p>
  </div>
</main>';
    include 'php/footer.php';
} else {
    include 'php/menu-nc.php';
    echo '
  <script src="/js/menu.js" defer></script>
  <main>
    <div class="text-content">
      <h1>Accès refusé</h1>
      <p>Vous devez être authentifié afin d&apos;accéder à cette page</p>
    </div>
  </main>';
    include 'php/footer.php';
}
?>

</body>
</html>
