<?php
include_once 'SQL_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['postId'];
    $editPostTitle = $_POST['editPostTitle'];
    $editPostContent = $_POST['editPostContent'];

    // Update post data in the database
    $query = "UPDATE post SET title = :editPostTitle, content = :editPostContent WHERE id = :postId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
    $stmt->bindParam(':editPostTitle', $editPostTitle, PDO::PARAM_STR);
    $stmt->bindParam(':editPostContent', $editPostContent, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo 'success';
    } catch (\PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request method.';
}
?>
