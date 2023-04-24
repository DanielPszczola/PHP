<!DOCTYPE html>
<html>
<head>
    <title>Odwracanie kolejności</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Wyślij">
</form>
<?php
if(isset($_FILES['file'])) {
    $tempname = $_FILES["file"]["tmp_name"];

    $lines = file($tempname, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $reversed_lines = array_reverse($lines);

    $handle = fopen($tempname, "w");
    fwrite($handle, implode(PHP_EOL, $reversed_lines));
    fclose($handle);

    echo "<pre>" . file_get_contents($tempname) . "</pre>";
}
?>
</body>
</html>
