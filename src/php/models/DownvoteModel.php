<?php

class DownvoteModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function createDownvote($user_id, $post_id)
  {
    $query = "INSERT INTO downvote (user_id, post_id) VALUES ($user_id, $post_id)";
    $this->pdo->query($query);
  }

  public function removeDownvote($user_id, $post_id)
  {
    $query = "DELETE FROM downvote WHERE user_id = $user_id AND post_id = $post_id";
    $this->pdo->query($query);
  }

  public function doesDownvoteExist($user_id, $post_id)
  {
    $query = "SELECT * FROM downvote WHERE user_id = $user_id AND post_id = $post_id";
    $statement = $this->pdo->query($query);
    return $statement->rowCount() > 0;
  }

  public function removeAllDownvotes($post_id)
  {
    $query = "DELETE FROM downvote WHERE post_id = $post_id";
    $this->pdo->query($query);
  }
}