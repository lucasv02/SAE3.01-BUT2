<?php
session_start();

require_once __DIR__ . '/php/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

// Mise en place du Header
echo '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="img/logo.png" />
  <title>Relax Maths - Historique</title>
  <link rel="stylesheet" href="css/construction.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="stylesheet" href="css/historique.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

echo '<body>';

if (isset($_SESSION['login']) && $_SESSION['login']) {
    include 'php/menu-c.php';

    $cnx = new mysqli($db_host, $db_user, $db_pass, $db_name);


    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // Historique de Crypto
    $id_utilisateur = $_SESSION['id']; // ← récupération de l'id utilisateur depuis la session

    $sql_crypto = "SELECT * FROM historique_crypto WHERE user_id = ? ORDER BY date_action DESC";
    $stmt_crypto = $cnx->prepare($sql_crypto);
    $stmt_crypto->bind_param("i", $id_utilisateur);
    $stmt_crypto->execute();
    $result_crypto = $stmt_crypto->get_result();

    echo '
    <script src="../js/accueil.js"></script>
    <div class="text-content">
      <h1>Historique des opérations Cryptographie</h1>';

    if ($result_crypto->num_rows > 0) {
        echo '<table class="histo_crypto">
            <tr>
              <th>Méthode</th>
              <th>Message</th>
              <th>Résultat</th>
              <th>Date</th>
            </tr>';

        while ($row = $result_crypto->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['methode']) . "</td>
                    <td>" . htmlspecialchars($row['message']) . "</td>
                    <td>" . htmlspecialchars($row['resultat']) . "</td>
                    <td>" . htmlspecialchars($row['date_action']) . "</td>
                  </tr>";
        }

        echo '</table>';
    } else {
        echo "<p>Aucun historique enregistré pour l'instant.</p>";
    }

    echo '</div>';
    $stmt_crypto->close();

} else {
    include 'php/menu-nc.php';
    echo '
    <div class="text-content">
        <h1>Accès refusé</h1>
        <br>
        <p>Vous devez être authentifié afin d\'accéder à cette page</p>
    </div>';
}

include 'php/footer.php';

echo '</body></html>';