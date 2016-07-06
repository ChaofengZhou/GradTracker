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
  require_once 'Advisor/advisor.php';
  $uid = $_SESSION["uid"];
  $advisor = get_advisor_by($uid);
  $students = $advisor->get_students();
  $recent_forms = recent_submmited_forms();
  require "Advisor/mainpage_view.php";
} else {
  header('Location: '.'..');
}

?>



