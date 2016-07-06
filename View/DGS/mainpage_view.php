<?php

require 'Layout/head_nav_view.php';
echo"
  <div class='container vertical-center'>
    <div class='jumbotron front_page'>
      <div class='card-title'>Students by Advisor</div>
        <div class='advisor-filter'>
          <label>Advisor:</label> 
          <select name='advisorFilter' class='form-control'>";
          foreach($students_by_advisors as $advisorID => $students) {
            $advisor = get_advisor_by($advisorID);
            echo "<option value='{$advisor->uid}'>{$advisor->firstName} {$advisor->lastName}</option>";
          }
          echo "
          </select>
        </div>";
          $count = 0;
          foreach($students_by_advisors as $advisorID => $students) {
            $advisor = get_advisor_by($advisorID);
            if($count == 0) echo "<div class='student-list-table {$advisor->uid} adv'>";
            else echo "<div class='student-list-table {$advisor->uid} adv' hidden>";
          echo "
          <table>
            <tr>
              <th class='tHeader'>Name</th>
              <th class='tHeader'>UID</th>
              <th class='tHeader'>Degree</th>
              <th class='tHeader'>Track</th>
            </tr>";
          if($students != null) {
            foreach ($students as $student) {
              echo "<tr><td><a href='../DGS/student_info.php?uid=$student->uid'>"; 
                  echo htmlspecialchars($student->firstName." ".$student->lastName); 
                  echo "</a></td>
                <td>"; echo htmlspecialchars($student->uid); echo "</td>
                <td>"; echo htmlspecialchars($student->degree); echo "</td>
                <td>"; echo htmlspecialchars($student->track); echo "</td>
              </tr>";
              } 
            }
          $count++;
      echo "</table>
         </div>";
          }
    echo "
      </div>
    <div class='jumbotron front_page'>
      <div class='card-title'>Forms Approved by Staff Recently</div>
        <div class='student-list-table'>
          <table>
            <tr>
              <th class='tHeader'>Form ID</th>
              <th class='tHeader'>Student Name</th>
              <th class='tHeader'>Approved Date</th>
              <th class='tHeader'>Form</th>
            </tr>";
            foreach ($recent_forms as $form) {
              if($form->approvedByStaff) {
              echo "<tr>
              <td>"; echo htmlspecialchars($form->formId); echo "</td>
              <td><a href='../DGS/student_info.php?uid=$form->uid'>"; 
                  echo htmlspecialchars($form->firstName." ".$form->lastName); 
                  echo "</a></td>
                <td>"; echo htmlspecialchars($form->staffApprovedDate); echo "</td>
                <td><a class='btn btn-info' href='../DGS/progress_form.php?formId=$form->formId'>View</a></td>
              </tr>";
              }
            }
    echo "</table>
     </div>
   </div>
  </div>
  <script src='../Assets/js/advisor_filter.js'></script>";
require 'Layout/footer_view.php';
?>

<!-- <script src='../Assets/js/highcharts.js'></script>
  <script src='../Assets/js/overview.js'></script>
  <div class='container vertical-center'>
    <div class='jumbotron front_page'>
        <div class='card-title'>Charts of Stats</div>
        <div class='charts'>
        <form id='chartForm' onchange='return find_data()'>
          <select name='chartOption' class='form-control' id='chartList'>
            <option value='0' selected>Select a chart</option>
            <option value='1'>Current GPAs of all students</option>
            <option value='2'>Progress form completion and signed info</option>
            <option value='3'>Number of Ph.D. students per faculty</option>
            <option value='4'>Number of committees each faculty sits on</option>
            <option value='5'>Number of graduating Ph.D. students for the given year</option>
            <option value='6'>Number of students ahead of, on and behind schedule</option>
          </select>
          <div id='yearForm' style='display:none;'>
            <label for='year'>Year</label>
            <select name='yearOption' class='form-control' id='yearList'>
              <option value='2009' selected>2009</option>
              <option value='2010'>2010</option>
              <option value='2011'>2011</option>
              <option value='2012'>2012</option>
              <option value='2013'>2013</option>
              <option value='2014'>2014</option>
              <option value='2015'>2015</option>
              <option value='2016'>2016</option>
            </select>
          </div>
        </form>
      </div>
      <div id='chart'></div>
    </div> -->
