<?php
session_start();
if(isset($_SESSION['li_uname111'])){
	$e=$_SESSION['li_uname111'];
	$type=1;	
}
elseif(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$email=$e;
	$type=2;
	$title="Task Poster";
}
elseif(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Worker";
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

<script type="text/javascript">

var messageDelay = 2000;  // How long to display status messages (in milliseconds)

// Init the form once the document is ready
$( init );


// Initialize the form

function init() {

  // Hide the form initially.
  // Make submitForm() the form's submit handler.
  // Position the form so it sits in the centre of the browser window.
  $('#contactForm').hide().submit( submitForm ).addClass( 'positioned' );

  // When the "Send us an email" link is clicked:
  // 1. Fade the content out
  // 2. Display the form
  // 3. Move focus to the first field
  // 4. Prevent the link being followed

  $('a[href="#contactForm"]').click( function() {
		$('#content').fadeTo( 'slow', .2 );
		$('#contactForm').fadeIn( 'slow', function() {
			$('#fname').focus();
		})
		return false;
	});
  
  // When the "Cancel" button is clicked, close the form
  $('#cancel').click( function() { 
		$('#contactForm').fadeOut();
		$('#content').fadeTo( 'slow', 1 );
	});  

  // When the "Escape" key is pressed, close the form
  $('#contactForm').keydown( function( event ) {
		if ( event.which == 27 ) {
			$('#contactForm').fadeOut();
			$('#content').fadeTo( 'slow', 1 );
		}
	});

}


// Submit the form via Ajax

function submitForm() {
  var contactForm = $(this);

  // Are all the fields filled in?

  if ( !$('#fname').val() || !$('#lname').val() || !$('#telephone').val() || !$('#city').val() || !$('#address').val() || !$('#aboutme').val() ) {

    // No; display a warning message and return to the form
    $('#incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
    contactForm.fadeOut().delay(messageDelay).fadeIn();

  } 
  else {

    // Yes; submit the form to the PHP script via Ajax
    $('#sendingMessage').fadeIn();
    contactForm.fadeOut();

    $.ajax( {
			url: contactForm.attr( 'action' ) + "?ajax=true",
			type: contactForm.attr( 'method' ),
			data: contactForm.serialize(),
			success: submitFinished
		});
	}
	// Prevent the default form submission occurring
	return false;
}


// Handle the Ajax response

function submitFinished( response ) {

	response = $.trim( response );
	$('#sendingMessage').fadeOut();

	if ( response == "success" ) {

		// Form submitted successfully:
		// 1. Display the success message
		// 2. Clear the form fields
		// 3. Fade the content back in

		$('#successMessage').fadeIn().delay(messageDelay).fadeOut();
		//$('#senderName').val( "" );
		//$('#senderEmail').val( "" );
		//$('#message').val( "" );
		
		$('#content').delay(messageDelay+500).fadeTo( 'slow', 1, function(){
				location.reload();   // page reloads immediately.
				//window.setTimeout('location.reload()', 3000); //reloads after 3 seconds
		});
		
	} 
	else {
		// Form submission failed: Display the failure message,
		// then redisplay the form
		$('#failureMessage').fadeIn().delay(messageDelay).fadeOut();
		$('#contactForm').delay(messageDelay+500).fadeIn();
		
	}
}
</script>
<?php
require_once './includes/db_config.php';
	connect();
	if($type==2){
		$q = "SELECT * FROM poster_profile WHERE  email='".$email."'";
		profile($q);
	}
	elseif($type==3 || $type==1){
		if(isset($_REQUEST['v2'])){
			$pid=(int)$_REQUEST['v2'];
			$pid=trim($pid);
			$q = "SELECT * FROM   poster_profile WHERE  poster_id='".$pid."'";	
			profile($q);
		}else{
				echo "<script>history.go(-1)</script>" ;
				
			}
	}
?> 
<?php
function profile($q){
	$r=mysql_query($q) or die(mysql_error());
	$count=mysql_num_rows($r);
	if ($count > 0){
		$row = mysql_fetch_array($r);
		$name=$row['fname']." ".$row['lname'];
		$fname=$row['fname'];
		$lname=$row['lname'];
		$city=$row['location'];
		$address=$row['address'];
		$gender=$row['gender'];
		$telephone=$row['telephone'];
		$email=$row['email'];
		$created=$row['created'];
		$about_me=$row['about_me'];
		$id=$row[0]; 
		$auth_id=$row[1]; 
		

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<div id="content">
<table class="main-table">
<tr><td>
<a href='javascript:history.go(-1)'><img src="images/back4.png" width="8%" height="4%"></a><br/><br/>   	   	   
<tr>
		<td colspan=2>
			<p><a href="#contactForm">Edit Profile</a></p><br/>
		</td>
	</tr>
<table class="main-table">
	<tr><td><img src="https://graph.facebook.com/<?php echo $auth_id; ?>/picture"><br/><h2><?php echo $name;?></h2></td></tr>
	<tr><td colspan=2><div class="hr"><hr /></div><br/></td></tr>
	<tr><td><strong>Gender</strong></td><td><?php echo $gender;?></td></tr>
	<tr><td><strong>Email</strong></td><td><?php echo $email;?></td></tr>
	<tr><td><strong>Telephone</strong></td><td><?php echo $telephone;?></td></tr>
	<tr><td><strong>City</strong></td><td><?php echo $city;?></td></tr>
	<tr><td><strong>Address</strong></td><td><?php echo $address;?></td></tr>
	<tr><td><strong>Joined</strong></td><td><?php echo $created;?></td></tr>
	<tr><td><strong>About me</strong></td><td><textarea cols="80" rows="10"  readonly maxlength="10000"><?php echo $about_me;?></textarea></td></tr>
	<tr><td><strong>Reviews</strong></td><td><?php echo"<a href=reviews.php?pi={$row['poster_id']} title='view'>View</a>";?></td></tr>
</table>
</td></tr>
</table>
</div>



<form id="contactForm" action="poster_profile2.php" method="post">
  <h2>Edit Profile</h2>
	<ul>
		<li>
			<label for="fname">First Name*</label>
			<input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" placeholder="Type your first name" required="required" maxlength="40" />
			<input type="hidden" name="id" value="<?php echo $id;?>">
		</li>
		<li>
			<label for="lname">Last Name*</label>
			<input type="text" name="lname" id="lname" value="<?php echo $lname; ?>" placeholder="Type your last name" required="required" maxlength="40" />
		</li>
		<li>
			<label for="telephone">Telephone*</label>
			<input type="text" name="telephone" id="telephone" value="<?php echo $telephone; ?>"placeholder="Type your telephone number" required="required" maxlength="50" />
		</li>
		<li>
			<label for="city">City*</label>
			<input type="text" name="city" id="city" value="<?php echo $city; ?>" placeholder="Type your current city" required="required" maxlength="50" />
		</li>
		
		<li>
			<label for="address">Address*</label>
			<input type="text" name="address" id="address" value="<?php echo $address; ?>"placeholder="Type your full address" required="required" maxlength="50" />
		</li>
		
		<li>
			<label for="aboutme" style="padding-top: .5em;">About Me</label>
			<textarea name="aboutme" id="aboutme"   placeholder="Please type about you" required="required" cols="80" rows="10" maxlength="10000"><?php echo $about_me;?></textarea>
		</li>
		
  </ul>

  <div id="formButtons">
    <input type="submit" id="sendMessage" name="sendMessage" value="Save" />
    <input type="button" id="cancel" name="cancel" value="Cancel" />
  </div>
</form>



<div id="sendingMessage" class="statusMessage"><p>Please wait...</p></div>
<div id="successMessage" class="statusMessage"><p>Record Saved!</p></div>
<div id="failureMessage" class="statusMessage"><p>There was a problem saving your record. Please try again.</p></div>
<div id="incompleteMessage" class="statusMessage"><p>Please complete all the fields.</p></div>

<?php 
		}else{
			echo "<script>history.go(-1)</script>";
	}
}
?>

<?php include('./includes/footer.php');?>