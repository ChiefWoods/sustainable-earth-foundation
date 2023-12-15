<?php

class RedemptionController
{
  private $pdo;
  private $redemptionModel;
  private $userModel;
  private $rewardModel;

  public function __construct($pdo, $redemptionModel, $userModel, $rewardModel)
  {
    $this->pdo = $pdo;
    $this->redemptionModel = $redemptionModel;
    $this->userModel = $userModel;
    $this->rewardModel = $rewardModel;
  }

  public function generateRedemptionsTable()
  {
    $redemptions = $this->redemptionModel->getAllRedemptions();
    $resultCount = count($redemptions);

    echo <<<HTML
      <span id="total-results">Total results: <span id="result-count">$resultCount</span></span>
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

    if ($resultCount > 0) {
      foreach ($redemptions as $redemption) {
        $username = $this->userModel->getUsername($redemption['user_id']);
        $reward_points = $this->rewardModel->getRewardPoints($redemption['reward_id']);

        echo <<<HTML
          <tr>
            <td class="redemption-username">$username</td>
            <td class="redemption-points">$reward_points</td>
            <td class="redemption-code">$redemption[redemption_code]</td>
            <td class="redemption-date">$redemption[date_redeemed]</td>
            <td class="edit-delete">
              <button class="action-btn edit-btn">
                <img src="../../assets/icons/edit/edit.svg" alt="Edit" class="icon">
              </button>
              <button class="action-btn delete-btn">
                <img src="../../assets/icons/delete/delete.svg" alt="Delete" class="icon">
              </button>
            </td>
          </tr>
        HTML;
      }
    } else {
      echo <<<HTML
        <tr>
          <td colspan="5" class="no-results">No redemptions found</td>
        </tr>
      HTML;
    }
    echo <<<HTML
        </tbody>
      </table>
    HTML;
  }

  public function generateUserRedemptions()
  {
    $redemptions = $this->redemptionModel->getUserRedemptions($_SESSION['user_id']);

    if (count($redemptions) > 0) {
      foreach ($redemptions as $redemption) {
        $reward_points = $this->rewardModel->getRewardPoints($redemption['reward_id']);
        echo <<<HTML
          <tr>
            <td>$redemption[redemption_code]</td>
            <td>$reward_points</td>
            <td>$redemption[date_redeemed]</td>
          </tr>
        HTML;
      }
    } else {
      echo <<<HTML
        <tr>
          <td colspan="3" class="no-rewards">No rewards redeemed</td>
        </tr>
      HTML;
    }
  }

  public function editRedemption($old_redemption_code, $new_redemption_code, $date_redeemed)
  {
    $this->redemptionModel->editRedemption($old_redemption_code, $new_redemption_code, $date_redeemed);
    echo json_encode(['status' => 'success', 'message' => 'Redemption edited successfully!']);
  }

  public function deleteRedemption($redemption_code)
  {
    $this->redemptionModel->deleteRedemption($redemption_code);
    echo json_encode(['status' => 'success', 'message' => 'Redemption deleted successfully!']);
  }

  public function findRedemptions($searchValue)
  {
    $redemptions = $this->redemptionModel->findRedemptions($searchValue);
    echo json_encode(['status' => 'success', 'message' => 'Redemption found successfully!', 'redemptions' => $redemptions]);
  }
}
