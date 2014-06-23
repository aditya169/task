<?php
session_start();
if(isset($_SESSION['li_uname111'])){
	header('Location:../admin_home.php');   // jump to home page
}
elseif(isset($_SESSION['li_uname222'])){
	header('Location:../main.php'); 	
}
elseif(isset($_SESSION['li_uname333'])){
	header('Location:../main.php'); 
}
else{
	$e='';
	$type=0;	
}
?>

<?php include ('../includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include '../includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>


<form  method="post" action="./admin/login.php">
<center>
<table class="main-table" width="95%" height="500px">
<tr><td>
<center><br><strong>Administrator Login</strong><br><br>

<table  width="46%">
<tr>
	<td><strong>Email</strong></td>
	<td><input type="textbox" name="username" placeholder="Your email" size="30"></td>
</tr>
<tr>
	<td><strong>Password</strong></td>
	<td><input type="password" name="password" placeholder="**************" size="30"></td>
</tr>
<tr>
	<td colspan="2">
		<center><input id="submit1" type="submit" name="submit" value="Log In"></center>
	</td>
</tr>
</table>
</form>

<table ><br>
	<!--<tr><td><a href="admin/reset1.pdp"  style="text-decoration: none">Lost your password ?</a></td></tr> -->
</table>
</center>
</td></tr>
</table>

<!-- login form ends -->
	
<!-- footer -->
<?php include('../includes/footer.php');?>