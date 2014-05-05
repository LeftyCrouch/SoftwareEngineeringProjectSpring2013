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
    <title>Guided Feedback</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
    <link rel="stylesheet" type="text/css"
          href="stylesheet.css" />
  </head>
  <body>
    <!-- following used to always have content centered in the middle of the browser -->
    <div id="wrapper">
      <div id="content">
        <!-- menu option on top of page to return to case or logout -->  
        <div id='top_menu'>
          <div id='top_options'>
	        <ul>
	          <li><a href="javascript:javascript:history.go(-1)">Return to Case</a> |</li>
	          <li><a href='logout.php'>Logout</a> </li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
		</div> <!-- end banner -->
		<!-- script to show/hide answers -->
		<script>
		  function toggle(x){
			var divx = document.getElementById('div'+x)
			if (divx.style.display == 'none') {
		   	  divx.style.display = 'block'
			} 
			else {
			  divx.style.display = 'none'
			}
		  }
		</script>
		<div class="questions container-fluid"> 
          <div class="row-fluid">
		    <div class="well sidebar-nav">
              <ul class="nav nav-list">
                <li class="nav-header questionTitle">Guided Feedback</li>
		        <?php
		          include 'questionsPane.php';
		        ?>
			  </ul>
            </div> <!-- end well & sidebar-nav -->
	      </div> <!-- end row-fluid -->
		</div> <!-- end questions & container-fluid -->
      </div> <!-- end content -->
	</div>  <!-- end wrapper -->
  </body>
</html>