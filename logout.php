<?php
//============================================================+
// File name   : logout.php
//
// Description : User Logout
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
session_start();
require_once("./includes/configure.php");
if(isset($_SESSION['li_uname111'])){
session_destroy();
header('location:./admin'); 
}
elseif(isset($_SESSION['li_uname222'])){
$facebook->destroySession();
session_destroy();
header('location:login.php');
}
elseif(isset($_SESSION['li_uname333'])){
$facebook->destroySession();
session_destroy();
header('location:login.php');
}
else{
header('location:./');
}

?> 