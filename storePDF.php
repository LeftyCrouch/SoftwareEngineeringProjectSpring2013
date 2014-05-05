<?php
  #author: Michael Bevilacqua
  #modified from www.WS3 School
  $allowedExts = array("pdf");
  $extension = end(explode(".", $_FILES["pdffile"]["name"]));
  if ((($_FILES["pdffile"]["type"] == "application/pdf")
        && in_array($extension, $allowedExts)))
  {
    if ($_FILES["pdffile"]["error"] > 0)
    {
    }
    else
    {
      if (file_exists("PDF/.UPLOADED/archive/" . $_FILES["pdffile"]["name"]))
      {    
      }
      else
      {
        move_uploaded_file($_FILES["pdffile"]["tmp_name"],
        "/export/home/crouch59/source_html/swe/project/team2/InteractiveClinicalStudies/public_html/PDF/.UPLOADED/archive/" . $_FILES["pdffile"]["name"]);
      }
    }
	header("location: addCase.php");
  }
  else
  {
    echo "Invalid file";
    echo $extension;
    echo "size: ". $_FILES["pdffile"]["size"]."";
    echo "type: ". $_FILES["pdffile"]["type"]. "";
  }
?> 
