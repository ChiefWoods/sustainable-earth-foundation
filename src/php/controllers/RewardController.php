<?php

class RewardController
{
  private $pdo;
  private $userModel;
  private $rewardModel;
  private $redemptionModel;
  private $notificationModel;

  public function __construct($pdo, $userModel, $rewardModel, $redemptionModel, $notificationModel)
  {
    $this->pdo = $pdo;
    $this->userModel = $userModel;
    $this->rewardModel = $rewardModel;
    $this->redemptionModel = $redemptionModel;
    $this->notificationModel = $notificationModel;
  }

  public function generateSavedPointsDiv()
  {
    echo <<<HTML
      <div id="saved-points">
        <span>Saved Points</span>
        <span id="user-points">{$this->userModel->getUserPoints()}</span>
      </div>
    HTML;
  }

  public function generateRewardListUl()
  {
    echo <<<HTML
      <ul class="reward-list">
    HTML;

    $rewards = $this->rewardModel->getAllRewards();

    foreach ($rewards as $reward) {
      echo <<<HTML
        <li>
          <div>
            <h3 class="reward-name">$reward[reward_name]</h3>
            <p class="reward-points">$reward[reward_points] points</p>
          </div>
          <button href="../views/rewards.php" class="btn redeem-btn">Redeem</button>
        </li>
      HTML;
    }

    echo <<<HTML
      </ul>
    HTML;
  }

  public function generateRewardDialogs()
  {
    echo <<<HTML
      <dialog id="redeem-dialog">
        <div class="dialog-top">
          <h3 class="dialog-title">Redeem Reward</h3>
          <button class="close-btn">
            <img src="../../assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
          </button>
        </div>
        <div class="dialog-bottom">
          <p>Redeem this reward?</p>
          <div class="dialog-options">
            <button id="cancel-btn" class="option-btn">Cancel</button>
            <button id="yes-btn" class="confirmation-btn option-btn">Yes</button>
          </div>
        </div>
      </dialog>
    HTML;
  }

  public function redeemReward()
  {
    if ($this->userModel->getUserPoints() >= $_POST['reward_points']) {
      $this->userModel->deductPoints($_POST['reward_points']);

      $reward_id = $this->rewardModel->getRewardId($_POST['reward_name']);

      $data = [
        'reward_name' => $_POST['reward_name'],
        'reward_points' => $_POST['reward_points']
      ];

      $this->redemptionModel->createRedemption($this->userModel->getUserId(), $reward_id);
      $this->notificationModel->createNotification($this->userModel->getUserId(), 'reward', $data);

      echo "<script>console.log('Reward redeemed successfully!')</script>";
      header("location:../views/rewards.php");
      exit;
    } else {
      echo "<script>alert('You do not have enough points to redeem this reward.')</script>";
      header("location:../views/rewards.php");
      exit;
    }
  }
}
