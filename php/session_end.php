<?php
session_start();

if (isset($_SESSION['username'])) {
    $name = htmlspecialchars($_SESSION['username']);

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
        // Redirect to SessionEnd.html and exit
        header("Location: ../html/SessionEnd.html");
        exit();
    }

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity timestamp
} else {
    // Redirect to SessionEnd.html and exit
    echo "Hi $name.<br> Inactive for 5 seconds will logout";
    header("refresh:5;url=../html/SessionEnd.html"); // Redirect after 5 seconds
    exit();
}

function destroy_session_and_data()
{
   unset($_SESSION['username']);
   $_SESSION = array();
   session_unset();
   setcookie(session_name(), '', time() - 2592000, '/');
   session_destroy();
   header("Location: login.php");
   exit();
}
?>