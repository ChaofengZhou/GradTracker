<?php
require 'Layout/head_nav_view.php';

echo"
  <div class='container vertical-center'>
    <div class='jumbotron front_page'>";
echo "<div class='card-title'>Profile <a href='update_profile.php' class='edit'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>";
  echo "<div class='form-table'>
          <table>
            <tr>
              <th>First Name: </th>
              <td>"; echo htmlspecialchars($student->firstName); echo "</td>
              <th>Last Name: </th>
              <td>"; echo htmlspecialchars($student->lastName); echo "</td>
            </tr>
            <tr>
              <th>Degree: </th>
              <td>"; echo htmlspecialchars($student->degree); echo "</td>
              <th>Track: </th>
              <td>"; echo htmlspecialchars($student->track); echo "</td>
            </tr>
            <tr>
              <th>Student ID: </th>
              <td>"; echo htmlspecialchars($student->uid); echo "</td>
              <th>Advisor:</th>
              <td>"; if($currAdvisor != null) {
                echo htmlspecialchars($currAdvisor->firstName." ".$currAdvisor->lastName); 
              } echo "</td>
            </tr>
          </table>
        <label style='padding:10px 0'>Committe:<label>
      </div>
    </div>
    <div class='jumbotron front_page'>
      <div class='card-title'>Progress Forms</div>
        <div class='student-list-table'>
          <table>
            <tr>
              <th class='tHeader'>Form ID</th>
              <th class='tHeader'>Created Date</th>
              <th class='tHeader'>Modified Date</th>
              <th class='tHeader'>Submitted</th>
              <th class='tHeader'>Advisor Approved</th>
              <th class='tHeader'>Form</th>
            </tr>";
            if($forms != null) {
            foreach ($forms as $form) {
              echo "<tr>
              <td>"; echo htmlspecialchars($form->formId); echo "</td>
                <td>"; echo htmlspecialchars($form->createdDate); echo "</td>
                <td>"; echo htmlspecialchars($form->modifiedDate); echo "</td>
                <td>";if($form->submitted) {
                  echo "<i class='fa fa-check fa-lg yes-icon' aria-hidden='true'></i>";
                } else {
                  echo "<i class='fa fa-times fa-lg no-icon' aria-hidden='true'></i>";
                }
                echo "</td>
                <td>";if($form->approvedByAdvisor) {
                  echo "<i class='fa fa-check fa-lg yes-icon' aria-hidden='true'></i>";
                } else {
                  echo "<i class='fa fa-times fa-lg no-icon' aria-hidden='true'></i>";
                }
                echo "</td>
                <td><a class='btn btn-info' href='../Student/progress_form.php?formId=$form->formId'>View</a></td>
              </tr>";
              }
            }
    echo "</table>
        </div>
        <a class='btn btn-primary submit-form-btn' href='../Student/new_progress_form.php'>Create Progress Form</a>
      </div>
    </div>
    ";
require 'Layout/footer_view.php';
?>
