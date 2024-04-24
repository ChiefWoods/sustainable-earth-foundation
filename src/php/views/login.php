<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="/web2202_web_programming/sustainable-earth-foundation/src/">
  <title>Login | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="css/header-footer.css">
  <link rel="stylesheet" href="css/login-sign-up.css">
  <link rel="shortcut icon" href="assets/icons/favicon.png" type="image/x-icon">
  <script type="module" src="js/login.js" defer></script>
  <?php
  require_once '../util/session.php';
  require_once '../util/database.php';
  ?>
</head>

<body>
  <?php require_once 'templates/header.php' ?>
  <main id="login">
    <section>
      <form action="php/util/requestHandler.php" method="post" id="login-form">
        <fieldset>
          <legend>Welcome back!</legend>
          <div class="form-control">
            <input type="text" name="username" placeholder="Username" minlength="3" pattern="^[a-zA-Z][a-zA-Z0-9]*$" required>
            <p></p>
          </div>
          <div class="form-control">
            <input type="password" name="password" placeholder="Password" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]+" required>
            <p></p>
          </div>
          <button type="submit" class="btn">Login</button>
        </fieldset>
        <a href="php/views/sign-up.php" class="create">Create new account</a>
      </form>
    </section>
  </main>
  <?php require_once 'templates/footer.php' ?>
</body>

</html>