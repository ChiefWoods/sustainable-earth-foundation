<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="/web2202_web_programming/sustainable-earth-foundation/src/">
  <title>Manage Users | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="css/header-footer.css">
  <link rel="stylesheet" href="css/manage.css">
  <link rel="stylesheet" href="css/table.css">
  <link rel="stylesheet" href="css/dialog.css">
  <link rel="shortcut icon" href="assets/icons/favicon.png" type="image/x-icon">
  <script src="js/manage.js" defer></script>
  <?php
  require_once '../util/session.php';
  require_once '../util/database.php';
  require_once '../controllers/UserController.php';
  require_once '../models/UserModel.php';
  require_once '../models/RewardModel.php';
  require_once '../models/RedemptionModel.php';
  require_once '../models/PostModel.php';
  require_once '../models/NotificationModel.php';
  require_once '../models/UpvoteModel.php';
  require_once '../models/DownvoteModel.php';

  $userController = new UserController($pdo, new UserModel($pdo), new RewardModel($pdo), new RedemptionModel($pdo), new PostModel($pdo), new NotificationModel($pdo), new UpvoteModel($pdo), new DownvoteModel($pdo));
  ?>
</head>

<body>
  <?php require_once 'templates/header.php' ?>
  <main id="manage-users">
    <section>
      <div id="head">
        <img src="assets/icons/account_group/account_group.svg" alt="Account" class="icon">
        <h2>Manage Users</h2>
      </div>
      <form id="search-bar">
        <input type="text" name="search" id="search-input">
        <button type="button" id="search-btn" class="btn">Search</button>
      </form>
      <?php $userController->generateUsersTable(); ?>
    </section>
    <div class="overlay"></div>
    <dialog id="edit-dialog"> 
      <div class="dialog-top">
        <h3 class="dialog-title">Edit User</h3>
        <button class="close-btn">
          <img src="assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
        </button>
      </div>
      <form class="dialog-bottom" id="edit-users">
        <div id="user-input">
          <label for="username">Username:</label>
          <label for="email">Email:</label>
          <label for="phone">Phone Number:</label>
          <label for="user-points">Points:</label>
          <input type="text" name="username" id="username" disabled>
          <input type="email" name="email" id="email" disabled>
          <input type="text" name="phone" id="phone" pattern="^\d{10}$|^-$" oninvalid="setCustomValidity('Phone number should consist of 10 digits.')">
          <input type="number" name="user-points" id="user-points" min="0">
        </div>
        <div class="dialog-options">
          <button type="submit" id="edit-btn" class="confirmation-btn option-btn">Edit</button>
        </div>
      </form>
    </dialog>
    <dialog id="delete-dialog">
      <div class="dialog-top">
        <h3 class="dialog-title">Delete User</h3>
        <button class="close-btn">
          <img src="assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
        </button>
      </div>
      <div class="dialog-bottom">
        <p>Delete this user?</p>
        <div class="dialog-options">
          <button id="cancel-btn" class="option-btn">Cancel</button>
          <button id="delete-btn" class="confirmation-btn option-btn">Delete</button>
        </div>
      </div>
    </dialog>
  </main>
  <?php require_once 'templates/footer.php' ?>
</body>

</html>