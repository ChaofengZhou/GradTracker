<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for modifying a progress form
 *
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path( "../../Model/" . PATH_SEPARATOR . "../../View/");

session_start();

require_once 'Staff/staff.php';

$error = "";

if (isset($_SESSION["uid"])) {
  $uid = $_SESSION["uid"];
  $staff = get_staff_by($uid);
  if(!isset($_POST['uid'])) {
    require "Staff/update_profile_view.php";
  } else {
    $staff->update_profile($_POST);
  }
} else {
  header('Location: '.'..');
}

?>
