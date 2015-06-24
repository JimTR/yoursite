<?php
//create_topic.php
// this no longer works ! sift the group
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
define('AREA',2); 
require DOC_ROOT.'/includes/master.inc.php'; // required
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
@$getid = intval($_GET['id']);

$template = new Template; 

	$page['header'] = $template->load($site->settings['template_path'].'header.html', COMMENT);
	$page['footer'] = $template->load($site->settings['template_path'].'footer.tmpl', COMMENT);
	$page['include'] = $template->load( $site->settings['template_path'].'include.tmpl', COMMENT);
	$page['css'] = $site->settings['url'].'/css/aqua.css';
	$page['editor_opts'] = "<script>CKEDITOR.replace( 'editor1', {uiColor: '#067AC5',removePlugins: 'elementspath',toolbar: [
					[ 'Bold', 'Italic','Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat', '-', 'NumberedList', 'BulletedList' ],
					[ 'FontSize', 'TextColor', 'Scayt' ], ['JustifyLeft', 'JustifyCenter', 'JustifyRight' ], [ 'Blockquote' , 'Link', 'Image','Smiley','oembed','allMedias'], ['codesnippet'] 
				]
			});</script>"; 
    @$css ="<style>".file_get_contents ($css)."</style>";
    
    if (!@$_GET['id']){$page['navi']= '<a style="color:#FFFFFF" href="index.php">Forum->New Thread</a>';}
    else { $page['navi'] = "add the full nav";}
    $page['base'] = $site->settings['url'].'/css/'.$basecolour;
    $page['users'] = $database->num_rows("select * from sessions");

if($site->settings['showphp'] === false)
{
$template->removephp();
}
    
if($Auth->loggedIn()) 
           {
			   
			     $name = $Auth->username;
			   $nid = $Auth->nid;
			   if ($Auth->level === 'user') {
				  				   
			   $login = $template->load(DOC_ROOT.'/templates/member.html', COMMENT);
		   }
		   elseif ($Auth->level === 'admin') {
			   $login = $template->load(DOC_ROOT.'/templates/admin.html', COMMENT) ;
		   }
			  
			   $page['attach'] = "user".$Auth->id.".txt";
			   $page['login'] = $login;
			   //echo $page['attach'];			   
			    if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown if required
		if ($getid)
			{
				$sql= "SELECT cat_id, cat_name, cat_description FROM categories where cat_id  ='".$getid."' and area = ".AREA; // not working ?
			}
			else
			{
				$sql = "SELECT cat_id, cat_name, cat_description FROM categories where isgroup = '0' and area =".AREA;
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
					$page['navi']= '<a style="color:#FFFFFF" href="index.php">Forum->New Thread</a>';
    				$page['catlist']= '<br />
					<label>Area:</label> <select name="topic_cat">';
					$cat = $database->get_results($sql);
					foreach ($cat as $row)
					{
						$page['catlist'] .= '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
						//print_r($row);
						//die();
					}
				$page['catlist'].= '</select>';}	
					else {
						$cat = $database->get_results($sql);
						foreach ($cat as $row){}
					$page['navi'] = '<a style="color:#FFFFFF" href="index.php">Forum-></a><a style="color:#FFFFFF" href="category.php?id='.$row['cat_id'].'">'. $row['cat_name'] .'-></a>New Thread';
					$page['catlist'] = '<input type= "hidden" name= "topic_cat" value ="'.$getid.'">';}
					$template->load("templates/create_thread.html", COMMENT);   
						$page['query'] = $database->total_queries();
	                    $template->replace_vars($page);
	                    $linecount = filelength($_SERVER['SCRIPT_FILENAME']);
                        $test =page_stats($linecount,$page['query'],$start);
    $adminstats= "Page generated in ".$test['time']." seconds. &nbsp;
     PHP ".$test['php']."% SQL ".$test['sql']."% 
     SQL Queries  ". $test['query']; 
      
     if (@$Auth->level === 'admin')
    { 
		$template->replace("adminstats", $adminstats);
	}
	else { $template->replace("adminstats", ""); }	    
     $template->replace("adminstats", $adminstats);    
					$template->replace("title", "Create Thread");
					$template->replace("newthread",$newthread);
					$template->replace("newpost",$newpost);
					$template->replace("datetime", FORMAT_TIME);
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
			//add the area dummo 
			$sql = "INSERT INTO 
						topics(topic_subject,
							   topic_date,
							   topic_cat,
							   topic_by,
							   topic_ip
							   )
				   VALUES('" . mysqli_real_escape_string($database->link,$_POST['topic_subject']) . "',
							   NOW(),
							   " . mysqli_real_escape_string($database->link,$_POST['topic_cat']) . ",
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
				$content = $database->escape($_POST['post_content']);
				$time_stamp = time();
				//die ("content = ".$time_stamp);			
				$sql = "INSERT INTO
							posts(post_content,
								  post_date,
								  post_stamp,
								  post_topic,
								  post_by,
								  post_ip)
						VALUES
							('" . $content . "',
								  NOW(),
								  " . $time_stamp .", 
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
				 
				 //$post_id = $database->lastid();
				//		 
							
				else
				{
					// this code adds the field data
					$post_id = $database->lastid();
					$sql = "INSERT INTO
							post_fields_data (post_id)
						VALUES
						 ('".$post_id."')";
				    $result= $database->query($sql);
				    
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
					//$login = file_get_contents( $site->settings['url'].'/templates/guest.html') ;
					
					//echo 'Sorry, you have to be <a href="/login.php">signed in</a> to create a topic.';
					//echo 'should call error.php';
					redirect ("index.php");
					
				}
				
	writeid ($id,$nid,$database);

?>
