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

require_once 'Staff/staff.php';
require_once 'Student/form.php';

$message = null;

if(isset($_SESSION["uid"])) {
  $staff = get_staff_by($_SESSION["uid"]);
  if(!isset($_POST['formId'])) {
    $form = get_form($_GET['formId']);
      $student = $form->get_owner_student();
      $currAdvisor = $student->get_advisor();
      require "Staff/progress_form_view.php";
  } else {
    $staff->approve_form($_POST);
  }
} else {
  header('Location: '.'..');
}

?>

