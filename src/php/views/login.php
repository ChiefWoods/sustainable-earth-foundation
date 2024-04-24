<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="/web2202_web_programming/sustainable-earth-foundation/src/">
  <title>Login | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="css/header_footer.css">
  <link rel="stylesheet" href="css/login_sign_up.css">
  <link rel="shortcut icon" href="assets/icons/favicon.png" type="image/x-icon">
  <?php require_once '../components/session.php'; ?>
</head>

<body>
  <?php require_once 'templates/header.php' ?>
  <main id="login">
    <section>
      <form action="php/components/requestHandler.php" method="post" id="login-form">
        <div>
          <h2>Welcome back!</h2>
          <input type="text" name="username" placeholder="Username" pattern="^[a-zA-Z][a-zA-Z0-9]{2,}$" oninvalid="setCustomValidity('Username has to be at least 3 characters long, starts with an alphabet, and can only contain alphanumeric characters.')" required>
          <input type="password" name="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="setCustomValidity('Password needs to be at least 8 characters long, and contain at least one number, one uppercase letter, and one lowercase letter.')" required>
          <button type="submit" class="btn">Login</button>
        </div>
        <!-- <a href="#" class="forgot">Forgot your password?</a> -->
        <a href="php/views/sign-up.php" class="create">Create new account</a>
      </form>
    </section>
  </main>
  <?php require_once 'templates/footer.php' ?>
</body>

</html>