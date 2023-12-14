<?php

class UserController
{
  private $pdo;
  private $userModel;
  private $rewardModel;
  private $redemptionModel;

  public function __construct($pdo, $userModel, $rewardModel, $redemptionModel)
  {
    $this->pdo = $pdo;
    $this->userModel = $userModel;
    $this->rewardModel = $rewardModel;
    $this->redemptionModel = $redemptionModel;
  }

  public function generateUsersTable()
  {
    echo <<<HTML
      <table>
        <thead>
          <tr class="column">
            <th class="table-col">Username</th>
            <th class="table-col">Email</th>
            <th class="table-col">Phone Number</th>
            <th class="table-col">Points</th>
            <th class="table-col"></th>
          </tr>
        </thead>
        <tbody>
    HTML;

    $allUsers = $this->userModel->getAllUsers();

    $users = array_filter($allUsers, function ($user) {
      return $user['is_admin'] == 0;
    });

    if (count($users) > 0) {
      foreach ($users as $user) {
        if ($user['phone_number'] == "") {
          $user['phone_number'] = "-";
        }

        echo <<<HTML
          <tr>
            <td>{$user['username']}</td>
            <td>{$user['email']}</td>
            <td>{$user['phone_number']}</td>
            <td>{$user['user_points']}</td>
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

  public function generateUserRedemptionSection()
  {
    echo <<<HTML
      <section id="history">
        <table>
          <thead>
            <tr id="title-row">
              <th id="table-title" colspan="3">Redemption History</th>
            </tr>
            <tr class="column">
              <th class="table-col">Redemption Code</th>
              <th class="table-col">Points Used</th>
              <th class="table-col">Date Redeemed</th>
            </tr>
          </thead>
    HTML;

    echo $this->generateUserRedemptionTbody();

    echo <<<HTML
        </table>
      </section>
    HTML;
  }

  private function generateUserRedemptionTbody()
  {
    echo <<<HTML
      <tbody>
    HTML;

    $user_id = $this->userModel->getUserId();
    $redemptions = $this->redemptionModel->getAllRedemptions();

    $userRedemptions = array_filter($redemptions, function ($redemption) use ($user_id) {
      return $redemption['user_id'] == $user_id;
    });

    if (count($userRedemptions) > 0) {
      foreach ($userRedemptions as $redemption) {
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

    echo <<<HTML
      </tbody>
    HTML;
  }

  public function updateProfilePicture($uploadInfo)
  {
    session_start();
    switch ($uploadInfo['error']) {
      case UPLOAD_ERR_OK:
        $name = $uploadInfo['tmp_name'];
        $content_type = mime_content_type($name);
        $data = base64_encode(file_get_contents($name));
        $path = 'data: ' . $content_type . ';base64,' . $data;
        $this->userModel->updateProfilePicture($path);
        $_SESSION['profile_picture'] = $path;
        header("location:../views/profile.php");
        break;
      case UPLOAD_ERR_INI_SIZE:
        echo "The uploaded file is too large";
        break;
      case UPLOAD_ERR_PARTIAL:
        echo "The uploaded file was only partially uploaded";
        break;
      case UPLOAD_ERR_EXTENSION:
        echo "File upload stopped by extension";
        break;
      default:
        echo "Unknown upload error";
        break;
    }
  }

  public function updateProfileInfo($email, $phone)
  {
    session_start();
    $this->userModel->updateProfileInfo($email, $phone);
    header("location:../views/profile.php");
    echo "Profile info updated";
    exit;
  }

  public function updatePassword($current, $new, $confirm)
  {
    session_start();
    $hash = $this->userModel->getPassword();

    if (!password_verify($current, $hash)) {
      header("location:../views/profile.php");
      echo "Incorrect password";
      exit;
    } elseif ($new != $confirm) {
      header("location:../views/profile.php");
      echo "New passwords do not match";
      exit;
    } else {
      $this->userModel->updatePassword($new);
      header("location:../views/profile.php");
      echo "Password updated";
      exit;
    }
  }

  public function getEmail()
  {
    return $this->userModel->getEmail($_SESSION['username']);
  }

  public function getPhoneNumber()
  {
    return $this->userModel->getPhoneNumber($_SESSION['username']);
  }

  public function getProfilePicture()
  {
    return $this->userModel->getProfilePicture($_SESSION['username']);
  }

  public function getUserPoints()
  {
    return $this->userModel->getUserPoints();
  }
}
