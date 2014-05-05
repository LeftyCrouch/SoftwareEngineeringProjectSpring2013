<!-- check to make sure user is signed in to be able to access page -->
<?php
  session_start();
  $category = $_GET['category'];
  $_SESSION['category'] = $category;
  $title = $_GET['title'];
  $_SESSION['title'] = $title;
  $description = $_GET['description'];
  $_SESSION['description'] = $description;
  $caseID = $_GET['caseID'];
  $_SESSION['caseID'] = $caseID;
  $_SESSION['firstTime'] = 1;
   
  $pdfPath = $_GET['pdfPath'];
  
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  $dbh = ConnectDB();

  $category_query = "SELECT * FROM CaseFile WHERE CaseID= :caseID";
  $stmt = $dbh->prepare($category_query);
  $stmt->bindParam('caseID',$caseID);
  $stmt->execute();
  $caseData = $stmt->fetchAll(PDO::FETCH_OBJ);
  $stmt = null;
  
  $pdfPath = $caseData[0]->PDFPath;
  $_SESSION['pdfPath'] = $pdfPath;
  $imgPath = $caseData[0]->ImagePath;
  $_SESSION['imagePath'] = $imgPath;
  
  if(!isset($_SESSION['email'])){
    header("location: loginPage.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Case</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
	<link rel="stylesheet" type="text/css"
          href="stylesheet.css" />
  </head>
  <body>
    <!-- following used to always have content centered in the middle of the browser -->
    <div id="wrapper">
      <div id="content">
        <!-- menu option on top of page to return to home or logout -->  
        <div id='top_menu'>
          <div id='top_options'>
	        <ul>
			  <?php if($_SESSION['userType'] == "Admin") {
					  echo "<li><a href='delete.php'>Delete Case</a> | </li>";
			          echo "<li><a href='addCase.php'>Edit Case</a> | </li>";
					}
			  ?>
			  <li><a href='resetCase.php'>Reset Case</a> | </li>
		      <?php if(($_SESSION['userType'] == "Admin") or ($_SESSION['userType'] == "Facilitator") and isset($pdfPath)) {
					  echo "<li><a href=\"http://elvis.rowan.edu/~crouch59/swe/$pdfPath\" target='_blank'>Retrieve PDF</a> |</li>";
				    }
					else if(($_SESSION['userType'] == "Admin") or ($_SESSION['userType'] == "Facilitator")){
					  echo "<li>No PDF |</li>";
					}
			  ?>
			  <li><a href='questions.php?'>Questions about Case</a> | </li>
	          <li><a href='homePage.php'>Return to Home Page</a> |</li>
	          <li><a href='logout.php'>Logout</a> </li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
		<!-- case files body -->
		<div class="welcome_message container-fluid"> 
		  <div class="row-fluid">
	        <div class="whiteSpace well sidebar-nav">
			  <h2 class="form-signin-heading">
		        <?php echo "".$_SESSION['title']."";
				      if($imgPath != NULL) {
		                echo "<a href=\"http://elvis.rowan.edu/~crouch59/swe/pdf/$imgPath\" target='_blank'><img src=\"pdf/$imgPath\" width=\"450\" height=\"450\"/></a>";
				      }
				?>
		      </h2>
              <?php 
				echo nl2br($description);
		      ?>
		      <h3 class="form-signin-heading toolsTitle"> Diagnostic Tools </h3>
		      <form action="diagnosticTools.php" target="_blank">
                <button class="btn btn-large btn-primary" value="diagnosticTools.php" type="submit">Click Here</button>
			  </form>
			</div> <!-- end whiteSpace, well, & sidebar-nav -->
	      </div> <!-- end row-fluid -->
		</div> <!-- end welcome_message & container-fluid -->
		<!-- navigation bar on left side of page with cases -->
		<div class="container-fluid">
          <div class="row-fluid">
            <div class="span3">
		      <div class="well sidebar-nav">
                <ul class="nav nav-list">
                  <li class="nav-header"> <?php echo "".$_SESSION['category']." "; ?>Cases
			      </li>
		          <?php
			        include "casePane.php";
			      ?>
			    </ul>
              </div> <!-- end well -->
            </div> <!--end span3-->
	      </div> <!-- end row-fluid -->
		</div> <!-- end container-fluid -->
	  </div> <!-- end content -->
    </div> <!-- end wrapper -->
  </body>
</html>