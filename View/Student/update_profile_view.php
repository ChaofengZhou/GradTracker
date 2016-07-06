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
              <td><input class='form-control' type='text' name='firstName' value='{$student->firstName}' required/></td>
              <th>Last Name</th>
              <td><input class='form-control' type='text' name='lastName' value='{$student->lastName}' required/></td>
            </tr>
            <tr>
              <th>Degree</th>
              <td><input class='form-control' type='text' name='degree' value='{$student->degree}'/></td>
              <th>Track</th>
              <td><input class='form-control' type='text' name='track' value='{$student->track}'/></td>
            </tr>
            <tr>
              <th>Semester Admitted</th>
              <td><input class='form-control' type='text' name='semesterAdmitted' value='{$student->semesterAdmitted}'/></td>
              <th>Advisor</th>
              <td><select class='form-control' name='advisor'>";
                if($currAdvisor != null) {
                  echo "<option value='{$currAdvisor->uid}'>{$currAdvisor->firstName} {$currAdvisor->lastName}</option>";
                  foreach ($advisors as $advisor) {
                    if($currAdvisor->uid != $advisor->uid) {
                      echo "<option value='{$advisor->uid}'>{$advisor->firstName} {$advisor->lastName}</option>";
                    }
                  }
                } else {
                  echo "<option></option>";
                  foreach ($advisors as $advisor) {
                    echo "<option value='{$advisor->uid}'>{$advisor->firstName} {$advisor->lastName}</option>";
                  }
                }
                echo "
                </select></td>
            </tr>
            <tr>
              <th>Committe</th>
              <td><input class='form-control' type='text' name='committe'/></td>
            </tr>
          </table>
        </div>
        <input name='uid' value='{$student->uid}' hidden/>
        <button type='submit' class='btn btn-primary submit-form-btn'> Save </button>
        <a href='mainpage.php' class='btn btn-warning submit-form-btn'> Cancel </a>
      </form>        
    </div>    
    <script src='../Assets/js/add_committee.js'></script>";
  require 'Layout/footer_view.php';
?>
