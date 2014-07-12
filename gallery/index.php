<?php
/*
 * forum index script
 */
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
//echo "Forum Lives here<br>";
require DOC_ROOT.'/includes/master.inc.php'; // do login or not
if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   
			    $login = '<a href="'.$site->settings['url'].'/user.php">Settings</a><a href="'.$site->settings['url'].'/logout.php">Logout</a>';
			   }
			   
	else
				{
					$name ="Guest";
					$login = file_get_contents( $site->settings['url'].'/templates/guest.html') ;
				}
 $header = file_get_contents ( $site->settings['url'].'/templates/header.html');
	$footer = file_get_contents (  $site->settings['url'].'/templates/footer.tmpl');
	$include = file_get_contents ( $site->settings['url'].'/templates/include.tmpl');
	$css = $site->settings['url'].'/css/main.css';
    $css ="<style>".file_get_contents ($css)."</style>";
    $template = new Template;
$template->load($site->settings['url'].'/templates/gallery.html');
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
$template->replace("vari",DOC_ROOT);
$template->replace("stuff",'gallery not coded');
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}

$template->publish();
?>
