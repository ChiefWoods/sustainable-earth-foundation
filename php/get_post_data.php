<?php
include_once 'SQL_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['postId'];

    // Fetch post data from the database
    $query = "SELECT title, content FROM post WHERE id = :postId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
    $stmt->execute();
    $postData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return post data as JSON
    echo json_encode($postData);
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}