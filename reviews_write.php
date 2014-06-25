<?php
//============================================================+
// File name   : reviews_write.php
//
// Description : This file let the user to write a review.
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
	$r8 = mysql_query("SELECT  poster_id FROM poster_profile WHERE email = '$e' ")or die(mysql_error());
	$row8 =mysql_fetch_array($r8);
	$pid=$row8['poster_id'];
}
elseif(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Worker";	
	require_once './includes/db_config.php';
	connect();
	$r8 = mysql_query("SELECT worker_id FROM worker_profile WHERE email = '$e' ")or die(mysql_error());
	$row8 =mysql_fetch_array($r8);
	$wid=$row8['worker_id'];
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

<table class="main-table"><tr><td>
<a href='javascript:history.go(-1)'><img src="images/back4.png" width="8%" height="4%"></a><br/><br/>   	   	   
</td></tr></table>
<?php
require_once './includes/db_config.php';
connect();

//poster to worker
if(isset($_REQUEST['wi'])) {
	$wid=$_REQUEST['wi'];
	$wid=trim($wid);
	$r2 = mysql_query("SELECT fname FROM worker_profile WHERE worker_id = '$wid' ")or die(mysql_error());
	$row2 =mysql_fetch_array($r2);
	$wn=$row2['fname'];
			
	$q ="SELECT * FROM reviews, poster_profile
		WHERE  reviews.poster_id=poster_profile.poster_id
        AND	 type=3 
		AND	 worker_id='".$wid."'";
		
		$r=mysql_query($q) or die(mysql_error());
		$count=mysql_num_rows($r);
		
		echo "<table class='main-table'>";
		if ($count > 0){
			if($count==1){$str="Review";}else{$str="Reviews";} //grammar
		
		echo"<tr>";
			echo"<td colspan=4><br><h2>Total $count $str. </h2></br></td>";
		echo "</tr>";
		echo"<tr><td colspan=4><div class='hr'><hr /></td></tr>";	
		
		$c=1;
		while($row=mysql_fetch_array($r))
		{	
		echo"<tr>";
			$poster_id=$row['poster_id'];
			$rid=$row['rid'];
			echo"<td>{$c}.</td>";
			$name=$row['fname']." ".$row['lname'];
			if($poster_id==$pid ){$name="You";}
			echo"<td><strong>{$name}</strong> wrote @{$wn}<br/><br/>";	
			echo"<textarea  disabled rows=4 cols=100>{$row['review']}-{$row['date']}</textarea></td>";
		echo "</tr>";
		
		if($poster_id==$pid ){	
			echo"<tr>";
				?><td><a href='reviews_write.php?wi=<?php echo $wid;?>&f2=delreview&v3=<?php echo $rid;?>' onclick="return confirm('Are you sure?');"><img src='images/del.png' width='51px' height='16px'></a></td><?php	
				
			echo "</tr>";
		}
		echo"<tr><td colspan=4><div class='hr'><hr /></td></tr>";
		$c++;
		}
			
	}else{
			echo"<tr><td colspan=4><h3>No Review</h3></td></tr>";
		}
	
		$q3 ="SELECT *FROM task_applied
			  WHERE poster_id= '".$pid."'
			  AND   worker_id='".$wid."'
			  AND   accepted_flag=1";

		$r3=mysql_query($q3);
		$cnt=mysql_num_rows($r3);
		if ($cnt > 0){
			// allow them to write a review.
			write_review($pid,$wid,3);
		
		}else{ tag();}
}
//Worker to poster
elseif(isset($_REQUEST['pi'])){

	$pid=(int)$_REQUEST['pi'];
	$pid=trim($pid);
	$r2 = mysql_query("SELECT * FROM poster_profile WHERE poster_id = '$pid' ")or die(mysql_error());
	$row2 =mysql_fetch_array($r2);
	$pn=$row2['fname'];
			
	$q ="SELECT * FROM reviews, worker_profile
		WHERE  reviews.worker_id=worker_profile.worker_id
		AND	 type=2 			  
		AND	  poster_id='".$pid."'";
		
		$r=mysql_query($q) or die(mysql_error());
		$count=mysql_num_rows($r);
		echo "<table class='main-table'>";
		
		if ($count > 0){
			if($count==1){$str="Review";}else{$str="Reviews";} //grammar
		
		echo"<tr>";
			echo"<td colspan=4><br><h2>Total $count $str. </h2></br></td>";
		echo "</tr>";
		echo"<tr><td colspan=4><div class='hr'><hr /></td></tr>";	
		
		$c=1;
		while($row=mysql_fetch_array($r))
		{	
		echo"<tr>";
			$worker_id=$row['worker_id'];
			$rid=$row['rid'];
			echo"<td>{$c}.</td>";
			$name=$row['fname']." ".$row['lname'];
			if($worker_id==$wid ){$name="You";}
			echo"<td><strong>{$name}</strong> wrote @{$pn}<br/><br/>";	
			echo"<textarea  disabled rows=4 cols=100>{$row['review']}-{$row['date']}</textarea></td>";
		echo "</tr>";
		
		if($worker_id==$wid ){	
			echo"<tr>";
			
				?><td><a href='reviews_write.php?pi=<?php echo $pid;?>&f2=delreview&v3=<?php echo $rid;?>' onclick="return confirm('Are you sure?');"><img src='images/del.png' width='51px' height='16px'></a></td><?php	
				
			echo "</tr>";
		}
		echo"<tr><td colspan=4><div class='hr'><hr /></td></tr>";
		$c++;
		}
	}else{
			echo"<tr><td colspan=4><h3>No Review</h3></td></tr>";
		}
	
		$q3 ="SELECT *FROM task_applied
			  WHERE poster_id= '".$pid."'
			  AND   worker_id='".$wid."'
			  AND   accepted_flag=1";

		$r3=mysql_query($q3);
		$cnt=mysql_num_rows($r3);
		if ($cnt > 0){
			// allow them to write a review.
				write_review($pid,$wid,2);
		}else{ tag();}
		
	}
	
else{
	echo"<script> function goBack(){window.history.back()} goBack(); </script>";

}
?> 


<?php      //delete review
if(isset($_GET['f2']) && isset($_GET['v3'])){ 
       $v3=$_GET['v3'];       // getting value from url
	   $_GET['f2']($v3);       // call to function del with parameter.
}	
function delreview($id2){      //function definition
require_once './includes/db_config.php';
$id2=trim($id2); 
$r2 = mysql_query("DELETE from reviews where rid = '".$id2."' ")or die(mysql_error());

	if($r2){
		echo "<script> alert('Review Deleted.') </script>" ;
		echo"<script> function goBack(){window.history.back()} goBack(); </script>";
	}else{
		echo "<script> alert('Error deleting this review.') </script>" ;
		echo"<script> function goBack(){window.history.back()} goBack(); </script>";
	}
}
?>


<?php
function write_review($pid,$wid,$type){
?>
<form method="POST" action="reviews_save.php" >
	<tr>
		<td><strong>Write a Review</strong></td>
		<td><textarea name="review" rows="4" cols="65"></textarea></td>
		<td><input type="hidden" name="pid" value="<?php echo $pid?>"></td>
		<td><input type="hidden" name="wid" value="<?php echo $wid?>"></td>
		<td><input type="hidden" name="type" value="<?php echo $type?>"></td>
   </tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="OK"></td>
	</tr>
</table>
</form>
<?php
} 
?>

<?php
function tag(){echo"</table>";}
?>

<?php include('./includes/footer.php');?>