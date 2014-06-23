<?php
session_start();
if(isset($_SESSION['li_uname111'])){
	$e=$_SESSION['li_uname111'];
	$type=1;	
}
elseif(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$email=$e;
	$type=2;
	$title="Task Poster";
}
elseif(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Worker";
}
else{
		$e='';
		$type=0;
		header('location:login.php');die;//redirect to login page
}
?>

<?php include('./includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include './includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>


<?php
require_once './includes/db_config.php';
	connect();
	if($type==2){
		$q = "SELECT * FROM poster_profile WHERE  email='".$email."'";
		profile($q);
	}
	elseif($type==3 || $type==1){
		if(isset($_REQUEST['v'])){
			$pi=trim($_REQUEST['v']);
			$poster_id=$pi; 
			$q = "SELECT * FROM   poster_profile WHERE  poster_id='".$poster_id."'";	
			profile($q);
		}else{
					echo "<script>history.go(-1)</script>" ;
				}
	}
?> 
<?php
function profile($q){
	$r=mysql_query($q) or die(mysql_error());
	$count=mysql_num_rows($r);
	if ($count > 0){
		$row = mysql_fetch_array($r);
		$name=$row['fname']." ".$row['lname'];
		$gender=$row['gender'];
		$city=$row['location'];
		$address=$row['address'];
		$fulladd=$address.", ".$city;
		$telephone=$row['telephone'];
		$email=$row['email'];
		$created=$row['created'];
		$poster_id=$row['poster_id'];
		$url2=$poster_id; 
		$auth_id=$row[1]; 

?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<div id="content">
<table class="main-table" >
<tr><td>
<a href='javascript:history.go(-1)'><img src="images/back4.png" width="8%" height="4%"></a><br/><br/>   	   	   

<table  class="main-table">
	<tr><td><img src="https://graph.facebook.com/<?php echo $auth_id; ?>/picture"><br/><h2><?php echo $name;?></h2></td></tr>
	<tr><td colspan=2><div class="hr"><hr /></div><br/></td></tr>
	<tr><td><strong>Email</strong></td><td><?php echo $email;?></td></tr>
	<tr><td><strong>Telephone</strong></td><td><?php echo $telephone;?></td></tr>
	<tr><td><strong>Address</strong></td><td><?php echo $fulladd;?></td></tr>
	<tr><td><strong>Gender</strong></td><td><?php echo $row['gender'];?></td></tr>
	<tr><td><strong>Joined</strong></td><td><?php echo $created;?></td></tr>
	<tr><td><strong>Reviews</strong></td><td><?php echo"<a href=reviews_write.php?pi={$url2} title='view'>View</a></td>";	
?></td></tr>
</table>
</td></tr>
</table>
</div>
<?php 
		}else{
				echo "<script>history.go(-1)</script>" ;
		}
	} 
?>
<?php include('./includes/footer.php');?>