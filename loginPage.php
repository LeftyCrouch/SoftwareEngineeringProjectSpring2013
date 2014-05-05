<!-- start session to post info if a user just registered a new account -->
<?
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
    <link rel="stylesheet" type="text/css"
          href="stylesheet.css" />
  </head>
  <body>
    <!-- following used to always have content centered in the middle of the browser -->
    <div id="wrapper">
      <div id="content">
        <!-- menu option on top of page to register a new account -->  
        <div id='top_menu'>
          <div id='top_options'>
            <ul>
			  <li> <?php if(isset($_SESSION['newAccount'])) {
						   echo "".$_SESSION['newAccount']." | ";
						   $_SESSION['newAccount'] = null;
						 }
				   ?>
			  </li>
	          <li><a href='registrationPage.html'>Register A New Account</a> </li>
	        </ul>
          </div> <!-- end top_options -->
        </div> <!-- end top_menu -->
        <!-- Banner -->
        <div id ="banner"><img id ="logo" src="cooper-banner.jpg" alt="Rowan University Interactive Clinical Studies"
                               style="border:none;"/>
        </div> <!-- end banner -->
		<!-- form for signing into the site -->
        <div class="container">
	      <form class="form-signin" name="userInformation" method="post" action="login.php">
            <h2 class="form-signin-heading">Please sign in</h2>
            <input name="email" type="email" maxlength="256" class="input-block-level" placeholder="Email address">
            <input name="password" type="password" maxlength="16" class="input-block-level" placeholder="Password">
            <button class="btn btn-large btn-primary" type="submit">Sign in</button>
          </form>
        </div> <!-- end container -->
      </div> <!-- end content -->
    </div> <!-- end wrapper -->  
  </body>
</html>
