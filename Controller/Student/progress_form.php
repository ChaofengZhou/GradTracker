<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for progress form
 *
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path( "../../Model/" . PATH_SEPARATOR . "../../View/");

session_start();

require_once 'Student/form.php';

$formId = $_GET['formId'];
$form = get_form($formId);
// echo $form->uid;
$student = $form->get_owner_student();
$message = null;

if(isset($_SESSION["uid"])) {
  if($_SESSION["uid"] == $form->uid || $_SESSION["role"] != 'student') {
    $currAdvisor = $student->get_advisor();
    require "Student/progress_form_view.php";  
  } else {
    header('Location: '.'..');
  }
} else {
  header('Location: '.'..');
}

?>

