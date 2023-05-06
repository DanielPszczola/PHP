<?php
// sprawdzenie, czy ciasteczko już istnieje
if (!isset($_COOKIE['visits'])) {
    // ustawienie wartości początkowej ciasteczka
    setcookie('visits', 1, time() + (60 * 60 * 24 * 30), "/"); // ciasteczko ważne przez 30 dni
    $visits = 1;
} else {
    $visits = $_COOKIE['visits'];
}

// sprawdzenie, czy ciasteczko użytkownika już istnieje
if (!isset($_COOKIE['user_id'])) {
    // wygenerowanie unikalnego identyfikatora użytkownika
    $user_id = uniqid();
    // ustawienie ciasteczka user_id na wygenerowany identyfikator
    setcookie('user_id', $user_id, time() + (60 * 60 * 24 * 30), "/");
    // zwiększenie liczby unikalnych użytkowników
    if (!isset($_COOKIE['unique_users'])) {
        setcookie('unique_users', 1, time() + (60 * 60 * 24 * 30), "/");
    } else {
        $unique_users = $_COOKIE['unique_users'] + 1;
        setcookie('unique_users', $unique_users, time() + (60 * 60 * 24 * 30), "/");
    }
} else {
    $user_id = $_COOKIE['user_id'];
}

// sprawdzenie, czy strona została odświeżona
if (!isset($_COOKIE['refreshed'])) {
    // zwiększenie liczby odwiedzin tylko wtedy, gdy strona nie została odświeżona
    $visits++;
    // ustawienie ciasteczka refreshed na true, aby oznaczyć, że strona została odwiedzona
    setcookie('refreshed', 'true', time() + (60 * 60 * 24 * 30), "/");
    // zapisanie nowej wartości ciasteczka visits
    setcookie('visits', $visits, time() + (60 * 60 * 24 * 30), "/");
}

// wyświetlenie liczby odwiedzin i unikalnych użytkowników
echo "Liczba odwiedzin: $visits <br>";
echo "Liczba unikalnych użytkowników: " . $_COOKIE['unique_users'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Moja strona</title>
</head>
<body>

<h1>Witaj na mojej stronie!</h1>

</body>
</html>






