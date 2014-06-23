<?php
session_start();
if(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$type=2;
	$title="Task Poster";
	require_once './includes/db_config.php';
	connect();
	$rs=mysql_query("select poster_id from poster_profile where email ='".$e."' ");
	$row=mysql_fetch_array($rs);
	$pid=$row['poster_id'];	
}
else{
	header('location:login.php');die; //kill script & jump to login page
}
?>
<?php
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$r=mysql_query("select * from task_applied, worker_profile 
					where  	task_applied.worker_id = worker_profile.worker_id
					AND		accepted_flag=0 
					And 	poster_id=$pid order by id");
	while($row=mysql_fetch_array($r)){
		$id=$row['id'];
		$wid=$row['worker_id'];
		$wname=$row['fname']." ".$row['lname'];
		$comment=$row['comment'];
		$task_id=$row['task_id'];
		$date_time=$row['applied_date'];
		$rs=mysql_query("select title from task where task_id=$task_id");
		$row5=mysql_fetch_array($rs);
		$task_title=$row5['title'];

		?>

		<div class="comment_ui" >
			<div class="comment_text">
				<div class="comment_actual_text">
					<a  id="single" href="review_wprofile.php?v=<?php echo $wid;?>"><?php echo $wname;?></a>&nbsp;made offer for your task&nbsp;<a id="single" href="job_apply1.php?t=<?php echo $task_id;?>"><?php echo $task_title;?></a><br/>says,"<?php echo $comment; ?>"<h6><?php echo $date_time;?></h6>
					<a  id="cancle"	href="notific_action.php?apid=<?php echo $id?>&action2=decline">Decline</a>
					<a  id="accept"	href="notific_action.php?apid=<?php echo $id?>&action1=accept&wi=<?php echo $wid;?>">Accept</a><br/><br/>
			</div>
		</div>
	</div>
<?php } 
}
?>