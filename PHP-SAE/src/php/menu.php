<?php

// Style css
echo '<style>';
include("../css/menu.css");
echo '</style>';

// Barre de navigation
echo '<header>
<div class="banniere_haute">
    <img src="../img/banniere_haut.svg" alt="Bannière haute">
  </div>

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
        <a href="../index.html">Accueil</a>
        <a href="../modules.html">Modules</a>
      </div>
    </div>
    <div class="nav-authentication">
      <a href="../login.html" class="user-toggler" aria-label="Page de connexion">
        <img src="../img/user.svg" alt="Icône utilisateur" >
      </a>
      <div class="sign-btns">
        <a href="../login.html" type="button" aria-label="Se connecter">
          <button type="button" aria-label="Se connecter">Se connecter</button>
        </a>
        <a href="../inscription.html" type="button" aria-label="Se connecter">
          <button type="button" aria-label="S\'inscrire">S\'inscrire</button>
        </a>
      </div>
    </div>
  </nav>
  </header>';


echo '<script>';
include("../js/menu.js");
echo '</script>';