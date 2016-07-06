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
            <td>"; echo htmlspecialchars($advisor->firstName); echo "</td>
            <th>Last Name: </th>
            <td>"; echo htmlspecialchars($advisor->lastName); echo "</td>
          </tr>
          <tr>
            <th>Office Room #: </th>
            <td>"; echo htmlspecialchars($advisor->officeRoom); echo "</td>
            <th>Office Phone #: </th>
            <td>"; echo htmlspecialchars($advisor->officePhone); echo "</td>
          </tr>
        </table>
      </div>
    </div>
    <div class='jumbotron front_page'>
        <div class='card-title'>Graduate students</div>
        <div class='student-list-table'>
          <table>
            <tr>
              <th class='tHeader'>Name</th>
              <th class='tHeader'>UID</th>
              <th class='tHeader'>Degree</th>
              <th class='tHeader'>Track</th>
            </tr>";
            if($students != null) {
            foreach ($students as $student) {
              echo "<tr><td><a href='../Advisor/student_info.php?uid=$student->uid'>"; 
              echo htmlspecialchars($student->firstName." ".$student->lastName); echo "</a></td>
              <td>"; echo htmlspecialchars($student->uid); echo "</td>
              <td>"; echo htmlspecialchars($student->degree); echo "</td>
              <td>"; echo htmlspecialchars($student->track); echo "</td>
            </tr>";
              } 
            }
  echo"</table>
      </div>
    </div>
    <div class='jumbotron front_page'>
      <div class='card-title'>Forms Submited by Students Recently</div>
        <div class='student-list-table'>
          <table>
            <tr>
              <th class='tHeader'>Form ID</th>
              <th class='tHeader'>Student Name</th>
              <th class='tHeader'>Submited Date</th>
              <th class='tHeader'>Form</th>
            </tr>";
            foreach ($recent_forms as $form) {
              echo "<tr>
              <td>"; echo htmlspecialchars($form->formId); echo "</td>
              <td><a href='../DGS/student_info.php?uid=$form->uid'>"; 
                  echo htmlspecialchars($form->firstName." ".$form->lastName); 
                  echo "</a></td>
                <td>"; echo htmlspecialchars($form->modifiedDate); echo "</td>
                <td><a class='btn btn-info' href='../DGS/progress_form.php?formId=$form->formId'>View</a></td>
              </tr>";
            }
    echo "</table>
      </div>
    </div>
  </div>
    ";
require 'Layout/footer_view.php';
?>
