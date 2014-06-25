<?php
//============================================================+
// File name   : index.php
//
// Description : Home page for the site.
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
require_once("./includes/configure.php");

if(isset($_SESSION['li_uname111'])){
header('Location:./admin_home.php');   // jump to home page
} 
elseif(isset($_SESSION['li_uname222'])){
	redirectURL(SITE_URL."./main.php");
}
elseif(isset($_SESSION['li_uname333'])){
	redirectURL(SITE_URL."./main.php");
	
}
else{
	//persist on default public home page
	$e='';
	$type=0;	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EasyTask</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
<link href="./css/geometry.css" rel="stylesheet" />
<link href="./css/form.css" rel="stylesheet" />
<link href="./css/structure.css" rel="stylesheet" />
</head>

<body>
<div class="header">
  <div class="topstrip">
   <div class="logo"></div>
    <div class="links"> <a href="login.php">Sign In</a></div>
  </div>
  <div class="tabs">
    <ul>
      <li><a class="current" href="#">Home</a></li>
      <li><a href="login.php">Post a Task</a></li>
      <li><a href="main.php">Browse Tasks</a></li>
      <li><a href="about.php">About Us</a></li>
    </ul>
  </div>
  <div class="imageslide">
    <div class="overlay">
      <div class="overlaycontent">
        <div class="container">
          <h1  style="text-align: center;" >Find people to help you.</h1>
          <div style="margin-top: 30px">
          <form action="login.php">
            <input class="task-name" name="task[name]" placeholder="e.g Clean my apartment" size="30" type="text">
            <input class="greenbutton" value="Post a Task" type="submit"/>
          </form>
          </div>
        </div>
        <div class="container">
          <h1 style="text-align: center;" >Help people with their work.</h1>
          <div align="center" style="margin-top: 30px"> 
           <form action="main.php">
            <input class="greenbutton" value="Browse Tasks" type="submit"/>
          </form></div>
        </div>
      </div>
    </div>
  </div>
  <div class="spacer"></div>
</div>
<div class="maincontent"> 




</div>
<footer>
  <div class="upperfooter">
    <div class="footercontainer">
	
      <div class="lowerboxes">
			<h2>Follow Us On</h2>
			<a  href="https://www.facebook.com/easytasksCMU"><div class="" style="opacity: 0.4;"></div><img alt="Facebook" src="./images/fb-icon.png"></a>                 
			<a  href="https://twitter.com/TaskMasterWorld"><div class="" style="opacity: 0.4; float:right;"></div><img alt="Twitter" src="./images/twitter-icon.png"></a>                     
      </div>
      <div class="lowerboxes">
			<h2>Site Map</h2>
			<a href="./">Home</a><br/>
			<a href="./job.php">Post a Task</a><br/>
			<a href="./main.php">Browse Tasks</a><br/>
			<a href="./about.php">About Us</a><br/>
      </div>
	  
	   <div class="lowerboxes">
			<h2 >New Here?</h2>
			<a  href="./sign_up2.php">Sign Up</a><br/>
			<a  href="./job.php">Post a Task</a><br/>
			<a  href="./rules.php">Markerplace Rules</a><br/>
			<a  href="./trust.php">Trust & Safety</a><br/>
      </div>
	  
	  <div class="lowerboxes">
			<h2 >Already A Member?</h2>
			<a  href="./login.php">Sign In</a><br/>
			<a  href="./job.php">Post a Task</a><br/>
			<a  href="./main.php">Browse Tasks</a><br/>
      </div>
	  
    </div>
	
  </div>
  <div class="lowerfooter" >
	<div>EasyTask &copy; 2013-2014  EasyTasks - All rights reserved</div>
  </div>
</footer>
</body>
</html>