<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sticky Wall | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/sticky_wall.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
  <?php
  require_once '../components/session.php';
  require_once '../components/connect.php';
  require_once '../controllers/PostController.php';
  require_once '../models/PostModel.php';
  require_once '../models/UserModel.php';

  $postController = new PostController($pdo, new PostModel($pdo), new UserModel($pdo));
  ?>
</head>

<body>
  <?php require_once '../components/header.php'; ?>
  <main>
    <img src="../../assets/backgrounds/sticky_wall_bg.jpg" alt="Groups of people smiling">
    <section id="sticky-wall">
      <div id="head">
        <div id="title">
          <img src="../../assets/icons/bulletin_board/bulletin_board.svg" alt="Sticky Wall">
          <h2>Sticky Wall</h2>
        </div>
        <?php echo $_SESSION['is_admin'] == 0 ? $postController->generateCreatePostBtn() : ""; ?>
      </div>
      <?php $postController->generateWall(); ?>
    </section>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>