<?php
/*** Check Name String;*/
function checkName($name){
   $pattern = "/^[a-zA-Z ]{3,16}$/i";
    if (preg_match($pattern, trim(strip_tags($name)))) {
            return true;
    } else {
               return false;
        }
}

/*** Check email String;*/
function checkEmail($email){
   $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
    if (preg_match($pattern, trim(strip_tags($email)))){
        return true;	
    } else {
            return false;		
        }
}


/*** Check telephone;*/
function checkPhone($telephone){
   $pattern = "/^[\d\.\-]+$/";
    if (preg_match($pattern, trim(strip_tags($telephone)))) {
            return true;
    } else {
               return false;
        }
}



/*** Check email Existence;*/
function checkExistence($email,$type){
	require_once './includes/db_config.php';
	connect();
	if($type==1){
		$query1 = "select email from admin where email='".$email."'";
		$result1=mysql_query($query1) or die(mysql_error());
		if(mysql_num_rows($result1)>0){
				return true;	
		} else {
            return false;		
			}
	}
	
	if($type==2){
		$query1 = "select email from poster_profile where email='".$email."'";
		$result1=mysql_query($query1) or die(mysql_error());
		if(mysql_num_rows($result1)>0){
				return true;	
		} else {
            return false;		
			}
	}
	
	if($type==3){
		$query1 = "select email from worker_profile where email='".$email."'";
		$result1=mysql_query($query1) or die(mysql_error());
		if(mysql_num_rows($result1)>0){
				return true;	
		} else {
            return false;		
			}
	}


}
?>