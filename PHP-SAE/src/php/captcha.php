<?php

$x =array(12,10,8,10,2,4,10);
$n =array(1,2,1,3,1,2,4);

echo '<table>';
echo '<tr>';
echo '<th>x</th>';
foreach ($x as $value) {
    echo '<td>'.$value.'</td>';
}
echo '</tr>';

echo '<tr>';
echo '<th>n</th>';
foreach ($n as $value) {
    echo '<td>'.$value.'</td>';
}
echo '</tr>';
echo '</table>';


$message="";
if(isset($_GET["error"])){
    $message="erreur d'identifiant ou de MDP";
}
