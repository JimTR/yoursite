<?PHP

    require 'includes/master.inc.php'; // load required files

    if($Auth->loggedIn()) 
           {
			   // already logged in default to the main index
			   $goto = ($_SERVER['HTTP_REFERER']);
			   redirect($goto);
			   
			   
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
			
            $Error = "We're sorry, you have entered an incorrect username or password. Please try again.";
           
	   }
    }

    // Clean the submitted username before redisplaying it.
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $users = $database->num_rows("select * from sessions");
    $job = $_SERVER['HTTP_REFERER'];
	setcookie('redirect',$job, time() + (60 * 5),'/'); // make sure we go back
    $header = file_get_contents ( $site->settings['url'].'/templates/header.html');
	$footer = file_get_contents (  $site->settings['url'].'/templates/footer.tmpl');
	$include = file_get_contents ( $site->settings['url'].'/templates/include.tmpl');
	$css = $site->settings['url'].'/css/yuiapp.css';
    $css ="<style>".file_get_contents ($css)."</style>";
    $template = new Template;
	$template->load($site->settings['url'].'/templates/login.html');
	$template->replace("css",$css);
	$template->replace("error",$Error);
	$template->replace("title", "Login");
	$template->replace("header", $header);
	$template->replace("footer", $footer);
	$template->replace("include", $include);
	$template->replace ("path", $site->settings['url']);
	$template->replace("name",$name );
	$template->replace("login","");
	$template->replace("vari",$users);
	$template->replace("datetime", FORMAT_TIME);
		if($site->settings['showphp'] === false)
			{
				$template->removephp();
			}

	$template->publish();

?>

