<?php
session_start();

// Include your database connection file
include_once 'SQL_login.php';

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user's current points
    $selectPointsQuery = "SELECT points FROM tb_user WHERE username = :username";
    $selectPointsStmt = $pdo->prepare($selectPointsQuery);
    $selectPointsStmt->bindParam(':username', $username, PDO::PARAM_STR);

    if ($selectPointsStmt->execute()) {
        $userPoints = $selectPointsStmt->fetchColumn();
        echo $userPoints;
    } else {
        echo 'Error fetching user points.';
    }
} else {
    echo 'User not logged in.';
}
?>
