<!-- check to make sure user is signed in to be able to access page -->
<?php
  session_start();
  $_SESSION['caseID'] = null;
  if(!isset($_SESSION['email'])){
    header("location: loginPage.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
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
			  <li><?php if(isset($_SESSION['changeResults'])) {
						  echo "".$_SESSION['changeResults']." | ";
						  $_SESSION['changeResults'] = null;
						}
				  ?>
			  </li>
			  <?php if($_SESSION['userType'] == "Admin") {
					  echo "<li><a href='addCase.php'>Add Case</a> | </li>";
				    }
			        if($_SESSION['userType'] == "Admin") {
					  echo "<li><a href='addAdmin.php'>Assign Administrator</a> |</li>";
				    }
			  ?>
	          <li><a href='changePasswordPage.php'>Change Password</a> |</li>
	          <li><a href='logout.php'>Logout</a> </li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
		<!-- body of homepage -->
		<div class="welcome_message container-fluid"> 
		  <div class="row-fluid">
			<div class="whiteSpace well sidebar-nav">
			  <h2 class="form-signin-heading">Welcome</h2>
				Welcome to Rowan University Cooper Medical School's Active Learning Group website.
				Here you can explore different interactive clinical cases and read your way through a diagnostic.
				Along the way you will encounter different tools to help you and questions to better
				your understanding of the case. Listed to the left are different categories of cases
				that are available on the site.						 
		    </div> <!-- end whiteSpace, well, & sidebar-nav -->
		  </div> <!-- end row-fluid -->
		</div>
		<!-- navigation bar on the left side -->
		<div class="container-fluid">
          <div class="row-fluid">
            <div class="span3">
			  <div class="well sidebar-nav">
                <ul class="nav nav-list">
                  <li class="nav-header">Categories</li>
		            <?php
			          include "categoriesPane.php";
			        ?>
			    </ul>
              </div> <!-- end well & sidebar-nav -->
            </div> <!-- end span3 -->
		  </div> <!-- end row-fluid -->
		</div> <!-- end container-fluid -->
	  </div> <!-- end content -->
    </div> <!-- end wrapper -->
  </body>
</html>
