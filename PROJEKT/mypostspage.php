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
                <li><a href="accountpage.php">Account</a></li>
                <li class="logout-link"><a href="?logout=true">Logout</a></li>
            <?php else : ?>
                <li class="login-link"><a href="loginpage.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php
$db = getDatabaseConnection();

//----------------------------------pobranie posta--------------------------------------------------------
$query = 'SELECT * FROM posts WHERE author = :username ORDER BY date DESC';
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $_COOKIE['username']);
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
//---------------------------------------------------buttony-----------------------------------------------
$requestedPostId = isset($_GET['id']) ? $_GET['id'] : null;

$displayedPost = null;
$displayedPostIndex = 0;
foreach ($posts as $index => $post) {
    if ($post['id'] == $requestedPostId) {
        $displayedPost = $post;
        $displayedPostIndex = $index;
        break;
    }
}

// Jeśli nie znaleziono żądanego postu, użyj pierwszego postu jako domyślnego
if ($displayedPost === null) {
    $displayedPost = $posts[0];
    $displayedPostIndex = 0;
}

$previousPostId = $displayedPostIndex > 0 ? $posts[$displayedPostIndex - 1]['id'] : null;
$nextPostId = $displayedPostIndex < count($posts) - 1 ? $posts[$displayedPostIndex + 1]['id'] : null;
//---------------------------------------------------------obsługa------------------------------------
if (isset($_POST['delete_post_id'])) {
    // Your code to delete post goes here...
    $postIdToDelete = $_POST['delete_post_id'];

    try {
        $query = 'DELETE FROM posts WHERE id = :id AND author = :username';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $postIdToDelete);
        $stmt->bindParam(':username', $_COOKIE['username']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo 'Post was successfully deleted';
        } else {
            echo 'Could not delete post. Either the post does not exist, or you are not the author of the post';
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_post'])) {
    // Your code to add post goes here...
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;

    // Add the new post
    try {
        // Get author from cookies
        $author = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;

        // Check if author is not null
        if (!$author) {
            throw new Exception('Author not found in cookies');
        }

        // Get current date and time
        $date = date("Y-m-d H:i:s");

        // Connect to database
        $pdo = getDatabaseConnection();

        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO posts (title, author, content, date) VALUES (?, ?, ?, ?)");

        // Execute the statement with title, author, content and date parameters
        $stmt->execute([$title, $author, $content, $date]);

        echo "Post successfully added.";
        header("Location: " . $_SERVER['PHP_SELF'], true, 303);
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_post_id'])) {
    // Your code to update post goes here...
    $postIdToUpdate = $_POST['update_post_id'];
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;

    try {
        // Get author from cookies
        $author = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;

        // Check if author is not null
        if (!$author) {
            throw new Exception('Author not found in cookies');
        }

        // Get current date and time
        $date = date("Y-m-d H:i:s");

        // Prepare SQL statement
        $stmt = $db->prepare("UPDATE posts SET title = :title, content = :content, date = :date WHERE id = :id AND author = :author");

        // Bind parameters and execute the statement
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':id', $postIdToUpdate);
        $stmt->bindParam(':author', $author);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo 'Post was successfully updated';
        } else {
            echo 'Could not update post. Either the post does not exist, or you are not the author of the post';
        }

        header("Location: " . $_SERVER['PHP_SELF'], true, 303);
        exit;
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
}

?>
<main>
    <div class="main-section">
        <?php
        // Wyświetl przycisk "Previous", jeśli istnieje poprzedni post
        if (isset($posts[$displayedPostIndex - 1])) {
            echo '<a class="previous" href="?id=' . $posts[$displayedPostIndex - 1]['id'] . '">Previous</a>';
        }
        ?>
    </div>
    <div class="main-section">
        <nav class="postpage">
            <!-- New Post Form -->
            <form action="mypostspage.php" method="post">
                <h1>ADD POST</h1>
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title"><br>
                <label for="content">Content:</label><br>
                <textarea id="content" name="content"></textarea><br>
                <input type="hidden" name="add_post" value="1">
                <input class="dodpost" type="submit" value="Submit">
            </form>
        </nav>
    </div>
    <div class="main-section">
        <div class="post">
            <?php if ($displayedPost !== null) : ?>
                <div class="postincomment">
                    <h2><a href="commentpostpage.php?id=<?php echo $displayedPost['id']; ?>"><?php echo $displayedPost['title'] ?></a></h2>
                    <p><?php echo $displayedPost['content'] ?></p>
                    <h5>Autor: <?php echo $displayedPost['author'] ?>    Data: <?php echo $displayedPost['date'] ?></h5>
                    <form method="post" action="mypostspage.php">
                        <input type="hidden" name="delete_post_id" value="<?php echo $displayedPost['id']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </div>
            <?php else : ?>
                <p>No posts to display.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="main-section">
        <nav class="postpage">
            <!-- Edit Post Form -->
            <form action="mypostspage.php" method="post">
                <h1>EDIT POST</h1>
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" value="<?php echo $displayedPost['title']; ?>"><br>
                <label for="content">Content:</label><br>
                <textarea id="content" name="content"><?php echo $displayedPost['content']; ?></textarea><br>
                <input type="hidden" name="update_post_id" value="<?php echo $displayedPost['id']; ?>">
                <input type="submit" value="Update">
            </form>
        </nav>
    </div>
    <div class="main-section">
        <?php
        // Wyświetl przycisk "Next", jeśli istnieje następny post
        if (isset($posts[$displayedPostIndex + 1])) {
            echo '<a class="next" href="?id=' . $posts[$displayedPostIndex + 1]['id'] . '">Next</a>';
        }
        ?>
    </div>
</main>
<footer>
    <p>&copy; 2023 Just BLOG. Wszelkie prawa zastrzeżone.</p>
</footer>
</body>
</html>