<?php
  #author: Michael Bevilacqua
  #modified from www.WS3 School

  session_start();
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  $dbh = ConnectDB();

  $PDFPath = null;
  $imagePath = null;
  $imgExts = array("jpg","png","gif","bmp","psd", "jpeg");
  $pdfExts = array("pdf");
  $pdfextension = end(explode(".", $_FILES["pdffile"]["name"]));
  $imgextension = end(explode(".", $_FILES["image"]["name"]));
  
  //storing pdf
  if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['description']) && !empty($_POST['description']) && 
     isset($_POST['category']) && !empty($_POST['category'])) {
    if ((($_FILES["pdffile"]["type"] == "application/pdf")
          && in_array($pdfextension, $pdfExts))) {
      if ($_FILES["pdffile"]["error"] > 0) {
      }
      else {
        if (file_exists("pdf/" . $_FILES["pdffile"]["name"])) {
        }
        else {
          move_uploaded_file($_FILES["pdffile"]["tmp_name"],
                             "/export/home/crouch59/public_html/swe/pdf/".$_FILES["pdffile"]["name"]);
          $PDFPath = "pdf/".$_FILES["pdffile"]["name"];
	      $_SESSION["pdfPath"] = $PDFPath;
	    }
      }
    }
    else {
      echo "Invalid file";
      echo $pdfextension;
      echo "size: ". $_FILES["pdffile"]["size"]."";
      echo "type: ". $_FILES["pdffile"]["type"]. "";
    }
	//end storing pdf
	
	//storing image
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
	
  
    #end storing the pdf and img file on the server
  
    $title=$_POST['title'];
    $description=$_POST['description'];
    $category=$_POST['category'];
    $CaseID = $_SESSION['caseID'];
  
	  
    if(isset($_POST["edit"])) {
      if(!isset($PDFPath) && !isset($imgPath)) {
	    $query = "UPDATE CaseFile SET Title = :title, Description = :description, Category = :category
	             where CaseID = :CaseID";
      }
	  else if(isset($PDFPath) && !isset($imgPath)){
        $query = "UPDATE CaseFile SET Title = :title, Description = :description, Category = :category, PDFPath = :PDFPath
	             where CaseID = :CaseID";
	  }
	  else if(isset($imgPath) && !isset($PDFPath)){
	  
	  $query = "UPDATE CaseFile SET Title = :title, Description = :description, Category = :category, ImagePath = :imgPath
	             where CaseID = :CaseID";
	  }
	  else if(isset($imgPath) && isset($PDFPath)){
	  
	  $query = "UPDATE CaseFile SET Title = :title, Description = :description, Category = :category, PDFPath = :PDFPath, ImagePath = :imgPath
	             where CaseID = :CaseID"; 
	  }
	  
	  $stmt = $dbh->prepare($query);
	  $stmt->bindParam(':CaseID',$CaseID);
	  $stmt->bindParam(':title',$title);
	  $stmt->bindParam(':description',$description);
	  $stmt->bindParam(':category',$category);
	  if(isset($PDFPath)) {
	    $stmt->bindParam(':PDFPath',$PDFPath);
	  }
	  if(isset($imgPath)) {
	    $stmt->bindParam(':imgPath',$imgPath);
	  }	  
      $stmt->execute();
	  $stmt = null;
	
	  $_SESSION['changeResults'] = "Case Modified";
    }
    //add a new case
    else {
	  $query = 'INSERT INTO CaseFile (Title, Description, Category, PDFPath, ImagePath)
	           VALUES(:title, :description, :category, :PDFPath, :imgPath)';
	  $stmt = $dbh->prepare($query);
	  $stmt->bindParam(':title',$title);
	  $stmt->bindParam(':description',$description);
	  $stmt->bindParam(':category',$category);
	  $stmt->bindParam(':PDFPath',$PDFPath);
	  $stmt->bindParam(':imgPath',$imgPath);
      $stmt->execute();
	  $caseData = $stmt->fetchAll(PDO::FETCH_OBJ);
	  $caseID=$dbh->lastInsertId();//should get last caseID 
	  $stmt = null;
	  
	  #$caseID = $caseData[0]->CaseID;
      $_SESSION['caseID'] = $caseID;
	  
	  $_SESSION['changeResults'] = "Case Added";
    }
    echo $_FILES["pdffile"]["name"];
	echo $_FILES["image"]["name"];
    header("location: addQuestions.php");  
  }
  else {
    echo "Please fill out all Case Fields"; 
  }
?> 
