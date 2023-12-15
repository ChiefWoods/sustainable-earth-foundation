<?php

class UpvoteModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function createUpvote($user_id, $post_id)
  {
    $query = "INSERT INTO upvote (user_id, post_id) VALUES ($user_id, $post_id)";
    $this->pdo->query($query);
  }

  public function removeUpvote($user_id, $post_id)
  {
    $query = "DELETE FROM upvote WHERE user_id = $user_id AND post_id = $post_id";
    $this->pdo->query($query);
  }

  public function doesUpvoteExist($user_id, $post_id)
  {
    $query = "SELECT * FROM upvote WHERE user_id = $user_id AND post_id = $post_id";
    $statement = $this->pdo->query($query);
    return $statement->rowCount() > 0;
  }

  public function removeAllUpvotes($post_id)
  {
    $query = "DELETE FROM upvote WHERE post_id = $post_id";
    $this->pdo->query($query);
  }
}