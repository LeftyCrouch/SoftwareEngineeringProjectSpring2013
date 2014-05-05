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
    <title>Add Questions</title>
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
	          <li><a href='homePage.php'>Don't Add Questions or Diagnostic Tools</a> </li>
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
			echo'<form class="form-signin-case" name="addQuestions" method="post" action="addQuestions.php" enctype="multipart/form-data">
                   <h2 class="form-signin-heading">Add Question</h2>
		           <h4> Fill in all fields</h4>
 		           <input type="text" name="question" class="input-block-level" placeholder="Question">
                   <textarea name="answer" class="input-block-level" placeholder="Answer"></textarea>
		           <button class="btn btn-large btn-primary" type="submit" name="button" value="add">Add Question</button>
				   <button class="btn btn-large btn-primary" type="submit" name="button" value="next">Next</button>
                 </form>';
		  
		    include("storeQuestion.php");
		  ?>
		      </div> <!-- end nav-question & nav-list-question -->
			</div> <!-- end well & sidebar-nav --> 
		  </div> <!-- end row-fluid -->
        </div> <!-- end container -->
	  </div> <!-- end content -->
	</div> <!-- end wrapper -->
  </body>
</html>