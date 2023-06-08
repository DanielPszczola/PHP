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
if (isset($_GET['logout'])) {
    setcookie('user_logged_in', '', time() - 3600, "/"); // unset the cookie
    setcookie('username', 'guest', time() + 3600, "/"); // set the cookie to 'guest'
    header('Location: glowna.php'); // redirect to the main page
}
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
                <li class="logout-link"><a href="?logout=true">Logout</a></li>
            <?php else : ?>
                <li class="login-link"><a href="loginpage.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<main>
    <form method="POST" action="">
        <div class="passw">
            <h2>CHANGE PASSWORD</h2>
            <label for="new_password">New password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Update password</button>
        </div>
    </form>
</main>

<footer>
    <p>&copy; 2023 Just BLOG. Wszelkie prawa zastrzeżone.</p>
</footer>
</body>
</html>
