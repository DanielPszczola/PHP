<!DOCTYPE html>
<html>
<head>
    <title>Druga podstrona</title>
</head>
<body>
<h1>Dane osobowe</h1>
<form action="4.1.3.php.php" method="post">
    <?php
    session_start();

    // Sprawdzenie, czy dane ogólne zostały już wprowadzone na pierwszej podstronie
    if (!isset($_SESSION['karta']) || !isset($_SESSION['imie']) || !isset($_SESSION['nazwisko']) || !isset($_SESSION['ilosc'])) {
        echo "<p>Błąd: brak danych ogólnych. Wróć na pierwszą podstronę i wprowadź dane ogólne.</p>";
        exit();
    }

    // Pobranie liczby osób z danych ogólnych
    $ilosc = $_SESSION['ilosc'];

    // Pobranie danych osobowych każdej osoby z formularza
    for ($i = 1; $i <= $ilosc; $i++) {
        echo "<h2>Osoba $i</h2>";
        echo "<label for=\"imie$i\">Imię:</label>";
        echo "<input type=\"text\" id=\"imie$i\" name=\"imie$i\"><br>";
        echo "<label for=\"nazwisko$i\">Nazwisko:</label>";
        echo "<input type=\"text\" id=\"nazwisko$i\" name=\"nazwisko$i\"><br><br>";
    }
    ?>

    <input type="submit" name="submit" value="Przejdź do trzeciej podstrony">
</form>

<form action="4.1.1.php" method="post">
    <input type="submit" name="submit" value="Wróć do pierwszej podstrony">
</form>

<form action="zapisz_w_sesji.php" method="post">
    <input type="submit" name="submit" value="Zapisz dane w sesji">
</form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    // Zapisanie danych osobowych każdej osoby do sesji
    for ($i = 1; $i <= $_SESSION['ilosc']; $i++) {
        $_SESSION["imie$i"] = $_POST["imie$i"];
        $_SESSION["nazwisko$i"] = $_POST["nazwisko$i"];
    }

    header('Location: 4.1.3.php');
    exit();
}
?>
