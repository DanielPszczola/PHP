<!DOCTYPE html>
<html>
<head>
    <title>Formularzrezerwacjihotel</title>
</head>
<body>
<h1>Formularzrezerwacjihotel</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="ilosc-osob">Ilość osób (1-4):</label>
    <select id="ilosc-osob" name="ilosc-osob">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <br>
    <label for="imie">Imię:</label>
    <input type="text" id="imie" name="imie" required>
    <br>
    <label for="nazwisko">Nazwisko:</label>
    <input type="text" id="nazwisko" name="nazwisko" required>
    <br>
    <label for="adres">Adres:</label>
    <input type="text" id="adres" name="adres" required>
    <br>
    <label for="karta">Dane karty kredytowej:</label>
    <input type="text" id="karta" name="karta" pattern="[0-9]{16}" required>
    <small>Wpisz 16-cyfrowy numer karty bez spacji</small>
    <br>
    <label for="data-pobytu">Data pobytu:</label>
    <input type="date" id="data-pobytu" name="data-pobytu" required>
    <br>
    <label for="godzina-przyjazdu">Godzina przyjazdu:</label>
    <input type="time" id="godzina-przyjazdu" name="godzina-przyjazdu" required>
    <br>
    <label for="dostawka">Czy potrzebna dostawka dla dziecka?</label>
    <select id="dostawka" name="dostawka">
        <option value="tak">Tak</option>
        <option value="nie">Nie</option>
    </select>
    <br>
    <label for="udogodnienia">Udogodnienia:</label>
    <br>
    <input type="checkbox" id="klimatyzacja" name="udogodnienia[]" value="klimatyzacja">
    <label for="klimatyzacja">Klimatyzacja (dodatkowa opłata)</label>
    <br>
    <input type="checkbox" id="popielniczka" name="udogodnienia[]" value="popielniczka">
    <label for="popielniczka">Popielniczka dla palacza</label>
    <br>
    <button type="submit">Zarezerwuj</button>
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // odbieranie danych z formularza
    $iloscOsob = $_POST['ilosc-osob'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $adres = $_POST['adres'];
    $karta = $_POST['karta'];
    $dataPobytu = $_POST['data-pobytu'];
    $godzinaPrzyjazdu = $_POST['godzina-przyjazdu'];
    $dostawka = isset($_POST['dostawka']) ? true : false;
    $udogodnienia = isset($_POST['udogodnienia']) ? $_POST['udogodnienia'] : [];

// wyświetlanie podsumowania rezerwacji
    echo "<h2>Podsumowanie rezerwacji</h2>";
    echo "<p>Ilość osób: $iloscOsob</p>";
    echo "<p>Imię: $imie</p>";
    echo "<p>Nazwisko: $nazwisko</p>";
    echo "<p>Adres: $adres</p>";
    echo "<p>Dane karty kredytowej: $karta</p>";
    echo "<p>Data pobytu: $dataPobytu</p>";
    echo "<p>Godzina przyjazdu: $godzinaPrzyjazdu</p>";
    echo "<p>Dostawka dla dziecka: " . ($dostawka ? 'tak' : 'nie') . "</p>";
    echo "<p>Udogodnienia: " . implode(', ', $udogodnienia) . "</p>";
}
?>

</body>
</html>
