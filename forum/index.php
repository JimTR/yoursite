<?php
/*
 * newindex.php
 * 
 * Copyright 2014 Jim Richardson <jim@noideersoftware.co.uk>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * New Forum Index
 * 12-09-2014 
 */
 

define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
//
require DOC_ROOT.'/includes/master.inc.php'; // do login or not
if (!isset($_GET['tabs']))
{
	//die ("use default");
}
elseif (intval($_GET['tabs']) === 1)
{
	$settings['forumtabs'] = true;
		}
		elseif (intval($_GET['tabs']) === 0)
		{
			$settings['forumtabs'] = false;
			
		}
		
$i = 0;
$ul = 0;
$template = new Template; 
if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   $id = session_id();
			   $nid = $Auth->nid;
			   $login = '<ul class="egmenu"><li><a href="'.$site->settings['url'].'/user.php">Settings</a>
			   			   
			   </li><li><a href="'.$site->settings['url'].'/logout.php">Logout</a></li></ul>';
			  
			   
			    
			   }
			   
	else
				{
					$name ="Guest";
					$login = $template->load( $site->settings['url'].'/templates/guest.html') ;
					
				}
				
	
	
	writeid ($id,$nid,$database);
	$page['users'] = $database->num_rows("select * from sessions"); // online users count
	$page['header'] = $template->load('templates/header.html'); // load header
	$page['footer'] = $template->load($site->settings['url'].'/templates/footer.tmpl');
	$page['include'] = $template->load($site->settings['url'].'/templates/include.tmpl');
	$page['login'] = $login;
	$page['datetime'] = FORMAT_TIME;
	$page['path'] = $site->settings['url'];
	$page['title'] = "Forums";
	//get the root groups
		$groupsql ="SELECT * 
					FROM categories
					WHERE categories.isgroup <>0
					AND categories.groupid =0";
	
	if ($settings['forumtabs'] == true)
    {
		
		$root = $database->get_results($groupsql);
		foreach ($root as $row)
				{
					if ($ul == 0) //sets active tab later it will remember
					{
					    $page['tab'] .='<li class="active" ><a href="#'.$row['cat_id'].'" title ="tab locked">'.$row['cat_name'].'</a></li>'; // use the id for tab ref
					    if ($row['cat_locked'] == true) {
							     $page['tab'] .='<li class="active" ><a href="#'.$row['cat_id'].'" title ="tab locked">'.$row['cat_name'].'<label class="icon icon-16 icon-lock color-red" ></label></a></li>'; // use the id for tab ref 
							     }
					    $ul =1;
					 }         
					else 
					{
						$page['tab'] .='<li><a href="#'.$row['cat_id'].'">'.$row['cat_name'].'</a></li>';
					}	
					$sql = "SELECT * , COUNT( posts.post_id ) AS totalp
							FROM categories
							LEFT JOIN topics ON categories.cat_id = topics.topic_cat
							LEFT JOIN posts ON topics.topic_id = posts.post_topic
							LEFT JOIN users ON topics.topic_by = users.id
							WHERE categories.groupid = ".$row['cat_id']."
							GROUP BY categories.cat_id
							ORDER BY categories.cat_id ASC, posts.post_id DESC ";
							$cats = $database->get_results($sql); //get whats underneath needs remember code
							if ($i == "0") {
								$page['rowd'] .= ' <div class="cell" id="'.$row['cat_id'].'"><div class="col"><table>'; // set visible
								$class = "cell";
								$i= 1;  
	            				}
							else { 
								$page['rowd'] .= ' <div class="cell hidden-tab" id="'.$row['cat_id'].'"><div class="col"><table>'; // set invisible
								$class =  "cell hidden-tab";
								}
								$page['rowd'] .='<table>';
								foreach ($cats as $catrow)
			{
				 $sql = "SELECT topic_id , topic_subject, categories.cat_id, categories.cat_name,
				         (SELECT posts.post_date FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_Action , 
				         (SELECT posts.post_by FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_User ,
				         (SELECT users.username FROM users WHERE users.id = Latest_User ORDER BY users.id DESC limit 1) as Last_Username 
				         FROM topics 
				         LEFT JOIN categories ON topics.topic_cat =categories.cat_id 
				         LEFT JOIN posts ON topics.topic_id = posts.post_topic 
				         where categories.cat_id = ".$catrow['cat_id']."  
				         GROUP BY posts.post_topic 
				         ORDER BY Latest_Action desc limit 1";
				         $lp = $database->get_row($sql);
				 $template->load("templates/forum_row.html"); // load the row template
				 
				 $topic_subject = $lp['topic_subject'];
				 $post_topic = $lp['topic_id'];
				 $user_name = $lp['Last_Username'];
				 $last_time =  time2str($lp['Latest_Action']);
			    
				 $cat_name = $catrow['cat_name'];
                 $cat_id = $catrow['cat_id'];
                 $posts = $catrow['totalp'];
                 if ($posts == 0) 
				       {
							$threads=0;
							$last_time =  "Never";
							$last_user = "Never";
							//$template->replace("last_user","Never");
					   }	
					
				
				else {
					$threads = $database->num_rows("select * from topics where topic_cat = ".$cat_id); 
					$last_user = '<a onclick = window.location.assign("topic.php?id=#post_topic#")>#topic_subject#</a> by #user_name# #last_time#';
					
					if ($catrow['isgroup'] == 1)
						{
							
						}
					  
						    
							
					
			}
							if ($catrow['cat_description'] =="")  {$catrow['cat_description']="&nbsp;";}
							//$topic_subject = $catrow['topic_subject'];
							//$user_name = $catrow['username'];
							$template->replace ("last_user", $last_user);
							$template->replace("post_topic",$post_topic);
							$template->replace("cat_id",$cat_id);
							$template->replace("cat_name",$cat_name);
							$template->replace("cat_description",$catrow['cat_description']);
							$template->replace("threads",$threads);
							$template->replace("posts",$posts);
							$template->replace("last_time",$last_time);
							$template->replace("user_name",$user_name);
							$template->replace("topic_subject",$topic_subject);
							$page['rowd'].= $template->get_template();  
			}
			$page['rowd'] .= "</table></div></div>";
		}	 	
		$template->load ("templates/newindex.html");
	}
	else 
	{
		// do a classic view
		$page['tab'] = ""; //turn the tabs off
		$root = $database->get_results($groupsql);
		$subtemplate = new Template; // define the subtemplate
		
		foreach ($root as $row)
				{
					$template->load("templates/catbit.html");
					$template->replace("cat_name",$row['cat_name']);
					//query for forum in group 
					 
					$sql = "SELECT * , COUNT( posts.post_id ) AS totalp
							FROM categories
							LEFT JOIN topics ON categories.cat_id = topics.topic_cat
							LEFT JOIN posts ON topics.topic_id = posts.post_topic
							LEFT JOIN users ON topics.topic_by = users.id
							WHERE categories.groupid = ".$row['cat_id']."
							GROUP BY categories.cat_id, topics.topic_cat
							ORDER BY categories.cat_id ASC, posts.post_id DESC ";
							$cats = $database->get_results($sql);
							$rows.="<table>";
								foreach ($cats as $catrow)
								
							{
								$subtemplate->load("templates/forum_row.html"); // load the row template
								$sql = "SELECT topic_id , topic_subject, categories.cat_id, categories.cat_name,
				         (SELECT posts.post_date FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_Action , 
				         (SELECT posts.post_by FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_User ,
				         (SELECT users.username FROM users WHERE users.id = Latest_User ORDER BY users.id DESC limit 1) as Last_Username 
				         FROM topics 
				         LEFT JOIN categories ON topics.topic_cat =categories.cat_id 
				         LEFT JOIN posts ON topics.topic_id = posts.post_topic 
				         where categories.cat_id = ".$catrow['cat_id']."  
				         GROUP BY posts.post_topic 
				         ORDER BY Latest_Action desc limit 1";
				         $lp = $database->get_row($sql);
				                $topic_subject = $lp['topic_subject'];
								$post_topic = $lp['topic_id'];
								$user_name = $lp['Last_Username'];
								$last_time =  time2str($lp['Latest_Action']); 
								//$post_topic= $catrow['post_topic'];
								$cat_name = $catrow['cat_name'];
								$cat_id = $catrow['cat_id'];
								$posts = $catrow['totalp'];
									if ($posts == 0) 
								{
										$threads=0;
										$last_time =  "Never";
										$last_user = "Never";
								}
								else {
										$threads = $database->num_rows("select * from topics where topic_cat = ".$cat_id); 
										$last_user = '<a onclick = window.location.assign("topic.php?id=#post_topic#")>#topic_subject#</a> by #user_name# #last_time#';
										//$last_time =  time2str($catrow['post_date']);
										if ($catrow['isgroup'] == 1)
												{
													//perhaps do group stuff							
												}
										}
							if ($catrow['cat_description'] =="")  {$catrow['cat_description']="&nbsp;";}
							//$topic_subject = $catrow['topic_subject'];
							//$user_name = $catrow['username'];
							$subtemplate->replace ("last_user", $last_user);
							$subtemplate->replace("post_topic",$post_topic);
							$subtemplate->replace("cat_id",$cat_id);
							$subtemplate->replace("cat_name",$cat_name);
							$subtemplate->replace("cat_description",$catrow['cat_description']);
							$subtemplate->replace("threads",$threads);
							$subtemplate->replace("posts",$posts);
							$subtemplate->replace("last_time",$last_time);
							$subtemplate->replace("user_name",$user_name);
							$subtemplate->replace("topic_subject",$topic_subject);
							//$rows .="</table>";
							$rows .= $subtemplate->get_template();
									
                              // upload data to the sub template
                                							
							}
							$rows .="</table>";
							$template->replace("rows",$rows);
							$rows=""; 	
						$page['rowd'].= $template->get_template(); // new cat	
					}
		
		$template->load ("templates/classicindex.html");
		
	} 
	
	$template->replace_vars($page);
	$template->publish(); 
	
	
?>
