<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="5.1.css">
    <title>Moja Strona</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "mojabaza";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $cena = $_POST['cena'];
    $rok = $_POST['rok'];
    $opis = $_POST['opis'];

    try {
        $query = "INSERT INTO samochody (marka, model, cena, rok, opis) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$marka, $model, $cena, $rok, $opis]);
    } catch(PDOException $e) {
        echo 'Błąd przy dodawaniu komentarza: ' . $e->getMessage();
        exit;
    }

    header("Location: 5.1.php");
    exit;
}
?>
<div class="navbar">
    <a href="5.1.php">Strona główna</a>
    <a href="5.1.2.php">Wszystkie samochody</a>
    <a href="5.1.3.php">Dodaj samochód</a>
</div>
<div>
    <form action="5.1.3.php" method="post">
        <label for="marka">Marka:</label><br>
        <input type="text" id="marka" name="marka"><br>
        <label for="model">Model:</label><br>
        <input type="text" id="model" name="model"><br>
        <label for="cena">Cena:</label><br>
        <input type="number" id="cena" name="cena"><br>
        <label for="rok">Rok:</label><br>
        <input type="number" id="rok" name="rok"><br>
        <label for="opis">Opis:</label><br>
        <input type="text" id="opis" name="opis"><br>
        <input type="submit" value="Dodaj Samochód">
    </form>
</div>
<div>
</div>
</body>
</html>