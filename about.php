<?php
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
	<p>&nbsp;</p>
	<div>What is EasyTask?</div>
	<div><br clear="none" />
    </div>
	<div>EasyTask connects neighbours to get things done. Since the start of this century, the lives of people have become quite hectic and they rarely get enough time to do their daily chores.But again there are few who feel that they do not have enough work, and they look for possibilities to end their boredom or earn their living by doing some easy-to-do jobs. Taskmaster aims to connect these two sets of people. It eases the burden of those who are under work-pressure and at the same time it provides a channel to earn money.</div>
	<div><br />
    </div>
	<div>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	</div>
	<div><br />
    </div>
	<div></div>
	<div><br />
    </div>
	<div>How it works?</div>
	<div>You'll have to first create an account on our website by providing your andrew e-mail id. Once registered, you will have access to a wide database of small jobs that is available in your area and elsewhere. You could also post jobs that you would like to get done within a certain time frame. If someone shows interest on your posted job, you'll receive a notification on your registered mail. </div>
	<p>&nbsp;</p>
</header>
<div class="main-content"></div>
<div class="sidebar"></div>
<div class="clear"></div>

</div>

<!-- login form ends -->	
	
<?php include('./includes/footer.php');?>