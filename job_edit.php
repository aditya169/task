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


<!-- Header -->
<?php include('./includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include './includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>



<?php
if(isset($_POST['submit'])){

$id=trim($_POST["id"]);
$job_title=trim($_POST["job_title"]);
$description=trim($_POST["description"]);

//validating
if($job_title == "" ) {
$error= "error : Please enter task title";
$code= "2";
}
elseif($description == "" ) {
$error= "error : Please enter task description.";
$code= "3";
}

else{
//final code will execute here.

require_once './includes/db_config.php';
connect();
$query1 = "update task set title='".$job_title."' , description='".$description."'
		   where task_id='".$id."' ";
			
$result1=mysql_query($query1);
if($result1){
		 echo "<script> alert('Task Updated') </script>" ;
		 echo "<script> window.location='job_posted_history1.php'</script>";
	}else{
			echo"Oops! Something went wrong!";
	}
 }
}
?>

<?php
if(isset($_REQUEST['v'])){ 	
		$id=trim($_REQUEST['v']); 
		//$id=base64_decode($t1); 
		require_once './includes/db_config.php';
		connect();
		$query=" Select * from task where task_id='".$id."' ";
		$result=mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_array($result);
		
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
$location=$row['location'];
if($row['currency']==1){$currency="Rs";}
if($row['currency']==2){$currency="$";}

if($row['task_method']==1){$task_method="Yes";}
if($row['task_method']==0){$task_method="No";}
$payment = $currency." ".$row['payment']; 
if($row['payment_mode']==1){$payment_mode="Online";}
if($row['payment_mode']==2){$payment_mode="In Person";}
$posted_date=$row['posted_date'];
	
}else{echo "<script>history.go(-1)</script>" ;}
?>	

<form name= "info" id= "info" method= "post" action= "" >
<center>
<table class='main-table'>
<tr>
    <td>
    <table class='main-table'>
      <!-- table column for Genreal Information -->
        </br><h2 align="center"><i><u>Edit Task Description</u></i></h2>
		<tr>
			<td><input type="hidden" name="id" value="<?php echo $row[0];?>"></td>
			<td><?php if (isset($error)){echo'<p class=message >' .$error. ' <br></p>';} ?></td>
		</tr>
		
		<tr>
			<td>Category</td>
			<td><?php echo $category;?></td>
		</tr>
		 
        <tr>
			<td><label for="job_title">*Title</label></td>&nbsp;
			<td><input type='text' name='job_title' size=40 placeholder='Enter task title'   value="<?php echo $job_title?>" <?php if(isset($code) && $code ==2){echo "class=error" ;} ?> >
	    </tr>
		
		<tr>
			<td>*Description</td>&nbsp;
			<td><textarea name='description' rows=10 cols=50  <?php if(isset($code) && $code ==3){echo "class=error" ;} ?> > <?php echo $description;?></textarea></td>
		</tr>	
		<tr>
			<td>*I need this task done by</td>&nbsp;
			  <td><?php echo $deadline;?></td> 	
		
	    </tr>
		<tr>
			<td>*Location</td>&nbsp;
			<td><?php echo $location;?></td> 	
	    </tr>
		
        <tr>
			<td>Can this task be done on phone or online?</td>&nbsp;
		<td><?php echo $task_method;?></td> 	
        </tr>
        <tr>
			<td>*How much will you be paying for the task?</td>&nbsp;
			<td><?php echo $payment;?></td> 	
		</tr>
		
		<tr>
            <td>*Mode of Payment</td>&nbsp;
       	<td><?php echo $payment_mode;?></td> 		
        </tr>
		 <td></br></td>
	    </tr>
	 
	</table>
	<br><br>
  <tr>
    <td align='center'>
	  <input type='submit' name="submit" value='Save'>&nbsp;&nbsp;
      <input type='Reset' value='Reset'>
	</td>
  </tr>
  
    </td></tr>
</table>
<center>
</form>


<!-- footer -->
<?php include('./includes/footer.php');?>