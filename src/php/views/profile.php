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
  require_once '../components/session.php';
  require_once '../components/connect.php';
  require_once '../controllers/UserController.php';
  require_once '../models/UserModel.php';
  require_once '../models/RewardModel.php';
  require_once '../models/RedemptionModel.php';

  $userController = new UserController($pdo, new UserModel($pdo), new RewardModel($pdo), new RedemptionModel($pdo));
  ?>
</head>

<body>
  <?php require_once '../components/header.php'; ?>
  <main>
    <section id="profile">
      <form action="../components/requestHandler.php" method="post" enctype="multipart/form-data" id="user">
        <div id="image-btn">
          <img src="<?php echo $userController->getProfilePicture($_SESSION['username']); ?>" alt="Profile Picture" id="profile-image">
          <input type="file" name="profile_picture" id="profile-picture">
        </div>
        <span id="username">Username: <?php echo $_SESSION['username']; ?></span>
        <span id="points">Points: <?php echo $userController->getUserPoints($_SESSION['username']); ?></span>
      </form>
      <div id="info">
        <form action="../components/requestHandler.php" method="post">
          <h2>Profile Info</h2>
          <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $userController->getEmail($_SESSION['username']); ?>">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $userController->getPhoneNumber($_SESSION['username']); ?>" pattern="^[0-9]{10}$" oninvalid="setCustomValidity('Phone number should consist of 10 digits.')">
          </div>
          <button type="submit" class="btn update-btn">Update Info</button>
        </form>
        <form action="../components/requestHandler.php" method="post">
          <h2>Change Password</h2>
          <div>
            <label for="current">Current Password</label>
            <input type="password" name="current" id="current" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="setCustomValidity('Password needs to be at least 8 characters long, and contain at least one number, one uppercase letter, and one lowercase letter.')">
            <label for="new">New Password</label>
            <input type="password" name="new" id="new" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="setCustomValidity('Password needs to be at least 8 characters long, and contain at least one number, one uppercase letter, and one lowercase letter.')">
            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm" id="confirm" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="setCustomValidity('Password needs to be at least 8 characters long, and contain at least one number, one uppercase letter, and one lowercase letter.')">
          </div>
          <button type="submit" class="btn update-btn">Update Password</button>
        </form>
      </div>
    </section>
    <?php echo $_SESSION['is_admin'] == 0 ? $userController->generateUserRedemptionSection() : ""; ?>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>