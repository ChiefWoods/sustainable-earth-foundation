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