<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Model for Advisor
 *
 */

require_once 'Student/student.php';
require_once 'Advisor/advisor.php';

class Staff {

  public function update_profile($profile) {
    try {
      require 'DBConn/db_connect.php';

      $uid = $profile['uid'];
      $firstName = $profile['firstName'];
      $lastName = $profile['lastName'];
      $officeRoom = $profile['officeRoom'];
      $officePhone = $profile['officePhone'];

      $query = "
       UPDATE User U, Staff S
        SET firstName = '$firstName', lastName = '$lastName',
          officeRoom='$officeRoom', officePhone='$officePhone'
       WHERE U.uid = '$uid' and U.uid = S.uid";
      $stmt = $db->prepare($query);
      $stmt->execute();

      $_SESSION['firstName'] = $firstName;
      $_SESSION['lastName'] = $lastName;

      header('Location: '.'mainpage.php');
    } catch (PDOException $ex) {
      echo "<pre>$ex</pre>";
    }
  }

  public function approve_form($post) {
    try {
      require 'DBConn/db_connect.php';
      $formId = $post['formId'];
      $uid_or_null = $post['submitType'];

      date_default_timezone_set('America/Denver');
      $date = date("Y-m-d H:i:s");

      $query = null;
      if($uid_or_null != null) {
        $query = "
          UPDATE Form
            SET approvedByStaff = '$uid_or_null', staffApprovedDate = '$date'
          WHERE formId = '$formId'";
      } else {
        $query = "
          UPDATE Form
            SET approvedByStaff = null, staffApprovedDate = null
          WHERE formId = '$formId'";
      }
      $stmt = $db->prepare($query);
      $stmt->execute();

      $message = $uid_or_null != null ? "You have successfully approved this form." : "You have successfully disapproved this form.";
      $form = get_form($formId);
      $student = get_student_by($form->uid);
      $currAdvisor = $student->get_advisor();
      require "Staff/progress_form_view.php";

      $this->send_email($post['advisorEmail'], 'advisor', $form);
      $this->send_email($post['dgsEmail'], 'DGS', $form);
    }
    catch ( PDOException $ex) {
      echo "<pre>$ex</pre>";
      // $error = "Approving the form failed. Please try again.";
      // require "Advisor/progress_form_view.php";
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
    $approvedMes = $form->approvedByStaff != null ? "approved" : "disapproved";
    if ($role == 'advisor') {
      $mail->Subject = "Staff {this->firstName} has $approvedMes the form of {$student->firstName} {$student->lastName}.";
      $mail->Body = "Hi,\r\n\r\nStaff {$this->firstName} {$this->lastName} 
        has {$approvedMes} your student {$student->firstName} {$student->lastName}'s form.\r\n\r\nThanks,\r\n\r\nGrad Tracker of SoC";
    } else {
      $mail->Subject = "Staff {this->firstName} has $approvedMes the form of {$student->firstName} {$student->lastName}.";
      $mail->Body = "Hi,\r\n\r\nStaff {$this->firstName} {$this->lastName} has {$approvedMes} 
        student {$student->firstName} {$student->lastName}'s' form.\r\n\r\nThanks,\r\n\r\nGrad Tracker of SoC";
    }
    if (!$mail->send()) {
      return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      return 'Message has been sent';
    }
  }
}

function get_staff_by($uid) {
  try {
    require 'DBConn/db_connect.php';

    $query = "SELECT * FROM Staff S, User U WHERE U.uid = '$uid' and U.uid = S.uid";
    $stmt = $db->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Staff');
    $stmt->execute();
    $staff = $stmt->fetch();
    return $staff; 
  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
  }
}

function get_students_by_advisors() {
  $students_by_advisors = array();
  foreach(get_advisors() as $advisor) {
    $students_by_advisors[$advisor->uid] = $advisor->get_students();
  }
  return $students_by_advisors;
}

function recent_advisor_approvals() {
  try {
    require 'DBConn/db_connect.php';

    $query = "
      SELECT * FROM Form F, User U
      WHERE F.uid = U.uid
      ORDER BY advisorApprovedDate DESC";
    $stmt = $db->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Form');
    $stmt->execute();
    $forms = $stmt->fetchAll();

    return $forms;
  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
  }
}

// function get_advisors() {
//   try {
//     require 'DBConn/db_connect.php';

//     $query = "SELECT * From User U, Advisor A WHERE U.uid = A.uid";
//     $stmt = $db->prepare($query);
//     $stmt->setFetchMode(PDO::FETCH_CLASS, 'Advisor');
//     $stmt->execute();
//     $advisors = $stmt->fetchAll();
//     return $advisors;
//   } catch (PDOException $ex) {
//     echo "<pre>$ex</pre>";
//   }
// }

?>
