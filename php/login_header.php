<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Example: Set $user_role_id based on your logic
$user_role_id = isset($_SESSION['user_role_id']) ? $_SESSION['user_role_id'] : 0;

// Determine which header to include based on the user's role ID
if ($user_role_id == 1) {
    include '../html/admin-header.html';
} elseif ($user_role_id == 2) {
    include '../html/user-header.html';
} else {
    include '../html/header.html';
}