<?php
session_start(); // Necéssaire pour stocker les valeurs à vérifer

//Générer un calcul simple
$a = random_int(0, 10);
$b = random_int(0, 10);

//Stock le résultat du calcul dans la session
$_SESSION['captcha-result'] = $a + $b;


echo "
<fieldset class='fieldset'><legend class='legend'>Captcha</legend>
<label for='captcha'>Combien font $a + $b ?</label><br>
<input type='number' name='captcha' placeholder='Entrez le réponse' id='captcha' required>
</fieldset>";
?>
