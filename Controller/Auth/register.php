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

$error = "";
$usernameError = "";
$uidError = "";
$passwordError = "";

require_once 'Student/student.php';
require_once 'Advisor/advisor.php';
require_once 'Staff/staff.php';

session_start();

if(!isset($_POST['uid'])) {
  require "Auth/register_form_view.php";  
} else {
  require_once 'Auth/register.php';
}

?>
