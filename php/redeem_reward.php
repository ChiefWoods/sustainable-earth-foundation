<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'SQL_login.php'; // Include your database connection file

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Get the reward details from the POST request
    $rewardCode = isset($_POST['rewardCode']) ? $_POST['rewardCode'] : '';

    // Fetch reward details
    $selectRewardQuery = "SELECT id, points FROM reward WHERE reward_code = :reward_code";
    $selectRewardStmt = $pdo->prepare($selectRewardQuery);
    $selectRewardStmt->bindParam(':reward_code', $rewardCode, PDO::PARAM_STR);

    if ($selectRewardStmt->execute()) {
        $rewardDetails = $selectRewardStmt->fetch(PDO::FETCH_ASSOC);

        if ($rewardDetails) {
            $pointsNeeded = $rewardDetails['points'];
            $rewardId = $rewardDetails['id'];

            // Fetch user's current points
            $selectPointsQuery = "SELECT points FROM tb_user WHERE username = :username";
            $selectPointsStmt = $pdo->prepare($selectPointsQuery);
            $selectPointsStmt->bindParam(':username', $username, PDO::PARAM_STR);

            if ($selectPointsStmt->execute()) {
                $userPoints = (int)$selectPointsStmt->fetchColumn(); // Cast to integer

                // Check if user has enough points for redemption
                if ($userPoints >= $pointsNeeded) {
                    // Update user's points
                    $updatedPoints = $userPoints - $pointsNeeded;
                    $updatePointsQuery = "UPDATE tb_user SET points = :points WHERE username = :username";
                    $updatePointsStmt = $pdo->prepare($updatePointsQuery);
                    $updatePointsStmt->bindParam(':points', $updatedPoints, PDO::PARAM_INT);
                    $updatePointsStmt->bindParam(':username', $username, PDO::PARAM_STR);

                    // Insert a record into the redemption table
                    $insertRedemptionQuery = "INSERT INTO redemption (username, used_points, reward_id, reward_code) 
                                              VALUES (:username, :used_points, :reward_id, :reward_code)";
                    $insertRedemptionStmt = $pdo->prepare($insertRedemptionQuery);
                    $insertRedemptionStmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $insertRedemptionStmt->bindParam(':used_points', $pointsNeeded, PDO::PARAM_INT);
                    $insertRedemptionStmt->bindParam(':reward_id', $rewardId, PDO::PARAM_INT);
                    $insertRedemptionStmt->bindParam(':reward_code', $rewardCode, PDO::PARAM_STR);

                    // Start a transaction to ensure data integrity
                    $pdo->beginTransaction();

                    try {
                        // Execute the update and insert statements
                        $updatePointsStmt->execute();
                        $insertRedemptionStmt->execute();

                        // Commit the transaction
                        $pdo->commit();

                        echo 'success';
                    } catch (PDOException $e) {
                        // Rollback the transaction in case of an error
                        $pdo->rollBack();
                        echo 'Error redeeming reward.';
                    }
                } else {
                    echo 'Insufficient points for redemption.';
                }
            } else {
                echo 'Error fetching user points.';
            }
        } else {
            echo 'Invalid reward code.';
        }
    } else {
        echo 'Error fetching reward details.';
    }
} else {
    echo 'User not logged in.';
}
?>
