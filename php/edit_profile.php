<?php
include_once 'SQL_login.php';

// Start or resume the session
session_start();

// Initialize response array
$response = [];

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user data
    $selectQuery = "SELECT phone_num, email ,points FROM tb_user WHERE username = ?";
    $stmt = $pdo->prepare($selectQuery);

    if ($stmt) {
        $stmt->bindParam(1, $username);
        $stmt->execute();

        if (!$stmt->errno) {
            $stmt->bindColumn('phone_num', $userPhoneNum);
            $stmt->bindColumn('email', $userEmail);
            $stmt->bindColumn('points', $earnedPoints);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt->closeCursor();

            // Set default values if data is not available
            $userPhoneNum = isset($userPhoneNum) ? $userPhoneNum : "";
            $userEmail = isset($userEmail) ? $userEmail : "";
            $earnedPoints = isset($earnedPoints) ? $earnedPoints : 0;

            // Add user data to the response
            $response['success'] = true;
            $response['username'] = $username;
            $response['userPhoneNum'] = $userPhoneNum;
            $response['userEmail'] = $userEmail;
            $response['earnedPoints'] = $earnedPoints;
        } else {
            // Handle SQL error
            $response['error'] = 'Error executing SQL query.';
        }
    } else {
        // Handle SQL error
        $response['error'] = 'Database error.';
    }
} else {
    // Redirect to the login page if the user is not logged in
    $response['error'] = 'User not logged in.';
}

// Process form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have form field names as 'phoneNum', 'email', etc.
    $phoneNum = $_POST['phoneNum'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $comPhoneNum = $_POST['comPhoneNum'];
    $comEmail = $_POST['comEmail'];
    $comPassword = $_POST['comPassword'];

    // Validate and update the user profile as needed

    // Add any necessary response data based on the update operation
    $response['updateSuccess'] = true;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have form field names as 'phoneNum', 'email', etc.
    $phoneNum = $_POST['phoneNum'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $comPhoneNum = $_POST['comPhoneNum'];
    $comEmail = $_POST['comEmail'];
    $comPassword = $_POST['comPassword'];

    // Validate form data
    if (empty($phoneNum) || empty($email) || empty($password) || empty($comPhoneNum) || empty($comEmail) || empty($comPassword)) {
        $response['validationError'] = 'Please insert all the info.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['validationError'] = 'Invalid email format.';
    } elseif (!ctype_digit($phoneNum) || !ctype_digit($comPhoneNum)) {
        $response['validationError'] = 'Phone numbers must be integers.';
    } elseif ($password !== $comPassword) {
        $response['validationError'] = 'Password and Confirm Password must match.';
    } elseif ($email !== $comEmail) {
        $response['validationError'] = 'Email and Confirm Email must match.';
    } elseif ($phoneNum !== $comPhoneNum) {
        $response['validationError'] = 'Phone Number and Confirm Phone Number must match.';
    } else {
        // Update user profile in the database
        $updateQuery = "UPDATE tb_user SET phone_num = ?, email = ? WHERE username = ?";
        $stmt = $pdo->prepare($updateQuery);

        if ($stmt) {
            $stmt->bindParam(1, $phoneNum, PDO::PARAM_INT);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $_SESSION['username'], PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Update successful
                $response['updateSuccess'] = true;
                $response['message'] = 'Info Updated';
            } else {
                $response['updateError'] = 'Error updating user profile.';
            }
        } else {
            $response['updateError'] = 'Error preparing SQL statement.';
        }
        
    }
}?>