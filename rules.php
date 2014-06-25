<?php
//============================================================+
// File name   : rules.php
//
// Description : eztasker.com  MarketPlace Rules
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
	$type=1;
	$title="Admin";  	
}
elseif(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$type=2;
	$title="Task Poster";  	
}
elseif(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Seeker";  	
}
else{
	$e='';
	$type=0;
	//header('location:login.php');die; //kill script
}
?>

<?php include ('./includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include './includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>
<!--Include Tooltips script-->
<?php require_once './includes/tooltip.php';?>
<br/><br/>
<div id="container" class="ltr">

<header id="header" class="info">
	<h2>MarketPlace Rules</h2>
</header>
<div class="main-content">
<h2>Create your Task Master account as a Task Poster or Task Worker. </h2>
<ul>
<li>Post the necessary tasks with your respective bid as a Task Poster.</li>
<li>Accept tasks that suit your requirements as the Task Worker.</li>
<li>Rate the task poster or task worker after the completion of the task.</li>
<li>Do not apply for tasks that cannot be done within the stipulated time, you will receive negative reps.</li>
<li>Do not try to renegotiate the price of the task after the job has been accepted. </li>
<li>Spamming with bogus tasks will lead to suspension or expulsion from the marketplace.</li>
<li>We will not be responsible for the quality of the tasks performed, accept or decline offers based on the reputation of the user.</li>
</ul></div>
<div class="sidebar"></div>
<div class="clear"></div>

</div>

<!-- login form ends -->	
	
<?php include('./includes/footer.php');?>