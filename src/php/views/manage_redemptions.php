<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Redemptions | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/manage.css">
  <link rel="stylesheet" href="../../css/table.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
</head>

<body>
  <?php include '../components/header.php'; ?>
  <main id="manage-redemptions">
    <section>
      <div id="head">
        <img src="../../assets/icons/reward/reward.svg" alt="Redemptions" class="icon">
        <h2>Manage Redemptions</h2>
      </div>
      <form action="" id="search-bar">
        <input type="text" name="search" id="search-input">
        <button type="submit" id="search-btn" class="btn">Search</button>
      </form>
      <?php include '../components/table_manage_redemptions.php'; ?>
    </section>
  </main>
  <?php include '../components/footer.php'; ?>
</body>

</html>