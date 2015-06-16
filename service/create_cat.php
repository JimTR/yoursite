<?php
//create_cat.php

define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // required
define('AREA','3');
if ($_POST['action'] == 'Quit') { redirect ('index.php');} // hit the quit button see template
$template = new Template;

if($Auth->loggedIn()) 
           {
			   //die("auth done logged in");
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
					redirect ("index.php");
					die("auth done guest ");
					// add default colour from config
				}
				
	writeid ($id,$nid,$database); 
if ($site->settings['https'] == AREA)
		{
			$site->settings['url'] = preg_replace("/^http:/i", "https:", $site->settings['url']);
			
		}		
$page['header'] = $template->load(DOC_ROOT.'/templates/header.html', COMMENT);
$page['footer'] = $template->load(DOC_ROOT.'/templates/footer.tmpl', COMMENT);
$page['include'] = $template->load( DOC_ROOT.'/templates/include.tmpl', COMMENT);
$page['navi'] = '<a style="color:#FFFFFF" href="index.php">Shop->New Category</a>';
$page['title'] = "Create Category";
$page['path'] = $site->settings['url'];
$page['login'] = $login;
$page['error'] = $Error;
$page['datetime'] = FORMAT_TIME;
$page['cats'] = $database->num_rows("select * from categories");
$page['topics'] = $database->num_rows("select * from topics");
$page['posts'] = $database->num_rows("select * from posts");
$page['groups'] = $database->num_rows("SELECT * FROM categories where isgroup = 1");
$template->load (DOC_ROOT."/templates/create_cat.html", COMMENT);


if( $Auth->level <> 'admin' )
{
	//the user is not an admin
	die ("hit a none admin");
	redirect ("index.php");
		
}
else
{
	
	//the user has admin rights
	
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		
		  $sql = "SELECT cat_id, cat_name, cat_description FROM categories where isgroup = 1 and area =".AREA ;
		 
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
		$sql = "INSERT INTO categories(cat_name, cat_description , isgroup, groupid,area)
		   VALUES('".$database->escape($_POST['cat_name']) . "',
				 '".$database->escape($_POST['cat_description']) ."',
				 '".$database->escape($_POST['isgroup'])."',
				 '".$database->escape($_POST['groupid'])."',
				 '".$database->escape(AREA)."')";
		$result = $database->query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysqli_error();
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
