<?php

include 'connect.php';

function validateUser($pdo)
{
  $errors = [];
  $username = str_replace("'", "", sanitise($pdo, $_POST['username']));
  $password = $_POST['password'];

  $query = "SELECT * FROM user WHERE username = '$username'";
  $statement = $pdo->query($query);

  if (!$statement->rowCount()) {
    $errors[] = "Username does not exist";
  } else {
    $row = $statement->fetch();
    $hash = $row['password'];

    if (password_verify($password, $hash)) {
      session_start();

      $_SESSION['username'] = $username;
      $_SESSION['is_admin'] = $row['is_admin'];
      $_SESSION['profile_picture'] = $row['profile_picture'];
      $_SESSION['last_activity'] = time();

      header("location:../views/index.php");
    } else {
      $errors[] = "Incorrect password";
    }
  }

  foreach ($errors as $error) {
    echo $error . "<br>";
  }

  echo "<a href='../views/login.php'>Go back to login page.</a>";
}

function sanitise($pdo, $str)
{
  $str = htmlentities($str);
  return $pdo->quote($str);
}

validateUser($pdo);
