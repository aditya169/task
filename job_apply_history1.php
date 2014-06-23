<?php
session_start();
if(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Worker";
	require_once './includes/db_config.php';
	connect();
	$q1 = "SELECT worker_id from worker_profile where email='".$e."'";
	$r1=mysql_query($q1) or die(mysql_error());
	$row1 = mysql_fetch_array($r1);
	$worker_id= $row1['worker_id'];
}else{
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

<!--Include Tooltips script-->
<?php require_once './includes/tooltip.php';?>

<table class="data-table">
<tr><td>
<a href='javascript:history.go(-1)'><img src="images/back4.png" width="8%" height="4%"></a><br/><br/>   	   	   

<?php   
require_once './includes/db_config.php';
connect();

$q3 ="SELECT *
	  FROM task_applied, task
	  WHERE task_applied.task_id= task.task_id
	  AND   task_applied.worker_id='".$worker_id."' 
	  AND   accepted_flag=1 
	  order by applied_date desc ";
$r3=mysql_query($q3);
$count=mysql_num_rows($r3);
if ($count > 0){

echo"<br>";
echo "<div id=''>	";
if($count==1){$str="Task";}else{$str="Tasks";} //grammar
echo"<h2>You applied for $count $str.</h2><br>";
echo"</td></tr></table>";
echo "<table rules='all' class='data-table'>";
echo"<tr>";
			echo"<th>#</th>";
			echo"<th>Applied Date</th>";
			echo"<th>Comments</th>";
			echo"<th>Task Category</th>";
			echo"<th>Task Title</th>";
			echo"<th>Task Description</th>";
			echo"<th>Deadline</th>";
			echo"<th>Task Location</th>";
			echo"<th>Payment</th>";
			echo"<th>Mode of Payment</th>";
			echo"<th>Posted Date</th>";
			echo"<th>Photos</th>";
			//echo"<th>Status</th>";
			echo"<th>Posted by</th>";
echo "</tr>";

	$count=1;
	while($row3=mysql_fetch_array($r3))
	{	
		echo"<tr>";
		   //$url=base64_encode($row['auto_id']);
		    $url=$row3['task_id'];
			$url2=$row3['poster_id'];
			
if($row3['category']==1){$category="Painting the fence";}
if($row3['category']==2){$category="Mowing the lawn";}
if($row3['category']==3){$category="Landscaping / gardening";}
if($row3['category']==4){$category="Washing the dishes";}
if($row3['category']==5){$category="Cleaning the bathroom";}
if($row3['category']==6){$category="Changing light bulbs";}
if($row3['category']==7){$category="Taking out the garbage";}
if($row3['category']==8){$category="Laundry";}
if($row3['category']==9){$category="Sweeping / dusting / vacuuming";}
if($row3['category']==10){$category="Washing the car";}
if($row3['category']==11){$category="Others";}

if($row3['currency']==1){$currency="Rs";}
if($row3['currency']==2){$currency="$";}
$payment = $currency." ".$row3['payment']; 
if($row3['payment_mode']==1){$payment_mode="Online";}
if($row3['payment_mode']==2){$payment_mode="In Person";}	
		
		
			echo"<td>{$count}.</td>";
			echo"<td>{$row3['applied_date']}</td>";
			echo"<td>{$row3['comment']}</td>";
			echo"<td>{$category}</td>";
			echo"<td>{$row3['title']}</td>";
			echo"<td>{$row3['description']}</td>";
			echo"<td>{$row3['deadline']}</td>";
			echo"<td>{$row3['location']}</td>";
			echo"<td>{$payment}</td>";
			echo"<td>{$payment_mode}</td>";
			echo"<td>{$row3['posted_date']}</td>";
            if($row3['photo_flag']==1){
				echo"<td><a title='View Photo' href=photo2.php?v={$url}><img src=images/view.gif width=60px height=20px></a></td>";					
			}else{
				echo"<td>N/A</td>";							
				}
			
			echo"<td><a title='Click to view' href='review_pprofile.php?v={$url2}'><img src='images/clk.png' width='80px' height='20px'></a></td>";	
			
					
		echo "</tr>";
		$count++;
	}
		echo '</table>';
		echo '<table class="data-table"><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr></table>';
		
		echo"</div>";
}
else{
	echo"<table class='data-table'><tr><td>&nbsp;</td><td><h2>You have offered for no task yet.</h2></td></tr></table><br>";

}
?>

<?php include('./includes/footer.php');?>