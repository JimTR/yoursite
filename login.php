<?PHP

    require 'includes/master.inc.php'; // load required files
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$start = $time;
	
if (!isset($_SERVER['HTTP_REFERER'])) 
{ 
	//redirect("index.php");
	} 
//die();
    if($Auth->id > 0) 
           {
			   // already logged in default to the main index
			   $goto = ($_SERVER['HTTP_REFERER']);
			   if ($goto <> $_SERVER['PHP_SELF']) 
				{
					//die ($goto.' and '.$_SERVER['PHP_SELF']);
					redirect($site->settings['url'].'/index.php');
					//die ("user");
				}
			
			  else {
				  die("goto index");
				  redirect($goto);
			      }
}		
if ($_SERVER['HTTPS'])
		{
			$site->settings['url'] = preg_replace("/^http:/i", "https:", $site->settings['url']);
			//die ('https on');
		}	
    if(!empty($_POST['username']))
    {
        if($Auth->login($_POST['username'], $_POST['password']))
        {
			//successful login 
			$goto = $_COOKIE['redirect'];
            setcookie ("redirect", "", time() - 3600,'/'); // clear the login cookie
            redirect($goto);
        }
        else
        {
			//die ('no user name');
            $Error = "You have entered an incorrect username/password combination.<br> Please try again. ";
           
           
	   }
		
    }
    
	if ($Error <> '')
	{
	 $page['error'] = '<script type="text/javascript">alertify.alert("'.$Error.'");</script>';
 }
    // Clean the submitted username before redisplaying it.
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    $users = $database->num_rows("select * from sessions");
    $job = $_SERVER['HTTP_REFERER'];
	if (@!$_COOKIE['redirect']) {setcookie('redirect',$job, time() + (60 * 5),'/');} // make sure we go back
	$template = new Template;
	$name ="Guest";
	$login = $template->load('templates/guest.html', COMMENT) ;
    $page['header'] = $template->load($site->settings['url'].'/templates/header.html', COMMENT);
	$page['footer'] = $template->load($site->settings['url'].'/templates/footer.tmpl', COMMENT);
	$page['include'] = $template->load($site->settings['url'].'/templates/include.tmpl', COMMENT);
	$page['login'] = $login;
	$page['query'] = $database->total_queries();
	$page['path'] = $site->settings['url'];
	$page['error'] ="";
	  
	$template->load($site->settings['url'].'/templates/login.html', COMMENT);
	$template->replace_vars($page);
	$template->replace("css",$css);
	$template->replace("title", "Login");
	@$template->replace("name",$name );
	//$template->replace("login","");
	$template->replace("vari",$users);
	$template->replace("datetime", FORMAT_TIME);
	//$template->replace("error",$Error);
		if($site->settings['showphp'] === false)
			{
				$template->removephp();
			}
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

