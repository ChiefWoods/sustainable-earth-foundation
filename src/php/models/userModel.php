<?php

class UserModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function createUser($username, $email, $phone, $password)
  {
    $query = "INSERT INTO user (username, email, phone_number, password, profile_picture, user_points) VALUES ('$username', '$email', '$phone', '$password', '../../assets/images/default_profile_picture.png', 0)";
    $this->pdo->query($query);
  }

  public function getUserId($username)
  {
    $query = "SELECT user_id FROM user WHERE username = '$username'";
    $statement = $this->pdo->query($query);
    $user = $statement->fetch();
    return $user['user_id'];
  }

  public function getUsername($user_id)
  {
    $query = "SELECT username FROM user WHERE user_id = $user_id";
    $statement = $this->pdo->query($query);
    $user = $statement->fetch();
    return $user['username'];
  }

  public function getEmail($username)
  {
    $query = "SELECT email FROM user WHERE username = '$username'";
    $statement = $this->pdo->query($query);
    $user = $statement->fetch();
    return $user['email'];
  }

  public function getPhoneNumber($username)
  {
    $query = "SELECT phone_number FROM user WHERE username = '$username'";
    $statement = $this->pdo->query($query);
    $user = $statement->fetch();
    return $user['phone_number'];
  }

  public function getPassword($username)
  {
    $query = "SELECT password FROM user WHERE username = '$username'";
    $statement = $this->pdo->query($query);
    $user = $statement->fetch();
    return $user['password'];
  }

  public function getProfilePicture($username)
  {
    $query = "SELECT profile_picture FROM user WHERE username = '$username'";
    $statement = $this->pdo->query($query);
    $user = $statement->fetch();
    return $user['profile_picture'];
  }

  public function getUserPoints($username)
  {
    $query = "SELECT user_points FROM user WHERE username = '$username'";
    $statement = $this->pdo->query($query);
    $user = $statement->fetch();
    return $user['user_points'];
  }

  public function getAllUsers()
  {
    $query = "SELECT * FROM user";
    $statement = $this->pdo->query($query);
    $users = $statement->fetchAll();
    return $users;
  }

  public function getAllUsersByUsername($username)
  {
    $query = "SELECT * FROM user WHERE username LIKE '%$username%'";
    $statement = $this->pdo->query($query);
    return $statement;
  }

  public function getAllUsersByEmail($email)
  {
    $query = "SELECT * FROM user WHERE email LIKE '%$email%'";
    $statement = $this->pdo->query($query);
    return $statement;
  }

  public function updateProfilePicture($path, $username)
  {
    $query = "UPDATE user SET profile_picture = '$path' WHERE username = '$username'";
    $this->pdo->query($query);
  }

  public function updateProfileInfo($email, $phone, $username)
  {
    $query = "UPDATE user SET email = '$email', phone_number = '$phone' WHERE username = '$username'";
    $this->pdo->query($query);
  }

  public function updatePassword($password, $username)
  {
    $query = "UPDATE user SET password = '$password' WHERE username = '$username'";
    $this->pdo->query($query);
  }

  public function deductPoints($points, $username)
  {
    $query = "UPDATE user SET user_points = user_points - $points WHERE username = '$username'";
    $this->pdo->query($query);
  }

  public function editUser($username, $phone, $userPoints)
  {
    $query = "UPDATE user SET phone_number = '$phone', user_points = $userPoints WHERE username = '$username'";
    $this->pdo->query($query);
  }

  public function deleteUser($username)
  {
    $query = "DELETE FROM user WHERE username = '$username'";
    $this->pdo->query($query);
  }
}
