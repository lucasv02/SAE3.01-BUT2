<?php
session_start();

require_once __DIR__ . '/php/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

// Supprimer une ligne de l'historique crypto
if (isset($_POST['delete-crypto-entry']) && isset($_SESSION['id'])) {
    $entry_id = intval($_POST['delete-crypto-entry']);
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }
    $id_utilisateur = $_SESSION['id'];
    $sql_delete_entry = "DELETE FROM historique_crypto WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql_delete_entry);
    $stmt->bind_param("ii", $entry_id, $id_utilisateur);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: historique.php?deleted=1");
    exit;
}

// Supprimer une ligne de l'historique proba
if (isset($_POST['delete-proba-entry']) && isset($_SESSION['id'])) {
    $entry_id = intval($_POST['delete-proba-entry']);
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }
    $id_utilisateur = $_SESSION['id'];
    $sql_delete_entry = "DELETE FROM historique_proba WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql_delete_entry);
    $stmt->bind_param("ii", $entry_id, $id_utilisateur);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: historique.php?deleted=1");
    exit;
}


// Supprimer l'historique crypto
if (isset($_POST['delete-crypto-history']) && isset($_SESSION['id'])) {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }
    $id_utilisateur = $_SESSION['id'];

    $sql_delete_crypto = "DELETE FROM historique_crypto WHERE user_id = ?";
    $stmt_delete_crypto = $conn->prepare($sql_delete_crypto);
    $stmt_delete_crypto->bind_param("i", $id_utilisateur);
    $stmt_delete_crypto->execute();
    $stmt_delete_crypto->close();
    $conn->close();
    header("Location: historique.php?deleted=1");
    exit;
}


// Supprimer l'historique proba
if (isset($_POST['delete-proba-history']) && isset($_SESSION['id'])) {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }
    $id_utilisateur = $_SESSION['id'];

    $sql_delete_proba = "DELETE FROM historique_proba WHERE user_id = ?";
    $stmt_delete_proba = $conn->prepare($sql_delete_proba);
    $stmt_delete_proba->bind_param("i", $id_utilisateur);
    $stmt_delete_proba->execute();
    $stmt_delete_proba->close();
    $conn->close();
    header("Location: historique.php?deleted=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="img/logo.png"/>
    <title>Relax Maths - Historique</title>
    <link rel="stylesheet" href="css/construction.css"/>
    <link rel="stylesheet" href="css/general.css"/>
    <link rel="stylesheet" href="css/historique.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="/js/menu.js" defer></script>
</head>

<body>
<div class="wrapper">

    <?php
    if (isset($_SESSION['login']) && $_SESSION['login']) {
        include 'php/menu-c.php';

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_error) {
            die("Erreur de connexion : " . $conn->connect_error);
        }

        $id_utilisateur = $_SESSION['id'];

        // Crypto
        $sql_crypto = "SELECT * FROM historique_crypto WHERE user_id = ? ORDER BY date_action DESC";
        $stmt_crypto = $conn->prepare($sql_crypto);
        $stmt_crypto->bind_param("i", $id_utilisateur);
        $stmt_crypto->execute();
        $result_crypto = $stmt_crypto->get_result();

        echo '<div class="text-content">';
        echo '<h1>Historique des opérations Cryptographie</h1>';

        if ($result_crypto->num_rows > 0) {
            echo '<table class="histo_crypto">
      <thead>
        <tr>
          <th>Méthode</th>
          <th>Message</th>
          <th>Résultat</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>';

            while ($row = $result_crypto->fetch_assoc()) {
                echo '<tr>
        <td>' . htmlspecialchars($row['methode']) . '</td>
        <td>' . htmlspecialchars($row['message']) . '</td>
        <td>' . htmlspecialchars($row['resultat']) . '</td>
        <td>' . htmlspecialchars($row['date_action']) . '</td>
        <td>
          <form method="post" action="historique.php" onsubmit="return confirm(\'Supprimer cette entrée ?\');">
            <input type="hidden" name="delete-crypto-entry" value="' . intval($row['id']) . '">
            <button type="submit" class="delete-history-btn">Supprimer</button>
          </form>
        </td>
      </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo "<p>Aucun historique enregistré pour l'instant.</p>";
        }

        echo '
    <form method="post" action="historique.php" class="delete-crypto-history-form" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer tout votre historique ? Cette action est irréversible.\');">
      <button type="submit" name="delete-crypto-history" class="delete-history-btn">
        Supprimer tout l\'historique
      </button>
    </form>
  ';
        echo '</div>';
        $stmt_crypto->close();

        // Proba
        $sql_proba = "SELECT * FROM historique_proba WHERE user_id = ? ORDER BY date_action DESC";
        $stmt_proba = $conn->prepare($sql_proba);
        $stmt_proba->bind_param("i", $id_utilisateur);
        $stmt_proba->execute();
        $result_proba = $stmt_proba->get_result();

        echo '<div class="text-content">';
        echo '<h1>Historique des opérations Probabilité</h1>';

        if ($result_proba->num_rows > 0) {
            echo '<table class="histo_proba">
      <thead>
        <tr>
          <th>Moyenne</th>
          <th>Ecart-type</th>
          <th>Borne supérieure</th>
          <th>Nombre de subdivisions</th>
          <th>Résultat</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>';

            while ($row = $result_proba->fetch_assoc()) {
                echo '<tr>
        <td>' . htmlspecialchars($row['moyenne']) . '</td>
        <td>' . htmlspecialchars($row['ecart_type']) . '</td>
        <td>' . htmlspecialchars($row['borne_sup']) . '</td>
        <td>' . htmlspecialchars($row['nb_subdivision']) . '</td>
        <td>' . htmlspecialchars($row['resultat']) . '</td>
        <td>' . htmlspecialchars($row['date_action']) . '</td>
        <td>
          <form method="post" action="historique.php" onsubmit="return confirm(\'Supprimer cette entrée ?\');">
            <input type="hidden" name="delete-proba-entry" value="' . intval($row['id']) . '">
            <button type="submit" class="delete-history-btn">Supprimer</button>
          </form>
        </td>
      </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo "<p>Aucun historique enregistré pour la probabilité pour l'instant.</p>";
        }

        echo '
    <form method="post" action="historique.php" class="delete-proba-history-form" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer tout votre historique ? Cette action est irréversible.\');">
      <button type="submit" name="delete-proba-history" class="delete-history-btn">
        Supprimer tout l\'historique
      </button>
    </form>
  ';
        echo '</div>';
        $stmt_proba->close();
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
    ?>

</div>
</body>
</html>
