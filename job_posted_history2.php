<?php
session_start();
if(isset($_SESSION['li_uname111'])){
	$e=$_SESSION['li_uname111'];
	$type=1;	
}
elseif(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$type=2;
	$title="Task Poster";
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



<table class="main-table">
<tr><td>
<a href='javascript:history.go(-1)'><img src="images/back4.png" width="8%" height="4%"></a><br>   	   	   

<?php
if(isset($_REQUEST['v'])){
			$task_id=(int)$_REQUEST['v'];
			$task_id=trim($task_id);
	}else{
			echo "<script>history.go(-1)</script>" ;
		}


require_once './includes/db_config.php';
connect();
$q3 ="SELECT *
	  FROM task_applied, worker_profile 	
	  WHERE task_applied.worker_id =worker_profile.worker_id
	  AND	accepted_flag=1
	  AND   task_applied.task_id='".$task_id."' ";

$r3=mysql_query($q3);
$count=mysql_num_rows($r3);
if ($count > 0){

if($count==1){$str="Candidate";}else{$str="Candidates";} //grammar
echo"<br><h2>$count $str applied for this post.</h2></br>";
echo"</td></tr></table>";

echo "<table rules='all'  class='main-table' >";
echo"<tr>";
			
			echo"<th>#</th>";
			echo"<th>Applied by</th>";
			echo"<th>Comments</th>";
			echo"<th>Applied Date</th>";
			//echo"<th>Gender</th>";
			//echo"<th>Address</th>";
			//echo"<th>Telephone</th>";
			//echo"<th>Email</th>";
			

echo "</tr>";

	$count=1;
	while($row=mysql_fetch_array($r3))
	{	
		echo"<tr>";
		   //$url=base64_encode($row['auto_id']);
	$name=$row['fname']." ".$row['lname'];
	$address=$row['address'];
	$telephone=$row['telephone'];
	$email=$row['email'];
	if($row['gender']==1){$gen="Male";}else{ $gen="Female";}
			
			echo"<td>{$count}.</td>";
			echo"<td><a href=review_wprofile.php?v={$row['worker_id']} title='view'>{$name}</a></td>";	
			//echo"<td>{$gen}</td>";
			//echo"<td>{$address}</td>";
			//echo"<td>{$telephone}</td>";
			//echo"<td>{$email}</td>";
			echo"<td>{$row['comment']}</td>";
			echo"<td>{$row['applied_date']}</td>";
		echo "</tr>";
		$count++;
	}
		echo '</table>';
		echo '<table class="main-table"><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr></table>';

}else{

echo"<table class='main-table'><tr><td>&nbsp;</td><td><h2>No one is applied yet for this post.</h2></td></tr></table><br>";
echo '<table class="main-table"><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr></table>';

}
?>
<!-- footer -->
<?php include('./includes/footer.php');?>