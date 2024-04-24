<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout'] == true) {
  session_destroy();
  header("Location: ../views/login.php");
} elseif (isset($_SESSION['username']) && isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3000000000)) {
  session_destroy();
  header("Location: ../views/session-expired.php");
} else {
  $_SESSION['last_activity'] = time();
}
