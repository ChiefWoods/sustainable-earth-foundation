<?php
include_once 'SQL_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voteType = $_POST['voteType'];
    $postId = $_POST['postId'];

    // Validate $voteType and $postId here if needed

    // Initialize variables for column names
    $incrementColumn = '';
    $decrementColumn = '';

    // Set column names based on the vote type
    if ($voteType === 'upvote') {
        $incrementColumn = 'upvote';
        $decrementColumn = 'downvote';
    } elseif ($voteType === 'downvote') {
        $incrementColumn = 'downvote';
        $decrementColumn = 'upvote';
    }

    // Update the database based on the vote type
    $query = "UPDATE post SET $incrementColumn = $incrementColumn + 1, $decrementColumn = $decrementColumn - 1 WHERE id = :postId";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();

        // Return a success message or data if needed
        echo json_encode(['success' => true, 'message' => 'Vote updated successfully']);
    } catch (\PDOException $e) {
        // Handle the error
        echo json_encode(['success' => false, 'error' => 'Error updating vote']);
    }
} else {
    // Handle invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
