<?php

function isUserLoggedIn() {
    return isset($_COOKIE['user_logged_in']) && $_COOKIE['user_logged_in'] == true;
}
function logOut(){
    if (isset($_GET['logout'])) {
        setcookie('user_logged_in', '', time() - 3600, "/"); // unset the cookie
        setcookie('username', 'guest', time() + 3600, "/"); // set the cookie to 'guest'
        header('Location: glowna.php'); // redirect to the main page
    }
}

