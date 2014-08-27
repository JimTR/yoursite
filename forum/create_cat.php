<?php
//create_cat.php

define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // required
if ($_POST['action'] == 'Quit') { redirect ('index.php');} // hit the quit button see template
if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   $id = session_id();
			   $nid = $Auth->nid;
			    $login = '<li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li>';
			    $page['basecolour'] = "aqua";
			    
			   }
			   
	else
				{
					$name ="Guest";
					$login = $template->load( $site->settings['url'].'/templates/guest.html') ;
					$page['basecolour'] = "aqua";
					// add default colour from config
				}
				
	writeid ($id,$nid,$database); 
	$template = new Template;

$page['header'] = $template->load('templates/header.html');
$page['footer'] = $template->load($site->settings['url'].'/templates/footer.tmpl');
$page['include'] = $template->load( $site->settings['url'].'/templates/include.tmpl');
$page['base'] =  $site->settings['url'].'/css/'.$basecolour;
$page['navi'] = '<a style="color:#FFFFFF" href="index.php">Forum->New Category</a>';
$page['title'] = "Create Category";
$page['path'] = $site->settings['url'];
$page['login'] = $login;
$page['error'] = $Error;
$page['datetime'] = FORMAT_TIME;
$page['cats'] = $database->num_rows("select * from categories");
$page['topics'] = $database->num_rows("select * from topics");
$page['posts'] = $database->num_rows("select * from posts");
$page['groups'] = $database->num_rows("SELECT * FROM categories where isgroup = 1");
$template->load ("templates/create_cat.html");


if( $Auth->level <> 'admin' )
{
	//the user is not an admin
	redirect ("index.php");
		
}
else
{
	
	//the user has admin rights
	
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		
		  $sql = "SELECT cat_id, cat_name, cat_description FROM categories where isgroup = 1";
		 
		$result = $database->query($sql);
		
		
		$catlist= '<select name="groupid" id="groupid"><option value="0">None</option> ';
					if ($result){
					$cat = $database->get_results($sql);
					
					foreach ($cat as $row)
					{
						$catlist .= '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
						
					}
				}
					// publish
					$template->replace ("catlist",$catlist); 
					if($site->settings['showphp'] === false) { $template->removephp();}
					$template->replace_vars($page); 
					$template->publish();
					
	}
	else
	{
		//the form has been posted, so save it
		$sql = "INSERT INTO categories(cat_name, cat_description , isgroup, groupid)
		   VALUES('" . mysql_real_escape_string($_POST['cat_name']) . "',
				 '" . mysql_real_escape_string($_POST['cat_description']) ."',
				 '".mysql_real_escape_string($_POST['isgroup'])."',
				 '".mysql_real_escape_string($_POST['groupid'])."')";
		$result = $database->query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysql_error();
		}
		else
		{
			//$template->replace_vars($page); 
			//$template->publish();
			redirect('index.php');
		}
	} 
}


?>
