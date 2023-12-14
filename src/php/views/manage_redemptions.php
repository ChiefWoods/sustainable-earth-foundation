<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Redemptions | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/manage.css">
  <link rel="stylesheet" href="../../css/table.css">
  <link rel="stylesheet" href="../../css/dialog.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
  <script src="../../js/manage.js" defer></script>
  <?php
  require_once '../components/session.php';
  require_once '../components/connect.php';
  require_once '../controllers/RedemptionController.php';
  require_once '../models/RedemptionModel.php';
  require_once '../models/UserModel.php';
  require_once '../models/RewardModel.php';

  $redemptionController = new RedemptionController($pdo, new RedemptionModel($pdo), new UserModel($pdo), new RewardModel($pdo));
  ?>
</head>

<body>
  <?php require_once '../components/header.php'; ?>
  <main id="manage-redemptions">
    <section>
      <div id="head">
        <img src="../../assets/icons/reward/reward.svg" alt="Redemptions" class="icon">
        <h2>Manage Redemptions</h2>
      </div>
      <form action="" id="search-bar">
        <input type="text" name="search" id="search-input">
        <button type="submit" id="search-btn" class="btn">Search</button>
      </form>
      <?php $redemptionController->generateRedemptionsTable(); ?>
    </section>
    <div class="overlay"></div>
    <dialog id="edit-dialog">
      <div class="dialog-top">
        <h3 class="dialog-title">Edit Redemption</h3>
        <button class="close-btn">
          <img src="../../assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
        </button>
      </div>
      <form class="dialog-bottom" id="edit-redemptions">
        <div id="user-input">
          <label for="username">Username:</label>
          <label for="reward-points">Points Used:</label>
          <label for="reward-code">Phone Number:</label>
          <label for="date-redeemed">Date Redeemed:</label>
          <input type="text" name="username" id="username" disabled>
          <input type="number" name="reward-points" id="reward-points" disabled>
          <input type="text" name="reward-code" id="reward-code">
          <input type="date" name="date-redeemed" id="date-redeemed">
        </div>
        <div class="dialog-options">
          <button type="submit" id="edit-btn" class="confirmation-btn option-btn">Edit</button>
        </div>
      </form>
    </dialog>
    <dialog id="delete-dialog">
      <div class="dialog-top">
        <h3 class="dialog-title">Delete Redemption</h3>
        <button class="close-btn">
          <img src="../../assets/icons/window_close/window_close_white.svg" alt="Close" class="dialog-icon close-icon">
        </button>
      </div>
      <div class="dialog-bottom">
        <p>Delete this redemption?</p>
        <div class="dialog-options">
          <button id="cancel-btn" class="option-btn">Cancel</button>
          <button id="delete-btn" class="confirmation-btn option-btn">Delete</button>
        </div>
      </div>
    </dialog>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>