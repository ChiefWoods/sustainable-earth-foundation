<?php
session_start();

if (isset($_SESSION['username'])) {
    $name = htmlspecialchars($_SESSION['username']);

    destroy_session_and_data();

    // Redirect to the home page
    header("Location: index.php");
    exit();
} else {
    // Redirect to the home page if not logged in
    header("Location: index.php");
    exit();
}

function destroy_session_and_data()
{
    unset($_SESSION['username']);
    $_SESSION = array();
    session_unset();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
}
?>
