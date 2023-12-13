<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/manage.css">
  <link rel="stylesheet" href="../../css/table.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
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
  <main id="manage-users">
    <section>
      <div id="head">
        <img src="../../assets/icons/account_group/account_group.svg" alt="Account" class="icon">
        <h2>Manage Users</h2>
      </div>
      <form action="" id="search-bar">
        <input type="text" name="search" id="search-input">
        <button type="submit" id="search-btn" class="btn">Search</button>
      </form>
      <?php $userController->generateUsersTable(); ?>
    </section>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>