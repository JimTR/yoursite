<?php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php';
require_once(DOC_ROOT.'/includes/class.geoplugin.php'); 
$geoplugin = new geoPlugin();
$geoplugin->locate($_GET['ip']);
$template = new Template;
$page['ipusers']="0";
$page['posts'] = $database->num_rows("select * from posts where post_ip = '".$_GET['ip']."'");
$page['test'] = $database->num_rows("select * from users where ip = '".$_GET['ip']."'");
if ($page['test'] === 0) {$page['test'] = "None";}

else{
	//we have users
	$page['ipusers'] = $page['test'];
	$ipusers = $database->get_results("select * from users where ip = '".$_GET['ip']."' order by username ASC"); // now list registered
	$selectbox = '<select style="
    height: 20px;
    font-size: 13px;
    font-weight: bold;
    padding: 0px;
    background: transparent;
    border: 0px;
    width: auto;
    margin-top: -1px;
" class="color-red">';
	foreach ($ipusers as $users)
	{
		$selectbox .= '<option style="background:#A0D1EA; font-weight:bold;">'.$users['username'].'</option>';
	}
	$selectbox .= "</select>";
	$page['test'] = $selectbox; 
	}
$page['ip'] = $_GET['ip'];
$page['hostname'] = @gethostbyaddr($_GET['ip']);
$page['hostlocation'] = $geoplugin->countryName;
$page['path'] = $site->settings['url'];
$template->load($page['template_path']."ips.html");
$template->replace_vars($page);
$template->publish();
?>
