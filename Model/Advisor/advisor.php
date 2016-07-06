<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Model for Advisor
 *
 */

require_once 'Student/student.php';

class Advisor {

  public function update_profile($profile) {
    try {
      require 'DBConn/db_connect.php';

      $uid = $profile['uid'];
      $firstName = $profile['firstName'];
      $lastName = $profile['lastName'];
      $officeRoom = $profile['officeRoom'];
      $officePhone = $profile['officePhone'];

      $query = "
       UPDATE User U, Advisor A
        SET firstName = '$firstName', lastName = '$lastName',
          officeRoom='$officeRoom', officePhone='$officePhone'
       WHERE U.uid = '$uid' and U.uid = A.uid";
      $stmt = $db->prepare($query);
      $stmt->execute();

      $_SESSION['firstName'] = $firstName;
      $_SESSION['lastName'] = $lastName;

      header('Location: '.'mainpage.php');
    } catch (PDOException $ex) {
      echo "<pre>$ex</pre>";
    }
  }

  public function get_students() {
    try {
      require 'DBConn/db_connect.php';

      $query = "SELECT * From 
        User U, Student S, (SELECT * FROM Advises WHERE advisorID = '$this->uid') S1
        WHERE U.uid = S.uid and S.uid = S1.studentID";
      $stmt = $db->prepare($query);
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Student');
      $stmt->execute();
      $students = $stmt->fetchAll();
      return $students; 
    } catch (PDOException $ex) {
      echo "<pre>$ex</pre>";
    }
  }

  public function is_advisor_of($studentID) {
    try {
      require 'DBConn/db_connect.php';

      $query = "SELECT * FROM Advises WHERE advisorID = '$this->uid' AND studentID = '$studentID'";
      $stmt = $db->prepare($query);
      $stmt->execute();

      if ($row = $stmt->fetch()) {
        return true;
      }
      return false;
    } catch (PDOException $ex) {
      echo "<pre>$ex</pre>";
    }
  }

  public function save_comment($post) {
    try {
      require 'DBConn/db_connect.php';
      $formId = $post['formId'];
      $content = $post['comment'];

      date_default_timezone_set('America/Denver');
      $date = date("Y-m-d H:i:s");

      $query = "
        SELECT * FROM Comments where uid = '$this->uid' and formId = '$formId'";

      $stmt = $db->prepare($query);
      $stmt->execute();

      if ($stmt->fetch()) {
        $query = "
          UPDATE Comments
            SET content = '$content', date = '$date'
          WHERE uid = '$this->uid' and formId = '$formId'";
      } else {
        $query = "
          INSERT INTO Comments (uid, formId, content, date)
          VALUES ('$this->uid', '$formId', '$content', '$date')";
      }
      $stmt = $db->prepare($query);
      $stmt->execute();
      $message = null;
      $form = get_form($formId);
      $student = get_student_by($form->uid);
      $currAdvisor = $student->get_advisor();
      require "Advisor/progress_form_view.php";
    }
    catch ( PDOException $ex) {
      echo "<pre>$ex</pre>";
      // $error = "Approving the form failed. Please try again.";
      // require "Advisor/progress_form_view.php";
    }
  }

  public function approve_form($post) {
    try {
      require 'DBConn/db_connect.php';
      $formId = $post['formId'];
      $approve_or_not = $post['submitType'];

      date_default_timezone_set('America/Denver');
      $date = date("Y-m-d H:i:s");

      $query = null;
      if($approve_or_not != null) {
        $query = "
          UPDATE Form
            SET approvedByAdvisor = '$approve_or_not', advisorApprovedDate = '$date'
          WHERE formId = '$formId'";
      } else {
        $query = "
          UPDATE Form
            SET approvedByAdvisor = null, advisorApprovedDate = null
          WHERE formId = '$formId'";
      }
      $stmt = $db->prepare($query);
      $stmt->execute();

      $message = $approve_or_not != null ? "You have successfully approved this form." : "You have successfully disapproved this form.";
      $form = get_form($formId);
      $student = get_student_by($form->uid);
      $currAdvisor = $student->get_advisor();
      require "Advisor/progress_form_view.php";

      $this->send_email($post['studentEmail'], 'student', $form);
      $this->send_email($post['staffEmail'], 'staff', $form);
    }
    catch ( PDOException $ex) {
      echo "<pre>$ex</pre>";
      $error = $message = "Approving the form failed. Please try again.";
      require "Advisor/progress_form_view.php";
    }
  }

  private function send_email($to, $role, $form) {
    $mail = new PHPMailer;
    $mail->isSMTP();

    $from = "admin@uchaofz.me";
    $mail->Host = 'chaofz.localdomain';

    $mail->Port = 25;
    $mail->setFrom($from, 'Grad Tracker');
    $mail->addAddress($to);

    $student = get_student_by($form->uid);
    $approvedMes = $form->approvedByAdvisor != null ? "approved" : "disapproved";
    if ($role == 'student') {
      $mail->Subject = "Your progress form has been {$approvedMes} by the advisor";
      $mail->Body = "Hi,\r\n\r\nYour advisor Dr. {$this->firstName} {$this->lastName} 
        has {$approvedMes} your student form.\r\n\r\nThanks,\r\n\r\nGrad Tracker of SoC";
    } else {
      $mail->Subject = "Student {$student->firstName} {$student->lastName}'s form has been {$approvedMes} by Dr. {$this->lastName}";
      $mail->Body = "Hi,\r\n\r\nFaculty Dr. {$this->firstName} {$this->lastName} has {$approvedMes} 
        student {$student->firstName} {$student->lastName}'s' form.\r\n\r\nThanks,\r\n\r\nGrad Tracker of SoC";
    }
    if (!$mail->send()) {
      return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      return 'Message has been sent';
    }
  }
}

function get_advisor_by($uid) {
  try {
    require 'DBConn/db_connect.php';

    $query = "SELECT * FROM Advisor A, User U WHERE U.uid = '$uid' and U.uid = A.uid";
    $stmt = $db->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Advisor');
    $stmt->execute();
    $advisor = $stmt->fetch();
    return $advisor; 
  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
  }
}

function recent_submmited_forms() {
  try {
    require 'DBConn/db_connect.php';

    $query = "
      SELECT * FROM Form F, User U
      WHERE F.uid = U.uid and F.submitted = '1'
      ORDER BY modifiedDate DESC";
    $stmt = $db->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Form');
    $stmt->execute();
    $forms = $stmt->fetchAll();

    return $forms;
  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
  }
}

function get_advisors() {
  try {
    require 'DBConn/db_connect.php';

    $query = "SELECT * From User U, Advisor A WHERE U.uid = A.uid";
    $stmt = $db->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Advisor');
    $stmt->execute();
    $advisors = $stmt->fetchAll();
    return $advisors;
  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
  }
}

?>
