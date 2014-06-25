<?php
//============================================================+
// File name   : reviews_save.php
//
// Description : This file saves the reviews written by user.
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
if(isset($_SESSION['li_uname111'])){
	$e=$_SESSION['li_uname111'];
}
elseif(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$title="Task Poster";
}
elseif(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$title="Task Worker";	
}
else{
		$e='';
		header('location:login.php');die;//redirect to login page
}
?>


<?php
if(isset($_POST['submit'])){

//gathering user's entered data
$pid=trim($_POST["pid"]);
$wid=trim($_POST["wid"]);
$tpe=trim($_POST["type"]);
$review=trim($_POST["review"]);
//gathering other data
$today = mktime(0,0,0,date("m"),date("d"),date("Y"));
$date = date("m/d/y",$today);

//validating form content
if($review =="" ){
	echo "<script> alert('Please write a review first.')</script>";
	echo"<script> function goBack(){window.history.back()} goBack(); </script>";  
}
else{
//processing form content

	require_once './includes/db_config.php';
	connect();
	$query2 = "insert into reviews values('','$pid',$wid,'$review','$date','$tpe')";
	$result2=mysql_query($query2);
	if($result2){
	 //echo "<script> alert('Review written.') </script>" ;
	 echo"<script> function goBack(){window.history.back()} goBack(); </script>";
	}else{
			echo"Oops! Something went wrong!";
		}
  }
}
?>