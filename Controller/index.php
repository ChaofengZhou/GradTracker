<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for creating a student
 *
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path( "../Model/" . PATH_SEPARATOR .
  "../View/");

session_start();

$message = "";

$uid = "";
if (isset($_SESSION["uid"])) {
  $uid = $_SESSION["uid"];
  if($_SESSION['role'] == "student") {
    header('Location: '.'Student/mainpage.php');
  }
  else if($_SESSION['role'] == "advisor") {
    header('Location: '.'Advisor/mainpage.php');
  }
  else if($_SESSION['role'] == "staff") {
    header('Location: '.'Staff/mainpage.php');
  }
  else if($_SESSION['role'] == "DGS") {
    header('Location: '.'DGS/mainpage.php');
  }
} else {
  require_once 'Layout/index_view.php';  
}

?>
