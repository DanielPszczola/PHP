<?php
include "database.php";
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "admin";

try {
    $db = getDatabaseConnection();
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];
    $username = $_POST['username'];
    $content = $_POST['content'];

    // You need to sanitize the input here to prevent SQL injection
    // ...

    try {
        $query = "INSERT INTO comments (post_id, author, content) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$postId, $username, $content]);
    } catch(PDOException $e) {
        echo 'Błąd przy dodawaniu komentarza: ' . $e->getMessage();
        exit;
    }

    header("Location: commentpostpage.php?id=" . $postId); // redirect back to the post
    exit;
}
?>
