<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Model for students. Forms are exsiting as student's property
 *
 */
require_once 'form.php';
require_once 'Advisor/advisor.php';
require_once '../../Assets/lib/class.phpmailer.php';
require_once '../../Assets/lib/class.smtp.php';

class Student {

  public function update_profile($profile) {
    try {
      require 'DBConn/db_connect.php';
      $uid = $profile['uid'];
      $firstName = $profile['firstName'];
      $lastName = $profile['lastName'];
      $degree = $profile['degree'];
      $track = $profile['track'];
      $semesterAdmitted = $profile['semesterAdmitted'];

      $query = "
       UPDATE User U, Student S
        SET firstName = '$firstName', lastName = '$lastName', semesterAdmitted='$semesterAdmitted', 
        degree='$degree', track='$track'
       WHERE U.uid = '$uid' and U.uid = S.uid";
      $stmt = $db->prepare($query);
      $stmt->execute();

      if($profile['advisor'] != null) {
        $this->update_advisor($profile['advisor']);
      }

      $_SESSION['firstName'] = $firstName;
      $_SESSION['lastName'] = $lastName;
      
      header('Location: '.'mainpage.php');
    } catch (PDOException $ex) {
      echo "<pre>$ex</pre>";
    }
  }

  private function update_advisor($uid) {
    try {
      require 'DBConn/db_connect.php';
      $query = null;
      if($this->get_advisor() == null) {
        $query = "INSERT Advises (advisorID, studentID) VALUE('$uid', '$this->uid')";
      } else {
        $query = "UPDATE Advises SET advisorID = '$uid' WHERE studentID = '$this->uid'";
      }
      $stmt = $db->prepare($query);
      $stmt->execute();
      echo $uid;
    } catch (PDOException $ex) {
      echo "<pre>$ex</pre>";
    }
  }

  public function get_forms() {
    try {
      require 'DBConn/db_connect.php';

      $query = "
        SELECT * FROM Form F1
        WHERE F1.uid = '$this->uid' AND F1.modifiedDate = (
          SELECT max(F2.modifiedDate) FROM Form F2
          WHERE F1.uid = F2.uid AND F2.createdDate = F1.createdDate
          GROUP BY F2.createdDate)
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

  public function get_advisor() {
    try {
      require 'DBConn/db_connect.php';

      $query = "SELECT advisorID FROM Advises WHERE studentID = '$this->uid'";
      $stmt = $db->prepare($query);
      $stmt->execute();

      if ($row = $stmt->fetch()) {
        return get_advisor_by($row['advisorID']);
      }
      return null;
    } catch (PDOException $ex) {
      echo "<pre>$ex</pre>";
    }
  }

  public function send_email($role, $to) {
    $mail = new PHPMailer;
    $mail->isSMTP();

    $from = "admin@chaofz.com";
    $mail->Host = 'chaofz.localdomain';

    $mail->Port = 25;
    $mail->setFrom($from, 'Grad Tracker');
    $mail->addAddress($to);
    if ($role == 'student') {
      $mail->Subject = "You have submmitted a progress form";
      $mail->Body    = "Hi,\r\n\rJust to confirm that you have submitted a progress form to your advisor.\r\n\r\nThanks,\r\n\r\nGrad Tracker of SoC";
    } else {
      $mail->Subject = "Your student {$this->firstName} {$this->lastName} has submmitted a progress form";
      $mail->Body    = "Hi,\r\n\r\nYour student {$this->firstName} {$this->lastName} has submitted a progress form.\r\n\r\nThanks,\r\n\r\nGrad Tracker of SoC";
    }

    if (!$mail->send()) {
      return 'Mailer Error: ' . $mail->ErrorInfo.'</br>';
    } else {
      return 'Message has been sent';
    }
  }
}

function get_student_by($uid) {
  try {
    require 'DBConn/db_connect.php';

    $query = "
      SELECT * FROM Student S, User U WHERE S.uid = '$uid' and S.uid = U.uid";
    $stmt = $db->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Student');
    $stmt->execute();
    $student = $stmt->fetch();
    return $student; 

  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
  }
}

?>
