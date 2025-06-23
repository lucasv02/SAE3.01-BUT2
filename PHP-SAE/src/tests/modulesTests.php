<?php

require_once '../modules.php';

# Pour lancer les tests : php modulesTests.php dans le dossier src/tests

function assertEquals($expected, $actual, $message = '', $delta = null) {
    if (is_float($expected) && $delta !== null) {
        $success = abs($expected - $actual) <= $delta;
    } else {
        $success = $expected === $actual;
    }

    if ($success) {
        echo " $message\n";
    } else {
        echo " $message - attendu: $expected, obtenu: $actual\n";
    }
}

// === Tests ===

echo "=== Tests de la loi normale ok===\n";
$loiNormaleCas = [
    [0, 0, 1, 0.3989, 0.0001],
    [1, 0, 1, 0.2419, 0.0001],
    [2, 0, 2, 0.1209, 0.0001],
];

foreach ($loiNormaleCas as $i => [$point_median, $moyenne, $ecart_type, $expected, $delta]) {
    $result = loi_normale($point_median, $moyenne, $ecart_type);
    assertEquals($expected, $result, "Test loi_normale[$point_median, $moyenne, $ecart_type]", $delta);
}

echo "\n=== Test loi normale return 0 ===\n";
$result = loi_normale(10, 10, 0);
assertEquals(0, $result, "loi_normale avec écart type 0");

echo "\n=== Tests de la méthode des rectangles ok ===\n";
$rectanglesCas = [
    [0, 1, 5, 10000, 0.99, 1.0],
    [0, 1, 2, 5000, 0.84, 0.86],
];

foreach ($rectanglesCas as $i => [$moy, $ecart, $borne, $nb, $min, $max]) {
    $result = methode_rectangles($moy, $ecart, $borne, $nb);
    assertEquals($expected, $result, "Test méthode des rectangles[$moy, $ecart, $borne, $nb]", $delta);
}

echo "\n=== Test de la méthode des rectangles return error ===\n";
$result = methode_rectangles(0, -1, 5, 10000);
assertEquals("valeurs_non_cohérentes", $result, "methode_rectangles avec écart type invalide");
