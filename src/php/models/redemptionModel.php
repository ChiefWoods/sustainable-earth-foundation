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
