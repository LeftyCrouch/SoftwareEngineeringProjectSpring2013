<!-- only administrator can access page -->
<?php
  session_start();
  $_SESSION['redirect'] = 'no';
  if($_SESSION['userType'] != "Admin") {
	header("location: homePage.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add Diagnostic Tools</title>
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
	          <li><a href='homePage.php'>Don't Add Diagnostic Tools</a> </li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
		<!-- add a question body -->
		<div class="questions container-fluid Container">	
		  <div class="row-fluid">
		    <div class="well sidebar-nav">
			  <div class="nav-question nav-list-question">
		  <?php
		    //add a question
			echo'<form class="form-signin-case" name="addTools" method="post" action="addTools.php" enctype="multipart/form-data">
                   <h2 class="form-signin-heading">Add Diagnostic Tool</h2>
		           <h4> Fill in all fields</h4>
				   <select name="category" size="1">
				     <option selected="Category">Category</option>
                     <option value="Vital Signs">Vital Signs</option>
                     <option value="Laboratory Values">Laboratory Values</option>
                     <option value="Diagnostic Imaging">Diagnostic Imaging</option>
                     <option value="Physical Exam">Physical Exam</option>
                     <option value="Special Test">Special Test</option>
					 <option value="Pathology">Pathology</option>
                   </select>
 		           <textarea name="description" class="input-block-level" placeholder="Description"></textarea>
                   <textarea name="diagnosticEvaluation" class="input-block-level" placeholder="Diagnostic Evaluation"></textarea>
				   <h4>Choose Image for Diagnostic Evaluation of Tool</h4>
				   <input type="file" name="image" id="image" class="input-block-level">
				   <h4>Time to wait until tool is available ( set to 0.0 to make it instant upon ordering )</h4>
				   <input type="number" name="timer" placeholder="minutes"><br>
		           <button class="btn btn-large btn-primary" type="submit" name="button" value="add">Add Tool</button>
				   <button class="btn btn-large btn-primary" type="submit" name="button" value="finish">Finish</button>
                 </form>';
		  
		    include("storeTool.php");
		  ?>
		      </div> <!-- end nav-question & nav-list-question -->
			</div> <!-- end well & sidebar-nav -->
		  </div> <!-- end row-fluid -->
        </div> <!-- end container -->
	  </div> <!-- end content -->
	</div> <!-- end wrapper -->
  </body>
</html>