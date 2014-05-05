<?php
  // let the user change their password 
  session_start();
  $session_email=$_SESSION['email'];
  //access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  
  $dbh = ConnectDB();
  
  //make variables for values entered in form
  $email=$_POST['email'];
  $oldPassword=$_POST['oldPassword'];
  $newPassword=$_POST['newPassword'];
  $retypedNewPassword=$_POST['retypedNewPassword'];
  
  //is session email same as email entered in form?
  if($session_email == $email) {
    $query = "SELECT * FROM LoginInfo WHERE Password = :oldPassword";
	$stmt = $dbh->prepare($query);
    $stmt->bindparam(':oldPassword',$oldPassword);
    $stmt->execute();
  	 
    $result=$stmt->fetchAll(PDO::FETCH_OBJ);
    $stmt = null;
	
	//if result matched $oldPassword
	if(isset($result) && (!empty($result))) {
	  if(($newPassword == $retypedNewPassword) && (!empty($newPassword)) && (!empty($retypedNewPassword))) {
	    $query = "UPDATE LoginInfo SET Password = :newPassword
                 WHERE Email = :email";
	    $stmt = $dbh->prepare($query);
	    $stmt->bindParam(':newPassword',$newPassword);
	    $stmt->bindParam(':email',$email);
	    $stmt->execute();
	    $stmt = null;
	    $_SESSION['changeResults']="PASSWORD SUCCESSFULLY CHANGED";
	    header("location: homePage.php");
	  }
	  else {
	    echo "New password and retyped new password do not match";
	  }
	}
	else {
	  echo "Old password entered is incorrect!";
	}
  }
  else {
    echo "Email entered did not match email used to log in!";
  }
?>