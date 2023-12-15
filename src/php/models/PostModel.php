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

  public function editPost($old_title, $old_post_text, $new_title, $new_post_text)
  {
    $query = "UPDATE post SET title = '$new_title', post_text = '$new_post_text' WHERE title = '$old_title' AND post_text = '$old_post_text'";
    $statement = $this->pdo->query($query);
  }

  public function deletePost($title, $post_text)
  {
    $query = "DELETE FROM post WHERE title = '$title' AND post_text = '$post_text'";
    $statement = $this->pdo->query($query);
  }
}
