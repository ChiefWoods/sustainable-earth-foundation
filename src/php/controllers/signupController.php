<?php

include 'connect.php';

function validateForm($pdo)
{
  $errors = [];
  $username = str_replace("'", "", sanitise($pdo, $_POST['username']));
  $email = str_replace("'", "", sanitise($pdo, $_POST['email']));
  $phone = str_replace("'", "", sanitise($pdo, $_POST['phone']));
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];

  if (strlen($username) < 3 || !ctype_alnum($username)) {
    $errors[] = "Username has to be at least 3 characters long, and can only contain alphanumeric characters";
  } else {
    $query = "SELECT * FROM user WHERE username = '$username'";
    $statement = $pdo->query($query);

    if ($statement->rowCount()) {
      $errors[] = "Username already exists";
    }
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  } else {
    $query = "SELECT * FROM user WHERE email = '$email'";
    $statement = $pdo->query($query);

    if ($statement->rowCount()) {
      $errors[] = "Email already exists";
    }
  }

  if ($phone != '' && !preg_match("/^[0-9]{10}$/", $phone)) {
    $errors[] = "Invalid phone number";
  }

  if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
    $errors[] = "Password needs to be at least 8 characters long, and contain at least one number, one uppercase letter, and one lowercase letter";
  } else {
    if ($password !== $confirm) {
      $errors[] = "Passwords do not match";
    }
  }

  if (empty($errors)) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $is_admin = 0;
    $profile_picture = '../../assets/profile_pictures/default_profile_picture.png';

    $query = "
      INSERT INTO user (username, email, phone_number, password, profile_picture, user_points, is_admin)
      VALUES ('$username', '$email', '$phone', '$password', '$profile_picture', 0, $is_admin)  
    ";
    $result = $pdo->query($query);

    if (!$result) {
      die('Error: ' . $pdo->errorInfo()[2]);
    }

    session_start();

    $_SESSION['username'] = $username;
    $_SESSION['is_admin'] = $is_admin;
    $_SESSION['profile_picture'] = $profile_picture;
    $_SESSION['last_activity'] = time();

    header("location:../../php/views/profile.php");
  } else {
    foreach ($errors as $error) {
      echo $error . "<br>";
    }

    echo "<a href='../../php/views/sign_up.php'>Go back to sign-up page</a>";
  }
}

function sanitise($pdo, $str)
{
  $str = htmlentities($str);
  return $pdo->quote($str);
}

validateForm($pdo);
