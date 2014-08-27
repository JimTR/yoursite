<?php
//create_topic.php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // required
$getid = intval($_GET['id']);

$template = new Template; 

	$header = $template->load('templates/header.html');
	$footer = $template->load($site->settings['url'].'/templates/footer.tmpl');
	$include = $template->load( $site->settings['url'].'/templates/include.tmpl');
	$css = $site->settings['url'].'/css/aqua.css';
	$editor_opts = "<script>CKEDITOR.replace( 'editor1', {uiColor: '#067AC5',removePlugins: 'elementspath',toolbar: [
					[ 'Bold', 'Italic','Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat', '-', 'NumberedList', 'BulletedList' ],
					[ 'FontSize', 'TextColor', 'Scayt' ], ['JustifyLeft', 'JustifyCenter', 'JustifyRight' ], [ 'Blockquote' , 'Link', 'Image','Smiley','oembed','allMedias'], ['codesnippet'] 
				]
			});</script>"; 
    $css ="<style>".file_get_contents ($css)."</style>";
    
    if (!$_GET['id']){$navi= '<a style="color:#FFFFFF" href="index.php">Forum->New Thread</a>';}
    else { $navi = "add the full nav";}
    $base = $site->settings['url'].'/css/'.$basecolour;
    $users = $database->num_rows("select * from sessions");
$template->load("templates/create_thread.html");    	
$template->replace("css",$css);
$template->replace("editor_opts",$editor_opts);
$template->replace("error",$Error);
$template->replace("title", "Create Thread");
$template->replace("header", $header);
$template->replace("login",$login);
$template->replace("footer", $footer);
$template->replace("include", $include);
$template->replace ("path", $site->settings['url']);
$template->replace("name",$name );
$template->replace("vari",$users);
$template->replace("pmnew",0);
$template->replace("rowd",$rowd);
$template->replace("newthread",$newthread);
$template->replace("newpost",$newpost);
$template->replace("datetime", FORMAT_TIME);
$template->replace("base",$base);
if($site->settings['showphp'] === false)
{
$template->removephp();
}
    
if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   $id = session_id();
			   $nid = $Auth->nid;
			   $login = '<li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li>';
			   $basecolour = "aqua";
			   
			    if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown if required
		if ($getid)
			{
				$sql= "SELECT cat_id, cat_name, cat_description FROM categories where cat_id  ='".$getid."'";
			}
			else
			{
				$sql = "SELECT cat_id, cat_name, cat_description FROM categories where isgroup = '0'";
			}
			
		$result = $database->query($sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			
			
			if($database->num_rows($sql) == 0 )
			{
				//there are no categories, so a topic can't be posted
				if($Auth->level == 'admin')
				{
					echo 'You have not created Forums yet.';
				}
				else
				{
					echo 'Before you can post a topic, you must wait for an admin to create some forums.';
				}
			}
			else
			{
		       
				if (!$getid){
					$navi= '<a style="color:#FFFFFF" href="index.php">Forum->New Thread</a>';
    				$catlist= '<br />
					Forum: <select name="topic_cat">';
					$cat = $database->get_results($sql);
					foreach ($cat as $row)
					{
						$catlist .= '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
						//print_r($row);
						//die();
					}
				$catlist.= '</select><br />';}	
					else {
						$cat = $database->get_results($sql);
						foreach ($cat as $row){}
						$navi = '<a style="color:#FFFFFF" href="index.php">Forum-></a><a style="color:#FFFFFF" href="category.php?id='.$row['cat_id'].'">'. $row['cat_name'] .'-></a>New Thread';
					$catlist = '<input type= "hidden" name= "topic_cat" value ="'.$getid.'">';}
					$template->replace("catlist",$catlist);
					$template->replace("navi",$navi);
					$template->publish();
					
								 
			}
		}
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = $database->query($query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your topic. Please try again later.';
			
		}
		else
		{
	
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			//die ("ready to insert all ok");
			$topicip = getip();
			//die ($topicip);
			$sql = "INSERT INTO 
						topics(topic_subject,
							   topic_date,
							   topic_cat,
							   topic_by,
							   topic_ip
							   )
				   VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "',
							   NOW(),
							   " . mysql_real_escape_string($_POST['topic_cat']) . ",
							   " .$Auth->id . ",
							   '" .$topicip."'
							   )";
					 //die ($sql);
			$result = $database->query($sql);
			//die ($sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occured while inserting your data. Please try again later.<br /><br />' . mysql_error();
				die();
				$sql = "ROLLBACK;";
				$result = $database->query($sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				
				$topicid = $database->lastid();
				//die ("topic id = ".$topicid);
				$ip = getip();
								
				$sql = "INSERT INTO
							posts(post_content,
								  post_date,
								  post_topic,
								  post_by,
								  post_ip)
						VALUES
							('" . mysql_real_escape_string($_POST['post_content']) . "',
								  NOW(),
								  " . $topicid . ",
								  " . $Auth->id . ",
								  '" . $ip ."'
							)";
							//die($_POST['post_content']);
				$result = $database->query($sql);
				
				if(!$result)
				{
					//something went wrong, display the error & rollback
					echo 'An error occured while inserting your post. Please try again later.<br /><br />' . mysql_error();
					$sql = "ROLLBACK;";
					die();
					$result = $database->query($sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = $database->query($sql);
					
					//after a lot of work, the query succeeded!
					// redirect to the topic
					redirect("topic.php?id=". $topicid);
					//echo "should be in";
				}
			}
		}
	}
			    
			   }
			   
	else
				{
					$name ="Guest";
					$login = file_get_contents( $site->settings['url'].'/templates/guest.html') ;
					$basecolour = "aqua";
					// add default colour from config
					echo 'Sorry, you have to be <a href="/login.php">signed in</a> to create a topic.';
				}
				
	writeid ($id,$nid,$database);

?>
