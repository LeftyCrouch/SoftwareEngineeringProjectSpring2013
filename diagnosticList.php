<?php
  //make a list of the different tools for the case selected
  session_start();
  $caseID = $_SESSION['caseID'];

  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

  $dbh = ConnectDB();

  $query = "SELECT Category, DTID FROM DiagnosticTool WHERE CaseID = :caseID";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam('caseID', $caseID);
  $stmt->execute();
  $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
		
  $stmt = null;

  foreach ( $categoryData as $category ) {
    echo "<li><a href='http://elvis.rowan.edu/~crouch59/swe/diagnosticTools.php?toolID=".urlencode($category->DTID)."'>$category->Category</a></li>";
  }
?>