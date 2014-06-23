<?php
/*
fb-sign-up config file
*/
session_start();
require 'facebook_library/facebook.php';
require 'includes/functions.php';
define("APP_ID", "744416412252784");
define("APP_SECRET", "ac6173a151cf6fd5a86487cb8d57cb50");
define("SITE_URL", "http://eztasker.com/");
define("PERMISSIONS", "email,user_hometown,user_about_me,user_location");


$confg= array(		
		'appId'  => APP_ID, 
		'secret' => APP_SECRET
	);

// create a facebook object
$facebook = new Facebook($confg); 
$userID = $facebook->getUser();


// Login or logout url will be needed depending on current user state.
if ($userID) {
  $logoutURL = $facebook->getLogoutUrl(array('next'=> SITE_URL.'logout.php'));
} else {
  $loginURL = $facebook->getLoginUrl( array('scope' => PERMISSIONS,'redirect_uri' => SITE_URL) );
}

// Only if user is logged in, we can fetch user details
if ($userID) {
  try {
	  $_SESSION["user_id"] = $userID;
    // fetch user details.
    $user_profile = $facebook->api('/me');
	
	//gather user's facebook data
	$uid = $user_profile["id"];
	$fname = $user_profile['first_name'];
	$lname = $user_profile['last_name'];
	$gender= $user_profile["gender"];
	$email= $user_profile["email"];
	$city= $user_profile["hometown"]["name"];
	$address="";
	$telephone="";
	$ip=$_SERVER['REMOTE_ADDR'];
	$today = mktime(0,0,0,date("m"),date("d"),date("Y"));
	$date = date("m/d/y", $today);
	
	$utype=$_SESSION['utype'];
	switch($utype){
	
	case 2:
	//create object of class User
	$user = new User();
	$userdata = $user->checkUser($uid,$fname,$lname,$gender,$ip,$city,$address,$telephone,$date,$email,$utype);
	if(!empty($userdata)){
				session_start();
				// $_SESSION['id'] = $userdata['id'];
				//$_SESSION['oauth_id'] = $uid;
				$_SESSION['li_uname222']=$userdata['email'];
				$_SESSION['city']=$userdata['location']; 
		}
		break;
		
	case 3:
	//create object of class User
	$user = new User();
	$userdata = $user->checkUser($uid,$fname,$lname,$gender,$ip,$city,$address,$telephone,$date,$email,$utype);
	if(!empty($userdata)){
				session_start();
				// $_SESSION['id'] = $userdata['id'];
				//$_SESSION['oauth_id'] = $uid;
				$_SESSION['li_uname333']=$userdata['email'];
				$_SESSION['city']=$userdata['location']; 
		}
		break;
	}
	
  } catch (FacebookApiException $e) {
	#debugResults($e);
    $userID = NULL;
  }
	
}


/*
This function output the results based on the datatype.
If strict mode is turned on will show the variable datatype too.
It can come very handy when you need to debug your code.
*/
function debugResults($var, $strict = false) {
	if ($var != NULL) {
		if ($strict == false) {

			if( is_array($var) ||  is_object($var) ) {
				echo "<pre>";print_r($var);echo "</pre>";
			} else {
				echo $var;
			}
			
		} else {

			if( is_array($var) ||  is_object($var) ) {
				echo "<pre>";var_dump($var);echo "</pre>";
			} else {
				var_dump($var) ;
			}

		}

	} else {
		var_dump($var) ;
	}
}

function redirectURL($url) {
	echo '<script> window.location.href="'.$url.'"</script>"';
}

?>