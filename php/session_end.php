<?php
session_start();

if (isset($_SESSION['username'])) {
    $name = htmlspecialchars($_SESSION['username']);

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
        destroy_session_and_data();
        include '../html/SessionEnd.html';
    }

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity timestamp
} else {
    include '../html/SessionEnd.html';
}

function destroy_session_and_data()
{
    unset($_SESSION['username']);
    $_SESSION = array();
    session_unset();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
    header("location:../html/login.html");
}
?>
