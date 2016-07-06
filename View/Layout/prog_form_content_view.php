<?php

echo "
      <table class='form-info-table'>
        <tr>
          <th>Modified Date: </th>
          <td>"; echo htmlspecialchars($form->modifiedDate); echo "</td>
        </tr>
        <tr>
          <th>Student Name: </th>
          <td>"; echo htmlspecialchars($student->firstName." ".$student->lastName); echo "</td>
          <th>Student ID #: </th>
          <td>"; echo htmlspecialchars($form->uid); echo "</td>
        </tr>
        <tr>
          <th>Degree: </th>
          <td>"; echo htmlspecialchars($student->degree); echo "</td>
          <th>Track: </th>
          <td>"; echo htmlspecialchars($student->track); echo "</td>
        </tr>
        <tr>
          <th style='font-size:16px'>Semester Admitted: </th>
          <td>"; echo htmlspecialchars($student->semesterAdmitted); echo "</td>
          <th style='font-size:16px'>Number of semesters</br> in the program: </th>
          <td>"; echo htmlspecialchars($form->numOfSemesters); echo "</td>
        </tr>
        <tr>
          <th>Advisor: </th>
          <td>"; if($currAdvisor !=null)
          echo htmlspecialchars($currAdvisor->firstName." ".$currAdvisor->lastName); echo "</td>
        </tr>
        <tr>
          <th>Committee: </th>
          <td>"; if($currAdvisor !=null)
          echo htmlspecialchars($currAdvisor->firstName." ".$currAdvisor->lastName); echo "</td>
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
          <td>"; if($form->identifyAdvisor != null) echo htmlspecialchars($form->identifyAdvisor); echo "</td>
        </tr>
        <tr>
          <th>Program of study approved by advisor and initial committee</th>
          <td>4 semesters</td>
          <td>5 semesters</td>
          <td>"; if($form->programApprovedInitial != null) echo htmlspecialchars($form->programApprovedInitial); echo "</td>
        </tr>
        <tr>
          <th>Complete teaching mentorship</th>
          <td>4 semesters</td>
          <td>6 semesters</td>
          <td>"; if($form->teachingMentorship != null) echo htmlspecialchars($form->teachingMentorship); echo "</td>
        </tr>
        <tr>
          <th>Complete required courses</th>
          <td>5 semesters</td>
          <td>6 semesters</td>
          <td>"; if($form->completeRequiredCourse != null) echo htmlspecialchars($form->completeRequiredCourse); echo "</td>
        </tr>
        <tr>
          <th>Full committee formed</th>
          <td>6 semesters</td>
          <td>7 semesters</td>
          <td>"; if($form->committeeFormed != null) echo htmlspecialchars($form->committeeFormed); echo "</td>
        </tr>
        <tr>
          <th>Program of Study approved by committee</th>
          <td>6 semesters</td>
          <td>7 semesters</td>
          <td>"; if($form->programApproved != null) echo htmlspecialchars($form->programApproved); echo "</td>
        </tr>
        <tr>
          <th>Written qualifier</th>
          <td>5 semesters</td>
          <td>6 semesters</td>
          <td>"; if($form->writtenQualifier != null) echo htmlspecialchars($form->writtenQualifier); echo "</td>
        </tr>
        <tr>
          <th>Oral qualifier/Proposal</th>
          <td>7 semesters</td>
          <td>8 semesters</td>
          <td>"; if($form->oralProposal != null) echo htmlspecialchars($form->oralProposal); echo "</td>
        </tr>
        <tr>
          <th>Dissertation defense</th>
          <td>10 semesters</td>
          <td>12 semesters</td>
          <td>"; if($form->dissertationDefense != null) echo htmlspecialchars($form->dissertationDefense); echo "</td>
        </tr>
        <tr>
          <th>Final document</th>
          <td></td>
          <td></td>
          <td>"; if($form->finalDocument != null) echo htmlspecialchars($form->finalDocument); echo "</td>
        </tr>
      </table>
    ";

?>
