<?php
include_once 'SQL_login.php'; // Make sure to include your database connection logic

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have user authentication and obtain username from the session or elsewhere.
    $username = $_SESSION['username'];  // Replace with your actual session variable.

    // Retrieve post data from the AJAX request
    $postTitle = $_POST['postTitle'];
    $postContent = $_POST['postContent'];

    // Validate if the title and content are not empty
    if (empty($postTitle) || empty($postContent)) {
        echo json_encode(['error' => 'Please enter both title and content.']);
        exit();
    }

    // Insert post data into the post table
    $query = "INSERT INTO post (username, title, content) VALUES (:username, :postTitle, :postContent)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':postTitle', $postTitle, PDO::PARAM_STR);
    $stmt->bindParam(':postContent', $postContent, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo json_encode(['success' => 'Post created successfully.']);
    } catch (\PDOException $e) {
        echo json_encode(['error' => 'Error creating post: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
