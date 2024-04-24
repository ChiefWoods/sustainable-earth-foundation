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
        <span id="user-points">{$this->userModel->getUserPoints($_SESSION['username'])}</span>
      </div>
    HTML;
  }

  public function generateRewardListUl()
  {
    echo <<<HTML
      <ul class="reward-list">
    HTML;

    $rewards = $this->rewardModel->getAllRewards();

    if (count($rewards) > 0) {
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
    } else {
      echo <<<HTML
        <span id="no-rewards">No rewards available. Come back another time!</span>
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
            <img src="assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
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

  public function redeemReward($rewardName, $rewardPoints)
  {
    session_start();
    $username = $_SESSION['username'];

    if ($this->userModel->getUserPoints($username) >= $rewardPoints) {
      $this->userModel->deductPoints($rewardPoints, $username);

      $reward_id = $this->rewardModel->getRewardId($rewardName);

      $data = [
        'reward_name' => $rewardName,
        'reward_points' => $rewardPoints,
      ];

      $user_id = $this->userModel->getUserId($username);
      $this->redemptionModel->createRedemption($user_id, $reward_id);
      $this->notificationModel->createNotification($user_id, 'reward', $data);
      $userPoints = $this->userModel->getUserPoints($username);
      
      echo json_encode(['status' => 'success', 'message' => 'Reward redeemed successfully!', 'userPoints' => $userPoints]);
    } else {
      echo json_encode(['status' => 'error', 'message' => 'You do not have enough points to redeem this reward.']);
    }
  }
}
