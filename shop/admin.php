<?php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // required
require DOC_ROOT.'/includes/functions_admin.php'; //admin functions
if( $Auth->level <> 'admin' )
{
	//the user is not an admin
	redirect ("index.php");
		
}  
echo "no module admin installed<br>You may wish to use the install refresh command !";
?> 
