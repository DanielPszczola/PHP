<!DOCTYPE html>
<html>
<head>
    <title>Mój Blog</title>
    <link rel="stylesheet" type="text/css" href="glowna.css">
    <meta charset="UTF-8">
</head>
<body>

<?php
include 'login.php';
include 'database.php';

logOut();

$db = getDatabaseConnection();
?>

<header>
    <h1>Just BLOG!</h1>
</header>

<div class="nav-container">
    <nav>
        <ul>
            <li><a href="glowna.php">Main Page</a></li>
            <?php if (isUserLoggedIn()) : ?>
                <li><a href="#">Account</a></li>
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
    $query = "SELECT * FROM posts WHERE author = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $_COOKIE['username']);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo 'Błąd połączenia z bazą danych: ' . $e->getMessage();
    exit;
}

$displayedPostIndex = null;

if (isset($_GET['id'])) {
    $requestedPostId = $_GET['id'];
    foreach ($posts as $index => $post) {
        if ($post['id'] == $requestedPostId) {
            $displayedPostIndex = $index;
            break;
        }
    }
}

usort($posts, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

if ($displayedPostIndex === null) {
    $displayedPostIndex = 0;
}

$displayedPost = $posts[$displayedPostIndex];
?>

<main>
    <div class="main-section">
        <?php
        // Wyświetl przycisk "Previous", jeśli istnieje poprzedni post
        if ($displayedPostIndex > 0) {
            $previousPostId = $posts[$displayedPostIndex - 1]['id'];
            echo '<a class="previous" href="?id=' . $previousPostId . '">Previous</a>';
        }
        ?>
    </div>
    <div class="main-section">
        <div class="post">
            <div class="postincomment">
                <h2><a href="commentpostpage.php?id=<?php echo $displayedPost['id']; ?>"><?php echo $displayedPost['title'] ?></a></h2>
                <p><?php echo $displayedPost['content'] ?></p>
                <h5>Autor: <?php echo $displayedPost['author'] ?>    Data: <?php echo $displayedPost['date'] ?></h5>
                <form method="post" action="deletepost.php">
                    <input type="hidden" name="post_id" value="<?php echo $displayedPost['id']; ?>" />
                    <input type="submit" value="Delete Post" />
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="main-section">
        <?php
        // Wyświetl przycisk "Next", jeśli istnieje następny post
        if ($displayedPostIndex < count($posts) - 1) {
            $nextPostId = $posts[$displayedPostIndex + 1]['id'];
            echo '<a class="next" href="?id=' . $nextPostId . '">Next</a>';
        }
        ?>
    </div>
</main>
<footer>
    <p>&copy; 2023 Just BLOG. Wszelkie prawa zastrzeżone.</p>
</footer>
</body>
</html>