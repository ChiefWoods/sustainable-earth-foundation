<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/login_sign_up.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
</head>

<body>
  <?php include '../components/header.php'; ?>
  <main id="sign-up">
    <section>
      <form action="../controllers/signupController.php" method="post" id="signup-form">
        <div>
          <h2>Join us today!</h2>
          <input type="text" name="username" placeholder="Username">
          <input type="email" name="email" id="email" placeholder="Email">
          <input type="tel" name="phone" id="phone" placeholder="Phone Number">
          <input type="password" name="password" placeholder="Password">
          <input type="password" name="confirm" placeholder="Confirm Password">
          <button type="submit" class="btn">Sign Up</button>
        </div>
        <a href="../views/login.php" class="already">Already have an account?</a>
      </form>
    </section>
  </main>
  <?php include '../components/footer.php'; ?>
</body>

</html>