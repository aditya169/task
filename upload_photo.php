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
if(isset($_POST['upload'])) // Has a file been uploaded?
{
   // Make sure the file was sent without errors
	if($_FILES['files']['error'] == 0) 
	{
        //Gather required data
		//adding image-file record
if($_FILES['files']['size'] > 0 ){

		$task_id=trim($_POST['taskid']);
		$task_id=(int)($task_id);
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
			echo "<script> alert('Invalid File! Try Again.') </script>" ;
			echo "<script>window.location='job_posted_history1.php'</script>" ;

		}	
	}
	if($result2 && $result3){
				echo "<script> alert('Image uploaded.') </script>" ;
				echo "<script>window.location='job_posted_history1.php'</script>" ;
			}else{
				  echo "<script> alert('Oops! somthing went wrong.') </script>" ;
				  echo "<script>window.location='job_posted_history1.php'</script>" ;
				}	
				
	}else {
			echo "<script> alert('Please choose image file.')</script>";
			echo"<script> function goBack(){window.history.back()} goBack(); </script>";  
		}
		// Close the mysql connection		 //$dbLink.close();		
}
?>

<?php
// gathering data via url & decoding it
if(isset($_REQUEST['v'])){
	$id=trim($_REQUEST['v']);      
	//$id=base64_decode($t1); 
}else{echo "<script>history.go(-1)</script>" ;}   
?>

<form action="" method="POST" enctype="multipart/form-data">
<table class="main-table">
	<tr>
	  	<td><a href='javascript:history.go(-1)'><img src="images/back4.png" width="8%" height="4%"></a><br></td> 	   	   
	</tr>
    <tr>
		<td></td>
	</tr>
	<tr>
		<td>
			<input type="file" name="files"  />
			<input type="hidden" name="taskid" value='<?php echo $id;?>'/>
			<input type="submit" name='upload' value='Upload'/>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
 </table>
 </form>
<?php include('./includes/footer.php');?>