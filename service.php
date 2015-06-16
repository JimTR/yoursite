
<?php
/*
 * main Index file
 * does very little as it does not need to !
 * COMMENT in the template->load function uses the default setting
 * replace COMMENT with either true or false to over ride this
 */ 
require 'includes/master.inc.php'; // do login and stuff
define ("AREA",0);
define ("FORUM",1);
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
$template = new Template;
$a=0;
$id = session_id();
//printr($Auth);
//die();
if($Auth->loggedIn()) 
           {
			  
			   $name = $Auth->username;
			   $level = $Auth->level;
			   $nid = $Auth->nid;
			   if ($Auth->level === 'user') {
				  				   
			   $login = $template->load(DOC_ROOT.'/templates/member.html', COMMENT);
		   }
		   elseif ($Auth->level === 'admin') {
			   $login = $template->load(DOC_ROOT.'/templates/admin.html', COMMENT) ;
		   }
		   }
						   
	else
				{
					$name ="Guest";
					$login = $template->load('templates/guest.html', COMMENT) ;
					$level = 'guest';
					
				}
				//writeid ($id,$nid,$database);
$css = 'css/main.css';
$css ="<style>".file_get_contents ($css)."</style>";

    $page['users'] = $database->num_rows("select * from sessions"); // online users count
	$page['header'] = $template->load('templates/header.html', COMMENT); // load header
	$page['footer'] = $template->load($site->settings['url'].'/templates/footer.tmpl', COMMENT);
	$page['include'] = $template->load($site->settings['url'].'/templates/include.tmpl', COMMENT);
	$page['login'] = $login;
	
	//$page['path'] = $site->settings['url'];
	$page['datetime'] = FORMAT_TIME;
	$page['title'] .= " - Home";
	
	
$sql = "SELECT posts. * , users.username, users.avatar, topics.topic_subject, permissions.*
FROM  `posts` 
JOIN users ON posts.post_by = users.id
JOIN topics ON posts.post_topic = topics.topic_id
JOIN categories ON topics.topic_cat = categories.cat_id 
LEFT JOIN permissions ON categories.cat_id = permissions.pcat_id 
where categories.area = ".FORUM."
ORDER BY  `post_date` DESC 
";
//echo $sql;
//die();
$newposts = $database->get_results($sql);

foreach ($newposts as $row)
{	// decode the row
	   $priv = explode(",",$row[$level]);
	   
					if ($priv[0] === '0')
	                 {
						 goto noview;
						  
					} 
		$viewpost++;
		if ($viewpost >$site->settings['per_page'])
				{
						break;
					}
						
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
	$template->load("templates/post.html", COMMENT);
	$template->replace_vars($post_info);
	$page['newposts'].= $template->get_template();
	noview:
					}  
	$pms="0";	


$template->load("templates/page.html", COMMENT);
$template->replace("css",$css);
$template->replace("pms",$pms);
if($site->settings['showphp'] === false)
{
$template->removephp();
}
      $page['query'] = $database->total_queries();
	  
	//echo 'There were '. $database->total_queries() . ' queries performed';
     
     if ($Auth->level === 'admin')
    { 
		$linecount = filelength($_SERVER['SCRIPT_FILENAME']);
     $test =page_stats($linecount,$page['query'],$start);
     $page['adminstats']= "Page generated in ".$test['time']." seconds. &nbsp;
     PHP ".$test['php']."%  &nbsp;SQL ".$test['sql']."% &nbsp; 
     SQL Queries  ". $test['query'];
    
	}
	else { $page['adminstats'] = ""; }
	
$template->replace_vars($page);	    
$template->publish();

?>
