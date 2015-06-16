
<?php
/*
 * main Index file Gallery
 * does very little as it does not need to !
 * COMMENT in the template->load function uses the default setting
 * replace COMMENT with either true or false to over ride this
 * code tidy 22-5-2015
 * add plugin code as a tester
 */ 
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // start up stuff 
define ("AREA",4); //gallery cat ID
define ("FORUM",2); //Forum cat ID
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
			$login = $template->load(DOC_ROOT.'/templates/guest.html', COMMENT) ;
			$level = 'guest';
		}
				
					$groupsql = 'SELECT * , permissions.*
					FROM categories
					LEFT JOIN
				    permissions on permissions.pcat_id = cat_id	
					WHERE categories.isgroup <> 0
					AND categories.groupid = 0
					AND categories.area = '.AREA.'
					order by disp_order asc';
  
    $page['users'] = $database->num_rows("select * from sessions"); // online users count
	$page['header'] = $template->load($site->settings['template_path'].'/header.html', COMMENT); // load header
	$page['footer'] = $template->load($site->settings['template_path'].'/footer.tmpl', COMMENT); // load footer
	$page['include'] = $template->load($site->settings['template_path'].'/include.tmpl', COMMENT); // load includes - note ability to use different includes (js etc) per device
	$page['login'] = $login;
	$page['email'] = $Auth->loc;
	$page['path'] = $site->settings['url'];
	$page['datetime'] = FORMAT_TIME;
	$page['title'] .= " - Gallery";

	//todo run plugins
	
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
					$tabs->load(DOC_ROOT.'/templates/tab.html',false); //dont show this template's remarks  
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
					$tabs->load(DOC_ROOT.'/templates/tab_desc.html',false); // load the description template todo set it to device
					$tabs->replace("content",$row['cat_description']);
					$tabs->replace("class",$class);	
					$tabs->replace("id",$row['cat_id']);
					$tabs->replace("path",$page['path']);
					$tabs->replace("title",	$row['cat_name']);
					$page['tab_content'] .= $tabs->get_template();
					$tab++;
					noview:
				}
	
}

$template->load($site->settings['template_path'].'/gallery/index.html', COMMENT); // load header

if($site->settings['showphp'] === false)
	{
		$template->removephp();
	}
      $page['query'] = $database->total_queries();
	  
	     
     if ($Auth->level === 'admin')
    { 
		$linecount = filelength($_SERVER['SCRIPT_FILENAME']);
		$stats = page_stats($linecount,$page['query'],$start);
		$page['adminstats'] = "Page generated in ".$stats['time']." seconds. &nbsp;
		PHP ".$stats['php']."%  &nbsp;SQL ".$stats['sql']."% &nbsp; 
		SQL Queries  ". $stats['query'];
    
	}
	else { $page['adminstats'] = ""; }
	
$template->replace_vars($page);	    
$template->replace("xx",FORMAT_TIME);
//echo "going to remove comments";
//$template->remove_comments();
$template->publish();

?>
