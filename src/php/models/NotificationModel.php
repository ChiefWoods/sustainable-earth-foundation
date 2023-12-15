<?php

class NotificationModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getLatestNotifications($user_id)
  {
    $query = "SELECT * FROM notification WHERE user_id = $user_id ORDER BY notification_id DESC LIMIT 5";
    $statement = $this->pdo->query($query);
    $notifications = $statement->fetchAll();
    return $notifications;
  }

  public function createNotification($user_id, $category, $data)
  {
    switch ($category) {
      case 'reward':
        $reward_name = $data['reward_name'];
        $reward_points = $data['reward_points'];
        $content = "$reward_name redeemed using $reward_points points.";
        break;
      case 'upvote':
        $title = $data['title'];
        $content = "Your post $title received an upvote.";
        break;
      case 'points':
        $reward_name = $data['reward_name'];
        $content = "You have enough points to redeem reward $reward_name.";
        break;
    }

    $query = "INSERT INTO notification (user_id, category, content) VALUES ($user_id, '$category', '$content')";
    $this->pdo->query($query);
  }

  public function deleteAllUserNotifications($user_id)
  {
    $query = "DELETE FROM notification WHERE user_id = $user_id";
    $this->pdo->query($query);
  }
}
