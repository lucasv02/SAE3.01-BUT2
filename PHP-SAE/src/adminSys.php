<?php
session_start();
require_once __DIR__ . '/php/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

// Suppression de l'historique
if (isset($_POST['delete_all_log']) && isset($_SESSION['id']) && isset($_SESSION['permission']) && $_SESSION['permission'] === 'admin_sys') {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $sql_delete_log = "DELETE FROM admin_log";
    $sql_delete_log = $conn->prepare($sql_delete_log);
    $sql_delete_log->execute();
    $sql_delete_log->close();
}

// Suppression de l'historique ligne par ligne
if (isset($_POST['delete_line']) && isset($_SESSION['id']) && isset($_SESSION['permission']) && $_SESSION['permission'] === 'admin_sys') {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $id_line = isset($_POST['id_to_delete']) ? intval($_POST['id_to_delete']) : 0;

    $sql_delete_log = "DELETE FROM admin_log WHERE idh = ?";
    $sql_delete_log = $conn->prepare($sql_delete_log);
    $sql_delete_log->bind_param("i", $id_line);
    $sql_delete_log->execute();
    $sql_delete_log->close();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="img/logo.png"/>
    <title>Relax Maths - Historique Admin</title>
    <link rel="stylesheet" href="css/construction.css"/>
    <link rel="stylesheet" href="css/general.css"/>
    <link rel="stylesheet" href="css/historique.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet"/>
    <script src="/js/menu.js" defer></script>
</head>
<body>
<?php

if (isset($_SESSION['login']) && $_SESSION['login'] && isset($_SESSION['permission']) && $_SESSION['permission'] === 'admin_sys') {
    include 'php/menu-c.php';


    $cnx = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($cnx->connect_error) {
        die("Erreur de connexion : " . $cnx->connect_error);
    }

    $sql_log = "SELECT al.idh, u.login, al.action, al.ip_adresse, al.date_action FROM admin_log al LEFT JOIN utilisateur u ON al.id_utilisateur = u.id ORDER BY al.date_action DESC";
    $stmt_log = $cnx->prepare($sql_log);
    $stmt_log->execute();
    $result_log = $stmt_log->get_result();
    ?>

    <div class="text-content">
        <h1>Journal de log</h1>

        <?php if ($result_log->num_rows > 0): ?>
            <table class="histo_crypto">
                <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Action</th>
                    <th>Adresse IP</th>
                    <th>Date</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result_log->fetch_assoc()):
                    $id = htmlspecialchars($row['idh'] ?? "Inconnu");?>

                    <tr>
                        <td><?= htmlspecialchars($row['login'] ?? 'Inconnu') ?></td>
                        <td><?= htmlspecialchars($row['action'] ?? 'Inconnu') ?></td>
                        <td><?= htmlspecialchars($row['ip_adresse'] ?? 'Inconnu') ?></td>
                        <td><?= htmlspecialchars($row['date_action'] ?? 'Inconnu') ?></td>
                        <td>
                            <form method='post' action='adminSys.php' class='delete-history-form' onsubmit='return confirm(\"Êtes-vous sûr de vouloir supprimer cette ligne ? Cette action est irréversible.\");'>
                                <input type='hidden' name='id_to_delete' value=<?=$id?> />
                                <button type='submit' name='delete_line' class='delete-history-btn'>Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun log enregistré.</p>
        <?php endif; ?>

        <form method="post" action="adminSys.php"
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tout votre historique ? Cette action est irréversible.');">
            <button type="submit" name="delete_all_log" class="delete-history-btn">
                Supprimer tout l'historique
            </button>
        </form>
    </div>

    <?php
    $stmt_log->close();

} else {
    include 'php/menu-nc.php';
    ?>
    <script src="/js/menu.js" defer></script>
    <div class="text-content">
        <h1>Accès refusé</h1>
        <br/>
        <p>Vous devez être authentifié afin d'accéder à cette page</p>
    </div>
    <?php
}

include 'php/footer.php';
?>
</body>
</html>
