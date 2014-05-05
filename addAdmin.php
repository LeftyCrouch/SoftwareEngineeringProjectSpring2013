<!-- only administrator can access page -->
<?php
  session_start();
  if($_SESSION['userType'] != "Admin") {
	header("location: homePage.php");
  }
?> 
<!DOCTYPE html>
<html>
  <head>
    <title>Add Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
	<link rel="stylesheet" type="text/css"
          href="stylesheet.css" />
  </head>
  <body>
    <!-- following used to always have content centered in the middle of the browser -->
    <div id="wrapper">
      <div id="content">
        <!-- menu option on top of page to change password or logout -->  
        <div id='top_menu'>
          <div id='top_options'>
            <ul>
	          <li><a href='homePage.php'>Don't Change User Type</a></li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
		<!-- form to add an administrator -->
		<div class="container">
	      <form class="form-signin" name="updateUserTypeInformation" method="post" action="updateUserType.php">
            <h2 class="form-signin-heading">Edit Privileges</h2>
		    <h4>Enter email of account to modify</h4>
 		    <input name="email" type="email" maxlength="256" class="input-block-level" placeholder="Email address">
            <input type="radio" name="userType" value="Admin">Admin
            <input type="radio" name="userType" value="Facilitator">Facilitator
		    <input type="radio" name="userType" value="Student">Student
            <button class="btn btn-large btn-primary" type="submit">Submit</button>
          </form>
        </div> <!-- end container -->
	  </div> <!-- end content -->
	</div> <!-- end wrapper -->
	
  </body>
</html>