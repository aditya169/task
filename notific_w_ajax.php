<?php
//============================================================+
// File name   : notific_w_ajax.php
//
// Description : Displays notification for worker account- ajax file
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
if(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Worker";
	require_once './includes/db_config.php';
	connect();
	$rs=mysql_query("select worker_id from worker_profile where email ='".$e."' ");
	$row=mysql_fetch_array($rs);
	$wid=$row['worker_id'];	
}
else{
	header('location:login.php');die; //kill script & jump to login page
}
?>
<?php
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$r=mysql_query("select * from task_applied,poster_profile 
					where  	task_applied.poster_id = poster_profile.poster_id
					AND		accepted_flag=1 
					And 	worker_id=$wid order by accepted_date desc");
	while($row=mysql_fetch_array($r)){
		$id=$row['id'];
		$pid=$row['poster_id'];
		$pname=$row['fname']." ".$row['lname'];
		$task_id=$row['task_id'];
		$date_time=$row['accepted_date'];
		$rs=mysql_query("select title from task where task_id=$task_id");
		$row5=mysql_fetch_array($rs);
		$task_title=$row5['title'];
		
		?>
		<div class="comment_ui" >
			<div class="comment_text">
				<div class="comment_actual_text">
					<a id="single" href="review_pprofile.php?v=<?php echo $pid;?>"><?php echo $pname;?></a>&nbsp;accepted your offer for task &nbsp;<a id="single" href="job_apply1.php?t=<?php echo $task_id;?>"><?php echo $task_title;?></a><h6><?php echo $date_time;?></h6>
					<a  id="accept"	href="notific_action.php?apid=<?php echo $id?>&action=read">View Details</a><br/><br/>
			</div>
		</div>
	</div>
<?php } 
}
?>