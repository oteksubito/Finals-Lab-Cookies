<?php
// Check if the cookies are set
if (isset($_COOKIE['firstName']) && isset($_COOKIE['lastName'])) {
    $firstName = htmlspecialchars($_COOKIE['firstName']);
    $lastName = htmlspecialchars($_COOKIE['lastName']);
    echo "Welcome, " . $firstName . " " . $lastName . "!";
} else {
    echo "Welcome, Guest!";
}
?>