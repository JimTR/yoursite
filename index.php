
<?php
/*
 * main Index file
 * does very little as it does not need to !
 */ 
require 'includes/master.inc.php'; // do login and stuff
$template = new Template;
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
$css = 'css/main.css';
$css ="<style>".file_get_contents ($css)."</style>";
$users = $database->num_rows("select * from sessions");
$header = $template->load('templates/header.html');
$footer = $template->load ( 'templates/footer.tmpl');
$include = $template->load ('templates/include.tmpl');
writeid ($id,$nid,$database);
// get new posts
$sql = "SELECT posts. * , users.username, users.avatar, topics.topic_subject
FROM  `posts` 
JOIN users ON posts.post_by = users.id
JOIN topics ON posts.post_topic = topics.topic_id
ORDER BY  `post_date` DESC 
LIMIT 0 , 5";
$newposts = $database->get_results($sql);

foreach ($newposts as $row)
{	// decode the row
	
	if (empty($row['avatar'])) {$row['avatar'] = $site->settings['url'].'/images/default_avatar.png';}
	                //$post_info['postid'] = $pid;
					$post_info['postid1'] = $row['post_id'];
					$post_info['path']= $site->settings['url'];
					$post_info['postdate'] = date('d-m-Y', strtotime($row['post_date']));
					$post_info['posttime'] = date('H:i', strtotime($row['post_date']));
					$post_info['username'] = $row['username'];
					$post_info['post_content'] = html_entity_decode(stripslashes($row['post_content']));
					$post_info['post_subject'] = $subject; // will update when each post has a subject
					$post_info['profilelink']= $row['username']; // later do a link
					$post_info['onlinestatus'] = $online;
					$post_info['avatar'] = $row['avatar'];
					$post_info['subject'] = $row['topic_subject'];
					$post_info['attachments'] = "";
					$post_info['iplogged']='';
					$post_info['signature'] = $row['sig'];
	$template->load("templates/post.html");
	$template->replace_vars($post_info);
	$page['posts'].= $template->get_template();
						}  
	//print_r ($page);
	//echo "page end <br>";
	//die(" loop done");
$pms="0";	


$template->load("templates/page.html");
$template->replace("css",$css);
$template->replace("header", $header);
$template->replace("include", $include);
$template->replace("title", "Home");
$template->replace("login",$login);
$template->replace("footer", $footer);
$template->replace("pms",$pms);
$template->replace ("path", $site->settings['url']);
$template->replace("name",$name );
$template->replace("vari",$users);
$template->replace("stuff",$stuff);
$template->replace("newposts",$page['posts']);
$template->replace("reload",$rjs); // fix for ie 
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}

$template->publish();

?>
