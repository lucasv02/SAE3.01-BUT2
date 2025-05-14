<?php
function aleatoire($rnd){
    $num=range(0, 9);
    shuffle($num);
    $i=0;
    echo "<table class='alea' role='presentation'>";
    echo "<tr>";
    foreach($num as $valeur){
        if($i==5){
            echo "</tr><tr>";
        }
        if ($valeur == $rnd){
            echo "<td style='border-radius: 8px; border: 1px solid firebrick; height: 30px'>".$valeur."</td>";
        }
        else {
            echo "<td style='border-radius: 8px; border: 1px solid firebrick; background-color: firebrick; color: white; height: 30px'>".$valeur."</td>";
        }
        $i=$i+1;
    }
    echo "</tr></table>";
}

$captcha = random_int(0, 9);

aleatoire($captcha);


echo "<fildset class='fieldset'><legend class='legend'>Captcha</legend>
<label for='alea'>Captcha</label>
<input type='number' name='alea' placeholder='Entrez le numéro' id='alea'>
<button type='submit' name='ok' value='Valider'>Valider</button>
";
if (isset($_GET['error'])) {
    echo "<p class='perreor'>vous avez une erreur sur la saisie de vos identifiants.</p>";
}
echo "</fildset>";
