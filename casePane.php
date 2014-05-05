<?php
  //make a list of cases with the same category as selected from the home page
  session_start();
  $category = $_SESSION['category'];
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

  $dbh = ConnectDB();

  $category_query = "SELECT * FROM CaseFile WHERE Category= :category";
  $stmt = $dbh->prepare($category_query);
  $stmt->bindParam('category',$category);
  $stmt->execute();
  $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
			
  $stmt = null;

  $count = 0;
  foreach ( $categoryData as $title ) {
    $count++;
    echo "<li><a href='http://elvis.rowan.edu/~crouch59/swe/caseFiles.php?category=".urlencode($title->Category)."&title=".urlencode($title->Title)."&description=".urlencode($title->Description)."&caseID=".urlencode($title->CaseID)."'>Case $count</a></li>";
  }
?>