<?php

if (isset($_SESSION['username']) && isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 5)) {
  header("location:../controllers/logoutController.php?expired=true");
} else {
  $_SESSION['last_activity'] = time();
}