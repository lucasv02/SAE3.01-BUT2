<?php

//Il n’y a qu’un seul administrateur web enregistré dans la base de données (login:adminweb,mdp: adminweb).
//Ces identifiants sont obligatoires et ne doivent pas être changés.
//• L’administrateur web se connecte
//• L’administrateur web peut voir la liste des utilisateurs inscrits.
//• Il peut créer des comptes utilisateurs à partir d’un fichier csv.
//• Il peut supprimer des comptes utilisateurs et l’historique liés à ces comptes. Un fichier de log inhérent
//à ces suppression est créé et consultatble ultérieurement.


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
  <title>Relax Maths - Historique Admin</title>
  <link rel="stylesheet" href="css/construction.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="stylesheet" href="css/historique.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
</head>';

echo '<body>';

if (isset($_SESSION['login']) && $_SESSION['login'] && isset($_SESSION['permission']) && $_SESSION['permission'] === 'admin_web') {
    include 'php/menu-c.php';

    $cnx = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($cnx->connect_error) {
        die("Erreur de connexion : " . $cnx->connect_error);
    }

    $sql_log = "SELECT u.id, u.login, u.permission FROM utilisateur u ORDER BY u.id";

    $stmt_log = $cnx->prepare($sql_log);
    $stmt_log->execute();
    $result_log = $stmt_log->get_result();

    echo '
    <script src="../js/accueil.js"></script>
    <div class="text-content">
      <h1>Liste des utilisateurs</h1>';

    if ($result_log->num_rows > 0) {
        echo '<table class="histo_crypto">
            <tr>
              <th>ID</th>
              <th>Login</th>
              <th>Rôle</th>
            </tr>';

        while ($row = $result_log->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['login']) . "</td>
                    <td>" . htmlspecialchars($row['permission']) . "</td>
                  </tr>";
        }

        echo '</table>';
    } else {
        echo "<p>Aucun utilisateurs enregistré dans la base de donnée.</p>";
    }

    echo '</div>';
    $stmt_log->close();

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