<!DOCTYPE html>
<html>
<head>
    <title>Lista odnośników</title>
</head>
<body>
<h1>Lista odnośników</h1>
<ul>
    <?php
    $file = fopen("lista.txt", "r");
    while (!feof($file)) {
        $line = fgets($file);
        $data = explode(";", $line);
        if (count($data) == 2) {
            $url = trim($data[0]);
            $opis = trim($data[1]);
            echo "<li><a href='$url'>$opis</a></li>";
        }
    }
    fclose($file);
    ?>
</ul>
</body>
</html>