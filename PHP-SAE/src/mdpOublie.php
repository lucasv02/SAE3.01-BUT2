<?php
echo '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="img/logo.png" />
  <title>Relax Maths</title>
  <link rel="stylesheet" href="css/construction.css" />
  <link rel="stylesheet" href="css/general.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="/js/menu.js"></script>
</head>
<body>
<div class="wrapper">';

include 'php/menu-nc.php';

echo '
<div class="text-content">
  <h1>Page en Construction</h1>
  <p>Momentanément suspendu</p>
</div>';

include 'php/footer.php';

echo '</div>
</body>
</html>';
