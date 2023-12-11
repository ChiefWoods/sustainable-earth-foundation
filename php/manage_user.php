<?php
include_once 'SQL_login.php';

<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
// Start or resume the session
session_start();

// Initialize response array for fetching user data
$userResponse = [];

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch all user data
    $selectAllQuery = "SELECT username, phone_num, email, points FROM tb_user";
    $result = $pdo->query($selectAllQuery);

    if ($result) {
        $users = $result->fetchAll(PDO::FETCH_ASSOC);

        // Add user data to the response
        $userResponse['success'] = true;
        $userResponse['users'] = $users;
    } else {
        // Handle SQL error
        $userResponse['error'] = 'Error executing SQL query: ' . $pdo->errorInfo()[2];
    }
} else {
    // Redirect to the login page if the user is not logged in
    $userResponse['error'] = 'User not logged in.';
}

// Ensure that $userResponse['users'] is always an array
if (!isset($userResponse['users']) || !is_array($userResponse['users'])) {
    $userResponse['users'] = [];
}

// Output users directly as a JavaScript array
echo '<script>';
echo 'const users = ' . json_encode($userResponse['users']) . ';';
echo '</script>';

// Initialize response variable for delete operation
$deleteResponse = '';

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Check if the delete_username parameter is set
    if (isset($_POST['delete_username'])) {
        $deleteUsername = $_POST['delete_username'];

        // Perform deletion in the database
        $deleteUserQuery = "DELETE FROM tb_user WHERE username = :username";
        $deleteUserStmt = $pdo->prepare($deleteUserQuery);
        $deleteUserStmt->bindParam(':username', $deleteUsername, PDO::PARAM_STR);

        if ($deleteUserStmt->execute()) {
            // Output a simple success message
            $deleteResponse = 'success';
        } else {
            // Output an error message
            $deleteResponse = 'Error deleting user from the database: ' . $deleteUserStmt->errorInfo()[2];
        }
    } else {
        // Output an error message if delete_username is missing
        $deleteResponse = 'Missing delete_username parameter.';
    }
} else {
    // Output an error message if the user is not logged in
    $deleteResponse = 'User not logged in.';
}

// Output the response for delete operation
echo $deleteResponse;
?>
