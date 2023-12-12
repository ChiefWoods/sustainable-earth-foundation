<?php

session_start();

if (isset($_GET['logout']) && $_GET['logout'] == true) {
  session_destroy();
  header("location:../views/login.php");
  exit;
}