<!-- check to make sure user is signed in to be able to access page -->
<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("location: loginPage.php");
  }
  
  $DTID = $_GET['toolID'];
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  $dbh = ConnectDB();

  $category_query = "SELECT * FROM DiagnosticTool WHERE DTID = :DTID";
  $stmt = $dbh->prepare($category_query);
  $stmt->bindParam('DTID',$DTID);
  $stmt->execute();
  $caseData = $stmt->fetchAll(PDO::FETCH_OBJ);
  $stmt = null;
  
  $imgPath = $caseData[0]->ImagePath;
  $_SESSION['imagePath'] = $imgPath;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Diagnostic Tools</title>
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
	          <li><a href="JavaScript:window.close()">Close Window</a> </li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
		<!-- body of diagnostic tool -->
		<div class="welcome_message container-fluid"> 
		  <div class="row-fluid">
	        <div class="well sidebar-nav">
			  <div class="nav nav-list">
			    <h2 class="form-signin-heading">Description</h2>
			    <?php 
			      if($_SESSION['firstTime'] == 1) {
					echo "Click on a tool to the left to help diagnose the case";
					$_SESSION['firstTime'] = 0;
			      }
				  include 'diagnosticPane.php';
				?>
			  </div> <!-- end nav nav-list -->
		    </div> <!-- end whiteSpace, well, & sidebar-nav -->
		  </div> <!-- end row-fluid -->
		</div> <!-- end welcome_message & container-fluid -->
		<!-- navigation bar of all tools for the case -->
     	<div class="container-fluid">
          <div class="row-fluid">
            <div class="span3">
		      <div class="well sidebar-nav">
                <ul class="nav nav-list">
                  <li class="nav-header">Case Tools</li>
			      <?php 					
			        include "diagnosticList.php";
				  ?>
			    </ul>
              </div> <!--end well -->
            </div><!--end span3 -->
	      </div> <!-- end row-fluid -->
		</div> <!-- end container-fluid -->
      </div> <!-- end content -->
    </div> <!-- end wrapper -->
  </body>
</html>