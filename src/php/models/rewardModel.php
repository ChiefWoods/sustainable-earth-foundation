<?php

class RewardModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getRewardId($reward_name)
  {
    $query = "SELECT reward_id FROM reward WHERE reward_name = '$reward_name'";
    $statement = $this->pdo->query($query);
    $reward = $statement->fetch();
    return $reward['reward_id'];
  }

  public function getRewardPoints($reward_id)
  {
    $query = "SELECT reward_points FROM reward WHERE reward_id = $reward_id";
    $statement = $this->pdo->query($query);
    $reward = $statement->fetch();
    return $reward['reward_points'];
  }

  public function getAllRewards()
  {
    $query = "SELECT * FROM reward";
    $statement = $this->pdo->query($query);
    $rewards = $statement->fetchAll();
    return $rewards;
  }

  public function getLargestRedeemableReward($user_points)
  {
    $query = "SELECT reward_name FROM reward WHERE reward_points <= $user_points ORDER BY reward_points DESC LIMIT 1";
    $statement = $this->pdo->query($query);
    $reward = $statement->fetch();
    return $reward['reward_name'];
  }
}
