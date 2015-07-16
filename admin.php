<?php
// main or home page admin.cp
/* 6-7-2015 update
 * added database table to handle the settings groups
 */
require 'includes/master.inc.php'; // required
require 'includes/functions_admin.php'; //admin functions 

if (!$_SERVER['HTTP_REFERER']) { 
		redirect ($site->settings['url']."/index.php");
	} 
		
if (!$_SERVER['HTTP_REFERER'] === $site->settings['url']."/index.php" || !$_SERVER['PHP_SELF']) {
		redirect ($site->settings['url']."/index.php");
	}
if( $Auth->level <> 'admin' )
{
	//the user is not an admin
	redirect ("index.php");
		
}
    $activetab=0;
//print_r($_REQUEST);			  
if (!isset ($_REQUEST['action']))
{
displayit:
if (isset($_REQUEST['activetab'])) 
{
	// find out what tab to display
	$activetab = intval($_REQUEST['activetab']);
	}		
else {
	// if nothing default
	$activetab = 0;}
$tab=0;
$sql = '
 select (SELECT COUNT(*) FROM posts) as post_count, 
(select count(*) from users) as user_count, 
(select count(*) from topics) as topic_count, 
(select count(*) from categories) as cat_count,
(select count(*) from sessions) as wol,
(select count(*) from modules) as modules,
(select count(*) from sessions where usertype >100) as staff_ol 
limit 1';
 $astats = $database->get_row($sql);
  
$dbsize = getdbsize();
if ($settings['siteclosed'] == 1) { 
	$stat = "#6FAF47"; 
	} 
else {
	$stat="#FF0000";
	} 
$postsize = (int)(str_replace('M', '', ini_get('post_max_size')) * 1024 * 1024);
$upsize = (int)(str_replace('M', '', ini_get('upload_max_filesize')) * 1024 * 1024);
$load = sys_getloadavg();
$pt = $_SERVER['DOCUMENT_ROOT'];
$df = $pt.dirname($_SERVER['PHP_SELF']);
$df = getDirectorySize($df);
$page['date_format'] = date($site->settings['date_format'],time()).' '.date($site->settings['time_format'],TIME_NOW);
$template =  new Template;
$name = $Auth->username;
$nid = $Auth->nid;
     $login = $template->load($page['template_path'].'admin.html', COMMENT) ;
    $page['header'] = $template->load($page['template_path'].'header.html', COMMENT); // load header
	$page['footer'] = $template->load($page['template_path'].'footer.tmpl', COMMENT);
	$page['include'] = $template->load($page['template_path'].'include.tmpl', COMMENT);
	$page['login'] = $login;
	//add the tabs
	
	$sql = 'select * from admin order by disp_order asc'; // needs to be changed on device type
	
	$root = $database->get_results($sql);
		$tabs = new Template;
		
			foreach ($root as $row)
				{
					
					//$priv = explode(",",$row[$level]);
					if ($priv[0] === '0')
	                 {
						// goto noview;
					} 
					$tabs->load($page['template_path'].'/tab.html',false); //dont show this templates remarks  
					$tab_entry['tab_id'] = $row['cat_id']; 
					$tab_entry['tab_name'] = $row['cat_name']; 
					$tab_entry['tab_title'] = $row['cat_tooltip'];
					$tab_entry['datetime'] = $page['datetime'];
					//$tabs['active_tab'] == $tab; 
					if ($ul == 0 && $activetab == $tab) //sets active tab later it will remember now does it
						{
							$tab_entry['tab_class'] = "active"; // sets the tab active
							$ul =1;
							$class = "cell";
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
					$tabs->replace("active_tab",$tab);	
					$tabs->replace("id",$row['cat_id']);
					$tabs->replace("path",$page['path']);
					$tabs->replace("title",	$row['cat_name']);
					$tabs->replace_vars($page);	    
					$page['tab_content'] .=$tabs->get_template();
					$tab++;
					noview:  
				}
				
$page['astat'] = $template->load($page['template_path'].'admin/stat.html',COMMENT);
$page['adminstats'] = ""; //do we need this ??
$page['datetime'] = FORMAT_TIME;
$page['path'] = $site->settings['url'];
$page['ds'] = $df['count'];
$page['df']= sizeFormat($df['size']);
$page['php'] = phpversion();
$page['sql'] = getsql();
$page['os'] = PHP_OS;
$page['mi'] = 0; 
$page['load'] = $load[0];
$page['dbs'] = sizeFormat($dbsize[1]);
$page['dbs1'] = sizeFormat($dbsize[2]); 
$page['pt'] = $df['dircount'];
$page['postsize'] = sizeFormat($postsize);
$page['upsize'] = sizeFormat($upsize);
$page['ver'] = $site->settings['version']; 
$page['stat'] = $stat; // on/off line indicator
$page['uol'] = $astats['wol'];;
$page['mod'] = $astats['modules'];
$page['total_users']  = $astats['user_count'];
$page['total_content'] = $astats['post_count'];
$page['closed'] = $site->settings['siteclosed_url'];
$template->load($page['template_path'].'admincp.html', COMMENT);
$template->replace_vars($page);
$template->publish();
}
$file = rtrim($_SERVER['DOCUMENT_ROOT'],"/").dirname($_SERVER['PHP_SELF']).'/includes/settings.php';
//die ($file);
$header ="SETTINGS v". $settings['version']."\n do not edit this file !";

$name="settings";
if (isset ($_REQUEST['action'])){
	//die($_REQUEST['action']);
switch ($_REQUEST['action']) {
    case "turnstatus":
        if ($settings['siteclosed'] == 0){
			
		$settings['siteclosed'] = 1;} 
		else {$settings['siteclosed'] = 0;}
		writeini ($settings,$file,$header,$name);
		
        break;
    case "change_date":
            switch ($_REQUEST['date']) {
				case "1":
					$_REQUEST['date'] = 'l, d M Y';
				break;
				   
				case "2":
					$_REQUEST['date'] = 'Y-m-d';
				break;
            }  
              switch ($_REQUEST['time']) {
				  case "1":
					$_REQUEST['time'] = 'g:i:s a';
				  break; 
				  case "2":
					$_REQUEST['time'] = 'h:i:s';
				break;	
			  }
			  			
			$settings['date_format'] = $_REQUEST['date'];
			$settings['time_format'] = $_REQUEST['time'];
			writeini ($settings,$file,$header,$name);
         break;
    case "change_url":
    $settings['siteclosed_url'] = $_REQUEST['curl1'];
			writeini ($settings,$file,$header,$name);
			break;
    default:
        
        print_r($_REQUEST);
        die($_REQUEST['action']);
        break;
	}
	unset ($_REQUEST['action']);
	goto displayit;
}
?>
