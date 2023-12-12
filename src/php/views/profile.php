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
  <?php
  include '../controllers/connect.php';
  include '../models/userModel.php';
  ?>
</head>

<body>
  <?php include '../components/header.php'; ?>
  <main>
    <section id="profile">
      <?php include '../components/user_profile.php'; ?>
      <div id="info">
        <?php include '../components/profile_info.php'; ?>
        <?php include '../components/change_password.php'; ?>
      </div>
    </section>
    <?php include '../components/table_redemption_history.php'; ?>
  </main>
  <?php include '../components/footer.php'; ?>
</body>

</html>