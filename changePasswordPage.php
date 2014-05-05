<!-- check to make sure user is signed in to be able to access page -->
<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("location: loginPage.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Change Password</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Ray Wickersham, Christopher Crouch">
	<link rel="stylesheet" type="text/css"
          href="stylesheet.css" />
  </head>
  <body>
    <!-- following used to always have content centered in the middle of the browser -->
    <div id="wrapper">
      <div id="content">
        <!-- menu option on top of page to not change password -->  
        <div id='top_menu'>
          <div id='top_options'>
            <ul>
	          <li><a href='homePage.php'>Don't Change Password</a> </li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
        <!-- form to change password -->		
		<div class="container">
	      <form class="form-signin" name="changepasswordInformation" method="post" action="changePassword.php">
            <h2 class="form-signin-heading">Change Password</h2>
 		    <input name="email" type="email" maxlength="256" class="input-block-level" placeholder="Email address">
            <input name="oldPassword" type="password" maxlength="16" class="input-block-level" placeholder="Old Password">
		    <input name="newPassword" type="password" maxlength="16" class="input-block-level" placeholder="New Password">
		    <input name="retypedNewPassword" type="password" maxlength="16" class="input-block-level" placeholder="Retype New Password">
            <button class="btn btn-large btn-primary" type="submit">Submit</button>
          </form>
        </div> <!-- end container -->
	  </div> <!-- end content -->
	</div> <!-- end wrapper -->
  </body>
</html>
