<?php
  //order a test for a diagnostic tool
  session_start();
  $email = $_SESSION['email'];
  $DTID = $_SESSION['toolID'];
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');
  $currentTime = time();
  $dbh = ConnectDB();
  $query = "Insert into Ordered values(:email, :DTID, :currentTime)";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam('DTID',$DTID);
  $stmt->bindParam('email',$email);
  $stmt->bindParam('currentTime',$currentTime);
  $stmt->execute();
  $stmt = null;
  header("location: diagnosticTools.php?toolID=$DTID");
  ?>