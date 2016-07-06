<?php

/**
 * AuthorChaofeng Zhou
 * Date2/3/2016
 *
 * View for creating a new progress form 
 *
 */
require 'Layout/head_nav_view.php';
echo "
<script type='text/javascript' src='../Assets/js/bootstrap-multiselect.js'></script>
<link rel='stylesheet' href='../Assets/css/bootstrap-multiselect.css' type='text/css'/>
  <div class='container vertical-center'>";
  if($message) {
    if(isset($error)) {
      echo "<div class='alert alert-danger' role='alert'>";
    } else {
      echo "<div class='alert alert-success' role='alert'>";
    }
    echo "
      <i class='fa fa-exclamation-circle' aria-hidden='true'></i> $message
    </div>
    <div class='back-to-page'>
      <a href='student_info.php?uid={$student->uid}' class='btn btn-warning'><i class='fa fa-chevron-left' aria-hidden='true'></i> Back to Student</a>
    </div>";
  }
  echo "<div class='jumbotron front_page'>
    <div class='card-title form-name'>Due Progress Advisory Document for Ph.D. Degree</div>
      <div class='form-table'>";
      require 'Layout/prog_form_content_view.php';
        // <div class='bottom-descr'>
        //   <p>Has the student meet due progress requirement?</p>
        //   <span>";if($form->meetRequirement) {
        //     echo "<img class='yes-icon' src='../Assets/img/yes.svg' />";
        //   } else {
        //     echo "<img class='no-icon' src='../Assets/img/no.svg' />";
        //   }
        //   echo"</span>

        // </div>
        // if($form->approvedByAdvisor) {
        //   echo "<span class='advisor-signed'>Advisor Signed</span><img class='yes-icon' src='/Projects/asset/yes.svg' />";
        // } else {
        //   echo "<a href='../Advisor/sign_progress_form.php?formId=$form->formId' class='submit-form-btn'>Sign this form</a><span class='uid-descr'>This button will only be viewable for advisor in later assignments</span></br>";  
        // }
         
        if($message == "") {
            echo "<form action='progress_form.php' method='post'>
            <div class='form-group prog-descr'>
              <label for='comment'>Comment:</label>
              <textarea class='form-control' rows='5' name='comment''></textarea>
            </div>
            <div class='prog-descr split2'>
              <p style='font-size:14px'>The email addresses are used for email notifications. When the project comes to production, we won't need these prompts since we will have umails given by the real UIDs.</p>
              <div style='margin-right: 10px;'>
                <label>Student Advisor Email</label>
                <input type='text' class='form-control' name='advisorEmail'>
              </div>
              <div style='margin-left: 10px;'>
                <label>DGS Email</label>
                <input type='text' class='form-control' name='dgsEmail'>
              </div>  
            </div>
            <input type='text' value='{$form->formId}' name='formId' hidden>
            <div class='p-form-btns2'>";
            if(!$form->approvedByDGS) { echo "
              <button type='submit' name='submitType' value='{$_SESSION['uid']}' class='btn btn-primary submit-form-btn'>Approve</button>"; }
            else {
              echo "
              <button type='submit' name='submitType' value='' class='btn btn-danger submit-form-btn'>Disapprove</button>";
            }
            echo"
              <a href='student_info.php?uid=$student->uid' class='btn btn-warning submit-form-btn'> Back </a>
            </div></form>"; 
          }
      echo "</div>";
require 'Layout/footer_view.php';
?>
