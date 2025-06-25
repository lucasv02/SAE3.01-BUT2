<?php

// Mise en place de la bannière haute dans le menu
echo '
<header>
  <div class="banniere_haute">
    <img src="../img/banniere_haut.svg" alt="Bannière haute">
  </div>
';

// Barre de Navigation
echo '
  <nav>
    <a class="nav-icon" aria-label="Homepage" aria-current="page">
      <img src="../img/logo.png" alt="Logo Relax Maths" >
      <span>Relax Maths</span>
    </a>
    <div class="main-navlinks">
      <button type="button" class="hamburger" aria-label="Barre Navigation" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="navlinks-container">
        <a href="index.php">Accueil</a>
        <a href="proba.php">Probabilité</a>
        <a href="crypto.php">Crypto</a>
        <a href="historique.php">Historique</a>';
if (isset($_SESSION['permission']) && $_SESSION['permission'] === 'admin_sys') {
    echo '<a href="adminSys.php">Journal log</a>';
}
if (isset($_SESSION['permission']) && $_SESSION['permission'] === 'admin_web') {
    echo '<a href="adminWeb.php">Liste utilisateurs</a>';
}
echo '    </div>
    </div>
    <div class="nav-authentication">
      <a href="login.php" class="user-toggler" aria-label="Page de connexion">
        <img src="../img/user.svg" alt="Icône utilisateur" >
      </a>
      <div class="navlinks-container">
        <a href="compte.php">Mon Compte</a>
        <a href="deconnexion.php" >Déconnexion</a>
      </div>
    </div>
  </nav>
</header>
';

// Inclusion du fichier js de manière responsive
echo '<script>';
include'../js/menu.js';
echo '</script>';