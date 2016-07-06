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

require_once 'Student/student.php';
require_once 'Advisor/advisor.php';

$error = "";

if (isset($_SESSION["uid"])) {
  $uid = $_SESSION["uid"];
  $student = get_student_by($uid);
  if(!isset($_POST['uid'])) {
    $advisors = get_advisors();
    $currAdvisor = $student->get_advisor();
    require "Student/update_profile_view.php";
  } else {
    $student->update_profile($_POST);
  }
} else {
  header('Location: '.'..');
}

?>
