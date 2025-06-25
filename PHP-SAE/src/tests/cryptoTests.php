<?php

require_once '../crypto.php';

# Pour lancer les tests : php cryptoTests.php dans le dossier src/tests

function assertEquals($expected, $actual, $message = '')
{
    $success = $expected === $actual;

    if ($success) {
        echo "✅  $message\n";
    } else {
        echo "❌  $message - attendu: $expected, obtenu: $actual\n";
    }
}


echo "=== Tests du chiffrement ok ===\n";
$chiffrementCas = [
    ['azerty', 'FFVDADDDDGVA'],
    ['AZERTY', 'FFVDADDDDGVA'],
    ['azErty0', 'FFVDADDDDGVAVF'],
];

foreach ($chiffrementCas as $i => [$message, $expected]) {
    $result = chiffrer($message);
    assertEquals($expected, $result, "Test chiffrement[$message]");
}


echo "=== Tests du déchiffrement ok ===\n";
$dechiffrementCas = [
    ['FFVDADDDDGVA', 'AZERTY'],
    ['FFVDADDDDGVA', 'AZERTY'],
    ['FFVDADDDDGVAVF', 'AZERTY0'],
];

foreach ($dechiffrementCas as $i => [$message, $expected]) {
    $result = dechiffrer($message);
    assertEquals($expected, $result, "Test déchiffrement[$message]");
}

echo "=== Tests du déchiffrement return erreur ===\n";
$result = dechiffrer('AZE');
assertEquals('Erreur : le code doit avoir un nombre pair de caractères.', $result, "Test déchiffrement[erreur]");
