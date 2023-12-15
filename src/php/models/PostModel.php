<?php

class PostModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getPostId($title, $post_text)
  {
    $query = "SELECT post_id FROM post WHERE title = '$title' AND post_text = '$post_text'";
    $statement = $this->pdo->query($query);
    $post = $statement->fetch();
    return $post['post_id'];
  }

  public function getUserId($post_id)
  {
    $query = "SELECT user_id FROM post WHERE post_id = $post_id";
    $statement = $this->pdo->query($query);
    $post = $statement->fetch();
    return $post['user_id'];
  }

  public function getAllPosts()
  {
    $query = "SELECT * FROM post ORDER BY upvotes DESC";
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

  public function deleteAllUserPosts($user_id)
  {
    $query = "DELETE FROM post WHERE user_id = $user_id";
    $statement = $this->pdo->query($query);
  }

  public function upvotePost($title, $post_text)
  {
    $query = "UPDATE post SET upvotes = upvotes + 1 WHERE title = '$title' AND post_text = '$post_text'";
    $statement = $this->pdo->query($query);
  }

  public function downvotePost($title, $post_text)
  {
    $query = "UPDATE post SET downvotes = downvotes + 1 WHERE title = '$title' AND post_text = '$post_text'";
    $statement = $this->pdo->query($query);
  }

  public function removeUpvote($title, $post_text)
  {
    $query = "UPDATE post SET upvotes = upvotes - 1 WHERE title = '$title' AND post_text = '$post_text'";
    $statement = $this->pdo->query($query);
  }

  public function removeDownvote($title, $post_text)
  {
    $query = "UPDATE post SET downvotes = downvotes - 1 WHERE title = '$title' AND post_text = '$post_text'";
    $statement = $this->pdo->query($query);
  }
}
