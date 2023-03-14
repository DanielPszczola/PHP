<?php

function cenz($zd, $niepSlowa) {
    foreach ($niepSlowa as $slo) {
        $gw = str_repeat('*', strlen($slo));
        $zd = str_ireplace($slo, $gw, $zd);
    }
    return $zd;
}

$zd = "Zdanie z niepożądanym słowem.";
$niepSlowa = array("niepożądanym", "słowem");
$ocZdanie = cenz($zd, $niepSlowa);
echo $ocZdanie;

?>
