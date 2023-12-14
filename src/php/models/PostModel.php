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
}
