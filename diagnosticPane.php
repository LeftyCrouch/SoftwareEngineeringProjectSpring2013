<?php
  // display the information about a tool
  session_start();
  $email = $_SESSION['email'];
  $DTID = $_GET['toolID'];
  $_SESSION['toolID'] = $DTID;
  $imgPath = $_SESSION['imagePath'];
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

  $dbh = ConnectDB();

  $query = "SELECT Description, Timer, ImagePath, DiagnosticEvaluation, Category FROM DiagnosticTool WHERE DTID = :DTID";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam('DTID',$DTID);
  $stmt->execute();
  $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);		
  
  $stmt = null;

  foreach ( $categoryData as $title ) 
  {
	$query = "SELECT TimeSet FROM Ordered WHERE Email = :email and DTID = :DTID";
	$stmt = $dbh->prepare($query);
	$stmt->bindParam('email',$email);
	$stmt->bindParam('DTID',$DTID);
	$stmt->execute();
	$OrderedData = $stmt->fetch();		
	$stmt = null;
	$currentDate = time();

	if(isset($OrderedData[0]))
	{
	  if((($OrderedData[0] + ($title->Timer)) <= $currentDate) or ($_SESSION['userType'] == 'Admin'))
	  {
	    //Ordered and ready to be viewed
		echo "<li class=\"questionPadding\">$title->Description</li>
				  <li class=\"questionPadding\"><div class=\"bold\">The results are:</div>$title->DiagnosticEvaluation</li>";
		if($imgPath != NULL) {
	    echo "<a href=\"http://elvis.rowan.edu/~crouch59/swe/pdf/$imgPath\" target='_blank'><img src=\"pdf/$imgPath\" width=\"450\" height=\"450\"/></a>";
		}
	  }
	  else {
		//Ordered, but not ready to be veiwed
		$timeRemaining = round(((($OrderedData[0] + $title->Timer) - $currentDate)/60), 2);
			
			
		echo "<li class=\"questionPadding\">$title->Description</li>";
		echo "<li><button class=\"btn\" disabled=\"disabled\">Tool Ordered</button> </li>"; 
		echo "<li>Will be ready: $timeRemaining minutes</li>";
	  }	 
	}
	else {	
	  //Not Ordered yet
	  $timerInMinutes = ($title->Timer/60);
	  echo "<li class=\"questionPadding\">$title->Description</li>";
		
	  echo "<form name=\"order\" method=\"post\" action=\"orderATest.php\">";
	  echo "<button class=\"btn\" type=\"submit\" value=\"order\">Order Tool</button> </form>";
		
	  echo "<li><div class=\"\">Time for completion: $timerInMinutes minutes</li> </div>";
	}	 
  }
?>