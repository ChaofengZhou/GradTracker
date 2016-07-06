<?php
/**
 * Created by PhpStorm.
 * User: Chaofeng
 * Date: 2/16/16
 * Purpose: model for creating a student. Store data from the web form to db
 */

try {
  require_once 'DBConn/db_connect.php';

  $stmt = $db->prepare("select * from User where uid='$uid'");
  $stmt->execute();
  if ($row = $stmt->fetch()) {
    if(password_verify($password, $row['password'])) {
      $_SESSION['uid'] = $row['uid'];
      $_SESSION['firstName'] = $row['firstName'];
      $_SESSION['lastName'] = $row['lastName'];
      $stmt = $db->prepare("select role from Role where uid = '$uid'");
      $stmt->execute();
      $role = "";
      if ($row = $stmt->fetch()) {
        $role = $row['role'];
      }
      
      $_SESSION['role'] = $role;
      if($role == "student") {
        header('Location: '.'../Student/mainpage.php');
      }
      else if($role == "advisor") {
        header('Location: '.'../Advisor/mainpage.php');
      }
      else if($role == "staff") {
        header('Location: '.'../Staff/mainpage.php');
      }
      else if($role == "DGS") {
        header('Location: '.'../DGS/mainpage.php');
      }
    } else {
      $message = "UID or password was wrong";
      require 'Layout/index_view.php';
      exit();
    }
  }
  else {
    $message = "UID or password was wrong";
    require 'Layout/index_view.php';
    exit();
  }
}
catch (PDOException $ex) {
  echo
   "<p>Oops, DB error</p>
    <p> Code: {$ex->getCode()} </p>
    <pre>$ex</pre>";
  $message = "Server authentication failed. Please try again in a couple of hours.";
  require "Layout/index_view.php";
}

?>
