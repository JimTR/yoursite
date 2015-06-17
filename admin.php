<?php
// main or home page admin.cp
require 'includes/master.inc.php'; // required
require 'includes/functions_admin.php'; //admin functions 

if (!$_SERVER['HTTP_REFERER']) { 
		redirect ($site->settings['url']."/index.php");
	} 
		//echo $_SERVER['DOCUMENT_ROOT'];
	//die();
if (!$_SERVER['HTTP_REFERER'] === $site->settings['url']."/index.php" || !$_SERVER['PHP_SELF']) {
		redirect ($site->settings['url']."/index.php");
	}
if( $Auth->level <> 'admin' )
{
	//the user is not an admin
	redirect ("index.php");
		
}
    
			  
if (!isset ($_GET['action']))
{
displayit:	
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
if ($settings['siteclosed'] == 1) { $stat = "#6FAF47"; } 
else {$stat="red";} 
$postsize = (int)(str_replace('M', '', ini_get('post_max_size')) * 1024 * 1024);
$upsize = (int)(str_replace('M', '', ini_get('upload_max_filesize')) * 1024 * 1024);
$load = sys_getloadavg();
$pt = $_SERVER['DOCUMENT_ROOT'];
$df = $pt.dirname($_SERVER['PHP_SELF']);
$df = getDirectorySize($df);
$template =  new Template;
$name = $Auth->username;
$nid = $Auth->nid;
$page['header'] = $template->load($site->settings['template_path'].'/header.html', COMMENT); // load header
	$page['footer'] = $template->load($site->settings['template_path'].'/footer.tmpl', COMMENT);
	$page['include'] = $template->load($site->settings['template_path'].'/include.tmpl', COMMENT);
	$page['login'] = $login;
$page['astat'] = $template->load('templates/admin/stat.html',COMMENT);
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
$template->load('templates/admincp.html', COMMENT);
$template->replace_vars($page);
$template->publish();
}
$filename = rtrim($_SERVER['DOCUMENT_ROOT'],"/").dirname($_SERVER['PHP_SELF']).'/includes/settings.php';

if (isset ($_GET['action'])){
switch ($_GET['action']) {
    case "turnstatus":
        if ($settings['siteclosed'] == 0){
			
		$settings['siteclosed'] = 1;} 
		else {$settings['siteclosed'] = 0;}
		$writevar ="<?php
/*********************************\ 
SETTINGS v1.01
\*********************************/\n";
	foreach ($settings as $key => $val) {
      $writevar .=  "\$settings['" . $key . "'] = \"".$val."\";\r\n";
    }
    $writevar .= "?>";
	file_put_contents ($filename , $writevar,LOCK_EX);
	
	
        break;
    case "datetime":
        //echo "i equals 1";
                break;
    case 2:
        //echo "i equals 2";
        break;
	}
	unset ($_GET['action']);
	goto displayit;
}
?>
