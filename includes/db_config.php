<?php
function connect(){
$h="jobtest1.db.10963277.hostedresource.com";
$u="jobtest1";
$ps="Sept123@";
$dbn= 'jobtest1';
@mysql_connect($h,$u,$ps) or die('could not connect to server');
@mysql_select_db($dbn) or die('could not connect to database');
}