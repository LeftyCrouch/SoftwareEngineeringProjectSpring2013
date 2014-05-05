<?php
  session_start();
  $caseID = $_SESSION['caseID'];
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  $dbh = ConnectDB();
  
  //setup for image
  $imagePath = null;
  $imgExts = array("jpg","png","gif","bmp","psd", "jpeg");
  $imgextension = end(explode(".", $_FILES["image"]["name"]));
    
  if($_POST['button'] == 'finish') {
    header("location:homePage.php");
  }
  // was a tool completely filled out
  else if ( isset($_POST['category'])   &&  !empty($_POST['category'])   &&
       isset($_POST['description'])  && !empty($_POST['description']) &&
	   isset($_POST['diagnosticEvaluation'])  && !empty($_POST['diagnosticEvaluation']) &&
	   isset($_POST['timer'])  && !empty($_POST['timer'])) {
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
	  
      //editing tool to database
      echo "<h4>Editing \"" . $_POST['category'] . "\" type of tool to Case.</h4>";
  
      $DTID = $_POST['DTID'];
	  $category = $_POST['category'];
      $description = $_POST['description'];
      $diagnosticEvaluation = $_POST['diagnosticEvaluation'];
	  $timer = $POST['timer']*60;
	  
	  if(!isset($imgPath)) {
        $query = "UPDATE DiagnosticTool SET Category = :category, Description = :description,
		         DiagnosticEvaluation = :diagnosticEvaluation, Timer = :timer WHERE DTID = :DTID";
	  }
      else if(isset($imgPath)) {
        $query = "UPDATE DiagnosticTool SET Category = :category, Description = :description,
		         DiagnosticEvaluation = :diagnosticEvaluation, Timer = :timer, ImagePath = :imgPath WHERE DTID = :DTID";
      }				 
	    

	  $stmt = $dbh->prepare($query);
	  // Note each parameter must be bound separately
	  $stmt->bindParam(':category', $category);
	  $stmt->bindParam(':description', $description);
	  $stmt->bindParam(':diagnosticEvaluation', $diagnosticEvaluation);
      $stmt->bindParam(':timer', $timer);
      $stmt->bindParam(':DTID', $DTID);
	  if(isset($imgPath)) {
	    $stmt->bindParam(':imgPath', $imgPath);
	  }
	  $stmt->execute();
	  $inserted = $stmt->rowCount();
	  $stmt = null;
    
      $_SESSION['redirect'] = 'yes';
	  $redirect = $_SESSION['redirect'];
  }	
  else {
    echo "<h4>All fields must be filled in</h4>";
	echo "cat:	".$_POST['category']."";
	echo "des:	".$_POST['description']."";
	echo "dia:	".$_POST['diagnosticEvaluation']."";
	echo "DTI:	".$_POST['DTID']."";
	echo "tim:	".$_POST['timer']."";
  }
 
 
  if($redirect == 'yes') {
	header("location: addTools.php");
  }
 
  try{
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
	
	
	
	
	
echo "<h4>Here is a list of the Tool(s) in the Case now:</h4>";
$counter = 0;
//echo "<ul>";
foreach ( $studentdata as $number ) {
    $counter++;
	$minutes = ($number->Timer)/60;
    echo "    <li class=\"questionListing\"> ".urldecode($number->Category)." with Timer: $minutes minutes ";
    echo "<a href='./addTools.php?category=".urlencode($number->Category)."&amp;DTID=$number->DTID&amp;remove=yes'>";
    echo "remove</a> | ";
    echo "                       ";
    echo "<a href='./modifyTools.php?category=".urlencode($number->Category)."&amp;description=".urlencode($number->Description)."&amp;diagnosticEvaluation=".urlencode($number->DiagnosticEvaluation)."&amp;timer=$number->Timer&amp;DTID=$number->DTID&amp;edit=yes'>";
    echo "edit</a>";
    echo "</li>";
	
	
	
    // modification: add delete link
}
//echo "</ul>";

echo "<h4> $counter Tool(s) in case.</h4>";

// uncomment next line for debugging
# echo '<pre>'; print_r($namelist); echo '</pre>';



?>