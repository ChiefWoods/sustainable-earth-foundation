<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="/web2202_web_programming/sustainable-earth-foundation/src/">
  <title>Session Expired | Please Log In Again</title>
  <link rel="stylesheet" href="css/header-footer.css">
  <link rel="stylesheet" href="css/session-expired.css">
  <link rel="shortcut icon" href="assets/icons/favicon.png" type="image/x-icon">
  <?php
  require_once '../util/session.php';
  require_once '../util/database.php';
  ?>
</head>

<body>
  <?php require_once 'templates/header.php' ?>
  <main>
    <section>
      <div>
        <h2>Session Expired</h2>
        <p>Please log in again.</p>
        <a href="php/views/login.php" class="btn">Login</a>
      </div>
    </section>
  </main>
  <?php require_once 'templates/footer.php' ?>
</body>

</html>