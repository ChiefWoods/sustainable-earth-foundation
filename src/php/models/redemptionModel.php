<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

function getAllRedemptions($pdo)
{
  $query = "SELECT * FROM redemption";
  $statement = $pdo->query($query);
  $redemptions = $statement->fetchAll();
  return $redemptions;
}

function createRedemption($pdo, $user_id, $reward_id)
{
  $redemption_code = generateRewardCode($pdo);
  $date_redeemed = date("Y-m-d");
  $query = "INSERT INTO redemption (user_id, reward_id, redemption_code, date_redeemed) VALUES ($user_id, $reward_id, '$redemption_code', '$date_redeemed')";
  $pdo->query($query);
}

function generateRewardCode($pdo)
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
  } while (checkDuplicateCode($pdo, $code));

  return $code;
}

function checkDuplicateCode($pdo, $redemption_code)
{
  $query = "SELECT * FROM redemption WHERE redemption_code = '$redemption_code'";
  $statement = $pdo->query($query);
  $duplicateExists = $statement->fetch();
  return $duplicateExists;
}
