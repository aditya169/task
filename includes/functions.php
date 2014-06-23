<?php
require 'dbconfig.php';

class User {

    function checkUser($uid,$fname,$lname,$gender,$ip,$city,$address,$telephone,$date,$email,$utype) 
	{
		switch($utype){
		
		case 2:
	
        $query = mysql_query("SELECT * FROM `poster_profile` WHERE oauth_uid = '$uid'") or die(mysql_error());			
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
        } 
		else {
            #user not present. Insert a new Record & register as taskposter
			//ask user do you want to register as taskposter. 
			
			//if yes continue registering..
            $query1 = mysql_query("INSERT INTO `poster_profile`   VALUES ('','$uid','$fname','$lname','$gender','$ip','$city','$address','$telephone','$date','$email','NULL','')") or die(mysql_error());
		
			$query = mysql_query("SELECT * FROM `poster_profile`  WHERE oauth_uid = '$uid'");
            $result = mysql_fetch_array($query);
            return $result;
			
			//else cancle the process , logout fb & show login page

        }
        return $result;
		
		break;
		
		
		case 3:
		
        $query = mysql_query("SELECT * FROM `worker_profile` WHERE oauth_uid = '$uid'") or die(mysql_error());			
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
        } 
		else {
            #user not present. Insert a new Record & register as taskworker
			//ask user do you want to register as taskworker. 
			
			//if yes continue registering... 

            $query1 = mysql_query("INSERT INTO `worker_profile`   VALUES ('','$uid','$fname','$lname','$gender','$ip','$city','$address','$telephone','$date','$email','NULL','')") or die(mysql_error());
			
			$query = mysql_query("SELECT * FROM `worker_profile` WHERE oauth_uid = '$uid'");
            $result = mysql_fetch_array($query);
            return $result;
			
			//else cancle the process , logout fb & show login page
        }
        return $result;
		break;
		
		//default: echo "invalid user type";
		
		}
		
    }
}
?>
