<?php
require 'includes/master.inc.php'; // do login or not
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
$template = new Template;
if (isset($_POST['nid'])) {
	//need to add per field we are saving data
	$_POST['sig'] = $database->escape($_POST['sig']);
	unset ($_POST['action']);
	$where['nid'] = $_POST['nid'];
	if (!isset($_POST['tabs'])) {
		$_POST['tabs'] = "";
		}
		else { $_POST['tabs'] = "true";}
		
	unset ($_POST['nid']);
	//printr($_POST);
	$database->update( 'users', $_POST, $where, 1 );
	
	$sql = "select * from users where nid = '".$_POST['nid']."'";
	$page['msg'] = 'Job Done';
	}

if($Auth->loggedIn()) 
           {
			   if($_POST){  
					$page['theme_path'] =  DOC_ROOT.'/themes/'.$_POST['theme'].'/templates/'.$page['udevice'].'/';
					$page['css_path'] =  $page['path'].'/themes/'.$_POST['theme'].'/';   
				}
			if($page['template_path']<>$page['theme_path']) 
				{$page['template_path']=$page['theme_path'];
					}
			   $name = $Auth->username;
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
					
					redirect($site->settings['url'].'/index.php'); 
				}
				

writeid ($id,$nid,$database);
$sql = "select * from users where nid = '".$nid."'";
$result = $database->get_row ($sql);
//printr($result);
$page['users'] = $database->num_rows('select * from sessions');
$page['header'] = $template->load($page['template_path'].'header.html', COMMENT); // load header
	$page['footer'] = $template->load($page['template_path'].'footer.tmpl', COMMENT);
	$page['include'] = $template->load($page['template_path'].'include.tmpl', COMMENT);
	$page['login'] = $login;
$page['login'] = $login;
$page['path'] = $site->settings['url'];
$page['title'] = $site->settings['sitename'].'- User CP';
$page['name'] = $name;
$page['nick'] = $result['nick'];
$page['nid'] = $nid;
$page['dob'] = date("m/d/Y",$result['dob']);
$page['dobv'] = $result['dob'];
$page['priv'] = $result['b_priv'];
$page['sig'] = $result['sig'];
$page['avatar'] = $result['avatar'];
if (empty($page['avatar'])) {$page['avatar'] = $page['path'].'/images/default_avatar.png';}
$page['datetime'] = FORMAT_TIME;
$page['sex'] = $result['sex'];
$page['loc'] = $result['loc'];
$page['tab'] = $result['tabs'];
$page['bio'] = $result['bio'];
$page['url'] = $result['url'];
$page['myemail'] = $result['email'];
$page['posts'] = $result['posts'];
$page['threads'] = $result['threads'];
$page['steamid'] = $result['steamid'];
$page['skypeid'] = $result['skypeid'];
 $dir = "themes";
$curdir = getcwd();
// Open a known directory, and proceed to read its contents
chdir ($dir);
$dirs = array_filter(glob('*'), 'is_dir');
//print_r( $dirs);

chdir($curdir);
//$page['theme'] = '<select>';
foreach ($dirs as $v) {
   // echo "Current value of \$dirs: $v.<br>";
   if ($v == 'img') {goto protect;}
    if ($result['theme'] === $v) {
    $page['theme'] .= '<option value="'.$v.'" selected>'.$v.'</option>';
}
else {$page['theme'] .= '<option value="'.$v.'">'.$v.'</option>';}
protect:
}

//$page['theme'] .= '</select>';
//print_r ($page['theme']);
//die();
$page['editor_opts'] = "<script>CKEDITOR.replace( 'editor1', {uiColor: '#F58220',removePlugins: 'elementspath',toolbar: [
					[ 'Bold', 'Italic','Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat'],
					[ 'FontSize', 'TextColor'], ['JustifyLeft', 'JustifyCenter', 'JustifyRight' ], [ 'Link', 'Image'], ['codesnippet'] 
				],
				   
				    	
					resize_dir: 'both',
					resize_minWidth: 200,
					resize_minHeight: 65,
					resize_maxWidth: 600,
					resize_maxHeight: 100,
					resize_enabled : false
			});</script>"; 
$template->load($page['template_path'].'user.html');

$page['query'] = $database->total_queries();
     if (@$Auth->level === 'admin')
    { 
    $linecount = filelength($_SERVER['SCRIPT_FILENAME']);
    $test = page_stats($linecount,$page['query'],$start);
    $page['adminstats'] = "Page generated in ".$test['time']." seconds. &nbsp;
     PHP ".$test['php']."% SQL ".$test['sql']."% 
     SQL Queries  ". $test['query']; 
  }

	else { $page['adminstats'] = ""; }	    
$template->replace_vars($page);
$template->replace("result"," Main Index");

if($site->settings['showphp'] === false)
{
$template->removephp();
}
$template->listv("lang/lang.php","");
$template->publish();
?>
