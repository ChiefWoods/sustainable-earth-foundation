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
} else if (isset($_FILES['profile_picture'])) {
  $uploadInfo = $_FILES['profile_picture'];

  switch ($uploadInfo['error']) {
    case UPLOAD_ERR_OK:
      $name = $uploadInfo['tmp_name'];
      $content_type = mime_content_type($name); 
      $data = base64_encode(file_get_contents($name));
      $path = 'data: ' . $content_type . ';base64,' . $data;
      updateProfilePicture($pdo, $path);
      $_SESSION['profile_picture'] = $path;
      header("location:../views/profile.php");
      exit;
    case UPLOAD_ERR_INI_SIZE:
      echo "The uploaded file is too large";
      break;
    case UPLOAD_ERR_PARTIAL:
      echo "The uploaded file was only partially uploaded";
      break;
    case UPLOAD_ERR_EXTENSION:
      echo "File upload stopped by extension";
      break;
    default:
      echo "Unknown upload error";
      break;
  }
}