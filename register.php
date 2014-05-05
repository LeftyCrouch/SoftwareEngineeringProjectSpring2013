<?php
  // register a new account 
  //access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  
  $dbh = ConnectDB();
  
  //make variables for values entered in form
  
  if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['firstName']) && !empty($_POST['firstName']) && 
     isset($_POST['lastName']) && !empty($_POST['lastName']) && isset($_POST['password']) && !empty($_POST['password'])) { 
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $retypePassword=$_POST['retypePassword'];
    //default usertype to student
    $userType="student";
  
    //check if email is already in database
    $query = "SELECT * FROM LoginInfo WHERE Email = :email";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':email',$email);
    $stmt->execute();
  
    $result=$stmt->fetchAll(PDO::FETCH_OBJ);
    $stmt = null;
 
    //if result isn't in database, create account
    if(!isset($result[0])){
      if($password == $retypePassword) {
        $query = "INSERT INTO LoginInfo (F_name, Email, L_name, Password, UserType)
	             VALUES(:F_name, :Email, :L_name, :Password, :UserType)";
        $stmt = $dbh->prepare($query);
	    $stmt->bindParam(':F_name',$firstName);
        $stmt->bindParam(':Email',$email);
	    $stmt->bindParam(':L_name',$lastName);
	    $stmt->bindParam(':Password',$password);
	    $stmt->bindParam(':UserType',$userType);
        $stmt->execute();
	    $stmt = null;
	  
	    session_start();
	    $_SESSION['newAccount']="Account Successfully Created";
	    header("location: loginPage.php");
	  }
	  else {
	    echo "Password does not match Retyped password!";
	  }
    }
    else {
      echo "Email is already registered for this website!";
    } 
  }
  else {
    echo "Please fill out all Registration Fields"; 
  }
?>