<?php
//receive post data
session_start();
$sel_user =  $_POST['sel_user'];
 
 switch($sel_user){
 
	case 3:		$_SESSION['utype']=3;
	break;
	
	case 2:		$_SESSION['utype']=2;
	break;
	
	default: 	$_SESSION['utype']=2;  //default taskposter

 }
?>