<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

function getRewardPoints($pdo, $reward_id)
{
  $query = "SELECT reward_points FROM reward WHERE reward_id = $reward_id";
  $statement = $pdo->query($query);
  $reward = $statement->fetch();
  return $reward['reward_points'];

}
