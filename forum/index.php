<?php
/*
 * forum index script
 */
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
//
require DOC_ROOT.'/includes/master.inc.php'; // do login or not
if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   $id = session_id();
			   $nid = $Auth->user->columns['nid'];
			    $login = '<li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li>';
			    $basecolour = "aqua";
			    writeid ($id,$nid,$database);
			   }
			   
	else
				{
					$name ="Guest";
					$login = file_get_contents( $site->settings['url'].'/templates/guest.html') ;
					$basecolour = "aqua";
					// add default colour from config
				}
	$users = $database->num_rows("select * from sessions");	
	$pms="0";
	$newthread="12";
	$newpost ="24";			
	$header = file_get_contents ( $site->settings['url'].'/templates/header.html');
	$footer = file_get_contents (  $site->settings['url'].'/templates/footer.tmpl');
	$include = file_get_contents ( $site->settings['url'].'/templates/include.tmpl');
	$css = $site->settings['url'].'/css/aqua.css';
    $css ="<style>".file_get_contents ($css)."</style>";
    $base = $site->settings['url'].'/css/'.$basecolour;
    //die ("base = ".$base);

        $template = new Template;
$template->load($site->settings['url'].'/templates/forum.html');
$template->replace("result","Forum");
$template->replace("css",$css);
$template->replace("error",$Error);
$template->replace("title", "Forum");
$template->replace("header", $header);
$template->replace("login",$login);
$template->replace("footer", $footer);
$template->replace("include", $include);
$template->replace ("path", $site->settings['url']);
$template->replace("name",$name );
$template->replace("vari",$users);
$template->replace("pms",$pms);
$template->replace("newthread",$newthread);
$template->replace("newpost",$newpost);
$template->replace("datetime", FORMAT_TIME);
$template->replace("base",$base);
if($site->settings['showphp'] === false)
{
$template->removephp();
}
//    echo "Forum Lives here<br>";
//die();
$template->publish();
?>
