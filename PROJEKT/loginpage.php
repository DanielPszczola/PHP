<!DOCTYPE html>
<html lang="">
<head>
    <title>Strona logowania</title>
    <link rel="stylesheet" type="text/css" href="glowna.css">
    <meta charset="UTF-8">
</head>
<body class="loginpage">
<header>
    <h1>Just BLOG!</h1>
</header>

<div class="nav-container">
    <nav>
        <ul>
            <li><a href="glowna.php">Main Page</a></li>
        </ul>
    </nav>
</div>

<main>
    <?php
    include 'login.php';
    include 'database.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $conn = getDatabaseConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $result = $stmt->fetchAll();

        if (count($result) > 0) {
            setcookie('user_logged_in', true, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie('username', $username, time() + (86400 * 30), "/");
            header('Location: glowna.php');
        } else {
            $_SESSION['error'] = "Nieprawidłowe dane logowania";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
        <form method="post">
            <h2>Just Login</h2>
            <label for="username">User Name:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Zaloguj" class="zaloguj">
            <?php
            if(isset($_SESSION['error'])) {
                echo "<p>".$_SESSION['error']."</p>";
                unset($_SESSION['error']);
            }
            ?>
        </form>

</main>

<footer>
    <p>&copy; 2023 Just BLOG. Wszelkie prawa zastrzeżone.</p>
</footer>
</body>
</html>
