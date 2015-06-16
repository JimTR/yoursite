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
 * updated 29-9-2014 
 */
 require 'includes/master.inc.php'; // do login or not
 @$action = $_POST['action'] | $_GET['action']; // allows the error in either format 
if ($action === 0) {redirect ("index.php");} 
if($Auth->loggedIn()) 
           {
			   
			   $page['username'] = $Auth->username;
			   $login = '<a href="logout.php">Log Out</a>';
			   
			   }
			   
	else
				{
					$page['username'] ="Guest";
					$login = '<a href="login.php">Login</a>' ;
				}
$template = new Template;				
$page['header'] = $template->load('templates/header.html', COMMENT); // load subs
$page['footer'] = $template->load('templates/footer.tmpl', COMMENT);
$page['include'] = $template->load('templates/include.tmpl', COMMENT);
$page['result'] = "Some Error was hit";
//start vari's
$page['path'] = $site->settings['url'];
$page['datetime'] = FORMAT_TIME;
$page['title'] = "Error";
$page['login'] = $login;
switch ($action) {
	case 1:
		$page['errorcode'] = "To Many connections from this IP, you need to wait until other connections from this IP clear";
		break;
	case 700:
		$page['errorcode'] = "<p>You Can not access this page</p><p>Perhaps its an idea to login ?</p>";
		$page['result'] = "You are a total fuck face !";
		break;	
	default:
		$page['errorcode'] = "this is where the error lives";
	}
		

// add an error case statement
$template->load("templates/error.html", COMMENT);
$template->replace_vars($page);
if($site->settings['showphp'] === false)
{
$template->removephp();
}

$template->publish();
?>
