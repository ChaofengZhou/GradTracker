<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * View for create user form
 *
 */
require 'Layout/head_nav_view.php';
echo "
  <div class='container vertical-center'>
      <div class='regular-title form-name'>Register a new user</div>";
          if($error || $usernameError || $uidError || $passwordError) {
            echo "<div class='alert alert-danger' role='alert'>
            <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> 
            {$error} {$usernameError} {$uidError} {$passwordError}</div>";
          }
          echo "
          <div class='col-md-4'>
          </div>
        <form action='register.php' method='post'>
          <div class='col-md-4'>
            <input type='text' name='uid' class='signup-form form-control' placeholder='UID (e.g. u1001000)' pattern='^u[\d]{7}' required>
            <input type='password' name='password' class='signup-form form-control' placeholder='Password' pattern='^.{1,}$'  required>
            <input type='password' name='passwordrp' class='signup-form form-control' placeholder='Confirm Password' pattern='^.{1,}$' required>
            <input type='text' name='firstName' class='signup-form form-control' placeholder='First Name' required>
            <input type='text' name='lastName' class='signup-form form-control' placeholder='Last Name' required>
            <div class='role-pick'>
              <input type='radio' name='role' value='student' checked> Student
              <input type='radio' name='role' value='advisor'> Faculty
              <input type='radio' name='role' value='staff'> Staff
            </div>
            <div class='col-md-2'></div>
            <div class='col-md-8'>
              <button type='submit' class='btn btn-success signup-btn'> Sign Up</button>
              <a class='btn btn-danger cancel-btn pull-right' href='../index.php'> Cancel</a>
            </div>
          </div>
          </div>
        </form>
      </div>   
      </div>
    </div>";
require 'Layout/footer_view.php';
?>

<!-- pattern='^[a-zA-Z]+$' -->
