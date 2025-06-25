<?php

session_start();

require_once __DIR__ . '/php/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

// === Import CSV Utilisateurs ===
if (
    isset($_POST['import_csv']) &&
    isset($_FILES['csv_file']) &&
    $_FILES['csv_file']['error'] == UPLOAD_ERR_OK &&
    isset($_SESSION['login']) &&
    $_SESSION['permission'] === 'admin_web'
) {
    $fileTmp = $_FILES['csv_file']['tmp_name'];
    $handle = fopen($fileTmp, 'r');

    if ($handle !== false) {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        fgetcsv($handle, 1000, ','); // Ignore la première ligne

        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $login = trim($data[0]);
            $password = trim($data[1]);
            $permission = isset($data[2]) ? trim($data[2]) : 'utilisateur';

            if ($login && $password) {
                $hashed_password = md5($password);
                $stmt = $conn->prepare("INSERT INTO utilisateur (login, password, permission) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $login, $hashed_password, $permission);
                $stmt->execute();
                $stmt->close();
            }
        }

        fclose($handle);
    }

    header("Location: adminWeb.php?import=success");
    exit();
}


// Méthode de suppression d'un compte utilisateur
if (isset($_POST['delete_user']) && isset($_SESSION['id']) && isset($_SESSION['permission']) && $_SESSION['permission'] === 'admin_web') {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erreur de connexion : . $conn->connect_error");
    }
    $id_utilisateur = isset($_POST['user_id_to_delete']) ? intval($_POST['user_id_to_delete']) : 0;

    // Récupérer la permission de l'utilisateur ciblé
    $sql_check_permission = "SELECT permission FROM utilisateur WHERE id = ?";
    $stmt_check = $conn->prepare($sql_check_permission);
    $stmt_check->bind_param("i", $id_utilisateur);
    $stmt_check->execute();
    $stmt_check->bind_result($permission);
    $stmt_check->fetch();
    $stmt_check->close();

    // Vérifier si la permission interdit la suppression
    if ($permission === 'admin_web' || $permission === 'admin_sys') {
        echo "Erreur : Vous ne pouvez pas supprimer cet utilisateur (admin ou sysadmin).";
    } else {
        // Étape 3 : Supprimer l'utilisateur si autorisé
        $sql_delete_user = "DELETE FROM utilisateur WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete_user);
        $stmt_delete->bind_param("i", $id_utilisateur);
        $stmt_delete->execute();
        $stmt_delete->close();

        echo "Utilisateur supprimé avec succès.";
    }
}


// Méthode de suppression de l'historique de l'utilisateur
if (isset($_POST['delete_historique']) && isset($_SESSION['id']) && isset($_SESSION['permission']) && $_SESSION['permission'] === 'admin_web') {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erreur de connexion : . $conn->connect_error");
    }
    $id_utilisateur = isset($_POST['user_id_to_delete']) ? intval($_POST['user_id_to_delete']) : 0;

    //Pour supprimer l'historique crypto de la base de donn&es
    $sql_delete_crypto = "DELETE FROM historique_crypto WHERE user_id = ?";
    $stmt_delete_crypto = $conn->prepare($sql_delete_crypto);
    $stmt_delete_crypto->bind_param("i", $id_utilisateur);
    $stmt_delete_crypto->execute();
    $stmt_delete_crypto->close();

    //Pour supprimer l'historique proba de la base de donn&es
    $sql_delete_crypto = "DELETE FROM historique_proba WHERE user_id = ?";
    $stmt_delete_crypto = $conn->prepare($sql_delete_crypto);
    $stmt_delete_crypto->bind_param("i", $id_utilisateur);
    $stmt_delete_crypto->execute();
    $stmt_delete_crypto->close();
}


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
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet" />
  <script src="/js/menu.js" defer></script>
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
    <div class="text-content">
      <h1>Liste des utilisateurs</h1>';

    if (isset($_GET['import']) && $_GET['import'] === 'success') {
        echo "<p style='color: green;'>Importation réussie !</p>";
    }

    echo '
    <form action="adminWeb.php" method="post" enctype="multipart/form-data">
        <label for="csv_file">Importer des utilisateurs (CSV) :</label>
        <input type="file" name="csv_file" id="csv_file" accept=".csv" required />
        <button type="submit" name="import_csv">Importer</button>
    </form>
    <br />';

    if ($result_log->num_rows > 0) {
        echo '<table class="histo_crypto">
            <thead>
              <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Rôle</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';

        while ($row = $result_log->fetch_assoc()) {
            $id = htmlspecialchars($row['id'] ?? "Inconnu");
            $login = htmlspecialchars($row['login'] ?? "Inconnu");
            $perm = htmlspecialchars($row['permission'] ?? "Inconnu");

            echo "<tr>
                    <td>$id</td>
                    <td>$login</td>
                    <td>$perm</td>
                    <td>
                      <form method='post' action='adminWeb.php' class='delete-history-form' onsubmit='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.\");'>
                        <input type='hidden' name='user_id_to_delete' value='$id' />
                        <button type='submit' name='delete_user' class='delete-history-btn'>Supprimer cet utilisateur</button>
                        <button type='submit' name='delete_historique' class='delete-history-btn'>Supprimer l&apos;historique</button>
                      </form>
                    </td>
                  </tr>";
        }

        echo '</tbody></table>';
    } else {
        echo "<p>Aucun utilisateur enregistré dans la base de données.</p>";
    }

    echo '</div>';
    $stmt_log->close();

} else {
    include 'php/menu-nc.php';
    echo '
  <script src="/js/menu.js" defer></script>
    <div class="text-content">
        <h1>Accès refusé</h1>
        <br />
        <p>Vous devez être authentifié afin d&apos;accéder à cette page.</p>
    </div>';
}

include 'php/footer.php';
echo '</body></html>';