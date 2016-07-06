<?php
require 'Layout/head_nav_view.php';
echo"

  <div class='container vertical-center'>
    <div class='back-to-page'>
      <a href='mainpage.php' class='btn btn-warning'><i class='fa fa-chevron-left' aria-hidden='true'></i> Back</a>
    </div>
    <div class='jumbotron front_page'>
      <div class='card-title'>"; echo htmlspecialchars($student->firstName." ".$student->lastName); echo "</div>
      <div class='form-table'>
        <table>
          <tr>
            <th>Student ID: </th>
            <td>"; echo htmlspecialchars($student->uid); echo "</td>
            <th>Advisor:</th>
            <td>"; if($currAdvisor != null) {
              echo htmlspecialchars($currAdvisor->firstName." ".$currAdvisor->lastName); 
            } echo "</td>
          </tr>
          <tr>
            <th>Degree: </th>
            <td>"; echo htmlspecialchars($student->degree); echo "</td>
            <th>Track: </th>
            <td>"; echo htmlspecialchars($student->track); echo "</td>
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
              <th class='tHeader'>Submited Date</th>
              <th class='tHeader'>Approved by Staff</th>
              <th class='tHeader'>Approved by You</th>
              <th class='tHeader'>Form</th>
            </tr>";
          if($forms != null) {
            foreach ($forms as $form) {
              if($form->approvedByStaff) {
              echo "<tr>
              <td>"; echo htmlspecialchars($form->formId); echo "</td>
                <td>"; echo htmlspecialchars($form->modifiedDate); echo "</td>
                <td>";if($form->approvedByStaff != null) {
                  echo "<i class='fa fa-check fa-lg yes-icon' aria-hidden='true'></i>";
                } else {
                  echo "<i class='fa fa-times fa-lg no-icon' aria-hidden='true'></i>";
                }
                echo "</td>
                <td>";if($form->approvedByDGS != null) {
                  echo "<i class='fa fa-check fa-lg yes-icon' aria-hidden='true'></i>";
                } else {
                  echo "<i class='fa fa-times fa-lg no-icon' aria-hidden='true'></i>";
                }
                echo "</td>
                <td><a class='btn btn-info' href='../DGS/progress_form.php?formId=$form->formId'>View</a></td>
              </tr>";
              }
            }
          }
     echo "</table>
         </div>
       </div>
    </div>
  </div>";
require 'Layout/footer_view.php';
?>
