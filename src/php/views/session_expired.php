<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session Expired | Please Log In Again</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/session_expired.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
  <?php require_once '../components/session.php'; ?>
</head>

<body>
  <?php require_once '../components/header.php'; ?>
  <main>
    <section>
      <div>
        <h2>Session Expired</h2>
        <p>Please log in again.</p>
        <a href="../views/login.php" class="btn">Login</a>
      </div>
    </section>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>