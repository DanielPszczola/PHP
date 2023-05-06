<?php
session_start(); // inicjujemy sesję

// sprawdzamy, czy użytkownik nie był już wcześniej na stronie (w tej sesji)
if(!isset($_SESSION['visited'])) {
    // zwiększamy licznik odwiedzin i ustawiamy flagę odwiedzin
    $_SESSION['visited'] = true;
    $_SESSION['visits'] = isset($_SESSION['visits']) ? $_SESSION['visits'] + 1 : 1;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Moja strona</title>
</head>
<body>

<h1>Witaj na mojej stronie!</h1>
<p>Twoja liczba unikalnych odwiedzin: <?php echo $_SESSION['visits']; ?></p>

</body>
</html>
