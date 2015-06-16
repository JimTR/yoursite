<?php
/*$headers = "MIME-Version: 1.0" . "\r\n"; // set html
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; //set html
	$headers .= 'From: '.$settings['sitename'].'<'.$settings['adminemail'].'>'; //email address sent from
	$payuser = 'Tester';
	$to = $payuser.'<jim@noideersoftware.co.uk>'; // need to add real email address !
	$title = "Order - #Test";
	$message = 'php mail is working';*/
	 
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $headers = "MIME-Version: 1.0" . "\r\n"; // set html
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; //set html
    $from = "KB Racing Malvern <emailtest@YOURDOMAIN>";
    $to = "KB Rcacing <jim@noideersoftware.co.uk>";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    $headers .= "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "Test email sent";
?>
