<?php
  /* Set oracle user login and password info */
  $dbuser = "ajind";  /* your deakin login */
  $dbpass = "ANOOP";  /* your deakin password */
  $dbname = "SSID"; 
  $db = oci_connect($dbuser, $dbpass, $dbname); 

  if (!$db)  {
    echo "An error occurred connecting to the database"; 
    exit; 
  }

?>