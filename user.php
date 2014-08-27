<?php
require 'includes/master.inc.php'; // do login or not
$template = new Template;
if($Auth->loggedIn()) 
           {
			  //print_r($Auth);
			  //die(); 
			   $name = $Auth->username;
			   $id = session_id();
			   $nid = $Auth->nid;
			   if ($Auth->level === 'user') {
				   //die ("user");
			   $login = '<ul class="egmenu"><li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li></ul>';
		   }
		   elseif ($Auth->level === 'admin') {
			   $login = '<ul class="egmenu"><li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li> <li><a href="#">Admin</a></li></ul>';
		   }
		   }
						   
	else
				{
					$name ="Guest";
					$login = $template->load('templates/guest.html') ;
					
				}


writeid ($id,$nid,$database);
$users = $database->num_rows("select * from sessions");
$user= $database->get_row ("SELECT * FROM  `users` WHERE  `id` = ".$Auth->id);
//printr($user);
//die ($Auth->id);
$stuff ="main Index";
$header = $template->load('templates/header.html');
$footer = $template->load('templates/footer.tmpl');
$include = $template->load('templates/include.tmpl');
$css = 'css/main.css';
$css ="<style>".$template->load($css)."</style>";
$template->load("templates/user.html");
$template->replace("result"," Main Index");
$template->replace("sig",$user['sig']);
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
$template->replace("avatar",$user['avatar']); 
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}
$template->listv("lang/lang.php","");
$template->publish();
?>
