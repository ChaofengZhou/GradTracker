<?php

/**
 * Author: Chaofeng Zhou
 * Date: 2/3/2016
 *
 * Model for DGS
 *
 */

require_once 'Student/student.php';
require_once 'Advisor/advisor.php';

class DGS {

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
            SET approvedByDGS = '$uid_or_null', dgsApprovedDate = '$date'
          WHERE formId = '$formId'";
      } else {
        $query = "
          UPDATE Form
            SET approvedByDGS = null, dgsApprovedDate = null
          WHERE formId = '$formId'";
      }
      $stmt = $db->prepare($query);
      $stmt->execute();

      $message = $uid_or_null != null ? "You have successfully approved this form." : "You have successfully disapproved this form.";
      $form = get_form($formId);
      $student = get_student_by($form->uid);
      $currAdvisor = $student->get_advisor();
      require "DGS/progress_form_view.php";

      $this->send_email($post['advisorEmail'], 'advisor', $form);
      $this->send_email($post['dgsEmail'], 'DGS', $form);
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
    $approvedMes = $form->approvedByDGS != null ? "approved" : "disapproved";
    if ($role == 'advisor') {
      $mail->Subject = "The DGS has $approvedMes the form of {$student->firstName} {$student->lastName}.";
      $mail->Body = "Hi,\r\n\r\nThe DGS has {$approvedMes} 
        your student {$student->firstName} {$student->lastName}'s form.\r\n\r\nThanks,\r\n\r\nGrad Tracker of SoC";
    } else {
      $mail->Subject = "The DGS has $approvedMes the form of {$student->firstName} {$student->lastName}.";
      $mail->Body = "Hi,\r\n\r\nThe DGS has {$approvedMes} 
        student {$student->firstName} {$student->lastName}'s' form.\r\n\r\nThanks,\r\n\r\nGrad Tracker of SoC";
    }
    if (!$mail->send()) {
      return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      return 'Message has been sent';
    }
  }
}

function get_students_by_advisors() {
  $students_by_advisors = array();
  foreach(get_advisors() as $advisor) {
    $students_by_advisors[$advisor->uid] = $advisor->get_students();
  }
  return $students_by_advisors;
}

function recent_staff_approvals() {
  try {
    require 'DBConn/db_connect.php';

    $query = "
      SELECT * FROM Form F, User U
      WHERE F.uid = U.uid
      ORDER BY staffApprovedDate DESC";
    $stmt = $db->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Form');
    $stmt->execute();
    $forms = $stmt->fetchAll();

    return $forms;
  } catch (PDOException $ex) {
    echo "<pre>$ex</pre>";
  }
}

function fetch_data($chartOption, $yearOption) {
  try {
    // Connect to the database and select it.
    require_once 'DBConn/db_connect.php';

    if($chartOption == 1) {
      $query = "SELECT * FROM Student S, User U where S.uid = U.uid";
      $stmt = $db->prepare($query);
      $stmt->execute();

      $results = $stmt->fetchAll();
      $line_chart_data = new stdClass();
      $line_chart_data->name = [];
      $line_chart_data->data = [];

      for ($i = 0; $i < count($results); $i++)
      {
        $line_chart_data->name[] = $results[$i]['firstName']." ".$results[$i]['lastName'];
        $line_chart_data->data[] = 3.7;
      }
      echo json_encode($line_chart_data);

    } else if($chartOption == 2) {
      $query = "SELECT U.firstName, U.lastName, count(*) as numOfStud 
          FROM Advisor A Left outer join IsCommitteeOf C on A.username = C.advisorUsername, User U 
          where A.username = U.username group by A.username";
      $stmt = $db->prepare($query);
      $stmt->execute();

      $results = $stmt->fetchAll();
      $json  = array();
      $name = array('Form Completed', 'Form Imcompleted');

      for ($i = 0; $i < count($results)-5; $i++)
      {
        $jsonData = new stdClass();
        $jsonData->name = $name[$i];
        $jsonData->data = 4*$results[$i+2]['numOfStud']+8;
        $json[] = $jsonData;
      }

      echo json_encode($json);

    } else if($chartOption == 3) {
      $query = "SELECT U.firstName, U.lastName, count(*) as numOfStud 
          FROM Advisor A Left outer join Advises Advs on A.advisorID = Advs.advisorID, User U 
          where A.username = U.username group by A.username";
      $stmt = $db->prepare($query);
      $stmt->execute();

      $results = $stmt->fetchAll();
      $jsonData = new stdClass();
      $jsonData->name = [];
      $jsonData->data = [];

      for ($i = 0; $i < count($results); $i++)
      {
        $jsonData->name[] = $results[$i]['firstName']." ".$results[$i]['lastName'];
        $jsonData->data[] = $results[$i]['numOfStud'];
      }
      echo json_encode($jsonData);

    } else if($chartOption == 4) {
      $query = "SELECT U.firstName, U.lastName, count(*) as numOfStud 
          FROM Advisor A Left outer join IsCommitteeOf C on A.username = C.advisorUsername, User U 
          where A.username = U.username group by A.username";
      $stmt = $db->prepare($query);
      $stmt->execute();

      $results = $stmt->fetchAll();
      $jsonData = new stdClass();
      $jsonData->name = [];
      $jsonData->data = [];

      for ($i = 0; $i < count($results); $i++)
      {
        $jsonData->name[] = $results[$i]['firstName']." ".$results[$i]['lastName'];
        $jsonData->data[] = $results[$i]['numOfStud'];
      }
      echo json_encode($jsonData);

    } else if($chartOption == 5) {
      $query = "SELECT U.firstName, U.lastName, count(*) as numOfStud 
          FROM Advisor A Left outer join IsCommitteeOf C on A.username = C.advisorUsername, User U 
          where A.username = U.username group by A.username";
      $stmt = $db->prepare($query);
      $stmt->execute();

      $results = $stmt->fetchAll();
      $jsonData = new stdClass();
      $jsonData->name = [];
      $jsonData->data = [];

      for ($i = $yearOption-2009; $i < count($results)+5; $i++)
      {
        $jsonData->name[] = $yearOption;
        $jsonData->data[] = 4*$results[$i]['numOfStud']+8;
        break;
      }
      echo json_encode($jsonData);

    } else if($chartOption == 6) {
      $query = "SELECT U.firstName, U.lastName, count(*) as numOfStud 
          FROM Advisor A Left outer join IsCommitteeOf C on A.username = C.advisorUsername, User U 
          where A.username = U.username group by A.username";
      $stmt = $db->prepare($query);
      $stmt->execute();

      $results = $stmt->fetchAll();
      $json  = array();
      $name = array('A head of Schedule', 'On Schedule', 'Behind Schedule');

      for ($i = 0; $i < count($results)-4; $i++)
      {
        $jsonData = new stdClass();
        $jsonData->name = $name[$i];
        $jsonData->data = 4*$results[$i+2]['numOfStud']+8;
        $json[] = $jsonData; 
      }
      echo json_encode($json);
    }
  }
  catch (PDOException $ex)
  {
    "<p>Oops, DB error</p>
      <p> Code: {$ex->getCode()} </p>
      <pre>$ex</pre>";
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
