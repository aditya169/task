<?php
//============================================================+
// File name   : job_apply1.php
//
// Description : This file let the user to apply for the task.
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
if(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$type=2;
	$title="Task Poster";
}
elseif(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Worker";
}
else{
	//redirect to login page
	$e='';
	$type=0;
}
?>
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
	<br/><h2>&nbsp;&nbsp;Task Summary </h2>
</header>


<?php 
// Task_details + comment_option + include html_mail + include mail.php class
// $ref_id=base64_decode($_REQUEST['v']); 
if(isset($_REQUEST['t'])){ 	
	$task_id=trim($_REQUEST['t']);
	$url=$task_id;
}else{echo "<script>history.go(-1)</script>" ;}

require_once './includes/db_config.php';
connect();
$q1 ="SELECT  *	FROM task WHERE	task_id='".$task_id."'";
$r1=mysql_query($q1) or die(mysql_error());
$count=mysql_num_rows($r1);
if ($count <1){echo "<script>history.go(-1)</script>" ;}
$row = mysql_fetch_array($r1);
$poster_id=$row['poster_id'];
$url2=$poster_id;

	$q2 = "SELECT 	fname,lname,address,telephone,email FROM poster_profile WHERE poster_id='".$poster_id."'";   
	$r2=mysql_query($q2) or die(mysql_error());
	$row2 = mysql_fetch_array($r2);
	
	
if($row['category']==1){$category="Painting the fence";}
if($row['category']==2){$category="Mowing the lawn";}
if($row['category']==3){$category="Landscaping / gardening";}
if($row['category']==4){$category="Washing the dishes";}
if($row['category']==5){$category="Cleaning the bathroom";}
if($row['category']==6){$category="Changing light bulbs";}
if($row['category']==7){$category="Taking out the garbage";}
if($row['category']==8){$category="Laundry";}
if($row['category']==9){$category="Sweeping / dusting / vacuuming";}
if($row['category']==10){$category="Washing the car";}
if($row['category']==11){$category="Others";}
$job_title=$row['title'];
$description=$row['description'];
$deadline=$row['deadline'];
$location=$row['address'];
if($row['currency']==1){$currency="Rs";}
if($row['currency']==2){$currency="$";}
$payment = $currency." ".$row['payment']; 
if($row['payment_mode']==1){$payment_mode="Online";}
if($row['payment_mode']==2){$payment_mode="In Person";}
$posted_date=$row['posted_date'];
$photo_flag=$row['photo_flag'];


//poster's data
$fname=$row2['fname'];
$name=$fname." ".$row2['lname'];
$address=$row2['address'];
$telephone=$row2['telephone'];
$email=$row2['email'];
?>

<div class="maintaskinfo">

<form method="POST" action="job_apply2.php" >

<h1 class="tasktitlebig"><?php echo $job_title;?></h1>
<table class='login-table'>
	
	<tr>
		<td><input type="hidden" name="task_id" value="<?php echo $task_id;?>"></td>
		<td><input type="hidden" name="fname" value="<?php echo $fname;?>"></td>
	</tr>
  <tr>
	<td><strong>Category</strong></td>
	<td><?php echo $category;?> <input type="hidden" name="category" value="<?php echo $category;?>"></td>
  </tr>
  <tr>
	<td><strong>Title</strong></td>
	<td><?php echo $job_title?><input type="hidden" name="job_title" value="<?php echo $job_title;?>"></td>
  </tr>
  <tr>
	<td><strong>Description</strong></td>
	<td><textarea rows="4" cols="40" disabled> <?php echo $description?></textarea></td>
	<td><input type="hidden" name="description" value="<?php echo $description;?>"></td>
  </tr>
  <tr>
	<td><strong>Deadline</strong></td>
	<td><?php echo $deadline?><input type="hidden" name="deadline" value="<?php echo $deadline;?>"></td>
  </tr>
  <tr>
	<td><strong>Location</strong></td>
	<td><?php echo $location?><input type="hidden" name="location" value="<?php echo $location;?>"></td>
  </tr>
  <tr>
	<td><strong>Payment</strong></td>
	<td><?php echo $payment;?><input type="hidden" name="payment" value="<?php echo $payment;?>"></td>
  </tr>
  <tr>
	<td><strong>Mode of Payment</strong></td>
	<td><?php echo $payment_mode?><input type="hidden" name="payment_mode" value="<?php echo $payment_mode;?>"></td>
  </tr>
  <tr>
	<td><strong>Posted Date</strong></td>
	<td><?php echo $posted_date?><input type="hidden" name="posted_date" value="<?php echo $posted_date;?>"></td>
  </tr>
  
   <tr>
	<td><strong>Photos</strong></td>
	<?php
	
	if($photo_flag==1){
			echo"<td><a href=photo2.php?v={$url}><img src=images/view.gif width=60px height=20px></a></td>";					
		}else{
				echo"<td>N/A</td>";							
			}
	?>
  </tr>
  
  
  
  
   <tr><td colspan=2><br/><div class="hr"><hr /></div><br/></td><td></td></tr>
   <tr>
	<td><strong>Posted By</strong></td>
	<?php  
	if($type!==2) {
	echo"<td><a href='review_pprofile.php?v={$url2}'>{$name}</a></td>";
	}else{
		echo"<td>{$name}</td>";
	}
	?>
  </tr>
  <tr>
	<td><strong>Address</strong></td>
	<td><?php echo $address?><input type="hidden" name="email" value="<?php echo $email;?>">
	<input type="hidden" name="pid" value="<?php echo $poster_id;?>">
	</td>
  </tr>
  
   <?php if($type!==2) {?>
    <tr><td colspan=2><br/><div class="hr"><hr /></div><br/></td><td></td></tr>
	<tr>
		<td><strong>Comment</strong></td>
		<td><textarea name="comment" rows="4" cols="40"></textarea></td>
   </tr>
  </tr>
	<tr>
		<td></td>
		<td><input type="submit" name="make_offer" value="Make Offer"></td>
	</tr>
	 <?php }?>
	 <tr>
		<td>Share this task</td>
		<td>
		    <!-- Facebook Share plugin -->
		<a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),'facebook-share-dialog','width=626,height=436');return false;"><img src="images/facebook-icon.png" title="Share this task"></a>
		<!-- Google Plus Share plugin -->
		<a href="https://plus.google.com/share?url={http://eztasker.com/job_apply1.php?t=<?php echo $task_id;?>}" onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="images/google-plus-icon.png" alt="Share on Google+"/></a>	   
			<!-- Share via Email plugin -->
		<a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site http://eztasker.com/job_apply1.php?t=<?php echo $task_id;?>" title="Share by Email"><img src="images/mailicon.png" /></a>
			
			<!-- Twitter Share plugin -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://eztasker.com/job_apply1.php?t=<?php echo $task_id;?>" data-via="EasyTask" data-related="jasoncosta" data-lang="en" data-size="large"  data-count="none" data-text="Hi there! please visit the website & apply for this task.">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			
			 
			<!-- LinkedIn Share plugin -->						
		<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
		<script type="IN/Share" data-url="http://eztasker.com/job_apply1.php?t=<?php echo $task_id;?>" ></script>      
		
		    
		</td>
	</tr>
</table>
</form>
</div>
<div class="task-action"></div>
<div class="clear"></div>
</div>

<?php include('./includes/footer.php');?>