<?php
//============================================================+
// File name   : utype.php
//
// Description : Record user type for facebook login procedure.
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