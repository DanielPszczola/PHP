<!DOCTYPE html>
<html>
<head>
    <title>Liczba Pierwsza</title>
</head>
<body>
<h1>Liczba Pierwsza</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="liczba">Wpisz liczbę całkowitą dodatnią:</label>
    <input type="number" id="liczba" name="liczba" required>
    <button type="submit">Sprawdź</button>
</form>
<?php
function czy_jest_pierwsza($liczba) {
    if ($liczba < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($liczba); $i++) {
        if ($liczba % $i == 0) {
            return false;
        }
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $liczba = $_POST['liczba'];
    if (filter_var($liczba, FILTER_VALIDATE_INT) && $liczba > 0) {
        if (czy_jest_pierwsza($liczba)) {
            echo 'Liczba ' . $liczba . ' jest liczbą pierwszą.';
        } else {
            echo 'Liczba ' . $liczba . ' nie jest liczbą pierwszą.';
        }
    } else {
        echo 'Błędne dane wejściowe. Wprowadź poprawną liczbę całkowitą dodatnią.';
    }
}
?>
</body>
</html>