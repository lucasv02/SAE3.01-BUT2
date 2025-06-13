<?php

session_start();
unset($_SESSION['identifiant']);
unset($_SESSION['password']);
unset($_SESSION['login']);
session_destroy();

header('Location: /index.php');
exit;
?>