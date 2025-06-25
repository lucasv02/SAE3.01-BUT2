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
      </div>
    </div>
    <div class="nav-authentication">
      <a href="login.php" class="user-toggler" aria-label="Page de connexion">
        <img src="../img/user.svg" alt="Icône utilisateur" >
      </a>
      <div class="navlinks-container">
        <a href="login.php">Se connecter</a>
        <a href="inscription.php" >S\'inscrire</a>
      </div>
    </div>
  </nav>
</header>
';

// Inclusion du fichier js de manière responsive
echo '<script>';
include'../js/menu.js';
echo '</script>';