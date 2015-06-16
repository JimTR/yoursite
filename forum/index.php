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
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
define ('AREA',2);
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
if (isset($_GET['activetab'])) 
{
	// find out what tab to display
	$activetab = intval($_GET['activetab']);
	//echo $activetab;
}		
else {$activetab = 0;}
$i = 0;
$ul = 0;
$template = new Template; 
if($Auth->loggedIn()) 
           {
			   
			   $name = $Auth->username;
			   $nid = $Auth->nid;
			   $level = $Auth->level;
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
					$login = $template->load(DOC_ROOT.'/templates/guest.html', COMMENT) ;
					$nid = $nid = getnid();
					$level = 'guest'; 
				}
				
	
	//writeid ($id,$nid,$database);
	$page['users'] = $database->num_rows("select * from sessions"); // online users count
	$page['header'] = $template->load($site->settings['url'].'/templates/header.html', COMMENT); // load header
	$page['footer'] = $template->load($site->settings['url'].'/templates/footer.tmpl', COMMENT);
	$page['include'] = $template->load($site->settings['url'].'/templates/include.tmpl', COMMENT);
	$page['login'] = $login;
	$page['datetime'] = FORMAT_TIME;
	$page['path'] = $site->settings['url'];
	$page['title'] .= " - Forums";
	//get the root groups
		$groupsql ="SELECT * , permissions.*
					FROM categories
					LEFT JOIN
				    permissions on permissions.pcat_id = cat_id	
					WHERE categories.isgroup <> 0
					AND categories.groupid = 0
					AND categories.area = ".AREA."
					order by disp_order asc";
	
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
					$tabs->load(DOC_ROOT."/templates/tab.html",false); //dont show this templates remarks  
					$tab_entry['tab_id'] = $row['cat_id']; 
					$tab_entry['tab_name'] = $row['cat_name']; 
					$tab_entry['tab_title'] = ""; 
					if ($ul == 0 && $activetab == @$tab) //sets active tab later it will remember now does it
					{
						$tab_entry['tab_class'] = "active";
						$ul =1;
					 }         
					else 
					{
						$tab_entry['tab_class'] = "";
						$ul = 0;
					}	
					
					$tab++;
					$sql = "SELECT * , 
					        COUNT( posts.post_id ) AS totalp,
					        permissions.*
							FROM categories
							LEFT JOIN topics ON categories.cat_id = topics.topic_cat
							LEFT JOIN permissions ON categories.cat_id = permissions.pcat_id	
							LEFT JOIN posts ON topics.topic_id = posts.post_topic
							LEFT JOIN users ON topics.topic_by = users.id
							WHERE categories.groupid = ".$row['cat_id']."
							AND categories.area = ".AREA." 
							GROUP BY categories.cat_id
							ORDER BY categories.disp_order ASC, posts.post_id DESC ";
							$cats = $database->get_results($sql); //get whats underneath needs remember code
							if ($ul == "1") {
								$class = "cell";
								$ul= 0;  
	            				}
							else { 
								  $class =  "cell hidden-tab";
								}
								
				                $template->load("templates/forum_group.html",COMMENT);
					            $template->replace("class",$class);
					            $template->replace("rowid",$row['cat_id']); //added the header
					            //$foumtab = $template->get_template();
					            $totalthreads=0;
					            $subtemplate = new Template;
					             
								foreach ($cats as $catrow)
			{
				 $sql = "SELECT topic_id , topic_subject, categories.cat_id, categories.cat_name,
				         (SELECT posts.post_date FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_Action , 
				         (SELECT posts.post_by FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_User ,
				         (SELECT users.username FROM users WHERE users.id = Latest_User ORDER BY users.id DESC limit 1) as Last_Username 
				         FROM topics 
				         LEFT JOIN categories ON topics.topic_cat = categories.cat_id 
				         LEFT JOIN posts ON topics.topic_id = posts.post_topic 
				         where categories.cat_id = ".$catrow['cat_id']."  
				         GROUP BY posts.post_topic 
				         ORDER BY Latest_Action desc limit 1";
				         $lp = $database->get_row($sql);
				                  
				 $subtemplate->load("templates/forum_row.html", COMMENT); // load the row template
				 //$template->replace("demo",$demo);
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
							$currentab = (string) $tab - 1;
							//$template->replace("last_user","Never");
					   }	
					
				
				else {
					$currentab = (string) $tab - 1;
					$threads = $database->num_rows("select * from topics where topic_cat = ".$cat_id); 
					
					$last_user = '<a onclick = window.location.assign("topic.php?id=#post_topic#&activetab='.$currentab.'")>#topic_subject#</a> by #user_name# #last_time#';
					
					if ($catrow['isgroup'] == 1)
						{
							
						}
					
			           }
							if (empty($catrow['cat_description']))  {$catrow['cat_description']="&nbsp;";}
							$subtemplate->replace ("last_user", $last_user);
							$subtemplate->replace("tab","&activetab= ".$currentab);
							$subtemplate->replace("post_topic",$post_topic);
							$subtemplate->replace("cat_id",$cat_id);
							$subtemplate->replace("cat_name",$cat_name);
							$subtemplate->replace("cat_description",$catrow['cat_description']);
							$subtemplate->replace("threads",$threads);
							$subtemplate->replace("posts",$posts);
							$subtemplate->replace("last_time",$last_time);
							$subtemplate->replace("user_name",$user_name);
							$subtemplate->replace("topic_subject",$topic_subject);
							$xx .= $subtemplate->get_template(); 
							$totalthreads = $totalthreads + $threads;
							$totalposts = $totalposts + $posts;
			    }
			              
			                $template->replace("rows",$xx);
			                $page['rowd'] .= $template->get_template();
			                $xx ="";
			//echo $totalthreads."-";
			                    $tab_entry['tab_title'] .= "Threads ".$totalthreads." Posts ".$totalposts; 
								$tabs->replace_vars($tab_entry);
					            $page['tab'].= $tabs->get_template();
					            $totalthreads =0;
					            $totalposts=0;
					            noview:
		}	 	
		$template->load ("templates/tabindex.html", COMMENT);
	}
	else 
	{
		// do a classic view
		$page['tab'] = ""; //turn the tabs off
		$root = $database->get_results($groupsql);
		$subtemplate = new Template; // define the subtemplate
		
		foreach ($root as $row)
				{
					$priv = explode(",",$row[$level]);
					
					if ($priv[0] === '0')
	                 {
						 goto noview1;
					} 
					$template->load("templates/catbit.html", COMMENT);
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
							@$rows.="<table>";
								foreach ($cats as $catrow)
								
							{
								$subtemplate->load("templates/forum_row.html", COMMENT); // load the row template
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
									if ($posts === 0) 
								{
										$threads=0;
										$last_time =  "Never";
										$last_user = "Never";
								}
								else {
										$threads = $database->num_rows("select * from topics where topic_cat = ".$cat_id);
										$posts = $posts-$threads; 
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
							$subtemplate->replace("tab","");
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
							 	
						@$page['rowd'].= $template->get_template(); // new cat
						noview1:	
					}
		               $page['rowd'] .= "</table></div></div>";
		$template->load ("templates/classicindex.html", COMMENT);
		
	} 
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
	$template->publish(); 
	
?>
