<?php
session_start();

require_once __DIR__ . '/php/env.php';


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
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

echo '<body>';

if (isset($_SESSION['login']) && $_SESSION['login']) {
  include 'php/menu-c.php';


  // Connexion à la BDD à modifer comme formulaireBD
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
  }

  $id_utilisateur = $_SESSION['id']; // S'assurer que la session contient bien l'id

  //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

  // Historique de Crypto
  $sql_crypto = "SELECT * FROM historique_crypto WHERE user_id = ? ORDER BY date_action DESC"; // Requete SQL
  $stmt_crypto = $conn->prepare($sql_crypto); // on prépare la requete dans la BDD
  $stmt_crypto->bind_param("i", $id_utilisateur); // i pour integer / et on lie la varaible id_utilisateur à la requête préparée en remplacant "?" dans la requête
  $stmt_crypto->execute(); // exécution de la requete avec la valeur liée "id_utilisateur"
  $result_crypto = $stmt_crypto->get_result(); // on récupère le résultat sous la forme d'un objet résultat.

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
  //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

  // Historique de Probabilité
  $sql_proba = "SELECT * FROM historique_proba WHERE user_id = ? ORDER BY date_action DESC";
  $stmt_proba = $conn->prepare($sql_proba);
  $stmt_proba->bind_param("i", $id_utilisateur);
  $stmt_proba->execute();
  $result_proba = $stmt_proba->get_result();

  echo '
    <div class="text-content">
      <h1>Historique des opérations Probabilité</h1>';

  if ($result_proba->num_rows > 0) {
    echo '<table>
            <tr>
              <th>Type</th>
              <th>Moyenne</th>
              <th>Ecart-Type</th>
              <th>Borne supérieure</th>
              <th>Nombre de Subdivision</th>
              <th>Résultat</th>
              <th>Date</th>
            </tr>';

    echo "<tr>
                    <td>" . htmlspecialchars($row['moyenne']) . "</td>
                    <td>" . htmlspecialchars($row['ecrat_type']) . "</td>
                    <td>" . htmlspecialchars($row['borne_sup']) . "</td>
                    <td>" . htmlspecialchars($row['nb_subdivision']) . "</td>
                    <td>" . htmlspecialchars($row['resultat']) . "</td>
                    <td>" . htmlspecialchars($row['date_action']) . "</td>
                  </tr>";
    echo '</table>';
  } else {
    echo "<p>Aucun historique enregistré pour la probabilité pour l'instant.</p>";
  }
  echo '</div>';
  $stmt_proba->close();
  $conn->close();

} else {        /* if de connexion */
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
