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
        HTML;

        echo isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0
          ? <<<HTML
                <div class="actions">
                  <button class="upvote-btn">
                    <img src="../../assets/icons/upvote/upvote.svg" alt="Upvote" class="action-icon">
                  </button>
                  <button class="downvote-btn">
                    <img src="../../assets/icons/downvote/downvote.svg" alt="Downvote" class="action-icon">
                  </button>
                </div>
              </div>
            HTML
          : <<<HTML
                <div class="actions">
                  <button class="edit-btn">
                    <img src="../../assets/icons/edit/edit.svg" alt="Edit" class="action-icon">
                  </button>
                  <button class="delete-btn">
                    <img src="../../assets/icons/delete/delete.svg" alt="Delete" class="action-icon">
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

  public function generateCreateDialog()
  {
    echo <<<HTML
      <dialog id="create-dialog">
        <div class="dialog-top">
          <h3 class="dialog-title">Create Post</h3>
          <button class="close-btn">
            <img src="../../assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
          </button>
        </div>
        <form class="dialog-bottom">
          <div class="post-input">
            <input type="text" name="title" placeholder="Title" id="post-title">
            <textarea name="post-text" id="post-text" placeholder="Content"></textarea>
          </div>
          <div class="dialog-options">
            <button type="submit" id="post-btn" class="confirmation-btn option-btn">Post</button>
          </div>
        </form>
      </dialog>
    HTML;
  }

  public function generateEditDialog()
  {
    echo <<<HTML
      <dialog id="edit-dialog">
        <div class="dialog-top">
          <h3 class="dialog-title">Edit Post</h3>
          <button class="close-btn">
            <img src="../../assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
          </button>
        </div>
        <form class="dialog-bottom">
          <div class="post-input">
            <input type="text" name="title" placeholder="Title" id="post-title">
            <textarea name="post-text" id="post-text" placeholder="Content"></textarea>
          </div>
          <div class="dialog-options">
            <button type="submit" id="edit-btn" class="confirmation-btn option-btn">Edit</button>
          </div>
        </form>
      </dialog>
    HTML;
  }

  public function generateDeleteDialog()
  {
    echo <<<HTML
      <dialog id="delete-dialog">
        <div class="dialog-top">
          <h3 class="dialog-title">Delete Post</h3>
          <button class="close-btn">
            <img src="../../assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
          </button>
        </div>
        <div class="dialog-bottom">
          <p>Delete this post?</p>
          <div class="dialog-options">
            <button id="cancel-btn" class="option-btn">Cancel</button>
            <button id="delete-btn" class="confirmation-btn option-btn">Delete</button>
          </div>
        </div>
      </dialog>
    HTML;
  }

  public function createPost($title, $postText)
  {
    session_start();
    $user_id = $this->userModel->getUserId($_SESSION['username']);
    $this->postModel->createPost($user_id, $title, $postText);
    echo json_encode(['status' => 'success', 'message' => 'Post created successfully!']);
  }
}
