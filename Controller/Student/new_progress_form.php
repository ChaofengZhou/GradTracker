<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for creating a new form
 *
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path( "../../Model/" . PATH_SEPARATOR . "../../View/");

session_start();

$error = "";

require_once 'Student/student.php';
require_once 'Student/form.php';

if(isset($_SESSION["uid"]) && $_SESSION["role"] == 'student') {
  $student = get_student_by($_SESSION['uid']);
  $currAdvisor = $student->get_advisor();
  if(!isset($_POST['submitType'])) {  
    require "Student/new_form_view.php";
  } else {
    write_form($_POST, "new");
  }
} else {
  header('Location: '.'..');
}

?>
