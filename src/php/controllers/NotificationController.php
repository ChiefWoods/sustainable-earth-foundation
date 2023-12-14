<?php

class NotificationController
{
  private $pdo;
  private $userModel;
  private $notificationModel;

  public function __construct($pdo, $userModel, $notificationModel)
  {
    $this->pdo = $pdo;
    $this->userModel = $userModel;
    $this->notificationModel = $notificationModel;
  }

  public function generateNotificationLi()
  {
    $user_id = $this->userModel->getUserId($_SESSION['username']);
    $notifications = $this->notificationModel->getLatestNotifications($user_id);

    foreach ($notifications as $notification) {
      $category = $notification['category'];

      switch ($category) {
        case 'upvote':
          $href = "../views/sticky_wall.php";
          $src = "../../assets/icons/upvote/upvote_selected_blue.svg";
          $alt = "Upvoted";
          $class = "upvote-icon";
          break;
        case 'reward':
          $href = "../views/profile.php";
          $src = "../../assets/icons/reward/reward_blue.svg";
          $alt = "Reward";
          $class = "reward-icon";
          break;
        case 'points':
          $href = "../views/rewards.php";
          $src = "../../assets/icons/points/points_blue.svg";
          $alt = "Points";
          $class = "points-icon";
          break;
      }

      echo <<<HTML
      <li>
        <a href="$href">
          <img src="$src" alt="$alt" class="icon $class">
          <span class="dropdown-content">$notification[content]</span>
        </a>
      </li>
      HTML;
    }
  }
}
