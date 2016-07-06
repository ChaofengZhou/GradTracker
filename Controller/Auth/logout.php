
<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Controller for creating a student
 *
 */

error_reporting(E_ALL);

ini_set("display_errors", 1);

set_include_path( "../../Model/" . PATH_SEPARATOR . "../../View/");

session_start();
session_destroy();

header('Location: '.'..');

?>
