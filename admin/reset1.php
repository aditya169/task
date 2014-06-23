<?php 
	$e='';
	$type=0;
?>
<!-- Header -->
<?php include('./includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include './includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>

<br/><br/>
<div id="container" class="ltr">

<header id="header" class="info">
	<br/><h2>&nbsp;&nbsp;Reset Password</h2>
</header>



<?php
function goback(){
	echo'<br/><br/><a class="hyper" href="./login.php">&nbsp; &nbsp;Back to login page</a><br/><br/></div>';
}

echo'
<form action="reset2.php" method="get">
	<table class="login-table"  height="200">
		<tr>
			<td colspan=3>Enter your email address and your role. We will send an email with the link to reset your password.<br/></td>
		</tr>

		<tr>
			<td>Your Email Address<span class="imp">*</span> </td>
			<td><input type="text" name="email" placeholder="Your Email" size="40"></td>
		</tr>
		<tr>
		<td>Your Role<span class="imp">*</span> </td>
		<td>
			<select name="tp" >
				<option value="3">Task Worker &nbsp;&nbsp;</option>
				<option value="2">Task Poster &nbsp;&nbsp;</option>
			</select>
		
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="submit" value="Reset" /></td>
		</tr>
		<tr><td></td></tr>
	</table>
</form> ';

	goback();
?>

</div>
<br/><br/>
<!-- footer -->
<?php include('./includes/footer.php');?>