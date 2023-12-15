<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sticky Wall | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/sticky_wall.css">
  <link rel="stylesheet" href="../../css/dialog.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
  <script src="../../js/sticky_wall.js" defer></script>
  <?php
  require_once '../components/session.php';
  require_once '../components/connect.php';
  require_once '../controllers/PostController.php';
  require_once '../models/PostModel.php';
  require_once '../models/UserModel.php';
  require_once '../models/UpvoteModel.php';
  require_once '../models/DownvoteModel.php';
  require_once '../models/NotificationModel.php';

  $postController = new PostController($pdo, new PostModel($pdo), new UserModel($pdo), new UpvoteModel($pdo), new DownvoteModel($pdo), new NotificationModel($pdo));
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
        <?php echo isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0 ? $postController->generateCreatePostBtn() : ""; ?>
      </div>
      <?php $postController->generateWall(); ?>
    </section>
    <div class="overlay"></div>
    <?php isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0 ? $postController->generateCreateDialog() : ""; ?>
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
      $postController->generateEditDialog();
      $postController->generateDeleteDialog();
    } ?>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>