<?php
  //retrieve questions and answers for a specific case
  session_start();
  $caseID = $_SESSION['caseID'];
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

  $dbh = ConnectDB();

  $query = "SELECT Question, Answer FROM GuidedFeedBack WHERE CaseId= :caseID";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam('caseID',$caseID);
  $stmt->execute();
  $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
			
  $stmt = null;
  $count = 0;
  
  foreach ( $categoryData as $title ) {
    $count++;
    echo "<li class=\"questionPadding\"><div class=\"bold\">Question:</div> $title->Question</li>
		  <li><div align=\"left\" id='div$count' style='display:none'><div class=\"bold\">Answer:</div> ".nl2br($title->Answer)."</div>
		  <button class=\"btn\" onclick=\"toggle($count)\">Show/Hide Answer</button>
	      </li>";
  }
?>