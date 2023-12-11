<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/login_sign_up.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
</head>

<body>
  <?php include '../components/header.php'; ?>
  <main id="login">
    <section>
      <form action="" id="login-form">
        <div>
          <h2>Welcome back!</h2>
          <input type="text" name="username" placeholder="Username">
          <input type="password" name="password" placeholder="Password">
          <button type="submit" class="btn">Login</button>
        </div>
        <a href="#" class="forgot">Forgot your password?</a>
        <a href="../views/sign_up.php" class="create">Create new account</a>
      </form>
    </section>
  </main>
  <?php include '../components/footer.php'; ?>
</body>

</html>