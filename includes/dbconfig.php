<?php
define('DB_SERVER', 'jobtest1.db.10963277.hostedresource.com');
define('DB_USERNAME', 'jobtest1');
define('DB_PASSWORD', 'Sept123@');
define('DB_DATABASE', 'jobtest1');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
