<?php
include_once 'SQL_login.php';

// Start or resume the session
session_start();

// Initialize response array for fetching redemption data
$redemptionResponse = [];

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch all redemption data
    $selectAllQuery = "SELECT r.id, r.username, r.used_points, rw.reward_code, r.redemption_date 
    FROM redemption r
    INNER JOIN reward rw ON r.reward_id = rw.id";

    $result = $pdo->query($selectAllQuery);

    if ($result) {
        $redemptions = $result->fetchAll(PDO::FETCH_ASSOC);

        // Add redemption data to the response
        $redemptionResponse['success'] = true;
        $redemptionResponse['redemptions'] = $redemptions;
    } else {
        // Handle SQL error
        $redemptionResponse['error'] = 'Error executing SQL query: ' . $pdo->errorInfo()[2];
    }

} else {
    // Redirect to the login page if the user is not logged in
    $redemptionResponse['error'] = 'User not logged in.';
}

// Ensure that $redemptionResponse['redemptions'] is always an array
if (!isset($redemptionResponse['redemptions']) || !is_array($redemptionResponse['redemptions'])) {
    $redemptionResponse['redemptions'] = [];
}

// Output redemptions directly as a JavaScript array
echo '<script>';
echo 'const redemptions = ' . json_encode($redemptionResponse['redemptions']) . ';';
echo '</script>';

// Initialize response variable for delete operation
$deleteResponse = '';

// Check if the user is logged in
// Check if the user is logged in
if (isset($_SESSION['username'])) {
   // Check if either delete_id or delete_username is set
// Check if either delete_id or delete_username is set
if (isset($_POST['delete_id']) || isset($_POST['delete_username'])) {
    $deleteId = isset($_POST['delete_id']) ? $_POST['delete_id'] : null;
    $deleteUsername = isset($_POST['delete_username']) ? $_POST['delete_username'] : null;

    // Perform deletion in the database
    if (!is_null($deleteId)) {
        $deleteRedemptionQuery = "DELETE FROM redemption WHERE id = :id";
        $deleteRedemptionStmt = $pdo->prepare($deleteRedemptionQuery);
        $deleteRedemptionStmt->bindParam(':id', $deleteId, PDO::PARAM_INT);
    } elseif (!is_null($deleteUsername)) {
        $deleteRedemptionQuery = "DELETE FROM redemption WHERE username = :username";
        $deleteRedemptionStmt = $pdo->prepare($deleteRedemptionQuery);
        $deleteRedemptionStmt->bindParam(':username', $deleteUsername, PDO::PARAM_STR);
    }

    if ($deleteRedemptionStmt->execute()) {
        // Output a simple success message
        $deleteResponse = 'success';
    } else {
        // Output an error message
        $deleteResponse = 'Error deleting redemption from the database: ' . $deleteRedemptionStmt->errorInfo()[2];
    }
} else {
    // Output an error message if either delete_id or delete_username is missing
    $deleteResponse = 'Missing delete_id or delete_username parameter.';
}

}

// Output the response for delete operation
echo $deleteResponse;


?>
