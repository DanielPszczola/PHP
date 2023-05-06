
<!DOCTYPE html>
<html>
<head>
    <title>Pierwsza podstrona</title>
</head>
<body>
<h1>Dane ogólne</h1>
<form action="4.1.2.php" method="post">
    <label for="karta">Nr karty:</label>
    <input type="text" id="karta" name="karta"><br><br>

    <label for="zamawiajacy">Dane zamawiającego:</label><br>
    <label for="imie">Imię:</label>
    <input type="text" id="imie" name="imie"><br>
    <label for="nazwisko">Nazwisko:</label>
    <input type="text" id="nazwisko" name="nazwisko"><br><br>

    <label for="ilosc">Ilość osób:</label>
    <select id="ilosc" name="ilosc">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select><br><br>

    <input type="submit" name="submit" value="Przejdź do drugiej podstrony">
    <?php

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['karta'] = $_POST['karta'];
        $_SESSION['imie'] = $_POST['imie'];
        $_SESSION['nazwisko'] = $_POST['nazwisko'];
        $_SESSION['ilosc'] = $_POST['ilosc'];

        header('Location: 4.1.2.php');
        exit();
    }
    session_write_close()
    ?>
</form>
</body>
</html>


