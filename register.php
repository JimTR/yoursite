<?php
/*
 * Register script
 * 
 */
 
 require 'includes/master.inc.php'; // do login or not
 
 if($Auth->loggedIn()) 
           {
			   // logged in already go back from whence you came
			   redirect("index.php");
			   
			   }
	 if(!empty($_POST['username']))
	{
		// add user
		$checku['username'] = $_POST['username'];
		$checke['email'] =$_POST['email'];
		if (!$_POST['email'])
			{$Error = 'You did not supply an email address';
				goto render;
			} 
			else 
			{
				$validemail=valid_email($_POST['email'], true);
		              if(!$validemail)
		              { 
						  $Error = "There appears to be a problem with your email address check & retry";
						  goto render;}
			}
		if ($database->exists("users","username",$checku))
		{
			$Error ="We're sorry, you have entered a username that is in use.";
			//die ($Error);
			goto render;
			}
		if ($database->exists("users","email",$checke))
		{
			$Error ="We're sorry, you have entered an email address that is in use.";
			//die ($Error);
			goto render;
			}			
		$newuser = array();
		$file='log.txt';
			   if(! empty($_SERVER['REMOTE_ADDR']) ){
		$ip = getip();
		$nid = getnid();
        $password = md5($_POST['password'].SALT);
		$newuser['nid'] = $nid;
		$newuser['username']= $_POST['username'];
		$newuser['password'] = $password;
		$newuser['email'] = $_POST['email']; 
		$newuser['ip'] = $ip;	
		$newuser['regdate'] = time();
		$person = $_POST['username'].' '.FORMAT_TIME.' '.$ip;
		log_to ($file,$person);
		
			$database->insert ("users",$newuser);
		}
			 if($Auth->login($_POST['username'], $_POST['password']))
        {
			
            redirect("index.php");
        }
        else
        {
			
            $Error->add($Shit, "We're sorry, you have entered an incorrect username or password. Please try again.");
           
	   }
			die();
		}  
render:	
if ($Error <> "")
	{
		$Error = "<p class=\"alert error\" style=\"width:98%;margin:10px\">".$Error."</p>";
	}
$header = file_get_contents('templates/header.html');
$footer = file_get_contents ( 'templates/footer.tmpl');
$include = file_get_contents ('templates/include.tmpl');
$css = 'css/main.css';
$css ="<style>".file_get_contents ($css)."</style>";
$stuff = "register page";
$template = new Template;
$template->load("templates/register.html");
$template->replace("email",$_POST['email']);
$template->replace("username",$_POST['username']);
$template->replace("password",$_POST['password']);
$template->replace("result"," register");
$template->replace("css",$css);
$template->replace("title", "Register");
$template->replace("header", $header);
$template->replace("footer", $footer);
$template->replace("include", $include);
$template->replace ("path", $site->settings['url']);
$template->replace("error",$Error );
$template->replace("login","");
$template->replace("vari",DOC_ROOT);
$template->replace("stuff",$stuff);
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}

$template->publish();
  
?>
