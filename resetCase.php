<?php
  // reset the diagnostic tools of a case
  session_start();
  $email = $_SESSION['email'];
  $caseID = $_SESSION['caseID'];
  
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

  $dbh = ConnectDB();
  
  $query ="DELETE from Ordered WHERE Email = :email and DTID in 
          (Select DTID from DiagnosticTool where CaseID = :caseID)";
  
  $stmt = $dbh->prepare($query);
  $stmt->bindParam('email',$email);
  $stmt->bindParam('caseID',$caseID);
  $stmt->execute();
  
  $stmt = null;
  
  $_SESSION['changeResults']="Case Has Been Reset";
  header("location:homePage.php");
?>