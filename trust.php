<?php
//============================================================+
// File name   : trust.php
//
// Description : Trust and Safety
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
	<h2>About EasyTask</h2>
</header>
<div class="main-content">
  <p>&nbsp;</p>
  <p>Trust &amp; Safety    </p>
  <p>1. We ensure trusted interactions between helpers and people in need with review and vetting of work done. </p>
  <p>2. Feedback on work done with star rating for task doers. </p>
  <p>3. Vetting of task post and actual work given - rating for task posters</p>
</div>
<div class="sidebar"></div>
<div class="clear"></div>

</div>

<!-- login form ends -->	
	
<?php include('./includes/footer.php');?>