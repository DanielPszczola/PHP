<!DOCTYPE html>
<html>
<head>
    <title>JustBLOG</title>
    <link rel="stylesheet" type="text/css" href="glowna.css">
    <meta charset="UTF-8">
</head>
<body>

<?php
include 'login.php';
include 'database.php';
logOut();
?>

<header>
    <h1>Just BLOG!</h1>
</header>

<div class="nav-container">
    <nav>
        <ul>
            <li><a href="glowna.php">Main Page</a></li>
            <?php if (isUserLoggedIn()) : ?>
                <li><a href="mypostspage.php">My Posts</a></li>
                <li><a href="accountpage.php">Account</a></li>
                <li class="logout-link"><a href="?logout=true">Logout</a></li>
            <?php else : ?>
                <li class="login-link"><a href="loginpage.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php
try {
    $db = getDatabaseConnection();

    if (isset($_GET['id'])) {
        $postId = $_GET['id'];
        $query = "SELECT * FROM posts WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        header('Location: glowna.php'); // redirect to the main page if no id is provided
    }
} catch(PDOException $e) {
    echo 'Błąd połączenia z bazą danych: ' . $e->getMessage();
    exit;
}
?>

<main>
    <div class="main-section">
        <div class="comment">
            <?php

            $query = "SELECT * FROM comments WHERE post_id = ? ORDER BY date DESC LIMIT 3";
            $stmt = $db->prepare($query);
            $stmt->execute([$postId]);
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($comments as $comment) {
                echo '<div class="commentinvidual">';
                echo '<h5>' . htmlspecialchars($comment['author']) . ' - ' . $comment['date'] . '</h5>';
                echo '<p>' . htmlspecialchars($comment['content']) . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="main-section">
        <div class="post">
            <div class="postincomment">
                <h2><?php echo $post['title'] ?></h2>
                <p><?php echo $post['content'] ?></p>
                <h5>Autor: <?php echo $post['author'] ?> &nbsp &nbsp &nbsp &nbsp&nbsp&nbsp Data: <?php echo $post['date'] ?></h5>
            </div>

        </div>
    </div>
    <div class="main-section">
        <div class="comment-section">
            <h3>Add a Comment</h3>
            <form method="POST" action="add_comment.php">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <input type="hidden" name="username" value="<?php echo $_COOKIE['username']; ?>">
                <div>
                    <label for="content">Comment:</label>
                    <textarea id="content" name="content" maxlength="50"></textarea>
                </div>
                <div>
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>

</main>
<footer>
    <p>&copy; 2023 Just BLOG. Wszelkie prawa zastrzeżone.</p>
</footer>
</body>
</html>
