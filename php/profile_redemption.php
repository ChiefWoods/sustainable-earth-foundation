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
    $selectAllQuery = "SELECT r.used_points, rw.reward_code, r.redemption_date 
                      FROM redemption r
                      JOIN reward rw ON r.reward_id = rw.id
                      WHERE r.username = :username";

    $stmt = $pdo->prepare($selectAllQuery);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $redemptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add redemption data to the response
        $redemptionResponse['success'] = true;
        $redemptionResponse['redemptions'] = $redemptions;
    } else {
        // Handle SQL error
        $redemptionResponse['error'] = 'Error executing SQL query: ' . $stmt->errorInfo()[2];
    }

} else {
    // Redirect to the login page if the user is not logged in
    $redemptionResponse['error'] = 'User not logged in.';
}

// Ensure that $redemptionResponse['redemptions'] is always an array
if (!isset($redemptionResponse['redemptions']) || !is_array($redemptionResponse['redemptions'])) {
    $redemptionResponse['redemptions'] = [];
}

// Output redemptions and script directly
echo '<script>';
echo 'const redemptions = ' . json_encode($redemptionResponse['redemptions']) . ';';
echo 'updateRedemptionTable(redemptions);'; // This line executes the updateRedemptionTable function
echo '</script>';
?>
