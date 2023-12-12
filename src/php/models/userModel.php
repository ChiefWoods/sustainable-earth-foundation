<?php

session_start();

function getPoints($pdo) {
  $username = $_SESSION['username'];
  $query = "SELECT points FROM user WHERE username = '$username'";
  $statement = $pdo->query($query);
  $user = $statement->fetch();
  return $user['points'];
}

function getProfileInfo($pdo) {
  $username = $_SESSION['username'];
  $query = "SELECT * FROM user WHERE username = '$username'";
  $statement = $pdo->query($query);
  $user = $statement->fetch();
  if (is_null($user['phone_number'])) {
    $user['phone_number'] = "";
  }
  return $user;
}

function updateProfileInfo($pdo, $email, $phone) {
  $username = $_SESSION['username'];
  $query = "UPDATE user SET email = '$email', phone_number = '$phone' WHERE username = '$username'";
  $pdo->query($query);
}


function updatePassword($pdo, $password) {
  $username = $_SESSION['username'];
  $password = password_hash($password, PASSWORD_DEFAULT);
  $query = "UPDATE user SET password = '$password' WHERE username = '$username'";
  $pdo->query($query);
}