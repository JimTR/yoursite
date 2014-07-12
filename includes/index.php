<?php
require 'includes/master.inc.php'; // do login or not
if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   $login = '<a href="'.$site->settings['url'].'/user.php">Settings</a><a href="'.$site->settings['url'].'/logout.php">Logout</a>';
			   }
			   
	else
				{
					$name ="Guest";
					$login = file_get_contents('templates/guest.html') ;
				}




$stuff ="main Index";
$header = file_get_contents('templates/header.html');
$footer = file_get_contents ( 'templates/footer.tmpl');
$include = file_get_contents ('templates/include.tmpl');
$css = 'css/main.css';
$css ="<style>".file_get_contents ($css)."</style>";
$template = new Template;
$template->load("templates/page.html");
$template->replace("result"," Main Index");
$template->replace("css",$css);
$template->replace("title", "Beta Page");
$template->replace("header", $header);
$template->replace("login",$login);
$template->replace("footer", $footer);
$template->replace("include", $include);
$template->replace ("path", $site->settings['url']);
$template->replace("name",$name );
$template->replace("vari",DOC_ROOT);
$template->replace("stuff",$stuff);
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}

$template->publish();
?>
