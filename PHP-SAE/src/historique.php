<?php
session_start();

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

    // Connexion à la BDD
    $conn = new mysqli("localhost", "di2s6_sae", "Xipnep-keppa6-netxud", "dis26_sae");
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $id_utilisateur = $_SESSION['id']; // S'assurer que la session contient bien l'id

    $sql = "SELECT * FROM historique WHERE id_utilisateur = ? ORDER BY date_creation DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_utilisateur);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '
    <script src="../js/accueil.js"></script>
    <div class="text-content">
      <h1>Historique des opérations</h1>';

    if ($result->num_rows > 0) {
        echo '<table>
            <tr>
              <th>Type</th>
              <th>Données</th>
              <th>Résultat</th>
              <th>Date</th>
            </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['type']) . "</td>
                    <td>" . htmlspecialchars($row['donnees']) . "</td>
                    <td>" . htmlspecialchars($row['resultat']) . "</td>
                    <td>" . htmlspecialchars($row['date_creation']) . "</td>
                  </tr>";
        }

        echo '</table>';
    } else {
        echo "<p>Aucun historique enregistré pour l'instant.</p>";
    }

    echo '</div>';

    $stmt->close();
    $conn->close();
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
