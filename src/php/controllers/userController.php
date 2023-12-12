<?php

include '../controllers/connect.php';
include '../models/userModel.php';

if (isset($_POST['email']) && isset($_POST['phone'])) {
  updateProfileInfo($pdo, $_POST['email'], $_POST['phone']);
  header("location:../views/profile.php");
  echo "Profile info updated";
  exit;
} else if (isset($_POST['current']) && isset($_POST['new']) && isset($_POST['confirm'])) {
  $hash = getPassword($pdo);
  if (!password_verify($_POST['current'], $hash)) {
    header("location:../views/profile.php");
    echo "Incorrect password";
    exit;
  } else if ($_POST['new'] != $_POST['confirm']) {
    header("location:../views/profile.php");
    echo "New passwords do not match";
    exit;
  } else {
    updatePassword($pdo, $_POST['new']);
    header("location:../views/profile.php");
    echo "Password updated";
    exit;
  }
}