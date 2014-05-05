<?php
    // Make sure an ID was passed
   
     
/*      
       
          session_start();
  $caseID = $_SESSION['caseID'];
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

  $dbh = ConnectDB();

  $query = "SELECT PDFPath FROM CaseFile WHERE CaseId= :caseID";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam('caseID',$caseID);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
			
  $stmt = null;
  */      


	
  $file = 'export/home/~crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/PDF/.UPDATED/archive/ALG Case 7 Marfan syndrome facilitatorsrevised.pdf';
  $filename = 'facilitator.pdf'; /* Note: Always use .pdf at the end. */

  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Content-Length: ' . filesize($file));
  header('Accept-Ranges: bytes');

  @readfile($file);
?>