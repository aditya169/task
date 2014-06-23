<?php
session_start();
if(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$type=2;
	$title="Task Poster";
    require_once './includes/db_config.php';
	connect();
	$query ="SELECT poster_id,location,address from poster_profile where email ='".$e."' ";
	$result=mysql_query($query) or die(mysql_error());
	if($result){
		$row=mysql_fetch_array($result);
		$poster_id=$row['poster_id'];
		$city=$row['location'];
		$address=$row['address'];
	}		   	
}
else{
	$e='';
	$type=0;
	header('location:login.php');die; //kill script
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
$lat1=40.4447;   	//default lattitude (pitts)
$lang1=-79.9438;	//default longitude (pitts)
if(isset($_POST['submit'])){

$address1=trim($_POST["autocomplete"]);
$lat1=trim($_POST["lat1"]);			//dragged lattitude 
$lang1=trim($_POST["lang1"]);		//dragged longitude 
$city1=trim($_POST["locality"]);
$category=trim($_POST["category"]);
$job_title=trim($_POST["job_title"]);
$description=trim($_POST["description"]);
$deadline=trim($_POST["deadline"]);
$chk=(isset($_POST['chk']))?1:0;
$task_method=(isset($_POST['task_method']))?1:0;
$currency=trim($_POST["currency"]);
$payment=trim($_POST["payment"]);
$payment_mode=trim($_POST["payment_mode"]);
$today = mktime(0,0,0,date("m"),date("d"),date("Y"));
$date = date("m/d/y", $today);

//validating inputs

if($address1 =="" ) {
$error= "error : You did not enter task location.";
$code= "1";
}
elseif($city1 =="" ) {
$error= "error : You did not enter city.";
$code= "2";
}
elseif($category == "" ) {
$error= "error : You did not select task category.";
$code= "3" ;
}
elseif($job_title == "" ) {
$error= "error : Please enter task title";
$code= "4";
}
elseif($description == "" ) {
$error= "error : Please enter task description.";
$code= "5";
}
elseif($deadline == "" ) {
$error= "error : Please enter deadline.";
$code= "6";
}
elseif($currency == "" ) {
$error= "error : You did not select currency.";
$code= "7";
}
elseif($payment == "" ) {
$error= "error : Please enter payment.";
$code= "8";
}
elseif($payment_mode == "" ) {
$error= "error : Please choose mode of payment.";
$code= "9";
}
else{

//final code will execute here.
require_once './includes/db_config.php';
connect();
$query1= "insert into task values('','$poster_id','$type','$category','$job_title','$description','$deadline','$city1','$address1','$task_method','$currency',$payment,'$payment_mode','$date','0','0')";
$result1=mysql_query($query1);
$task_id = mysql_insert_id();     // to get the last inserted auto_id

//adding image-file record
if($_FILES['files']['size'] > 0 ){
	
		require_once './includes/mysqlidb_config.php';
        //Gather all required data
		$allowedExts = array("gif", "jpeg","jpg", "png");
		$temp = explode(".", $_FILES["files"]["name"]);
		$extension = end($temp);
		if ((($_FILES["files"]["type"] == "image/gif") 
		|| ($_FILES["files"]["type"] == "image/jpeg") 
		|| ($_FILES["files"]["type"] == "image/jpg") 
		|| ($_FILES["files"]["type"] == "image/pjpeg") 
		|| ($_FILES["files"]["type"] == "image/x-png") 
		|| ($_FILES["files"]["type"] == "image/png")) 
		&& in_array($extension, $allowedExts))
		{
		if ($_FILES["files"]["error"] > 0){
			echo "Return Code: " . $_FILES["files"]["error"] . "<br>";
		}
		else{
			$name = $dbLink->real_escape_string($_FILES['files']['name']);
			$mime = $dbLink->real_escape_string($_FILES['files']['type']);
			//$data = $dbLink->real_escape_string(file_get_contents($_FILES['files']['tmp_name']));
			$size = intval($_FILES['files']['size']);
			$random_digit=rand(0000,9999);
			$new_name=$random_digit.$name;
			$target = "task-photos/";
			$target = $target.$new_name; 
		
			$query2 = "insert into photos values('','$task_id','$new_name','$mime','$size',NOW())";		
			$result2 = $dbLink->query($query2);
				if($result2){
					move_uploaded_file($_FILES['files']['tmp_name'],$target);
					$query3 = "update task set photo_flag=1 where task_id='".$task_id."' ";		
					$result3 = $dbLink->query($query3);
				}
			}
		
		}else{
			echo "<script> alert('Invalid File. You can also upload images later from task posted history.') </script>" ;
		}	
	}     //else{ alert('please choose img file.');}
		
	if($result1){
				echo "<script> alert('Your task has been posted.') </script>" ;
				echo "<script>window.location='job_posted_history1.php'</script>" ;
			}else{
					echo"Oops! Something went wrong!";
				}
 }
}
?>


<script>
// fill home address upon checkbox checked.
$(document).ready(function(){
	$("#chk").click(function(){		
		if($(this).is(":checked")){
			$("#locality").val("<?php echo $city;?>");
			$("#autocomplete").val("<?php echo $address;?>");
			$("#locality").css("background-color","#cccccc");
			$("#autocomplete").css("background-color","#cccccc");
			$("#locality").attr("readonly" , "readonly");
			$("#autocomplete").attr("readonly" , "readonly");
		}else{
			$("#locality").val("");
			$("#autocomplete").val("");
			$("#locality").css("background-color","#ffffff");
			$("#autocomplete").css("background-color","#ffffff");
			$("#locality").removeAttr("readonly");
			$("#autocomplete").removeAttr("readonly");
        }
	}); 
});
</script>
<!--Include Tooltips script-->
<?php require_once './includes/tooltip.php';?>

<center>
<table class='main-table'>
<tr>
    <td>
	<form name= "info" method= "post" action= ""  enctype="multipart/form-data">
    <table class='main-table'>
      <!-- table column for Genreal Information -->
        </br><h2 align="center"><i><u>Task Description</u></i></h2>
		<tr>
			<td></td>
			<td><?php if (isset($error)){echo'<p class=message >' .$error. ' <br></p>';} ?></td>
		</tr>	
		<tr>
			<td><strong>*Drag marker to your task location</strong><?php include('./lib/drag-locator-map.php');?>
				<br/><br/>
				<div id="infoPanel">
				<b>Marker status:</b><div id="markerStatus"><i>Click and drag the marker.</i></div>
				<div id="info"></div>
				</div>
			</td>
			<td>
				<div id="mapCanvas"></div>
			</td>
		</tr>
		
		<tr>
			<td><strong>*Task Location</strong></td>
			<td><input type="text" id="autocomplete" name="autocomplete" size="100" title="To fill the task location drag map marker to your task location " value="<?php if(isset($address1)){echo $address1;} ?>" <?php if(isset($code) && $code ==1){echo "class=error" ;} ?> /></td>
			<input type="hidden" id="lat1" name="lat1">
			<input type="hidden" id="lang1" name="lang1">
		</tr>
		<tr>
			<td><strong>*Task City</strong></td>
			<td>
				<input type="text" id="locality" name="locality"  size="40" title="Type Task city" value="<?php if(isset($city1)){echo $city1;} ?>" <?php if(isset($code) && $code ==2){echo "class=error" ;} ?> />
				Or Same as home address? 
				<input type="checkbox" id="chk" name="chk"<?php if(isset($chk) && $chk ==1){echo "checked";}?>>
			</td>	
	    </tr> 
		
		<tr>
            <td><label for="category"><strong>*Task Category</strong> </label></td>&nbsp;
            <td><select name="category" <?php if(isset($code) && $code ==3){echo "class=error" ;} ?> >
                <option value="">Select Task Category</option>
				<option value="1" <?php if(isset($category) && $category ==1){echo "selected";}?>>Painting the fence</option>  
                <option value="2" <?php if(isset($category) && $category ==2){echo "selected";}?>>Mowing the lawn</option>
                <option value="3" <?php if(isset($category) && $category ==3){echo "selected";}?>>Landscaping / gardening</option>
                <option value="4" <?php if(isset($category) && $category ==4){echo "selected";}?>>Washing the dishes</option>
                <option value="5" <?php if(isset($category) && $category ==5){echo "selected";}?>>Cleaning the bathroom</option>
                <option value="6" <?php if(isset($category) && $category ==6){echo "selected";}?>>Changing light bulbs</option>
                <option value="7" <?php if(isset($category) && $category ==7){echo "selected";}?>>Taking out the garbage</option>
                <option value="8" <?php if(isset($category) && $category ==8){echo "selected";}?>>Laundry</option>
                <option value="9" <?php if(isset($category) && $category ==9){echo "selected";}?>>Sweeping / dusting / vacuuming</option>
                <option value="10"<?php if(isset($category) && $category ==10){echo "selected";}?>>Washing the car</option>	  
                <option value="11"<?php if(isset($category) && $category ==11){echo "selected";}?>>Others</option>	  
              </select>
			  </td> 		
        </tr>
		 
        <tr>
			<td><label for="job_title"><strong>*Task Title</strong></label></td>&nbsp;
			<td><input type='text' name='job_title' size=40 title='Enter Task title' value="<?php if(isset($job_title)){echo $job_title;} ?>" <?php if(isset($code) && $code ==4){echo "class=error" ;} ?> >
	    </tr>
		
		<tr>
			<td><strong>*Task Description</strong></td>&nbsp;
			<td><textarea name='description' title='fill Task Description' rows=10 cols=50  <?php if(isset($code) && $code ==5){echo "class=error" ;} ?> ><?php if(isset($description)){echo $description;} ?></textarea></td>
		</tr>	
		
		<tr>
			<td><strong>*I need this task done by</strong></td>&nbsp;
			<td><input type='text' id="datepicker" name='deadline' size=40  value="<?php if(isset($deadline)){echo $deadline;} ?>" <?php if(isset($code) && $code ==6){echo "class=error" ;} ?> >
			<script>$(document).ready(function(){$( "#datepicker" ).datepicker();});</script></td>
	    </tr>
		
        <tr>
			<td><strong>Can this task be done on phone or online?</strong></td>&nbsp;
			<td><input type='checkbox' name='task_method' <?php if(isset($task_method) && $task_method ==1){echo "checked";}?>></td>
        </tr>
        <tr>
			<td><strong>*How much will you be paying for the task?</strong></td>&nbsp;
			<td>
				<select name="currency" <?php if(isset($code) && $code ==7){echo "class=error" ;} ?> >
					<option value="">Currency</option>
					<option value="1" <?php if(isset($currency) && $currency ==1){echo "selected";}?>>Rs.</option>
					<option value="2" <?php if(isset($currency) && $currency ==2){echo "selected";}?>>$</option>
				</select>
				<input type='text' name='payment' size='25' title='Enter payment' value="<?php if(isset($payment)){echo $payment;} ?>" <?php if(isset($code) && $code ==8){echo "class=error" ;} ?> >
	       </td>
		</tr>
		
		<tr>
            <td><strong>*Mode of Payment</strong></td>&nbsp;
            <td>
				<select name="payment_mode" <?php if(isset($code) && $code ==9){echo "class=error" ;} ?> >
					<option value="">Select</option>
					<option value="1" <?php if(isset($payment_mode) && $payment_mode ==1){echo "selected";}?>>Online</option>
					<option value="2" <?php if(isset($payment_mode) && $payment_mode ==2){echo "selected";}?>>In Person</option>
				</select>
			</td> 		
        </tr>
		<tr>
			<td><strong>Upload photo of the task </strong></br>(Optional)</td>&nbsp;
			<td><input type="file" name="files"  /></td>	
	    </tr>
		<tr><td>&nbsp;</td></tr>
	</table><br><br>
  
  <tr>
    <td align='center'>
	  <input type='submit' name="submit" value='Post'>&nbsp;&nbsp;
      <input type='Reset' value='Reset'>
	</td>
  </tr>
  
    </td></tr>
</table>
<center>
</form>

<!-- footer -->
<?php include('./includes/footer.php');?>