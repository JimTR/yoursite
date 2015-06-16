
<?php
/*
 * main Index file adding dynamic tabs
 * does very little as it does not need to !
 * COMMENT in the template->load function uses the default setting
 * replace COMMENT with either true or false to over ride this
 */ 
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
//
require DOC_ROOT.'/includes/master.inc.php'; // do login or not
//require '/includes/master.inc.php'; // do login and stuff
//printr ($_SERVER); 
//die();
define ("AREA",3);
define ("FORUM",0);
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
$template = new Template;
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
$a=0;
$id = session_id();
$groupsql ="SELECT * 
					FROM categories
					LEFT JOIN
				    permissions on permissions.pcat_id = cat_id	
					WHERE categories.isgroup <> 0
					AND categories.groupid = 0
					AND categories.area = ".AREA."
					order by disp_order asc";
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
				
if ($site->settings['https'] == AREA)
		{
			$site->settings['url'] = preg_replace("/^http:/i", "https:", $site->settings['url']);
			die ("hit area bug");
		}	
    
	
	$page['header'] = $template->load($site->settings['template_path'].'/header.html', COMMENT); // load header
	$page['footer'] = $template->load(DOC_ROOT.'/templates/footer.tmpl', COMMENT);
	$page['include'] = $template->load(DOC_ROOT.'/templates/include.tmpl', COMMENT);
	$page['login'] = $login;
	$page['path'] = $site->settings['url'];
	$page['datetime'] = FORMAT_TIME;
	$page['title'] .= " - Service";
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
					$tabs->load(DOC_ROOT."/templates/tab.html",true); //dont show this templates remarks  
					$tab_entry['tab_id'] = $row['cat_id']; 
					$tab_entry['tab_name'] = $row['cat_name']; 
					$tab_entry['tab_title'] = $row['cat_tooltip']; 
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
					
					$tabs->load($site->settings['template_path'].'/service/tab_desc.html',true); // load the description template
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
					$page['tab_content'] .=$tabs->get_template();
					$tab++;
					noview:
				}

$template->load($site->settings['template_path'].'/service/index.html', COMMENT); // load header
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
