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

if(isset($_SESSION["uid"])) { 
  if(!isset($_POST['submitType'])) {
    $form = get_form($_GET['formId']);
    if($_SESSION["uid"] == $form->uid) {
      $student = $form->get_owner_student();
      $currAdvisor = $student->get_advisor();
      $message = null;
      require "Student/edit_form_view.php";
    } else {
      header('Location: '.'..');
    }
  } else {
    write_form($_POST, "edit");
  }
} else {
  header('Location: '.'..');
}

?>

