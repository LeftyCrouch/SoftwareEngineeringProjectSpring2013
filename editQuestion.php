<?php
  //edit a question in the database
  session_start();
  
  $caseID = $_SESSION['caseID'];
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

  $dbh = ConnectDB();
  
  if($_POST['button'] == 'next') {
    header("location:addTools.php");
  }
  else if ( isset($_POST['question'])   &&  !empty($_POST['question'])   &&
            isset($_POST['answer'])  && !empty($_POST['answer'])) {
  
         echo "<h4>Editing \"" . $_POST['question'] . "\" to Case.</h4>";
  
         $GFID = $_POST['GFID'];
         $question = $_POST['question'];
         $answer = $_POST['answer'];
         try {

           $query = 'UPDATE GuidedFeedBack SET Question = :question, Answer = :answer
			        WHERE GFID = :GFID';
	       $stmt = $dbh->prepare($query);

	       // Note each parameter must be bound separately
	       $stmt->bindParam(':question', $question);
	       $stmt->bindParam(':answer', $answer);
	       $stmt->bindParam(':GFID', $GFID);

	       $stmt->execute();
	       $inserted = $stmt->rowCount();
	       $stmt = null;
    
		   $_SESSION['redirect'] = 'yes';
		   $redirect = $_SESSION['redirect'];

         } 
         catch(PDOException $e)
         {
           die ('PDO error inserting(): ' . $e->getMessage() );
         }
  }
  else {
    echo "<h4>All fields must be filled in</h4>";
  }
 
  if($redirect == 'yes') {
	header("location: addQuestions.php");
  }
 
  try {
    // set up query
    $student_query = "SELECT * FROM GuidedFeedBack WHERE CaseID = :caseID";
    // prepare to execute (this is a security precaution)
    $stmt = $dbh->prepare($student_query);
		
	$stmt->bindParam(':caseID', $caseID);
    // run query
    $stmt->execute();
    // get all the results from database into array of objects
    $studentdata = $stmt->fetchAll(PDO::FETCH_OBJ);
    // release the statement
    $stmt = null;
  }
  catch(PDOException $e)
  {
    die ('PDO error in ListAllStudents()": ' . $e->getMessage() );
  }
	

  echo "<h4>Here is a list of the Question(s) in the Case now:</h4>";
  $counter = 0;
  
  foreach ( $studentdata as $number ) {
    $counter++;
    echo "    <li class=\"questionListing\"> ".urldecode($number->Question)." ";
    echo "<a href='./addQuestions.php?question=".urlencode($number->Question)."&amp;GFID=$number->GFID&amp;remove=yes'>";
    echo "remove</a> | ";
    echo "                       ";
    echo "<a href='./modifyQuestions.php?question=".urlencode($number->Question)."&amp;answer=".urlencode($number->Answer)."&amp;GFID=$number->GFID'>";
    echo "edit</a>";
    echo "</li>";
  }

  echo "<h4> $counter Question(s) in case.</h4>";
?>