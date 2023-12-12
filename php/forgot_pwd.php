<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start a new session or resume the existing session
session_start();

ob_start(); // Start output buffering

require_once 'SQL_login.php';

// Log PHP errors to a file
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

header('Content-Type: application/json');

$response = ['success' => false, 'debug' => []];

try {
    // Check if PDO connection is successful
    $pdo = new PDO($attr, $user, $pass, $opts);
    $response['debug'][] = 'Database connection successful';
} catch (\PDOException $e) {
    $response['error'] = 'Database connection failed: ' . htmlspecialchars($e->getMessage());
    echo json_encode($response);
    exit();
}

if (isset($_POST['username']) && isset($_POST['newPassword']) && isset($_POST['comNewPassword'])) {
    $username = $_POST['username'];
    $newpwd_temp = $_POST['newPassword'];
    $comnewpwd_temp = $_POST['comNewPassword'];

    $response['debug']['username'] = $username;
    $response['debug']['newPassword'] = $newpwd_temp;

    $query = "SELECT * FROM tb_user WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        $response['error'] = 'Query execution error: ' . print_r($stmt->errorInfo(), true);
        echo json_encode($response);
        exit();
    }

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $stored_password = $row['password'];
        $user_role_id = $row['user_role_id'];

        $response['debug']['stored_password'] = $stored_password;
        $response['debug']['input_password'] = $newpwd_temp;

        // Check if passwords match
        if ($newpwd_temp !== $comnewpwd_temp) {
            $response['error'] = 'Passwords do not match';
        } else {
            // Update the user's password in the database
            $updateQuery = "UPDATE tb_user SET password = :password WHERE username = :username";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':password', $newpwd_temp, PDO::PARAM_STR);
            $updateStmt->bindParam(':username', $username, PDO::PARAM_STR);

            if (!$updateStmt->execute()) {
                $response['error'] = 'Query execution error: ' . print_r($updateStmt->errorInfo(), true);
            } else {
                $response['success'] = true;
                $response['message'] = 'Password updated successfully';

                // Redirect based on user_role_id
                if ($user_role_id == 1) {
                    session_start();
                    $response['redirect'] = '../html/admin-profile.html';
                } elseif ($user_role_id == 2) {
                    session_start();
                    $response['redirect'] = '../html/profile.html';
                }
            }
        }
    } else {
        $response['error'] = 'User not found';
    }
} else {
    $response['error'] = 'Please enter both new passwords and the username';
}

// Log debug information to a file
file_put_contents('debug_log.json', json_encode($response['debug'], JSON_PRETTY_PRINT));

ob_end_clean(); // Clean (discard) the buffer

// Output the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
