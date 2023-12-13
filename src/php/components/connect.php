<?php
$server = "localhost";
$database = "sef";
$username = "root";
$password = "";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

try {
  $pdo = new PDO("mysql:host=$server;dbname=$database", $username, $password, $options);
} catch (PDOException $error) {
  throw new PDOException($error->getMessage(), (int)$error->getCode());
}