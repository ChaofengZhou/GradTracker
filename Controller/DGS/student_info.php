<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for student form list
 *
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path( "../../Model/" . PATH_SEPARATOR . "../../View/");

session_start();

require_once 'Staff/staff.php';

if (isset($_SESSION["uid"])) {
  $studentId = $_GET['uid'];
  if($_SESSION['role'] == 'DGS') {
    load_student_view($studentId);
  } else {
    header('Location: '.'..');
  }
} else {
  header('Location: '.'..');
}

function load_student_view($studentId) {
  $student = get_student_by($studentId);
  $currAdvisor = $student->get_advisor();
  $forms = $student->get_forms();
  require_once 'DGS/student_info_view.php';
}

?>
