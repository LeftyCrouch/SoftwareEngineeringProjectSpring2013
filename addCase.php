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
    <?php 
      if(isset($_SESSION['caseID']) ) {
        echo" <title>Edit Case</title> ";
      }
      else{
        echo " <title>Add Case</title> ";
      }
    ?> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
	<link rel="stylesheet" type="text/css"
          href="stylesheet.css" />
  </head>
  <body>
    <!-- following used to always have content centered in the middle of the browser -->
    <div id="wrapper">
      <div id="content">
        <!-- menu option on top of page to choose to not add a case and return to home -->  
        <div id='top_menu'>
          <div id='top_options'>
            <ul>
	          <li><a href='homePage.php'>Return to Home</a> </li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
		<!-- add a case body -->
		<div class="questions container-fluid Container">	
		  <div class="row-fluid">
		    <div class="well sidebar-nav">
			  <div class="nav nav-list">
		  <?php
		  //edit a case
		  if(isset($_SESSION['caseID']) ) {
			echo'<form class="form-signin-case" name="editCase" method="post" action="storeCase.php" enctype="multipart/form-data">
                   <h2 class="form-signin-heading">Edit Case</h2>
		           <h4> Edit any or all of the Case Fields</h4>
 		           <input name="title" type="text" maxlength="256" class="input-block-level" placeholder="Title" value="'.htmlentities($_SESSION['title']).'">
                   <textarea name="description" class="input-block-level" placeholder="Description">'.urldecode($_SESSION['description']).'</textarea>
		           <input name="category" type="text" maxlength="256" class="input-block-level" placeholder="Category" value="'.urldecode($_SESSION['category']).'" >
				   <h4>Choose Image for description of Case</h4>
				   <input type="file" name="image" id="image" class="input-block-level">
				   <h4>Choose PDF to add for Facilitator</h4>
                   <input type="file" name="pdffile" class="input-block-level" id="pdffile" value="'.$_SESSION['PDFPath'].'">
				   <input type= "hidden" name="edit" value="edit" class="input-block-level">
		           <button class="btn btn-large btn-primary" type="submit">Next</button>
                 </form>';
		  
          }
          else{
		    #if adding a case
	        echo' <form class="form-signin-case" name="addCase" method="post" action="storeCase.php" enctype="multipart/form-data">
                    <h2 class="form-signin-heading">Add Case</h2>
		            <h4>Fill in all fields before creating case</h4>
 		            <input name="title" type="text" maxlength="256" class="input-block-level" placeholder="Title">
                    <textarea placeholder="Description" rows="10" cols="50" name="description" class="input-block-level"></textarea>
		            <input name="category" type="text" maxlength="256" class="input-block-level" placeholder="Category">
                    <h4>Choose Image for description of Case</h4>
					<input type="file" name="image" id="image" class="input-block-level">
					<h4>Choose PDF to add for Facilitator</h4>
					<input type="file" name="pdffile" id="pdffile" class="input-block-level">
		            <button class="btn btn-large btn-primary" type="submit">Next</button>
                  </form>';
		  } 
		  ?>
		      </div> <!-- end nav & nav-list -->
			</div> <!-- end well & sidebar-nav -->
		  </div> <!-- end row-fluid -->
        </div> <!-- end container -->
	  </div> <!-- end content -->
	</div> <!-- end wrapper -->
  </body>
</html>