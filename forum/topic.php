<?php
//topic.php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // load connection & user functions
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
$template = new Template;
  $getid = intval($_GET['id']);
  $activetab = intval($_GET['activetab']);  

if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   $id = session_id();
			   $nid = $Auth->nid;
			   //$sql = "select * from users where nid = '".$nid."'";
               //$user_fields = $database->get_row ($sql);
			   if ($Auth->level === 'user') {
			   $page['warn'] = $name;   				   
			   $login = $template->load($site->settings['template_path'].'member.html', COMMENT);
		   }
				elseif ($Auth->level === 'admin') {
			   $login = $template->load($site->settings['template_path'].'admin.html', COMMENT) ;
		   }
			   $page['basecolour'] = "aqua";
			   $editor = $template->load($site->settings['template_path'].'forum/editor.html'); //load the editor for all logged in switch it off with permissions
			   $page['warn'] = $name;
			   
			    
			   }
			   
else
				{
					$name ="Guest";
					$login = $template->load( $site->settings['template_path'].'guest.html') ;
					$page['basecolour'] = "aqua";
					$editor = ''; /// set the editor off 
					$page['warn'] = "";
					// add default colour from config
				}
				
	writeid ($id,$nid,$database);

	$css = $site->settings['url'].'/css/aqua.css';
	$page['attach'] = DOC_ROOT."/forum/user".$Auth->id.".txt";
	$page['css'] ="<style>".file_get_contents ($css)."</style>";
    $page['base'] = $site->settings['url'].'/css/'.$page['basecolour'];
    $page['header'] = $template->load($site->settings['template_path'].'header.html', COMMENT);
	$page['include'] = $template->load($site->settings['template_path'].'include.tmpl', COMMENT);
	$page['footer'] = $template->load ($site->settings['template_path'].'footer.tmpl', COMMENT);
	//die($page['include']);
	$page['file'] = "user".$Auth->id.".txt";
	$page['vari'] = $database->num_rows("select * from sessions");	
	$page['login'] = $login;
	$page['editor'] = $editor;
	$post_info['signature'] = "Signatures disabled";
	$page['navi'] ='<a href="index.php?activetab='.$activetab.'">Community</a>';
	$page['newthread'] = 0;
	$page['usertitle'] = "";
	$page['pmnew'] = 0;
	$page['path'] = $site->settings['url'];
	
//print_r($page);
//die();
// start code 
$sql = "SELECT
			topic_id,
			topic_subject,
			topic_cat,
			topic_views,
			cat_name,
			cat_id
						
		FROM
			topics
		LEFT JOIN 
				categories
			on topic_cat = cat_id
		
		WHERE
			topics.topic_id = " . mysqli_real_escape_string($database->link,$getid).
			" ORDER BY `topic_date` DESC";
			
