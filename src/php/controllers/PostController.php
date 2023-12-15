<?php

class PostController
{
  private $pdo;
  private $postModel;
  private $userModel;
  private $upvoteModel;
  private $downvoteModel;
  private $notificationModel;

  public function __construct($pdo, $postModel, $userModel, $upvoteModel, $downvoteModel, $notificationModel)
  {
    $this->pdo = $pdo;
    $this->postModel = $postModel;
    $this->userModel = $userModel;
    $this->upvoteModel = $upvoteModel;
    $this->downvoteModel = $downvoteModel;
    $this->notificationModel = $notificationModel;
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
    
    if (isset($_SESSION['username'])) {
      $user_id = $this->userModel->getUserId($_SESSION['username']);
    } else {
      $user_id = false;
    }

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

        if ($user_id) {
          if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0) {
            echo <<<HTML
              <div class="actions">
                <button class="upvote-btn">
            HTML;
            if ($this->upvoteModel->doesUpvoteExist($user_id, $post['post_id'])) {
              echo <<<HTML
                  <img src="../../assets/icons/upvote/upvote_selected.svg" alt="Upvote-selected" class="action-icon">
                </button>
              HTML;
            } else {
              echo <<<HTML
                  <img src="../../assets/icons/upvote/upvote.svg" alt="Upvote" class="action-icon">
                </button>
              HTML;
            }
            if ($this->downvoteModel->doesDownvoteExist($user_id, $post['post_id'])) {
              echo <<<HTML
                <button class="downvote-btn">
                  <img src="../../assets/icons/downvote/downvote_selected.svg" alt="Downvote-selected" class="action-icon">
              HTML;
            } else {
              echo <<<HTML
                <button class="downvote-btn">
                  <img src="../../assets/icons/downvote/downvote.svg" alt="Downvote" class="action-icon">
              HTML;
            }
            echo <<<HTML
                  </button>
                </div>
              </div>
            HTML;
          } else {
            echo <<<HTML
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
        } else {
          echo <<<HTML
            </div>
          HTML;
        }
      }
    } else {
      echo <<<HTML
        <span id="no-posts">It's a little empty here...</span>
      HTML;
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
            <textarea name="post-content" id="post-content" placeholder="Content"></textarea>
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
            <textarea name="post-content" id="post-content" placeholder="Content"></textarea>
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

  public function editPost($old_title, $old_post_text, $new_title, $new_post_text)
  {
    $this->postModel->editPost($old_title, $old_post_text, $new_title, $new_post_text);
    echo json_encode(['status' => 'success', 'message' => 'Post edited successfully!']);
  }

  public function deletePost($title, $post_text)
  {
    $post_id = $this->postModel->getPostId($title, $post_text);
    $this->postModel->deletePost($title, $post_text);
    $this->upvoteModel->removeAllUpvotes($post_id);
    $this->downvoteModel->removeAllDownvotes($post_id);
    echo json_encode(['status' => 'success', 'message' => 'Post deleted successfully!']);
  }

  public function upvotePost($title, $post_text)
  {
    session_start();
    $user_id = $this->userModel->getUserId($_SESSION['username']);
    $post_id = $this->postModel->getPostId($title, $post_text);
    $post_owner_id = $this->postModel->getUserId($post_id);
    $post_owner_username = $this->userModel->getUsername($post_owner_id);
    $this->postModel->upvotePost($title, $post_text);
    $this->upvoteModel->createUpvote($user_id, $post_id);
    $this->userModel->incrementPoints($post_owner_username);
    $this->notificationModel->createNotification($post_owner_id, 'upvote', ['title' => $title]);
    echo json_encode(['status' => 'success', 'message' => 'Post upvoted successfully!']);
  }

  public function downvotePost($title, $post_text)
  {
    session_start();
    $user_id = $this->userModel->getUserId($_SESSION['username']);
    $post_id = $this->postModel->getPostId($title, $post_text);
    $this->postModel->downvotePost($title, $post_text);
    $this->downvoteModel->createDownvote($user_id, $post_id);
    echo json_encode(['status' => 'success', 'message' => 'Post downvoted successfully!']);
  }

  public function removeUpvote($title, $post_text)
  {
    session_start();
    $user_id = $this->userModel->getUserId($_SESSION['username']);
    $post_id = $this->postModel->getPostId($title, $post_text);
    $this->postModel->removeUpvote($title, $post_text);
    $this->upvoteModel->removeUpvote($user_id, $post_id);
    echo json_encode(['status' => 'success', 'message' => 'Post upvote removed successfully!']);
  }

  public function removeDownvote($title, $post_text)
  {
    session_start();
    $user_id = $this->userModel->getUserId($_SESSION['username']);
    $post_id = $this->postModel->getPostId($title, $post_text);
    $this->postModel->removeDownvote($title, $post_text);
    $this->downvoteModel->removeDownvote($user_id, $post_id);
    echo json_encode(['status' => 'success', 'message' => 'Post downvote removed successfully!']);
  }
}
