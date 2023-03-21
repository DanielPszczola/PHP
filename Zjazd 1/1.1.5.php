<?php

function calculateTriangleArea() {
    echo "Podaj długość podstawy trójkąta: ";
    $base = readline();
    echo "Podaj wysokość trójkąta: ";
    $height = readline();
    $area = $base * $height / 2;
    echo "Pole trójkąta wynosi: " . $area . PHP_EOL;
}

function calculateRectangleArea() {
    echo "Podaj długość boku a prostokąta: ";
    $sideA = readline();
    echo "Podaj długość boku b prostokąta: ";
    $sideB = readline();
    $area = $sideA * $sideB;
    echo "Pole prostokąta wynosi: " . $area . PHP_EOL;
}

function calculateTrapeziumArea() {
    echo "Podaj długość dolnej podstawy trapezu: ";
    $base1 = readline();
    echo "Podaj długość górnej podstawy trapezu: ";
    $base2 = readline();
    echo "Podaj wysokość trapezu: ";
    $height = readline();
    $area = ($base1 + $base2) * $height / 2;
    echo "Pole trapezu wynosi: " . $area . PHP_EOL;
}

echo "Witaj w kalkulatorze pól powierzchni!" . PHP_EOL;
echo "Wybierz figurę, której pole chcesz obliczyć:" . PHP_EOL;
echo "1 - Trójkąt" . PHP_EOL;
echo "2 - Prostokąt" . PHP_EOL;
echo "3 - Trapez" . PHP_EOL;

$choice = readline();
switch ($choice) {
    case 1:
        calculateTriangleArea();
        break;
    case 2:
        calculateRectangleArea();
        break;
    case 3:
        calculateTrapeziumArea();
        break;
    default:
        echo "Błędny wybór." . PHP_EOL;
}

?>
