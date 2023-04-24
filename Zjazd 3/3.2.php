<!DOCTYPE html>
<html>
<head>
    <title>Licznik</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Wyślij">
</form>
<?php
$file_path = 'licznik.txt';
if (!file_exists($file_path)) {
    file_put_contents($file_path, '1');
} else {
    $count = intval(file_get_contents($file_path)) + 1;
    file_put_contents($file_path, strval($count));
}
echo "Liczba odwiedzin: " . $count;
?>
</body>
</html>

