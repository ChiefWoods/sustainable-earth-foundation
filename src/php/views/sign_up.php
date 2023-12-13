<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/login_sign_up.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
  <?php require_once '../components/session.php'; ?>
</head>

<body>
  <?php require_once '../components/header.php'; ?>
  <main id="sign-up">
    <section>
      <form action="../components/requestHandler.php" method="post" id="signup-form">
        <div>
          <h2>Join us today!</h2>
          <input type="text" name="username" placeholder="Username" pattern="^[a-zA-Z][a-zA-Z0-9]{2,}$" oninvalid="setCustomValidity('Username has to be at least 3 characters long, starts with an alphabet, and can only contain alphanumeric characters.')" required>
          <input type="email" name="email" id="email" placeholder="Email" required>
          <input type="tel" name="phone" id="phone" placeholder="Phone Number" pattern="^[0-9]{10}$" oninvalid="setCustomValidity('Phone number should consist of 10 digits.')">
          <input type="password" name="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="setCustomValidity('Password needs to be at least 8 characters long, and contain at least one number, one uppercase letter, and one lowercase letter.')" required>
          <input type="password" name="confirm" placeholder="Confirm Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="setCustomValidity('Password needs to be at least 8 characters long, and contain at least one number, one uppercase letter, and one lowercase letter.')" required>
          <button type="submit" class="btn">Sign Up</button>
        </div>
        <a href="../views/login.php" class="already">Already have an account?</a>
      </form>
    </section>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>