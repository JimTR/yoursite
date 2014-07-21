<?php
//category.php
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // do login or not
//include 'connect.php';
//include 'header.php';
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
	$header = file_get_contents ( $site->settings['url'].'/templates/header.html');
	$footer = file_get_contents (  $site->settings['url'].'/templates/footer.tmpl');
	$include = file_get_contents ( $site->settings['url'].'/templates/include.tmpl');
	$css = $site->settings['url'].'/css/aqua.css';
    $css ="<style>".file_get_contents ($css)."</style>";
    $base = $site->settings['url'].'/css/'.$basecolour;
    $pmnew=0;
    	
//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			categories
		WHERE
			cat_id = " . mysql_real_escape_string($_GET['id']);

$result = $database->get_results($sql);
$toprow = $database->get_row($sql);
//die (print_r($toprow));
$navi= '<a style="color:#FFFFFF" href="index.php">Forum->'.$toprow[1].'</a>';
$newthreads = '<a href="create_topic.php?id='.$toprow[0].'">New Thread</a>';

if(!$result)
{
	echo 'The Forum could not be displayed, please try again later.' . mysql_error();
}
else
{
	if($database->num_rows($sql) == 0)
	{
		echo 'This Forum does not exist.';
	}
	
	
		//display category data
		
		while($row = $database->get_results ($result))
		{
			echo '<h2>Threads in &prime;' . $row['cat_name'] . '&prime; category</h2><br />';
			
		}
	/*SELECT posts. * , topic_id, topic_subject, topic_date, topic_cat, username, COUNT( * ) AS count
FROM posts
LEFT JOIN users ON post_by = id
LEFT JOIN topics ON topic_id = post_topic
WHERE topic_cat =  '3'
GROUP BY post_topic
ORDER BY  `posts`.`post_date` DESC */
		//do a query for the topics
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					topics
				WHERE
					topic_cat = " . mysql_real_escape_string($_GET['id']);
	
		$result = $database->get_results ($sql);
		
		
		
		{
			if($database->num_rows($sql) == 0)
			{
				$rowd = '<tr><td colspan="5" style="text-align:center">There are no threads in this forum yet.</td></tr>';
			}
			else
			{
				
					
				foreach ($result as $row)
				{			
					// lets get the stats
					$stats= $database->num_rows("SELECT * FROM posts where post_topic =".$row['topic_id']);
					$replies=$stats-1; 
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
									post_topic = " . $row['topic_id'] . "
								ORDER BY
									post_date
								DESC
								LIMIT
									1";
									$data = $database->get_results($topicsql);
									foreach ($data as $userstuff) {};
										
					$rowd .= '<tr><td class="leftpart"><h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3></td>
						 <td  style="text-align:center">'.$stats.'</td><td><center>'.$replies.'</center></td><td><center>'.date('d-m-Y H:i:s', strtotime($userstuff['post_date'])).' By  '.$userstuff['username'].'</center></td></tr>'; 
				}
			}
		}
	}

// do main template
$template->load("templates/category.html");
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
$template->replace("navi",$navi);
$template->replace("rowd",$rowd);
$template->replace("newthread",0);
$template->replace("newpost",0);
//die ($newthreads);
$template->replace("newthreads",$newthreads);
$template->replace("datetime", FORMAT_TIME);
$template->replace("base",$base);
$template->replace("pmnew",$pmnew);
if($site->settings['showphp'] === false)
{
$template->removephp();
}
$template->publish();
//include 'footer.php';
?>
