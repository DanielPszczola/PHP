<!DOCTYPE html>
<html>
<head>
    <title>Blokada strony</title>
</head>
<body>
<h1>Lista odnośników</h1>
<ul>
    <?php
    $allowed_ips_file = 'dozwolone_ip.txt';

    $user_ip = $_SERVER['REMOTE_ADDR'];
    $allowed_ips = file($allowed_ips_file, FILE_IGNORE_NEW_LINES);
    if (in_array($user_ip, $allowed_ips)) {
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
    } else {
        echo 'Nie masz uprawnień do wyświetlenia tej strony.';
        echo "$user_ip";
    }
    ?>
</ul>
</body>
</html>
