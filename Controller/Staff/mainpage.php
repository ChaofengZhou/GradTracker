<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for DGS
 *
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path( "../../Model/" . PATH_SEPARATOR . "../../View/");

session_start();

if (isset($_SESSION["uid"])) {
  require_once 'Staff/staff.php';
  $uid = $_SESSION["uid"];
  $staff = get_staff_by($uid);
  $students_by_advisors = get_students_by_advisors();
  $recent_forms = recent_advisor_approvals();
  require "Staff/mainpage_view.php";
} else {
  header('Location: '.'..');
}

?>
