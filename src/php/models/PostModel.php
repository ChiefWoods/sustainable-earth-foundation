<?php

class PostModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getAllPosts()
  {
    $query = "SELECT * FROM post";
    $statement = $this->pdo->query($query);
    $posts = $statement->fetchAll();
    return $posts;
  }

  public function createPost($user_id, $title, $post_text)
  {
    $date = date("Y-m-d");
    $query = "INSERT INTO post (user_id, title, post_text, date_posted) VALUES ($user_id, '$title', '$post_text', '$date')";
    $statement = $this->pdo->query($query);
  }
}
