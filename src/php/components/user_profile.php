<div id="user">
  <button id="image-btn">
    <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile picture" id="profile-image">
  </button>
  <span id="username">Username: <?php echo $_SESSION['username']; ?></span>
  <span id="points">Points: <?php echo getPoints($pdo); ?></span>
</div>