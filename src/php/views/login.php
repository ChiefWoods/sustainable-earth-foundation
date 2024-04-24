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