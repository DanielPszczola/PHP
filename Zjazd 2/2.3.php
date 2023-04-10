<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator silni i ciągu Fibonacciego</title>
</head>
<body>
<h1>Kalkulator silni i ciągu Fibonacciego</h1>
<form method="post" action=<?php echo $_SERVER['PHP_SELF']; ?>">
    Ścieżka:<input type="text" name="path"><br>
    Nazwa katalogu:<input type="text" name="dir_name"><br>
    Rodzaj operacji:
    <select name="operation">
        <option value="read">Odczytaj zawartość katalogu</option>
        <option value="delete">Usuń katalog</option>
        <option value="create">Stwórz katalog</option>
    </select><br>
    <input type="submit" name="submit" value="Wykonaj">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function executeOperation($path, $dir_name, $operation = 'read') {
        $full_path = rtrim($path, '\\') . '\\' . $dir_name;

        if (!file_exists($full_path)) {
            return "Katalog nie istnieje.";
        }

        if ($operation === 'read') {
            $elements = scandir($full_path);
            $elements = array_diff($elements, array('.', '..'));
            return "Elementy katalogu: " . implode(", ", $elements);
        } elseif ($operation === 'delete') {
            if (!is_dir($full_path)) {
                return "Nie można usunąć, ponieważ $dir_name nie jest katalogiem.";
            }

            if (count(scandir($full_path)) > 2) {
                return "Nie można usunąć, ponieważ katalog $dir_name nie jest pusty.";
            }

            if (!rmdir($full_path)) {
                return "Wystąpił błąd podczas usuwania katalogu.";
            }

            return "Katalog $dir_name został usunięty.";
        } elseif ($operation === 'create') {
            if (file_exists($full_path)) {
                return "Nie można stworzyć, ponieważ katalog $dir_name już istnieje.";
            }

            if (!mkdir($full_path, 0777, true)) {
                return "Wystąpił błąd podczas tworzenia katalogu.";
            }

            return "Katalog $dir_name został stworzony.";
        }

        return "Nieznana operacja.";
    }

    if (isset($_POST['submit'])) {
        $path = $_POST['path'];
        $dir_name = $_POST['dir_name'];
        $operation = $_POST['operation'];

        echo executeOperation($path, $dir_name, $operation);
    }
}
?>
</body>
</html>

