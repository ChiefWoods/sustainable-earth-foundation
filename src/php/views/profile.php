<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/profile.css">
  <link rel="stylesheet" href="../../css/table.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
  <script src="../../js/profile.js" defer></script>
  <?php
  include '../controllers/connect.php';
  include '../models/userModel.php';
  include '../models/redemptionModel.php';
  include '../models/rewardModel.php';
  ?>
</head>

<body>
  <?php include '../components/header.php'; ?>
  <main>
    <section id="profile">
      <form action="../controllers/userController.php" method="post" enctype="multipart/form-data" id="user">
        <div id="image-btn">
          <img src="<?php echo getProfilePicture($pdo); ?>" alt="Profile picture" id="profile-image">
          <input type="file" name="profile_picture" id="profile-picture">
        </div>
        <span id="username">Username: <?php echo $_SESSION['username']; ?></span>
        <span id="points">Points: <?php echo getPoints($pdo); ?></span>
      </form>
      <div id="info">
        <form action="../controllers/userController.php" method="post">
          <h2>Profile Info</h2>
          <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo getProfileInfo($pdo)['email']; ?>">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?php echo getProfileInfo($pdo)['phone_number']; ?>">
          </div>
          <button type="submit" class="btn update-btn">Update Info</button>
        </form>
        <form action="../controllers/userController.php" method="post">
          <h2>Change Password</h2>
          <div>
            <label for="current">Current Password</label>
            <input type="password" name="current" id="current">
            <label for="new">New Password</label>
            <input type="password" name="new" id="new">
            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm" id="confirm">
          </div>
          <button type="submit" class="btn update-btn">Update Password</button>
        </form>
      </div>
    </section>
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
        <tbody>
          <?php
          $redemptions = getAllRedemptions($pdo);

          if (count($redemptions) > 0) {
            foreach ($redemptions as $redemption) {
              $reward_points = getRewardPoints($pdo, $redemption['reward_id']);
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
          ?>
        </tbody>
      </table>
    </section>
  </main>
  <?php include '../components/footer.php'; ?>
</body>

</html>