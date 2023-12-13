<?php

include '../controllers/connect.php';
include '../models/redemptionModel.php';
include '../models/userModel.php';
include '../models/rewardModel.php';

function generateRedemptionsTable($pdo)
{
  echo <<<HTML
  <table>
  <thead>
    <tr class="column">
      <th class="table-col">Username</th>
      <th class="table-col">Points Used</th>
      <th class="table-col">Redemption Code</th>
      <th class="table-col">Date Redeemed</th>
      <th class="table-col"></th>
    </tr>
  </thead>
  <tbody>
  HTML;

  $redemptions = getAllRedemptions($pdo);

  if (count($redemptions) > 0) {
    foreach ($redemptions as $redemption) {
      $username = getUsername($pdo, $redemption['user_id']);
      $reward_points = getRewardPoints($pdo, $redemption['reward_id']);

      echo <<<HTML
      <tr>
        <td>$username</td>
        <td>$reward_points</td>
        <td>$redemption[redemption_code]</td>
        <td>$redemption[date_redeemed]</td>
        <td class="edit-delete">
          <button id="edit-btn">
            <img src="../../assets/icons/edit/edit.svg" alt="Edit" class="icon">
          </button>
          <button id="delete-btn">
            <img src="../../assets/icons/delete/delete.svg" alt="Delete" class="icon">
          </button>
        </td>
      </tr>
      HTML;
    }
  } else {
    echo <<<HTML
    <tr>
      <td colspan="5" class="no-results">No results found</td>
    </tr>
    HTML;
  }
  echo <<<HTML
    </tbody>
  </table>
  HTML;
}
