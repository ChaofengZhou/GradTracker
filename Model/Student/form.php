<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Model for progress form
 *⁄€
 */

require_once 'Student/student.php';

class Form {

  public function get_owner_student() {
    return get_student_by($this->uid);
  }
}

function get_form($formId) {
  try {
    require 'DBConn/db_connect.php';

    $query = "
      SELECT * FROM Form WHERE formId = '$formId'";
    $stmt = $db->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Form');
    $stmt->execute();
    $form = $stmt->fetch();
    return $form; 
  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
  }
}

function write_form($post, $isNewForm) {
  try {
    require 'DBConn/db_connect.php';

    $uid = $post["uid"];
    $numOfSemesters = $post["numOfSemesters"];
    // $advisor = $post["advisorID"];
    // $committee = $post["advisor"];
    $identifyAdvisor = $post["identifyAdvisor"];
    $programApprovedInitial = $post["programApprovedInitial"];
    $teachingMentorship = $post["teachingMentorship"];
    $completeRequiredCourse = $post["completeRequiredCourse"];
    $committeeFormed = $post["committeeFormed"];
    $programApproved = $post["programApproved"];
    $writtenQualifier = $post["writtenQualifier"];
    $oralProposal = $post["oralProposal"];
    $dissertationDefense = $post["dissertationDefense"];
    $finalDocument = $post["finalDocument"];
    $progressDescription = $post["progressDescription"];
    $submitted = $post['submitType'];

    date_default_timezone_set('America/Denver');
    $modifiedDate = date("Y-m-d H:i:s");

    $form = null;
    if($isNewForm == "new") {
      $createdDate = $modifiedDate;
      $query = "
       INSERT INTO Form (uid, createdDate, modifiedDate, numOfSemesters, identifyAdvisor, 
        programApprovedInitial, teachingMentorship, completeRequiredCourse, committeeFormed, 
        programApproved, writtenQualifier, oralProposal, dissertationDefense, finalDocument, 
        progressDescription, submitted)
       VALUES ('$uid', '$createdDate', '$modifiedDate', '$numOfSemesters', '$identifyAdvisor', 
        '$programApprovedInitial', '$teachingMentorship', '$completeRequiredCourse', '$committeeFormed', 
        '$programApproved', '$writtenQualifier', '$oralProposal', '$dissertationDefense', '$finalDocument', 
        '$progressDescription', '$submitted')";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $form = get_form($db->lastInsertId());
    } else {
      $formId = $post["formId"];
      $query = "
       UPDATE Form 
       SET modifiedDate = '$modifiedDate', numOfSemesters = '$numOfSemesters', identifyAdvisor = '$identifyAdvisor', 
        programApprovedInitial = '$programApprovedInitial', teachingMentorship = '$teachingMentorship', 
        completeRequiredCourse = '$completeRequiredCourse', committeeFormed = '$committeeFormed', 
        programApproved = '$programApproved', writtenQualifier = '$writtenQualifier', oralProposal = '$oralProposal', 
        dissertationDefense = '$dissertationDefense', finalDocument = '$dissertationDefense', progressDescription = '$progressDescription',
        submitted = '$submitted'
       WHERE formId = '$formId'";
       $stmt = $db->prepare($query);
      $stmt->execute();
      $form = get_form($formId);
    }
    $message = $submitted == 1 ? "You have successfully submitted this form." : "You have successfully saved this form.";
    $student = get_student_by($uid);
    $currAdvisor = $student->get_advisor();
    require "Student/progress_form_view.php";
    
    if($submitted == 1) {
      $student->send_email("student", $post["studentEmail"]);
      $student->send_email("advisor", $post["advisorEmail"]);
    }
  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
    $error = $message = "Creating a form failed. Please try again.";
    $student = new Student($_SESSION["uid"]);
    if($isNewForm == "new") {
      require "Student/new_form_view.php";
    } else {
      $form = get_form($post["formId"]);
      require "Student/progress_form_view.php";
    }
  }
}

?>
