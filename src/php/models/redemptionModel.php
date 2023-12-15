<?php

class RedemptionModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getAllRedemptions()
  {
    $query = "SELECT * FROM redemption";
    $statement = $this->pdo->query($query);
    $redemptions = $statement->fetchAll();
    return $redemptions;
  }

  public function createRedemption($user_id, $reward_id)
  {
    $redemption_code = $this->generateRewardCode();
    $date_redeemed = date("Y-m-d");
    $query = "INSERT INTO redemption (user_id, reward_id, redemption_code, date_redeemed) VALUES ($user_id, $reward_id, '$redemption_code', '$date_redeemed')";
    $this->pdo->query($query);
  }

  public function editRedemption($oldRedemptionCode, $newRedemptionCode, $date_redeemed) 
  {
    $query = "UPDATE redemption SET redemption_code = '$newRedemptionCode', date_redeemed = '$date_redeemed' WHERE redemption_code = '$oldRedemptionCode'";
    $this->pdo->query($query);
  }

  public function deleteRedemption($redemption_code)
  {
    $query = "DELETE FROM redemption WHERE redemption_code = '$redemption_code'";
    $this->pdo->query($query);
  }

  public function findRedemptions($searchValue)
  {
    $query = "SELECT user.username, reward.reward_points, redemption.redemption_code, redemption.date_redeemed FROM redemption INNER JOIN user ON redemption.user_id = user.user_id INNER JOIN reward ON redemption.reward_id = reward.reward_id WHERE user.username LIKE '%$searchValue%' OR CAST(reward.reward_points AS SIGNED) = '$searchValue' OR redemption_code LIKE '%$searchValue%' OR date_redeemed LIKE '%$searchValue%'";
    $statement = $this->pdo->query($query);
    $redemptions = $statement->fetchAll();
    return $redemptions;
  }
  
  public function deleteAllUserRedemptions($user_id)
  {
    $query = "DELETE FROM redemption WHERE user_id = $user_id";
    $this->pdo->query($query);
  }

  private function generateRewardCode()
  {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    do {
      for ($i = 0; $i < 3; $i++) {
        $code .= $letters[rand(0, 25)];
      }

      for ($i = 0; $i < 3; $i++) {
        $code .= rand(0, 9);
      }
    } while ($this->checkDuplicateCode($code));

    return $code;
  }

  private function checkDuplicateCode($redemption_code)
  {
    $query = "SELECT * FROM redemption WHERE redemption_code = '$redemption_code'";
    $statement = $this->pdo->query($query);
    $duplicateExists = $statement->fetch();
    return $duplicateExists;
  }
}
