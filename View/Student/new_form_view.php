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
  if($error) {
    echo "<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> $error</div>";
  }
   echo "<div class='jumbotron front_page'>
      <div class='regular-title form-name'>New Progress Form</div>
      <form action='new_progress_form.php' method='post'>
        <div class='form-table'>
          <table class='form-info-table'>
            <tr>
              <th>Name: </th>
              <td><input class='form-control' type='text' name='uid' value='{$student->firstName} {$student->lastName}' disabled/></td>
              <th class='right-col'>UID: </th>
              <td><input class='form-control' type='text' name='uid' value='{$student->uid}' disabled/></td>
            </tr>
            <tr>
              <th>Degree: </th>
              <td><input class='form-control' type='text' name='degree' value='{$student->degree}' required/></td>
              <th class='right-col'>Track: </th>
              <td><input class='form-control' type='text' name='track' value='{$student->track}' required/></td>
            </tr>
            <tr>
              <th style='font-size:15px'>Semester</br> Admitted: </th>
              <td><input class='form-control' type='text' name='semesterAdmitted' value='{$student->semesterAdmitted}' disabled/></td>
              <th style='font-size:15px' class='right-col'>Number of semesters</br> in the program: </th>
              <td><input class='form-control' type='text' name='numOfSemesters'/></td>
            </tr>
            <tr>
              <th>Advisor: </th>
              <td>";
              if($currAdvisor != null) {
                echo "<input class='form-control' type='text' name='uid' value='{$currAdvisor->firstName} {$currAdvisor->lastName}' disabled/>";
              } else {
                echo "
                <select class='form-control' name='advisor'>
                <option></option>
                <option>Peter Jensen</option>
                <option>Matt Flatt</option>
                <option>Chuck Hansen</option>
                </select>";
              }
              echo "
              </td>
            </tr>
            <tr>
              <th>Committee: </th>
              <td></td>
            </tr>
          </table>
          <table class='semester-form'>
            <tr>
              <th class='tHeader'>Activity</th>
              <th class='tHeader'>Good Progress</th>
              <th class='tHeader'>Acceptable Progress</th>
              <th class='tHeader'>Completed Semester</th>
            </tr>
            <tr>
              <th>Identify Advisor</th>
              <td>1 semester</td>
              <td>2 semesters</td>
              <td><input class='form-control' type='text' name='identifyAdvisor'>
            </tr>
            <tr>
              <th>Program of study approved by advisor and initial committee</th>
              <td>4 semesters</td>
              <td>5 semesters</td>
              <td><input class='form-control' type='text' name='programApprovedInitial'>
            </tr>
            <tr>
              <th>Complete teaching mentorship</th>
              <td>4 semesters</td>
              <td>6 semesters</td>
              <td><input class='form-control' type='text' name='teachingMentorship'>
            </tr>
            <tr>
              <th>Complete required courses</th>
              <td>5 semesters</td>
              <td>6 semesters</td>
              <td><input class='form-control' type='text' name='completeRequiredCourse'>
            </tr>
            <tr>
              <th>Full committee formed</th>
              <td>6 semesters</td>
              <td>7 semesters</td>
              <td><input class='form-control' type='text' name='committeeFormed'>
            </tr>
            <tr>
              <th>Program of Study approved by committee</th>
              <td>6 semesters</td>
              <td>7 semesters</td>
              <td><input class='form-control' type='text' name='programApproved'>
            </tr>
            <tr>
              <th>Written qualifier</th>
              <td>5 semesters</td>
              <td>6 semesters</td>
              <td><input class='form-control' type='text' name='writtenQualifier'>
            </tr>
            <tr>
              <th>Oral qualifier/Proposal</th>
              <td>7 semesters</td>
              <td>8 semesters</td>
              <td><input class='form-control' type='text' name='oralProposal'>
            </tr>
            <tr>
              <th>Dissertation defense</th>
              <td>10 semesters</td>
              <td>12 semesters</td>
              <td><input class='form-control' type='text' name='dissertationDefense'>
            </tr>
            <tr>
              <th>Final document</th>
              <td></td>
              <td></td>
              <td><input class='form-control' type='text' name='finalDocument'>
          </table>
        
          <div class='prog-descr'>
            <label for='comment'>Progress Description:</label>
            <textarea class='form-control' rows='5' name='progressDescription'></textarea>
          </div>
          <div class='prog-descr split2'>
            <p style='font-size:14px'>The email addresses are used for email notifications. When the project comes to production, we won't need these prompts since we will have umails given by the real UIDs.</p>
            <div style='margin-right: 10px;'>
              <label>Advisor Email</label>
              <input type='text' class='form-control' name='advisorEmail'>
            </div>
            <div style='margin-left: 10px;'>
              <label>Student Email</label>
              <input type='text' class='form-control' name='studentEmail'>
            </div>  
          </div>
        </div>
        <input type='text' value='{$student->uid}' name='uid' hidden>
        <div class='p-form-btns'>
          <button type='submit' class='btn btn-primary submit-form-btn' name='submitType' value='1'>Submit</button>
          <button type='submit' class='btn btn-info submit-form-btn' name='submitType' value='0'>Save</button>
          <a href='..' class='btn btn-danger submit-form-btn'>Canel</a>
        </div>
      </form>
    </div>
    ";
require 'Layout/footer_view.php';
?>
