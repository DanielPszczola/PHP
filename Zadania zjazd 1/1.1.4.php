<?php

function peselToDate($pesel) {
    $rok = substr($pesel, 0, 2);
    $miesiac = substr($pesel, 2, 2);
    $dzien = substr($pesel, 4, 2);

    if ($miesiac > 80) {
        $rok += 1800;
        $miesiac -= 80;
    } elseif ($miesiac > 60) {
        $rok += 2200;
        $miesiac -= 60;
    } elseif ($miesiac > 40) {
        $rok += 2100;
        $miesiac -= 40;
    } elseif ($miesiac > 20) {
        $rok += 2000;
        $miesiac -= 20;
    } else {
        $rok += 1900;
    }

    $data = $dzien . '-' . str_pad($miesiac, 2, '0', STR_PAD_LEFT) . '-' . substr($rok, 2);
    return $data;
}

$pesel = '01242609175';
$data = peselToDate($pesel);
echo $data;

?>