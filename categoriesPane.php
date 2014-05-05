<?php
  // make a list of the categories of the cases stored in the database
  // access information in directory with no web access
  require_once('/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/Connect.php');

  $dbh = ConnectDB();

  $category_query = "SELECT DISTINCT (Category), Title, Description, CaseID FROM CaseFile group by Category";
  $stmt = $dbh->prepare($category_query);
  $stmt->execute();
  $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
		
  $stmt = null;

  foreach ( $categoryData as $category ) {   
   echo "<li><a href='http://elvis.rowan.edu/~crouch59/swe/caseFiles.php?category=".urlencode($category->Category)."&title=".urlencode($category->Title)."&description=".urlencode($category->Description)."&caseID=".urlencode($category->CaseID)."'>$category->Category</a></li>";
  }
?>