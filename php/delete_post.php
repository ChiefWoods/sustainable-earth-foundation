<?php
include_once 'SQL_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming the post ID is sent as a POST parameter named 'postId'
    $postId = isset($_POST['postId']) ? $_POST['postId'] : null;
    echo 'Received postId: ' . $postId;
    if ($postId) {
        try {
            // Perform the deletion in the database
            $deleteQuery = "DELETE FROM post WHERE id = :postId";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $deleteStmt->execute();

            // Check if any row was affected
            $rowCount = $deleteStmt->rowCount();
            
            if ($rowCount > 0) {
                // Deletion successful
                echo json_encode(['success' => 'success']);
            } else {
                // No rows affected, likely the post with the given ID does not exist
                echo json_encode(['error' => 'Post not found']);
            }
        } catch (\PDOException $e) {
            // Handle the error here
            echo json_encode(['error' => 'Error deleting post: ' . $e->getMessage()]);
        }
    } else {
        // No postId provided in the request
        echo json_encode(['error' => 'Invalid request']);
    }
} else {
    // Invalid request method
    echo json_encode(['error' => 'Invalid request method']);
}
?>
