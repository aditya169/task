<?php
session_start();
if(isset($_SESSION['li_uname111'])){
	$e=$_SESSION['li_uname111'];
	$type=1;
}
else{
	header('location:login.php');die; //kill script & jump to login page
}
?>
<!-- Header -->
<?php include('./includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include './includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>



<table class='main-table'>
<tr>
	<td><br/><h3><?php echo $title;?></h3></td>
</tr>
</table>


<table  class='main-table'>
<tr>
	<td><img src="images/front.jpg"></td>
</tr>
</table>

<?php include './includes/footer.php';?> 

