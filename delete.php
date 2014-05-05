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
    <title>Delete Case</title>
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
	          <li><a href='homePage.php'>Don't Delete a Case</a></li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
		<!-- form to confirm delete -->
		<div class="container">
	      <form class="form-signin" name="updateUserTypeInformation" method="post" action="deleteCase.php">
            <h2 class="form-signin-heading">Delete Case</h2>
		    <h4>Are you sure you want to delete case titled: <?php echo "".$_SESSION['title']."" ?> </h4>
            <input type="radio" name="decision" value="Yes">Yes
            <input type="radio" name="decision" value="No">No
            <button class="btn btn-large btn-primary" type="submit">Submit</button>
          </form>
        </div> <!-- end container -->
	  </div> <!-- end content -->
	</div> <!-- end wrapper -->
  </body>
</html>