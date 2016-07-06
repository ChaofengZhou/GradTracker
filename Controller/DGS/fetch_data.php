<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for advisor
 *
 */

error_reporting(E_ALL);

ini_set("display_errors", 1);

set_include_path( "../../Model/" . PATH_SEPARATOR . "../../View/");

session_start();

// if (isset($_SESSION["uid"]) && $_SESSION['role'] == "DGS") {
//   require_once 'DGS/change_role.php';
// } else {
//   header('Location: '.'../Index/index.php');
// }

if (isset($_SESSION["uid"])) {
  require_once 'DGS/dgs.php';
  fetch_data($_POST['chartOption'], $_POST['yearOption']);
}

?>
