<?php
/*
 * error.php
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
 * 13-7-14 
 */
 
 require 'includes/master.inc.php'; // do login or not
 
 if(!empty($_POST['username']))
    {
        if($Auth->login($_POST['username'], $_POST['password']))
        {
            if(isset($_REQUEST['r']) && strlen($_REQUEST['r']) > 0)
                //redirect($_REQUEST['r']);
                die ("here we are");
                //redirect(WEB_ROOT);
            else
                redirect();
                echo "here we are (should be root) ".WEB_ROOT ;
                die();
        }
        else
            $Error->add('username', "We're sorry, you have entered an incorrect username and password. Please try again.");
            echo $Error->alert;
            //die ("Web Root = ".WEB_ROOT);
            //redirect ('error.php?error=1');
            //echo "web root =".WEB_ROOT. " invalid login";
    }

if($Auth->loggedIn()) 
           {
			   //redirect("page.html");
			   //echo "logged in<br>";
			   //print_r($Auth);
			   $name = $Auth->username;
			   //$_REQUEST[\'r\'] ;
			    $login = '<a href="logout.php">logout link</a>';
			    redirect("index.php");
			   }
			   
	else
				{
					$name ="Guest";
					$login = file_get_contents('templates/login.html') ;
				}
$header = file_get_contents('templates/header.html');
$header= str_replace("#login#", $content, $header);
$footer = file_get_contents ( 'templates/footer.tmpl');
$include = file_get_contents ('templates/include.tmpl');
$login = file_get_contents ('templates/login.html');
$css = 'css/main.css';
$css ="<style>".file_get_contents ($css)."</style>";
$template = new Template;
$template->load("templates/error.html");
$template->replace("result"," Error Page");
$template->replace("css",$css);
$template->replace("title", "Site Error");
$template->replace("header", $header);
$template->replace("footer", $footer);
$template->replace("include", $include);
$template->replace ("path", $site->settings['url']);
$template->replace("name",$name );
$template->replace("login",$login);
$template->replace("vari",DOC_ROOT);
$template->replace("stuff",$stuff);
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}

$template->publish();
?>
