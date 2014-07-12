<?php
require 'includes/master.inc.php'; // do login or not
if($Auth->loggedIn()) 
           {
			  //print_r($Auth);
			  //die(); 
			   $name = $Auth->username;
			   $id = session_id();
			   $nid = $Auth->user->columns['nid'];
			   if ($Auth->user->columns['level'] === 'user') {
				   //die ("user");
			   $login = '<li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li> ';
		   }
		   elseif ($Auth->user->columns['level'] === 'admin') {
			   $login = '<li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li> <li><a href="#">Admin</a></li>';
		   }
		   }
						   
	else
				{
					$name ="Guest";
					$login = file_get_contents('templates/guest.html') ;
					
				}


writeid ($id,$nid,$database);
$users = $database->num_rows("select * from sessions");
$stuff ="main Index";
$header = file_get_contents('templates/header.html');
$footer = file_get_contents ( 'templates/footer.tmpl');
$include = file_get_contents ('templates/include.tmpl');
$css = 'css/main.css';
$css ="<style>".file_get_contents ($css)."</style>";
$template = new Template;
$template->load("templates/user.html");
$template->replace("result"," Main Index");
$template->replace("css",$css);
$template->replace("title", "User Control");
$template->replace("header", $header);
$template->replace("login",$login);
$template->replace("footer", $footer);
$template->replace("include", $include);
$template->replace ("path", $site->settings['url']);
$template->replace("name",$name );
$template->replace("vari",$users);
$template->replace("stuff",$stuff);
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}
$template->listv("lang.php","");
$template->publish();
?>
