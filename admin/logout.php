<?php
session_start();
if(isset($_SESSION['li_uname111'])){
session_destroy();
header('location:./'); 
}
else{
header('location:./');
}

?> 