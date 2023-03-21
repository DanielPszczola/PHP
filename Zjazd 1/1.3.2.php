<?php
function roll_dice($num_rolls) {
    $results = array();
    for ($i = 0; $i < $num_rolls; $i++) {
        $result = rand(1, 6);
        array_push($results, $result);
    }
    return $results;
}

$wyniki = roll_dice(5);
echo "Wyniki rzutów kostką: ";
foreach ($wyniki as $wynik) {
    echo $wynik . " ";
}
?>
