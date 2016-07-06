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

$message = null;

if(isset($_SESSION["uid"])) {
  $advisor = get_advisor_by($_SESSION["uid"]);
  if(!isset($_POST['formId'])) {
    $form = get_form($_GET['formId']);
    if($advisor->is_advisor_of($form->uid)) {
      $student = $form->get_owner_student();
      $currAdvisor = $advisor;
      require "Advisor/progress_form_view.php";
    } else {
      header('Location: '.'..');
    }
  } else {
    if($_POST['submitType'] == 'save_comment') {
      $advisor->save_comment($_POST);
    } else {
      $advisor->approve_form($_POST);  
    }
    
  }
} else {
  header('Location: '.'..');
}

?>

