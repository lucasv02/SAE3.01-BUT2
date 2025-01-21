<?php

require_once ("fonctions.php");

echo "<body>
          <div class='conteneur-formulaire'>
              <img id='logo' src='images/logo.jpeg' alt='logo représentant une calculatrice'>
              <h1 id='titre-login'>Relax Maths</h1>
              <p id='explicatif'>Connectez-vous à votre compte</p>
                  <form action='login.php' method='post'>
                      <label for='email'>Adresse mail</label>
                      <input type='email' name='email' id='email' placeholder='Adresse mail' required>
                      <br>
                      <label for='password'>Mot de passe</label>
                      <input type='password' name='password' id='password' placeholder='Mot de passe' required>
                      <a id='mdp-oublie' href='/reset-password'>Mot de passe oublié ?</a>
                      <br>
                      <button type='submit'>Connexion</button>
                      <p id='copyright'>© 2024 Relax Maths</p>
                  </form>


          </div>
      </body>";

echo "<style>
body {
          background-color: #f5f6fa;
          justify-content: center;
          align-items: center;
          height: 100vh;
          display: flex;

      }

      #titre-login {
          margin-bottom: 5px;
          font-family: Arial, Helvetica, sans-serif;
      }

      #explicatif {
          margin-top: 5px;
          font-size: 22px;
          font-family: Arial, Helvetica, sans-serif;
      }

      #copyright {
          text-align: center;
      }

      .conteneur-formulaire {
          display: flex;
          align-items: center;
          flex-direction: column;
          background-color: #ffffff;
          padding-left: 60px;
          padding-right: 60px;
          padding-bottom: 10px;
          padding-top: 15px;
          border-radius: 10px;
      }

      form {
          display: flex;
          flex-direction: column;
          width: 100%;
          font-family: Arial, Helvetica, sans-serif;
      }

      input[type='email'], input[type='password'] {
          border-radius: 5px;
          background-color: #ffffff;
          border: 1px solid #ccc;
          padding: 5px;
          margin-top: 10px;
      }

      button[type='submit'] {
          border-radius: 5px;
          background-color: #d9824c;
          border: 1px solid #ccc;
          padding: 5px;
          margin-top: 10px;
          font-family: Arial, Helvetica, sans-serif;
      }
      #logo {
          width: 100px;
          height: auto;

      }

      #mdp-oublie {
          margin-top: 5px;
          color: #000000;
          text-align: right;
          align-self: flex-end;
          font-family: Arial, Helvetica, sans-serif;
      }
  </style>
";

$cnx=mysqli_connect("localhost","relax-user","HeLu2FGK#2J");
$bd=mysqli_select_db($cnx,"auth");
$table="relax";

if (isset($_POST['email'],$_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlInser="INSERT INTO $table (email, password) VALUES ('$email', '$password')";
    print_r($sqlInser);
    mysqli_query($cnx,$sqlInser);

}

mysqli_close($cnx);