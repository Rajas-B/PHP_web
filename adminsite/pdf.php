<?php
$filename = $_GET['pdf'];

  
// Header content type

  
header('Content-type: application/pdf');
  
header('Content-Disposition: inline; filename="' . $filename . '"');
  
header('Content-Transfer-Encoding: binary');
  
header('Accept-Ranges: bytes');
  
// Send the file to the browser.
readfile($filename);
?>