<?php
  //admin updating the user type of an email 
  session_start();
  
  // let the user change their password 
  //access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  
  $dbh = ConnectDB();
  
  //make variables for values entered in form
  $email=$_POST['email'];
  $userType=$_POST['userType'];
  
  //is email in the database?
  $query = "SELECT * FROM LoginInfo WHERE Email = :email";
  $stmt = $dbh->prepare($query);
  $stmt->bindparam(':email',$email);
  $stmt->execute();
  	 
  $result=$stmt->fetchAll(PDO::FETCH_OBJ);
  $stmt = null;
	
  //if result matched $oldPassword
  if(isset($result) && (!empty($result))) {
    if(($userType == "Admin") && (!empty($userType))) {
	  $query = "UPDATE LoginInfo SET UserType = :userType
               WHERE Email = :email";
	  $stmt = $dbh->prepare($query);
	  $stmt->bindParam(':email',$email);
      $stmt->bindParam(':userType',$userType);
	  $stmt->execute();
	  $stmt = null;
	  $_SESSION['changeResults']="Privileges Successfully Updated for ".$email."";
	  header("location: homePage.php");
	}
	else if(($userType == "Facilitator") && (!empty($userType))) {
	  $query = "UPDATE LoginInfo SET UserType = :userType
               WHERE Email = :email";
	  $stmt = $dbh->prepare($query);
	  $stmt->bindParam(':email',$email);
      $stmt->bindParam(':userType',$userType);
	  $stmt->execute();
	  $stmt = null;
	  $_SESSION['changeResults']="Privileges Successfully Updated for ".$email."";
	  header("location: homePage.php");
	}
	else if(($userType == "Student") && (!empty($userType))) {
	  $query = "UPDATE LoginInfo SET UserType = :userType
               WHERE Email = :email";
	  $stmt = $dbh->prepare($query);
	  $stmt->bindParam(':email',$email);
      $stmt->bindParam(':userType',$userType);
	  $stmt->execute();
	  $stmt = null;
	  $_SESSION['changeResults']="Privileges Successfully Updated for ".$email."";
	  header("location: homePage.php");
	}
	else {
	  echo "User Type not Selected!";
	}
  } 
  else {
    echo "Email entered was not found in Database!";
  }

  /*update session variable if user changed self privileges */
  if($_SESSION['email'] == $email) {
	$_SESSION['userType']=$userType;
  }
?>