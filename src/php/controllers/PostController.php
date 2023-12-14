<?php

class PostController
{
  private $pdo;
  private $postModel;
  private $userModel;

  public function __construct($pdo, $postModel, $userModel)
  {
    $this->pdo = $pdo;
    $this->postModel = $postModel;
    $this->userModel = $userModel;
  }

  public function generateCreatePostBtn()
  {
    echo <<<HTML
      <button id="create-post-btn" class="btn">
        <img src="../../assets/icons/add_post/add_post_white.svg" alt="Create Post">
        <span>Create Post</span>
      </button>
    HTML;
  }

  public function generateWall()
  {
    echo <<<HTML
      <div id="wall">
    HTML;

    $posts = $this->postModel->getAllPosts();

    if (count($posts) > 0) {
      foreach ($posts as $post) {
        $username = $this->userModel->getUsername($post['user_id']);

        echo <<<HTML
          <div class="post">
            <div class="top">
              <span class="username">$username</span>
              <span class="date">$post[date_posted]</span>
            </div>
            <div class="middle">
              <h3 class="post-title">$post[title]</h3>
              <p class="post-content">$post[post_text]</p>
            </div>
            <div class="votes">
              <button id="upvote-btn">
                <img src="../../assets/icons/upvote/upvote.svg" alt="Upvote" class="vote-icon">
              </button>
              <button id="downvote-btn">
                <img src="../../assets/icons/downvote/downvote.svg" alt="Downvote" class="vote-icon">
              </button>
            </div>
          </div>
        HTML;
      }
    }

    echo <<<HTML
      </div>
    HTML;
  }
}
