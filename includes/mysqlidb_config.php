<?php
$h="jobtest1.db.10963277.hostedresource.com";
$u="jobtest1";
$ps="Sept123@";
$dbn= 'jobtest1';
$dbLink = new mysqli($h,$u,$ps,$dbn);
if(mysqli_connect_errno()){
die("MySQL connection failed: ". mysqli_connect_error());
}