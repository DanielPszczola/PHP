<?php
function getDatabaseConnection() {
    $db = new PDO('mysql:host=localhost;dbname=admin;charset=utf8', 'admin', 'admin');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}
