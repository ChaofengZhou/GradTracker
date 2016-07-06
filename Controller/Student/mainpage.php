<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for creating a user
 *
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path( "../../Model/" . PATH_SEPARATOR . "../../View/");

session_start();

if (isset($_SESSION["uid"])) {
  $uid = $_SESSION["uid"];
  
  require_once 'Student/student.php';
  $student = get_student_by($uid);
  $currAdvisor = $student->get_advisor();
  $forms = $student->get_forms();
  require "Student/mainpage_view.php";
} else {
  header('Location: '.'..');
}

?>
