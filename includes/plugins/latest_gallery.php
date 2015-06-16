<?php
// gallery latest image
if(!defined(DOC_ROOT)) {
	echo 'This file can not be executed';
	die();
}
$sql ='select * from gallery order by time_stamp limit 5';
?>
