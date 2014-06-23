<?php
session_start();
require_once("./includes/configure.php");

if(isset($_SESSION['li_uname111'])){
header('Location:./admin_home.php');   // jump to home page
} 
elseif(isset($_SESSION['li_uname222'])){
	redirectURL(SITE_URL."./main.php");
}
elseif(isset($_SESSION['li_uname333'])){
	redirectURL(SITE_URL."./main.php");
	
}
else{
	//persist on default public home page
	$e='';
	$type=0;	
}
?>


<?php include ('./includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include './includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>
<!--Include Tooltips script-->
<?php require_once './includes/tooltip.php';?>


<div id="container" class="ltr">

<header id="header" class="info">
<script type="text/javascript">
$(document).ready(function() {


	$("#btnBack").click(function(){
	$("#fieldset").fadeIn(80, function(){
							$("#fblogin").fadeOut(100);
					});
	
	});
	
	

	$("#btnGo").click(function(){
			
		$("#ajaxform").submit(function(e){
	
			$("#simple-msg").html("<img src='images/loading.gif'/>&nbsp; Wait..");
			var postData = $(this).serializeArray();
			var formURL = $(this).attr("action");
			
			//validateForm(postData);  
			
			$.ajax(
			{
				url : formURL,
				type: "POST",
				data : postData,
				success:function(data, textStatus, jqXHR) 
				{	
					$("#ajaxform")[0].reset(); //reset fields
					
						//fade Out form on submission
					$("#fieldset").fadeOut(80, function(){
							$("#fblogin").fadeIn(1000); 	//fade In confirmation message
							$("#simple-msg").html('<pre><code class="prettyprint">'+data+'</code></pre>'); //show data from server side
					});
				
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
					//show upon error
					$("#simple-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
					
				}
			});
			
			e.preventDefault();	//STOP default action
		
		});
			
			$("#ajaxform").submit(); //SUBMIT FORM
			
	});
	
});
</script>
<style type="text/css"> 

#fblogin { 
    display:none; 
    
} 
 #simple-msg { 
    font-size:25; 
    font-weight:normal;
    color:purple; 
	margin-top:3px;
	margin-left:590px
}
</style>

	<br/><h2>&nbsp;&nbsp;Login to EasyTasks</h2>
</header>
<div class="main-content">
<div id="fieldset">
<form name="ajaxform" id="ajaxform" method="POST" action="utype.php"><center><br/><br/><br/>
<table>
	<tr>
		<td><strong>Your Role&nbsp;&nbsp;&nbsp;</strong></td>
		<td>
			<select name="sel_user" title="Select Your role"  >
				<option value="3">Task Worker&nbsp;&nbsp;</option>
				<option value="2">Task Poster&nbsp;&nbsp;</option>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input id="btnGo" type="submit" name="btnGo" value="GO" >
		</td>
	</tr>
</table>
</form>
</div>
<div id="simple-msg"></div><br/>

	<div id="fblogin">
    <div class="mainTitle" ></div>	
	
    <div style="text-align:center;">
	<a href="<?php echo $loginURL;?>" ><img src="images/facebook_login.png" width="209" height="40" border="0" alt="Facebook Login" /></a> </div>
	<br/><br/><br/><input id="btnBack" type="button" value="Back" >

	
	</div>
	
</div>
<div class="sidebar"></div>
<div class="clear"></div>
</div>

<!-- login form ends -->	
	
<!-- footer -->
<?php include('./includes/footer.php');?>