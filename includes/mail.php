<?php
class mail{
/*** THis is Mail Sender function. */
function mail_sender($from,$to, $subject, $message)
	{

		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From:" .$from. "\r\n";
		$headers .= "Reply to " .$from. "\r\n";
		//$headers .= "X-Mailer: PHP/" . phpversion();

		$responce = mail($to, $subject, $message, $headers);
		return true;  
	}
}
?>