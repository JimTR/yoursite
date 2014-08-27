
<?php
/*
 * main Index file
 * does very little as it does not need to !
 */ 
require 'includes/master.inc.php'; // do login and stuff
$a=0;
$id = session_id();
if($Auth->loggedIn()) 
           {
			  //print_r($Auth);
			  //die(); 
			   $name = $Auth->username;
			   $nid = $Auth->nid;
			   if ($Auth->level === 'user') {
				   //die ("user");
				   
			   $login = '
			   <ul class="egmenu"><li><a href="'.$site->settings['url'].'/user.php">Settings</a></li>
			   <li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li></ul> ';
		   }
		   elseif ($Auth->level === 'admin') {
			   $login = '<ul class="egmenu"><li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li> <li><a href="#">Admin</a></li></ul>';
		   }
		   }
						   
	else
				{
					$name ="Guest";
					$login = file_get_contents('templates/guest.html') ;
					$nid = getnid();
					
				}


$reload = writeid ($id,$nid,$database);
 //this is a fix it is there for IE
/* if($reload)
	{
		//die ('reload is true');
		$rjs='<script type="text/javascript">
jQuery(document).ready(function(){

//Check if the current URL contains # 
if(document.URL.indexOf("#")==-1)
{
// Set the URL to whatever it was plus "#".
url = document.URL+"#";
location = "#";

//Reload the page
location.reload(true);

}
});
</script>  ';
	}
	else {
$file='log1.txt';
	$ip=getip();
	$person = $name.' '.FORMAT_TIME.' '.$ip;
		//die("a= ". $a);
		log_to ($file,$person);
		$rjs=
		'<script type="text/javascript">
jQuery(document).ready(function(){

//Check if the current URL contains # 
if(document.URL.indexOf("#")>=0)
{
// Set the URL to whatever it was without "#".
url = document.URL;
location = "";
//alert (url);
}
});
</script> ';
	}
	*/ 
$pms="0";	
$template = new Template;
$users = $database->num_rows("select * from sessions");
$header = $template->load('templates/header.html');
$footer = $template->load ( 'templates/footer.tmpl');
$include = $template->load ('templates/include.tmpl');
$css = 'css/main.css';
$css ="<style>".file_get_contents ($css)."</style>";

$template->load("templates/page.html");
$template->replace("css",$css);
$template->replace("title", "Home");
$template->replace("header", $header);
$template->replace("include", $include);
$template->replace("login",$login);
$template->replace("footer", $footer);
$template->replace("pms",$pms);
$template->replace ("path", $site->settings['url']);
$template->replace("name",$name );
$template->replace("vari",$users);
$template->replace("stuff",$stuff);
$template->replace("reload",$rjs); // fix for ie 
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}

$template->publish();

?>
