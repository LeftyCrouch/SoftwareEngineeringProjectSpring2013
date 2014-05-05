<?php
  //login the user
  //connect to the database
  ob_start();
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
 
  $dbh = ConnectDB();

  // Connect to server and select databse.
  //mysql_connect("$hostname", "$username", "$password")or die("cannot connect");
  //mysql_select_db("$dbh")or die("cannot select DB");

  // Define $username and $password
  $email=$_POST['email'];
  $password=$_POST['password'];
  
  // To protect MySQL injection
  $email = stripslashes($email);
  $password = stripslashes($password);
  $email = mysql_real_escape_string($email);
  $password = mysql_real_escape_string($password);

  $query="SELECT * FROM LoginInfo WHERE Email= :email and Password= :password
		 AND BINARY(Password) = BINARY(:password)";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':email',$email);
  $stmt->bindParam(':password',$password);
  $stmt->execute();
  	 
  $result=$stmt->fetchAll(PDO::FETCH_OBJ);
  $stmt = null;

  // Mysql_num_row is counting table row
  //$count=mysql_num_rows($result);

  // If result matched $username and $password
  if(isset($result) && (!empty($result))){
    // Register $email, $password and redirect to file "login_success.php"
	$query = "SELECT UserType FROM LoginInfo WHERE email = :email";
	$stmt = $dbh->prepare($query);
	$stmt->bindParam(':email',$email);
	$stmt->execute();
	
	$result=$stmt->fetch();
	$stmt = null;
	
    session_start();
    $_SESSION['email']=$email;
    $_SESSION['password']='';
	$_SESSION['userType']=$result[0];
    header("location: homePage.php"); 
  }
  else {
    echo "Wrong Username or Password";
  }
  ob_end_flush();
?>
