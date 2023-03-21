<?php

function maksimum_for($tablica) {
    $n = count($tablica);
    $maksimum = $tablica[0];
    for ($i = 1; $i < $n; $i++) {
        if ($tablica[$i] > $maksimum) {
            $maksimum = $tablica[$i];
        }
    }
    return $maksimum;
}

function maksimum_while($tablica) {
    $n = count($tablica);
    $maksimum = $tablica[0];
    $i = 1;
    while ($i < $n) {
        if ($tablica[$i] > $maksimum) {
            $maksimum = $tablica[$i];
        }
        $i++;
    }
    return $maksimum;
}

function maksimum_do_while($tablica) {
    $n = count($tablica);
    $maksimum = $tablica[0];
    $i = 1;
    do {
        if ($tablica[$i] > $maksimum) {
            $maksimum = $tablica[$i];
        }
        $i++;
    } while ($i < $n);
    return $maksimum;
}

function maksimum_foreach($tablica) {
    $maksimum = $tablica[0];
    foreach ($tablica as $liczba) {
        if ($liczba > $maksimum) {
            $maksimum = $liczba;
        }
    }
    return $maksimum;
}

$tablica = array(5, 10, 15, 20, 25);
echo "For: " . maksimum_for($tablica) . "\n";
echo "While: " . maksimum_while($tablica) . "\n";
echo "Do while: " . maksimum_do_while($tablica) . "\n";
echo "Foreach: " . maksimum_foreach($tablica) . "\n";

?>
