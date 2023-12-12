<?php 
    // Example: Set $user_role_id based on your logic
    $user_role_id = isset($_SESSION['user_role_id']) ? $_SESSION['user_role_id'] : 0;

    // Determine which header to include based on the user's role ID
    if ($user_role_id == 1) {
        $header_file = '../html/admin-header.html';
    } elseif ($user_role_id == 2) {
        $header_file = '../html/user-header.html';
    } else {
        $header_file = '../html/header.html';
    }

    // Include the dynamically determined header file
    include $header_file;
?>
