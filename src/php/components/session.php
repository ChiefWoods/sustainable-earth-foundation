<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout'] == true) {
  session_destroy();
  header("location:../views/login.php");
} elseif (isset($_SESSION['username']) && isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
  session_destroy();
  header("location:../../php/views/session_expired.php");
} else {
  $_SESSION['last_activity'] = time();
}
