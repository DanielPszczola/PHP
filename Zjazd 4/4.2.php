<!DOCTYPE html>
<html>
<head>
    <title>Moja strona</title>
</head>
<body>

<?php
// sprawdzenie, czy ciasteczko już istnieje
if(isset($_COOKIE['visits'])) {
    // odczytanie wartości ciasteczka
    $visits = $_COOKIE['visits'] + 1;
    // zapisanie zwiększonej wartości ciasteczka
    setcookie('visits', $visits, time() + (60 * 60 * 24 * 30), "/"); // ciasteczko ważne przez 30 dni
} else {
    // ustawienie wartości początkowej ciasteczka
    setcookie('visits', 1, time() + (60 * 60 * 24 * 30), "/"); // ciasteczko ważne przez 30 dni
}
?>

<h1>Witaj na mojej stronie!</h1>
<p>Twoja liczba odwiedzin: <?php echo $_COOKIE['visits']; ?></p>

</body>
</html>