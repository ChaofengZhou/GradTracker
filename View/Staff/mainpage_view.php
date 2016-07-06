<?php

require 'Layout/head_nav_view.php';
echo"
  <div class='container vertical-center'>
    <div class='jumbotron front_page'>
      <div class='card-title'>Profile <a href='update_profile.php' class='edit'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>
      <div class='form-table'>
        <table>
          <tr>
            <th>First Name: </th>
            <td>"; echo htmlspecialchars($staff->firstName); echo "</td>
            <th>Last Name: </th>
            <td>"; echo htmlspecialchars($staff->lastName); echo "</td>
          </tr>
          <tr>
            <th>Office Room #: </th>
            <td>"; echo htmlspecialchars($staff->officeRoom); echo "</td>
            <th>Office Phone #: </th>
            <td>"; echo htmlspecialchars($staff->officePhone); echo "</td>
          </tr>
        </table>
      </div>
    </div>
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
              echo "<tr><td><a href='../Staff/student_info.php?uid=$student->uid'>"; 
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
      <div class='card-title'>Forms Approved by Advisors Recently</div>
        <div class='student-list-table'>
          <table>
            <tr>
              <th class='tHeader'>Form ID</th>
              <th class='tHeader'>Student Name</th>
              <th class='tHeader'>Approved Date</th>
              <th class='tHeader'>Approved by Staff</th>
              <th class='tHeader'>Form</th>
            </tr>";
            foreach ($recent_forms as $form) {
              if($form->approvedByAdvisor) {
              echo "<tr>
              <td>"; echo htmlspecialchars($form->formId); echo "</td>
              <td><a href='../Staff/student_info.php?uid=$form->uid'>"; 
                  echo htmlspecialchars($form->firstName." ".$form->lastName); 
                  echo "</a></td>
                <td>"; echo htmlspecialchars($form->advisorApprovedDate); echo "</td>
                <td>";if($form->approvedByStaff != null) {
                  echo "<i class='fa fa-check fa-lg yes-icon' aria-hidden='true'></i>";
                } else {
                  echo "<i class='fa fa-times fa-lg no-icon' aria-hidden='true'></i>";
                }
                echo "</td>
                <td><a class='btn btn-info' href='../Staff/progress_form.php?formId=$form->formId'>View</a></td>
              </tr>";
              }
            }
     echo "</table>
         </div>
       </div>
       </div>
  </div>
  <script src='../Assets/js/advisor_filter.js'></script>";
require 'Layout/footer_view.php';
?>
