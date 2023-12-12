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

if (isset($_POST['username']) && isset($_POST['phoneNum']) && isset($_POST['Email']) && isset($_POST['password']) && isset($_POST['comPassword'])) {
    $username = $_POST['username'];
    $phoneNum = $_POST['phoneNum'];
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $comPassword = $_POST['comPassword'];

    // Check if username already exists
    $query = "SELECT * FROM tb_user WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        $response['error'] = 'Query execution error: ' . print_r($stmt->errorInfo(), true);
        echo json_encode($response);
        exit();
    }

    if ($stmt->rowCount() > 0) {
        $response['error'] = 'Username already exists';
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO tb_user (username, phone_num, email, password, confirm_password) VALUES (:username, :phoneNum, :email, :password, :comPassword)";
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->bindParam(':username', $username, PDO::PARAM_STR);
        $insertStmt->bindParam(':phoneNum', $phoneNum, PDO::PARAM_STR);
        $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $insertStmt->bindParam(':password', $password, PDO::PARAM_STR);
        $insertStmt->bindParam(':comPassword', $comPassword, PDO::PARAM_STR);

        if (!$insertStmt->execute()) {
            $response['error'] = 'Query execution error: ' . print_r($insertStmt->errorInfo(), true);
        } else {
            $response['success'] = true;
            $response['message'] = 'User registered successfully';
        }
    }
} else {
    $response['error'] = 'Please fill out all the fields';
}

// Log debug information to a file
file_put_contents('debug_log.json', json_encode($response['debug'], JSON_PRETTY_PRINT));

ob_end_clean(); // Clean (discard) the buffer

// Output the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
