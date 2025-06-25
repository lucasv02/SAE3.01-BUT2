<?php

require_once '../proba.php';

# Pour lancer les tests : php probaTests.php dans le dossier src/tests

function assertEquals($expected, $actual, $message = '')
{
    $success = is_numeric($expected) && is_numeric($actual)
        ? abs($expected - $actual) < 1e-6
        : $expected === $actual;

    if ($success) {

        echo "✅  $message\n";
    } else {
        echo "❌  $message - attendu: $expected, obtenu: $actual\n";
    }
}


echo "=== Tests de la loi normale ok ===\n";
$loiNormaleCas = [
    [0, 0, 1, 0.39894228040143],
    [1, 0, 1, 0.24197072451914],
    [2, 0, 2, 0.17109914015611],
];

foreach ($loiNormaleCas as $i => [$point_median, $moyenne, $ecart_type, $expected]) {
    $result = loi_normale($point_median, $moyenne, $ecart_type);
    assertEquals($expected, $result, "Test loi_normale[$point_median, $moyenne, $ecart_type]");
}

echo "\n=== Test loi normale return 0 ===\n";
$result = loi_normale(10, 10, 0);
assertEquals(0, $result, "loi_normale avec écart type 0");


echo "\n=== Tests de la méthode des rectangles ok ===\n";
$rectanglesCas = [
    [0, 1, 5, 10000, 0.99999942669748],
    [0, 1, 2, 5000, 0.97724959021938],
    [10, 5, 2, 500, 0.12253301269903],
];

foreach ($rectanglesCas as $i => [$moy, $ecart, $borne, $nb, $expected]) {
    $result = methode_rectangles($moy, $ecart, $borne, $nb);
    assertEquals($expected, $result, "Test méthode des rectangles[$moy, $ecart, $borne, $nb]");
}

echo "\n=== Test de la méthode des rectangles return error ===\n";
$result = methode_rectangles(1, 5, 10, 500);
assertEquals("valeurs_non_cohérentes", $result, "methode_rectangles avec écart type invalide");
