<?php

function getNationality($country) {
    $nationalities = array(
        "Polska" => "Polski",
        "Niemcy" => "Niemiecki",
        "Francja" => "Francuski",
        "Hiszpania" => "Hiszpański",
        "Włochy" => "Włoski"
    );
    if (isset($nationalities[$country])) {
        return $nationalities[$country];
    } else {
        return "Nieznana narodowość";
    }
}
echo "Narodowość dla kraju Polska to: " . getNationality("Polska") . PHP_EOL;

?>
