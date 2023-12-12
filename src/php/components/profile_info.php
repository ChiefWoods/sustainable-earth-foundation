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