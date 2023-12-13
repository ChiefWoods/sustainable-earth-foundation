<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rewards | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/rewards.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
  <script src="../../js/rewards.js" defer></script>
  <?php
  require_once '../components/session.php';
  require_once '../components/connect.php';
  require_once '../controllers/RewardController.php';
  require_once '../models/UserModel.php';
  require_once '../models/RewardModel.php';
  require_once '../models/RedemptionModel.php';
  require_once '../models/NotificationModel.php';

  $rewardController = new RewardController($pdo, new UserModel($pdo), new RewardModel($pdo), new RedemptionModel($pdo), new NotificationModel($pdo));
  ?>
</head>

<body>
  <?php require_once '../components/header.php'; ?>
  <main>
    <section>
      <div>
        <div id="head">
          <img src="../../assets/icons/reward/reward.svg" alt="Reward" id="reward-icon">
          <div id="title">
            <h2>Reward Redemption</h2>
            <button id="help-btn">
              <img src="../../assets/icons/help_circle_outline/help_circle_outline.svg" alt="Help" id="help-icon">
            </button>
          </div>
          <p id="desc">Redeeming your hard earned points is easy!<br>Choose a voucher code below.</p>
        </div>
        <?php isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0 ? $rewardController->generateSavedPointsDiv() : ""; ?>
      </div>
      <?php $rewardController->generateRewardListUl(); ?>
    </section>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>