<?php

function getElementAtIndex($array, $index) {
    if (isset($array[$index])) {
        return $array[$index];
    } else {
        return "Niepoprawny indeks tablicy.";
    }
}

// Definiujemy tablicę z losowymi liczbami
$array = array(5, 12, 8, 3, 9, 6, 1, 4, 7, 2);

// Wywołujemy funkcję z indeksem 3
echo "Wartość elementu o indeksie 3 wynosi: " . getElementAtIndex($array, 3) . PHP_EOL;

?>