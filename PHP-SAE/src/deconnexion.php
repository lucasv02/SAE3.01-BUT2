<?php

session_start();
$_SESSION = []; // Vider toutes les variables de session
session_unset(); // Supprime les variables de session
session_destroy(); // Détruit la session
setcookie(session_name(), '', time() - 3600, '/'); // Supprime le cookie de session

header('Location: /index.php');
exit;
?>