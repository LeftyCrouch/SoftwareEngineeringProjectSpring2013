<?php
  // logout session of user
  session_start();
  session_destroy();
  //send user to login page
  header("Location: loginPage.php");
?>
