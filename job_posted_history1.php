<?php
//============================================================+
// File name   : job_posted_history1.php
//
// Description : Displays job posted history
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
}
elseif(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$type=2;
	$title="Task Poster";
	require_once './includes/db_config.php';
	connect();
	$q1 = "SELECT poster_id from poster_profile where email='".$e."'";
	$r1=mysql_query($q1) or die(mysql_error());
	$row1 = mysql_fetch_array($r1);
	$poster_id= $row1['poster_id'];	
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
if(isset($_GET['f']) && isset($_GET['v2'])){ 
       $v2=$_GET['v2'];       // getting value from url
	   $_GET['f']($v2);       //call to function del with parameter.
}	
function del($id2){           //function definition
require_once './includes/db_config.php';
$id2=trim($id2); 
$r1 = mysql_query("DELETE from task where task_id = '".$id2."' ")or die(mysql_error());
$r2 = mysql_query("SELECT name FROM photos WHERE task_id = '$id2' ")or die(mysql_error());
$row =mysql_fetch_array($r2);
@unlink('task-photos/'.$row['name']);
$r3 = mysql_query("DELETE from photos where task_id = '".$id2."' ")or die(mysql_error());
$r4 = mysql_query("DELETE from task_applied where task_id = '".$id2."' ")or die(mysql_error());
	
	if($r1 && $r2 && $r3 && $r4){
		echo "<script> alert('Task Deleted.') </script>" ;
		echo "<script>window.location='job_posted_history1.php'</script>" ;
	}else{
		echo "<script> alert('Error deleting this task') </script>" ;
		echo "<script>window.location='job_posted_history1.php'</script>" ;
	}
}
?>

<?php      //delete selected task photo- (metadata + photo)
if(isset($_GET['f2']) && isset($_GET['v3'])){ 
       $v3=$_GET['v3'];       // getting value from url
	   $_GET['f2']($v3);       // call to function del with parameter.
}	
function delphoto($id2){      //function definition
require_once './includes/db_config.php';
$id2=trim($id2); 
$r1 = mysql_query("SELECT name FROM photos WHERE task_id = '$id2' ")or die(mysql_error());
$row =mysql_fetch_array($r1);
@unlink('task-photos/'.$row['name']);
$r2 = mysql_query("DELETE from photos where task_id = '".$id2."' ")or die(mysql_error());
$r3 = mysql_query("update task set photo_flag=0 where task_id='".$id2."' ")or die(mysql_error());
	
	if($r1 && $r2 && $r3){
		echo "<script> alert('Image Deleted.') </script>" ;
		echo "<script>window.location='job_posted_history1.php'</script>" ;
	}else{
		echo "<script> alert('Error deleting this photo') </script>" ;
		echo "<script>window.location='job_posted_history1.php'</script>" ;
	}
}
?>




<?php 
if(isset($_REQUEST['v6'])){
	$t1=trim($_REQUEST['v6']); 
	$i=base64_decode($t1); 
	require_once './includes/db_config.php';
	connect();
	$q = "update task set status=1 where task_id='".$i."' ";
	mysql_query($q);
}
?> 



<?php   
require_once './includes/db_config.php';
connect();
if($type==1){
	$q3 ="SELECT * FROM task order by posted_date desc";
	$r3=mysql_query($q3);
	$total=mysql_num_rows($r3);
}
elseif($type==2){
	$q3 ="SELECT * FROM task where poster_id='".$poster_id."' order by posted_date desc";
	$r3=mysql_query($q3);
}
echo"<br>";
if($type==1){
	echo"<h3> All Tasks: Total $total tasks on TaskMaster..</h3><br/>";
}else{
	echo"<h2> Task Posted History </h2><br/>";
}
echo "<table rules='all' class='data-table'>";
echo"<tr>";
			echo"<th>&nbsp;#&nbsp</th>";
			echo"<th>Posted Date</th>";
			echo"<th>Deadline</th>";
			echo"<th>Task Category</th>";
			echo"<th>Task Title</th>";
			echo"<th>Task Description</th>";
			echo"<th>Task Location</th>";
			echo"<th>Payment</th>";
			echo"<th>Mode of Payment</th>";
			echo"<th>Photos</th>";
			if($type==1){
			echo"<th>Posted by</th>";
			}
			echo"<th>Applied by</th>";
			echo"<th>Status</th>";
			
			if($type==1){
			echo"<th>Action</th>";
			}
			
echo "</tr>";

	$count=1;
	while($row3=mysql_fetch_array($r3))
	{	
		echo"<tr>";
	
		    $url=$row3['task_id'];
		    $url2=$row3['poster_id'];
			//$url=base64_encode($row[0]); 
			//$url2=base64_encode($row[1]);
			
			$qr ="SELECT task_applied.task_id
				FROM task_applied,task	
				WHERE task_applied.task_id =task.task_id
				AND	accepted_flag=1
				AND task_applied.task_id='".$url."' ";
				$rs=mysql_query($qr);
				$applied=mysql_num_rows($rs);
			
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
			echo"<td>{$row3['posted_date']}</td>";
			echo"<td>{$row3['deadline']}</td>";
			echo"<td>{$category}</td>";
			echo"<td><a href=job_edit.php?v={$url} title='Click to Edit'>{$row3['title']}</a></td>";	
			echo"<td>{$row3['description']}</td>";
			echo"<td>{$row3['location']}</td>";
			echo"<td>{$payment}</td>";
			echo"<td>{$payment_mode}</td>";
			
			if($row3['photo_flag']==1){
			echo"<td><a title='Click to View Photo' href='photo2.php?v={$url}'><img src='images/view.gif' width='51px' height='16px'></a><br/><br/>";
				?><a href='job_posted_history1.php?f2=delphoto&v3=<?php echo $url;?>' onclick="return confirm('Are you sure?');"><img src='images/del.png' width='51px' height='16px'></a></td><?php					
			}else{
				echo"<td><a title='Upload Photo for this task' href='upload_photo.php?v={$url}'><img src='images/up.png' width='80px' height='20px'></a></td>";							
				}
			
			if($type==1){
					echo"<td><a title='click to view' href='poster_profile.php?v2={$url2}'><img src='images/clk.png' width='80px' height='20px'></a></td>";	
				}
		    
			
			if($applied>0){
				echo"<td>$applied Applied<br/><br/><a href='job_posted_history2.php?v={$url}' title='click to view'><img src='images/clk.png' width='80px' height='20px'></a></td>";	
			}
			else{
				echo"<td>No one applied</td>";	
			}
			
			if($row3['status']==1){
					echo"<td>Closed</td>";	
			}
			else{	
			    if($type==1){
					$url=base64_encode($row3[0]); 
					?><td><a href="job_posted_history1.php?v6=<?php echo $url;?>" onclick="return confirm('Are you sure you want to permanently close this task ?');"title='Click to Close'>Active</a></td><?php				
					}else{
							echo"<td>Active</td>";
						}					
				}
				
			if($type==1){
					//$url=base64_encode($row3[0]); 
					?>
						<td><a href='job_posted_history1.php?f=del&v2=<?php echo $row3[0];?>' onclick="return confirm('Are you sure?');"><img src="images/del.png" width="75px" height="15px"></a></td>
					<?php				
				}					
		echo "</tr>";
		$count++;
	}
		echo '</table>';
		echo '<table class="data-table"><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr></table>';

	
?>
<!-- footer -->
<?php include('./includes/footer.php');?>