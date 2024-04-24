<?php
require_once '../components/connect.php';
require_once '../controllers/NotificationController.php';
require_once '../models/UserModel.php';
require_once '../models/NotificationModel.php';

$notificationController = new NotificationController($pdo, new UserModel($pdo), new NotificationModel($pdo));
?>

<script src="js/header.js" defer></script>
<header>
  <div>
    <a href="php/views/index.php" class="branding">
      <img src="assets/images/logo.png" alt="Logo" class="logo">
      <div class="divider"></div>
      <h1>Sustainable Earth Foundation</h1>
    </a>
    <?php if (!isset($_SESSION['username'])) { ?>
      <nav>
        <a href="php/views/index.php" class="nav-link">Home</a>
        <a href="php/views/sticky-wall.php" class="nav-link">Sticky Wall</a>
        <a href="php/views/rewards.php" class="nav-link">Rewards</a>
        <a href="php/views/login.php" id="login-btn" class="btn">Login</a>
      </nav>
  </div>
<?php } ?>

<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0) { ?>
  <nav>
    <a href="php/views/index.php" class="nav-link">Home</a>
    <a href="php/views/sticky-wall.php" class="nav-link">Sticky Wall</a>
    <a href="php/views/rewards.php" class="nav-link">Rewards</a>
    <a href="php/views/profile.php" id="profile-btn">
      <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile picture" class="icon" id="profile-icon">
    </a>
    <button id="notification-btn">
      <img src="assets/icons/notification/notification_blue.svg" alt="Notification" class="icon" id="notification-icon">
    </button>
    <a href="php/components/session.php?logout=true" id="logout-btn">
      <img src="assets/icons/logout/logout_blue.svg" alt="Logout" class="icon" id="logout-icon">
    </a>
  </nav>
  </div>
  <ul class="dropdown">
    <?php $notificationController->generateNotificationLi(); ?>
  </ul>
<?php } ?>

<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) { ?>
  <nav>
    <a href="php/views/index.php" class="nav-link">Home</a>
    <a href="php/views/sticky-wall.php" class="nav-link">Sticky Wall</a>
    <a id="manage-btn" class="nav-link">Manage</a>
    <a href="php/views/profile.php" id="profile-btn">
      <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile picture" class="icon" id="profile-icon">
    </a>
    <a href="php/components/session.php?logout=true" id="logout-btn">
      <img src="assets/icons/logout/logout_blue.svg" alt="Logout" class="icon" id="logout-icon">
    </a>
  </nav>
  </div>
  <ul class="dropdown">
    <li>
      <a href="php/views/manage-users.php">
        <img src="assets/icons/account_group/account_group_blue.svg" alt="Users" class="icon users-icon">
        <span class="dropdown-content">Manage Users</span>
      </a>
    </li>
    <li>
      <a href="php/views/manage-redemptions.php">
        <img src="assets/icons/reward/reward_blue.svg" alt="Reward" class="icon reward-icon">
        <span class="dropdown-content">Manage Redemptions</span>
      </a>
    </li>
  </ul>
<?php } ?>

</header>