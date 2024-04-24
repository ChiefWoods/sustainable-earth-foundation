<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="/web2202_web_programming/sustainable-earth-foundation/src/">
  <title>Sign Up | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="css/header-footer.css">
  <link rel="stylesheet" href="css/login-sign-up.css">
  <link rel="shortcut icon" href="assets/icons/favicon.png" type="image/x-icon">
  <script type="module" src="js/sign-up.js" defer></script>
  <?php
  require_once '../util/session.php';
  require_once '../util/database.php';
  ?>
</head>

<body>
  <?php require_once 'templates/header.php' ?>
  <main id="sign-up">
    <section>
      <form action="php/util/requestHandler.php" method="post" id="signup-form">
        <fieldset>
          <legend>Join us today!</legend>
          <div class="form-control">
            <input type="text" name="username" placeholder="Username" minlength="3" pattern="^[a-zA-Z][a-zA-Z0-9]{2,}$" required>
            <p></p>
          </div>
          <div class="form-control">
            <input type="email" name="email" placeholder="Email" required>
            <p></p>
          </div>
          <div class="form-control">
            <input type="tel" name="phone" placeholder="Phone Number" minlength="10" maxlength="10" pattern="^[0-9]$">
            <p></p>
          </div>
          <div class="form-control">
            <input type="password" name="password" placeholder="Password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]$" required>
            <p></p>
          </div>
          <div class="form-control">
            <input type="password" name="confirm" placeholder="Confirm Password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]$" required>
            <p></p>
          </div>
          <button type="submit" class="btn">Sign Up</button>
        </fieldset>
        <a href="php/views/login.php" class="already">Already have an account?</a>
      </form>
    </section>
  </main>
  <?php require_once 'templates/footer.php' ?>
</body>

</html>