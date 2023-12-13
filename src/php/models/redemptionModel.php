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
