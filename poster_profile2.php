<?php
//============================================================+
// File name   : poster_profile2.php
//
// Description : This file saves the edited records of poster's profile
//
// Author:  Aditya Mathur
//
// (c) Copyright:
//               Aditya Mathur
//               eztasker.com
//
// License:
//    Copyright (C) 2014 Aditya Mathur - eztasker.com
//============================================================+

// Read the form values
$success = false;
//gathering user's entered data
$id=trim($_POST["id"]);
$fname=trim($_POST["fname"]);
$lname=trim($_POST["lname"]);
$telephone=trim($_POST["telephone"]);
$city=trim($_POST["city"]);
$address=trim($_POST["address"]);
$aboutme=trim($_POST["aboutme"]);

require_once './includes/db_config.php';
connect();
// If all values exist, save to database
if ( $fname && $lname && $telephone && $city && $address && $aboutme ) {

  $success=mysql_query("update poster_profile set fname='".$fname."', lname='".$lname."', telephone='".$telephone."', location='".$city."', address='".$address."' , about_me='".$aboutme."' where poster_id='".$id."' ");
  
}

// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
  echo $success ? "success" : "error";
} else {
?>
<html>
  <head>
    <title>Thanks!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Record Saved.</p>" ?>
  <?php if ( !$success ) echo "<p>Oops! Something went wrong.</p>" ?>
  <p>Click your browser's Back button to return to the page.</p>
  </body>
</html>
<?php
}
?>


