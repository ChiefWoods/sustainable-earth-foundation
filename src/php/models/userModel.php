<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

function getUserId($pdo)
{
  $username = $_SESSION['username'];
  $query = "SELECT user_id FROM user WHERE username = '$username'";
  $statement = $pdo->query($query);
  $user = $statement->fetch();
  return $user['user_id'];
}

function getUsername($pdo, $user_id)
{
  $query = "SELECT username FROM user WHERE user_id = $user_id";
  $statement = $pdo->query($query);
  $user = $statement->fetch();
  return $user['username'];
}

function getPassword($pdo)
{
  $username = $_SESSION['username'];
  $query = "SELECT password FROM user WHERE username = '$username'";
  $statement = $pdo->query($query);
  $user = $statement->fetch();
  return $user['password'];
}

function getProfilePicture($pdo)
{
  $username = $_SESSION['username'];
  $query = "SELECT profile_picture FROM user WHERE username = '$username'";
  $statement = $pdo->query($query);
  $user = $statement->fetch();
  return $user['profile_picture'];
}

function getPoints($pdo)
{
  $username = $_SESSION['username'];
  $query = "SELECT user_points FROM user WHERE username = '$username'";
  $statement = $pdo->query($query);
  $user = $statement->fetch();
  return $user['user_points'];
}

function getAllUsers($pdo)
{
  $query = "SELECT * FROM user";
  $statement = $pdo->query($query);
  $users = $statement->fetchAll();
  return $users;
}

function getProfileInfo($pdo)
{
  $username = $_SESSION['username'];
  $query = "SELECT * FROM user WHERE username = '$username'";
  $statement = $pdo->query($query);
  $user = $statement->fetch();
  if (is_null($user['phone_number'])) {
    $user['phone_number'] = "";
  }
  return $user;
}

function updateProfilePicture($pdo, $path)
{
  $username = $_SESSION['username'];
  $query = "UPDATE user SET profile_picture = '$path' WHERE username = '$username'";
  $pdo->query($query);
}

function updateProfileInfo($pdo, $email, $phone)
{
  $username = $_SESSION['username'];
  $query = "UPDATE user SET email = '$email', phone_number = '$phone' WHERE username = '$username'";
  $pdo->query($query);
}


function updatePassword($pdo, $password)
{
  $username = $_SESSION['username'];
  $password = password_hash($password, PASSWORD_DEFAULT);
  $query = "UPDATE user SET password = '$password' WHERE username = '$username'";
  $pdo->query($query);
}

function deductPoints($pdo, $points)
{
  $username = $_SESSION['username'];
  $query = "UPDATE user SET user_points = user_points - $points WHERE username = '$username'";
  $pdo->query($query);
  echo getPoints($pdo);
}
