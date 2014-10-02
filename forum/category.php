<?php
//category.php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // do login or not

    $getid = intval($_GET['id']); //stop injection 
    $template = new Template; // start the template workspace
    $header = $template->load('templates/header.html');
	$footer = $template->load(  $site->settings['url'].'/templates/footer.tmpl');
	$include = $template->load( $site->settings['url'].'/templates/include.tmpl');
	$users = $database->num_rows("select * from sessions");
	
    if ($getid === 0) {die ("get = ".$getid);}
if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   $id = session_id();
			   $nid = $Auth->nid;
			    $login = '<li><a href="'.$site->settings['url'].'/user.php">Settings</a></li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li>';
			    
			    
			   }
			   
	else
				{
					$name ="Guest";
					$login = $template->load( $site->settings['url'].'/templates/guest.html') ;
					// add default colour from config
				}
				
	writeid ($id,$nid,$database);
			
	
	
	$pmnew=0; // for later
    	
//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description,
			topics.topic_date,
			topics.topic_subject,
			topics.topic_id,
			posts.post_date,
			topics.topic_views,
			(SELECT posts.post_date FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_Action,
			COUNT( posts.post_id ) AS totalp,
			(SELECT posts.post_by FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_User,
			(SELECT users.username FROM users WHERE users.id = Latest_User ORDER BY users.id DESC limit 1) as Last_Username  
		FROM
			categories
		LEFT JOIN 
			topics ON topics.topic_cat = cat_id
		JOIN 
			posts on topics.topic_id = posts.post_topic		
		WHERE
			cat_id = " . mysql_real_escape_string($getid).
			" 
		GROUP BY 
			topics.topic_subject 
		ORDER BY 
			Latest_Action DESC"
			;
		

	$result = $database->get_results($sql);
	$toprow = $database->get_row($sql);
	
	
	// do a worker template for the navi 14-9-14 /new sql does the whole lot
	$navi= '<a style="color:#FFFFFF" href="index.php">Forum</a><span class="icon icon-16 icon-angle-right"></span>'.$toprow[1];
	$newthreads = '<button class="button" onclick= window.location.replace("create_topic.php?id='.$toprow[0].'")>New Thread</button>'; 
   

if(!$result)
{
	echo 'The Forum could not be displayed, please try again later.' . mysql_error();
}
 

else
{
			//display category data
		
		foreach ($result as $row)
		{
				
					//echo "got to here inloop ".$row['topic_subject']."<br>";
					// lets get the stats
					//print_r ($row);
					$stats = $row['totalp'];
					$replies = $row['topic_views'];
					$username  = $row['Last_Username'];
					$last_time =  time2str($row['Latest_Action']); 	
					$rowd .= '<tr style ="border-bottom:1px solid #000000;border-top:1px solid transparent"><td width="1">
					<span class="icon icon-32 icon-comment color-yellow float-left"></span></td><td><h3><a href="topic.php?id=' . $row['topic_id'] . '">'
					 . $row['topic_subject'] . '</a><br /><h3></td>
				    <td  style="text-align:center">'.$stats.'</td><td><center>'.$replies.'</center></td><td><center>'.$last_time.' By  '.$username.'</center></td></tr>'; 
				
			}
		//echo $rowd;
		//die();
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
$template->replace("newthreads",$newthreads);
$template->replace("datetime", FORMAT_TIME);
$template->replace("base",$base);
$template->replace("pmnew",$pmnew);

if($site->settings['showphp'] === false)
{
$template->removephp();
}
$template->publish();
?>
