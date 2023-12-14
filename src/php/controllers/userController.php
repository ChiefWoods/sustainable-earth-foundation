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
            <td class="user-username">{$user['username']}</td>
            <td class="user-email">{$user['email']}</td>
            <td class="user-phone">{$user['phone_number']}</td>
            <td class="user-points">{$user['user_points']}</td>
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
          <td colspan="5" class="no-results">No users found</td>
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

    $user_id = $this->userModel->getUserId($_SESSION['username']);
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
    $username = $_SESSION['username'];

    switch ($uploadInfo['error']) {
      case UPLOAD_ERR_OK:
        $name = $uploadInfo['tmp_name'];
        $content_type = mime_content_type($name);
        $data = base64_encode(file_get_contents($name));
        $path = 'data: ' . $content_type . ';base64,' . $data;
        $this->userModel->updateProfilePicture($path, $username);
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
    $username = $_SESSION['username'];
    $this->userModel->updateProfileInfo($email, $phone, $username);
    header("location:../views/profile.php");
    echo "Profile info updated";
  }

  public function updatePassword($current, $new, $confirm)
  {
    session_start();
    $username = $_SESSION['username'];
    $hash = $this->userModel->getPassword($username);

    if (!password_verify($current, $hash)) {
      header("location:../views/profile.php");
      echo "Incorrect password";
    } elseif ($new != $confirm) {
      header("location:../views/profile.php");
      echo "New passwords do not match";
    } else {
      $new = password_hash($new, PASSWORD_DEFAULT);
      $this->userModel->updatePassword($new, $username);
      header("location:../views/profile.php");
      echo "Password updated";
    }
  }

  public function editUser($username, $phone, $user_points)
  {
    $this->userModel->editUser($username, $phone, $user_points);
    echo json_encode(['status' => 'success', 'message' => 'User edited successfully!']);
  }

  public function deleteUser($username)
  {
    $this->userModel->deleteUser($username);
    echo json_encode(['status' => 'success', 'message' => 'User deleted successfully!']);
  }

  public function getEmail()
  {
    return $this->userModel->getEmail($_SESSION['username']);
  }

  public function getPhoneNumber()
  {
    return $this->userModel->getPhoneNumber($_SESSION['username']);
  }

  public function getProfilePicture($username)
  {
    return $this->userModel->getProfilePicture($username);
  }

  public function getUserPoints($username)
  {
    return $this->userModel->getUserPoints($username);
  }
}
