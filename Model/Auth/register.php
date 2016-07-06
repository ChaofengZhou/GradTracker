<?php
/**
 * Created by PhpStorm.
 * User: Chaofeng
 * Date: 2/16/16
 * Purpose: model for creating a user which is either a student or an advisor.
 */

$password = $_POST["password"];
$passwordrp = $_POST["passwordrp"];
$uid = $_POST["uid"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$role = $_POST["role"];

if($password != $passwordrp) {
  $passwordError = "The passwords don't match. Try again";
  require "NewUser/create_user_form_view.php";
  exit();
}

try {
  require_once 'DBConn/db_connect.php';

  $query = "
   SELECT uid FROM User WHERE uid = '$uid'
   ";
  $stmt = $db->prepare($query);
  $stmt->execute();
  if($stmt->fetch()) {
    $uidError = "The UID has been used. Try again";
    require "Auth/register_form_view.php";
    exit();
  }

  $options = [
    'cost' => 11,
    // 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
  ];
  $password = password_hash($password, PASSWORD_BCRYPT, $options);

  // save to User table
  $query = "
   INSERT INTO User (uid, password, firstName, lastName)
   VALUES ('$uid','$password', '$firstName', '$lastName')
   ";
  $stmt = $db->prepare($query);
  $stmt->execute();

  // save to Role table with speficited role
  $query = "
      INSERT INTO Role (uid, role) VALUES ('$uid','$role')";
  $stmt = $db->prepare($query);
  $stmt->execute();

  if ($role == "student") {
    $query = "
      INSERT INTO Student (uid, semesterAdmitted, degree, track)
      VALUES ('$uid','', '', '')";
    $stmt = $db->prepare($query);
    $stmt->execute();
    store_session($uid, $firstName, $lastName, $role);
    header('Location: '.'../Student/mainpage.php');

  } else if ($role == "advisor") {
    $query = "
      INSERT INTO Advisor (uid, officeRoom, officePhone)
      VALUES ('$uid','', '')";
    $stmt = $db->prepare($query);
    $stmt->execute();
    store_session($uid, $firstName, $lastName, $role);
    header('Location: '.'../Advisor/mainpage.php');

  } else if ($role == "staff") {
    $query = "
      INSERT INTO Staff (uid, officeRoom, officePhone)
      VALUES ('$uid','', '')";
    $stmt = $db->prepare($query);
    $stmt->execute();
    store_session($uid, $firstName, $lastName, $role);
    header('Location: '.'../Staff/mainpage.php');
  }
} catch (PDOException $ex) {
  echo
   "<p>Oops, DB error</p>
    <p> Code: {$ex->getCode()} </p>
    <pre>$ex</pre>";
  $error = "Registration failed. Try again.";
  require "Auth/register_form_view.php";
}

function store_session($uid, $firstName, $lastName, $role) {
  $_SESSION['uid'] = $uid;
  $_SESSION['firstName'] = $firstName;
  $_SESSION['lastName'] = $lastName;
  $_SESSION['role'] = $role;
}

?>
