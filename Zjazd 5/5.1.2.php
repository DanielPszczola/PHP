<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="5.1.css">
    <title>Moja Strona</title>
</head>
<body>
<div class="navbar">
    <a href="5.1.php">Strona główna</a>
    <a href="5.1.2.php">Wszystkie samochody</a>
    <a href="5.1.3.php">Dodaj samochód</a>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Marka</th>
        <th>Model</th>
        <th>Cena</th>
        <th>Rok</th>
        <th>Opis</th>
    </tr>
    <?php
    // Połącz z bazą danych
    $conn = new mysqli('localhost', 'admin', 'admin', 'mojaBaza');

    // Sprawdź połączenie
    if ($conn->connect_error) {
        die("Nie udało się połączyć: " . $conn->connect_error);
    }

    // Wykonaj zapytanie do bazy danych
    $sql = "SELECT id, marka, model, cena, rok, opis FROM samochody ORDER BY rok ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Wyświetl dane każdego wiersza
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["marka"]. "</td><td>" . $row["model"]. "</td><td>$" . $row["cena"]. "</td><td>" . $row["rok"]. "</td><td>" . $row["opis"]. "</td></tr>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</table>
<div>
    <!-- Miejsce na resztę treści strony -->
</div>
</body>
</html>
