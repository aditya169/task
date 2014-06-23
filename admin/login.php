<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$username=$_POST['username'];
	$username= preg_replace( '/\s+/','', $username); //remove all whitespaces
	$password=$_POST['password'];
	$password= preg_replace( '/\s+/','', $password);

	require_once '../includes/db_config.php';
	connect();
	$username=strip_tags(stripslashes(mysql_real_escape_string($username)));
	$password =strip_tags(stripslashes(mysql_real_escape_string($password)));

	if($username==null && $password ==null){
		echo "<script>history.go(-1)</script>" ;
		exit;
	}

	$query = "SELECT  email,password,permission FROM admin WHERE email='".$username."' and password='".$password."' "; //password='".md5($password)."' ";
	$result = mysql_query($query) or die("Selection Query Failed !!!");
	if (mysql_num_rows($result) == 1) {	
		$row=mysql_fetch_array($result);
		$_SESSION['li_permission111']=$row['permission'];
		$_SESSION['li_uname111']=$username;
		header("Location:../admin_home.php");				
	} 
	else {
		echo "<script> alert('Invalid email or password.') </script>" ;
		echo "<script>window.location='./'</script>" ;
	}
}
?>