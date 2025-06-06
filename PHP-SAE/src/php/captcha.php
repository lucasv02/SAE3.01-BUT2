<?php
session_start(); // Necéssaire pour stocker les valeurs à vérifer

//Générer un calcul simple
$a = random_int(0, 50);
$b = random_int(0, 50);

//Stock le résultat du calcul dans la session
$_SESSION['captcha'] = $a + $b;


echo "
<fieldset class='fieldset'><legend class='legend'>Captcha</legend>
<label for='alea'>Combien font $a + $b ?</label><br>
<input type='number' name='captcha' placeholder='Entrez le réponse' id='captcha' required>
</fieldset>";

//Affichage d'un message d'erreur en cas d'erreur
if(isset($_GET['erreur']) && $_GET['erreur'] != 2) {
    echo '<p class\"perreor\">Erreur sur le captcha. Veuillez réessayer.</p>';
}
?>