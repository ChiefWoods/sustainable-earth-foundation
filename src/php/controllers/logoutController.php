<?php

session_start();

if (isset($_GET['logout']) && $_GET['logout'] == true) {
  session_destroy();
  header("location:../views/login.php");
  exit;
} else if (isset($_GET['expired']) && $_GET['expired'] == true) {
  session_destroy();
  header("location:../../php/views/session_expired.php");
  exit;
}