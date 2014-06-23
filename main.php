<?php
session_start();
if(isset($_SESSION['li_uname111'])){
header('Location:./admin_home.php');   // jump to home page
}
elseif(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$type=2;
	$show=0;
	$title="Task Poster";
	$city=$_SESSION['city'];   //Home city of poster
	require_once './includes/db_config.php';
	connect();
	$rs=mysql_query("select poster_id from poster_profile where email ='".$e."' ");
	$rows=mysql_fetch_array($rs);
	$pid=$rows['poster_id'];	
}
elseif(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$show=0;
	$title="Task Worker";
	$city=$_SESSION['city'];  //Home city of Worker
	require_once './includes/db_config.php';
	connect();
	$rs=mysql_query("select worker_id from worker_profile where email ='".$e."' ");
	$rows=mysql_fetch_array($rs);
	$wid=$rows['worker_id'];	
}
else{
	//persist on default public home page
	$e='';
	$type=0;
	$show=0;
	$note='Search & Apply for tasks from the right pane by filling your desired task location, Zoom out/in map to view all the tasks.';
	
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

<!--Notifications for poster interface -->
<?php if($type==2){ ?>
<table>
  <tr>
    <td  align="left"><?php include './notific_p.php';?></td>
    <td><h3>( <?php echo $title;?> )</h3></td>
  </tr>
</table>
<?php } ?>

<!--Notifications for worker interface -->

<?php if($type==3){ ?>
<table>
  <tr>
    <td  align="left"><?php include './notific_w.php';?></td>
    <td><h3>( <?php echo $title;?> )</h3></td>
  </tr>
</table>
<?php } ?>

<!--Info bar -->
<?php if($type==0){ ?>
<h4 class="note">Note: <?php echo $note;?></h4>
<?php } ?>

<!-- Map.api -->
<?php function gmap(){ ?>
<iframe  class="map-iframe" src='./map.php' scrolling="no"></iframe>
<br/>
<?php } ?>
<?php 
	//get page value for pagination
	if(isset($_GET['start'])){
		$start = $_GET['start'];
	}else{
		$start=0;
	}
	if(!$start){ 
		$start=0; 
	}

	$job_count="";

//handling default task-search 
if(!isset($_GET['search'])){
		$chk=0;
		$category="";
		$arrange="1";
		//set queries
		require_once './includes/db_config.php';
		connect();
		if($type==2){
			$q= "SELECT * FROM task where poster_id='".$pid."' AND status=0  order by posted_date desc";
			$_SESSION['query']=$q;
			$show=1;
		}
		elseif($type==3){
			$q= "SELECT * FROM task where status=0 AND location='".$city."'  order by posted_date desc";
			$_SESSION['query']=$q;
		}
		else{
		
			$q= "SELECT * FROM task 
				 WHERE status=0 
				 ORDER BY address asc";
				
				$_SESSION['query']=$q;
		}
		$result=mysql_query($q) or die(mysql_error());
		$job_count=mysql_num_rows($result);
		$result2=mysql_query($q) or die(mysql_error());		
}

//handling Task-search
if(isset($_GET['search'])){
	$show=0; //to show message
	//Gathering data for search.
	$chk=1;
	$category=trim($_GET["category"]);
	$search_loc=trim($_GET["search_loc"]);
	$arrange=trim($_GET["arrange"]);
	if($arrange=='1'){$str="posted_date asc";}	if($arrange=='2'){$str="payment asc";}
	if($arrange=='3'){$str="payment desc";} if($arrange=='4'){$str="posted_date desc";}
	if($arrange=='5'){$str="deadline desc";}

	//fields validations
	if($search_loc == "" ){
		$error= "error : You did not enter a location.";
		$code= "2" ;
	}
	else{
		//set queries
		require_once './includes/db_config.php';
		connect();
		if($category == "" ){
			$q= "SELECT * FROM task 
			     WHERE location like '%$search_loc%'
			     AND status=0 ORDER BY $str";
		}
		elseif($category==11){
			$q= "SELECT * FROM task 
			     WHERE location like '%$search_loc%'
			     AND status=0 ORDER BY $str";
		}else{
			$q= "SELECT * FROM task 
				WHERE category='".$category."' && location like '%$search_loc%'
				AND status=0 ORDER BY $str";
		}
		$_SESSION['query']=$q;
		$result=mysql_query($q) or die(mysql_error());
		$job_count=mysql_num_rows($result);
		$result2=mysql_query($q) or die(mysql_error());
	
	}
}
?>
<div class="main-table">

  <div class="map"><?php
// pull entered location from db, otherwise display not found message 
if($job_count>0){
	while($row = mysql_fetch_array($result2)){
		$location=$row['location'];
	}
	gmap();
}else{
			if($type==2){ 
				echo'<iframe class="map-iframe" src="info3.php";></iframe><br/><br/>';
			}
			else{
				echo'<iframe  class="map-iframe" src="info.php";></iframe><br/><br/>';
			}
}
?>
</div>
    <div class="jobsection"><!--Include Tooltips script-->
      
      <?php require_once './includes/tooltip.php';?>
      
      <!--Search Form-->
      
      <form method="GET" action="">
        <table class="main-table" id="table-hover">
          <tr>
            <td colspan="2"><?php if(isset($error)){echo'<p class=message >' .$error. ' <br></p>';}?></td>
          </tr>
          <tr>
            <td><select name="category" title="Choose Task Category" >
                <Option value="">Select Task Category</Option>
                <option value="1" <?php if(isset($category) && $category ==1){echo "selected";}?>>Painting the fence</option>
                <option value="2" <?php if(isset($category) && $category ==2){echo "selected";}?>>Mowing the lawn</option>
                <option value="3" <?php if(isset($category) && $category ==3){echo "selected";}?>>Landscaping / gardening</option>
                <option value="4" <?php if(isset($category) && $category ==4){echo "selected";}?>>Washing the dishes</option>
                <option value="5" <?php if(isset($category) && $category ==5){echo "selected";}?>>Cleaning the bathroom</option>
                <option value="6" <?php if(isset($category) && $category ==6){echo "selected";}?>>Changing light bulbs</option>
                <option value="7" <?php if(isset($category) && $category ==7){echo "selected";}?>>Taking out the garbage</option>
                <option value="8" <?php if(isset($category) && $category ==8){echo "selected";}?>>Laundry</option>
                <option value="9" <?php if(isset($category) && $category ==9){echo "selected";}?>>Sweeping / dusting / vacuuming &nbsp;</option>
                <option value="10"<?php if(isset($category) && $category ==10){echo "selected";}?>>Washing the car</option>
                <option value="11"<?php if(isset($category) && $category ==11){echo "selected";}?>>Others</option>
              </select>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="arrange" title="Arange By" >
                <option value="1" <?php if(isset($arrange) && $arrange ==1){echo "selected";}?>>By Date</option>
                <option value="2" <?php if(isset($arrange) && $arrange ==2){echo "selected";}?>>Lowest Price First&nbsp;</option>
                <option value="3" <?php if(isset($arrange) && $arrange ==3){echo "selected";}?>>Highest Price First&nbsp;</option>
                <option value="4" <?php if(isset($arrange) && $arrange ==4){echo "selected";}?>>Most Recent</option>
                <option value="5" <?php if(isset($arrange) && $arrange ==5){echo "selected";}?>>Near Deadline</option>
              </select>
              &nbsp;&nbsp; </td>
          </tr>
          <tr>
			<td><input type="text" name="search_loc" size="65"  title="Type desired task location" value="<?php if(isset($search_loc)){echo $search_loc;} ?>" <?php if(isset($code) && $code ==2){echo "class=error" ;} ?> >&nbsp;
              <input type="submit" name="search" value="Search"></td>
          </tr>
         <!-- <tr><td colspan="2"><div class="hr"><hr/></div></td></tr> -->
        </table>
      </form>
	  
		<!--
		<h4 align="center"><?php if($show==1){echo "You Posted ";}?>&nbsp;&nbsp;<?php echo $job_count; if($job_count==1){echo " Task ";}else{echo" Tasks ";}?> on EasyTasks.</h4> 
		-->
		
      <table class="main-table" id="table-hover" >
    
        <?php  
				//fetching data, based on 'query-batch' created above.
				if($job_count>0){
				    //call to search with pagination method.
					search($start,$job_count,$q,$category,$location,$arrange,$chk,$type);
				}
			   ?>
        <?php
/* method to display task-search results */
function task($i,$id,$todo,$loc,$payment,$type){

		echo'<tr><td colspan="5"><div class="hr"><hr/></div></td></tr>';
		echo'<tr><td>'.$i.'.</td><td class="h">'.$todo.'</td>';
		echo'<td>'.$loc.'</td>';
		echo'<td>'.$payment.'</td>';
		if($type==0 || $type==2 || $type==3){
			$url=$id; 
			echo'<td><a title="Click to make offer for this task." href="job_apply1.php?t='.$url.'" class="but_pink">Make Offer</a></td></tr>';
		}
		else{
			echo'<td><a href="job_apply1.php?$t='.$url.'" onclick = "javascript: return false;">Make Offer</a></td></tr>';
		}		
} 
?>
        <!--search method with pagination-->
        <?php
function search($start,$job_count,$q,$category,$location,$arrange,$chk,$type){
	require_once './includes/db_config.php';
	connect();
	$per_page = 9;
	$foundnum=$job_count;
	if(!$start) $start=0;
	$append="LIMIT $start, $per_page";
	$q= $q." ".$append;
	$getquery = mysql_query($q);

		$c=$start+1;
		while($row= mysql_fetch_assoc($getquery))
		{
			$id=$row['task_id'];		 	     
			$todo=$row['title'];    
			$currency=$row['currency'];	
			if($currency==1){$currency="Rs.";} if($currency==2){$currency="$";}						
			$payment=$row['payment'];		
			$payment= $currency." ".$payment; //concatenate
			$location=$row['location'];		
			task($c,$id,$todo,$location,$payment,$type);// call to method task to display search list
			$c++;
		}
	echo 	"<tr><td colspan=4><div class='hr'><hr/></div></td></tr>";
	echo "</table>";
	echo "<center>";
	
	$prev = $start - $per_page;
	$next = $start + $per_page;
	if($chk!==0){
		if (!($start<=0))
		echo "<a class='h' href='main.php?category=$category&search_loc=$location&arrange=$arrange&search=Search&start=$prev'>Prev</a>"." "; 
		
		if (!($start>=$foundnum-$per_page)){
			echo "<a class='h'  href='main.php?category=$category&search_loc=$location&arrange=$arrange&search=Search&start=$next'>Next</a>"; 
		}
	}
	else{
		if (!($start<=0))
		echo "<a class='h' href='main.php?start=$prev'>Prev</a>"." "; 
		
		if (!($start>=$foundnum-$per_page)){
			echo "<a class='h' href='main.php?start=$next'>Next</a>"; 
		}
	}
	//echo "<br>$q";
    echo "</center>";
 }
?>
      </table><br/>
</div>
</div>
<!-- end page --> 
<div class="clear"></div>
<!-- footer -->
<?php include('./includes/footer.php');?>
