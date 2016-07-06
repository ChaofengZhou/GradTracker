<?php

require 'Layout/head_nav_view.php';
echo"
  <div class='container vertical-center'>";
    if($error) {
      echo "<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> $message</div>";
    }
    echo "
    <div class='jumbotron front_page'>
      <div class='card-title'>Your Profile</div>
        <form action='update_profile.php' method='post'>
          <div class='form-table'>
          <table>
            <tr>
              <th>First Name</th>
              <td><input class='form-control' type='text' name='firstName' value='{$advisor->firstName}' required/></td>
              <th>Last Name</th>
              <td><input class='form-control' type='text' name='lastName' value='{$advisor->lastName}' required/></td>
            </tr>
            <tr>
              <th>Office Room #</th>
              <td><input class='form-control' type='text' name='officeRoom' value='{$advisor->officeRoom}'/></td>
              <th>Office Phone #</th>
              <td><input class='form-control' type='text' name='officePhone' value='{$advisor->officePhone}'/></td>
            </tr>
          </table>
        </div>
        <input name='uid' value='{$advisor->uid}' hidden/>
        <button type='submit' class='btn btn-primary submit-form-btn'> Save </button>
        <a href='mainpage.php' class='btn btn-warning submit-form-btn'> Cancel </a>
      </form>           
    </div>";
require 'Layout/footer_view.php';
?>
