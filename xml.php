<?php
//============================================================+
// File name   : xml.php
//
// Description : retrieves xml data for google map  from db.
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
session_start();
if(isset($_SESSION['li_uname333'])){
require_once './includes/db_config.php';
connect();
$q=$_SESSION['query'];
}
else{
require_once './includes/db_config.php';
connect();
$q=$_SESSION['query'];
}
?>
<?php
$result2=mysql_query($q) or die(mysql_error());
$doc = new DomDocument('1.0');
$node = $doc->createElement("task");
$parnode = $doc->appendChild($node);
header("Content-type: text/xml");
while($row = mysql_fetch_array($result2)){
$node = $doc->createElement("marker");
$newnode = $parnode->appendChild($node);
$newnode->setAttribute("tid", $row['task_id']);
$newnode->setAttribute("title", $row['title']);
$newnode->setAttribute("description", $row['description']);
$newnode->setAttribute("deadline", $row['deadline']);
$currency=$row['currency'];	
if($currency==1){$currency="Rs.";} if($currency==2){$currency="$";}	
$newnode->setAttribute("payment", $currency."".$row['payment']);
$newnode->setAttribute("name", $row['location']);
$newnode->setAttribute("address", $row['address']);
}
print $doc->saveXML();