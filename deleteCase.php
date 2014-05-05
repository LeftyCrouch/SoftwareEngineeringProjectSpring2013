<?php
  // delete case from the database
  session_start();
  
  $caseID=$_SESSION['caseID'];
  $delete=$_POST['decision'];

  if($delete == 'Yes') {
    require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

    $dbh = ConnectDB();
   
    $query ="DELETE from Ordered WHERE DTID in (Select DTID from DiagnosticTool where CaseID = :caseID)";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam('caseID',$caseID);
    $stmt->execute();
    $stmt = null;
  
    $query ="DELETE from CaseFile WHERE CaseID = :caseID";
    $stmt = $dbh->prepare($query);
	$stmt->bindParam('caseID',$caseID);
    $stmt->execute();
    $stmt = null;
	
    $query ="DELETE from DiagnosticTool WHERE CaseID = :caseID";
    $stmt = $dbh->prepare($query);
	$stmt->bindParam('caseID',$caseID);
    $stmt->execute();
    $stmt = null;
	
	$query ="DELETE from GuidedFeedBack WHERE CaseID = :caseID";
    $stmt = $dbh->prepare($query);
	$stmt->bindParam('caseID',$caseID);
    $stmt->execute(); 
    $stmt = null;
 
    $_SESSION['changeResults']="Case Has Been Deleted";
  }  
  header("location:homePage.php");
?>