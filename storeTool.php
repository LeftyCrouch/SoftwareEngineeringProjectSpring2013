<?php
  //add or remove a tool
  session_start();
  $caseID = $_SESSION['caseID'];
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  $dbh = ConnectDB();
  
  $remove = $_GET['remove'];
  $category = $_GET['category'];
  $DTID = $_GET['DTID'];
  $imgPath = $_GET['imagePath'];
  
  if($_POST['button'] == 'finish') {
    header("location:homePage.php");
  }
  
  //remove a tool
  if($remove == 'yes') {
	
	echo "<h4>Removing \"$category\" from the Case.</h4>";
  
    try {

        $query = 'DELETE FROM DiagnosticTool WHERE CaseID = :caseID
		         AND DTID = :DTID';
	    $stmt = $dbh->prepare($query);

	    // Note each parameter must be bound separately
	    $stmt->bindParam(':caseID', $caseID);
		$stmt->bindParam(':DTID', $DTID);

	    $stmt->execute();
	    $inserted = $stmt->rowCount();
	    $stmt = null;
    
        //echo "<h4>inserted $inserted Question.</h4>";

      } 
      catch(PDOException $e)
      {
        die ('PDO error inserting(): ' . $e->getMessage() );
      }
  }
    

  
  
  
  
  
  
  
  
  
  
  		//storing image
  $imagePath = null;
  $imgExts = array("jpg","png","gif","bmp","psd", "jpeg");
  $imgextension = end(explode(".", $_FILES["image"]["name"]));
  
  
  
  
  
  
  // was a tool completely filled out
  if ( isset($_POST['category'])   &&  !empty($_POST['category'])   &&
       isset($_POST['description'])  && !empty($_POST['description']) &&
	   isset($_POST['diagnosticEvaluation'])  && !empty($_POST['diagnosticEvaluation']) &&
	   isset($_POST['timer'])  && !empty($_POST['timer'])) {
  
    //store the image 
	if  (
	     (
	      ($_FILES["image"]["type"] == "image/jpg") ||
	      ($_FILES["image"]["type"] == "image/png") ||
		  ($_FILES["image"]["type"] == "image/gif") ||
		  ($_FILES["image"]["type"] == "image/bmp") ||
		  ($_FILES["image"]["type"] == "image/psd") ||
          ($_FILES["image"]["type"] == "image/jpeg") 
		 )&& in_array($imgextension, $imgExts)
		)
	    {
      if ($_FILES["image"]["error"] > 0) {
      }
      else {
        if (file_exists($_FILES["image"]["name"])) {
        }
        else {
          move_uploaded_file($_FILES["image"]["tmp_name"],
                             "/export/home/crouch59/public_html/swe/pdf/".$_FILES["image"]["name"]);
          $imgPath = $_FILES["image"]["name"];
	      $_SESSION["imgPath"] = $imgPath;
	    }
      }
    }
    else {
      echo "Invalid file";
      echo $imgextension;
      echo "size: ". $_FILES["image"]["size"]."";
      echo "type: ". $_FILES["image"]["type"]. "";
    }
  
    
  
  
  
  
  
  
  
      echo "<h4>Adding \"" . $_POST['category'] . "\" type of tool to Case.</h4>";
  
      $category = $_POST['category'];
      $description = $_POST['description'];
	  $diagnosticEvaluation = $_POST['diagnosticEvaluation'];
	  $timer = $_POST['timer']*60;
	  
      try {

        $query = 'INSERT INTO DiagnosticTool (DTID, Description, Timer, ImagePath, DiagnosticEvaluation, CaseID, Category)
			     VALUES ("", :description, :timer, :imgPath, :diagnosticEvaluation, :caseID, :category)';
	    $stmt = $dbh->prepare($query);

	    // Note each parameter must be bound separately
	    $stmt->bindParam(':description', $description);
	    $stmt->bindParam(':timer', $timer);
		$stmt->bindParam(':imgPath',$imgPath);
		$stmt->bindParam(':diagnosticEvaluation',$diagnosticEvaluation);
	    $stmt->bindParam(':caseID', $caseID);
		$stmt->bindParam(':category',$category);

	    $stmt->execute();
	    $inserted = $stmt->rowCount();
	    $stmt = null;
    
        if($edit == 'yes') {
			$success == 'yes';
	    }

      } 
      catch(PDOException $e)
      {
        die ('PDO error inserting(): ' . $e->getMessage() );
      }
  }
  else {
    if($_SESSION['redirect'] == 'yes') {
	  echo "Tool Modified.";
	  $_SESSION['redirect'] = 'no';
	}
	else {
	  if($remove = 'yes') {
	  }
      else {
	    echo "<h4>All fields must be filled in</h4>";
	  }
	}
  }
 
 
 try {
        // set up query
        $student_query = "SELECT * FROM DiagnosticTool WHERE CaseID = :caseID";
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
	
	
  if($success == 'yes') {
	header("location:addTools.php");
  }
	
	
echo "<h4>Here is a list of the Tool(s) in the Case now:</h4>";
$counter = 0;
//echo "<ul>";
foreach ( $studentdata as $number ) {
    $counter++;
	$minutes = ($number->Timer)/60;
    echo "    <li class=\"questionListing\"> ".urldecode($number->Category)." with Timer: $minutes minutes ";
    echo "<a href='./addTools.php?category=".urlencode($number->Category)."&amp;DTID=$number->DTID&amp;remove=yes'>";
    echo "remove</a> ";
    echo "                       ";
    echo "</li>";
	
	
	
    // modification: add delete link
}
//echo "</ul>";

echo "<h4> $counter Tool(s) in case.</h4>";

// uncomment next line for debugging
# echo '<pre>'; print_r($namelist); echo '</pre>';



?>