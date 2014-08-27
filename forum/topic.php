<?php
//topic.php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // required
$template = new Template;
  $getid = intval($_GET['id']);
    

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

	$css = $site->settings['url'].'/css/aqua.css';
	$page['css'] ="<style>".file_get_contents ($css)."</style>";
    $page['base'] = $site->settings['url'].'/css/'.$page['basecolour'];
    $page['header'] = $template->load("templates/header.html");
	$page['include'] = $template->load($site->settings['url']."/templates/include.tmpl");
	$page['footer'] = $template->load ($site->settings['url'].'/templates/footer.tmpl');
	$page['vari'] = $database->num_rows("select * from sessions");	
	$page['login'] = $login;
	$post_info['signature'] = "Signatures disabled";
	$page['navi'] ='<a style="color:#FFFFFF" href="index.php">Forum</a>';
	$page['newthread'] = 0;
	$page['pmnew'] =0;
	$page['path'] = $site->settings['url'];

// start code 
$sql = "SELECT
			topic_id,
			topic_subject,
			topic_cat,
			topic_views,
			cat_name
						
		FROM
			topics
		LEFT JOIN 
				categories
			on topic_cat = cat_id
		
		WHERE
			topics.topic_id = " . mysql_real_escape_string($getid).
			" ORDER BY `topic_date` DESC";
			
$result = $database->query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{

	if( $database->num_rows($sql) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		
		      $data = $database->get_results($sql);
						 foreach ($data as $row) {}; // i need to alter the db class
						 $ids['topic_id'] = $row['topic_id'];
						 $dataset['topic_views'] = $row['topic_views']+1;
						 $database->update("topics",$dataset,$ids);
		
			//display post data
			 
			        $page['navi'].='-><a style="color:#fff" href="category.php?id='.$row['topic_cat'].'">'.$row['cat_name'].'</a>->'.$row['topic_subject'];
					$subject=$row['topic_subject'];
					$page['topic_id'] = $row['topic_id'];
					
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						posts.post_id,
						users.id,
						users.username,
						users.level,
						users.nid,
						users.avatar,
						users.sig
						
						
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.id
					WHERE
						posts.post_topic = " . mysql_real_escape_string($getid);
						
						
			$posts_result = $database->query($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			    $post_data = $database->get_results($posts_sql);
			    $test= $database->num_rows($posts_sql);
			    
				foreach ($post_data as $posts_row)
				{
					$pid =++ $pid;
					$online = $database->num_rows("select * from sessions where nid = '".$posts_row['nid']."'");
					if (empty($posts_row['avatar'])) {$posts_row['avatar'] = $page['path'].'/images/default_avatar.png';}
					if (empty($posts_row['sig'])) {$posts_row['sig'] = '&nbsp;';}
					if ($online == 1){$online='<img src ="'.$page['path'].'/images/online.png">';} else {$online = '<img src ="'.$page['path'].'/images/offline.png">';}
					$post_info['postid'] = $pid;
					$post_info['postid1'] = $posts_row['post_id'];
					$post_info['path']= $page['path'];
					$post_info['postdate'] = date('d-m-Y', strtotime($posts_row['post_date']));
					$post_info['posttime'] = date('H:i', strtotime($posts_row['post_date']));
					$post_info['username'] = $posts_row['username'];
					$post_info['post_content'] = html_entity_decode(stripslashes($posts_row['post_content']));
					$post_info['post_subject'] = $subject; // will update when each post has a subject
					$post_info['profilelink']= $posts_row['username']; // later do a link
					$post_info['onlinestatus'] = $online;
					$post_info['avatar'] = $posts_row['avatar'];
					$post_info['attachments'] = "";
					$post_info['iplogged']='';
					$post_info['signature'] = $posts_row['sig'];
					$template->load("templates/post.html");
					$template->replace_vars($post_info);
					$page['posts'].= $template->get_template();
					
				}

			}
			
			
			
			//finish the table
			if(!$Auth->loggedIn())
			{
				
				$page['warn']= 'You must be signed in to reply.';
			}
			else {$page['warn']= "";}
			
				$template->load("templates/topic.html");
				$template->replace_vars($page);
				
				$template->replace("title","Thread");
				$template->replace("datetime", FORMAT_TIME);
				$template->replace("topicsubject",$subject);
				$template->publish();
				
			
		
	}
}

//include 'footer.php';
?>
