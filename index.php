
<?php
/*
 * main Index file
 * does very little as it does not need to !
 * COMMENT in the template->load function uses the default setting
 * replace COMMENT with either true or false to over ride this
 */ 
 
require 'includes/master.inc.php'; // do login and stuff
//ini_set("zlib.output_compression", "On");
//print_r($page);
//die();
define ("AREA",0);
define ("FORUM",2);
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
$template = new Template;
$a=0;
if (isset($_GET['activetab'])) 
{
	// find out what tab to display
	$activetab = intval($_GET['activetab']);
	//echo $activetab;
}		
else {$activetab = 0;}
$i = 0;
$ul = 0;
$activetab = 0;
$id = session_id();
//printr($page);
//die();
if($Auth->loggedIn()) 
           {
			  
			   $name = $Auth->username;
			   $level = $Auth->level;
			   $nid = $Auth->nid;
			   
			   
			   if ($Auth->level === 'user') {
				  				   
			   $login = $template->load($page['template_path'].'member.html', COMMENT);
		   }
		   elseif ($Auth->level === 'admin') {
			   $login = $template->load($page['template_path'].'admin.html', COMMENT) ;
		   }
		   }
						   
	else
				{
					$name ="Guest";
					$login = $template->load($page['template_path'].'guest.html', COMMENT) ;
					$level = 'guest';
					
				}
				//writeid ($id,$nid,$database);
$groupsql ="SELECT * , permissions.*
					FROM categories
					LEFT JOIN
				    permissions on permissions.pcat_id = cat_id	
					WHERE categories.isgroup <> 0
					AND categories.groupid = 0
					AND categories.area = ".AREA."
					order by disp_order asc";
	

					
  
    $page['users'] = $database->num_rows("select * from sessions"); // online users count
	$page['header'] = $template->load($page['template_path'].'header.html', COMMENT); // load header
	//$hd = $site->settings['template_path'].'header.html';
	$page['footer'] = $template->load($page['template_path'].'footer.tmpl', COMMENT);
	$page['include'] = $template->load($page['template_path'].'include.tmpl', COMMENT);
	$page['logo'] = $site->settings['url'].$site->settings['logo'];
	$page['sitename'] = $site->settings['sitename'];
	$page['login'] = $login;
	$page['email'] = $Auth->loc;
	$page['path'] = $site->settings['url'];
	$page['datetime'] = FORMAT_TIME;
	$page['title'] .= " - Home";
	$sql = "SELECT posts. * , users.username, users.avatar, topics.topic_subject
FROM  `posts` 
JOIN users ON posts.post_by = users.id
JOIN topics ON posts.post_topic = topics.topic_id
JOIN categories ON topics.topic_cat = categories.cat_id 
where categories.area = ".FORUM."
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
	$template->load($page['template_path']."post.html", COMMENT);
	$template->replace_vars($post_info);
	$page['newposts'].= $template->get_template();
					}  
	
	if ($settings['forumtabs'] == true)
    {
		$tabset = $database->num_rows($groupsql);
		if ($tabset < $activetab) {$activetab = 0;}
		$root = $database->get_results($groupsql);
		$tabs = new Template;
			foreach ($root as $row)
				{
					$priv = explode(",",$row[$level]);
					if ($priv[0] === '0')
	                 {
						 goto noview;
					} 
					$tabs->load($page['template_path'].'/tab.html',false); //dont show this templates remarks  
					$tab_entry['tab_id'] = $row['cat_id']; 
					$tab_entry['tab_name'] = $row['cat_name']; 
					$tab_entry['tab_title'] = $row['cat_tooltip'];
					$tab_entry['datetime'] = $page['datetime']; 
					if ($ul == 0 && $activetab == $tab) //sets active tab later it will remember now does it
						{
							$tab_entry['tab_class'] = "active"; // sets the tab active
							$ul =1;
							$class = $class = "cell";
						}         
					else 
						{
							$tab_entry['tab_class'] = ""; // not active
							$ul = 0;
							$class =  "cell hidden-tab";
						}	
						
					$tabs->replace_vars($tab_entry);
					$page['tabs'].= $tabs->get_template(); // add the tab in
					//now add the content !
					$tabs->load($page['template_path'].'/tab_desc.html',false); // load the description template
					$tabs->replace("content",$row['cat_description']);
					
						if  ($tab_entry['tab_class'] = "active")
							{
								//$class = $class = "cell";
							}
						else
							{
								//$class =  "cell hidden-tab";
							}
					$tabs->replace("class",$class);	
					$tabs->replace("id",$row['cat_id']);
					$tabs->replace("path",$page['path']);
					$tabs->replace("title",	$row['cat_name']);
					//$tabs->replace("sitename",$site->settings['sitename']);
					//$tabs->replace("logo"
					$tabs->replace_vars($page);	    
					$page['tab_content'] .=$tabs->get_template();
					$tab++;
					noview:
				}
	
}


$template->load($page['template_path'].'index.html', COMMENT); // load header
$template->replace("css",$css);
$template->replace("pms",$pms);
if($site->settings['showphp'] === false)
	{
		$template->removephp();
	}
      $page['query'] = $database->total_queries();
	  
	
     
     if ($Auth->level === 'admin')
    { 
		$linecount = filelength($_SERVER['SCRIPT_FILENAME']);
     $test =page_stats($linecount,$page['query'],$start);
     $secs = $test['time']/ 1000000;
     $page['adminstats']= "Page generated in ".$test['time'] ." seconds. &nbsp;
     PHP ".$test['php']."%  &nbsp;SQL ".$test['sql']."% &nbsp; 
     SQL Queries  ". $test['query'];
    
	}
	else { $page['adminstats'] = ""; }
	
$template->replace_vars($page);	    

$template->replace("xx",FORMAT_TIME);

$template->publish();

?>
