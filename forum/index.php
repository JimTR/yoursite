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
			    
			   }
			   
	else
				{
					$name ="Guest";
					$login = file_get_contents( $site->settings['url'].'/templates/guest.html') ;
					$basecolour = "aqua";
					// add default colour from config
				}
				
	writeid ($id,$nid,$database);
	
	$template = new Template; // start the template workspace		
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
    
    $sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id
			order by categories.cat_id";
			
			$root = $database->get_results($sql);
					
			foreach($root as $row)
		{			
				//$data=$row; // start the array forum row array
				$threads= $database->num_rows("select * from topics where topic_cat ='".$row['cat_id']."'");
				$countpost= 
							"SELECT posts . * , topic_date, topic_cat, topic_subject, topic_id, cat_id,username
							FROM posts
							LEFT JOIN users ON post_by = id
							LEFT JOIN topics ON topic_id = post_topic
							LEFT JOIN categories ON topic_cat = cat_id
							WHERE topic_cat = '".$row['cat_id']."'
							ORDER BY post_date DESC";
							
							
						$cat_id = $row['cat_id']; // get the cat stuff
						$cat_name = $row['cat_name'];
						$cat_description = $row['cat_description'];
						$posts =$database->num_rows($countpost); // get posts in a cat
						
				$topicsql = "SELECT
									posts.*,
									topic_date,
									topic_cat,
									topic_subject,
									topic_id,
									username,
									level
								FROM
									posts
									
								LEFT JOIN users ON post_by = id
								LEFT JOIN topics ON topic_id = post_topic
								
									
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									post_date
								DESC
								LIMIT
									1";
									
						 $data = $database->get_results($topicsql);
						 foreach ($data as $userstuff) {};
							$template->load("templates/forum_row.html");
							$post_topic= $userstuff['post_topic'];
							$topic_subject = $userstuff['topic_subject'];
							$user_name = $userstuff['username'];
							$last_time = date('d-m-Y H:i:s', strtotime($userstuff['post_date']));
							
                         if ($posts === 0) { $template->replace("last_user","Never");}
								
						else {$template->replace("last_user",'<a href="topic.php?id=#post_topic#">#topic_subject#</a> by #user_name# #last_time#');}
				
									$template->replace("post_topic",$post_topic);
									$template->replace("cat_id",$cat_id);
									$template->replace("cat_name",$cat_name);
									$template->replace("cat_description",$cat_description);
									$template->replace("threads",$threads);
									$template->replace("posts",$posts);
									$template->replace("last_time",$last_time);
									$template->replace("user_name",$user_name);
									$template->replace("topic_subject",$topic_subject);
									$rowd.= $template->get_template();         
			}
			
        
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
$template->replace("rowd",$rowd);
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
