<!DOCTYPE html>
<html>
<head>
    <title>Prosty kalkulator w PHP</title>
</head>
<body>
<h1>Prosty kalkulator w PHP</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="liczba1">Liczba 1:</label>
    <input type="number" name="liczba1" required><br><br>
    <label for="liczba2">Liczba 2:</label>
    <input type="number" name="liczba2" required><br><br>
    <label for="operacja">Operacja:</label>
    <select name="operacja" required>
        <option value="dodawanie">Dodawanie</option>
        <option value="odejmowanie">Odejmowanie</option>
        <option value="mnozenie">Mnożenie</option>
        <option value="dzielenie">Dzielenie</option>
    </select><br><br>
    <input type="submit" value="Oblicz">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $liczba1 = $_POST["liczba1"];
    $liczba2 = $_POST["liczba2"];
    $operacja = $_POST["operacja"];

    switch($operacja) {
        case "dodawanie":
            $wynik = $liczba1 + $liczba2;
            break;
        case "odejmowanie":
            $wynik = $liczba1 - $liczba2;
            break;
        case "mnozenie":
            $wynik = $liczba1 * $liczba2;
            break;
        case "dzielenie":
            $wynik = $liczba1 / $liczba2;
            break;
        default:
            echo "Błędna operacja.";
    }

    echo "<h2>Wynik: $wynik</h2>";
}
?>
</body>
</html>