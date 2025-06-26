<?php
session_start();

require_once __DIR__ . '/php/env.php';

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$cnx = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$table = "utilisateur";

if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: index.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ancien_mdp = isset($_POST['ancien_mdp']) ? $_POST['ancien_mdp'] : '';
    $nouveau_mdp = isset($_POST['nouveau_mdp']) ? $_POST['nouveau_mdp'] : '';

    if ($ancien_mdp === '' || $nouveau_mdp === '') {
        $message = 'Veuillez remplir tous les champs.';
    } else {
        $login = $_SESSION['identifiant'];
        $ancien_mdp_hash = md5($ancien_mdp);

        $stmt = mysqli_prepare($cnx, "SELECT password FROM $table WHERE login = ?");
        mysqli_stmt_bind_param($stmt, "s", $login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['password'] === $ancien_mdp_hash) {
                $nouveau_mdp_hash = md5($nouveau_mdp);

                if ($ancien_mdp_hash === $nouveau_mdp_hash) {
                    $message = "Le nouveau mot de passe ne peut pas être identique à l'ancien.";
                } else {
                    $stmt2 = mysqli_prepare($cnx, "UPDATE $table SET password = ? WHERE login = ?");
                    mysqli_stmt_bind_param($stmt2, "ss", $nouveau_mdp_hash, $login);
                    if (mysqli_stmt_execute($stmt2)) {
                        $message = "Mot de passe changé avec succès.";
                    } else {
                        $message = "Erreur lors de la mise à jour du mot de passe.";
                    }
                }
            } else {
                $message = "Ancien mot de passe incorrect.";
            }
        } else {
            $message = "Utilisateur non trouvé.";
        }
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
    <title>Relax Maths - Modifier mot de passe</title>
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/general.css"/>
    <link rel="stylesheet" href="css/compte.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet"/>
    <script src="/js/menu.js" defer></script>

</head>
<body>
<?php include 'php/menu-c.php'; ?>

<main class="wrapper">
    <section class="content">
        <div class="text-content">
            <h1>Bienvenue <?php echo htmlspecialchars($_SESSION['identifiant']); ?>.</h1>
            <p>Voici votre espace personnel !</p>
        </div>

        <form action=" " method="post" class="form-changer-mdp" novalidate>
            <h2>Changer votre mot de passe</h2>
            <div class="form-group">
                <label for="ancien_mdp">Ancien mot de passe :</label>
                <input type="password" name="ancien_mdp" id="ancien_mdp" required/>
            </div>
            <div class="form-group">
                <label for="nouveau_mdp">Nouveau mot de passe :</label>
                <input type="password" name="nouveau_mdp" id="nouveau_mdp" required/>
            </div>
            <button type="submit" class="btn-submit">Changer</button>
        </form>

        <?php if ($message): ?>
            <p style="text-align:center; margin-top:1rem; color: <?php echo (strpos($message, 'succès') !== false) ? 'green' : 'red'; ?>;">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>
    </section>
</main>

<?php include 'php/footer.php'; ?>
</body>
</html>
