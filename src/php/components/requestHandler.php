<?php
require_once '../components/connect.php';
require_once '../controllers/UserController.php';
require_once '../controllers/RewardController.php';
require_once '../controllers/PostController.php';
require_once '../controllers/RedemptionController.php';
require_once '../models/UserModel.php';
require_once '../models/RewardModel.php';
require_once '../models/RedemptionModel.php';
require_once '../models/NotificationModel.php';
require_once '../models/PostModel.php';
require_once '../models/UpvoteModel.php';
require_once '../models/DownvoteModel.php';

$userModel = new UserModel($pdo);
$rewardModel = new RewardModel($pdo);
$redemptionModel = new RedemptionModel($pdo);
$notificationModel = new NotificationModel($pdo);
$postModel = new PostModel($pdo);
$upvoteModel = new UpvoteModel($pdo);
$downvoteModel = new DownvoteModel($pdo);
$userController = new UserController($pdo, $userModel, $rewardModel, $redemptionModel, $postModel, $notificationModel, $upvoteModel, $downvoteModel);
$rewardController = new RewardController($pdo, $userModel, $rewardModel, $redemptionModel, $notificationModel);
$postController = new PostController($pdo, $postModel, $userModel, $upvoteModel, $downvoteModel, $notificationModel);
$redemptionController = new RedemptionController($pdo, $redemptionModel, $userModel, $rewardModel);

function validateSignUp($pdo, $username, $email, $phone, $password, $confirm, $userModel)
{
  $errors = [];
  $username = str_replace("'", "", sanitise($pdo, $username));
  $email = str_replace("'", "", sanitise($pdo, $email));
  $phone = str_replace("'", "", sanitise($pdo, $phone));

  if (!preg_match("/^[a-zA-Z][a-zA-Z0-9]{2,}$/", $username)) {
    $errors[] = "Username has to be at least 3 characters long, starts with an alphabet, and can only contain alphanumeric characters";
  } else {
    $statement = $userModel->getAllUsersByUsername($username);

    if ($statement->rowCount()) {
      $errors[] = "Username already exists";
    }
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  } else {
    $statement = $userModel->getAllUsersByEmail($email);

    if ($statement->rowCount()) {
      $errors[] = "Email already exists";
    }
  }

  if ($phone != '' && !preg_match("/^[0-9]{10}$/", $phone)) {
    $errors[] = "Phone number should consist of 10 digits";
  }

  if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
    $errors[] = "Password needs to be at least 8 characters long, and contain at least one number, one uppercase letter, and one lowercase letter";
  } else {
    if ($password !== $confirm) {
      $errors[] = "Passwords do not match";
    }
  }

  if (count($errors) > 0) {
    foreach ($errors as $error) {
      echo $error . "<br>";
    }

    echo "<a href='../views/sign_up.php'>Go back to sign up page.</a>";
  } else {
    session_start();

    $password = password_hash($password, PASSWORD_DEFAULT);
    $userModel->createUser($username, $email, $phone, $password);

    $_SESSION['username'] = $username;
    $_SESSION['is_admin'] = 0;
    $_SESSION['profile_picture'] = '../../assets/images/default_profile_picture.png';
    $_SESSION['last_activity'] = time();

    header("location:../views/index.php");
  }
}

function verifyUser($pdo, $username, $password, $userModel, $rewardModel, $notificationModel)
{
  $username = str_replace("'", "", sanitise($pdo, $username));

  $statement = $userModel->getAllUsersByUsername($username);

  if (!$statement->rowCount()) {
    echo "Username does not exist<br>";
    echo "<a href='../views/login.php'>Go back to login page.</a>";
  } else {
    $row = $statement->fetch();
    $hash = $row['password'];

    if (password_verify($password, $hash)) {
      session_start();

      $_SESSION['username'] = $username;
      $_SESSION['is_admin'] = $row['is_admin'];
      $_SESSION['profile_picture'] = $row['profile_picture'];
      $_SESSION['last_activity'] = time();

      $largest_reward = $rewardModel->getLargestRedeemableReward($row['user_points']);

      if (!empty($largest_reward)) {
        $notificationModel->createNotification($row['user_id'], 'points', ['reward_name' => $largest_reward]);
      }

      header("location:../views/index.php");
    } else {
      echo "Incorrect password<br>";
      echo "<a href='../views/login.php'>Go back to login page.</a>";
    }
  }
}

function sanitise($pdo, $str)
{
  return $pdo->quote(htmlentities($str));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm'])) {
    validateSignUp($pdo, $_POST['username'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['confirm'], $userModel);
  } elseif (isset($_POST['username']) && isset($_POST['password'])) {
    verifyUser($pdo, $_POST['username'], $_POST['password'], $userModel, $rewardModel, $notificationModel);
  } elseif (isset($_FILES['profile_picture'])) {
    $userController->updateProfilePicture($_FILES['profile_picture']);
  } elseif (isset($_POST['email']) && isset($_POST['phone'])) {
    $userController->updateProfileInfo($_POST['email'], $_POST['phone']);
  } elseif (isset($_POST['current']) && isset($_POST['new']) && isset($_POST['confirm'])) {
    $userController->updatePassword($_POST['current'], $_POST['new'], $_POST['confirm']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'redeem') {
    $rewardController->redeemReward($_POST['reward_name'], $_POST['reward_points']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'create_post') {
    $postController->createPost($_POST['title'], $_POST['post_text']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'edit_user') {
    $userController->editUser($_POST['username'], $_POST['phone_number'], $_POST['user_points']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'edit_redemption') {
    $redemptionController->editRedemption($_POST['old_redemption_code'], $_POST['new_redemption_code'], $_POST['date_redeemed']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'delete_user') {
    $userController->deleteUser($_POST['username']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'delete_redemption') {
    $redemptionController->deleteRedemption($_POST['redemption_code']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'edit_post') {
    $postController->editPost($_POST['old_title'], $_POST['old_post_text'], $_POST['new_title'], $_POST['new_post_text']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'delete_post') {
    $postController->deletePost($_POST['title'], $_POST['post_text']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'find_users') {
    $userController->findUsers($_POST['search_value']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'find_redemptions') {
    $redemptionController->findRedemptions($_POST['search_value']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'upvote_post') {
    $postController->upvotePost($_POST['title'], $_POST['post_text']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'downvote_post') {
    $postController->downvotePost($_POST['title'], $_POST['post_text']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'remove_upvote') {
    $postController->removeUpvote($_POST['title'], $_POST['post_text']);
  } elseif (isset($_POST['action']) && $_POST['action'] === 'remove_downvote') {
    $postController->removeDownvote($_POST['title'], $_POST['post_text']);
  }
}