$result = $database->query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
	// send to error.php
}
else
{

	if( $database->num_rows($sql) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
		// send to error.php - should not happen
	}
	
	else
	{
		
		      $data = $database->get_results($sql);
						 foreach ($data as $row) {}; // i need to alter the db class
						 $ids['topic_id'] = $row['topic_id'];
						 $dataset['topic_views'] = $row['topic_views']+1;
						 $database->update("topics",$dataset,$ids);
		
			//display post data
			 
			        $page['navi'].=' >> <a href="category.php?id='.$row['topic_cat'].'&activetab='.$activetab.'">'.$row['cat_name'].'</a> >> '.$row['topic_subject'];
					$subject=$row['topic_subject'];
					$page['topic_id'] = $row['topic_id'];
					
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						posts.post_id,
						posts.post_ip,
						users.id,
						users.username,
						users.level,
						users.regdate,
						users.nid,
						users.avatar,
						users.sig,
						users.postnum,
						users.topicnum,
						users.url
																		
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.id
					WHERE
						posts.post_topic = " . mysqli_real_escape_string($database->link,$getid).
						" order by posts.post_stamp ASC";
						
			//die ($posts_sql);			
			$posts_result = $database->query($posts_sql);
			
			if(!$posts_result)
			{
				echo 'The posts could not be displayed, please try again later.';
				$page['poo'] = '';
				
			}
			else
			{
			    $post_data = $database->get_results($posts_sql);
			    $test= $database->num_rows($posts_sql);
			    $pageno++;
			    $pid = 1;
			    $page['poo'] ="";
			    $page['posts'].= '<div id ="p'.$pageno.'" class="pag">';
				foreach ($post_data as $posts_row)
				{
				    $onlinesql = "select * from sessions where nid = '".$posts_row['nid']."'";
					$online = $database->num_rows($onlinesql);
					//echo $onlinesql."<br>";
					if (empty($posts_row['avatar'])) {$posts_row['avatar'] = $page['path'].'/images/default_avatar.png';}
					if (empty($posts_row['sig'])) {$posts_row['sig'] = '&nbsp;';}
					if ($online){
						        $testing = $database->get_row($onlinesql);
						        //printr($testing);
						        $inactive = time()-(5*60);
						        //echo "time -- ".time()."  inactive -- ".$inactive;
						        
						        if ($testing['updated_on'] > $inactive ){
									$online = '<span class="icon icon-16 icon-circle color-green float-left tip3" title="Online"></span>';
								}
								else{
								$online='<span class="icon icon-16 icon-circle color-yellow float-left tip3" title = "In active"></span>';
							}
								} 
					else {
						$online = '<span class="icon icon-16 icon-circle color-red float-left tip3" title = "Offline"></span>';
						}
					$post_info['quote'] ="";
					$post_info['reply'] ="";
					$post_info['edit'] ="";
					$post_info['delete']="";
					$post_info['www']="";
					$post_info['iplogged']='';
					$post_info['postid'] = $pid;
					$post_info['postid1'] = $posts_row['post_id'];
					$post_info['total_posts'] = $posts_row['postnum'];
					$post_info['total_threads'] = $posts_row['topicnum'];
					$post_info['path']= $page['path'];
					$post_info['postdate'] = date('d-m-Y', strtotime($posts_row['post_date']));
					$post_info['posttime'] = date('H:i', strtotime($posts_row['post_date']));
					$post_info['username'] = $posts_row['username'];
					$post_info['post_content'] = html_entity_decode(stripslashes($posts_row['post_content']));
					$post_info['post_subject'] = $subject; // will update when each post has a subject in fact no need to do this
					$post_info['profilelink']= $posts_row['username']; // later do a link
					$post_info['onlinestatus'] = $online;
					$post_info['avatar'] = $posts_row['avatar'];
					$post_info['attachments'] = "";
					//echo $posts_row['regdate'];
					$post_info['regdate'] = date('M Y', $posts_row['regdate']);
					//$post_info['iplogged']='some shit is looking';
					$post_info['signature'] = $posts_row['sig'];
					/* button code to go here add the buttons as defined names using the priv to mark valid buttons
					 * now do the priv stuff as an if type statement
					 * load the template per button this should be a function
					 * select * FROM sessions WHERE `updated_on` < (UNIX_TIMESTAMP() - 600)
					 */  
					
					$post_info['home'] = setbutton("Home","index.php",true);
					if (!empty($posts_row['url'])){ $post_info['www'] = setbutton ("www", $posts_row['url'],true, "webpage"); }
					if($Auth->loggedIn()){
						$post_info['quote'] = setbutton("Quote","quote('pid_".$pid."','".$post_info['profilelink']."','".$post_info['postdate']."')",false);
						$post_info['reply'] = setbutton("Reply",'editor.php',true,"iframeAnchor");
						
						
						if ($Auth->level === 'admin' or $post_info['username'] === $name ) {
							$post_info['edit'] = setbutton("Edit","editpost.php?pid=".$post_info['postid1'],true);
							$post_info['delete'] = setbutton("Delete","deletepost.php?action=".$post_info['postid1'],true);
						}
						if ($Auth->level=== 'admin') {$post_info['iplogged']= setbutton('IP Info', "ips.php?ip=".$posts_row['post_ip'].'&action=view',true,"ippage");}
						}
						
					//$template->publish;
					//print_r ($post_info);
					//die();					
					$template->load($site->settings['template_path'].'forum/post.html', COMMENT);
					$template->replace_vars($post_info);
					$page['posts'].= $template->get_template(); // add the posts
					$pg = $pid % 5; // check page length
                    if ($pg === 0) {
						//$page['posts'].= "end page ".$pageno."<br>";
						if ($test > 5 and $pid < $test ){
						$page['poo'] .= '<li class="dummy" href = "#'.$pageno.'"><a href="#p'.$pageno.'">'.$pageno.'</a></li>';
						$pageno++;
						$page['posts'] .= '</div><div id ="p'.$pageno.'" class ="pag hidden-tab">'; }
						// adds the page
						
						}
                    $pid++; 
				}
                   //$page['posts'].= "end page ".$pageno."<br>";
                   if ($test > 5 ){
                   $page['poo'] .= '<li class="dummy" href = "#'.$pageno.'"><a href="#p'.$pageno.'">'.$pageno.'</a></li>';
                   }
                   $page['posts'] .= "</div></div>";
                   //finishes the last div
			}
			
			
			
			//finish the table
			if(!$Auth->loggedIn())
			{
				
				$page['warn']= 'You must be signed in to reply.';
				//redundant !
			}
			 
			    $page['cat_id'] = $row['cat_id'];
				$template->load($site->settings['template_path'].'forum/topic.html',COMMENT);
				//die('loaded');
				$page['query'] = $database->total_queries();
				//$page['navi'] .= "</div>";
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
				$template->replace_vars($page);
			    $template->replace("title","Thread");
				$template->replace("datetime", FORMAT_TIME);
				$template->replace("topicsubject",$subject);
				$template->publish();
				
			
		
	}
}

function setbutton($text,$location,$type,$class="") {
	// load the button as per
	                $button = new Template; //define a new template
					
					
					if ($type === true)
					{
						$button->load('templates/button.html',true);
					    
					}
					 else
					 {
						$button->load('templates/pagebutton.html',true); 
						
					}
					$button->replace("loctext",$text);
					$button->replace("location",$location);
					$button->replace("class",$class); 
					return $button->get_template();
}
?>
